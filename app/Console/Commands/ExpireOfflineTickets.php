<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ETicket;
use App\Models\Transaction;
use Carbon\Carbon;

class ExpireOfflineTickets extends Command
{
    protected $signature = 'tickets:expire-offline';
    protected $description = 'Set offline (cash) tickets to expired if the transaction date has passed and still active';

    public function handle()
    {
        $today = Carbon::today();

        // Ambil transaksi offline (cash)
        $offlineTransactions = Transaction::where('payment_method', 'cash')->get();

        $count = 0;

        foreach ($offlineTransactions as $trx) {
            // Jika transaksi lebih lama dari hari ini
            if (Carbon::parse($trx->created_at)->lt($today)) {
                // Ubah semua e-ticket aktif jadi expired
                $updated = ETicket::where('transaction_id', $trx->id)
                    ->where('status', 'active')
                    ->update(['status' => 'expired']);

                $count += $updated;
            }
        }

        $this->info("Offline tickets expired: {$count}");
    }
}
