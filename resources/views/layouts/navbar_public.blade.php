<nav class="navbar navbar-expand-lg sticky-top navbar-glass transition-all">
    <div class="container">
        {{-- BRAND LOGO --}}
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            <i class="fa-solid fa-hand-holding-heart me-2"></i>VolunTeam
        </a>

        {{-- TOGGLER MOBILE --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#publicNav">
            <span class="fa-solid fa-bars"></span>
        </button>

        {{-- MENU ITEMS --}}
        <div class="collapse navbar-collapse" id="publicNav">
            <ul class="navbar-nav ms-auto align-items-center">
                
                {{-- 1. MENU UMUM: Jelajah Event --}}
                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::routeIs('events.*') ? 'text-primary fw-bold' : '' }}" 
                       href="{{ route('events.index') }}">
                       Jelajah Event
                    </a>
                </li>

                @auth
                    {{-- 2. MENU KHUSUS ROLE (Tampil sesuai login) --}}
                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item me-3">
                            <a class="btn btn-dark btn-sm rounded-pill px-4 shadow-sm fw-bold" href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-user-shield me-2"></i> Admin Panel
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'organizer')
                        <li class="nav-item me-3">
                            <a class="btn btn-primary btn-sm rounded-pill px-3" href="{{ route('organizer.events') }}">
                                <i class="fa-solid fa-list-check me-2"></i> Kelola Event
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'volunteer')
                        <li class="nav-item me-3">
                            <a class="nav-link {{ Request::routeIs('applications.history') ? 'text-primary fw-bold' : '' }}" 
                               href="{{ route('applications.history') }}">
                                <i class="fa-solid fa-clock-rotate-left me-1"></i> Riwayat
                            </a>
                        </li>
                    @endif

                    {{-- 3. FITUR NOTIFIKASI (REAL-TIME DB) --}}
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link" href="#" data-bs-toggle="dropdown">
                            <div class="btn btn-light btn-sm rounded-circle position-relative text-secondary shadow-sm" 
                                 style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-regular fa-bell"></i>
                                
                                {{-- Badge Merah (Cuma muncul kalau ada notif baru) --}}
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                @endif
                            </div>
                        </a>

                        {{-- Isi Dropdown Notifikasi --}}
                        <ul class="dropdown-menu dropdown-menu-end mt-3 shadow-lg border-0 rounded-4 p-0 overflow-hidden" style="width: 320px;">
                            <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0 text-dark">Notifikasi</h6>
                                <small class="text-muted">{{ Auth::user()->unreadNotifications->count() }} Baru</small>
                            </div>
                            
                            <div style="max-height: 300px; overflow-y: auto;">
                                @forelse(Auth::user()->unreadNotifications as $notification)
                                    <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item p-3 border-bottom d-flex align-items-start gap-3" style="white-space: normal;">
                                        <div class="mt-1">
                                            {{-- Icon diambil dari data notifikasi --}}
                                            <i class="{{ $notification->data['icon'] ?? 'fa-solid fa-bell' }}"></i>
                                        </div>
                                        <div>
                                            <p class="mb-1 small fw-semibold text-dark">{{ $notification->data['message'] }}</p>
                                            <small class="text-muted" style="font-size: 10px;">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-4">
                                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-box-4064360-3363921.png" width="80" class="opacity-50 mb-2">
                                        <p class="text-muted small mb-0">Tidak ada notifikasi baru.</p>
                                    </div>
                                @endforelse
                            </div>
                            
                            {{-- Tombol 'Tandai Semua Dibaca' --}}
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <div class="p-2 text-center bg-light border-top">
                                    <small class="text-muted">Klik notifikasi untuk menandai sudah dibaca</small>
                                </div>
                            @endif
                        </ul>
                    </li>

                    {{-- 4. DROPDOWN PROFIL USER --}}
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                            <div class="position-relative">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=E0E7FF&color=4F46E5&bold=true" 
                                     class="rounded-circle border border-2 border-white shadow-sm" width="40" height="40">
                                <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1" style="width: 12px; height: 12px;"></span>
                            </div>
                            <div class="d-none d-lg-block text-start lh-1">
                                <div class="fw-bold text-dark small">{{ Str::limit(Auth::user()->name, 15) }}</div>
                                <div class="text-muted" style="font-size: 10px; text-transform: uppercase;">{{ Auth::user()->role }}</div>
                            </div>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end mt-3 shadow-lg border-0 rounded-4 p-2" style="width: 220px;">
                            <li><h6 class="dropdown-header text-uppercase text-muted" style="font-size: 10px; letter-spacing: 1px;">Akun Saya</h6></li>
                            
                            <li>
                                <a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}">
                                    <i class="fa-regular fa-user me-2 text-primary"></i> Edit Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-3 py-2" href="#" onclick="alert('Fitur Pengaturan sedang dikembangkan! 🛠️')">
                                    <i class="fa-solid fa-gear me-2 text-secondary"></i> Pengaturan
                                </a>
                            </li>
                            
                            <li><hr class="dropdown-divider my-2 opacity-10"></li>
                            
                            <li>
                                <a class="dropdown-item rounded-3 py-2 text-danger fw-bold" href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                   <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Keluar
                                </a>
                            </li>
                        </ul>
                    </li>

                @else
                    {{-- 5. JIKA BELUM LOGIN --}}
                    <li class="nav-item"><a class="nav-link fw-bold text-dark" href="{{ route('login') }}">Masuk</a></li>
                    <li class="nav-item ms-2"><a class="btn btn-primary text-white rounded-pill px-4 shadow-sm" href="{{ route('register') }}">Daftar</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>