@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <div class="container-fluid px-4 px-lg-5 py-5">

            {{-- 1. HEADER (TEXT WHITE ON GRADIENT) --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 text-white">
                <div class="mb-3 mb-md-0">
                    <h6 class="text-uppercase fw-bold letter-spacing-2 mb-1 opacity-75">Overview</h6>
                    <h1 class="display-5 fw-bold tracking-tight mb-0">
                        Hello, {{ Auth::user()->name }} 👋
                    </h1>
                </div>
                <div class="">
                    <div
                        class="bg-white bg-opacity-10 px-4 py-2 rounded-pill backdrop-blur border border-white border-opacity-25 d-inline-block">
                        <span class="fw-medium">{{ now()->format('l, d F Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- 2. STATS ROW --}}
            <div class="row g-4 mb-5">
                {{-- Card 1 --}}
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card h-100">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="icon-box bg-indigo-light text-indigo">
                                <i class="fa-regular fa-calendar"></i>
                            </div>
                            <span
                                class="badge bg-indigo-subtle text-indigo rounded-pill px-3 align-self-start">Active</span>
                        </div>
                        <h2 class="stat-number text-dark">{{ $totalEvents }}</h2>
                        <p class="text-muted small mb-0 fw-semibold">Total Event Dibuat</p>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card h-100">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="icon-box bg-green-light text-green">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <span class="badge bg-green-subtle text-green rounded-pill px-3 align-self-start">Total</span>
                        </div>
                        <h2 class="stat-number text-dark">{{ $totalApplicants }}</h2>
                        <p class="text-muted small mb-0 fw-semibold">Pelamar Masuk</p>
                    </div>
                </div>

                {{-- Card 3 (Action Required) --}}
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card h-100 border-warning-subtle">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="icon-box bg-warning-light text-warning">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            @if($pendingApplicants > 0)
                                <span class="pulse-badge bg-warning align-self-start mt-2"></span>
                            @endif
                        </div>
                        <h2 class="stat-number text-dark">{{ $pendingApplicants }}</h2>
                        <p class="text-muted small mb-0 fw-semibold">Menunggu Review</p>
                    </div>
                </div>

                {{-- Card 4 --}}
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card h-100 bg-dark text-white border-0">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="icon-box bg-white bg-opacity-20 text-black">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                        </div>
                        <h2 class="stat-number text-white">
                            {{ $totalEvents > 0 ? round(($totalApplicants / $totalEvents), 1) : 0 }}
                        </h2>
                        <p class="text-white-50 small mb-0 fw-semibold">Rata-rata Pelamar / Event</p>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                {{-- 3. MAIN ACTIVITY (TABLE) --}}
                <div class="col-xl-8 mb-4 mb-xl-0">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                        <div
                            class="card-header bg-white border-0 py-4 px-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <h5 class="fw-bold text-dark mb-0">Aktivitas Terkini</h5>
                            <a href="{{ route('organizer.events') }}"
                                class="btn btn-sm btn-light rounded-pill px-3 fw-bold text-indigo">
                                Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-nowrap">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-uppercase text-muted x-small fw-bold ls-1 border-0">Event
                                        </th>
                                        <th class="py-3 text-uppercase text-muted x-small fw-bold ls-1 border-0">Status</th>
                                        <th class="py-3 text-uppercase text-muted x-small fw-bold ls-1 border-0">Stats</th>
                                        <th class="py-3 text-uppercase text-muted x-small fw-bold ls-1 border-0">Updated
                                        </th>
                                        <th class="pe-4 py-3 border-0"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse($recentEvents as $event)
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="avatar-char rounded-3 me-3 d-flex align-items-center justify-content-center fw-bold shadow-sm flex-shrink-0">
                                                        {{ substr($event->title, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-0 text-truncate"
                                                            style="max-width: 200px; font-size: 0.95rem;">{{ $event->title }}
                                                        </h6>
                                                        <small class="text-muted x-small">ID: {{ $event->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($event->status == 'open')
                                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">Open</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary-subtle text-secondary rounded-pill px-3">Closed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="fw-bold text-dark">{{ $event->applications_count }}</span>
                                                    <span class="text-muted x-small">Pelamar</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-muted small fw-medium">{{ $event->updated_at->diffForHumans() }}</span>
                                            </td>
                                            <td class="pe-4 text-end">
                                                <a href="{{ route('events.show', $event->id) }}"
                                                    class="btn btn-light btn-sm rounded-circle w-30px h-30px p-0 d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-chevron-right text-muted"
                                                        style="font-size: 0.8rem;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fa-regular fa-folder-open fa-2x mb-3 opacity-25"></i>
                                                <p class="mb-0 fw-medium">Belum ada aktivitas.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- 4. SIDEBAR ACTIONS --}}
                <div class="col-xl-4">
                    {{-- Quick Action Card --}}
                    <div class="card border-0 bg-white shadow-lg rounded-4 p-4 mb-4">
                        <h6 class="text-uppercase text-muted fw-bold ls-1 x-small mb-4">Aksi Cepat</h6>

                        <a href="{{ route('events.create') }}"
                            class="action-item d-flex align-items-center p-3 rounded-3 mb-3 bg-indigo-subtle text-decoration-none">
                            <div class="icon-circle bg-indigo text-white me-3 shadow-sm flex-shrink-0">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-indigo mb-0">Buat Event Baru</h6>
                                <small class="text-indigo opacity-75">Publikasikan lowongan</small>
                            </div>
                            <i class="fa-solid fa-arrow-right ms-auto text-indigo opacity-50"></i>
                        </a>

                        <a href="{{ route('organizer.events') }}"
                            class="action-item d-flex align-items-center p-3 rounded-3 mb-3 bg-light text-decoration-none hover-bg-gray">
                            <div class="icon-circle bg-white text-dark me-3 border flex-shrink-0">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Kelola Event</h6>
                                <small class="text-muted">Edit & hapus</small>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="action-item d-flex align-items-center p-3 rounded-3 bg-light text-decoration-none hover-bg-gray">
                            <div class="icon-circle bg-white text-dark me-3 border flex-shrink-0">
                                <i class="fa-solid fa-sliders"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Profil Saya</h6>
                                <small class="text-muted">Update info</small>
                            </div>
                        </a>
                    </div>

                    {{-- Summary Card --}}
                    <div class="card border-0 bg-white bg-opacity-10 text-white shadow-lg rounded-4 p-4 glass-card">
                        <h6 class="text-uppercase fw-bold ls-1 x-small mb-4 opacity-75 text-white">Performance</h6>

                        {{-- Acceptance Rate --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-medium text-white">Acceptance Rate</span>
                            <span class="fw-bold text-white">
                                {{ $totalApplicants > 0 ? round(($acceptedApplicants / $totalApplicants) * 100) : 0 }}%
                            </span>
                        </div>

                        {{-- Progress Bar Putih Transparan --}}
                        <div class="progress mb-4 bg-black bg-opacity-25" style="height: 6px;">
                            <div class="progress-bar bg-white" role="progressbar"
                                style="width: {{ $totalApplicants > 0 ? ($acceptedApplicants / $totalApplicants) * 100 : 0 }}%">
                            </div>
                        </div>

                        {{-- Rejection Rate --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-medium text-white">Rejection Rate</span>
                            <span class="fw-bold text-white opacity-75">
                                {{ $totalApplicants > 0 ? round(($rejectedApplicants / $totalApplicants) * 100) : 0 }}%
                            </span>
                        </div>

                        {{-- Progress Bar Putih Pudar --}}
                        <div class="progress bg-black bg-opacity-25" style="height: 6px;">
                            <div class="progress-bar bg-white opacity-50" role="progressbar"
                                style="width: {{ $totalApplicants > 0 ? ($rejectedApplicants / $totalApplicants) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* 🔥 BACKGROUND GRADIENT YANG KAMU MINTA 🔥 */
        .main-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 50%, #818cf8 100%);
            padding-bottom: 50px;
        }

        /* TYPOGRAPHY */
        .ls-1 {
            letter-spacing: 1px;
        }

        .letter-spacing-2 {
            letter-spacing: 2px;
            font-size: 0.75rem;
        }

        .tracking-tight {
            letter-spacing: -0.03em;
        }

        .x-small {
            font-size: 0.75rem;
        }

        /* RESPONSIVE FONT SIZES */
        @media (max-width: 768px) {
            .display-5 {
                font-size: 2rem;
                /* Smaller header on mobile */
            }
        }

        /* CARDS */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            /* Safari support */
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* ICONS & COLORS */
        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        /* Custom Colors Palette matching the gradient */
        .bg-indigo {
            background-color: #4f46e5;
        }

        .text-indigo {
            color: #4f46e5;
        }

        .bg-indigo-light {
            background-color: #e0e7ff;
        }

        .bg-indigo-subtle {
            background-color: #e0e7ff;
        }

        .bg-green-light {
            background-color: #dcfce7;
        }

        .text-green {
            color: #16a34a;
        }

        .bg-green-subtle {
            background-color: #dcfce7;
        }

        .bg-warning-light {
            background-color: #fef3c7;
        }

        .text-warning {
            color: #d97706;
        }

        /* UTILS */
        .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 5px;
            letter-spacing: -1px;
        }

        .avatar-char {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);
            color: white;
        }

        .action-item {
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .action-item:hover {
            transform: translateX(5px);
        }

        .hover-bg-gray:hover {
            background-color: #f8fafc !important;
            border-color: #e2e8f0;
        }

        .icon-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pulse-badge {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(245, 158, 11, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
            }
        }
    </style>
@endsection