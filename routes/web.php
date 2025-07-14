<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomestayController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;

// ----------------------------
// Halaman Dashboard Utama
// ----------------------------
Route::get('/', function () {
    return view('dashboard.dashboard');
})->name('dashboard');


Route::get('/homestays/laporan', [HomestayController::class, 'laporan'])->name('homestays.laporan');
// ============================
// CRUD Homestay
// ============================
Route::resource('homestays', HomestayController::class);

// ============================
// CRUD User
// ============================
Route::resource('users', UserController::class);

// ============================
// CRUD Booking
// ============================
Route::resource('bookings', BookingController::class);

// ============================
// CRUD Payment
// ============================
Route::resource('payments', PaymentController::class);
