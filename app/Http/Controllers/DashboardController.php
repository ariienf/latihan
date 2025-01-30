<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Penawaran;
use App\Models\Produk;
use App\Models\DetailPenawaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data pengguna dengan role 'sales'
        $users = User::all();
        
        // Ambil total users (Sales)
        $totalUsers = User::count();
        
        // Ambil data produk dengan relasi kategori
        $produks = Produk::with('kategori')->paginate(10);

        // Hitung total produk
        $totalProducts = Produk::count();
        
        // Ambil data customer
        $customers = Customer::paginate(10);

        // Ambil data penawaran dengan relasi customer dan sales 
        $penawarans = Penawaran::with('customer', 'user')->paginate(10);

        // Hitung total penawaran 
        $totalOffers = Penawaran::count();

        // Ambil data detail penawaran terkait penawaran ini
        $detailPenawarans = DetailPenawaran::paginate(10);

        // Hitung total detail penawaran
        $totalDetail = DetailPenawaran::count();

        // Ambil filter dari request
        $filter = $request->input('filter', 'today');

        // Tentukan tanggal mulai dan akhir berdasarkan filter
        switch ($filter) {
            case '7days':
                $startDate = Carbon::now()->subDays(7);
                $endDate = Carbon::now();
                break;
            case '1month':
                $startDate = Carbon::now()->subMonth();
                $endDate = Carbon::now();
                break;
            case '3months':
                $startDate = Carbon::now()->subMonths(3);
                $endDate = Carbon::now();
                break;
            case '1year':
                $startDate = Carbon::now()->subYear();
                $endDate = Carbon::now();
                break;
            case 'today':
            default:
                $startDate = Carbon::now()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
        }

        // Ambil data penawaran berdasarkan rentang tanggal
        $filteredPenawarans = Penawaran::whereBetween('tanggal', [$startDate, $endDate])->with('customer', 'user')->get();

        // Dapatkan data untuk grafik
        $penawaranData = $this->getPenawaranData($startDate, $endDate);

        // Kirim data ke view
        return view('dashboard', compact(
            'users', 
            'totalUsers', 
            'produks', 
            'totalProducts', 
            'filteredPenawarans',
            'penawarans',
            'totalOffers', 
            'customers', 
            'detailPenawarans', 
            'totalDetail', 
            'penawaranData', 
            'filter'
        ));
    }

    /**
     * Fungsi untuk mendapatkan data penawaran untuk grafik
     */
    private function getPenawaranData($startDate, $endDate)
    {
        // Logika untuk mendapatkan data penawaran untuk grafik
        return Penawaran::selectRaw('DATE(tanggal) as date, COUNT(*) as count')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->groupBy('date')
            ->pluck('count', 'date');
    }

    public function show($id)
    {
        // Ambil penawaran berdasarkan ID
        $penawaran = Penawaran::with('customer', 'user', 'detailPenawarans.produk')->findOrFail($id);

        // Hitung total subtotal
        $totalSubtotal = $penawaran->detailPenawarans->sum('subtotal');

        return view('penawaran.detail', compact('penawaran', 'totalSubtotal'));
    }
}
