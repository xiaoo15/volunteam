@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0 overflow-hidden bg-white" style="height: calc(100vh - 80px);">
        <div class="row h-100 g-0">

            {{-- BAGIAN KIRI: FORM --}}
            <div class="col-lg-5 d-flex flex-column justify-content-center align-items-center p-5 position-relative">
                <div class="w-100" style="max-width: 420px;">
                    <div class="text-center mb-5">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-right-to-bracket fa-xl"></i>
                        </div>
                        <h2 class="fw-bold text-dark">Selamat Datang Kembali</h2>
                        <p class="text-muted">Lanjutkan misi kebaikanmu hari ini.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">EMAIL ADDRESS</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fa-regular fa-envelope text-muted"></i></span>
                                <input type="email" name="email"
                                    class="form-control bg-light border-start-0 ps-0 @error('email') is-invalid @enderror"
                                    placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">PASSWORD</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fa-solid fa-lock text-muted"></i></span>
                                <input type="password" name="password"
                                    class="form-control bg-light border-start-0 ps-0 @error('password') is-invalid @enderror"
                                    placeholder="••••••••" required>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small text-decoration-none fw-bold">Lupa
                                    Password?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm mb-4">
                            Masuk Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>

                        <div class="text-center">
                            <p class="small text-muted mb-0">Belum punya akun? <a href="{{ route('register') }}"
                                    class="fw-bold text-decoration-none">Daftar sebagai Relawan</a></p>
                        </div>
                    </form>
                </div>

                {{-- Footer Kecil --}}
                <div class="position-absolute bottom-0 mb-4 text-center w-100">
                    <small class="text-muted opacity-50">&copy; {{ date('Y') }} VolunTeam Indonesia</small>
                </div>
            </div>

            {{-- BAGIAN KANAN: GAMBAR & QUOTE (Hidden di HP) --}}
            <div class="col-lg-7 d-none d-lg-block position-relative bg-dark">
                {{-- Background Image Overlay --}}
                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                    class="w-100 h-100 object-fit-cover opacity-50" alt="Login Cover">

                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.8) 100%);"></div>

                <div class="position-absolute bottom-0 start-0 p-5 text-white mb-5">
                    <div class="mb-3">
                        <i class="fa-solid fa-quote-left fa-2x text-warning opacity-75"></i>
                    </div>
                    <h2 class="fw-bold display-6 mb-3">"Satu-satunya cara untuk melakukan pekerjaan hebat adalah dengan
                        mencintai apa yang Anda lakukan."</h2>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="bg-white text-dark rounded-circle p-1 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Steve Jobs</h6>
                            <small class="text-white-50">Visionary</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection