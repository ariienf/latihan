<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use App\Models\Produk;
use App\Models\DetailPenawaran;
use Illuminate\Http\Request;

class DetailPenawaranController extends Controller
{
    public function create()
    {
    // Ambil daftar penawaran dan produk yang tersedia
    $penawarans = Penawaran::all(); // Ambil semua penawaran
    $produks = Produk::all(); // Ambil semua produk

    return view('detail_penawaran.create', compact('penawarans', 'produks'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'penawaran_id' => 'required|exists:penawarans,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);
    
        // Ambil data penawaran dan produk
        $penawaran = Penawaran::findOrFail($request->penawaran_id);
        $produk = Produk::findOrFail($request->produk_id);
    
        // Hitung subtotal
        $subtotal = $produk->harga * $request->jumlah;
    
        // Buat detail penawaran baru
        $detailPenawaran = DetailPenawaran::create([
            'penawaran_id' => $penawaran->id,
            'produk_id' => $produk->id,
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
        ]);
    
        // Kurangi stok produk
        $produk->stok -= $request->jumlah;
        $produk->save();
    
        return redirect()->route('detail_penawaran.index', $penawaran->id)->with('success', 'Detail penawaran berhasil ditambahkan');
    }

    // Menampilkan daftar detail penawaran pada penawaran tertentu
    public function index()
    {   
        // Ambil data detail penawaran terkait penawaran ini
        $detailPenawarans = DetailPenawaran::paginate(10);
        $totalDetail = DetailPenawaran::count();

        return view('detail_penawaran.index', compact('detailPenawarans', 'totalDetail'));
    }

    public function edit($id)
    {
    // Ambil data detail penawaran berdasarkan id
    $detailPenawaran = DetailPenawaran::findOrFail($id);
    $penawarans = Penawaran::all(); // Ambil semua penawaran
    $produks = Produk::all(); // Ambil semua produk

    return view('detail_penawaran.edit', compact('detailPenawaran', 'penawarans', 'produks'));
    }

    public function update(Request $request, $id)
    {
    // Validasi input
    $validated = $request->validate([
        'penawaran_id' => 'required|exists:penawarans,id',
        'produk_id' => 'required|exists:produks,id',
        'jumlah' => 'required|integer|min:1',
    ]);

    // Ambil data detail penawaran, penawaran dan produk
    $detailPenawaran = DetailPenawaran::findOrFail($id);
    $penawaran = Penawaran::findOrFail($request->penawaran_id);
    $produk = Produk::findOrFail($request->produk_id);

    // Hitung subtotal
    $subtotal = $produk->harga * $request->jumlah;

    // Update data detail penawaran
    $detailPenawaran->update([
        'penawaran_id' => $penawaran->id,
        'produk_id' => $produk->id,
        'jumlah' => $request->jumlah,
        'subtotal' => $subtotal,
    ]);

    // Kurangi atau tambahkan stok produk sesuai dengan perubahan jumlah
    // Karena kita hanya mengupdate detail, maka pastikan stok produk dikembalikan jika diperlukan
    $produk->stok -= $request->jumlah - $detailPenawaran->jumlah;
    $produk->save();

    return redirect()->route('detail_penawaran.index', $penawaran->id)->with('success', 'Detail penawaran berhasil diperbarui');
    }

    public function destroy($id)
    {
    $detailPenawaran = DetailPenawaran::findOrFail($id);
    $produk = $detailPenawaran->produk;

    // Tambahkan stok produk kembali
    $produk->stok += $detailPenawaran->jumlah;
    $produk->save();

    $detailPenawaran->delete();

    return redirect()->route('detail_penawaran.index')->with('success', 'Detail penawaran berhasil dihapus');
    }

}
