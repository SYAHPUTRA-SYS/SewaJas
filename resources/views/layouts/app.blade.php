@include('layouts.header')
<style>
    .pagination {
    margin-bottom: 0;
    gap: 6px;
    flex-wrap: wrap;
}
.pagination .page-link {
    color: #0d6efd;
    border-radius: 6px;
    margin: 0 2px;
    font-size: 0.875rem;
}
.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}
.pagination .page-link:hover {
    background-color: #e7f1ff;
}
.pagination .page-item.disabled .page-link {
    color: #adb5bd;
}
</style>
<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="#" aria-label="adminHMD dashboard">
          <span class="brand-icon"><i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
        </span>
          <span class="brand-copy">
            <span class="brand-title">RUANG SARJANA</span>
            <span class="brand-subtitle">E-Commers</span>
          </span>
        </a>
      </div>

      <nav class="sidebar-nav">
        <a class="nav-link {{ $menuAdminDashboard ?? '' }}" href="{{ route('dashboard') }}">
          <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
          <span class="nav-text">Dashboard</span>
        </a>
        <a class="nav-link {{ $menuAdminPelanggan ?? '' }}" href="{{ route('pelanggan') }}">
          <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
          <span class="nav-text">Pelanggan</span>
        </a>
        <a class="nav-link {{ $menuAdminJas ?? '' }}" href="{{ route('jas') }}">
          <span class="nav-icon"><i class="bi bi-suitcase" aria-hidden="true"></i></span>
          <span class="nav-text">
            Data Jas
        </span>
        </a>
        <a class="nav-link {{ $menuAdminPemesanan ?? '' }}" href="{{ route('pemesanan') }}">
          <span class="nav-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
          <span class="nav-text">Pemesanan</span>
        </a>
      </nav>
    </aside>

    <div class="admin-main">
      @include('layouts.navbar')

      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          @yield('content')
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>&copy; 2026 Ruang Sarjana.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/main.js') }}"></script>

  {{-- Sweetalert2 --}}
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    @session('success')
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endsession

    @session('error')
        <script>
            Swal.fire({
                title: "Gagal",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endsession

    <script>
        $(document).ready(function() {
            // Aktifkan dropdown
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>
</html>
