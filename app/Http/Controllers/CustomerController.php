<?php

namespace App\Http\Controllers;

use App\Models\Jas;
use App\Models\Pelanggan;
use App\Models\PemesananJas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Route;
class CustomerController extends Controller
{
    /**
     * Halaman Homepage Customer
     * Route: GET /customer
     */
    public function home()
    {
        $jas = Jas::where('is_available', true)
                    ->where('stok', '>', 0)
                    ->orderBy('jenis')
                    ->take(4)
                    ->get();

        return view('customer.home', compact('jas'));
    }

    /**
     * Halaman Daftar Jas Customer
     * Route: GET /customer/jas
     */
    public function jasIndex(Request $request)
    {
        $query = Jas::where('is_available', true)->where('stok', '>', 0);

        // Filter berdasarkan jenis
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis', $request->jenis);
        }

        $jas = $query->orderBy('jenis')->orderBy('ukuran')->paginate(12);

        return view('customer.jas.index', compact('jas'));
    }

    /**
     * Halaman Detail Jas Customer
     * Route: GET /customer/jas/{id}
     */
    public function jasShow($id)
    {
        $jas = Jas::findOrFail($id);
        return view('customer.jas.show', compact('jas'));
    }

    /**
     * Halaman Form Booking Customer
     * Route: GET /customer/booking/create?jas_id={id}
     */
    public function bookingCreate(Request $request)
    {
        $jas_id = $request->jas_id;

        if (!$jas_id) {
            return redirect()->route('customer.jas')
                    ->with('error', 'Silakan pilih jas terlebih dahulu!');
        }

        $jas = Jas::findOrFail($jas_id);

        // Cek stok
        if ($jas->stok <= 0 || !$jas->is_available) {
            return redirect()->route('customer.jas')
                    ->with('error', 'Jas tidak tersedia!');
        }

        return view('customer.booking.create', compact('jas'));
    }

    /**
     * Proses Booking Customer
     * Route: POST /customer/booking/store
     */
    public function bookingStore(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jas_id' => 'required|exists:jas,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'tanggal_sidang' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'no_hp.required' => 'No. HP wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'jurusan.required' => 'Jurusan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'tanggal_sewa.required' => 'Tanggal sewa wajib diisi',
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi',
            'tanggal_kembali.after' => 'Tanggal kembali harus setelah tanggal sewa',
            'tanggal_sidang.required' => 'Tanggal sidang wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
        ]);

        // Cek atau buat pelanggan baru
        $pelanggan = Pelanggan::where('nim', $request->nim)->first();

        if (!$pelanggan) {
            // Jika belum ada, buat data pelanggan baru
            $pelanggan = Pelanggan::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
                'alamat' => $request->alamat,
            ]);
        } else {
            // Update data jika sudah ada
            $pelanggan->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
                'alamat' => $request->alamat,
            ]);
        }

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
        $pemesanan = PemesananJas::create([
            'pelanggan_id' => $pelanggan->id,
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

        return redirect()->route('customer.booking.selesai', $pemesanan->id)
                ->with('success', 'Booking berhasil!');
    }

    /**
     * Halaman Booking Selesai
     * Route: GET /customer/booking/selesai/{id}
     */
    public function bookingSelesai($id)
    {
        $pemesanan = PemesananJas::with(['pelanggan', 'jas'])->findOrFail($id);
        return view('customer.booking.selesai', compact('pemesanan'));
    }

    /**
     * Halaman Cek Status Booking
     * Route: GET /customer/cek-status
     */
    public function bookingCek()
    {
        return view('customer.booking.cek');
    }

    /**
     * Proses Cek Status Booking
     * Route: POST /customer/cek-status
     */
    public function bookingCekPost(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
        ], [
            'kode.required' => 'Masukkan NIM atau ID Pemesanan',
        ]);

        // Cari berdasarkan NIM atau ID pemesanan
        $pemesanan = PemesananJas::with(['pelanggan', 'jas'])
                        ->where('id', $request->kode)
                        ->orWhereHas('pelanggan', function($query) use ($request) {
                            $query->where('nim', $request->kode);
                        })
                        ->orderBy('created_at', 'desc')
                        ->first();

        if (!$pemesanan) {
            return redirect()->back()
                    ->with('error', 'Data pemesanan tidak ditemukan!')
                    ->withInput();
        }

        return view('customer.booking.hasil', compact('pemesanan'));
    }

        /**
     * Menampilkan Invoice Customer (HTML)
     * Route: GET /customer/invoice/{id}
     */
    public function invoice($id)
    {
        $pemesanan = PemesananJas::with(['pelanggan', 'jas'])->findOrFail($id);
        return view('customer.booking.invoice', compact('pemesanan'));
    }

    /**
     * Download Invoice Customer sebagai PDF
     * Route: GET /customer/invoice-pdf/{id}
     */
    public function invoicePDF($id)
    {
        $pemesanan = PemesananJas::with(['pelanggan', 'jas'])->findOrFail($id);

        $pdf = Pdf::loadView('customer.booking.invoice-pdf', compact('pemesanan'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('invoice-' . $pemesanan->id . '.pdf');
    }

     /**
     * Generate QR Code untuk invoice customer
     * Route: GET /customer/qr/{id}
     */
    public function generateQR($id)
    {
        $pemesanan = PemesananJas::findOrFail($id);

        // URL verifikasi CUSTOMER
        $url = route('customer.verify', $pemesanan->kode_verifikasi);

        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)
                    ->format('svg')
                    ->generate($url);

        return response($qrCode)
                ->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Halaman Verifikasi Invoice (Customer)
     * Route: GET /customer/verify/{kode}
     */
    public function verify($kode)
    {
        $pemesanan = PemesananJas::with(['pelanggan', 'jas'])
                        ->where('kode_verifikasi', $kode)
                        ->first();

        if (!$pemesanan) {
            return view('customer.booking.verify-invalid');
        }

        return view('customer.booking.verify-valid', compact('pemesanan'));
    }
}

