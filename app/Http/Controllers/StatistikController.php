<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class StatistikController extends Controller
{
    public function index()
    {
        // === 1. Hari paling ramai (dalam 30 hari terakhir) ===
        $hariRamai = Transaction::select(
                DB::raw('DAYNAME(created_at) as hari'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->where('status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('hari')
            ->orderByDesc('jumlah')
            ->first();

        // === 2. Rata-rata pengunjung per hari ===
        $totalPengunjung = TransactionDetail::join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->where('transactions.status', 'paid')
            ->sum('transaction_details.quantity');

        $jumlahHari = Transaction::where('status','paid')
            ->select(DB::raw('DATE(created_at) as tgl'))
            ->groupBy('tgl')
            ->get()
            ->count();

        $rataPengunjung = $jumlahHari > 0 ? round($totalPengunjung / $jumlahHari, 0) : 0;

        // === 3. Pengunjung bulan berjalan ===
        $bulanSekarang = Carbon::now()->format('F Y'); // Contoh: September 2025
        $totalBulanIni = TransactionDetail::join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->where('transactions.status','paid')
            ->whereYear('transactions.created_at', Carbon::now()->year)
            ->whereMonth('transactions.created_at', Carbon::now()->month)
            ->sum('transaction_details.quantity');

        return view('layouts.dashboard', [
            'hariRamai' => $hariRamai ? $hariRamai->hari : '-',
            'rataPengunjung' => $rataPengunjung,
            'bulanSekarang' => $bulanSekarang,
            'totalBulanIni' => $totalBulanIni,
        ]);
    }
}