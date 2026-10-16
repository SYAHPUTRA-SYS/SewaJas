@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
      <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
      </div>
    </div>
</div>
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-person-plus" aria-hidden="true"></i>
                <span>Data Pelanggan</span>
            </h2>
        </div>
        <a href="{{ route('pelanggan') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left-circle" aria-hidden="true"></i>Kembali</a>
    </div>
    <form action="{{ route('storePelanggan') }}" method="post">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="mb-1">Nim</label>
                <input type="number" class="form-control @error('nim') is-invalid @enderror"
                    name="nim" placeholder="Masukan Nim" autocomplete="off" value="{{ old('nim') }}">

                @error('nim')
                    <small>
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="mb-1">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                    name="nama" placeholder="Masukan Nama" autocomplete="off" {{ old('nama') }}>

                @error('nama')
                    <small>
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin')
                    is-invalid
                @enderror">
                    <option selected disabled>--Pilih Jenis Kelamin--</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>

                @error('jenis_kelamin')
                    <small>
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="mb-1">No Telpon</label>
                <input type="number" class="form-control mb-2 @error('no_hp') is-invalid @enderror"
                    name="no_hp" placeholder="Masukan No Hp" autocomplete="off" value="{{ old('no_hp') }}">

                @error('no_hp')
                    <small>
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="mb-1">Email</label>
                <input type="email" class="form-control mb-2 @error('email') is-invalid @enderror"
                    name="email" placeholder="Masukan Email" autocomplete="off" value="{{ old('email') }}">

                @error('email')
                    <small>
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="mb-1">Jurusan</label>
                <input type="text" class="form-control mb-2 @error('jurusan') is-invalid @enderror"
                    name="jurusan" placeholder="Masukan Jurusan" autocomplete="off">

                @error('jurusan')
                    <small>
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-12">
                <label class="mb-1">Alamat</label>
                <textarea name="alamat" rows="5" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                    @error('alamat')
                    <small>
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-save" aria-hidden="true"></i>
                Simpan
            </button>
        </div>
    </form>
</section>
@endsection
