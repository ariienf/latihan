<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data pengguna dengan role 'sales'
        $sales = User::where('id', 'name')->get();

        // Kirim data ke view 'dashboard'
        return view('dashboard', compact('sales'));
    }
}
