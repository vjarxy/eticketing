<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StatistikControllerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\UserETicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.dashboard');
})->name('dashboard');

Route::get('/', [StatistikController::class, 'index'])->name('dashboard');

// Public Ticket Routes (accessible to all authenticated users)
Route::middleware('auth')->group(function () {
    // Ticket browsing and purchasing
    Route::get('/tickets', [TicketController::class, 'showAll'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/add-to-cart', [TicketController::class, 'addToCart'])->name('tickets.add-to-cart');

    // Cart management
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Payment and checkout
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success/{transaction}', [PaymentController::class, 'success'])->name('payment.success');

    // E-Ticket
    Route::get('/eticket/{eTicket}', [PaymentController::class, 'showETicket'])->name('eticket.show');

    // User E-Tickets Dashboard
    Route::get('/my-tickets', [UserETicketController::class, 'index'])->name('user.etickets.index');
    Route::get('/my-tickets/{eTicket}', [UserETicketController::class, 'show'])->name('user.etickets.show');
    Route::get('/my-tickets/{eTicket}/download', [UserETicketController::class, 'download'])->name('user.etickets.download');
});

Route::prefix('petugas')->middleware(['auth'])->group(function () {
    Route::get('/riwayat-penjualan', [PetugasController::class, 'riwayatPenjualan'])
        ->name('petugas.riwayatPenjualan');
});

// Auth
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/tickets', TicketController::class)->names([
        'index' => 'admin.tickets.index',
        'create' => 'admin.tickets.create',
        'store' => 'admin.tickets.store',
        'show' => 'admin.tickets.show',
        'edit' => 'admin.tickets.edit',
        'update' => 'admin.tickets.update',
        'destroy' => 'admin.tickets.destroy'
    ]);
});

// Petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
    Route::post('petugas/verifikasi', [PetugasController::class, 'verifikasi'])->name('petugas.verifikasi');
    Route::get('petugas/stats', [PetugasController::class, 'getStats'])->name('petugas.stats');
    Route::get('petugas/transaksi-offline', [PetugasController::class, 'transaksiOfflineForm'])->name('petugas.transaksi.offline.form');
    Route::post('petugas/transaksi-offline', [PetugasController::class, 'storeTransaksiOffline'])->name('petugas.transaksi.offline.store');
    Route::get('petugas/transaksi-offline/success/{code}', [PetugasController::class, 'transaksiOfflineSuccess'])->name('petugas.transaksi.offline.success');
    Route::get('petugas/penjualan/riwayat', [PetugasController::class, 'riwayatPenjualan'])->name('petugas.penjualan.riwayat');
});

// Pengunjung
Route::middleware(['auth', 'role:pengunjung'])->group(function () {
    Route::get('transaksi', [TransactionController::class, 'index']);
    Route::post('transaksi/beli', [TransactionController::class, 'store']);
    Route::get('profile', [ProfileController::class, 'index'])->name('pengunjung.profile.index');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('pengunjung.profile.update');
    Route::put('profile/update/password', [ProfileController::class, 'password'])->name('pengunjung.profile.password');
});
