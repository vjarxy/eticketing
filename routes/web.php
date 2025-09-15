<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.dashboard');
});


// Auth
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::post('/luri: ogout', [AuthController::class, 'logout'])->name('logout');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/tickets', TicketController::class);
});

// Petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('petugas/dashboard', [PetugasController::class, 'index']);
});

// Pengunjung
Route::middleware(['auth', 'role:pengunjung'])->group(function () {
    Route::get('transaksi', [TransactionController::class, 'index']);
    Route::post('transaksi/beli', [TransactionController::class, 'store']);
});
