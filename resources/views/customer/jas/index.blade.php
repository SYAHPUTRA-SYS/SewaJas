@extends('layouts.customer')

@section('title', 'Daftar Jas Tersedia')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h2><i class="fas fa-tshirt me-2"></i> Daftar Jas Tersedia</h2>
        <div>
            <form action="{{ route('customer.jas') }}" method="GET" class="d-flex">
                <select name="jenis" class="form-select me-2" style="width: 180px;">
                    <option value="">Semua Jenis</option>
                    <option value="toga" {{ request('jenis') == 'toga' ? 'selected' : '' }}>Toga</option>
                    <option value="jas_almamater" {{ request('jenis') == 'jas_almamater' ? 'selected' : '' }}>Jas Almamater</option>
                    <option value="kebaya" {{ request('jenis') == 'kebaya' ? 'selected' : '' }}>Kebaya</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($jas as $item)
        <div class="col-md-4 col-lg-3">
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
                <div class="mb-2">
                    <span class="badge-stock badge-available"><i class="fas fa-check-circle"></i> Tersedia</span>
                    <span class="badge bg-secondary text-white">{{ $item->stok }} pcs</span>
                </div>
                <div class="price">Rp {{ number_format($item->harga_sewa_per_hari, 0, ',', '.') }}</div>
                <small class="text-muted">/ hari</small>
                <a href="{{ route('customer.jas.show', $item->id) }}" class="btn btn-primary w-100 mt-3">
                    <i class="fas fa-shopping-cart"></i> Sewa
                </a>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-4">
            <i class="fas fa-tshirt fa-3x text-muted mb-3 d-block"></i>
            <h5>Belum ada jas tersedia</h5>
            <p class="text-muted">Silakan cek kembali nanti</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $jas->links() }}
    </div>
</div>
@endsection
