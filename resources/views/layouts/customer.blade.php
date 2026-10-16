<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sewa Jas Sidang')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/togaa.png') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        /* Navbar */
        .navbar-customer {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-customer .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4f46e5;
            text-decoration: none;
        }
        .navbar-customer .brand i {
            color: #4f46e5;
        }
        .navbar-customer .nav-link {
            color: #4a5568;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: 0.3s;
            text-decoration: none;
        }
        .navbar-customer .nav-link:hover {
            background: #f3f4f6;
            color: #4f46e5;
        }
        .navbar-customer .btn-primary-custom {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 8px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .navbar-customer .btn-primary-custom:hover {
            background: #4338ca;
            color: white;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #8b5cf6 100%);
            padding: 80px 0;
            color: white;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        /* Feature Card */
        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: 100%;
            transition: 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .feature-card i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .icon-purple { color: #4f46e5; }
        .icon-green { color: #10b981; }
        .icon-orange { color: #f59e0b; }
        .icon-blue { color: #3b82f6; }

        /* Product Card */
        .product-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: 100%;
            transition: 0.3s;
            border: 1px solid #e5e7eb;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .product-card i {
            font-size: 4rem;
        }
        .product-card .price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4f46e5;
        }
        .badge-stock {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .badge-available { background: #d1fae5; color: #065f46; }
        .badge-empty { background: #fee2e2; color: #991b1b; }

        /* Footer */
        .footer {
            background: #1f2937;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
        .footer a {
            color: #9ca3af;
            text-decoration: none;
        }
        .footer a:hover { color: white; }

        /* Alert */
        .alert-custom {
            border-radius: 10px;
            padding: 15px 20px;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .hero p { font-size: 1rem; }
        }
    </style>
</head>
<body>

<!-- ==================== NAVBAR ==================== -->
<nav class="navbar-customer">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('customer.home') }}" class="brand">
                <i class="fas fa-graduation-cap"></i> SewaJas.id
            </a>
            <div class="d-none d-md-flex gap-2 align-items-center">
                <a href="{{ route('customer.jas') }}" class="nav-link">
                    <i class="fas fa-tshirt"></i> Daftar Jas
                </a>
                <a href="{{ route('customer.booking.cek') }}" class="nav-link">
                    <i class="fas fa-search"></i> Cek Status
                </a>
                <a href="{{ route('customer.jas') }}" class="btn-primary-custom">
                    <i class="fas fa-shopping-cart"></i> Booking
                </a>
            </div>
            <button class="btn d-md-none" style="border:1px solid #ddd;"
                    data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div class="collapse d-md-none mt-3" id="mobileMenu">
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('customer.jas') }}" class="nav-link">
                    <i class="fas fa-tshirt"></i> Daftar Jas
                </a>
                <a href="{{ route('customer.booking.cek') }}" class="nav-link">
                    <i class="fas fa-search"></i> Cek Status
                </a>
                <a href="{{ route('customer.jas') }}" class="btn-primary-custom text-center">
                    <i class="fas fa-shopping-cart"></i> Booking
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- ==================== ALERT ==================== -->
@if(session('success') || session('error'))
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show alert-custom">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show alert-custom">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>
@endif

<!-- ==================== MAIN CONTENT ==================== -->
<main>
    @yield('content')
</main>

<!-- ==================== FOOTER ==================== -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5><i class="fas fa-graduation-cap"></i> SewaJas.id</h5>
                <p class="text-white-50">Platform sewa jas untuk sidang akhir mahasiswa. Mudah, cepat, dan terpercaya.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('customer.home') }}"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                    <li><a href="{{ route('customer.jas') }}"><i class="fas fa-chevron-right"></i> Daftar Jas</a></li>
                    <li><a href="{{ route('customer.booking.cek') }}"><i class="fas fa-chevron-right"></i> Cek Status</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Kontak</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-phone me-2"></i> 0838-4204-4340</li>
                    <li><i class="fas fa-envelope me-2"></i> info@sewajas.id</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Medan-Banda Aceh, Lhokseumawe</li>
                </ul>
                <div class="mt-3">
                    <a href="#" class="text-white me-2" style="font-size:1.5rem;"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-2" style="font-size:1.5rem;"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="text-white" style="font-size:1.5rem;"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-secondary">
        <div class="text-center text-muted">
            &copy; 2026 SewaJas.id. All Rights Reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
