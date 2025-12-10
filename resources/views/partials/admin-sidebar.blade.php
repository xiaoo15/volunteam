<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100 shadow"
    style="width: 260px; position: fixed; top: 0; left: 0; z-index: 1000;">
    <a href="{{ route('admin.dashboard') }}"
        class="d-flex align-items-center mb-4 mb-md-0 me-md-auto text-white text-decoration-none">
        <div class="bg-primary rounded p-2 me-2 shadow-sm">
            <i class="fa-solid fa-user-shield fa-lg"></i>
        </div>
        <div>
            <span class="fs-5 fw-bold d-block lh-1">VolunTeam</span>
            <small class="text-white-50" style="font-size: 11px;">ADMINISTRATOR</small>
        </div>
    </a>
    <hr class="opacity-10">

    <ul class="nav nav-pills flex-column mb-auto gap-1">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link text-white {{ Request::routeIs('admin.dashboard') ? 'active bg-primary fw-bold shadow-sm' : '' }}">
                <i class="fa-solid fa-gauge me-3 text-center" style="width: 20px;"></i>
                Dashboard
            </a>
        </li>
        {{-- Perbaikan Link Mati --}}
        <li class="nav-item">
            <a href="#" onclick="alert('Fitur Manajemen User bisa diakses lewat Tabel Dashboard saat ini! 🚧')"
                class="nav-link text-white-50 hover-white">
                <i class="fa-solid fa-users me-3 text-center" style="width: 20px;"></i>
                Kelola User
            </a>
        </li>
        <li class="nav-item">
            <a href="#" onclick="alert('Fitur Manajemen Event bisa diakses lewat Tabel Dashboard saat ini! 🚧')"
                class="nav-link text-white-50 hover-white">
                <i class="fa-solid fa-calendar-check me-3 text-center" style="width: 20px;"></i>
                Kelola Event
            </a>
        </li>

        <li class="mt-4"><small class="text-uppercase text-white-50 ms-3 fw-bold"
                style="font-size: 10px;">Shortcuts</small></li>

        <li class="nav-item">
            <a href="{{ route('events.index') }}" class="nav-link text-white-50">
                <i class="fa-solid fa-arrow-up-right-from-square me-3 text-center" style="width: 20px;"></i>
                Lihat Web Utama
            </a>
        </li>
    </ul>

    <hr class="opacity-10">

    <div class="dropdown">
        <a href="#"
            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle p-2 rounded hover-bg-dark-light"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" width="32"
                height="32" class="rounded-circle me-2 border border-2 border-dark">
            <strong>{{ explode(' ', Auth::user()->name)[0] }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow border-0" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profil</a></li>
            <li><a class="dropdown-item" href="#">Pengaturan</a></li>
            <li>
                <hr class="dropdown-divider border-secondary">
            </li>
            <li>
                <a class="dropdown-item text-danger fw-bold" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
            </li>
        </ul>
    </div>
</div>

<style>
    .hover-white:hover {
        color: white !important;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
    }

    .hover-bg-dark-light:hover {
        background: rgba(255, 255, 255, 0.05);
    }
</style>