@extends('layouts.app')

@section('content')

{{-- 1. HERO SECTION (BRANDING UTAMA) --}}
<section class="position-relative overflow-hidden py-5" style="background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);">
    <div class="container py-5 text-center text-white position-relative z-2">
        <span class="badge bg-white bg-opacity-25 border border-white border-opacity-25 rounded-pill px-3 py-2 mb-4 fw-bold">
            🚀 Platform Pengembangan Karir #1
        </span>
        <h1 class="display-3 fw-bold mb-3" style="letter-spacing: -1px;">Level Up Your Future</h1>
        <p class="lead opacity-75 mb-5 mx-auto" style="max-width: 600px;">
            Temukan ribuan kesempatan magang dan volunteer untuk mengasah skill masa depanmu.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('events.index') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary shadow-sm">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Cari Lowongan
            </a>
            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">
                    Gabung Gratis
                </a>
            @endguest
        </div>
    </div>
    {{-- Hiasan Background --}}
    <i class="fa-solid fa-rocket position-absolute start-0 bottom-0 text-white opacity-10" style="font-size: 20rem; transform: translate(-30%, 30%) rotate(15deg);"></i>
</section>

{{-- 2. STATISTIK SECTION --}}
<div class="bg-white border-bottom py-4">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <h3 class="fw-bold text-dark mb-0">{{ $stats['events'] }}+</h3>
                <small class="text-muted text-uppercase fw-bold">Lowongan Aktif</small>
            </div>
            <div class="col-md-4 border-start border-end">
                <h3 class="fw-bold text-primary mb-0">{{ $stats['volunteers'] }}+</h3>
                <small class="text-muted text-uppercase fw-bold">Talent Bergabung</small>
            </div>
            <div class="col-md-4">
                <h3 class="fw-bold text-dark mb-0">{{ $stats['organizers'] }}+</h3>
                <small class="text-muted text-uppercase fw-bold">Mitra Organizer</small>
            </div>
        </div>
    </div>
</div>

{{-- 3. KENAPA HARUS KITA? (FEATURES) --}}
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Kenapa VolunTeam?</h2>
            <p class="text-muted">Platform yang didesain khusus untuk anak muda berkarya.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4 text-center hover-up">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                        <i class="fa-solid fa-certificate fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Sertifikat Digital</h5>
                    <p class="text-muted small">Dapatkan bukti pengalaman resmi yang bisa dipakai untuk melamar kerja.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4 text-center hover-up">
                    <div class="icon-box bg-success bg-opacity-10 text-success mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                        <i class="fa-solid fa-users fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Jejaring Luas</h5>
                    <p class="text-muted small">Kenalan dengan mentor dan teman baru dari berbagai latar belakang.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4 text-center hover-up">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                        <i class="fa-solid fa-briefcase fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Persiapan Karir</h5>
                    <p class="text-muted small">Asah soft-skill dan hard-skill sebelum terjun ke dunia profesional.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. TEASER LOWONGAN TERBARU --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">Lowongan Terbaru 🔥</h2>
                <p class="text-muted mb-0">Jangan sampai ketinggalan kesempatan emas.</p>
            </div>
            <a href="{{ route('events.index') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                Lihat Semua <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($latestEvents as $event)
                <div class="col-md-4">
                    <div class="card h-100 border shadow-sm rounded-4 overflow-hidden card-hover">
                        <div class="position-relative">
                            {{-- Gambar Event --}}
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="...">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                                    <i class="fa-regular fa-image fa-3x"></i>
                                </div>
                            @endif
                            <span class="badge bg-white text-dark position-absolute top-0 start-0 m-3 shadow-sm border">
                                {{ $event->category }}
                            </span>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark mb-1">{{ Str::limit($event->title, 40) }}</h5>
                            <small class="text-primary fw-bold mb-3 d-block">{{ $event->organizer->name }}</small>
                            
                            <div class="d-flex gap-3 text-muted small mb-4">
                                <span><i class="fa-solid fa-location-dot me-1"></i> {{ $event->location }}</span>
                                <span><i class="fa-regular fa-clock me-1"></i> {{ $event->created_at->diffForHumans() }}</span>
                            </div>

                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary w-100 rounded-pill mt-auto fw-bold">
                                Detail Lowongan
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 5. CALL TO ACTION --}}
<section class="py-5" style="background: #1e293b;">
    <div class="container text-center py-4">
        <h2 class="text-white fw-bold mb-4">Siap Mengubah Masa Depanmu?</h2>
        <p class="text-white-50 mb-4 lead">Gabung sekarang dan jadilah bagian dari perubahan.</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow">
            Daftar Sekarang
        </a>
    </div>
</section>

<style>
    .hover-up { transition: transform 0.3s ease; }
    .hover-up:hover { transform: translateY(-10px); }
    .card-hover:hover { border-color: #4f46e5; box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; transition: all 0.3s; }
</style>

@endsection