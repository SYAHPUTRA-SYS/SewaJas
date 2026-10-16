@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-pencil" aria-hidden="true"></i></span>
      <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
      </div>
    </div>
</div>
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-pencil" aria-hidden="true"></i>
                <span>Form Pesanan</span>
            </h2>
        </div>
        <a href="{{ route('pemesanan') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left-circle" aria-hidden="true"></i>Kembali</a>
    </div>

    <form action="{{ route('pesananUpdate', $pemesanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="pelanggan_id" class="mb-1">Pelanggan <span class="text-danger">*</span></label>
                <select name="pelanggan_id" id="pelanggan_id" class="form-control @error('pelanggan_id') is-invalid @enderror">
                    <option value="" disabled>Pilih Pelanggan</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id', $pemesanan->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}>
                            {{ $pelanggan->nama }} ({{ $pelanggan->nim }})
                        </option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="jas_id" class="mb-1">Jas <span class="text-danger">*</span></label>
                <select name="jas_id" id="jas_id" class="form-control @error('jas_id') is-invalid @enderror">
                    <option value="" disabled>Pilih Jas</option>
                    @foreach($jas as $item)
                        <option value="{{ $item->id }}"
                                data-harga="{{ $item->harga_sewa_per_hari }}"
                                {{ old('jas_id', $pemesanan->jas_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->jenis_label }} - {{ $item->ukuran }} ({{ $item->kode_jas }}) - Stok: {{ $item->stok }}
                        </option>
                    @endforeach
                </select>
                @error('jas_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="tanggal_sewa" class="mb-1">Tanggal Sewa <span class="text-danger">*</span></label>
                <input type="date"
                       class="form-control @error('tanggal_sewa') is-invalid @enderror"
                       id="tanggal_sewa"
                       name="tanggal_sewa"
                       value="{{ old('tanggal_sewa', $pemesanan->tanggal_sewa) }}">
                @error('tanggal_sewa')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="tanggal_kembali" class="mb-1">Tanggal Kembali <span class="text-danger">*</span></label>
                <input type="date"
                       class="form-control @error('tanggal_kembali') is-invalid @enderror"
                       id="tanggal_kembali"
                       name="tanggal_kembali"
                       value="{{ old('tanggal_kembali', $pemesanan->tanggal_kembali) }}">
                @error('tanggal_kembali')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="tanggal_sidang" class="mb-1">Tanggal Sidang <span class="text-danger">*</span></label>
                <input type="date"
                       class="form-control @error('tanggal_sidang') is-invalid @enderror"
                       id="tanggal_sidang"
                       name="tanggal_sidang"
                       value="{{ old('tanggal_sidang', $pemesanan->tanggal_sidang) }}">
                @error('tanggal_sidang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="jumlah" class="mb-1">Jumlah <span class="text-danger">*</span></label>
                <input type="number"
                       class="form-control @error('jumlah') is-invalid @enderror"
                       id="jumlah"
                       name="jumlah"
                       value="{{ old('jumlah', $pemesanan->jumlah) }}"
                       min="1">
                @error('jumlah')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="status" class="mb-1">Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="booking" {{ old('status', $pemesanan->status) == 'booking' ? 'selected' : '' }}>Booking</option>
                    <option value="diambil" {{ old('status', $pemesanan->status) == 'diambil' ? 'selected' : '' }}>Diambil</option>
                    <option value="kembali" {{ old('status', $pemesanan->status) == 'kembali' ? 'selected' : '' }}>Kembali</option>
                    <option value="batal" {{ old('status', $pemesanan->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="pembayaran" class="mb-1">Pembayaran <span class="text-danger">*</span></label>
                <select name="pembayaran" id="pembayaran" class="form-control @error('pembayaran') is-invalid @enderror">
                    <option value="belum_bayar" {{ old('pembayaran', $pemesanan->pembayaran) == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="dp" {{ old('pembayaran', $pemesanan->pembayaran) == 'dp' ? 'selected' : '' }}>DP</option>
                    <option value="lunas" {{ old('pembayaran', $pemesanan->pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
                @error('pembayaran')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="total_harga_preview" class="mb-1">Total Harga (Preview)</label>
                <input type="text"
                       class="form-control"
                       id="total_harga_preview"
                       readonly
                       value="Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}"
                       style="background: #f0f0f0; font-weight: bold; color: #4f46e5;">
            </div>

            <div class="col-md-12">
                <label for="catatan" class="mb-1">Catatan</label>
                <textarea name="catatan"
                          id="catatan"
                          rows="3"
                          class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan', $pemesanan->catatan) }}</textarea>
                @error('catatan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
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



