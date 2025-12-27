@extends('layouts.app')

@section('content')
{{-- BACKGROUND HEADER --}}
<div class="profile-header-bg position-absolute top-0 start-0 w-100" style="height: 250px; z-index: 0; background: linear-gradient(135deg, #4f46e5 0%, #6366f1 50%, #818cf8 100%);"></div>

<div class="container position-relative py-5" style="z-index: 1; margin-top: 50px;">
    {{-- 🔥 TAMBAHAN: ENCTYPE MULTIPART WAJIB BUAT UPLOAD --}}
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="row g-4 justify-content-center">
            
            {{-- 1. LEFT SIDEBAR (AVATAR UPLOAD) --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden text-center h-100 bg-white">
                    <div class="card-body p-0">
                        {{-- Cover Mini --}}
                        <div class="bg-light" style="height: 120px;"></div>
                        
                        {{-- 🔥 AVATAR UPLOADER AREA --}}
                        <div class="px-4 mt-n5 position-relative">
                            <div class="avatar-upload-wrapper d-inline-block position-relative">
                                {{-- Preview Image --}}
                                <img id="avatarPreview" 
                                     src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=ffffff&color=4f46e5&size=128&bold=true' }}" 
                                     class="rounded-circle shadow-lg border border-4 border-white bg-white object-fit-cover" 
                                     style="width: 130px; height: 130px;"
                                     alt="Profile">
                                
                                {{-- Tombol Kamera (Overlay) --}}
                                <label for="avatarInput" class="avatar-overlay position-absolute top-0 start-0 w-100 h-100 rounded-circle d-flex align-items-center justify-content-center cursor-pointer">
                                    <i class="fa-solid fa-camera text-white fa-2x opacity-0 icon-camera"></i>
                                </label>

                                {{-- Input File Tersembunyi --}}
                                <input type="file" name="avatar" id="avatarInput" class="d-none" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>

                        <div class="p-4">
                            <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                            <span class="badge bg-indigo-subtle text-indigo rounded-pill px-3 py-1 text-uppercase x-small fw-bold ls-1">
                                {{ $user->role }}
                            </span>
                            <p class="text-muted small px-2 mt-3 mb-0">
                                Klik foto di atas untuk mengganti avatar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. RIGHT CONTENT: FORM --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-white border-0 py-4 px-4 border-bottom">
                        <h5 class="fw-bold text-dark mb-0">Edit Profil</h5>
                        <p class="text-muted small mb-0">Update info pribadimu.</p>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        {{-- Info Dasar --}}
                        <div class="mb-5">
                            <h6 class="text-uppercase text-indigo fw-bold x-small ls-1 mb-3">Informasi Dasar</h6>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                                        <label for="name">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                                        <label for="email">Alamat Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="bio" class="form-control" id="bio" style="height: 100px">{{ $user->bio }}</textarea>
                                        <label for="bio">Bio Singkat</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Skills --}}
                        @if($user->role == 'volunteer')
                            <div class="mb-5">
                                <h6 class="text-uppercase text-indigo fw-bold x-small ls-1 mb-3">Skills</h6>
                                <div class="form-floating">
                                    <input type="text" name="skills" class="form-control" id="skills" value="{{ $user->skills }}">
                                    <label for="skills">Skills (Pisahkan koma)</label>
                                </div>
                            </div>
                        @endif

                        {{-- Password --}}
                        <div class="bg-warning-subtle p-4 rounded-3 border border-warning-subtle mb-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="fa-solid fa-lock text-warning"></i>
                                <h6 class="fw-bold text-dark mb-0">Ganti Password</h6>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control bg-white" id="new_password" placeholder="Pass">
                                        <label>Password Baru</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" name="password_confirmation" class="form-control bg-white" id="conf_password" placeholder="Konfirm">
                                        <label>Ulangi Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-light rounded-pill px-4 fw-bold text-muted">Reset</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-lg hover-scale">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .ls-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    
    /* INPUT STYLING */
    .form-control {
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        border-radius: 12px;
        color: #1e293b;
    }
    .form-control:focus {
        background-color: #fff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    .form-floating > label { color: #64748b; }

    /* AVATAR HOVER EFFECT */
    .avatar-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .avatar-upload-wrapper:hover .avatar-overlay {
        opacity: 1;
    }
    .avatar-upload-wrapper:hover .icon-camera {
        opacity: 1 !important;
    }
    .cursor-pointer { cursor: pointer; }

    /* UTILS */
    .bg-indigo-subtle { background-color: #e0e7ff; }
    .text-indigo { color: #4338ca; }
    .bg-warning-subtle { background-color: #fffbeb; }
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: scale(1.02); }
</style>

<script>
    // Script buat Preview Gambar sebelum diupload
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection