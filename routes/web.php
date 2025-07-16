<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomestayController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Login & Logout Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Hanya bisa diakses jika sudah login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    // Laporan Homestay
    Route::get('/homestays/laporan', [HomestayController::class, 'laporan'])->name('homestays.laporan');

    // Data Master: CRUD
    Route::resource('homestays', HomestayController::class);
    Route::resource('users', UserController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/laporan/booking', [LaporanController::class, 'bookingReport'])->name('laporan.booking');
    Route::get('/laporan/payment', [LaporanController::class, 'paymentReport'])->name('laporan.payment');
    Route::get('/laporan/pendapatan', [LaporanController::class, 'pendapatanReport'])->name('laporan.pendapatan');
    Route::get('/laporan/homestay', [LaporanController::class, 'homestayReport'])->name('laporan.homestay');
});

