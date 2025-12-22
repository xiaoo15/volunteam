@extends('layouts.app')

@section('content')

{{-- LOAD FONT POPPINS KHUSUS HALAMAN INI --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* VARS & RESET */
    :root {
        --primary-color: #4f46e5;
        --primary-light: #818cf8;
        --secondary-color: #10b981;
        --accent-color: #f59e0b;
        --bg-light: #f9fafb;
        --card-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    body {
        font-family: 'Poppins', sans-serif !important; /* Paksa pakai Poppins */
        background-color: var(--bg-light);
    }

    /* CONTAINER UTAMA */
    .register-card {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        background: white;
        border: none;
        min-height: 700px;
    }

    /* BAGIAN KIRI (HERO) */
    .register-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: white;
        padding: 60px 40px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        overflow: hidden;
    }

    .hero-logo-box {
        width: 60px; height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 28px; margin-right: 15px;
        backdrop-filter: blur(5px);
    }

    .feature-item {
        display: flex; align-items: center; margin-bottom: 20px;
    }
    .feature-icon {
        width: 40px; height: 40px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin-right: 15px; font-size: 16px;
    }

    /* BACKGROUND DECORATION */
    .hero-illustration {
        position: absolute; opacity: 0.1; font-size: 300px; z-index: 1; pointer-events: none;
    }
    .hero-illustration.top-left { top: -80px; left: -80px; }
    .hero-illustration.bottom-right { bottom: -100px; right: -80px; transform: rotate(15deg); }

    /* BAGIAN KANAN (FORM) */
    .form-control-custom {
        padding: 14px 20px;
        border-radius: 12px;
        border: 2px solid #e5e7eb;
        font-size: 15px;
        height: 55px;
        transition: all 0.3s ease;
    }
    .form-control-custom:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }
    
    /* ROLE SELECTION CARDS */
    .role-selection {
        display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;
    }
    .role-option input[type="radio"] { display: none; }
    .role-option label {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        padding: 20px 15px;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%; text-align: center;
        background: #fff;
    }
    /* State Checked */
    .role-option input[type="radio"]:checked + label {
        border-color: var(--primary-color);
        background-color: rgba(79, 70, 229, 0.04);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.1);
    }
    /* Icons */
    .role-icon {
        width: 50px; height: 50px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 10px; font-size: 20px; transition: all 0.3s;
    }
    .role-volunteer .role-icon { background: rgba(16, 185, 129, 0.1); color: var(--secondary-color); }
    .role-organizer .role-icon { background: rgba(245, 158, 11, 0.1); color: var(--accent-color); }

    /* BUTTON SUBMIT */
    .btn-submit-custom {
        background: linear-gradient(to right, var(--primary-color), var(--primary-light));
        border: none; color: white;
        padding: 16px; font-size: 16px; font-weight: 600;
        border-radius: 14px; width: 100%;
        transition: all 0.3s ease;
    }
    .btn-submit-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.25);
        color: white;
    }

    /* PASSWORD TOGGLE */
    .password-wrapper { position: relative; }
    .password-toggle {
        position: absolute; right: 20px; top: 50%; transform: translateY(-50%);
        background: none; border: none; color: #9ca3af; cursor: pointer; z-index: 10;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-11">
            <div class="card register-card">
                <div class="row g-0 h-100">
                    
                    {{-- BAGIAN KIRI: HERO SECTION --}}
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="register-hero">
                            {{-- Content Hero --}}
                            <div style="position: relative; z-index: 2;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="hero-logo-box">
                                        <i class="fa-solid fa-hand-holding-heart"></i>
                                    </div>
                                    <div class="h3 fw-bold mb-0">VolunTeam</div>
                                </div>

                                <h1 class="fw-bold mb-4" style="line-height: 1.3;">Bergabung dengan Komunitas Relawan Terbesar</h1>
                                <p class="mb-5 opacity-75 lead" style="font-size: 16px;">Temukan kesempatan untuk membuat perubahan positif, kembangkan keterampilan, dan bangun jaringan.</p>

                                <div class="mb-5">
                                    <div class="feature-item">
                                        <div class="feature-icon"><i class="fa-solid fa-check"></i></div>
                                        <div>Akses ke ratusan event relawan</div>
                                    </div>
                                    <div class="feature-item">
                                        <div class="feature-icon"><i class="fa-solid fa-check"></i></div>
                                        <div>Sertifikat digital resmi</div>
                                    </div>
                                    <div class="feature-item">
                                        <div class="feature-icon"><i class="fa-solid fa-check"></i></div>
                                        <div>Komunitas yang mendukung</div>
                                    </div>
                                </div>

                                {{-- Testimonial Kecil --}}
                                <div class="bg-white bg-opacity-10 p-3 rounded-3 border border-white border-opacity-25 backdrop-blur">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Revan+R&background=random&color=fff" class="rounded-circle me-3" width="45">
                                        <div>
                                            <p class="mb-0 small fst-italic">"Website ini membantu saya menemukan passion baru!"</p>
                                            <small class="fw-bold opacity-75">- Revan, Siswa SMK</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Ilustrasi Background --}}
                            <div class="hero-illustration top-left"><i class="fa-solid fa-heart"></i></div>
                            <div class="hero-illustration bottom-right"><i class="fa-solid fa-rocket"></i></div>
                        </div>
                    </div>

                    {{-- BAGIAN KANAN: FORM REGISTER --}}
                    <div class="col-lg-7 bg-white">
                        <div class="p-4 p-md-5 h-100 d-flex flex-column justify-content-center">
                            
                            <div class="mb-4">
                                <h2 class="fw-bold text-dark mb-1">Buat Akun Baru</h2>
                                <p class="text-muted">Isi data diri Anda untuk mulai bergabung.</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                {{-- Input Nama --}}
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- Input Email --}}
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Alamat Email</label>
                                    <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- Pilihan Role (Card Style) --}}
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Daftar Sebagai</label>
                                    <div class="role-selection">
                                        {{-- Opsi Volunteer --}}
                                        <div class="role-option role-volunteer">
                                            <input type="radio" id="role_volunteer" name="role" value="volunteer" {{ old('role') == 'volunteer' ? 'checked' : 'checked' }}>
                                            <label for="role_volunteer">
                                                <div class="role-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                                                <div class="fw-bold text-dark">Volunteer</div>
                                                <small class="text-muted" style="font-size: 11px;">Cari Event</small>
                                            </label>
                                        </div>
                                        {{-- Opsi Organizer --}}
                                        <div class="role-option role-organizer">
                                            <input type="radio" id="role_organizer" name="role" value="organizer" {{ old('role') == 'organizer' ? 'checked' : '' }}>
                                            <label for="role_organizer">
                                                <div class="role-icon"><i class="fa-solid fa-calendar-days"></i></div>
                                                <div class="fw-bold text-dark">Organizer</div>
                                                <small class="text-muted" style="font-size: 11px;">Buat Event</small>
                                            </label>
                                        </div>
                                    </div>
                                    @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- Password --}}
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Password</label>
                                        <div class="password-wrapper">
                                            <input type="password" name="password" id="password" class="form-control form-control-custom @error('password') is-invalid @enderror" placeholder="Min. 8 karakter" required>
                                            <button type="button" class="password-toggle" onclick="togglePass('password')"><i class="fa-regular fa-eye"></i></button>
                                        </div>
                                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Ulangi Password</label>
                                        <div class="password-wrapper">
                                            <input type="password" name="password_confirmation" id="password-confirm" class="form-control form-control-custom" placeholder="Konfirmasi password" required>
                                            <button type="button" class="password-toggle" onclick="togglePass('password-confirm')"><i class="fa-regular fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Syarat & Ketentuan --}}
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label small text-muted" for="terms">
                                        Saya setuju dengan <a href="#" class="text-primary text-decoration-none fw-bold">Syarat & Ketentuan</a> VolunTeam.
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-submit-custom shadow-sm">
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
        </div>
    </div>
</div>

<script>
    // Script buat show/hide password
    function togglePass(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

@endsection