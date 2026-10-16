<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $pemesanan->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            padding: 20px;
            color: #1f2937;
            font-size: 12px;
        }
        .invoice-container {
            max-width: 100%;
            padding: 20px;
        }
        .header {
            display: table;
            width: 100%;
            border-bottom: 3px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .header-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .header-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: right;
        }
        .brand h1 {
            color: #4f46e5;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .brand p {
            color: #6b7280;
            font-size: 10px;
            margin: 2px 0;
        }
        .invoice-title h2 {
            color: #4f46e5;
            font-size: 28px;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }
        .invoice-title p {
            font-size: 10px;
            color: #6b7280;
            margin: 2px 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 10px;
            text-transform: uppercase;
            color: #6b7280;
            letter-spacing: 1px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .info-grid {
            display: table;
            width: 100%;
        }
        .info-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 15px;
        }
        .info-box {
            background: #f9fafb;
            padding: 12px 15px;
            border-left: 4px solid #4f46e5;
        }
        .info-box p {
            margin: 4px 0;
            font-size: 11px;
        }
        .info-box strong {
            color: #4f46e5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        table thead th {
            background: #4f46e5;
            color: white;
            padding: 10px 12px;
            text-align: left;
            font-size: 11px;
            font-weight: 500;
        }
        table thead th:last-child {
            text-align: right;
        }
        table tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }
        table tbody td:last-child {
            text-align: right;
        }
        .total-row {
            background: #fef3c7;
            font-weight: bold;
            font-size: 13px;
        }
        .total-row td {
            padding: 12px;
            color: #92400e;
        }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            font-size: 10px;
            font-weight: 600;
        }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .notes {
            background: #fef3c7;
            padding: 12px 15px;
            border-left: 4px solid #f59e0b;
            margin-top: 15px;
        }
        .notes h4 {
            color: #92400e;
            margin-bottom: 8px;
            font-size: 11px;
        }
        .notes ul {
            padding-left: 18px;
            font-size: 10px;
            color: #78350f;
        }
        .notes li {
            margin-bottom: 3px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .footer p {
            color: #6b7280;
            font-size: 11px;
            margin-bottom: 5px;
        }
        .signature {
            margin-top: 50px;
            padding-top: 8px;
            border-top: 1px solid #1f2937;
            display: inline-block;
            font-weight: 600;
            color: #1f2937;
            font-size: 11px;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <!-- HEADER -->
    <div class="header">
        <div class="header-left">
            <div class="brand">
                <h1>SewaJas.id</h1>
                <p>Jl. Kampus No. 1, Kota</p>
                <p>Telp: 0812-3456-7890</p>
                <p>Email: info@sewajas.id</p>
            </div>
        </div>
        <div class="header-right">
            <div class="invoice-title">
                <h2>INVOICE</h2>
                <p><strong>No:</strong> INV-{{ date('Ymd', strtotime($pemesanan->created_at)) }}-{{ str_pad($pemesanan->id, 3, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Tanggal:</strong> {{ date('d/m/Y', strtotime($pemesanan->created_at)) }}</p>
                <p style="margin-top: 10px; padding: 8px; background: #f3f4f6; border-radius: 5px;">
                    <strong>Kode Verifikasi:</strong><br>
                    <span style="font-size: 14px; color: #4f46e5; letter-spacing: 2px;">
                        {{ $pemesanan->kode_verifikasi }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- INFO -->
    <div class="info-grid">
        <div class="info-col">
            <div class="section-title">Kepada:</div>
            <div class="info-box">
                <p><strong>{{ $pemesanan->pelanggan->nama }}</strong></p>
                <p>NIM: {{ $pemesanan->pelanggan->nim }}</p>
                <p>Jurusan: {{ $pemesanan->pelanggan->jurusan }}</p>
                <p>No. HP: {{ $pemesanan->pelanggan->no_hp }}</p>
                <p>Email: {{ $pemesanan->pelanggan->email }}</p>
            </div>
        </div>
        <div class="info-col">
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

    <!-- DETAIL -->
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
                    <td>Denda</td>
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

    <!-- NOTES -->
    <div class="notes">
        <h4>Catatan Penting:</h4>
        <ul>
            <li>Harap ambil jas 1 hari sebelum tanggal sidang</li>
            <li>Denda keterlambatan Rp {{ number_format($pemesanan->jas->denda_terlambat, 0, ',', '.') }} per hari</li>
            <li>Simpan invoice ini sebagai bukti pemesanan</li>
            <li>Bawa invoice ini saat pengambilan jas</li>
        </ul>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>{{ date('d/m/Y') }}</p>
        <div class="signature">
            (Admin SewaJas.id)
        </div>
    </div>
</div>
</body>
</html>
