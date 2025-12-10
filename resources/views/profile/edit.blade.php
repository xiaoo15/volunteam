@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=4f46e5&color=fff&size=128" class="rounded-circle mb-3 shadow-sm">
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 mb-3">
                    {{ ucfirst($user->role) }}
                </span>
                <p class="text-muted small px-3">
                    "{{ $user->bio ?? 'Belum ada bio.' }}"
                </p>
                <hr>
                <div class="text-start">
                    <small class="text-muted fw-bold">SKILLS:</small>
                    <div class="mt-2">
                        @if($user->skills)
                            @foreach(explode(',', $user->skills) as $skill)
                                <span class="badge bg-secondary mb-1">{{ trim($skill) }}</span>
                            @endforeach
                        @else
                            <small class="text-muted fst-italic">Belum ada skill.</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-user-pen me-2"></i>Edit Profil</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">EMAIL</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">BIO SINGKAT</label>
                            <textarea name="bio" class="form-control" rows="3" placeholder="Ceritakan sedikit tentang dirimu...">{{ $user->bio }}</textarea>
                        </div>

                        @if($user->role == 'volunteer')
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">SKILLS (Pisahkan dengan koma)</label>
                            <input type="text" name="skills" class="form-control" value="{{ $user->skills }}" placeholder="Contoh: Desain, Fotografi, Public Speaking">
                            <small class="text-muted">Contoh: Desain, Coding, Menulis</small>
                        </div>
                        @endif

                        <hr class="my-4">
                        <h6 class="fw-bold text-danger mb-3"><i class="fa-solid fa-lock me-2"></i>Ganti Password</h6>
                        <div class="alert alert-warning small">
                            Kosongkan jika tidak ingin mengubah password.
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">PASSWORD BARU</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted">KONFIRMASI PASSWORD</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection