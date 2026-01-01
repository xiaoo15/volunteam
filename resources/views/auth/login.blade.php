@extends('layouts.app')

@section('content')

{{-- 
    NOTE: Saya ganti 'min-vh-100' jadi 'py-5 my-5' 
    biar dia gak maksa full screen 100% yang bikin Navbar kegeser ke atas.
    Sisanya SAMA PERSIS.
--}}
<div class="container-fluid bg-light d-flex align-items-center justify-content-center py-5 my-5">
    
    <div class="login-card bg-white p-4 p-md-5 rounded-4 shadow-sm" style="max-width: 420px; width: 100%;">
        
        
        <div class="text-center mb-4">
            <a href="{{ url('/') }}" class="d-inline-block mb-3">
                <img src="{{ asset('images/logo_volunteam.png') }}" alt="Logo" height="50">
            </a>
            <h4 class="fw-bold text-dark">Login VolunTeam</h4>
            <p class="text-muted small">Silakan masuk untuk melanjutkan.</p>
        </div>

        
        @if ($errors->any())
            <div class="alert alert-danger border-0 d-flex align-items-center gap-2 mb-4 p-2 rounded-3 small">
                <i class="fas fa-exclamation-circle"></i>
                <div>Email atau password salah.</div>
            </div>
        @endif

        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            
            <div class="mb-3">
                <label for="email" class="form-label fw-bold small text-secondary">Email Address</label>
                <input type="email" name="email" class="form-control form-control-lg fs-6 bg-light border-0" 
                       id="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
            </div>

            
            <div class="mb-3 position-relative">
                <label for="password" class="form-label fw-bold small text-secondary">Password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control form-control-lg fs-6 bg-light border-0" 
                           id="password" placeholder="••••••••" required>
                    <button class="btn btn-light border-0 text-muted" type="button" onclick="togglePassword()">
                        <i class="far fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="small text-decoration-none fw-bold text-primary" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill shadow-sm mb-3">
                Masuk
            </button>

            
            <div class="text-center mb-3 position-relative">
                <hr class="m-0 border-secondary opacity-10">
                <span class="position-absolute top-50 start-50 translate-middle bg-white px-2 small text-muted">atau</span>
            </div>

            
            <div class="text-center">
                <p class="text-muted small mb-0">Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar disini</a>
                </p>
            </div>
        </form>
    </div>

</div>


<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>


<style>
    /* CSS YANG SEMBUNYIIN NAVBAR UDAH DIHAPUS DISINI */
    
    .form-control:focus {
        box-shadow: none;
        background-color: #fff !important;
        border: 1px solid #4f46e5 !important;
    }
    .input-group .btn-light {
        background-color: #f8f9fa;
    }
</style>

@endsection