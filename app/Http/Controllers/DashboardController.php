<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Penawaran;
use App\Models\Produk;
use App\Models\DetailPenawaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // Ambil data pengguna dengan role 'sales'
    $users = User::all();
    
    // Ambil total users (Sales)
    $totalUsers = User::count();
    
    // Ambil data produk dengan relasi kategori
    $produks = Produk::with('kategori')->paginate(10);
    
    // Ambil data penawaran dengan relasi customer dan sales
    $penawarans = Penawaran::with('customer', 'user')->paginate(10);
    
    // Ambil data customer
    $customers = Customer::paginate(10);

    // Ambil data detail penawaran terkait penawaran ini
    $detailPenawarans = DetailPenawaran::paginate(10);
    
    // Kirim data ke view
    return view('dashboard', compact('users', 'totalUsers', 'produks', 'penawarans', 'customers', 'detailPenawarans'));
}
}
