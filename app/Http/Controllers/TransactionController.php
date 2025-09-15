<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Ticket;
use App\Models\ETicket;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('status', 'aktif')->get();
        return view('pengunjung.transaksi.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::find($request->ticket_id);
        $total = $ticket->harga * $request->jumlah;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_harga' => $total,
            'metode_pembayaran' => $request->metode_pembayaran ?? 'tunai',
            'status' => 'paid',
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'ticket_id' => $ticket->id,
            'jumlah' => $request->jumlah,
            'subtotal' => $total,
        ]);

        $qrCodeData = 'TiketID-' . $transaction->id . '-' . Auth::id();
        ETicket::create([
            'transaction_id' => $transaction->id,
            'qr_code' => $qrCodeData,
            'status' => 'valid',
        ]);

        return redirect()->back()->with('success', 'Tiket berhasil dibeli. QR Code telah dibuat.');
    }
}
