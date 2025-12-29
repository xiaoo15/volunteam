@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0 overflow-hidden bg-white" style="height: calc(100vh - 80px);">
        <div class="row h-100 g-0 flex-row-reverse">

            {{-- BAGIAN KANAN: FORM --}}
            <div class="col-lg-5 d-flex flex-column justify-content-center align-items-center p-5 position-relative overflow-auto">
                <div class="w-100" style="max-width: 420px;">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">Gabung Gerakan Ini</h2>
                        <p class="text-muted">Buat akun barumu dan mulai buat dampak.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Pilihan Role (Visual Radio Button) --}}
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="role" id="role_volunteer" value="volunteer" checked>
                                <label class="btn btn-outline-primary w-100 py-2 rounded-3 fw-bold" for="role_volunteer">
                                    <i class="fa-solid fa-hand-holding-heart d-block mb-1 fs-5"></i> Volunteer
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="role" id="role_organizer" value="organizer">
                                <label class="btn btn-outline-primary w-100 py-2 rounded-3 fw-bold" for="role_organizer">
                                    <i class="fa-solid fa-building-ngo d-block mb-1 fs-5"></i> Organizer
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">NAMA LENGKAP</label>
                            <input type="text" name="name" class="form-control bg-light border-0 py-2 @error('name') is-invalid @enderror" placeholder="Nama Kamu" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">EMAIL</label>
                            <input type="email" name="email" class="form-control bg-light border-0 py-2 @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">PASSWORD</label>
                            <input type="password" name="password" class="form-control bg-light border-0 py-2 @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">ULANGI PASSWORD</label>
                            <input type="password" name="password_confirmation" class="form-control bg-light border-0 py-2" placeholder="Ketik ulang password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm mb-4">
                            Daftar Sekarang <i class="fa-solid fa-user-plus ms-2"></i>
                        </button>

                        <div class="text-center">
                            <p class="small text-muted mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Masuk disini</a></p>
                        </div>
                    </form>
                </div>
            </div>

            {{-- BAGIAN KIRI: GAMBAR (Hidden di HP) --}}
            <div class="col-lg-7 d-none d-lg-block position-relative bg-dark">
                <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                     class="w-100 h-100 object-fit-cover opacity-50" alt="Register Cover">

                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.8) 100%);"></div>

                <div class="position-absolute bottom-0 start-0 p-5 text-white mb-5">
                    <h2 class="fw-bold display-6 mb-3">"Relawan tidak dibayar bukan karena mereka tak bernilai, tapi karena mereka tak ternilai."</h2>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="bg-white text-dark rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fa-solid fa-heart"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Sherry Anderson</h6>
                            <small class="text-white-50">Humanitarian</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection