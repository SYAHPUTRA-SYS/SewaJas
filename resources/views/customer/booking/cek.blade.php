@extends('layouts.customer')

@section('title', 'Cek Status Booking')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0"><i class="fas fa-search"></i> Cek Status Booking</h4>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted text-center mb-4">
                        Masukkan <strong>NIM</strong> atau <strong>ID Pemesanan</strong> untuk mengecek status booking Anda.
                    </p>

                    <form action="{{ route('customer.booking.cek.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">NIM atau ID Pemesanan</label>
                            <input type="text" name="kode" class="form-control form-control-lg @error('kode') is-invalid @enderror"
                                   placeholder="Contoh: 202201001 atau 1" value="{{ old('kode') }}" required>
                            @error('kode') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search"></i> Cek Status
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="text-muted small mb-0">Belum melakukan booking?</p>
                        <a href="{{ route('customer.jas') }}" class="btn btn-outline-primary mt-2">
                            <i class="fas fa-tshirt"></i> Lihat Daftar Jas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
