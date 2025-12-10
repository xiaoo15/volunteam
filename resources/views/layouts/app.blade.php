<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'VolunTeam') }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root { --primary: #4f46e5; --bg-color: #f8fafc; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-color); min-height: 100vh; display: flex; flex-direction: column; }
        
        /* Navbar Awal (Glass effect dikit) */
        .navbar-glass { 
            background: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(8px); 
            border-bottom: 1px solid transparent;
            transition: all 0.3s ease; /* Animasi halus */
        }
        
        /* Navbar Pas Scroll (Putih Solid & Shadow) */
        .navbar-scrolled {
            background: rgba(255, 255, 255, 1) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }

        .nav-link { color: #64748b; font-weight: 500; }
        .nav-link:hover { color: var(--primary); }
    </style>
</head>
<body>

    @if(Request::is('admin*') && Auth::check() && Auth::user()->role == 'admin')
        {{-- Layout Admin Tetap Sama --}}
        <div class="d-flex">
            @include('partials.admin-sidebar')
            <div class="flex-grow-1" style="margin-left: 260px; min-height: 100vh; background-color: #f3f4f6;">
                <nav class="navbar navbar-light bg-white px-4 border-bottom shadow-sm sticky-top">
                    <span class="fw-bold text-dark"><i class="fa-solid fa-gauge me-2"></i>Dashboard Area</span>
                    <div class="ms-auto">
                        <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Web Utama
                        </a>
                    </div>
                </nav>
                <div class="container-fluid pt-4 px-4">
                    @include('layouts.alerts')
                    @yield('content')
                </div>
                <footer class="text-center py-4 text-muted small mt-auto">
                    &copy; {{ date('Y') }} VolunTeam Admin System
                </footer>
            </div>
        </div>
    @else
        {{-- Layout Public --}}
        @include('layouts.navbar_public')
        
        <div class="flex-grow-1">
            {{-- Container buat alerts biar rapi --}}
            @if(session('success') || session('error'))
            <div class="container mt-4">
                @include('layouts.alerts')
            </div>
            @endif
            
            @yield('content')
        </div>
        
        @include('partials.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

    {{-- SCRIPT SCROLL NAVBAR --}}
    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar-glass');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }
            }
        });
    </script>

</body>
</html>