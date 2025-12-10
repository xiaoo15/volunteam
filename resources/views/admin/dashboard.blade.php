@extends('layouts.app')

@section('content')

<style>
    /* Grid Layout untuk Kartu Statistik */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }

    /* Kartu Statistik */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: transform 0.2s;
    }
    .stat-card:hover { transform: translateY(-5px); }

    .stat-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; margin-bottom: 16px;
    }
    .stat-icon.users { background: #eff6ff; color: #3b82f6; }
    .stat-icon.events { background: #f0fdf4; color: #22c55e; }
    .stat-icon.applications { background: #fefce8; color: #eab308; }
    .stat-icon.organizations { background: #fef2f2; color: #ef4444; }

    .stat-value { font-size: 28px; font-weight: 700; color: #1e293b; line-height: 1; margin-bottom: 8px; }
    .stat-label { color: #64748b; font-size: 14px; font-weight: 500; }
    
    .stat-change { display: flex; align-items: center; gap: 6px; font-size: 13px; margin-top: 12px; }
    .stat-change.positive { color: #22c55e; }
    .stat-change.negative { color: #ef4444; }

    /* Kartu Umum (Chart/Table) */
    .chart-card, .data-table-card {
        background: white; border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden; margin-bottom: 24px;
    }
    .chart-header, .table-header {
        padding: 20px 24px; border-bottom: 1px solid #e2e8f0;
        display: flex; justify-content: space-between; align-items: center;
    }
    .chart-header h3, .table-header h3 { font-size: 18px; font-weight: 700; margin: 0; color: #0f172a; }
    
    .chart-placeholder { padding: 40px; display: flex; align-items: center; justify-content: center; min-height: 300px; color: #94a3b8; }

    /* Table Styling */
    .table-container { overflow-x: auto; }
    .table { margin-bottom: 0; width: 100%; white-space: nowrap; }
    .table th {
        background: #f8fafc; font-weight: 600; font-size: 12px;
        text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;
        padding: 16px 24px; border-bottom: 1px solid #e2e8f0;
    }
    .table td { padding: 16px 24px; vertical-align: middle; border-bottom: 1px solid #e2e8f0; }
    
    .user-avatar { width: 40px; height: 40px; border-radius: 50%; margin-right: 12px; }
    
    /* Badges */
    .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .status-active { background: #dcfce7; color: #166534; } /* Hijau */
    .status-inactive { background: #fee2e2; color: #991b1b; } /* Merah */
    .status-pending { background: #fef9c3; color: #854d0e; } /* Kuning */
    .status-closed { background: #f1f5f9; color: #475569; } /* Abu */

    /* Action Buttons */
    .action-buttons { display: flex; gap: 8px; }
    .btn-action {
        width: 32px; height: 32px; border-radius: 8px; border: none;
        display: flex; align-items: center; justify-content: center;
        transition: 0.2s; cursor: pointer;
    }
    .btn-view { background: #e0f2fe; color: #0ea5e9; }
    .btn-view:hover { background: #bae6fd; }
    .btn-edit { background: #fef9c3; color: #eab308; }
    .btn-edit:hover { background: #fde047; }
    .btn-delete { background: #fee2e2; color: #ef4444; }
    .btn-delete:hover { background: #fecaca; }

</style>

<div class="mb-4">
    <h2 class="fw-bold text-dark mb-4">Dashboard Overview</h2>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon users"><i class="fa-solid fa-users"></i></div>
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-label">Total Pengguna</div>
            <div class="stat-change positive">
                <i class="fa-solid fa-arrow-up"></i> <span>Aktif</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon events"><i class="fa-solid fa-calendar-check"></i></div>
            <div class="stat-value">{{ $totalEvents }}</div>
            <div class="stat-label">Total Lowongan</div>
            <div class="stat-change positive">
                <i class="fa-solid fa-arrow-up"></i> <span>{{ \App\Models\Event::where('status', 'open')->count() }} Open</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon applications"><i class="fa-solid fa-file-pen"></i></div>
            <div class="stat-value">{{ $totalApplications }}</div>
            <div class="stat-label">Total Lamaran</div>
            <div class="stat-change positive">
                <i class="fa-solid fa-arrow-up"></i> <span>Masuk</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon organizations"><i class="fa-solid fa-building"></i></div>
            <div class="stat-value">{{ $totalOrganizations }}</div>
            <div class="stat-label">Perusahaan</div>
            <div class="stat-change positive">
                <i class="fa-solid fa-check"></i> <span>Terdaftar</span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="data-table-card">
                <div class="table-header">
                    <h3>Pengguna Terbaru</h3>
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random&color=fff" class="user-avatar">
                                        <div>
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-dark">Admin</span>
                                    @elseif($user->role == 'organizer')
                                        <span class="badge bg-primary">Organizer</span>
                                    @else
                                        <span class="badge bg-secondary">Volunteer</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn-action btn-delete" type="submit" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="chart-card">
                <div class="chart-header">
                    <h3>Aktivitas Terbaru</h3>
                </div>
                <div class="p-3">
                    @forelse($recentActivities as $activity)
                    <div class="d-flex align-items-center py-3 border-bottom border-light">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-light p-2 text-center" style="width: 40px; height: 40px;">
                                @if($activity->type == 'User')
                                    <i class="fa-solid fa-user-plus text-primary"></i>
                                @else
                                    <i class="fa-solid fa-calendar-plus text-success"></i>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold text-dark small">{{ Str::limit($activity->desc, 30) }}</div>
                            <small class="text-muted" style="font-size: 11px;">{{ $activity->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted py-3">Belum ada aktivitas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="data-table-card">
        <div class="table-header">
            <h3>Event / Lowongan Terbaru</h3>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Event</th>
                        <th>Organizer</th>
                        <th>Pelamar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $event->title }}</div>
                            <small class="text-muted">{{ $event->location }}</small>
                        </td>
                        <td>{{ $event->organizer->name }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $event->applications_count }} org</span>
                        </td>
                        <td>
                            @if($event->status == 'open')
                                <span class="status-badge status-active">Open</span>
                            @else
                                <span class="status-badge status-closed">{{ ucfirst($event->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('events.show', $event->id) }}" target="_blank" class="btn-action btn-view">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.event.delete', $event->id) }}" method="POST" onsubmit="return confirm('Hapus event ini?');">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete" type="submit">
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
    </div>
</div>
@endsection