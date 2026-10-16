<?php
use App\Models\Jas;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JasController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $jas = Jas::all();
    return view('customer.home', compact('jas'));

});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Pelanggan
    Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
    Route::get('pelanggan/create', [PelangganController::class, 'create'])->name('createPelanggan');
    Route::post('pelanggan/store', [PelangganController::class, 'store'])->name('storePelanggan');
    Route::get('pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('pelangganEdit');
    Route::put('pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelangganUpdate');
    Route::get('pelanggan/show/{id}', [PelangganController::class, 'show'])->name('pelangganShow');
    Route::get('pelanggan/destroy/{id}', [PelangganController::class, 'destroy'])->name('pelangganDestroy');

    // Route Data Jas
    Route::get('jas', [JasController::class, 'index'])->name('jas');
    Route::get('jas/show/{id}', [JasController::class, 'show'])->name('jasShow');
    Route::get('jas/create', [JasController::class, 'create'])->name('createJas');
    Route::post('jas/store', [JasController::class, 'store'])->name('storeJas');
    Route::get('jas/edit/{id}', [JasController::class, 'edit'])->name('editJas');
    Route::put('jas/update/{id}', [JasController::class, 'update'])->name('updateJas');
    Route::delete('jas/delete/{id}', [JasController::class, 'destroy'])->name('destroyJas');

    // Route Pemesanan
    Route::get('pemesanan', [PemesananController::class, 'index'])->name('pemesanan');
    Route::get('pemesanan/create', [PemesananController::class, 'create'])->name('pesanCreate');
    Route::post('pemesanan/store', [PemesananController::class, 'store'])->name('pesananStore');
    Route::get('pemesanan/edit/{id}', [PemesananController::class, 'edit'])->name('pesananEdit');
    Route::put('pemesanan/update/{id}', [PemesananController::class, 'update'])->name('pesananUpdate');
    Route::get('pemesanan/show/{id}', [PemesananController::class, 'show'])->name('pesananShow');
    Route::delete('pemesanan/delete/{id}', [PemesananController::class, 'destroy'])->name('pesananDestroy');
    Route::get('pemesanan/invoice/{id}', [PemesananController::class, 'invoice'])->name('pemesanan.invoice');
    Route::get('pemesanan/invoice-pdf/{id}', [PemesananController::class, 'invoicePDF'])->name('pemesanan.invoice.pdf');
    // QR Code & Verifikasi
    Route::get('pemesanan/qr/{id}', [PemesananController::class, 'generateQR'])->name('pemesanan.qr');
    Route::get('pemesanan/verify/{kode}', [PemesananController::class, 'verify'])->name('pemesanan.verify');
    Route::post('pemesanan/konfirmasi/{id}', [PemesananController::class, 'konfirmasiAmbil'])->name('pemesanan.konfirmasi');
});

// ROUTE CUSTOMER
Route::prefix('customer')->name('customer.')->group(function () {
    // Homepage
    Route::get('/', [CustomerController::class, 'home'])->name('home');

    // Daftar Jas
    Route::get('/jas', [CustomerController::class, 'jasIndex'])->name('jas');
    Route::get('/jas/{id}', [CustomerController::class, 'jasShow'])->name('jas.show');

    // Booking
    Route::get('/booking/create', [CustomerController::class, 'bookingCreate'])->name('booking.create');
    Route::post('/booking/store', [CustomerController::class, 'bookingStore'])->name('booking.store');
    Route::get('/booking/selesai/{id}', [CustomerController::class, 'bookingSelesai'])->name('booking.selesai');

    // Cek Status
    Route::get('/cek-status', [CustomerController::class, 'bookingCek'])->name('booking.cek');
    Route::post('/cek-status', [CustomerController::class, 'bookingCekPost'])->name('booking.cek.post');

    // Invoice
    Route::get('/invoice/{id}', [CustomerController::class, 'invoice'])->name('invoice');
    Route::get('/invoice-pdf/{id}', [CustomerController::class, 'invoicePDF'])->name('invoice.pdf');

    // Invoice menggunakan QR
    Route::get('/qr/{id}', [CustomerController::class, 'generateQR'])->name('qr');
    Route::get('/verify/{kode}', [CustomerController::class, 'verify'])->name('verify');
});
