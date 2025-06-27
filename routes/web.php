<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomestayController;

// =======================
// Halaman Dashboard
// =======================
Route::get('/', function () {
    return view('dashboard.dashboard'); // Pastikan view-nya ada
})->name('dashboard');

// =======================
// Halaman Kamar (Opsional)
// =======================
Route::get('/kamar', function () {
    return view('kamar.index'); // Pastikan file resources/views/kamar/index.blade.php ada
})->name('kamar.index');

// =======================
// Route CRUD Homestay
// =======================
Route::prefix('homestays')->name('homestays.')->group(function () {
    Route::get('/', [HomestayController::class, 'index'])->name('index');           // List homestay
    Route::get('/create', [HomestayController::class, 'create'])->name('create');   // Form tambah
    Route::post('/', [HomestayController::class, 'store'])->name('store');          // Simpan data
    Route::get('/{id}', [HomestayController::class, 'show'])->name('show');         // Lihat detail
    Route::get('/{id}/edit', [HomestayController::class, 'edit'])->name('edit');    // Form edit
    Route::put('/{id}', [HomestayController::class, 'update'])->name('update');     // Simpan edit
    Route::delete('/{id}', [HomestayController::class, 'destroy'])->name('destroy');// Hapus
});
