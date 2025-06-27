<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomestayController;

Route::apiResource('homestays', HomestayController::class);

