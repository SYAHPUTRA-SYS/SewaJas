@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
      <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
      </div>
    </div>
</div>
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-people" aria-hidden="true"></i>
                <span>Form Pesanan</span>
            </h2>
        </div>
        <a href="{{ route('pemesanan') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left-circle" aria-hidden="true"></i>Kembali</a>
    </div>
    <form action="{{ route('pesananStore') }}" method="post">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label for="pelanggan_id" class="mb-2">Pelanggan <span class="text-danger">*</span></label>
                <select name="pelanggan_id" id="pelanggan_id"
                    class="form-control @error('pelanggan_id')
                        is-invalid
                    @enderror">
                    <option selected disabled>Pilih Pelanggan</option>
                    @foreach ($pelanggan as $item)
                    <option value="{{ $item->id }}" {{ old('pelanggan_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }} - {{ $item->nim }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="jas_id" class="mb-2">Jas <span class="text-danger">*</span></label>
                <select name="jas_id" id="jas_id" class="form-control
                    @error('jas_id')
                        is-invalid
                    @enderror">
                    <option selected disabled>Pilih Jas</option>
                    @foreach ($jas as $item)
                    <option value="{{ $item->id }}" data-harga="{{ $item->harga_sewa_per_hari }}"
                        data-stok="{{ $item->stok }}"
                        {{ old('jas_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->jenis }} - {{ $item->ukuran }} - {{ $item->kode_jas }}
                            - Stok:{{ $item->stok }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="tanggal_sewa" class="mb-2">
                    Tanggal Sewa
                    <span class="text-danger">*</span>
                </label>
                <input type="date" name="tanggal_sewa" id="tanggal_sewa"
                    class="form-control @error('tanggal_sewa')
                        is-invalid
                    @enderror" value="{{ old('tanggal_sewa') }}">
                 @error('tanggal_sewa')
                    <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>

            <div class="col-md-4">
                <label for="tanggal_kembali" class="mb-2">
                    Tanggal Kembalian
                    <span class="text-danger">*</span>
                </label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                    class="form-control @error('tanggal_kembali')
                        is-invalid
                    @enderror" value="{{ old('tanggal_kembali') }}">
                 @error('tanggal_kembali')
                    <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>

            <div class="col-md-4">
                <label for="tanggal_sidang" class="mb-2">
                    Tanggal Sidang
                    <span class="text-danger">*</span>
                </label>
                <input type="date" name="tanggal_sidang" id="tanggal_sidang"
                    class="form-control @error('tanggal_sidang')
                        is-invalid
                    @enderror" value="{{ old('tanggal_sidang') }}">
                 @error('tanggal_sidang')
                    <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>

            <div class="col-md-6">
                <label for="jumlah" class="mb-2">
                    Jumlah
                    <span class="text-danger">*</span>
                </label>
                <input type="number" name="jumlah" id="jumlah"
                    class="form-control @error('jumlah')
                        is-invalid
                    @enderror" value="{{ old('jumlah', 1) }}" min="1">
                 @error('jumlah')
                    <small class="text-danger">{{ $message }}</small>
                 @enderror
            </div>

            <div class="col-md-6">
                <label for="total_harga_preview" class="mb-2">Total Harga (Preview)</label>
                <input type="text"
                       class="form-control"
                       id="total_harga_preview"
                       readonly>
            </div>

            <div class="col-md-12">
                <label for="catatan" class="mb-2">Catatan</label>
                <textarea name="catatan"
                          id="catatan"
                          rows="3"
                          class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save" aria-hidden="true"></i>
                Simpan
            </button>
        </div>
    </form>

</section>
@endsection

{{-- @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jasSelect = document.getElementById('jas_id');
        const tanggalSewa = document.getElementById('tanggal_sewa');
        const tanggalKembali = document.getElementById('tanggal_kembali');
        const jumlahInput = document.getElementById('jumlah');
        const totalPreview = document.getElementById('total_harga_preview');

        function hitungTotal() {
            const harga = jasSelect.options[jasSelect.selectedIndex]?.dataset.harga || 0;
            const jumlah = jumlahInput.value || 0;

            let durasi = 1;
            if (tanggalSewa.value && tanggalKembali.value) {
                const start = new Date(tanggalSewa.value);
                const end = new Date(tanggalKembali.value);
                durasi = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
            }

            const total = harga * durasi * jumlah;
            totalPreview.value = 'Rp ' + total.toLocaleString('id-ID');
        }

        jasSelect.addEventListener('change', hitungTotal);
        tanggalSewa.addEventListener('change', hitungTotal);
        tanggalKembali.addEventListener('change', hitungTotal);
        jumlahInput.addEventListener('input', hitungTotal);
    });
</script>
@endpush --}}
