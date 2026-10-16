<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pemesanan - SewaJas.id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
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
        .status-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .status-booking { background: #f59e0b; }
        .status-diambil { background: #3b82f6; }
        .status-kembali { background: #10b981; }
        .status-batal { background: #ef4444; }

        .status-icon i {
            color: white;
            font-size: 3rem;
        }
        h1 {
            color: #1f2937;
            font-size: 1.6rem;
            margin-bottom: 5px;
        }
        .subtitle {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        .info-box {
            background: #f9fafb;
            border-left: 4px solid #4f46e5;
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
            color: #4f46e5;
            display: inline-block;
            min-width: 120px;
        }
        .badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .btn-home {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-home:hover {
            background: #4338ca;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        }
        .alert {
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-top: 15px;
        }
        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }
        .timeline {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            position: relative;
        }
        .timeline::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 10%;
            right: 10%;
            height: 2px;
            background: #e5e7eb;
            z-index: 1;
        }
        .timeline-item {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }
        .timeline-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e5e7eb;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
            margin-bottom: 5px;
        }
        .timeline-circle.active {
            background: #4f46e5;
        }
        .timeline-circle.done {
            background: #10b981;
        }
        .timeline-label {
            font-size: 0.7rem;
            color: #6b7280;
        }
    </style>
</head>
<body>

<div class="verify-card text-center">
    @php
        $statusIcon = [
            'booking' => 'fa-clock',
            'diambil' => 'fa-box-open',
            'kembali' => 'fa-check-double',
            'batal' => 'fa-times-circle'
        ];
        $statusClass = [
            'booking' => 'status-booking',
            'diambil' => 'status-diambil',
            'kembali' => 'status-kembali',
            'batal' => 'status-batal'
        ];
        $statusTitle = [
            'booking' => 'Menunggu Pengambilan',
            'diambil' => 'Jas Sudah Diambil',
            'kembali' => 'Jas Sudah Dikembalikan',
            'batal' => 'Pemesanan Dibatalkan'
        ];
    @endphp

    <div class="status-icon {{ $statusClass[$pemesanan->status] ?? 'status-booking' }}">
        <i class="fas {{ $statusIcon[$pemesanan->status] ?? 'fa-clock' }}"></i>
    </div>

    <h1>{{ $statusTitle[$pemesanan->status] ?? 'Status Pemesanan' }}</h1>
    <p class="subtitle">Pemesanan #{{ $pemesanan->id }}</p>

    {{-- TIMELINE --}}
    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-circle {{ in_array($pemesanan->status, ['booking', 'diambil', 'kembali']) ? 'done' : '' }}">
                <i class="fas fa-check"></i>
            </div>
            <div class="timeline-label">Booking</div>
        </div>
        <div class="timeline-item">
            <div class="timeline-circle {{ in_array($pemesanan->status, ['diambil', 'kembali']) ? 'done' : ($pemesanan->status == 'booking' ? 'active' : '') }}">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="timeline-label">Diambil</div>
        </div>
        <div class="timeline-item">
            <div class="timeline-circle {{ $pemesanan->status == 'kembali' ? 'done' : ($pemesanan->status == 'diambil' ? 'active' : '') }}">
                <i class="fas fa-check-double"></i>
            </div>
            <div class="timeline-label">Kembali</div>
        </div>
    </div>

    {{-- INFO PEMESANAN --}}
    <div class="info-box">
        <p><strong><i class="fas fa-user"></i> Nama</strong> {{ $pemesanan->pelanggan->nama }}</p>
        <p><strong><i class="fas fa-id-card"></i> NIM</strong> {{ $pemesanan->pelanggan->nim }}</p>
        <p><strong><i class="fas fa-tshirt"></i> Jas</strong> {{ $pemesanan->jas->jenis_label }} - {{ $pemesanan->jas->ukuran }}</p>
        <p><strong><i class="fas fa-calendar"></i> Tgl Sewa</strong> {{ date('d/m/Y', strtotime($pemesanan->tanggal_sewa)) }}</p>
        <p><strong><i class="fas fa-calendar-check"></i> Tgl Kembali</strong> {{ date('d/m/Y', strtotime($pemesanan->tanggal_kembali)) }}</p>
        <p><strong><i class="fas fa-money-bill"></i> Total</strong> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
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

    {{-- INFO TAMBAHAN --}}
    @if($pemesanan->status === 'booking')
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Silakan ambil jas di kampus sesuai tanggal yang ditentukan.
        </div>
    @elseif($pemesanan->status === 'diambil')
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Jas sedang Anda gunakan. Jangan lupa dikembalikan sebelum tanggal kembali.
        </div>
    @elseif($pemesanan->status === 'kembali')
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            Terima kasih! Jas sudah dikembalikan tepat waktu.
        </div>
    @endif

    <a href="{{ route('customer.home') }}" class="btn-home">
        <i class="fas fa-home"></i> Kembali ke Beranda
    </a>
</div>

</body>
</html>
