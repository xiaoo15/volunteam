@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    {{-- WELCOME HEADER --}}
    <div class="row mb-5 align-items-center">
        <div class="col-lg-8">
            <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-2">Dashboard Relawan</h6>
            <h1 class="fw-bold text-dark display-5">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-muted lead">Siap membuat perubahan kecil hari ini?</p>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <a href="{{ route('events.index') }}" class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-lg hover-scale">
                <i class="fa-solid fa-compass me-2"></i> Jelajahi Misi
            </a>
        </div>
    </div>

    {{-- STATS ROW --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-primary text-white position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="fa-solid fa-paper-plane fa-4x"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $totalApplications }}</h3>
                <small class="text-uppercase opacity-75 fw-bold letter-spacing-1">Misi Diikuti</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-dark position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fa-solid fa-clock fa-4x text-warning"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $totalHours }} <span class="fs-6 text-muted">Jam</span></h3>
                <small class="text-uppercase text-muted fw-bold letter-spacing-1">Total Kontribusi</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-dark position-relative overflow-hidden cursor-pointer hover-scale" onclick="window.location='{{ route('applications.history') }}'">
                <div class="d-flex align-items-center justify-content-between h-100">
                    <div>
                        <h6 class="fw-bold mb-1">Riwayat & Sertifikat</h6>
                        <small class="text-muted">Cek status lamaranmu</small>
                    </div>
                    <div class="bg-light rounded-circle p-3 text-primary">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 🔥 AI RECOMMENDATION SECTION 🔥 --}}
    <div class="mb-3 d-flex align-items-center gap-2">
        <div class="bg-gradient-primary text-white rounded-pill px-3 py-1 fw-bold small shadow-sm">
            <i class="fa-solid fa-robot me-1"></i> AI PICK
        </div>
        <h5 class="fw-bold text-dark mb-0">Rekomendasi Cerdas</h5>
    </div>
    <p class="text-muted mb-4 ms-1">{{ $aiMessage }}</p>

    <div class="row g-4">
        @forelse($recommendations as $event)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-up transition-all">
                    <div class="position-relative">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top object-fit-cover" height="180" alt="...">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 180px;">
                                <i class="fa-regular fa-image fa-2x opacity-25"></i>
                            </div>
                        @endif
                        <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm border">
                            {{ $event->category }}
                        </span>
                    </div>
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-2 text-truncate">{{ $event->title }}</h6>
                        <p class="text-muted small mb-3 line-clamp-2">{{ Str::limit(strip_tags($event->description), 80) }}</p>
                        
                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-location-dot text-danger small"></i>
                                <small class="text-muted fw-bold" style="font-size: 0.75rem;">{{ Str::limit($event->location, 15) }}</small>
                            </div>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light border-dashed text-center py-5 rounded-4">
                    <i class="fa-solid fa-wand-magic-sparkles fa-2x text-muted mb-3"></i>
                    <p class="mb-0 text-muted">AI kami sedang mempelajari preferensimu. Mulai lamar event yuk!</p>
                </div>
            </div>
        @endforelse
    </div>

</div>

<style>
    .hover-up:hover { transform: translateY(-5px); }
    .transition-all { transition: all 0.3s ease; }
    .bg-gradient-primary { background: linear-gradient(135deg, #4f46e5, #8b5cf6); }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .hover-scale:hover { transform: scale(1.02); transition: 0.2s; }
</style>
@endsection