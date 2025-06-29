<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomestayController;
use App\Http\Controllers\Api\UserControllerController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;

Route::apiResource('homestays', HomestayController::class);
Route::apiResource('users', UserControllerController::class);
Route::apiResource('bookings', BookingControllerController::class);
Route::apiResource('payments', PaymentController::class);