<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Ticket;
use App\Models\ETicket;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Total pengunjung (users with role 'pengunjung' or users who made transactions)
        $totalPengunjung = User::where('role', 'pengunjung')
            ->orWhereHas('transactions')
            ->count();

        // Total pendapatan (sum of all paid transactions)
        $totalPendapatan = Transaction::where('status', 'paid')
            ->sum('total');

        // Total tiket yang tersedia
        $totalTiket = Ticket::where('status', 'aktif')->count();

        // Transaksi hari ini
        $transaksiHariIni = Transaction::whereDate('created_at', Carbon::today())
            ->with(['user', 'transactionDetails.ticket'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Additional statistics for better dashboard
        $totalTransaksi = Transaction::count();
        $pendapatanHariIni = Transaction::where('status', 'paid')
            ->whereDate('created_at', Carbon::today())
            ->sum('total');

        return view('admin.dashboard', compact(
            'totalPengunjung',
            'totalPendapatan',
            'totalTiket',
            'transaksiHariIni',
            'totalTransaksi',
            'pendapatanHariIni'
        ));
    }
}
