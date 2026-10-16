<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PaginatesData;
use App\Models\Pelanggan;
use App\Models\Jas;
use Carbon\Carbon;
use App\Models\PemesananJas;
use Barryvdh\DomPDF\Facade\Pdf;
// use App\Models\Pemesananjas;
class PemesananController extends Controller
{
    use PaginatesData;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pemesanans = $this->paginateData(
            Pemesananjas::with('pelanggan', 'jas')->orderby('created_at', 'desc'),
            $request,
            ['pelanggan_id', 'jas_id'],
            10
        );
        $data = array(
            "title"              => "Pemesanan",
            "menuAdminPemesanan" => "active",
            "pemesanans"         => $pemesanans,
            "search"             => $request->input('search')
        );

        return view('pemesanan/index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array(
            "title"                 => "Tambah Pesanan",
            "menuAdminPemesanan"    => "active",
            "pelanggan"             => Pelanggan::orderBy('nama')->get(),
            "jas"                   => Jas::where('is_available', true)->where('stok', '>', '0')->get(),
        );

        return view('pemesanan/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'jas_id' => 'required|exists:jas,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'tanggal_sidang' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ],[
            'pelanggan_id.required' => 'Pelanggan wajib dipilih',
            'pelanggan_id.exists' => 'Pelanggan tidak valid',
            'jas_id.required' => 'Jas wajib dipilih',
            'jas_id.exists' => 'Jas tidak valid',
            'tanggal_sewa.required' => 'Tanggal sewa wajib diisi',
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi',
            'tanggal_kembali.after' => 'Tanggal kembali harus setelah tanggal sewa',
            'tanggal_sidang.required' => 'Tanggal sidang wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.min' => 'Jumlah minimal 1',
        ]);

        // Ambil data jas
        $jas = Jas::findOrFail($request->jas_id);

        // Cek stok
        if ($jas->stok < $request->jumlah) {
            return redirect()->back()
                    ->with('error', 'Stok jas tidak mencukupi! Stok tersedia: ' . $jas->stok)
                    ->withInput();
        }

       // Hitung durasi sewa
        $start = Carbon::parse($request->tanggal_sewa);
        $end = Carbon::parse($request->tanggal_kembali);
        $durasi = $start->diffInDays($end);

        // Hitung total harga
        $total_harga = $jas->harga_sewa_per_hari * $durasi * $request->jumlah;


        // Simpan pemesanan
        PemesananJas::create([
            'pelanggan_id' => $request->pelanggan_id,
            'jas_id' => $request->jas_id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'tanggal_sidang' => $request->tanggal_sidang,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'denda' => 0,
            'status' => 'booking',
            'pembayaran' => 'belum_bayar',
            'catatan' => $request->catatan,
        ]);

        // Kurangi stok jas
        $jas->decrement('stok', $request->jumlah);

        return redirect()->route('pemesanan')
                ->with('success', 'Pemesanan berhasil ditambahkan!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = array(
            "title"     => "Detail Pesanan",
            "menuAdminPemesanan"  => "active",
            "pemesanan" => PemesananJas::with('pelanggan', 'jas')->findOrFail($id),
        );

        return view('pemesanan/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = array(
            "title"                 => "Edit Pesanan",
            "menuAdminPemesanan"    => "active",
            "pemesanan"             => PemesananJas::findOrFail($id),
            "pelanggans"             => Pelanggan::orderBy('nama')->get(),
            "jas"                   => Jas::all(),
        );

        return view('pemesanan/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pemesanan = PemesananJas::findOrFail($id);

        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'jas_id' => 'required|exists:jas,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'tanggal_sidang' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:booking,diambil,kembali,batal',
            'pembayaran' => 'required|in:belum_bayar,dp,lunas',
            'catatan' => 'nullable|string',
        ], [
            'pelanggan_id.required' => 'Pelanggan wajib dipilih',
            'jas_id.required' => 'Jas wajib dipilih',
            'tanggal_sewa.required' => 'Tanggal sewa wajib diisi',
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi',
            'tanggal_kembali.after' => 'Tanggal kembali harus setelah tanggal sewa',
            'tanggal_sidang.required' => 'Tanggal sidang wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'status.required' => 'Status wajib dipilih',
            'pembayaran.required' => 'Pembayaran wajib dipilih',
        ]);

         // Ambil data jas
        $jas = Jas::findOrFail($request->jas_id);

        // Hitung durasi sewa
        $start = Carbon::parse($request->tanggal_sewa);
        $end = Carbon::parse($request->tanggal_kembali);
        $durasi = $start->diffInDays($end);

         // Hitung total harga
        $total_harga = $jas->harga_sewa_per_hari * $durasi * $request->jumlah;

        // Hitung denda jika status 'kembali' dan terlambat
        $denda = 0;
        if ($request->status == 'kembali' && Carbon::parse($request->tanggal_kembali) < now()) {
            $hari_terlambat = now()->diffInDays(Carbon::parse($request->tanggal_kembali));
            $denda = $hari_terlambat * $jas->denda_terlambat * $request->jumlah;
        }

        // Handle stok jika jumlah berubah
        $selisih = $request->jumlah - $pemesanan->jumlah;
        if ($selisih > 0) {
            // Jika jumlah bertambah, kurangi stok
            if ($jas->stok < $selisih) {
                return redirect()->back()
                        ->with('error', 'Stok jas tidak mencukupi!')
                        ->withInput();
            }
            $jas->decrement('stok', $selisih);
        } elseif ($selisih < 0) {
            // Jika jumlah berkurang, kembalikan stok
            $jas->increment('stok', abs($selisih));
        }

        // Update pemesanan
        $pemesanan->update([
            'pelanggan_id' => $request->pelanggan_id,
            'jas_id' => $request->jas_id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'tanggal_sidang' => $request->tanggal_sidang,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'denda' => $denda,
            'status' => $request->status,
            'pembayaran' => $request->pembayaran,
            'catatan' => $request->catatan,
        ]);

         return redirect()->route('pemesanan')
                ->with('success', 'Pemesanan berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemesanan = PemesananJas::findOrFail($id);

        // Kembalikan stok jas
        $jas = Jas::find($pemesanan->jas_id);
        if ($jas) {
            $jas->increment('stok', $pemesanan->jumlah);
        }

        $pemesanan->delete();

        return redirect()->route('pemesanan')
                ->with('success', 'Pemesanan berhasil dihapus!');
    }

        /**
     * Menampilkan Invoice (HTML)
     * Route: GET /pemesanan/invoice/{id}
     */
    public function invoice($id)
    {
        $pemesanan = PemesananJas::with(['pelanggan', 'jas'])->findOrFail($id);
        return view('pemesanan.invoice', compact('pemesanan'));
    }

    /**
     * Download Invoice sebagai PDF
     * Route: GET /pemesanan/invoice-pdf/{id}
     */
    public function invoicePDF($id)
    {
        $pemesanan = PemesananJas::with(['pelanggan', 'jas'])->findOrFail($id);

        $pdf = Pdf::loadView('pemesanan.invoice-pdf', compact('pemesanan'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('invoice-' . $pemesanan->id . '.pdf');
    }

        /**
     * Generate QR Code untuk invoice
     * Route: GET /pemesanan/qr/{id}
     */
    public function generateQR($id)
    {
        $pemesanan = PemesananJas::findOrFail($id);

        // URL untuk verifikasi
        $url = route('pemesanan.verify', $pemesanan->kode_verifikasi);

        // Generate QR Code
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)
                    ->format('svg')
                    ->generate($url);

        return response($qrCode)
                ->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Halaman Verifikasi Invoice
     * Route: GET /verify/{kode}
     */
    public function verify($kode)
    {
        $pemesanan = PemesananJas::with(['pelanggan', 'jas'])
                        ->where('kode_verifikasi', $kode)
                        ->first();

        if (!$pemesanan) {
            return view('pemesanan.verify-invalid');
        }

        return view('pemesanan.verify-valid', compact('pemesanan'));
    }

    /**
     * Konfirmasi Pengambilan Jas
     * Route: POST /pemesanan/konfirmasi/{id}
     */
    public function konfirmasiAmbil($id)
    {
        $pemesanan = PemesananJas::findOrFail($id);

        $pemesanan->update([
            'status' => 'diambil',
            'pembayaran' => 'lunas',
        ]);

        return redirect()->route('pemesanan.verify', $pemesanan->kode_verifikasi)
                ->with('success', 'Jas berhasil diserahkan!');
    }
}
