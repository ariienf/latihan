<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Penawaran;

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil data penawaran dengan pagination
        $penawarans = Penawaran::with('customer')->paginate(10); // Menampilkan 10 penawaran per halaman

        // Ambil data customer dengan pagination
        $customers = Customer::paginate(10); // Menampilkan 10 customer per halaman
        return view('penawaran.index', compact('penawarans', 'customers'));
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

        return redirect()->route('penawaran.index')->with('success', 'Data customer berhasil disimpan!');
    }
}
