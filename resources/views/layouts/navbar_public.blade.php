<style>
    /* NAVBAR CUSTOM STYLE */
    .navbar-custom {
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        /* Efek kaca buram */
        border-bottom: 1px solid #e2e8f0;
        padding: 15px 0;
        transition: all 0.3s ease;
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.35rem;
        color: #1e293b !important;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar-brand i {
        color: #4f46e5;
        /* Primary Color */
        font-size: 1.5rem;
    }

    /* Link Menu */
    .nav-link {
        font-weight: 500;
        color: #64748b !important;
        margin: 0 5px;
        transition: all 0.2s;
        position: relative;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #4f46e5 !important;
    }

    /* Garis bawah animasi pas hover */
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: #4f46e5;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 80%;
    }

    /* Tombol Login/Register */
    .btn-login {
        color: #4f46e5;
        font-weight: 600;
        border: 2px solid transparent;
        padding: 8px 20px;
        border-radius: 50px;
    }

    .btn-login:hover {
        background-color: rgba(79, 70, 229, 0.05);
        color: #4f46e5;
    }

    .btn-register {
        background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);
        color: white !important;
        font-weight: 600;
        padding: 8px 25px;
        border-radius: 50px;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        transition: transform 0.2s;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
    }

    /* Avatar User */
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #e2e8f0;
        object-fit: cover;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">

        {{-- LOGO DENGAN GAMBAR --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}" style="text-decoration: none;">

            {{-- 1. IKON GAMBAR (Hati Biru) --}}
            <img src="{{ asset('images/logo_volunteam.png') }}" alt="VolunTeam" style="height: 40px; width: auto;">
            {{-- Height 40px pas buat navbar --}}

            {{-- 2. TEKS KETINGAN (Biar Tajam) --}}
            <span
                style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1.5rem; letter-spacing: -0.5px; color: #1e293b;">
                Volun<span style="color: #4f46e5;">Team</span>
            </span>

        </a>
        {{-- TOGGLER MOBILE --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- MENU UTAMA --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto align-items-center mt-3 mt-lg-0">

                {{-- Link Umum --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}"
                        href="{{ route('events.index') }}">Cari Lowongan</a>
                </li>

                {{-- Link Khusus Organizer --}}
                @auth
                    @if(Auth::user()->role == 'organizer')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('organizer.events') ? 'active' : '' }}"
                                href="{{ route('organizer.events') }}">Kelola Event</a>
                        </li>
                    @endif

                    {{-- Link Khusus Volunteer --}}
                    @if(Auth::user()->role == 'volunteer')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('applications.history') ? 'active' : '' }}"
                                href="{{ route('applications.history') }}">Riwayat Lamaran</a>
                        </li>
                    @endif
                @endauth
            </ul>

            {{-- BAGIAN KANAN (AUTH) --}}
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                @guest
                    {{-- Kalau Belum Login --}}
                    <a href="{{ route('login') }}" class="btn-login text-decoration-none">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-register text-decoration-none">Daftar Sekarang</a>
                @else
                    {{-- Kalau Sudah Login --}}

                    {{-- Notifikasi (Icon Lonceng) --}}
                    <div class="dropdown">
                        <a href="#" class="text-secondary position-relative me-3" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-bell fs-5"></i>

                            {{-- 🔥 PERBAIKAN: Cuma muncul kalau ada notif unread --}}
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-0 rounded-4 overflow-hidden"
                            style="width: 320px;">
                            <li class="p-3 bg-light border-bottom">
                                <h6 class="dropdown-header text-uppercase small fw-bold p-0 m-0 text-dark">Notifikasi</h6>
                            </li>

                            <div style="max-height: 300px; overflow-y: auto;">
                                {{-- 🔥 LOOPING NOTIFIKASI REAL DARI DATABASE --}}
                                @forelse(Auth::user()->unreadNotifications as $notification)
                                    <li>
                                        <a class="dropdown-item py-3 border-bottom text-wrap"
                                            href="{{ route('notifications.read', $notification->id) }}">
                                            <div class="d-flex gap-3">
                                                <div class="mt-1">
                                                    {{-- Icon beda warna tergantung tipe notif (opsional, default biru) --}}
                                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 30px; height: 30px;">
                                                        <i class="fa-solid fa-bell"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    {{-- Ambil pesan dari data notifikasi --}}
                                                    <div class="small fw-bold text-dark mb-1">
                                                        {{ $notification->data['message'] ?? 'Ada notifikasi baru!' }}
                                                    </div>
                                                    <div class="text-muted" style="font-size: 10px;">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    {{-- Kalau Kosong --}}
                                    <li class="text-center text-muted small py-5">
                                        <i class="fa-regular fa-bell-slash fs-4 mb-2 opacity-50"></i><br>
                                        Belum ada notifikasi baru.
                                    </li>
                                @endforelse
                            </div>

                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <li class="text-center p-2 bg-light border-top">
                                    <a href="#" class="small text-decoration-none fw-bold text-primary">Tandai semua dibaca</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    {{-- Dropdown Profil User --}}
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none gap-2 dropdown-toggle-no-caret"
                            data-bs-toggle="dropdown">
                            <div class="text-end d-none d-md-block">
                                <div class="fw-bold text-dark small mb-0">{{ Auth::user()->name }}</div>
                                <div class="text-muted small" style="font-size: 10px;">{{ ucfirst(Auth::user()->role) }}
                                </div>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4f46e5&color=fff"
                                class="user-avatar shadow-sm">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-2 p-2">
                            <li>
                                <a class="dropdown-item rounded-3 py-2" href="{{ route('home') }}">
                                    <i class="fa-solid fa-gauge-high me-2 text-primary"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}">
                                    <i class="fa-solid fa-user-gear me-2 text-info"></i> Edit Profil
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item rounded-3 py-2 text-danger fw-bold" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
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