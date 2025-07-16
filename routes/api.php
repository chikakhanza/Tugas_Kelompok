<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomestayController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LaporanController;

// Auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/address', [AuthController::class, 'updateAddress']);
    Route::get('/address', [AuthController::class, 'getAddress']);

    // Route laporan
    Route::get('/laporan/booking', [LaporanController::class, 'booking']);
    Route::get('/laporan/payment', [LaporanController::class, 'payment']);
    Route::get('/laporan/homestay', [LaporanController::class, 'homestay']);
    Route::get('/laporan/pendapatan', [LaporanController::class, 'pendapatan']);
});

Route::apiResource('homestays', HomestayController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('payments', PaymentController::class);