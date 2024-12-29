<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Penawaran;
use App\Models\DetailPenawaran;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class PenawaranController extends Controller
{
    public function index()
    {
        // Ambil data penawaran dengan pagination
        $penawarans = Penawaran::with('customer')->paginate(10); // Menampilkan 10 penawaran per halaman
        
        return view('penawaran.index', compact('penawarans'));
    }

    public function create()
    {
        // Ambil semua data produk dan users
        $produks = Produk::all();
        $users = User::all(); // Menambahkan daftar user
        return view('penawaran.create', compact('produks', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'status' => 'required|in:Success,On Progress',
            'tanggal' => 'required|date',
            'customer_nama' => 'required|string|max:255',
            'customer_email' => 'required|string',
            'customer_alamat' => 'required|string',
            'customer_telepon' => 'required|integer',
            'user_id' => 'required|exists:users,id', // Validasi user_id
            'produk_ids' => 'required|array', // Validasi produk
            'produk_ids.*' => 'exists:produks,id', // Pastikan produk yang dipilih ada
            'jumlahs' => 'required|array', // Jumlah untuk tiap produk
            'jumlahs.*' => 'integer|min:1', // Pastikan jumlah produk positif
        ]);
    
        // Buat data customer
        $customer = Customer::create([
            'nama' => $validated['customer_nama'],
            'email' => $validated['customer_email'],
            'alamat' => $validated['customer_alamat'],
            'telepon' => $validated['customer_telepon'],
        ]);
    
        if (!$customer) {
            return redirect()->back()->withErrors('Gagal membuat data customer.');
        }
    
        // Ambil user yang login
        $user = User::find($validated['user_id']); // Menggunakan user_id dari form input
        if (!$user) {
            return redirect()->route('login')->withErrors('User tidak valid.');
        }
    
        // Buat data penawaran
        $penawaran = Penawaran::create([
            'status' => $validated['status'],
            'tanggal' => $validated['tanggal'],
            'customer_id' => $customer->id,
            'user_id' => $user->id, // Gunakan user_id yang dipilih
        ]);
    
        if (!$penawaran) {
            return redirect()->back()->withErrors('Gagal membuat penawaran.');
        }
    
        // Validasi stok produk dan buat detail penawaran
        foreach ($validated['produk_ids'] as $index => $produk_id) {
            $produk = Produk::find($produk_id);
            
            // Pastikan jumlah produk tidak melebihi stok yang tersedia
            if ($produk->stok < $validated['jumlahs'][$index]) {
                return redirect()->back()->withErrors('Jumlah produk ' . $produk->nama . ' melebihi stok yang tersedia.');
            }
    
            // Buat detail penawaran
            DetailPenawaran::create([
                'penawaran_id' => $penawaran->id,
                'produk_id' => $produk_id,
                'jumlah' => $validated['jumlahs'][$index],
                'subtotal' => $produk->harga * $validated['jumlahs'][$index], // Hitung subtotal
            ]);
    
            // Update stok produk setelah penawaran berhasil dibuat
            $produk->stok -= $validated['jumlahs'][$index];
            $produk->save();
        }
    
        return redirect()->route('penawaran.index')->with('success', 'Penawaran berhasil dibuat.');
    }
    

    public function edit($id)
    {
        $penawaran = Penawaran::findOrFail($id);
        return view('penawaran.edit', compact('penawaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Success,On Progress',
        ]);

        $penawaran = Penawaran::findOrFail($id);
        $penawaran->update([
            'status' => $request->status,
        ]);

        return redirect()->route('penawaran.index')->with('success', 'Penawaran berhasil diperbarui.');
    }
}
