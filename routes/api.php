<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomestayController;
use App\Http\Controllers\Api\UserControllerController;
use App\Http\Controllers\Api\BookingController;

Route::apiResource('homestays', HomestayController::class);
Route::apiResource('users', UserControllerController::class);
Route::apiResource('bookings', BookingControllerController::class);