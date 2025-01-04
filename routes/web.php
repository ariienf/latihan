<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailPenawaranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Ambil data semua pengguna
    $users = \App\Models\User::all();

    // Ambil total pengguna
    $totalUsers = \App\Models\User::count();

    // Ambil data produk dengan relasi kategori
    $produks = \App\Models\Produk::with('kategori')->paginate(10);

    // Ambil data penawaran dengan relasi customer dan sales
    $penawarans = \App\Models\Penawaran::with('customer', 'user')->paginate(10);
    
    // Ambil data customer
    $customers = \App\Models\Customer::paginate(10);

    $detailPenawarans = \App\Models\DetailPenawaran::paginate(10);

 

    // Kirim data ke view
    return view('dashboard', compact('users', 'totalUsers', 'produks', 'penawarans', 'customers', 'detailPenawarans'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('users', UserController::class);
Route::get('/customers/{id}/edit', [PenawaranController::class, 'editCustomer'])->name('customers.edit');
Route::put('/customers/{id}', [PenawaranController::class, 'updateCustomer'])->name('customers.update');
Route::delete('/customers/{id}', [PenawaranController::class, 'deleteCustomer'])->name('customers.delete');
Route::resource('produks', ProdukController::class);
Route::delete('/produks/{id}', [ProdukController::class, 'destroy'])->name('produks.delete');
Route::resource('kategoris', KategoriController::class);
Route::delete('/kategoris/{id}', [KategoriController::class, 'destroy'])->name('kategoris.delete');
Route::resource('customers', CustomerController::class);



Route::middleware('auth')->group(function () {
    // Route untuk menampilkan form tambah penawaran
    Route::get('/penawaran/create', [PenawaranController::class, 'create'])->name('penawaran.create');
    
    // Route untuk menyimpan data penawaran
    Route::post('/penawaran', [PenawaranController::class, 'store'])->name('penawaran.store');
    
    // Route untuk menampilkan daftar penawaran
    Route::get('/penawaran', [PenawaranController::class, 'index'])->name('penawaran.index');
    
    // Route untuk menampilkan form edit penawaran
    Route::get('/penawaran/{penawaran}/edit', [PenawaranController::class, 'edit'])->name('penawaran.edit');
    
    // Route untuk memperbarui penawaran
    Route::put('/penawaran/{penawaran}', [PenawaranController::class, 'update'])->name('penawaran.update');
    
    // Route untuk menghapus penawaran
    Route::delete('/penawaran/{penawaran}', [PenawaranController::class, 'destroy'])->name('penawaran.delete');
});

Route::middleware('auth')->group(function () {
    // Route untuk menampilkan daftar detail penawaran
    Route::get('/detail-penawaran', [DetailPenawaranController::class, 'index'])->name('detail_penawaran.index');
    
    // Route untuk menampilkan form input detail penawaran
    Route::get('/detail-penawaran/create', [DetailPenawaranController::class, 'create'])->name('detail_penawaran.create');
    
    // Route untuk menyimpan data detail penawaran
    Route::post('/detail-penawaran', [DetailPenawaranController::class, 'store'])->name('detail_penawaran.store');
    
    // Route untuk menampilkan form edit detail penawaran
    Route::get('/detail-penawaran/{id}/edit', [DetailPenawaranController::class, 'edit'])->name('detail_penawaran.edit');
    
    // Route untuk mengupdate data detail penawaran
    Route::put('/detail-penawaran/{id}', [DetailPenawaranController::class, 'update'])->name('detail_penawaran.update');
    
    // Route untuk menghapus data detail penawaran
    Route::delete('/detail-penawaran/{id}', [DetailPenawaranController::class, 'destroy'])->name('detail_penawaran.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
