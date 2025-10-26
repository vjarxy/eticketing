<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        Ticket::create($request->all());
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil ditambahkan');
    }

    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $ticket->update($request->all());
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil diperbarui');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dihapus');
    }

    // Public methods for customers
    public function showAll()
    {
        $tickets = Ticket::where('status', 'aktif')->get();
        return view('pengunjung.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('pengunjung.tickets.show', compact('ticket'));
    }

    public function addToCart(Request $request, Ticket $ticket)
{
    $request->validate([
        'quantity'   => 'required|integer|min:1',
        'visit_time' => 'required|date',
        'price'      => 'required|integer',
    ]);

    $visitTime = Carbon::parse($request->visit_time);
    $now = Carbon::now();

    // Validasi waktu pembelian (H-7 sampai H-5 jam)
    $minPurchaseTime = $visitTime->copy()->subDays(7);
    $maxPurchaseTime = $visitTime->copy()->subHours(5);

    if ($now->lt($minPurchaseTime)) {
        return back()->with('error', 'Tiket hanya dapat dibeli mulai H-7 sebelum waktu kunjungan.');
    }
    if ($now->gt($maxPurchaseTime)) {
        return back()->with('error', 'Tiket tidak dapat dibeli lagi karena sudah melewati batas H-5 jam sebelum kunjungan.');
    }

    // 🔍 Ambil daftar hari libur dari API
    try {
        $response = Http::get('https://api-harilibur.vercel.app/api?year=' . $visitTime->year);
        $holidays = $response->json(); // misal array dengan elemen ['date'=>'YYYY-MM-DD', …]
    } catch (\Exception $e) {
        // apabila gagal fetch, fallback ke array kosong atau daftar manual
        $holidays = [];
    }

    // Cek apakah tanggal kunjungan adalah hari libur nasional
    $visitDateString = $visitTime->format('Y-m-d');
    $isHoliday = collect($holidays)
                 ->pluck('date')
                 ->contains($visitDateString);

    $dayOfWeek = $visitTime->dayOfWeek; // 0 = Sunday, 6 = Saturday

    // Hitung harga berdasarkan kategori
    if ($isHoliday || $dayOfWeek === 0) {
        $price = 40000; // Minggu atau hari libur nasional
    } elseif ($dayOfWeek === 6) {
        $price = 30000; // Sabtu
    } else {
        $price = 20000; // Weekday
    }

    // Simpan ke keranjang
    $user = Auth::user();
    $existingCart = $user->carts()->where('ticket_id', $ticket->id)->first();

    if ($existingCart) {
        $existingCart->update([
            'quantity'   => $existingCart->quantity + $request->quantity,
            'price'      => $price,
            'visit_time' => $visitTime,
        ]);
    } else {
        $user->carts()->create([
            'ticket_id'  => $ticket->id,
            'quantity'   => $request->quantity,
            'price'      => $price,
            'visit_time' => $visitTime,
        ]);
    }

    return redirect()->back()->with('success', 'Tiket berhasil ditambahkan ke keranjang!');
}
}
