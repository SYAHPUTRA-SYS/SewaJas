@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-info-circle" aria-hidden="true"></i></span>
        <div>
            <h1 class="h3 mb-1">Detail Pemesanan</h1>
        </div>
    </div>
</div>

<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-info-circle" aria-hidden="true"></i>
                <span>Detail Pesanan #{{ $pemesanan->id }}</span>
            </h2>
        </div>
        <div>
            <a href="{{ route('pemesanan.invoice', $pemesanan->id) }}"
                class="btn btn-outline-primary btn-sm" target="_blank">
                    <i class="bi bi-receipt"></i> Cetak Invoice
            </a>
            <a href="{{ route('pemesanan.invoice.pdf', $pemesanan->id) }}"
                class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-file-pdf"></i> Download PDF
            </a>
            <a href="{{ route('pesananEdit', $pemesanan->id) }}" class="btn btn-outline-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('pemesanan') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left-circle" aria-hidden="true"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <h6 class="mb-3"><i class="bi bi-person"></i> Informasi Pelanggan</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 35%;">Nama</td>
                            <td>{{ $pemesanan->pelanggan->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">NIM</td>
                            <td>{{ $pemesanan->pelanggan->nim ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Jurusan</td>
                            <td>{{ $pemesanan->pelanggan->jurusan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">No. HP</td>
                            <td>{{ $pemesanan->pelanggan->no_hp ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <h6 class="mb-3"><i class="bi bi-tshirt"></i> Informasi Jas</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 35%;">Kode Jas</td>
                            <td>{{ $pemesanan->jas->kode_jas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Jenis</td>
                            <td>{{ $pemesanan->jas->jenis_label ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Ukuran</td>
                            <td>{{ $pemesanan->jas->ukuran ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Harga/Hari</td>
                            <td>Rp {{ number_format($pemesanan->jas->harga_sewa_per_hari ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr>

    <div class="row g-3">
        <div class="col-md-6">
            <h6 class="mb-3"><i class="bi bi-calendar"></i> Informasi Pemesanan</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 35%;">Tanggal Sewa</td>
                            <td>{{ $pemesanan->tanggal_sewa ? date('d/m/Y', strtotime($pemesanan->tanggal_sewa)) : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Kembali</td>
                            <td>{{ $pemesanan->tanggal_kembali ? date('d/m/Y', strtotime($pemesanan->tanggal_kembali)) : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Sidang</td>
                            <td>{{ $pemesanan->tanggal_sidang ? date('d/m/Y', strtotime($pemesanan->tanggal_sidang)) : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Jumlah</td>
                            <td>{{ $pemesanan->jumlah }} pcs</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <h6 class="mb-3"><i class="bi bi-credit-card"></i> Status & Pembayaran</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-bold" style="width: 35%;">Status</td>
                            <td>
                                @php
                                    $statusColors = [
                                        'booking' => 'warning',
                                        'diambil' => 'info',
                                        'kembali' => 'success',
                                        'batal' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$pemesanan->status] ?? 'secondary' }}">
                                    {{ ucfirst($pemesanan->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Pembayaran</td>
                            <td>
                                @php
                                    $pembayaranColors = [
                                        'belum_bayar' => 'danger',
                                        'dp' => 'warning',
                                        'lunas' => 'success'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $pembayaranColors[$pemesanan->pembayaran] ?? 'secondary' }}">
                                    {{ ucfirst(str_replace('_', ' ', $pemesanan->pembayaran)) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total Harga</td>
                            <td><strong>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Denda</td>
                            <td>Rp {{ number_format($pemesanan->denda, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Catatan</td>
                            <td>{{ $pemesanan->catatan ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
