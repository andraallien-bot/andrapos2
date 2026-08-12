<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">
  <div class="container-fluid px-4">
    <!-- Logo & Brand Brand -->
    <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('dashboard') }}">
      <div class="bg-warning text-dark d-flex align-items-center justify-content-center rounded-3 me-2 shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;">
        <i class="bi bi-shop fs-5"></i> <!-- Icon Logo -->
      </div>
      <div class="d-flex flex-column lh-1">
        <span class="fs-5 tracking-wide text-white">Andra Store</span>
        <span class="text-warning fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Golden POS</span>
      </div>
    </a>

    <!-- Toggler untuk HP -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Navbar -->
    <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-2">
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 d-flex align-items-center {{ Request::is('dashboard') ? 'active bg-warning text-dark fw-bold' : 'text-light-50' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 d-flex align-items-center {{ Request::is('admin/users*') || Request::is('users*') ? 'active bg-warning text-dark fw-bold' : 'text-light-50' }}" href="{{ route('admin.users') }}">
            <i class="bi bi-people me-2"></i> Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 d-flex align-items-center {{ Request::is('produk*') ? 'active bg-warning text-dark fw-bold' : 'text-light-50' }}" href="{{ route('produk.index') }}">
            <i class="bi bi-box-seam me-2"></i> Produk
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded-3 d-flex align-items-center {{ Request::is('penjualan*') ? 'active bg-warning text-dark fw-bold' : 'text-light-50' }}" href="{{ route('penjualan.index') }}">
            <i class="bi bi-cart-check me-2"></i> Penjualan
          </a>
        </li>
      </ul>

      <!-- Tombol Logout (Sudah Responsif & Rapi) -->
      <div class="d-flex align-items-center pt-2 pt-lg-0 border-top border-secondary border-lg-0">
        <form class="w-100" action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-danger w-100 px-4 rounded-3 d-flex align-items-center justify-content-center fw-semibold">
            <i class="bi bi-box-arrow-right me-2"></i> Keluar
          </button>
        </form>
      </div>

    </div>
  </div>
</nav>
