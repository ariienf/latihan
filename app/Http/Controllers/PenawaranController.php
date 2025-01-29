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
        $totalPenawaran = Penawaran::count();
        
        // Ambil data customer dengan pagination
        $customers = Customer::paginate(10); // Menampilkan 10 customer per halaman
        $totalCustomer = Customer::count();

        // Kirim data ke view
        return view('penawaran.index', compact('penawarans', 'totalPenawaran', 'customers', 'totalCustomer'));
    }

    public function create()
    {
        // Ambil data customer dan user
        $customers = Customer::all();
        $users = User::all();

        // Kirim data ke view
        return view('penawaran.create', compact('customers', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // Simpan data penawaran
        Penawaran::create([
            'customer_id' => $validated['customer_id'],
            'user_id' => $validated['user_id'],
            'status' => $validated['status'],
            'tanggal' => $validated['tanggal'],
        ]);

        return redirect()->route('penawaran.index')->with('success', 'Penawaran berhasil ditambahkan.');
    }
    

    public function edit($id)
    {
    // Ambil data penawaran berdasarkan ID
    $penawaran = Penawaran::findOrFail($id);
    
    // Ambil data customer dan user
    $customers = Customer::all();
    $users = User::all();
    
    // Kirim data ke view
    return view('penawaran.edit', compact('penawaran', 'customers', 'users'));
    }

    public function update(Request $request, $id)
{
    // Validasi data input
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'user_id' => 'required|exists:users,id',
        'status' => 'required|in:Success,On Progress',
        'tanggal' => 'required|date',
    ]);

    // Ambil data penawaran yang ingin diupdate
    $penawaran = Penawaran::findOrFail($id);

    // Update data penawaran
    $penawaran->update([
        'customer_id' => $validated['customer_id'],
        'user_id' => $validated['user_id'],
        'status' => $validated['status'],
        'tanggal' => $validated['tanggal'],
    ]);

    return redirect()->route('penawaran.index')->with('success', 'Penawaran berhasil diperbarui.');
}


    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('penawaran.index')->with('success', 'Customer berhasil diperbarui.');
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('penawaran.index')->with('success', 'Customer berhasil dihapus.');
    }
}
