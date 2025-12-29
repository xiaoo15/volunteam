<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100 shadow"
    style="width: 260px; position: fixed; top: 0; left: 0; z-index: 1000;">

    {{-- BRAND --}}
    <a href="{{ route('admin.dashboard') }}"
        class="d-flex align-items-center mb-4 mb-md-0 me-md-auto text-white text-decoration-none px-2">
        <div class="bg-primary rounded p-2 me-3 shadow-sm d-flex align-items-center justify-content-center"
            style="width: 40px; height: 40px;">
            <i class="fa-solid fa-user-shield fa-lg text-white"></i>
        </div>
        <div class="lh-1">
            <span class="fs-5 fw-bold d-block">VolunTeam</span>
            <small class="text-white-50" style="font-size: 10px; letter-spacing: 1px;">ADMINISTRATOR</small>
        </div>
    </a>

    <hr class="opacity-10 my-3">

    {{-- NAVIGATION --}}
    <ul class="nav nav-pills flex-column mb-auto gap-1">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary fw-bold shadow-sm' : '' }}">
                <i class="fa-solid fa-gauge me-3 text-center" style="width: 20px;"></i>
                Dashboard
            </a>
        </li>

        {{-- 🔥 LINK KELOLA USER (SUDAH BENAR) 🔥 --}}
        <li class="nav-item">
            <a href="{{ route('admin.users') }}"
                class="nav-link text-white {{ request()->routeIs('admin.users') ? 'active bg-primary fw-bold shadow-sm' : '' }} hover-white">
                <i class="fa-solid fa-users me-3 text-center" style="width: 20px;"></i>
                Kelola User
            </a>
        </li>

        {{-- 🔥 LINK KELOLA EVENT (SUDAH BENAR) 🔥 --}}
        <li class="nav-item">
            <a href="{{ route('admin.events') }}"
                class="nav-link text-white {{ request()->routeIs('admin.events') ? 'active bg-primary fw-bold shadow-sm' : '' }} hover-white">
                <i class="fa-solid fa-calendar-check me-3 text-center" style="width: 20px;"></i>
                Kelola Event
            </a>
        </li>

        <li class="mt-4 mb-2">
            <small class="text-uppercase text-white-50 ms-3 fw-bold"
                style="font-size: 10px; letter-spacing: 1px;">Shortcuts</small>
        </li>

        <li class="nav-item">
            <a href="{{ route('events.index') }}" target="_blank" class="nav-link text-white-50 hover-white">
                <i class="fa-solid fa-arrow-up-right-from-square me-3 text-center" style="width: 20px;"></i>
                Lihat Web Utama
            </a>
        </li>
    </ul>

    <hr class="opacity-10 mt-auto">

    {{-- USER PROFILE --}}
    <div class="dropdown">
        <a href="#"
            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle p-2 rounded hover-bg-dark-light"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ Auth::user()->avatar_url }}" width="32" height="32"
                class="rounded-circle me-2 border border-2 border-dark shadow-sm">
            <div class="lh-1 me-auto">
                <strong class="d-block" style="font-size: 0.9rem;">{{ explode(' ', Auth::user()->name)[0] }}</strong>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow border-0 mb-2" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profil</a></li>
            <li>
                <hr class="dropdown-divider border-secondary opacity-25">
            </li>
            <li>
                <a class="dropdown-item text-danger fw-bold" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Sign out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>

<style>
    /* CSS Tambahan Biar Rapi */
    .hover-white {
        transition: all 0.2s;
        color: rgba(255, 255, 255, 0.7);
    }

    .hover-white:hover {
        color: white !important;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
    }

    .hover-bg-dark-light {
        transition: background 0.2s;
    }

    .hover-bg-dark-light:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    .nav-link.active {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        /* Gradient Ungu */
        border: none;
    }
</style>