<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Invoice - SewaJas.id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .verify-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 100%;
            padding: 40px;
        }
        .icon-success {
            width: 100px;
            height: 100px;
            background: #10b981;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        .icon-success i {
            color: white;
            font-size: 3rem;
        }
        h1 {
            color: #1f2937;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        .info-box {
            background: #f9fafb;
            border-left: 4px solid #10b981;
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            margin-top: 20px;
        }
        .info-box p {
            margin: 8px 0;
            font-size: 0.95rem;
        }
        .info-box strong {
            color: #10b981;
            display: inline-block;
            min-width: 120px;
        }
        .badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .btn-confirm {
            background: #10b981;
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-confirm:hover {
            background: #059669;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }
        .alert {
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
    </style>
</head>
<body>

<div class="verify-card text-center">
    <div class="icon-success">
        <i class="fas fa-check-circle"></i>
    </div>

    <h1>✅ Invoice Valid</h1>
    <p class="text-muted">Data pemesanan ditemukan di sistem</p>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <hr class="my-2">
            <small>
                <i class="fas fa-info-circle"></i>
                Status: <strong>Diambil</strong> |
                Pembayaran: <strong>Lunas</strong>
            </small>
        </div>
    @endif

    <div class="info-box">
        <p><strong><i class="fas fa-hashtag"></i> ID Pemesanan</strong> #{{ $pemesanan->id }}</p>
        <p><strong><i class="fas fa-user"></i> Nama</strong> {{ $pemesanan->pelanggan->nama }}</p>
        <p><strong><i class="fas fa-id-card"></i> NIM</strong> {{ $pemesanan->pelanggan->nim }}</p>
        <p><strong><i class="fas fa-graduation-cap"></i> Jurusan</strong> {{ $pemesanan->pelanggan->jurusan }}</p>
        <hr>
        <p><strong><i class="fas fa-tshirt"></i> Jas</strong> {{ $pemesanan->jas->jenis_label }} - {{ $pemesanan->jas->ukuran }}</p>
        <p><strong><i class="fas fa-calendar"></i> Tgl Sewa</strong> {{ date('d/m/Y', strtotime($pemesanan->tanggal_sewa)) }}</p>
        <p><strong><i class="fas fa-calendar-check"></i> Tgl Kembali</strong> {{ date('d/m/Y', strtotime($pemesanan->tanggal_kembali)) }}</p>
        <p><strong><i class="fas fa-money-bill"></i> Total</strong> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
        <hr>
        <p>
            <strong><i class="fas fa-info-circle"></i> Status</strong>
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
        </p>
        <p>
            <strong><i class="fas fa-credit-card"></i> Pembayaran</strong>
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
        </p>
    </div>

    @if($pemesanan->status === 'booking')
        <form action="{{ route('pemesanan.konfirmasi', $pemesanan->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-confirm">
                <i class="fas fa-check-double"></i> Konfirmasi Pengambilan Jas
            </button>
        </form>
    @elseif($pemesanan->status === 'diambil')
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle"></i> Jas sudah diambil
        </div>
    @elseif($pemesanan->status === 'kembali')
        <div class="alert alert-success mt-3">
            <i class="fas fa-check-circle"></i> Jas sudah dikembalikan
        </div>
    @else
        <div class="alert alert-danger mt-3">
            <i class="fas fa-times-circle"></i> Pemesanan dibatalkan
        </div>
    @endif
</div>

</body>
</html>
