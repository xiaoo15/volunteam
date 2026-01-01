@extends('layouts.app')

@section('content')


<style>
    /* Biar selector Role-nya ganteng wokwok */
    .role-selector:checked + .role-card {
        background-color: #eff6ff; 
        border-color: #4f46e5;
        color: #4f46e5;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.1), 0 2px 4px -1px rgba(79, 70, 229, 0.06);
    }
    .role-selector:checked + .role-card i {
        color: #4f46e5 !important;
    }
    .role-card {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .role-card:hover {
        border-color: #a5b4fc;
        transform: translateY(-2px);
    }
    
    .bg-pattern {
        background-color: #4f46e5;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
</style>

<div class="container-fluid min-vh-100 d-flex bg-white">
    <div class="row w-100 g-0">

        
        <div class="col-lg-5 d-none d-lg-flex flex-column justify-content-center p-5 bg-pattern text-white position-relative overflow-hidden">
            
            
            <div class="position-absolute top-0 end-0 bg-white opacity-10 rounded-circle" style="width: 300px; height: 300px; margin-right: -100px; margin-top: -100px; filter: blur(60px);"></div>
            <div class="position-absolute bottom-0 start-0 bg-warning opacity-10 rounded-circle" style="width: 200px; height: 200px; margin-left: -50px; margin-bottom: -50px; filter: blur(40px);"></div>

            <div class="position-relative z-1 px-4">
                <div class="mb-5">
                    <img src="{{ asset('images/logo_volunteam.png') }}" alt="Logo" height="40" class="brightness-0 invert-100 mb-4" style="filter: brightness(0) invert(1);">
                    <h1 class="display-5 fw-bold mb-3">Gabung Komunitas <br>Kebaikan Terbesar.</h1>
                    <p class="lead opacity-75">Satu akun untuk ribuan aksi sosial. Temukan misimu, kembangkan skillmu, dan perluas jaringanmu.</p>
                </div>

                
                <ul class="list-unstyled d-flex flex-column gap-3 mb-5">
                    <li class="d-flex align-items-center gap-3">
                        <div class="bg-white bg-opacity-25 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="fa-solid fa-check small"></i>
                        </div>
                        <span>Akses ke ribuan event sosial eksklusif</span>
                    </li>
                    <li class="d-flex align-items-center gap-3">
                        <div class="bg-white bg-opacity-25 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="fa-solid fa-check small"></i>
                        </div>
                        <span>Sertifikat digital terverifikasi otomatis</span>
                    </li>
                    <li class="d-flex align-items-center gap-3">
                        <div class="bg-white bg-opacity-25 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="fa-solid fa-check small"></i>
                        </div>
                        <span>Gamifikasi & Badges untuk portofolio</span>
                    </li>
                </ul>

                <div class="mt-auto">
                    <p class="small opacity-50">© 2025 VolunTeam Platform. All rights reserved.</p>
                </div>
            </div>
        </div>

        
        <div class="col-lg-7 d-flex flex-column justify-content-center align-items-center py-5 px-4 px-md-5 bg-white">
            <div class="w-100" style="max-width: 520px;">
                
                <div class="text-center text-lg-start mb-4">
                    <h3 class="fw-bold text-dark">Buat Akun Baru</h3>
                    <p class="text-muted">Lengkapi data diri di bawah ini untuk memulai.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    
                    <label class="form-label small fw-bold text-secondary mb-2">DAFTAR SEBAGAI</label>
                    <div class="row g-3 mb-4">
                        
                        <div class="col-6">
                            <input type="radio" class="btn-check role-selector" name="role" id="role_volunteer" value="volunteer" checked>
                            <label class="role-card card p-3 h-100 border-2 d-flex flex-column align-items-center justify-content-center text-center rounded-3" for="role_volunteer">
                                <i class="fa-solid fa-hand-holding-heart fs-3 text-secondary mb-2"></i>
                                <span class="fw-bold d-block">Volunteer</span>
                                <small class="text-muted d-none d-md-block" style="font-size: 0.75rem;">Saya ingin membantu</small>
                            </label>
                        </div>
                        
                        <div class="col-6">
                            <input type="radio" class="btn-check role-selector" name="role" id="role_organizer" value="organizer">
                            <label class="role-card card p-3 h-100 border-2 d-flex flex-column align-items-center justify-content-center text-center rounded-3" for="role_organizer">
                                <i class="fa-solid fa-building-ngo fs-3 text-secondary mb-2"></i>
                                <span class="fw-bold d-block">Organizer</span>
                                <small class="text-muted d-none d-md-block" style="font-size: 0.75rem;">Saya punya event</small>
                            </label>
                        </div>
                    </div>

                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">NAMA LENGKAP</label>
                            <input type="text" name="name" class="form-control bg-light border-0 py-2" placeholder="Revan Andi Laksono" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">EMAIL</label>
                            <input type="email" name="email" class="form-control bg-light border-0 py-2" placeholder="name@email.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">PASSWORD</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control bg-light border-0 py-2" placeholder="Min. 8 karakter" required>
                            <button class="btn btn-light border-0 text-muted" type="button" onclick="togglePassword('password', 'eye1')">
                                <i class="far fa-eye" id="eye1"></i>
                            </button>
                        </div>
                    </div>

                    
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">ULANGI PASSWORD</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirm" class="form-control bg-light border-0 py-2" placeholder="Ketik ulang password" required>
                            <button class="btn btn-light border-0 text-muted" type="button" onclick="togglePassword('password_confirm', 'eye2')">
                                <i class="far fa-eye" id="eye2"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-lg hover-scale">
                        Daftar Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-primary text-decoration-none">Masuk disini</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

<style>
    .hover-scale:hover { transform: scale(1.02); transition: 0.2s; }
    .btn-check:focus + .role-card {
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
    }
</style>

@endsection