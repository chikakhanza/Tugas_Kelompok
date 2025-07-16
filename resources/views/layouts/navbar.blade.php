<nav
  id="layout-navbar"
  class="layout-navbar container-xxl navbar navbar-expand-xl align-items-center shadow-sm bg-gradient rounded-bottom py-2 px-4 mb-4"
  style="background: linear-gradient(to right, #fce7f3, #fbcfe8);"
>
  <!-- Toggle Sidebar (Mobile) -->
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 d-xl-none">
    <a class="nav-item nav-link px-2" href="javascript:void(0)">
      <span class="text-xl">📋</span>
    </a>
  </div>

  <!-- Search Bar -->
  <div class="navbar-nav align-items-center me-auto">
    <div class="nav-item d-flex align-items-center">
      <span class="text-xl me-2">🔍</span>
      <input
        type="text"
        class="form-control border-0 shadow-none bg-transparent"
        placeholder="Cari sesuatu..."
        aria-label="Search..."
      />
    </div>
  </div>

  <!-- Right Navbar -->
  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <!-- GitHub Star -->
    <li class="nav-item me-4 d-none d-md-block">
      <a
        href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free"
        class="btn btn-outline-dark btn-sm rounded-pill shadow-sm"
      >
        ⭐ Star
      </a>
    </li>

    <!-- Profile Dropdown -->
    <li class="nav-item dropdown dropdown-user">
      <a
        class="nav-link dropdown-toggle hide-arrow d-flex align-items-center"
        href="#"
        data-bs-toggle="dropdown"
      >
        <div class="avatar avatar-online me-2">
          <img
            src="{{ asset('assets/img/avatars/1.png') }}"
            alt="User Avatar"
            class="rounded-circle w-px-40 h-px-40 shadow-sm"
          />
        </div>
        <span class="fw-medium d-none d-md-inline">
          {{ Auth::user()->name ?? 'User' }} ⬇️
        </span>
      </a>

      <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-lg rounded-lg">
        <li class="dropdown-header text-center">
          <strong>{{ Auth::user()->name ?? 'User' }}</strong><br />
          <small class="text-muted">👑 Admin</small>
        </li>
        <li><hr class="dropdown-divider" /></li>

        <li>
          <a class="dropdown-item" href="#">🧑‍💼 Profil Saya</a>
        </li>
        <li>
          <a class="dropdown-item" href="#">⚙️ Pengaturan</a>
        </li>
        <li>
          <a
            class="dropdown-item d-flex justify-content-between align-items-center"
            href="#"
          >
            💳 Billing
            <span class="badge bg-danger rounded-pill">4</span>
          </a>
        </li>
        <li><hr class="dropdown-divider" /></li>

        <!-- Logout -->
        <li>
          <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">
              🚪 Keluar
            </button>
          </form>
        </li>
      </ul>
    </li>
  </ul>
</nav>
