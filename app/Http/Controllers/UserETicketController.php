<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ETicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserETicketController extends Controller
{
    /**
     * Display user's purchased e-tickets
     */
    public function index()
    {
        $user = Auth::user();

        // Get all user's paid transactions with e-tickets
        $transactions = Transaction::where('user_id', $user->id)
            ->where('status', 'paid')
            ->with(['eTickets', 'transactionDetails.ticket'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengunjung.etickets.index', compact('transactions'));
    }

    /**
     * Show specific e-ticket details
     */
    public function show(ETicket $eTicket)
    {
        // Check if e-ticket belongs to current user
        if ($eTicket->transaction->user_id !== Auth::id()) {
            return redirect()->route('user.etickets.index')->with('error', 'Akses tidak diizinkan');
        }

        // Generate QR code - use the raw QR code string
        $qrCodeData = $eTicket->qr_code;
        $qrCode = QrCode::size(300)
            ->backgroundColor(255, 255, 255)
            ->color(0, 0, 0)
            ->margin(2)
            ->generate($qrCodeData);

        // Get ticket details from QR data
        $ticketDetails = json_decode($eTicket->qr_code, true);

        // If QR code is not JSON, create basic details
        if (!$ticketDetails) {
            $ticketDetails = [
                'transaction_id' => $eTicket->transaction_id,
                'ticket_code' => $eTicket->qr_code
            ];
        }

        return view('pengunjung.etickets.show', compact('eTicket', 'qrCode', 'ticketDetails'));
    }

    /**
     * Download e-ticket as PDF (future enhancement)
     */
    public function download(ETicket $eTicket)
    {
        // Check if e-ticket belongs to current user
        if ($eTicket->transaction->user_id !== Auth::id()) {
            return redirect()->route('user.etickets.index')->with('error', 'Akses tidak diizinkan');
        }

        // For now, just redirect to show page
        // In the future, you can implement PDF generation here
        return redirect()->route('user.etickets.show', $eTicket);
    }
}
