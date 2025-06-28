<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomestayController;
use App\Http\Controllers\Api\UserControllerController;

Route::apiResource('homestays', HomestayController::class);
Route::apiResource('users', UserControllerController::class);