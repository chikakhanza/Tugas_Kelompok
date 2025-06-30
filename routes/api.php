<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomestayController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;

Route::apiResource('users', UserController::class);
Route::apiResource('homestays', HomestayController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('payments', PaymentController::class);

// Optional: Cek koneksi API
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
