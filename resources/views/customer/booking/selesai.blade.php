@extends('layouts.customer')

@section('title', 'Booking Berhasil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 6rem;"></i>
                    </div>
                    <h3>Booking Berhasil!</h3>
                    <p class="text-muted">Terima kasih, <strong>{{ $pemesanan->pelanggan->nama }}</strong>!</p>
                    <p class="text-muted">Pemesanan jas Anda telah berhasil dilakukan.</p>

                    <div class="alert alert-info text-start mt-4">
                        <h6 class="mb-3"><i class="fas fa-info-circle"></i> Informasi Pemesanan</h6>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <small class="text-muted">ID Pemesanan</small>
                                <p class="mb-0"><strong>#{{ $pemesanan->id }}</strong></p>
                            </div>
                            <div class="col-6 mb-2">
                                <small class="text-muted">Status</small>
                                <p class="mb-0">
                                    <span class="badge bg-warning">Booking</span>
                                </p>
                            </div>
                            <div class="col-6 mb-2">
                                <small class="text-muted">Jas</small>
                                <p class="mb-0"><strong>{{ $pemesanan->jas->jenis_label }} - {{ $pemesanan->jas->ukuran }}</strong></p>
                            </div>
                            <div class="col-6 mb-2">
                                <small class="text-muted">Jumlah</small>
                                <p class="mb-0">{{ $pemesanan->jumlah }} pcs</p>
                            </div>
                            <div class="col-6 mb-2">
                                <small class="text-muted">Tanggal Sewa</small>
                                <p class="mb-0">{{ date('d/m/Y', strtotime($pemesanan->tanggal_sewa)) }}</p>
                            </div>
                            <div class="col-6 mb-2">
                                <small class="text-muted">Tanggal Kembali</small>
                                <p class="mb-0">{{ date('d/m/Y', strtotime($pemesanan->tanggal_kembali)) }}</p>
                            </div>
                            <div class="col-6 mb-2">
                                <small class="text-muted">Tanggal Sidang</small>
                                <p class="mb-0">{{ date('d/m/Y', strtotime($pemesanan->tanggal_sidang)) }}</p>
                            </div>
                            <div class="col-6 mb-2">
                                <small class="text-muted">Total Harga</small>
                                <p class="mb-0"><strong class="text-success">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Penting!</strong> Simpan ID Pemesanan <strong>#{{ $pemesanan->id }}</strong> untuk mengecek status.
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('customer.invoice', $pemesanan->id) }}"
                        class="btn btn-primary" target="_blank">
                            <i class="fas fa-receipt"></i> Lihat Invoice
                        </a>
                        <a href="{{ route('customer.invoice.pdf', $pemesanan->id) }}"
                        class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                        <a href="{{ route('customer.home') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> Kembali ke Beranda
                        </a>
                        <a href="{{ route('customer.booking.cek') }}" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i> Cek Status
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
