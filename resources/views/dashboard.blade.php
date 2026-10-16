@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
      <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
      </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Total Mahasiswa -->
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Mahasiswa</p>
                        <h2 class="mb-1 fw-bold">{{ number_format($totalMahasiswa) }}</h2>
                        <small class="text-success">
                            <i class="fas fa-user-graduate"></i> Terdaftar
                        </small>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-user-graduate fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Jas -->
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Jas</p>
                        <h2 class="mb-1 fw-bold">{{ number_format($totalJas) }}</h2>
                        <small class="text-info">
                            <i class="fas fa-tshirt"></i> Jenis Jas
                        </small>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-tshirt fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemesanan Aktif -->
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Pemesanan Aktif</p>
                        <h2 class="mb-1 fw-bold">{{ number_format($pemesananAktif) }}</h2>
                        <small class="text-warning">
                            <i class="fas fa-clock"></i> Booking & Diambil
                        </small>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-shopping-cart fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Pendapatan</p>
                        <h4 class="mb-1 fw-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                        <small class="text-success">
                            <i class="fas fa-arrow-up"></i> Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }} bulan ini
                        </small>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-money-bill-wave fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- GRAFIK & STATISTIK PEMBAYARAN --}}
<div class="row g-4 mb-4">
    <!-- Grafik Pemesanan -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-success">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line text-primary me-2"></i> Grafik Pemesanan (6 Bulan Terakhir)
                </h5>
            </div>
            <div class="card-body">
                <canvas id="chartPemesanan" height="80"></canvas>
            </div>
        </div>
    </div>

    <!-- Statistik Pembayaran -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-secondary">
                <h5 class="mb-0">
                    <i class="fas fa-credit-card text-primary me-2"></i> Status Pembayaran
                </h5>
            </div>
            <div class="card-body">
                <canvas id="chartPembayaran" height="200"></canvas>

                <div class="mt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="fas fa-circle text-danger"></i> Belum Bayar</span>
                        <strong>{{ $belumBayar }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="fas fa-circle text-warning"></i> DP</span>
                        <strong>{{ $dp }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-circle text-success"></i> Lunas</span>
                        <strong>{{ $lunas }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== PEMESANAN TERBARU & STOK MENIPIS ==================== -->
<div class="row g-4">
    <!-- Pemesanan Terbaru -->
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-clock text-primary me-2"></i> Pemesanan Terbaru
                </h5>
                <a href="{{ route('pemesanan') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="text-center">
                                <th>Pelanggan</th>
                                <th>Jas</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemesananTerbaru as $item)
                            <tr class="text-center">
                                <td>
                                    <strong>{{ $item->pelanggan->nama ?? '-' }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $item->pelanggan->nim ?? '-' }}</small>
                                </td>
                                <td>
                                    {{ $item->jas->jenis_label ?? '-' }}
                                    <br>
                                    <small class="text-muted">{{ $item->jas->ukuran ?? '-' }}</small>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'booking' => 'warning',
                                            'diambil' => 'info',
                                            'kembali' => 'success',
                                            'batal' => 'danger'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$item->status] ?? 'secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">
                                    Belum ada pemesanan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Stok Jas Menipis -->
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-warning d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i> Stok Jas Menipis
                </h5>
                <a href="{{ route('jas') }}" class="btn btn-sm btn-outline-secondary">
                    Kelola <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($stokMenipis->count() > 0 || $jasHabis->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($jasHabis as $item)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->jenis_label }}</strong>
                                <br>
                                <small class="text-muted">{{ $item->kode_jas }}</small>
                            </div>
                            <span class="badge bg-danger">Habis</span>
                        </div>
                        @endforeach

                        @foreach($stokMenipis as $item)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->jenis_label }} - {{ $item->ukuran }}</strong>
                                <br>
                                <small class="text-muted">{{ $item->kode_jas }}</small>
                            </div>
                            <span class="badge bg-warning">{{ $item->stok }} pcs</span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <p class="text-muted mb-0">Semua stok jas aman</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ==================== AKSI CEPAT ==================== -->
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-danger">
                <h5 class="mb-0">
                    <i class="fas fa-bolt text-primary me-2"></i> Aksi Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('createPelanggan') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-user-plus fa-2x d-block mb-2"></i>
                            Tambah Mahasiswa
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('createJas') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="fas fa-tshirt fa-2x d-block mb-2"></i>
                            Tambah Jas
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('pesanCreate') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="fas fa-shopping-cart fa-2x d-block mb-2"></i>
                            Tambah Pemesanan
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('customer.home') }}" class="btn btn-outline-info w-100 py-3" target="_blank">
                            <i class="fas fa-eye fa-2x d-block mb-2"></i>
                            Lihat Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ========== GRAFIK PEMESANAN ==========
    const ctxPemesanan = document.getElementById('chartPemesanan').getContext('2d');
    new Chart(ctxPemesanan, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: @json($chartData),
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#4f46e5',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // ========== GRAFIK PEMBAYARAN ==========
    const ctxPembayaran = document.getElementById('chartPembayaran').getContext('2d');
    new Chart(ctxPembayaran, {
        type: 'doughnut',
        data: {
            labels: ['Belum Bayar', 'DP', 'Lunas'],
            datasets: [{
                data: [{{ $belumBayar }}, {{ $dp }}, {{ $lunas }}],
                backgroundColor: ['#ef4444', '#f59e0b', '#10b981'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            cutout: '65%'
        }
    });
</script>
@endpush

