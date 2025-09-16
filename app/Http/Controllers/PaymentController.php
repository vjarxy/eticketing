<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\ETicket;
use App\Models\PaymentMethod;
use App\Mail\ETicketMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PaymentController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = $user->carts()->with('ticket')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        $total = $cartItems->sum('total');
        $paymentMethods = PaymentMethod::where('is_active', true)->get();

        return view('pengunjung.checkout.index', compact('cartItems', 'total', 'paymentMethods'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $user = Auth::user();
        $cartItems = $user->carts()->with('ticket')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        $total = $cartItems->sum('total');

        DB::beginTransaction();

        try {
            // Create transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Create transaction details
            foreach ($cartItems as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'ticket_id' => $item->ticket_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ]);
            }

            // Generate E-Ticket with QR code for each ticket
            foreach ($cartItems as $item) {
                for ($i = 1; $i <= $item->quantity; $i++) {
                    // Create comprehensive QR data
                    $qrData = json_encode([
                        'transaction_id' => $transaction->id,
                        'ticket_id' => $item->ticket_id,
                        'ticket_name' => $item->ticket->name,
                        'user_name' => $user->name,
                        'issued_at' => now()->toDateTimeString(),
                        'verification_code' => 'TIK-' . strtoupper(uniqid()),
                    ]);

                    ETicket::create([
                        'transaction_id' => $transaction->id,
                        'qr_code' => $qrData,
                        'status' => 'valid',
                    ]);
                }
            }

            // Clear cart
            $user->carts()->delete();

            // For demo: Skip payment processing and mark as paid
            $transaction->update(['status' => 'paid']);

            DB::commit();

            return redirect()->route('payment.success', $transaction->id)
                ->with('success', 'Pembayaran berhasil diproses');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function success(Transaction $transaction)
    {
        // Check if transaction belongs to current user
        if ($transaction->user_id !== Auth::id()) {
            return redirect()->route('tickets.index')->with('error', 'Unauthorized access');
        }

        $eTickets = $transaction->eTickets;

        return view('pengunjung.payment.success', compact('transaction', 'eTickets'));
    }

    public function showETicket(ETicket $eTicket)
    {
        // Check if e-ticket belongs to current user
        if ($eTicket->transaction->user_id !== Auth::id()) {
            return redirect()->route('tickets.index')->with('error', 'Unauthorized access');
        }

        // Generate QR code image with better styling
        $qrCode = QrCode::size(300)
            ->backgroundColor(255, 255, 255)
            ->color(0, 0, 0)
            ->margin(2)
            ->generate($eTicket->qr_code);

        // Get ticket details
        $ticketDetails = json_decode($eTicket->qr_code, true);

        return view('pengunjung.etickets.show', compact('eTicket', 'qrCode', 'ticketDetails'));
    }
}
