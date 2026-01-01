@extends('layouts.app')

@section('content')

    <div class="container py-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-1">Mission Control Center</h6>
                <h2 class="fw-bold text-dark">Kelola Misi Kebaikan</h2>
                <p class="text-muted mb-0">Pantau performa event dan seleksi relawan terbaikmu.</p>
            </div>
            <a href="{{ route('events.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="fa-solid fa-plus me-2"></i> Buat Misi Baru
            </a>
        </div>

        {{-- Stats Row --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 border shadow-sm h-100 d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                        <i class="fa-solid fa-flag fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">{{ $events->total() }}</h3>
                        <span class="text-muted small text-uppercase fw-bold">Total Misi</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 border shadow-sm h-100 d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3">
                        <i class="fa-solid fa-users fa-2x"></i>
                    </div>
                    <div>
                        {{-- Hitung total pelamar semua event (Logic kasar di view gapapa buat lomba) --}}
                        <h3 class="fw-bold mb-0">{{ $events->sum('applications_count') }}</h3>
                        <span class="text-muted small text-uppercase fw-bold">Total Relawan</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-primary text-white rounded-4 shadow h-100 d-flex align-items-center justify-content-between cursor-pointer hover-scale">
                    <div>
                        <h5 class="fw-bold mb-1">Butuh Bantuan?</h5>
                        <small class="opacity-75">Hubungi Tim Support VolunTeam.</small>
                    </div>
                    <i class="fa-solid fa-headset fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        {{-- Event List Cards --}}
        <div class="row g-4">
            @forelse($events as $event)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 transition-hover">
                        <div class="card-body p-0">
                            <div class="d-flex">
                                {{-- Image Thumbnail --}}
                                <div class="bg-light d-none d-sm-block position-relative" style="width: 140px; min-height: 160px;">
                                    @if($event->image)
                                        <img src="{{ $event->image_url }}" class="w-100 h-100 object-fit-cover position-absolute">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="fa-regular fa-image fa-2x opacity-25"></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="p-4 flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge {{ $event->status == 'open' ? 'bg-success' : ($event->status == 'closed' ? 'bg-secondary' : 'bg-danger') }} bg-opacity-10 text-{{ $event->status == 'open' ? 'success' : ($event->status == 'closed' ? 'secondary' : 'danger') }} border px-2 py-1 rounded-pill x-small fw-bold">
                                            {{ strtoupper($event->status) }}
                                        </span>
                                        <div class="dropdown">
                                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3">
                                                <li><a class="dropdown-item" href="{{ route('events.show', $event->id) }}"><i class="fa-solid fa-eye me-2 text-primary"></i> Detail</a></li>
                                                <li><a class="dropdown-item" href="{{ route('events.edit', $event->id) }}"><i class="fa-solid fa-pen me-2 text-warning"></i> Edit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin hapus misi ini?');">
                                                        @csrf @method('DELETE')
                                                        <button class="dropdown-item text-danger"><i class="fa-solid fa-trash me-2"></i> Hapus</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <h5 class="fw-bold text-dark mb-1 text-truncate" style="max-width: 300px;">{{ $event->title }}</h5>
                                    <div class="text-muted small mb-3">
                                        <i class="fa-regular fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                    </div>

                                    {{-- Progress Bar Pelamar --}}
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between small fw-bold mb-1">
                                            <span class="text-primary">{{ $event->applications_count }} Pelamar</span>
                                            <span class="text-muted">Target: 50</span> {{-- Hardcode target biar keren --}}
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-primary" style="width: {{ min(($event->applications_count / 50) * 100, 100) }}%"></div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-bold">
                                            Kelola Relawan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-3"><i class="fa-solid fa-rocket fa-4x text-muted opacity-25"></i></div>
                    <h4 class="fw-bold text-dark">Misi Pertamamu Menunggu!</h4>
                    <p class="text-muted">Belum ada event yang dibuat. Yuk, buat perubahan sekarang.</p>
                    <a href="{{ route('events.create') }}" class="btn btn-primary rounded-pill px-4">Buat Misi Sekarang</a>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
        .transition-hover { transition: transform 0.2s, box-shadow 0.2s; }
        .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
        .hover-scale:hover { transform: scale(1.02); transition: transform 0.2s; }
        .x-small { font-size: 0.7rem; }
    </style>
@endsection