<style>
    /* NAVBAR PREMIUM STYLE */
    .navbar-premium {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        padding: 12px 0;
        /* Padding vertical ditambah dikit biar lega */
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        /* Shadow halus */
    }

    .navbar-premium.scrolled {
        padding: 10px 0;
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08);
    }

    /* Logo Section */
    .navbar-brand {
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        z-index: 2;
    }

    .logo-text {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.5rem;
        letter-spacing: -0.5px;
        background: linear-gradient(135deg, #1e293b 0%, #4f46e5 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Navigation Links */
    .navbar-nav {
        gap: 6px;
        /* Jarak antar menu */
    }

    .nav-link {
        font-weight: 600;
        color: #64748b !important;
        /* Slate-500 */
        padding: 10px 18px !important;
        border-radius: 50px;
        /* Fully rounded pill */
        transition: all 0.3s ease;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-link:hover {
        color: #4f46e5 !important;
        background-color: #f1f5f9;
        transform: translateY(-1px);
    }

    .nav-link.active {
        color: #4f46e5 !important;
        background-color: #e0e7ff;
        /* Indigo-100 */
        font-weight: 700;
    }

    .nav-link i {
        font-size: 1.1em;
        /* Icon sedikit dibesarkan */
        opacity: 0.8;
    }

    /* User & Auth Section */
    .user-section {
        gap: 24px;
        /* Jarak antara notif dan profil */
    }

    /* Auth Buttons */
    .auth-section {
        gap: 12px;
    }

    .btn-auth {
        font-weight: 700;
        padding: 10px 24px;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-login {
        color: #64748b;
        background: transparent;
        border: 1px solid transparent;
    }

    .btn-login:hover {
        color: #4f46e5;
        background: #f8fafc;
    }

    .btn-register {
        background: #4f46e5;
        color: white !important;
        box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.3);
        border: none;
    }

    .btn-register:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px 0 rgba(79, 70, 229, 0.4);
    }

    /* Notification Bell */
    .notification-wrapper .nav-link {
        padding: 8px !important;
        width: 42px;
        height: 42px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background: transparent;
        color: #64748b !important;
    }

    .notification-wrapper .nav-link:hover {
        background: #f1f5f9;
        color: #4f46e5 !important;
    }

    .notification-dot {
        position: absolute;
        top: 8px;
        right: 10px;
        width: 10px;
        height: 10px;
        background: #ef4444;
        border: 2px solid white;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    /* User Dropdown Trigger */
    .user-dropdown-toggle {
        padding: 6px 16px 6px 6px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-dropdown-toggle:hover,
    .user-dropdown-toggle[aria-expanded="true"] {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .user-info {
        line-height: 1.2;
        text-align: left;
    }

    /* Dropdown Menus */
    .dropdown-menu-premium {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        padding: 10px;
        margin-top: 15px !important;
        animation: slideInDown 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .dropdown-item {
        border-radius: 12px;
        padding: 10px 16px;
        font-weight: 500;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background: #f8fafc;
        color: #4f46e5;
        transform: translateX(4px);
    }

    .icon-box-small {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        /* Soft square icon bg */
        flex-shrink: 0;
    }

    /* Notification List Styling (Keeping functionality, improving design) */
    .notification-dropdown {
        width: 360px;
    }

    .notification-header {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .notification-list {
        max-height: 380px;
        overflow-y: auto;
    }

    .notification-item {
        padding: 14px 16px;
        border-bottom: 1px solid #f8fafc;
        transition: background 0.2s;
    }

    .notification-item:hover {
        background: #f8fafc;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4);
        }

        70% {
            box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
        }
    }

    /* Mobile Responsive */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-radius: 0 0 24px 24px;
        }

        .user-section {
            margin-top: 20px;
            width: 100%;
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .notification-bell {
            display: none;
        }

        /* Hide bell in mobile menu, maybe show in a list item instead */
        .user-dropdown-toggle {
            width: 100%;
            justify-content: center;
            border: 1px solid #e2e8f0;
            padding: 12px;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-premium sticky-top">
    <div class="container position-relative">
        
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_volunteam.png') }}" alt="VolunTeam" style="height: 40px; width: auto;">
            <span class="logo-text">VolunTeam</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none p-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml,...');"></span>
            
            <i class="fas fa-bars fa-lg text-dark"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
           
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}" href="{{ route('events.index') }}">
                        <i class="fas fa-search-location"></i> Cari Misi
                    </a>
                </li>

                @auth
                    
                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-user-shield"></i> Admin Panel
                            </a>
                        </li>
                    @endif

                    
                    @if(Auth::user()->role == 'organizer')
                        <li class="nav-item">
                            
                            <a class="nav-link {{ request()->routeIs('organizer.events') ? 'active' : '' }}" href="{{ route('organizer.events') }}">
                                <i class="fas fa-clipboard-list"></i> Kelola Misi
                            </a>
                        </li>
                    @endif

                    
                    @if(Auth::user()->role == 'volunteer')
                        <li class="nav-item">
                            
                            <a class="nav-link {{ request()->routeIs('applications.history') ? 'active' : '' }}" href="{{ route('applications.history') }}">
                                <i class="fas fa-history"></i> Jejak Kebaikan
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
            
            <div class="d-flex align-items-center user-section">
                @guest
                    <div class="d-flex auth-section">
                        <a href="{{ route('login') }}" class="btn btn-login btn-auth">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-register btn-auth">Daftar Sekarang</a>
                    </div>
                @else
                    
                    <div class="dropdown notification-wrapper">
                        <a href="#" class="nav-link position-relative" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-bell fa-lg"></i>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="notification-dot"></span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-premium notification-dropdown">
                            <div class="notification-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold text-dark">Notifikasi</h6>
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                    <span class="badge bg-primary rounded-pill shadow-sm" style="font-size: 0.7rem;">
                                        {{ Auth::user()->unreadNotifications->count() }} Baru
                                    </span>
                                @endif
                            </div>

                            <div class="notification-list">
                                @forelse(Auth::user()->notifications as $notification)
                                    @php
                                        $link = '#';
                                        if (isset($notification->data['type']) && $notification->data['type'] == 'chat') {
                                            $link = route('applications.history');
                                        }
                                    @endphp
                                    <a href="{{ $link }}"
                                        class="notification-item d-flex gap-3 text-decoration-none {{ $notification->unread() ? 'bg-primary bg-opacity-10 border-start border-3 border-primary ps-3' : 'ps-4 bg-white' }}">
                                        <div class="notification-icon rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                            style="width: 38px; height: 38px; background: {{ $notification->unread() ? 'rgba(79, 70, 229, 0.2)' : '#f1f5f9' }}">
                                            <i
                                                class="fas fa-comment-dots text-{{ $notification->unread() ? 'primary' : 'secondary' }}"></i>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <div class="fw-bold text-dark text-truncate small">
                                                {{ $notification->data['sender_name'] ?? 'Sistem' }}</div>
                                            <p class="mb-0 text-muted small text-truncate">
                                                {{ $notification->data['message'] ?? 'Pesan baru masuk' }}</p>
                                            <div class="text-muted mt-1" style="font-size: 0.7rem;">
                                                {{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="far fa-bell-slash fa-2x text-muted mb-3 opacity-50"></i>
                                        <p class="text-muted small mb-0 fw-medium">Belum ada notifikasi</p>
                                    </div>
                                @endforelse
                            </div>

                            @if(Auth::user()->notifications->count() > 0)
                                <div class="text-center p-2 border-top bg-light">
                                    <form action="{{ route('notifications.readAll') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-link btn-sm text-decoration-none fw-bold text-primary">Tandai semua
                                            dibaca</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    
                   <div class="dropdown">
    
    <a href="#" class="d-flex align-items-center text-decoration-none py-1 px-2 rounded-pill hover-bg-light transition-all" 
       data-bs-toggle="dropdown" aria-expanded="false">
     
        
        <img src="{{ Auth::user()->avatar_url }}" 
             class="rounded-circle object-fit-cover shadow-sm border border-2 border-white" 
             style="width: 40px; height: 40px;">

        
        <div class="d-none d-md-block text-start ms-2 lh-1">
            <div class="fw-bold text-dark text-truncate" style="max-width: 120px; font-size: 0.9rem;">
                {{ Auth::user()->name }}
            </div>
            <div class="text-primary fw-bold text-uppercase mt-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">
                {{ Auth::user()->role }}
            </div>
        </div>
        
        <i class="fas fa-chevron-down text-muted small ms-3 me-1"></i>
    </a>

    
    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2 p-2 overflow-hidden animate-slide-down" 
        style="width: 260px;">
        
        
        <li class="px-2 py-3 mb-2 border-bottom text-center">
            <div class="position-relative d-inline-block">
                <img src="{{ Auth::user()->avatar_url }}" 
                     class="rounded-circle shadow-sm object-fit-cover p-1 bg-white border"
                     style="width: 64px; height: 64px;">
                <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle"></span>
            </div>
            <div class="mt-2">
                <h6 class="fw-bold text-dark mb-0">{{ Auth::user()->name }}</h6>
                <small class="text-muted" style="font-size: 0.8rem;">{{ Auth::user()->email }}</small>
            </div>
        </li>

        
        <li>
            <a class="dropdown-item d-flex align-items-center gap-3 p-2 rounded-3 mb-1" href="{{ route('home') }}">
                <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3">
                    <i class="fas fa-gauge-high"></i>
                </div>
                <div>
                    <span class="fw-bold d-block text-dark small">Dashboard</span>
                    <span class="text-muted x-small">Panel Utama</span>
                </div>
            </a>
        </li>
        
        <li>
            <a class="dropdown-item d-flex align-items-center gap-3 p-2 rounded-3 mb-1" href="{{ route('profile.edit') }}">
                <div class="icon-box bg-info bg-opacity-10 text-info rounded-3">
                    <i class="fas fa-user-gear"></i>
                </div>
                <div>
                    <span class="fw-bold d-block text-dark small">Edit Profil</span>
                    <span class="text-muted x-small">Atur Akun</span>
                </div>
            </a>
        </li>

        <li><hr class="dropdown-divider my-2 opacity-10"></li>

        <li>
            <a class="dropdown-item d-flex align-items-center gap-3 p-2 rounded-3 text-danger group-hover-danger" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-3 transition-colors">
                    <i class="fas fa-arrow-right-from-bracket"></i>
                </div>
                <span class="fw-bold small">Keluar</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </li>
    </ul>
</div>

<style>
    /* CSS TAMBAHAN BIAR CANTIK */
    .hover-bg-light:hover { background-color: #f8f9fa; }
    .transition-all { transition: all 0.2s ease; }
    
    .icon-box {
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .dropdown-item {
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px); /* Geser kanan dikit pas hover */
        border-left-color: #4f46e5; /* Garis ungu di kiri */
    }
    
    /* Khusus tombol Logout pas di hover jadi merah */
    .dropdown-item.text-danger:hover {
        background-color: #fef2f2 !important; /* Merah sangat muda */
        border-left-color: #dc3545;
    }

    .x-small { font-size: 0.7rem; }

    /* Animasi Dropdown Muncul */
    .animate-slide-down {
        animation: slideDown 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        transform-origin: top right;
    }
    
    @keyframes slideDown {
        0% { opacity: 0; transform: translateY(-10px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
</style>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.querySelector('.navbar-premium');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    });
</script>