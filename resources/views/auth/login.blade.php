@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="width: 100%; max-width: 450px;">
        <div class="card-body">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Selamat Datang! 👋</h3>
                <p class="text-muted">Silakan masuk untuk melanjutkan misi kebaikanmu.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold small text-secondary">ALAMAT EMAIL</label>
                    <input id="email" type="email" class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold small text-secondary">PASSWORD</label>
                    <input id="password" type="password" class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="********">
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow">
                        MASUK SEKARANG
                    </button>
                </div>

                <div class="text-center">
                    <p class="small text-muted">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Daftar disini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection