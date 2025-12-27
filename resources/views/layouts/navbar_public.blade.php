<style>
    /* NAVBAR PREMIUM STYLE */
    .navbar-premium {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        padding: 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .navbar-premium.scrolled {
        padding: 0;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.08);
    }

    /* Logo Section */
    .navbar-brand {
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 0;
        position: relative;
        z-index: 2;
    }

    .logo-text {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        font-weight: 800;
        font-size: 1.65rem;
        letter-spacing: -0.5px;
        background: linear-gradient(135deg, #1e293b 0%, #4f46e5 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }

    .logo-text::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, #4f46e5, #818cf8);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover .logo-text::after {
        transform: scaleX(1);
    }

    /* Navigation Links */
    .navbar-nav {
        gap: 2px;
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        font-weight: 600;
        color: #64748b !important;
        padding: 12px 20px !important;
        border-radius: 10px;
        transition: all 0.3s ease;
        position: relative;
        font-size: 0.95rem;
        margin: 0 2px;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(129, 140, 248, 0.1) 100%);
        border-radius: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #4f46e5 !important;
        transform: translateY(-1px);
    }

    .nav-link:hover::before,
    .nav-link.active::before {
        opacity: 1;
    }

    .nav-link i {
        margin-right: 8px;
        font-size: 0.9em;
        opacity: 0.7;
    }

    /* Mobile Toggler */
    .navbar-toggler {
        border: none;
        padding: 10px;
        border-radius: 10px;
        background: transparent;
        position: relative;
        z-index: 2;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2831, 41, 55, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        width: 24px;
        height: 24px;
    }

    /* Auth Buttons */
    .auth-section {
        gap: 12px;
    }

    .btn-auth {
        font-weight: 600;
        padding: 10px 24px;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .btn-login {
        color: #4f46e5;
        background: rgba(79, 70, 229, 0.08);
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .btn-login:hover {
        background: rgba(79, 70, 229, 0.12);
        border-color: rgba(79, 70, 229, 0.4);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }

    .btn-register {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 50%, #818cf8 100%);
        color: white !important;
        border: none;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
        background: linear-gradient(135deg, #4338ca 0%, #4f46e5 50%, #6366f1 100%);
    }

    /* User Section */
    .user-section {
        gap: 20px;
        align-items: center;
    }

    /* Notification Bell */
    .notification-wrapper {
        position: relative;
    }

    .notification-bell {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(226, 232, 240, 0.5);
        border-radius: 10px;
        color: #64748b;
        transition: all 0.3s ease;
        position: relative;
    }

    .notification-bell:hover {
        background: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
        transform: translateY(-1px);
    }

    .notification-dot {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border-radius: 50%;
        border: 2px solid white;
        animation: pulse 2s infinite;
    }

    /* User Profile */
    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 12px;
        background: rgba(226, 232, 240, 0.5);
        border-radius: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .user-profile:hover {
        background: white;
        border-color: rgba(79, 70, 229, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transform: translateY(-1px);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .user-info {
        line-height: 1.3;
    }

    .user-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.9rem;
    }

    .user-role {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: capitalize;
    }

    /* Dropdown Menus */
    .dropdown-menu-premium {
        border: none;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(31, 38, 135, 0.15);
        padding: 8px;
        margin-top: 12px !important;
        background: white;
        animation: dropdownSlide 0.3s ease;
    }

    @keyframes dropdownSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item-premium {
        padding: 12px 16px;
        border-radius: 12px;
        margin: 2px 0;
        font-weight: 500;
        color: #475569;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dropdown-item-premium:hover {
        background: rgba(79, 70, 229, 0.08);
        color: #4f46e5;
        transform: translateX(4px);
    }

    .dropdown-item-premium i {
        width: 20px;
        text-align: center;
        opacity: 0.7;
    }

    /* Notification Dropdown */
    .notification-dropdown {
        width: 380px;
        max-height: 500px;
        overflow: hidden;
    }

    .notification-header {
        padding: 16px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e2e8f0;
    }

    .notification-item {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }

    .notification-item:hover {
        background: #f8fafc;
    }

    .notification-item.unread {
        background: rgba(79, 70, 229, 0.04);
        border-left: 3px solid #4f46e5;
    }

    .notification-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
        font-size: 0.9rem;
    }

    .notification-time {
        font-size: 0.75rem;
        color: #94a3b8;
    }

    /* Mobile Menu */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            position: fixed;
            top: 0;
            right: -100%;
            width: 320px;
            height: 100vh;
            background: white;
            padding: 80px 24px 24px;
            box-shadow: -20px 0 40px rgba(0, 0, 0, 0.1);
            transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
            overflow-y: auto;
        }

        .navbar-collapse.show {
            right: 0;
        }

        .nav-link {
            padding: 14px 16px !important;
            margin: 4px 0;
        }

        .auth-section {
            flex-direction: column;
            width: 100%;
            margin-top: 24px;
        }

        .btn-auth {
            width: 100%;
            justify-content: center;
        }

        .user-section {
            flex-direction: column;
            align-items: stretch;
            margin-top: 24px;
        }

        .notification-wrapper {
            width: 100%;
        }

        .notification-bell {
            width: 100%;
            justify-content: center;
        }

        .user-profile {
            width: 100%;
            justify-content: center;
        }

        .dropdown-menu-premium {
            position: static !important;
            transform: none !important;
            width: 100%;
            box-shadow: none;
            margin-top: 8px !important;
        }
    }

    /* Scroll Animation */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    /* Active State Indicator */
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 8px;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 3px;
        background: linear-gradient(90deg, #4f46e5, #818cf8);
        border-radius: 2px;
    }

    /* Backdrop for mobile */
    .navbar-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 0;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .navbar-backdrop.show {
        opacity: 1;
        visibility: visible;
    }

    .dropdown-toggle-custom:hover,
    .dropdown-toggle-custom[aria-expanded="true"] {
        background-color: #f8fafc;
        border-color: #e2e8f0 !important;
    }

    .hover-bg-light:hover {
        background-color: #f8fafc;
        color: #4f46e5;
        /* Primary Color */
    }

    .hover-bg-danger-soft:hover {
        background-color: #fef2f2;
        color: #dc2626 !important;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (min-width: 992px) {

        /* Saat class .dropdown di-hover, cari .dropdown-menu di dalamnya */
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            /* Biar nempel sama tombolnya */
            animation: fadeInUp 0.2s ease-out;
        }

        /* Opsional: Tambah jarak transparan biar mouse gak gampang lepas pas pindah ke menu */
        .dropdown-menu {
            margin-top: 0;
        }
    }

    /* Animasi Muncul Halus */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 10px, 0);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-premium sticky-top">
    <div class="container position-relative">
        <div class="navbar-backdrop" id="navbarBackdrop"></div>

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_volunteam.png') }}" alt="VolunTeam" style="height: 40px; width: auto;">
            <span class="logo-text">VolunTeam</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="fa-solid fa-home"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}"
                        href="{{ route('events.index') }}">
                        <i class="fa-solid fa-search"></i> Cari Lowongan
                    </a>
                </li>

                @auth
                    @if(Auth::user()->role == 'organizer')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('organizer.events') ? 'active' : '' }}"
                                href="{{ route('organizer.events') }}">
                                <i class="fa-solid fa-calendar-check"></i> Kelola Event
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->role == 'volunteer')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('applications.history') ? 'active' : '' }}"
                                href="{{ route('applications.history') }}">
                                <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Lamaran
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="d-flex align-items-center user-section">
                @guest
                    <div class="d-flex auth-section">
                        <a href="{{ route('login') }}" class="btn btn-login text-decoration-none btn-auth">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-register text-decoration-none btn-auth">
                            Daftar Sekarang
                        </a>
                    </div>
                @else
                    <div class="dropdown notification-wrapper">
                        <a href="#" class="notification-bell text-decoration-none" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-bell fa-lg"></i>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="notification-dot"></span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-premium notification-dropdown">
                            <div class="notification-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold">Notifikasi</h6>
                                    @if(Auth::user()->unreadNotifications->count() > 0)
                                        <span
                                            class="badge bg-primary rounded-pill">{{ Auth::user()->unreadNotifications->count() }}
                                            Baru</span>
                                    @endif
                                </div>
                            </div>

                            <div style="max-height: 400px; overflow-y: auto;">
                                {{-- LOOPING DATA DARI DATABASE --}}
                                @forelse(Auth::user()->notifications as $notification)
                                    <a href="{{ route('notifications.read', $notification->id) }}"
                                        class="notification-item d-flex gap-3 text-decoration-none {{ $notification->unread() ? 'unread' : '' }}">

                                        {{-- Icon Berubah Tergantung Status --}}
                                        <div class="notification-icon"
                                            style="background: {{ $notification->unread() ? 'rgba(79, 70, 229, 0.1)' : '#f1f5f9' }}">
                                            <i
                                                class="fa-solid fa-envelope text-{{ $notification->unread() ? 'primary' : 'secondary' }}"></i>
                                        </div>

                                        <div class="notification-content">
                                            <div class="notification-title">
                                                {{ $notification->data['message'] ?? 'Pesan baru masuk' }}
                                            </div>
                                            <div class="notification-time">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="fa-regular fa-bell-slash fa-2x text-muted mb-3 opacity-50"></i>
                                        <p class="text-muted small mb-0">Belum ada notifikasi</p>
                                    </div>
                                @endforelse
                            </div>

                            @if(Auth::user()->notifications->count() > 0)
                                <div class="text-center p-3 border-top">
                                    <a href="#" class="small text-primary fw-bold text-decoration-none">
                                        Tandai semua dibaca
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="dropdown">
                        <a href="#"
                            class="d-flex align-items-center text-decoration-none dropdown-toggle-custom gap-2 py-1 pe-2 ps-1 rounded-pill"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="transition: all 0.2s; border: 1px solid transparent;">

                            {{-- 🔥 LOGIKA AVATAR DINAMIS 🔥 --}}
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=4f46e5&color=fff&size=128&font-size=0.4&bold=true' }}"
                                class="rounded-circle shadow-sm object-fit-cover"
                                style="width: 38px; height: 38px; border: 2px solid #fff;" alt="{{ Auth::user()->name }}">

                            {{-- User Info (Desktop Only) --}}
                            <div class="d-none d-md-block text-start lh-1 me-1">
                                <div class="fw-bold text-dark" style="font-size: 0.85rem;">
                                    {{ Str::limit(Auth::user()->name, 15) }}</div>
                                <div class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">
                                    {{ Auth::user()->role }}</div>
                            </div>

                            {{-- Chevron Icon --}}
                            <i class="fa-solid fa-chevron-down text-muted small d-none d-md-block ms-1"
                                style="font-size: 0.7rem;"></i>
                        </a>

                        {{-- Dropdown Menu --}}
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2 p-2"
                            style="width: 240px; animation: fadeInUp 0.2s ease-out;">

                            {{-- Header Mobile Only --}}
                            <li class="d-block d-md-none px-3 py-2 border-bottom mb-2 text-center">
                                {{-- Avatar Besar di Mobile Menu --}}
                                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=4f46e5&color=fff&size=128&bold=true' }}"
                                    class="rounded-circle mb-2 shadow-sm object-fit-cover"
                                    style="width: 60px; height: 60px;">
                                <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                                <div class="small text-muted text-uppercase">{{ Auth::user()->role }}</div>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3 px-3 py-2 rounded-3 mb-1 hover-bg-light"
                                    href="{{ route('home') }}">
                                    <div class="icon-box-small bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px;">
                                        <i class="fa-solid fa-gauge-high fa-sm"></i>
                                    </div>
                                    <span class="fw-medium small">Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3 px-3 py-2 rounded-3 mb-1 hover-bg-light"
                                    href="{{ route('profile.edit') }}">
                                    <div class="icon-box-small bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px;">
                                        <i class="fa-solid fa-user-gear fa-sm"></i>
                                    </div>
                                    <span class="fw-medium small">Edit Profil</span>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider my-2 opacity-50">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3 px-3 py-2 rounded-3 hover-bg-danger-soft text-danger"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="icon-box-small bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px;">
                                        <i class="fa-solid fa-right-from-bracket fa-sm"></i>
                                    </div>
                                    <span class="fw-bold small">Keluar</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>


                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.querySelector('.navbar-premium');
        const backdrop = document.getElementById('navbarBackdrop');
        const navbarCollapse = document.querySelector('.navbar-collapse');

        // Scroll effect
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu backdrop
        const navbarToggler = document.querySelector('.navbar-toggler');
        navbarToggler.addEventListener('click', function () {
            backdrop.classList.toggle('show');
        });

        backdrop.addEventListener('click', function () {
            backdrop.classList.remove('show');
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            bsCollapse.hide();
        });

        // Close mobile menu when clicking a link
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                backdrop.classList.remove('show');
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            });
        });

        // Dropdown hover effect for desktop
        if (window.innerWidth >= 992) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('mouseenter', function () {
                    const dropdownMenu = this.querySelector('.dropdown-menu');
                    const bsDropdown = bootstrap.Dropdown.getInstance(this);
                    if (!dropdownMenu.classList.contains('show')) {
                        // Perbaikan: Pakai Bootstrap Constructor kalau instance null
                        if (bsDropdown) bsDropdown.show();
                        else new bootstrap.Dropdown(this.querySelector('[data-bs-toggle="dropdown"]')).show();
                    }
                });

                dropdown.addEventListener('mouseleave', function () {
                    const dropdownMenu = this.querySelector('.dropdown-menu');
                    const bsDropdown = bootstrap.Dropdown.getInstance(this);
                    if (dropdownMenu.classList.contains('show')) {
                        if (bsDropdown) bsDropdown.hide();
                    }
                });
            });
        }
    });
</script>