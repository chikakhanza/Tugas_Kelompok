<!-- =================== SIDEBAR START =================== -->
<aside id="layout-menu"
       class="layout-menu menu-vertical menu bg-light shadow-lg rounded-end-xl border-end">

  <!-- Logo / Brand -->
  <div class="app-brand demo py-4 px-3">
    <a href="{{ route('dashboard') }}" class="app-brand-link d-flex align-items-center">
      <img src="https://img.icons8.com/color/48/home-page.png" alt="logo" width="36" height="36">
      <span class="app-brand-text menu-text fw-bold ms-2 text-gradient fs-4">
        Homestay
      </span>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <!-- ===== MENU LIST ===== -->
  <ul class="menu-inner py-1">
    <!-- 1. Dashboard -->
    <li class="menu-item">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle text-primary"></i>
        <div>🏠 Dashboard</div>
      </a>
    </li>

    <!-- 2. Pengguna -->
    <li class="menu-item">
      <a href="{{ route('users.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user text-success"></i>
        <div>👤 Pengguna</div>
      </a>
    </li>

    <!-- 3. Data Kamar -->
    <li class="menu-item">
      <a href="{{ route('homestays.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-building-house text-warning"></i>
        <div>🛏️ Data Kamar</div>
      </a>
    </li>

    <!-- 4. Pemesanan -->
    <li class="menu-item">
      <a href="{{ route('bookings.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-calendar-check text-danger"></i>
        <div>📆 Pemesanan</div>
      </a>
    </li>

    <!-- 5. Pembayaran -->
    <li class="menu-item">
      <a href="{{ route('payments.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-credit-card-front text-indigo"></i>
        <div>💳 Pembayaran</div>
      </a>
    </li>

    <!-- 6. Laporan -->
    <li class="menu-item">
      <a class="menu-link" data-bs-toggle="collapse" href="#menu-laporan" role="button" aria-expanded="false" aria-controls="menu-laporan">
        <i class="menu-icon tf-icons bx bx-file text-pink"></i>
        <div>📊 Laporan</div>
        <i class="bx bx-chevron-down ms-auto"></i>
      </a>
      <ul class="collapse" id="menu-laporan">
        <li class="menu-item"><a href="{{ route('laporan.booking') }}" class="menu-link">Laporan Booking</a></li>
        <li class="menu-item"><a href="{{ route('laporan.payment') }}" class="menu-link">Laporan Payment</a></li>
        <li class="menu-item"><a href="{{ route('laporan.pendapatan') }}" class="menu-link">Laporan Pendapatan</a></li>
        <li class="menu-item"><a href="{{ route('laporan.homestay') }}" class="menu-link">Laporan Homestay</a></li>
      </ul>
    </li>

    <!-- Header tambahan -->
    <li class="menu-header mt-4">
      <span class="menu-header-text text-muted">Info Tambahan</span>
    </li>

    <!-- 7. GitHub -->
    <li class="menu-item">
      <a href="https://github.com/" class="menu-link" target="_blank">
        <i class="menu-icon tf-icons bx bxl-github text-dark"></i>
        <div>🔗 GitHub</div>
      </a>
    </li>
  </ul>
</aside>
<!-- ==================== SIDEBAR END ==================== -->

<!-- ============ STYLE “LUCU” ============ -->
<style>
  /* ---------- Gradient untuk judul brand ---------- */
  .text-gradient {
    background: linear-gradient(to right, #ec4899, #f472b6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  /* ---------- Palet pastel ---------- */
  :root {
    --cute-pink:   #f9d4e9;
    --cute-mint:   #d3f5ee;
    --cute-yellow: #fff8d6;
    --cute-blue:   #d9e9ff;
    --cute-lav:    #eadcff;
    --cute-text:   #525252;
  }

  /* ---------- Tombol dasar ---------- */
  .menu-link {
    position: relative;
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .7rem 1rem;
    border-radius: .9rem;
    font-weight: 600;
    color: var(--cute-text);
    transition: transform .18s ease, box-shadow .18s ease;
    overflow: hidden;                /* untuk ripple */
  }

  /* Hover pop */
  .menu-link:hover {
    transform: translateY(-3px) scale(1.04);
    box-shadow: 0 6px 8px rgba(0,0,0,.08);
  }

  /* Ripple lembut */
  .menu-link::after {
    content: '';
    position: absolute; inset: 0;
    background: rgba(255,255,255,.35);
    opacity: 0;
    transition: opacity .4s;
  }
  .menu-link:hover::after { opacity: 1; }

  /* Ikon sedikit lebih besar */
  .menu-link .menu-icon { font-size: 1.4rem; }

  /* Underline teks saat hover */
  .menu-link div { position: relative; }
  .menu-link:hover div::after {
    content: '';
    position: absolute; left: 0; bottom: -2px;
    width: 100%; height: 2px;
    background: currentColor;
    transform-origin: left;
    animation: slideIn .35s forwards;
  }
  @keyframes slideIn { from { transform: scaleX(0); } to { transform: scaleX(1); } }

  /* ---------- Warna berbeda per item ---------- */
  .menu-item:nth-child(1)  .menu-link { background: var(--cute-pink);   }
  .menu-item:nth-child(2)  .menu-link { background: var(--cute-mint);   }
  .menu-item:nth-child(3)  .menu-link { background: var(--cute-yellow); }
  .menu-item:nth-child(4)  .menu-link { background: var(--cute-blue);   }
  .menu-item:nth-child(5)  .menu-link { background: var(--cute-lav);    }
  .menu-item:nth-child(6)  .menu-link { background: var(--cute-pink);   }
  .menu-item:nth-child(8)  .menu-link { background: var(--cute-mint);   } /* GitHub */

  /* ---------- Styled header text ---------- */
  .menu-header-text {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  /* ---------- Sidebar collapsed (opsional) ---------- */
  @media (max-width: 768px) {
    #layout-menu.collapsed .menu-link div { display: none; }
    #layout-menu.collapsed .menu-link {
      justify-content: center;
      padding: .9rem;
    }
  }
</style>
