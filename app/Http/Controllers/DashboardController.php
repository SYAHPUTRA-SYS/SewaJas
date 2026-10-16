<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Jas;
use App\Models\PemesananJas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        // 1. Total Mahasiswa
        $totalMahasiswa = Pelanggan::count();

        // 2. Total Jas
        $totalJas = Jas::count();

        // 3. Pemesanan Aktif (status: booking atau diambil)
        $pemesananAktif = PemesananJas::whereIn('status', ['booking', 'diambil'])->count();

        // 4. Total Pendapatan (dari pemesanan yang lunas)
        $totalPendapatan = PemesananJas::where('pembayaran', 'lunas')
                            ->sum('total_harga');

        // ========== GRAFIK PEMESANAN PER BULAN ==========

        // Ambil data 6 bulan terakhir
        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $chartLabels[] = $bulan->translatedFormat('M Y');

            $count = PemesananJas::whereYear('created_at', $bulan->year)
                        ->whereMonth('created_at', $bulan->month)
                        ->count();

            $chartData[] = $count;
        }

        // ========== PEMESANAN TERBARU ==========
        $pemesananTerbaru = PemesananJas::with(['pelanggan', 'jas'])
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // ========== STOK JAS MENIPIS ==========
        $stokMenipis = Jas::where('stok', '<=', 5)
                        ->where('stok', '>', 0)
                        ->orderBy('stok', 'asc')
                        ->get();

        // ========== JAS HABIS ==========
        $jasHabis = Jas::where('stok', 0)->get();

        // ========== STATISTIK PEMBAYARAN ==========
        $belumBayar = PemesananJas::where('pembayaran', 'belum_bayar')->count();
        $dp = PemesananJas::where('pembayaran', 'dp')->count();
        $lunas = PemesananJas::where('pembayaran', 'lunas')->count();

        // ========== PENDAPATAN BULAN INI ==========
        $pendapatanBulanIni = PemesananJas::where('pembayaran', 'lunas')
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->sum('total_harga');

        return view('dashboard', compact(
            'title',
            'totalMahasiswa',
            'totalJas',
            'pemesananAktif',
            'totalPendapatan',
            'chartLabels',
            'chartData',
            'pemesananTerbaru',
            'stokMenipis',
            'jasHabis',
            'belumBayar',
            'dp',
            'lunas',
            'pendapatanBulanIni'
        ));
    }
}
