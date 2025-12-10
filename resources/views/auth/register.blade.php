@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h4 class="fw-bold mb-0">Bergabung dengan VolunTeam 🚀</h4>
                    <p class="mb-0 opacity-75 small">Mulai perjalanan karir dan sosialmu hari ini.</p>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                            <input id="name" type="text" class="form-control form-control-lg bg-light border-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama kamu...">
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">ALAMAT EMAIL</label>
                            <input id="email" type="email" class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">DAFTAR SEBAGAI</label>
                            <select name="role" class="form-select form-select-lg bg-light border-0 @error('role') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Peran Kamu --</option>
                                <option value="volunteer">🎓 Volunteer (Siswa/Pencari Kerja)</option>
                                <option value="organizer">🏢 Organizer (Perusahaan/Panitia)</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                            <div class="form-text small">
                                Pilih <strong>Volunteer</strong> jika ingin melamar, atau <strong>Organizer</strong> jika ingin membuka lowongan.
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">PASSWORD</label>
                                <input id="password" type="password" class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-muted">ULANGI PASSWORD</label>
                                <input id="password-confirm" type="password" class="form-control form-control-lg bg-light border-0" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow">
                                DAFTAR SEKARANG
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="small text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Masuk disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection