@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    {{-- Header Sambutan --}}
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold text-dark">Dashboard Organizer</h2>
            <p class="text-muted">Halo, <span class="fw-bold text-primary">{{ Auth::user()->name }}</span>! Berikut statistik event kamu hari ini.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('events.create') }}" class="btn btn-primary rounded-pill shadow-sm px-4 fw-bold">
                <i class="fa-solid fa-plus me-2"></i> Buat Event Baru
            </a>
        </div>
    </div>

    {{-- Kartu Statistik --}}
    <div class="row g-4 mb-5">
        
        {{-- Card 1: Total Event --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="p-3 bg-primary bg-opacity-10 rounded-3 text-primary">
                            <i class="fa-solid fa-calendar-check fa-2x"></i>
                        </div>
                        <div class="display-4 fw-bold text-dark">{{ $totalEvents }}</div>
                    </div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-0">Total Event Aktif</h6>
                    <i class="fa-solid fa-chart-line position-absolute bottom-0 end-0 text-primary opacity-10" style="font-size: 8rem; margin-bottom: -20px; margin-right: -20px;"></i>
                </div>
            </div>
        </div>

        {{-- Card 2: Total Pelamar --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="p-3 bg-success bg-opacity-10 rounded-3 text-success">
                            <i class="fa-solid fa-users fa-2x"></i>
                        </div>
                        <div class="display-4 fw-bold text-dark">{{ $totalApplicants }}</div>
                    </div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-0">Total Pelamar Masuk</h6>
                    <i class="fa-solid fa-user-group position-absolute bottom-0 end-0 text-success opacity-10" style="font-size: 8rem; margin-bottom: -20px; margin-right: -20px;"></i>
                </div>
            </div>
        </div>

        {{-- Card 3: Perlu Review (Pending) --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="p-3 bg-warning bg-opacity-10 rounded-3 text-warning">
                            <i class="fa-solid fa-clock fa-2x"></i>
                        </div>
                        <div class="display-4 fw-bold text-dark">{{ $pendingApplicants }}</div>
                    </div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-0">Menunggu Review</h6>
                    <i class="fa-solid fa-hourglass-half position-absolute bottom-0 end-0 text-warning opacity-10" style="font-size: 8rem; margin-bottom: -20px; margin-right: -20px;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm p-4">
                <h5 class="fw-bold mb-3">Akses Cepat</h5>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('organizer.events') }}" class="btn btn-outline-dark rounded-pill px-4">
                        <i class="fa-solid fa-list-check me-2"></i> Kelola Event Saya
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-user-gear me-2"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection