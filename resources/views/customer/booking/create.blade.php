@extends('layouts.customer')

@section('title', 'Form Booking')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Form Pemesanan Jas</h5>
                </div>
                <div class="card-body">
                    <!-- Info Jas -->
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Jenis Jas:</strong> {{ $jas->jenis_label }}<br>
                                <strong>Ukuran:</strong> {{ $jas->ukuran }}<br>
                                <strong>Kode:</strong> {{ $jas->kode_jas }}
                            </div>
                            <div class="col-md-6">
                                <strong>Harga/Hari:</strong> Rp {{ number_format($jas->harga_sewa_per_hari, 0, ',', '.') }}<br>
                                <strong>Stok Tersedia:</strong> {{ $jas->stok }} pcs<br>
                                <strong>Denda/Hari:</strong> Rp {{ number_format($jas->denda_terlambat, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('customer.booking.store') }}" method="POST" id="formBooking">
                        @csrf
                        <input type="hidden" name="jas_id" value="{{ $jas->id }}">
                        <input type="hidden" name="harga_per_hari" id="harga_per_hari" value="{{ $jas->harga_sewa_per_hari }}">

                        <!-- Data Mahasiswa -->
                        <h6 class="mb-3 mt-4"><i class="fas fa-user-graduate text-primary"></i> Data Mahasiswa</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>NIM <span class="text-danger">*</span></label>
                                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                                       placeholder="Masukkan NIM" value="{{ old('nim') }}" required>
                                @error('nim') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                       placeholder="Masukkan nama" value="{{ old('nama') }}" required>
                                @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="" selected disabled>Pilih</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>No. HP <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                       placeholder="08123456789" value="{{ old('no_hp') }}" required>
                                @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="email@domain.com" value="{{ old('email') }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jurusan <span class="text-danger">*</span></label>
                                <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror"
                                       placeholder="Informatika" value="{{ old('jurusan') }}" required>
                                @error('jurusan') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                          rows="2" placeholder="Alamat lengkap" required>{{ old('alamat') }}</textarea>
                                @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <hr>

                        <!-- Data Pemesanan -->
                        <h6 class="mb-3"><i class="fas fa-calendar-alt text-primary"></i> Data Pemesanan</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Tanggal Sewa <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_sewa" id="tanggal_sewa"
                                       class="form-control @error('tanggal_sewa') is-invalid @enderror"
                                       value="{{ old('tanggal_sewa') }}" required>
                                @error('tanggal_sewa') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Tanggal Kembali <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                       class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                       value="{{ old('tanggal_kembali') }}" required>
                                @error('tanggal_kembali') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Tanggal Sidang <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_sidang"
                                       class="form-control @error('tanggal_sidang') is-invalid @enderror"
                                       value="{{ old('tanggal_sidang') }}" required>
                                @error('tanggal_sidang') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jumlah <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah" id="jumlah"
                                       class="form-control @error('jumlah') is-invalid @enderror"
                                       value="{{ old('jumlah', 1) }}" min="1" max="{{ $jas->stok }}" required>
                                <small class="text-muted">Maksimal: {{ $jas->stok }} pcs</small>
                                @error('jumlah') <small class="text-danger d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Catatan</label>
                                <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror"
                                          rows="1" placeholder="Catatan tambahan">{{ old('catatan') }}</textarea>
                                @error('catatan') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Preview Total -->
                        <div class="alert alert-success mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><i class="fas fa-calculator"></i> Estimasi Total Harga:</strong>
                                    <br>
                                    <small class="text-muted">Harga/hari × Durasi × Jumlah</small>
                                </div>
                                <div>
                                    <h3 class="mb-0 text-success" id="totalPreview">Rp 0</h3>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-lg mt-3">
                            <i class="fas fa-check-circle"></i> Konfirmasi Booking
                        </button>
                        <a href="{{ route('customer.jas.show', $jas->id) }}" class="btn btn-secondary w-100 mt-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalSewa = document.getElementById('tanggal_sewa');
        const tanggalKembali = document.getElementById('tanggal_kembali');
        const jumlahInput = document.getElementById('jumlah');
        const totalPreview = document.getElementById('totalPreview');
        const hargaPerHari = {{ $jas->harga_sewa_per_hari }};

        function hitungTotal() {
            const jumlah = parseInt(jumlahInput.value) || 0;
            let durasi = 0;

            if (tanggalSewa.value && tanggalKembali.value) {
                const start = new Date(tanggalSewa.value);
                const end = new Date(tanggalKembali.value);
                durasi = Math.round((end - start) / (1000 * 60 * 60 * 24));

                if ($durasi < 1) {
                    durasi = 1;
                }
            }

            const total = hargaPerHari * durasi * jumlah;
            totalPreview.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        tanggalSewa.addEventListener('change', hitungTotal);
        tanggalKembali.addEventListener('change', hitungTotal);
        jumlahInput.addEventListener('input', hitungTotal);
    });
</script> --}}

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tanggalSewa    = document.getElementById('tanggal_sewa');
    const tanggalKembali = document.getElementById('tanggal_kembali');
    const jumlahInput    = document.getElementById('jumlah');
    const totalPreview   = document.getElementById('totalPreview');

    // ✅ Pastikan hargaPerHari berupa angka
    const hargaPerHari = Number("{{ $jas->harga_sewa_per_hari }}") || 0;

    console.log('Harga per hari:', hargaPerHari);

    function parseDate(str) {
        if (!str) return null;
        const [y, m, d] = str.split('-').map(Number);
        return new Date(y, m - 1, d);
    }

    function hitungTotal() {
        const jumlah = parseInt(jumlahInput.value) || 1;  // ✅ default 1
        let durasi = 0;

        if (tanggalSewa.value && tanggalKembali.value) {
            const start = parseDate(tanggalSewa.value);
            const end = parseDate(tanggalKembali.value);

            // Durasi: hari pertama tidak dihitung
            durasi = Math.round((end - start) / (1000 * 60 * 60 * 24));

            // Minimal 1 hari
            if (durasi < 1) durasi = 1;
        }

        const total = hargaPerHari * durasi * jumlah;

        console.log({
            tanggalSewa: tanggalSewa.value,
            tanggalKembali: tanggalKembali.value,
            durasi: durasi,
            jumlah: jumlah,
            total: total
        });

        totalPreview.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Set default tanggal kalau kosong
    if (!tanggalSewa.value) {
        const today = new Date();
        tanggalSewa.value = today.toISOString().split('T')[0];
    }
    if (!tanggalKembali.value) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tanggalKembali.value = tomorrow.toISOString().split('T')[0];
    }

    // Event listener
    tanggalSewa.addEventListener('change', function() {
        // Tanggal kembali minimal = tanggal sewa
        tanggalKembali.min = this.value;
        hitungTotal();
    });
    tanggalKembali.addEventListener('change', hitungTotal);
    jumlahInput.addEventListener('input', hitungTotal);

    // ✅ Panggil saat pertama load
    hitungTotal();
});
</script>
@endpush
