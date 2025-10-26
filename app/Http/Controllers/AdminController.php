<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {

        $currentMonth = now()->locale('id')->translatedFormat('F'); 

        // Statistik utama (sudah ada)
        $totalPengunjung = User::count();
        $totalPendapatan = Transaction::where('status','paid')->sum('total');
        $totalTiket = DB::table('tickets')->count();
        $transaksiHariIni = Transaction::whereDate('created_at', now())->get();
        $totalTransaksi = Transaction::count();
        $pendapatanHariIni = Transaction::where('status','paid')->whereDate('created_at', now())->sum('total');

        // ====== Statistik Bulanan untuk Grafik ======
        // 1. Pendapatan per bulan
        $pendapatanBulanan = Transaction::select(
                DB::raw("MONTH(created_at) as bulan"),
                DB::raw("SUM(total) as total")
            )
            ->where('status', 'paid')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('total', 'bulan')
            ->toArray();

        // 2. Penjualan tiket per bulan
        $tiketBulanan = TransactionDetail::select(
                DB::raw("MONTH(transaction_details.created_at) as bulan"),
                DB::raw("SUM(transaction_details.quantity) as total_tiket")
            )
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->where('transactions.status', 'paid')
            ->whereYear('transaction_details.created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(transaction_details.created_at)"))
            ->pluck('total_tiket', 'bulan')
            ->toArray();

        // 3. Pengunjung per bulan
        $pengunjungBulanan = User::select(
                DB::raw("MONTH(created_at) as bulan"),
                DB::raw("COUNT(id) as total_pengunjung")
            )
            ->where('role', 'pengunjung')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('total_pengunjung', 'bulan')
            ->toArray();

        // ====== Format Data untuk Chart.js ======
        $bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        $pendapatanData = [];
        $tiketData = [];
        $pengunjungData = [];
        for ($i = 1; $i <= 12; $i++) {
            $pendapatanData[] = $pendapatanBulanan[$i] ?? 0;
            $tiketData[] = $tiketBulanan[$i] ?? 0;
            $pengunjungData[] = $pengunjungBulanan[$i] ?? 0;
        }

        return view('admin.dashboard', [
            'totalPengunjung' => $totalPengunjung,
            'totalPendapatan' => $totalPendapatan,
            'totalTiket' => $totalTiket,
            'transaksiHariIni' => $transaksiHariIni,
            'totalTransaksi' => $totalTransaksi,
            'pendapatanHariIni' => $pendapatanHariIni,
            'bulanLabels' => $bulanLabels,
            'pendapatanData' => $pendapatanData,
            'tiketData' => $tiketData,
            'pengunjungData' => $pengunjungData,
            'currentMonth' => $currentMonth,
        ]);
    }
}
