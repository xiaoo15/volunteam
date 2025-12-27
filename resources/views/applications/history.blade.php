@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">Riwayat Lamaran</h2>
                    <p class="text-muted mb-0">Pantau status lamaranmu di sini.</p>
                </div>
                <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                    <i class="fa-solid fa-plus me-2"></i> Cari Event Baru
                </a>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-muted small fw-bold text-uppercase ls-1 border-0">Event</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase ls-1 border-0">Tanggal Melamar</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase ls-1 border-0">Status</th>
                                <th class="pe-4 py-3 text-end text-muted small fw-bold text-uppercase ls-1 border-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $app)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-3 me-3 d-flex align-items-center justify-content-center bg-white border shadow-sm" style="width: 45px; height: 45px;">
                                                <span class="fw-bold text-primary">{{ substr($app->event->title, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-0">{{ Str::limit($app->event->title, 40) }}</h6>
                                                <small class="text-muted">{{ $app->event->organizer->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ $app->created_at->format('d M Y, H:i') }}</span>
                                    </td>
                                    <td>
                                        @if($app->status == 'pending')
                                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">Menunggu Review</span>
                                        @elseif($app->status == 'accepted')
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Diterima</span>
                                        @elseif($app->status == 'rejected')
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">Ditolak</span>
                                        @elseif($app->status == 'completed')
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end">
                                        <a href="{{ route('events.show', $app->event_id) }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold text-muted border">
                                            Detail
                                        </a>
                                        @if($app->status == 'completed')
                                            {{-- Tombol Sertifikat (Nanti buat fiturnya) --}}
                                            <button class="btn btn-outline-success btn-sm rounded-pill px-3 ms-1" title="Download Sertifikat">
                                                <i class="fa-solid fa-certificate"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="opacity-50 mb-3">
                                            <i class="fa-regular fa-paper-plane fa-3x text-muted"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark">Belum ada lamaran</h6>
                                        <p class="text-muted small">Yuk, mulai cari kesempatan volunteer yang cocok!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $applications->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

<style>
    .ls-1 { letter-spacing: 1px; }
</style>
@endsection