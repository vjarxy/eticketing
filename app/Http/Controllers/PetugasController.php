<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ETicket;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard');
    }

    public function verifikasi(Request $request)
    {
        $qrCode = $request->input('qr_code');
        $ticket = ETicket::where('qr_code', $qrCode)->first();

        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'Tiket tidak ditemukan'], 404);
        }

        if ($ticket->status === 'used') {
            return response()->json(['status' => 'error', 'message' => 'Tiket sudah digunakan'], 400);
        }

        $ticket->update(['status' => 'used']);
        return response()->json(['status' => 'success', 'message' => 'Tiket valid dan berhasil diverifikasi']);
    }
}
