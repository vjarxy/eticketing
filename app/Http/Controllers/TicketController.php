<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

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
            'nama_tiket' => 'required|string',
            'harga' => 'required|numeric',
            'jenis' => 'required|string',
        ]);

        Ticket::create($request->all());
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil ditambahkan');
    }

    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'nama_tiket' => 'required|string',
            'harga' => 'required|numeric',
            'jenis' => 'required|string',
        ]);

        $ticket->update($request->all());
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil diperbarui');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus');
    }
}
