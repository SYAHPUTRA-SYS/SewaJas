@extends('layouts.customer')

@section('title', 'Detail Jas')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card p-3 text-center d-flex align-items-center justify-content-center"
                 style="height: 400px; background: #f9fafb; overflow: hidden;">
                @if($jas->jenis == 'toga')
                    <img src="{{ asset('images/toga.jpg') }}"
                         alt="toga"
                         class="img-fluid"
                         style="max-height: 350px; max-width: 100%; object-fit: contain;">
                @elseif($jas->jenis == 'jas_almamater')
                    <img src="{{ asset('images/jaspria.jpg') }}"
                         alt="jas"
                         class="img-fluid"
                         style="max-height: 350px; max-width: 100%; object-fit: contain;">
                @else
                    <img src="{{ asset('images/kebaya.jpg') }}"
                         alt="kebaya"
                         class="img-fluid"
                         style="max-height: 350px; max-width: 100%; object-fit: contain;">
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <h2>{{ $jas->jenis_label }}</h2>
            <p class="text-muted">Kode: {{ $jas->kode_jas }}</p>

            <div class="row mt-4">
                <div class="col-6 mb-3">
                    <h6 class="text-muted">Ukuran</h6>
                    <p class="fs-5"><strong>{{ $jas->ukuran }}</strong></p>
                </div>
                <div class="col-6 mb-3">
                    <h6 class="text-muted">Stok</h6>
                    <p>
                        <span class="badge bg-{{ $jas->stok > 0 ? 'success' : 'danger' }} fs-6">
                            {{ $jas->stok > 0 ? $jas->stok . ' pcs tersedia' : 'Habis' }}
                        </span>
                    </p>
                </div>
                <div class="col-6 mb-3">
                    <h6 class="text-muted">Harga Sewa/Hari</h6>
                    <p class="fs-5"><strong>Rp {{ number_format($jas->harga_sewa_per_hari, 0, ',', '.') }}</strong></p>
                </div>
                <div class="col-6 mb-3">
                    <h6 class="text-muted">Denda Terlambat/Hari</h6>
                    <p class="fs-5">Rp {{ number_format($jas->denda_terlambat, 0, ',', '.') }}</p>
                </div>
            </div>

            @if($jas->keterangan)
                <div class="mt-3">
                    <h6 class="text-muted">Keterangan</h6>
                    <p>{{ $jas->keterangan }}</p>
                </div>
            @endif

            @if($jas->stok > 0 && $jas->is_available)
                <a href="{{ route('customer.booking.create', ['jas_id' => $jas->id]) }}"
                   class="btn btn-primary btn-lg w-100 mt-4">
                    <i class="fas fa-shopping-cart"></i> Booking Sekarang
                </a>
            @else
                <button class="btn btn-secondary btn-lg w-100 mt-4" disabled>
                    <i class="fas fa-times-circle"></i> Tidak Tersedia
                </button>
            @endif

            <a href="{{ route('customer.jas') }}" class="btn btn-outline-secondary w-100 mt-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Jas
            </a>
        </div>
    </div>
</div>
@endsection
