@extends('layouts.app')

@section('content')

<style>
    /* Stats Card */
    .dashboard-stat-card {
        background: white; border-radius: 16px; padding: 24px;
        border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    .dashboard-stat-card:hover { transform: translateY(-5px); }
    .stat-icon-wrapper {
        width: 48px; height: 48px; border-radius: 12px; display: flex;
        align-items: center; justify-content: center; font-size: 1.25rem; margin-bottom: 16px;
    }
    
    /* Table Styling */
    .event-table-card {
        background: white; border-radius: 16px; border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow: hidden;
    }
    .table thead th {
        background: #f8fafc; font-weight: 600; text-transform: uppercase;
        font-size: 0.75rem; letter-spacing: 0.5px; color: #64748b; padding: 16px 24px;
        border-bottom: 1px solid #e2e8f0;
    }
    .table tbody td { padding: 20px 24px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
    
    /* Thumbnail */
    .event-thumbnail {
        width: 60px; height: 60px; border-radius: 10px; object-fit: cover;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Badges */
    .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
    .status-open { background: #dcfce7; color: #166534; }
    .status-closed { background: #f1f5f9; color: #475569; }
    
    /* Action Buttons */
    .btn-icon {
        width: 36px; height: 36px; border-radius: 8px; display: flex;
        align-items: center; justify-content: center; transition: 0.2s; border: none;
    }
    .btn-view { background: #e0f2fe; color: #0ea5e9; }
    .btn-view:hover { background: #0ea5e9; color: white; }
    
    .btn-edit { background: #fef9c3; color: #d97706; }
    .btn-edit:hover { background: #d97706; color: white; }
    
    .btn-delete { background: #fee2e2; color: #ef4444; }
    .btn-delete:hover { background: #ef4444; color: white; }
</style>

<div class="container py-4">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard Kelola Event</h2>
            <p class="text-muted mb-0">Pantau performa lowongan dan kelola pelamar Anda.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('events.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                <i class="fa-solid fa-plus me-2"></i> Buat Event Baru
            </a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="dashboard-stat-card h-100">
                <div class="stat-icon-wrapper bg-primary bg-opacity-10 text-primary">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3 class="fw-bold text-dark mb-1">{{ $events->count() }}</h3>
                <span class="text-muted small">Total Event Dibuat</span>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="dashboard-stat-card h-100">
                <div class="stat-icon-wrapper bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3 class="fw-bold text-dark mb-1">{{ $events->sum('applications_count') }}</h3>
                <span class="text-muted small">Total Pelamar Masuk</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-stat-card h-100">
                <div class="stat-icon-wrapper bg-warning bg-opacity-10 text-warning">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h3 class="fw-bold text-dark mb-1">{{ $events->where('status', 'open')->count() }}</h3>
                <span class="text-muted small">Lowongan Sedang Aktif (Open)</span>
            </div>
        </div>
    </div>

    <div class="event-table-card">
        @if($events->isEmpty())
            <div class="text-center py-5">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/folder-is-empty-4064360-3363921.png" width="180" class="mb-3 opacity-75">
                <h5 class="fw-bold text-dark">Belum ada event dibuat</h5>
                <p class="text-muted">Mulai cari talenta terbaik dengan membuat lowongan pertama Anda.</p>
                <a href="{{ route('events.create') }}" class="btn btn-outline-primary rounded-pill mt-2">Buat Sekarang</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Detail Event</th>
                            <th>Tanggal / Deadline</th>
                            <th>Status</th>
                            <th>Pelamar</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" class="event-thumbnail me-3">
                                    @else
                                        <div class="event-thumbnail me-3 bg-light d-flex align-items-center justify-content-center text-muted">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">{{ $event->title }}</h6>
                                        <small class="text-muted">
                                            <i class="fa-solid fa-location-dot me-1"></i> {{ $event->location }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $event->event_date->format('d M Y') }}</div>
                                <small class="text-muted">Updated {{ $event->updated_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                @if($event->status == 'open')
                                    <span class="status-badge status-open">
                                        <i class="fa-solid fa-circle-check me-1"></i> Open
                                    </span>
                                @else
                                    <span class="status-badge status-closed">Closed</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary rounded-pill me-2">{{ $event->applications_count }}</span>
                                    <span class="text-muted small">Orang</span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('events.show', $event->id) }}" class="btn-icon btn-view" title="Kelola Pelamar" data-bs-toggle="tooltip">
                                        <i class="fa-solid fa-users-gear"></i>
                                    </a>
                                    
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn-icon btn-edit" title="Edit Event">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin hapus event ini? Data pelamar juga akan hilang!')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script>
    // Aktifin Tooltip Bootstrap biar pas hover tombol ada tulisannya
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection