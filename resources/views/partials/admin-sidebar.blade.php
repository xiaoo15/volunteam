<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100 shadow-lg border-end border-secondary border-opacity-25"
    style="width: 280px; position: fixed; top: 0; left: 0; z-index: 1050; background: #111827 !important;">

    
    <a href="{{ route('admin.dashboard') }}"
        class="d-flex align-items-center mb-4 mt-2 px-2 text-white text-decoration-none transition-scale">
        
        
        <div class="bg-white rounded-3 p-1 me-3 shadow-sm d-flex align-items-center justify-content-center logo-box">
            
            <img src="{{ asset('images/logo_volunteam.png') }}" alt="Logo" width="32" height="32" class="object-fit-contain">
        </div>
        
        <div class="lh-1">
            <span class="fs-5 fw-bold d-block tracking-tight text-white">VolunTeam</span>
            <span class="badge bg-danger bg-opacity-25 text-danger border border-danger border-opacity-25 rounded-1 mt-1 px-2 py-1" 
                  style="font-size: 9px; letter-spacing: 1px;">ADMIN PANEL</span>
        </div>
    </a>

    <hr class="opacity-10 my-3 border-secondary">

    
    <ul class="nav nav-pills flex-column mb-auto gap-2">
        
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active-gradient shadow-sm text-white' : 'text-white-50 hover-light' }}">
                <div class="icon-width text-center me-3"><i class="fa-solid fa-gauge-high"></i></div>
                <span class="fw-medium">Dashboard</span>
            </a>
        </li>

        <li class="nav-header mt-4 mb-2 px-3 text-white">
            <small class="text-uppercase text-white-50 fw-bold" style="font-size: 10px; letter-spacing: 1.2px;">Master Data</small>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('admin.users') ? 'active-gradient shadow-sm text-white' : 'text-white-50 hover-light' }}">
                <div class="icon-width text-center me-3"><i class="fa-solid fa-users"></i></div>
                <span class="fw-medium">Kelola User</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.events') }}"
                class="nav-link d-flex align-items-center {{ request()->routeIs('admin.events') ? 'active-gradient shadow-sm text-white' : 'text-white-50 hover-light' }}">
                <div class="icon-width text-center me-3"><i class="fa-solid fa-calendar-days"></i></div>
                <span class="fw-medium">Kelola Event</span>
            </a>
        </li>

        <li class="nav-header mt-4 mb-2 px-3 text-white">
            <small class="text-uppercase text-white-50 fw-bold" style="font-size: 10px; letter-spacing: 1.2px;">System</small>
        </li>

        <li class="nav-item">
            <a href="{{ route('events.index') }}" target="_blank" class="nav-link d-flex align-items-center text-white-50 hover-light">
                <div class="icon-width text-center me-3"><i class="fa-solid fa-arrow-up-right-from-square"></i></div>
                <span class="fw-medium">Lihat Website</span>
            </a>
        </li>
    </ul>

    
    <div class="mt-auto pt-3 border-top border-secondary border-opacity-25">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle p-2 rounded-3 hover-bg-dark-light transition-all"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                
                <img src="{{ Auth::user()->avatar_url }}" width="38" height="38"
                    class="rounded-circle me-3 border border-2 border-secondary shadow-sm object-fit-cover">
                
                <div class="lh-1 me-auto overflow-hidden">
                    <strong class="d-block text-truncate mb-1" style="font-size: 0.9rem;">{{ explode(' ', Auth::user()->name)[0] }}</strong>
                    <small class="text-white-50 d-block" style="font-size: 0.75rem;">Administrator</small>
                </div>
            </a>
            
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow-lg border-0 mb-2 rounded-3 overflow-hidden p-1" aria-labelledby="dropdownUser1" style="width: 100%;">
                <li><a class="dropdown-item rounded-2 py-2 small" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear me-2 text-secondary"></i> Edit Profil</a></li>
                <li><hr class="dropdown-divider border-secondary opacity-25 my-1"></li>
                <li>
                    <a class="dropdown-item text-danger fw-bold rounded-2 py-2 small" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                        <i class="fa-solid fa-power-off me-2"></i> Sign out
                    </a>
                    <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- 
    =============================================
    CSS KHUSUS SIDEBAR ADMIN
    =============================================
--}}
<style>
    /* Background Lebih Gelap & Elegan */
    .bg-dark {
        background-color: #111827 !important; /* Cool Dark Gray */
    }

    /* Logo Box Glowing Effect */
    .logo-box {
        width: 42px; height: 42px;
        transition: all 0.3s ease;
    }
    .logo-box:hover {
        transform: rotate(10deg) scale(1.1);
    }

    /* Typography */
    .tracking-tight { letter-spacing: -0.5px; }
    .icon-width { width: 24px; }

    /* Menu Item Styling */
    .nav-link {
        padding: 12px 16px;
        border-radius: 12px; /* Rounded Modern */
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.9rem;
    }

    /* Hover Effect Halus */
    .hover-light:hover {
        color: white !important;
        background-color: rgba(255, 255, 255, 0.08);
        transform: translateX(4px);
    }

    /* Active State Gradient (Keren!) */
    .active-gradient {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3) !important;
    }

    /* User Profile Hover */
    .hover-bg-dark-light:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
    .transition-scale:hover {
        opacity: 0.9;
    }
</style>