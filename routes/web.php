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

// ============================
// CRUD Homestay
// ============================
Route::prefix('homestays')->name('homestays.')->group(function () {
    Route::get('/', [HomestayController::class, 'index'])->name('index');
    Route::get('/create', [HomestayController::class, 'create'])->name('create');
    Route::post('/', [HomestayController::class, 'store'])->name('store');
    Route::get('/{id}', [HomestayController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [HomestayController::class, 'edit'])->name('edit');
    Route::put('/{id}', [HomestayController::class, 'update'])->name('update');
    Route::delete('/{id}', [HomestayController::class, 'destroy'])->name('destroy');
});

// ============================
// CRUD User
// ============================
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});
// ============================
// CRUD Booking
// ============================
Route::prefix('bookings')->name('bookings.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::get('/create', [BookingController::class, 'create'])->name('create');
    Route::post('/', [BookingController::class, 'store'])->name('store');
    Route::get('/{user}', [BookingController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [BookingController::class, 'edit'])->name('edit');
    Route::put('/{user}', [BookingController::class, 'update'])->name('update');
    Route::delete('/{user}', [BookingController::class, 'destroy'])->name('destroy');
});
// ============================
// CRUD Payment
// ============================
Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::get('/create', [PaymentController::class, 'create'])->name('create');
    Route::post('/', [PaymentController::class, 'store'])->name('store');
    Route::get('/{user}', [PaymentController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [PaymentController::class, 'edit'])->name('edit');
    Route::put('/{user}', [PaymentController::class, 'update'])->name('update');
    Route::delete('/{user}', [PaymentController::class, 'destroy'])->name('destroy');
});
