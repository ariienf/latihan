<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penawaran;
use App\Models\DetailPenawaran;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Mencari di model Produk
        $produkResults = Produk::where('nama', 'LIKE', "%{$query}%")->get();

        // Mencari di model Penawaran
        $penawaranResults = Penawaran::where('customer_id', 'LIKE', "%{$query}%")->get();

        // Mencari di model DetailPenawaran
        $detailPenawaranResults = DetailPenawaran::where('penawaran_id', 'LIKE', "%{$query}%")->get();

        // Menggabungkan semua hasil pencarian
        $results = collect([
            'produk' => $produkResults,
            'penawaran' => $penawaranResults,
            'detail_penawaran' => $detailPenawaranResults,
        ]);

        return view('search.result', compact('results', 'query'));
    }
}
