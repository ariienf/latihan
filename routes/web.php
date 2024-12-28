<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Ambil data pengguna
    $sales = \App\Models\User::all();

    // Kirim data ke view
    return view('dashboard', compact('sales'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('produks', ProdukController::class);
Route::resource('kategoris', KategoriController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
