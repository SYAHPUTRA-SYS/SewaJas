@extends('layouts.customer')

@section('title', 'Status Booking')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Status Pemesanan #{{ $pemesanan->id }}</h5>
                </div>
                <div class="card-body">
                    <!-- Status Icon -->
                    <div class="text-center mb-4">
                        @if($pemesanan->status == 'booking')
                            <i class="fas fa-clock text-warning" style="font-size: 5rem;"></i>
                            <h4 class="text-warning mt-2">Menunggu Konfirmasi</h4>
                            <p class="text-muted">Silakan ambil jas sesuai tanggal yang ditentukan</p>
                        @elseif($pemesanan->status == 'diambil')
                            <i class="fas fa-check-circle text-info" style="font-size: 5rem;"></i>
                            <h4 class="text-info mt-2">Jas Sudah Diambil</h4>
                            <p class="text-muted">Jangan lupa kembalikan tepat waktu</p>
                        @elseif($pemesanan->status == 'kembali')
                            <i class="fas fa-check-double text-success" style="font-size: 5rem;"></i>
                            <h4 class="text-success mt-2">Jas Sudah Dikembalikan</h4>
                            <p class="text-muted">Terima kasih telah menggunakan layanan kami</p>
                        @else
                            <i class="fas fa-times-circle text-danger" style="font-size: 5rem;"></i>
                            <h4 class="text-danger mt-2">Booking Dibatalkan</h4>
                            <p class="text-muted">Hubungi admin untuk informasi lebih lanjut</p>
                        @endif
                    </div>

                    <!-- Detail -->
                    <div class="alert alert-light border">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">ID Pemesanan</small>
                                <p class="mb-0"><strong>#{{ $pemesanan->id }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Status</small>
                                <p class="mb-0">
                                    @php
                                        $statusColors = [
                                            'booking' => 'warning',
                                            'diambil' => 'info',
                                            'kembali' => 'success',
                                            'batal' => 'danger'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$pemesanan->status] ?? 'secondary' }}">
                                        {{ ucfirst($pemesanan->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Nama</small>
                                <p class="mb-0"><strong>{{ $pemesanan->pelanggan->nama }}</strong></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">NIM</small>
                                <p class="mb-0">{{ $pemesanan->pelanggan->nim }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Jas</small>
                                <p class="mb-0">{{ $pemesanan->jas->jenis_label }} - {{ $pemesanan->jas->ukuran }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Jumlah</small>
                                <p class="mb-0">{{ $pemesanan->jumlah }} pcs</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Tanggal Sewa</small>
                                <p class="mb-0">{{ date('d/m/Y', strtotime($pemesanan->tanggal_sewa)) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Tanggal Kembali</small>
                                <p class="mb-0">{{ date('d/m/Y', strtotime($pemesanan->tanggal_kembali)) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Tanggal Sidang</small>
                                <p class="mb-0">{{ date('d/m/Y', strtotime($pemesanan->tanggal_sidang)) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Pembayaran</small>
                                <p class="mb-0">
                                    @php
                                        $pembayaranColors = [
                                            'belum_bayar' => 'danger',
                                            'dp' => 'warning',
                                            'lunas' => 'success'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $pembayaranColors[$pemesanan->pembayaran] ?? 'secondary' }}">
                                        {{ ucfirst(str_replace('_', ' ', $pemesanan->pembayaran)) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Total Harga</small>
                                <p class="mb-0"><strong class="text-success">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong></p>
                            </div>
                            @if($pemesanan->denda > 0)
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Denda</small>
                                <p class="mb-0"><strong class="text-danger">Rp {{ number_format($pemesanan->denda, 0, ',', '.') }}</strong></p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('customer.invoice', $pemesanan->id) }}"
                        class="btn btn-primary" target="_blank">
                            <i class="fas fa-receipt"></i> Lihat Invoice
                        </a>
                        <a href="{{ route('customer.invoice.pdf', $pemesanan->id) }}"
                        class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                        <a href="{{ route('customer.booking.cek') }}" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cek Lagi
                        </a>
                        <a href="{{ route('customer.home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
