<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ETicket;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\TransactionDetail;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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

            // Check transaction status and handle cash payment auto-confirmation
            if ($ticket->transaction->status === 'pending' && $ticket->transaction->payment_method === 'cash') {
                // For cash payments, automatically mark as paid when scanned
                $ticket->transaction->update([
                    'status' => 'paid',
                    'updated_at' => now()
                ]);

                // Add notification that payment was completed
                $paymentCompletedMessage = ' ✅ PEMBAYARAN TUNAI BERHASIL DIKONFIRMASI!';
            } elseif (!in_array($ticket->transaction->status, ['paid', 'confirmed'])) {
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

            $message = 'Tiket berhasil diverifikasi! Silakan masuk.';
            if (isset($paymentCompletedMessage)) {
                $message .= $paymentCompletedMessage;
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => [
                    'ticket_id' => $ticket->id,
                    'transaction_id' => $ticket->transaction->id,
                    'customer_name' => $ticket->transaction->user->name,
                    'customer_email' => $ticket->transaction->user->email,
                    'ticket_names' => $ticketNames,
                    'total_quantity' => $totalQuantity,
                    'total_amount' => 'Rp ' . number_format($ticket->transaction->total, 0, ',', '.'),
                    'payment_method' => $ticket->transaction->payment_method === 'cash' ? 'Tunai' : 'Midtrans',
                    'purchase_date' => $ticket->transaction->created_at->format('d/m/Y H:i'),
                    'verification_time' => now()->format('d/m/Y H:i:s'),
                    'payment_completed' => isset($paymentCompletedMessage) ? true : false
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

    public function transaksiOfflineForm()
    {
        $tickets = Ticket::where('status', 'aktif')->get();
        return view('petugas.transaksi_offline', compact('tickets'));
    }

    public function storeTransaksiOffline(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:100',
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $ticket = Ticket::findOrFail($request->ticket_id);
            $quantity = $request->quantity;
            $total = $ticket->price * $quantity;

            // Simpan transaksi offline (tunai)
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'payment_method' => 'cash',
                'status' => 'paid',
            ]);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'ticket_id' => $ticket->id,
                'quantity' => $quantity,
                'price' => $ticket->price,
                'total' => $total,
            ]);

            // Buat QR Code unik
            $qrData = json_encode([
                'transaction_id' => $transaction->id,
                'ticket_id' => $ticket->id,
                'type' => 'offline',
            ]);

            $qrCodeFile = 'qr_' . time() . '_' . Str::random(6) . '.png';
            $qrDir = public_path('storage/images/');
            if (!file_exists($qrDir)) mkdir($qrDir, 0777, true);

            QrCode::format('png')->size(250)->generate($qrData, $qrDir . $qrCodeFile);

            $eticket = ETicket::create([
                'transaction_id' => $transaction->id,
                'qr_code' => 'storage/images/' . $qrCodeFile,
                'status' => 'active',
            ]);

            DB::commit();

            // Arahkan ke halaman sukses dengan QR code
            return redirect()->route('petugas.transaksi.offline.success', ['code' => $transaction->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaksi Offline Gagal: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat transaksi: ' . $e->getMessage());
        }
    }

    public function transaksiOfflineSuccess($code)
    {
        $transaction = Transaction::with(['transactionDetails.ticket', 'user'])
            ->findOrFail($code);

        $eticket = ETicket::where('transaction_id', $transaction->id)->firstOrFail();

        // Buat QR Image Base64 agar langsung tampil di view
        $qrImage = base64_encode(file_get_contents(public_path($eticket->qr_code)));

        return view('petugas.transaksi_offline_success', [
            'transaction' => $transaction,
            'eticket' => $eticket,
            'qrImage' => $qrImage,
        ]);
    }

    public function riwayatPenjualan(Request $request)
{
    // 🔹 Update otomatis status transaksi offline yang sudah lewat tanggalnya
    $offlineTransactions = Transaction::where('payment_method', 'cash')
        ->whereIn('status', ['paid', 'confirmed'])
        ->get();

    foreach ($offlineTransactions as $trx) {
        $createdDate = Carbon::parse($trx->created_at)->toDateString();
        $today = Carbon::now()->toDateString();

        if ($createdDate < $today) {
            // Ubah status transaksi jadi cancel (bukan hangus)
            $trx->update(['status' => 'cancel']);
        
            // Sekaligus ubah status tiketnya juga biar sinkron
            ETicket::where('transaction_id', $trx->id)->update(['status' => 'expired']);
        }
    }

    // 🔹 Query dasar transaksi
    $query = Transaction::with(['user', 'transactionDetails.ticket', 'eTickets'])
        ->orderBy('created_at', 'desc');

    // 🔹 Tambahkan filter berdasarkan request (semisal ?status=hangus)
    if ($request->has('status') && $request->status !== '') {
        if ($request->status === 'hangus') {
            $query->where('status', 'cancel'); // tampilkan yg cancel = hangus
        } else {
            $query->where('status', $request->status);
        }
    } else {
        // default: hanya tampilkan transaksi aktif (paid, confirmed)
        $query->whereIn('status', ['paid', 'confirmed']);
    }

    // 🔹 Ambil data dengan pagination
    $transactions = $query->paginate(20);

    return view('petugas.riwayat', compact('transactions'));
}

}
