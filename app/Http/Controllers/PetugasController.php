<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ETicket;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard');
    }

    public function verifikasi(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode QR tidak valid'
            ], 422);
        }

        $qrCode = $request->input('qr_code');

        try {
            // Try to decode QR code first to get transaction_id
            $qrData = json_decode($qrCode, true);

            // If QR code is not JSON, treat it as raw QR code
            if (!$qrData) {
                $ticket = ETicket::with(['transaction.user'])
                    ->where('qr_code', $qrCode)
                    ->first();
            } else {
                // If QR code is JSON, find by transaction_id
                $ticket = ETicket::with(['transaction.user'])
                    ->where('transaction_id', $qrData['transaction_id'] ?? null)
                    ->first();
            }

            if (!$ticket) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tiket tidak ditemukan atau kode QR tidak valid'
                ], 404);
            }

            // Check if ticket is already used
            if ($ticket->status === 'used') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tiket sudah digunakan sebelumnya'
                ], 400);
            }

            // Check if transaction is paid/confirmed
            if (!in_array($ticket->transaction->status, ['paid', 'confirmed'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tiket belum dibayar atau dikonfirmasi'
                ], 400);
            }

            // Check if ticket is expired
            // For waterboom tickets, let's assume they're valid for 30 days from purchase
            $purchaseDate = $ticket->transaction->created_at;
            $expiryDate = $purchaseDate->copy()->addDays(30);
            $today = Carbon::now();

            if ($today->greaterThan($expiryDate)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tiket sudah expired (kadaluarsa sejak ' . $expiryDate->format('d/m/Y') . ')'
                ], 400);
            }

            // All checks passed, mark ticket as used
            DB::transaction(function () use ($ticket) {
                $ticket->update([
                    'status' => 'used',
                    'used_at' => now()
                ]);
            });

            // Get ticket details for response
            $transactionDetails = $ticket->transaction->transactionDetails()->with('ticket')->get();
            $ticketNames = $transactionDetails->pluck('ticket.name')->join(', ');
            $totalQuantity = $transactionDetails->sum('quantity');

            return response()->json([
                'status' => 'success',
                'message' => 'Tiket berhasil diverifikasi! Silakan masuk.',
                'data' => [
                    'ticket_id' => $ticket->id,
                    'transaction_id' => $ticket->transaction->id,
                    'customer_name' => $ticket->transaction->user->name,
                    'ticket_names' => $ticketNames,
                    'total_quantity' => $totalQuantity,
                    'purchase_date' => $ticket->transaction->created_at->format('d/m/Y H:i'),
                    'verification_time' => now()->format('d/m/Y H:i:s')
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Ticket verification error', [
                'message' => $e->getMessage(),
                'qr_code' => $qrCode,
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            // Don't expose internal error details in production
            $message = config('app.debug')
                ? 'Error: ' . $e->getMessage() . ' (Line: ' . $e->getLine() . ')'
                : 'Terjadi kesalahan sistem saat memverifikasi tiket';

            return response()->json([
                'status' => 'error',
                'message' => $message
            ], 500);
        }
    }

    public function getStats()
    {
        try {
            $today = Carbon::today();

            $stats = [
                'verified_today' => ETicket::where('status', 'used')
                    ->whereDate('updated_at', $today)
                    ->count(),
                'total_tickets_today' => ETicket::whereHas('transaction', function ($query) use ($today) {
                    $query->whereDate('created_at', $today)
                        ->whereIn('status', ['paid', 'confirmed']);
                })->count(),
                'pending_verification' => ETicket::where('status', 'active')
                    ->whereHas('transaction', function ($query) use ($today) {
                        $query->whereDate('created_at', $today)
                            ->whereIn('status', ['paid', 'confirmed']);
                    })->count()
            ];

            return response()->json([
                'status' => 'success',
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil statistik'
            ], 500);
        }
    }
}
