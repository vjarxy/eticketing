<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $existingCart = $user->carts()->where('ticket_id', $ticket->id)->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + $request->quantity,
            ]);
        } else {
            $user->carts()->create([
                'ticket_id' => $ticket->id,
                'quantity' => $request->quantity,
                'price' => $ticket->price,
            ]);
        }

        return redirect()->back()->with('success', 'Tiket berhasil ditambahkan ke keranjang');
    }
}
