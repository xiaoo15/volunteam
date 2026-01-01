@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        
        
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100 position-relative overflow-hidden">
                
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-light opacity-50" style="z-index: 0;"></div>
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fa-solid fa-trophy fa-6x text-warning"></i>
                </div>
                
                <div class="position-relative" style="z-index: 1;">
                    
                    <div class="position-relative d-inline-block mb-3 mx-auto">
                        <img src="{{ $user->avatar_url }}" class="rounded-circle shadow-lg border border-4 border-white" width="120" height="120">
                        <label for="avatarInput" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow-sm cursor-pointer hover-scale" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                    </div>

                    <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3">{{ ucfirst($user->role) }}</span>

                    
                    <div class="mb-4 px-3 mt-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-bold text-dark"><i class="fa-solid fa-bolt text-warning me-1"></i> Level 5</span>
                            <span class="small fw-bold text-primary">Guardian</span>
                        </div>
                        <div class="progress shadow-sm" style="height: 10px; border-radius: 10px; background-color: #e2e8f0;">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 75%"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted" style="font-size: 0.65rem;">2.450 XP</small>
                            <small class="text-muted" style="font-size: 0.65rem;">Target: 3.000 XP</small>
                        </div>
                    </div>

                    
                    <div class="bg-white rounded-4 p-3 shadow-sm border mb-4 text-start position-relative">
                        <h6 class="fw-bold small text-muted mb-3 text-uppercase d-flex align-items-center justify-content-between">
                            <span>Koleksi Lencana</span>
                            <i class="fa-solid fa-circle-info text-muted opacity-50" data-bs-toggle="tooltip" title="Lencana didapat dari partisipasi aktif"></i>
                        </h6>
                        
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            
                            
                            <div class="badge-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Perintis: Bergabung di Bulan Pertama Rilis">
                                <div class="badge-icon bg-warning bg-opacity-10 text-warning border-warning">
                                    <i class="fa-solid fa-crown"></i>
                                </div>
                            </div>

                            
                            <div class="badge-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Terverifikasi: Identitas & Dokumen Asli">
                                <div class="badge-icon bg-info bg-opacity-10 text-info border-info">
                                    <i class="fa-solid fa-user-shield"></i>
                                </div>
                            </div>

                            
                            <div class="badge-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Dedikasi: 50+ Jam Mengabdi">
                                <div class="badge-icon bg-danger bg-opacity-10 text-danger border-danger">
                                    <i class="fa-solid fa-fire"></i>
                                </div>
                            </div>

                            
                            <div class="badge-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Connector: Membawa 5 Teman Baru">
                                <div class="badge-icon bg-primary bg-opacity-10 text-primary border-primary">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>

                            
                            <div class="badge-item grayscale" data-bs-toggle="tooltip" data-bs-placement="top" title="LOCKED: Ikuti 5 Event Lingkungan untuk membuka">
                                <div class="badge-icon bg-light text-muted border-light">
                                    <i class="fa-solid fa-leaf"></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <p class="text-muted small mb-4 fst-italic px-2">
                        "Misi hidup saya adalah memberi dampak positif, sekecil apapun itu."
                    </p>

                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-danger btn-sm rounded-pill py-2 fw-bold" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-user-gear me-2 text-primary"></i>Pengaturan Akun</h5>
                </div>
                <div class="card-body p-4">
                    
                    @if (session('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-4 d-flex align-items-center shadow-sm">
                            <i class="fa-solid fa-circle-check me-2 fa-lg"></i> 
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        
                        <input type="file" name="avatar" id="avatarInput" class="d-none" accept="image/*" onchange="this.form.submit()">

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-bold small text-secondary">NAMA LENGKAP</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fa-solid fa-user text-muted"></i></span>
                                    <input type="text" name="name" class="form-control bg-light border-0 py-2" value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary">EMAIL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control bg-light border-0 py-2" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">BIO SINGKAT (Tampil di Profil Publik)</label>
                            <textarea class="form-control bg-light border-0" rows="3" placeholder="Ceritakan passion dan keahlianmu..."></textarea>
                        </div>

                        <hr class="my-4 opacity-10">
                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-lock me-2 text-warning"></i>Keamanan</h6>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-secondary">PASSWORD BARU</label>
                                <input type="password" name="password" class="form-control bg-light border-0 py-2" placeholder="••••••">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary">ULANGI PASSWORD</label>
                                <input type="password" name="password_confirmation" class="form-control bg-light border-0 py-2" placeholder="••••••">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('home') }}" class="btn btn-light rounded-pill px-4 fw-bold me-2">Batal</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow hover-scale">
                                <i class="fa-solid fa-save me-2"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: scale(1.05); }

    .badge-item {
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .badge-item:hover {
        transform: translateY(-5px) scale(1.1);
    }
    
    .badge-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        border: 2px solid transparent; /* Border default */
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .grayscale {
        filter: grayscale(100%);
        opacity: 0.5;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(90deg, #4f46e5 0%, #818cf8 100%);
        box-shadow: 0 2px 10px rgba(79, 70, 229, 0.3);
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection