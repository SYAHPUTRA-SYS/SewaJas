<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $pemesanan->id }} - SewaJas.id</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            padding: 20px;
            color: #1f2937;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            border-bottom: 3px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .brand h1 {
            color: #4f46e5;
            font-size: 2rem;
            margin-bottom: 5px;
        }
        .brand p {
            color: #6b7280;
            font-size: 0.9rem;
            margin: 2px 0;
        }
        .invoice-title {
            text-align: right;
        }
        .invoice-title h2 {
            color: #4f46e5;
            font-size: 2.5rem;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }
        .invoice-title p {
            font-size: 0.9rem;
            color: #6b7280;
            margin: 2px 0;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #6b7280;
            letter-spacing: 1px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-box {
            background: #f9fafb;
            padding: 15px 20px;
            border-radius: 8px;
            border-left: 4px solid #4f46e5;
        }
        .info-box p {
            margin: 5px 0;
            font-size: 0.9rem;
        }
        .info-box strong {
            color: #4f46e5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table thead th {
            background: #4f46e5;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-size: 0.9rem;
            font-weight: 500;
        }
        table thead th:first-child {
            border-radius: 8px 0 0 0;
        }
        table thead th:last-child {
            border-radius: 0 8px 0 0;
            text-align: right;
        }
        table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.9rem;
        }
        table tbody td:last-child {
            text-align: right;
        }
        table tbody tr:last-child td {
            border-bottom: none;
        }
        .total-row {
            background: #fef3c7;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .total-row td {
            padding: 15px;
            color: #92400e;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .notes {
            background: #fef3c7;
            padding: 15px 20px;
            border-radius: 8px;
            border-left: 4px solid #f59e0b;
            margin-top: 20px;
        }
        .notes h4 {
            color: #92400e;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        .notes ul {
            padding-left: 20px;
            font-size: 0.85rem;
            color: #78350f;
        }
        .notes li {
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
        .footer p {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .signature {
            margin-top: 60px;
            padding-top: 10px;
            border-top: 1px solid #1f2937;
            display: inline-block;
            font-weight: 600;
            color: #1f2937;
        }
        .action-buttons {
            max-width: 800px;
            margin: 0 auto 20px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-print {
            background: #4f46e5;
            color: white;
        }
        .btn-print:hover { background: #4338ca; }
        .btn-pdf {
            background: #dc2626;
            color: white;
        }
        .btn-pdf:hover { background: #b91c1c; }
        .btn-back {
            background: #6b7280;
            color: white;
        }
        .btn-back:hover { background: #4b5563; }

        @media print {
            body { background: white; padding: 0; }
            .invoice-container { box-shadow: none; padding: 20px; }
            .action-buttons { display: none; }
        }

        .invoice-title {
            text-align: right;
        }
        .invoice-title .mt-3 {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<!-- Tombol Aksi -->
<div class="action-buttons">
    <a href="{{ route('pemesanan') }}" class="btn btn-back">← Kembali</a>
    <a href="{{ route('pemesanan.invoice.pdf', $pemesanan->id) }}" class="btn btn-pdf">📄 Download PDF</a>
    <button onclick="window.print()" class="btn btn-print">🖨️ Cetak</button>
</div>

<div class="invoice-container">
    <!-- HEADER -->
    <div class="header">
        <div class="brand">
            <h1>🎓 SewaJas.id</h1>
            <p>Jl. Kampus No. 1, Kota</p>
            <p>Telp: 0812-3456-7890</p>
            <p>Email: info@sewajas.id</p>
        </div>
        <div class="invoice-title">
            <h2>INVOICE</h2>
            <p><strong>No:</strong> INV-{{ date('Ymd', strtotime($pemesanan->created_at)) }}-{{ str_pad($pemesanan->id, 3, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Tanggal:</strong> {{ date('d/m/Y', strtotime($pemesanan->created_at)) }}</p>
        </div>

        <div class="invoice-title">
            <h2>INVOICE</h2>
            <p><strong>No:</strong> INV-{{ date('Ymd', strtotime($pemesanan->created_at)) }}-{{ str_pad($pemesanan->id, 3, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Tanggal:</strong> {{ date('d/m/Y', strtotime($pemesanan->created_at)) }}</p>

            {{-- QR CODE --}}
            <div class="mt-3">
                <img src="{{ route('pemesanan.qr', $pemesanan->id) }}"
                    alt="QR Code"
                    style="width: 120px; height: 120px; border: 2px solid #e5e7eb; border-radius: 8px; padding: 5px;">
                <p style="font-size: 0.7rem; color: #6b7280; margin-top: 5px;">
                    Scan untuk verifikasi
                </p>
                <p style="font-size: 0.7rem; color: #4f46e5; font-weight: 600;">
                    Kode: {{ $pemesanan->kode_verifikasi }}
                </p>
            </div>
        </div>
    </div>

    <!-- INFO PELANGGAN & STATUS -->
    <div class="info-grid">
        <div>
            <div class="section-title">Kepada:</div>
            <div class="info-box">
                <p><strong>{{ $pemesanan->pelanggan->nama }}</strong></p>
                <p>NIM: {{ $pemesanan->pelanggan->nim }}</p>
                <p>Jurusan: {{ $pemesanan->pelanggan->jurusan }}</p>
                <p>No. HP: {{ $pemesanan->pelanggan->no_hp }}</p>
                <p>Email: {{ $pemesanan->pelanggan->email }}</p>
            </div>
        </div>
        <div>
            <div class="section-title">Status:</div>
            <div class="info-box">
                @php
                    $statusColors = [
                        'booking' => 'badge-warning',
                        'diambil' => 'badge-info',
                        'kembali' => 'badge-success',
                        'batal' => 'badge-danger'
                    ];
                    $pembayaranColors = [
                        'belum_bayar' => 'badge-danger',
                        'dp' => 'badge-warning',
                        'lunas' => 'badge-success'
                    ];
                @endphp
                <p>Status: <span class="badge {{ $statusColors[$pemesanan->status] ?? 'badge-info' }}">{{ ucfirst($pemesanan->status) }}</span></p>
                <p>Pembayaran: <span class="badge {{ $pembayaranColors[$pemesanan->pembayaran] ?? 'badge-info' }}">{{ ucfirst(str_replace('_', ' ', $pemesanan->pembayaran)) }}</span></p>
                <p>Tanggal Sidang: <strong>{{ date('d/m/Y', strtotime($pemesanan->tanggal_sidang)) }}</strong></p>
            </div>
        </div>
    </div>

    <!-- DETAIL PEMESANAN -->
    <div class="section">
        <div class="section-title">Detail Pemesanan:</div>
        <table>
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Jenis Jas</td>
                    <td>{{ $pemesanan->jas->jenis_label }} - Ukuran {{ $pemesanan->jas->ukuran }}</td>
                </tr>
                <tr>
                    <td>Kode Jas</td>
                    <td>{{ $pemesanan->jas->kode_jas }}</td>
                </tr>
                <tr>
                    <td>Harga Sewa / Hari</td>
                    <td>Rp {{ number_format($pemesanan->jas->harga_sewa_per_hari, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tanggal Sewa</td>
                    <td>{{ date('d/m/Y', strtotime($pemesanan->tanggal_sewa)) }}</td>
                </tr>
                <tr>
                    <td>Tanggal Kembali</td>
                    <td>{{ date('d/m/Y', strtotime($pemesanan->tanggal_kembali)) }}</td>
                </tr>
                <tr>
                    <td>Durasi</td>
                    <td>
                        @php
                            $start = \Carbon\Carbon::parse($pemesanan->tanggal_sewa);
                            $end = \Carbon\Carbon::parse($pemesanan->tanggal_kembali);
                            $durasi = $start->diffInDays($end) + 1;
                        @endphp
                        {{ $durasi }} hari
                    </td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>{{ $pemesanan->jumlah }} pcs</td>
                </tr>
                @if($pemesanan->denda > 0)
                <tr>
                    <td>Denda Keterlambatan</td>
                    <td>Rp {{ number_format($pemesanan->denda, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td>TOTAL</td>
                    <td>Rp {{ number_format($pemesanan->total_harga + $pemesanan->denda, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- CATATAN -->
    <div class="notes">
        <h4>⚠️ Catatan Penting:</h4>
        <ul>
            <li>Harap ambil jas 1 hari sebelum tanggal sidang</li>
            <li>Denda keterlambatan Rp {{ number_format($pemesanan->jas->denda_terlambat, 0, ',', '.') }} per hari</li>
            <li>Simpan invoice ini sebagai bukti pemesanan</li>
            <li>Bawa invoice ini saat pengambilan jas</li>
            @if($pemesanan->catatan)
                <li>{{ $pemesanan->catatan }}</li>
            @endif
        </ul>
    </div>

    <!-- FOOTER / TANDA TANGAN -->
    <div class="footer">
        <p>{{ date('d/m/Y') }}</p>
        <div class="signature">
            (Admin SewaJas.id)
        </div>
    </div>
</div>

</body>
</html>
