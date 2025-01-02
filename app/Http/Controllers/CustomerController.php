<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); // Ambil semua data customer
        return view('customers.index', compact('customers'));
    }


    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email', // Menghapus unique
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15', // Menggunakan integer
        ]);

        Customer::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('customers.index')->with('success', 'Data customer berhasil disimpan!');
    }
}
