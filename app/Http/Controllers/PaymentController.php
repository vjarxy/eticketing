<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\ETicket;
use App\Models\PaymentMethod;
use App\Mail\ETicketMail;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Snap;
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
            'payment_method' => 'required|in:cash,midtrans',
        ]);

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total' => $request->total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
            ]);

            $cartItems = Cart::where('user_id', Auth::id())->with('ticket')->get();
            $totalAmount = 0;

            foreach ($cartItems as $cartItem) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'ticket_id' => $cartItem->ticket_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->ticket->price,
                    'total' => $cartItem->total,
                ]);

                $totalAmount += $cartItem->total;
            }

            // Update transaction total
            $transaction->update(['total' => $totalAmount]);

            // Create one e-ticket per transaction
            $qrData = [
                'transaction_id' => $transaction->id,
                'user_id' => Auth::id(),
                'timestamp' => now()->timestamp,
                'verification_code' => substr(hash('sha256', $transaction->id . Auth::id() . now()), 0, 16)
            ];

            ETicket::create([
                'transaction_id' => $transaction->id,
                'qr_code' => json_encode($qrData),
                'status' => 'active',
            ]);

            // Cash → set status confirmed dan langsung ke success
            if ($request->payment_method === 'cash') {
                $transaction->update(['status' => 'confirmed']);
                DB::commit();
                return redirect()->route('payment.success', $transaction->id);
            }

            // Midtrans → generate Snap
            if ($request->payment_method === 'midtrans') {
                Config::$serverKey = config('midtrans.serverKey');
                Config::$isProduction = config('midtrans.isProduction');
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $params = [
                    'transaction_details' => [
                        'order_id' => $transaction->id,
                        'gross_amount' => $transaction->total,
                    ],
                    'customer_details' => [
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    ],
                ];

                $snapToken = Snap::getSnapToken($params);

                DB::commit();
                // Kirim snapToken ke halaman yang sama
                return back()->with('snapToken', $snapToken)->with('transactionId', $transaction->id);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function success(Transaction $transaction)
    {
        // Check if transaction belongs to current user
        if ($transaction->user_id !== Auth::id()) {
            return redirect()->route('tickets.index')->with('error', 'Unauthorized access');
        }

        Cart::where('user_id', Auth::id())->delete();

        if ($transaction->payment_method === 'midtrans') {
            $transaction->status = 'paid';
            $transaction->save();
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
