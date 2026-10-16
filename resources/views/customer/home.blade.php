@extends('layouts.customer')

@section('title', 'Sewa Jas Sidang Akhir')

@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1>Sewa Jas untuk Sidang Akhir</h1>
                <p>Persiapan sidang akhir Anda dengan jas berkualitas.</p>
                <a href="{{ route('customer.jas') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-tshirt"></i> Lihat Jas
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-graduation-cap" style="font-size: 15rem; opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Jas Tersedia</h2>
        <div class="row g-4">
            @forelse($jas as $item)
            <div class="col-md-3">
                <div class="product-card">
                    @if($item->jenis == 'jas_almamater')
                        <img width="150" height="200" src="{{ asset('images/jaspria.jpg') }}" alt="jas">
                    @elseif($item->jenis == 'toga')
                        <img width="150" height="200" src="{{ asset('images/toga.jpg') }}" alt="toga">
                    @else
                        <img width="100" height="200" src="{{ asset('images/kebaya.jpg') }}" alt="kebaya">
                    @endif
                    <h5 class="mt-3">{{ $item->jenis_label }}</h5>
                    <p class="text-muted small">Ukuran {{ $item->ukuran }}</p>
                    <div class="price">Rp {{ number_format($item->harga_sewa_per_hari, 0, ',', '.') }}</div>
                    <small class="text-muted">/ hari</small>
                    <a href="{{ route('customer.jas.show', $item->id) }}" class="btn btn-primary w-100 mt-3">
                        <i class="fas fa-shopping-cart"></i> Sewa
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <h5>Belum ada jas tersedia</h5>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
