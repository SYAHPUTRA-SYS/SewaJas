<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Gagal - SewaJas.id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
            max-width: 450px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }
        .icon-error {
            width: 100px;
            height: 100px;
            background: #ef4444;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .icon-error i {
            color: white;
            font-size: 3rem;
        }
        h1 {
            color: #1f2937;
            font-size: 1.6rem;
            margin-bottom: 10px;
        }
        .btn-back {
            background: #6b7280;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-back:hover {
            background: #4b5563;
            color: white;
        }
    </style>
</head>
<body>

<div class="verify-card">
    <div class="icon-error">
        <i class="fas fa-times-circle"></i>
    </div>

    <h1>❌ Verifikasi Gagal</h1>
    <p class="text-muted">Kode verifikasi tidak ditemukan atau tidak valid.</p>

    <p class="text-muted small">
        Pastikan Anda menggunakan invoice yang benar, atau hubungi admin untuk informasi lebih lanjut.
    </p>

    <a href="{{ route('customer.home') }}" class="btn-back">
        <i class="fas fa-home"></i> Kembali ke Beranda
    </a>
</div>

</body>
</html>
