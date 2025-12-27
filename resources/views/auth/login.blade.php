@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">

        {{-- Brand / Logo Section (Optional but recommended) --}}
        <div class="text-center mb-4">
            {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo" height="50" class="mb-3"> --}}
            <h2 class="fw-bold text-primary">{{ config('app.name', 'VolunTeam') }}</h2>
        </div>

        <div class="card shadow-lg border-0 rounded-4 w-100 position-relative overflow-hidden" style="max-width: 480px;">
            {{-- Decorative Header Line --}}
            <div class="position-absolute top-0 start-0 w-100 h-1 bg-primary"></div>

            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-5">
                    <h4 class="fw-bold text-dark">{{ __('Welcome Back!') }} 👋</h4>
                    <p class="text-muted small mb-0">{{ __('Please sign in to continue your mission.') }}</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf

                    {{-- Email Input with Floating Label --}}
                    <div class="form-floating mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="name@example.com">
                        <label for="email">{{ __('Email Address') }}</label>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password Input with Toggle Visibility --}}
                    <div class="form-floating mb-3 position-relative">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Password">
                        <label for="password">{{ __('Password') }}</label>

                        {{-- Toggle Password Icon --}}
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                            onclick="togglePasswordVisibility()" style="cursor: pointer; z-index: 10;">
                            <i class="fa-regular fa-eye text-muted" id="toggleIcon"></i>
                        </span>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small text-muted" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="small text-decoration-none fw-bold" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>

                    {{-- Submit Button --}}
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-lg rounded-pill fw-bold shadow-sm py-3 btn-gradient">
                            {{ __('Sign In') }}
                            <i class="text-white fa-solid fa-arrow-right ms-2 icon"></i>
                        </button>
                    </div>

                    {{-- Register Link --}}
                    <div class="text-center">
                        <p class="small text-muted mb-0">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">
                                {{ __('Create Account') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        {{-- Footer Copyright --}}
        <div class="mt-4 text-center">
            <small class="text-muted opacity-50">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights
                reserved.</small>
        </div>
    </div>

    {{-- Scripts untuk Interaktivitas --}}
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

    {{-- Custom CSS untuk mempercantik (opsional jika belum ada di app.css) --}}
    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3) !important;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4f46e5;
            background-color: #f8fafc;
        }

        .form-floating>label {
            color: #94a3b8;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 50%, #818cf8 100%);
            color: white;
            border: none;
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                background-position 0.4s ease;
            background-size: 200% 200%;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 12px 25px rgba(79, 70, 229, 0.35);
            background-position: right center;
        }

        .btn-gradient:active {
            transform: translateY(0);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.25);
        }
    </style>
@endsection