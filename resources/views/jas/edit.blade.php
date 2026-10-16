@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-pencil" aria-hidden="true"></i></span>
        <div>
            <h1 class="h3 mb-1">{{ $title ?? 'Edit Data Jas' }}</h1>
        </div>
    </div>
</div>

<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-pencil" aria-hidden="true"></i>
                <span>Form Edit Data Jas</span>
            </h2>
        </div>
        <a href="{{ route('jas') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left-circle" aria-hidden="true"></i> Kembali
        </a>
    </div>

    <form action="{{ route('updateJas', $jas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="kode_jas" class="mb-1">Kode Jas <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('kode_jas') is-invalid @enderror"
                       id="kode_jas"
                       name="kode_jas"
                       value="{{ old('kode_jas', $jas->kode_jas) }}"
                       placeholder="Contoh : TOGA-S-001">
                @error('kode_jas')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="jenis" class="mb-1">Jenis Jas <span class="text-danger">*</span></label>
                <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror">
                    <option value="" disabled>Pilih Jenis Jas</option>
                    <option value="toga" {{ old('jenis', $jas->jenis) == 'toga' ? 'selected' : '' }}>Toga</option>
                    <option value="jas_almamater" {{ old('jenis', $jas->jenis) == 'jas_almamater' ? 'selected' : '' }}>Jas Almamater</option>
                    <option value="kebaya" {{ old('jenis', $jas->jenis) == 'kebaya' ? 'selected' : '' }}>Kebaya</option>
                </select>
                @error('jenis')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="ukuran" class="mb-1">Ukuran Jas <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('ukuran') is-invalid @enderror"
                       id="ukuran"
                       name="ukuran"
                       value="{{ old('ukuran', $jas->ukuran) }}"
                       placeholder="Masukan Ukuran Jas (S, M, L, XL, XXL)">
                @error('ukuran')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="stok" class="mb-1">Stok <span class="text-danger">*</span></label>
                <input type="number"
                       class="form-control @error('stok') is-invalid @enderror"
                       id="stok"
                       name="stok"
                       value="{{ old('stok', $jas->stok) }}"
                       min="0"
                       placeholder="Masukan Jumlah Stok">
                @error('stok')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="harga_sewa_per_hari" class="mb-1">Harga Sewa Per-Hari <span class="text-danger">*</span></label>
                <input type="number"
                       class="form-control @error('harga_sewa_per_hari') is-invalid @enderror"
                       id="harga_sewa_per_hari"
                       name="harga_sewa_per_hari"
                       value="{{ old('harga_sewa_per_hari', $jas->harga_sewa_per_hari) }}"
                       min="0"
                       placeholder="Masukan Jumlah Harga Sewa">
                @error('harga_sewa_per_hari')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="denda_terlambat" class="mb-1">Denda Terlambat Per-Hari</label>
                <input type="number"
                       class="form-control @error('denda_terlambat') is-invalid @enderror"
                       id="denda_terlambat"
                       name="denda_terlambat"
                       value="{{ old('denda_terlambat', $jas->denda_terlambat) }}"
                       min="0"
                       placeholder="Masukan Jumlah Denda">
                @error('denda_terlambat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="keterangan" class="mb-1">Keterangan</label>
                <textarea name="keterangan"
                          id="keterangan"
                          rows="5"
                          class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $jas->keterangan) }}</textarea>
                @error('keterangan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input type="hidden" name="is_available" value="0">
                    <input type="checkbox"
                           class="form-check-input"
                           id="is_available"
                           name="is_available"
                           value="1"
                           {{ old('is_available', $jas->is_available) ? 'checked' : '' }}>
                    <label for="is_available" class="form-check-label">
                        Tersedia Untuk Disewa
                    </label>
                </div>
            </div>
        </div>

        <br>
        <div>
            <button type="submit" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-save" aria-hidden="true"></i>
                Update
            </button>
        </div>
    </form>
</section>
@endsection
