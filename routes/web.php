<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomestayController;

// Halaman Dashboard
Route::get('/', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

// Halaman daftar Homestay (untuk menu)
Route::get('/homestays', [HomestayController::class, 'index'])->name('homestays.index');

// CRUD Homestay
Route::prefix('homestays')->name('homestays.')->group(function () {
    Route::get('/create', [HomestayController::class, 'create'])->name('create');
    Route::post('/', [HomestayController::class, 'store'])->name('store');
    Route::get('/{id}', [HomestayController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [HomestayController::class, 'edit'])->name('edit');
    Route::put('/{id}', [HomestayController::class, 'update'])->name('update');
    Route::delete('/{id}', [HomestayController::class, 'destroy'])->name('destroy');
});
