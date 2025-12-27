@extends('layouts.app')

@section('content')

    <style>
        /* --- DASHBOARD GRID & CARDS --- */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 24px;
                margin-bottom: 32px;
            }

            .stat-card {
                background: white;
                border-radius: 20px;
                padding: 24px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); /* Shadow lebih lembut */
                border: 1px solid rgba(226, 232, 240, 0.8);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            }

            /* Hiasan background tipis di kartu */
            .stat-card::before {
                content: '';
                position: absolute;
                top: -20px;
                right: -20px;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background: currentColor;
                opacity: 0.05;
                z-index: 0;
            }

            .stat-content {
                position: relative;
                z-index: 1;
            }

            .stat-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 16px;
            }

            .stat-icon {
                width: 54px;
                height: 54px;
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
            }

            /* Warna-warni Icon */
            .icon-purple { background: #eef2ff; color: #4f46e5; }
            .icon-green { background: #f0fdf4; color: #16a34a; }
            .icon-yellow { background: #fefce8; color: #ca8a04; }
            .icon-blue { background: #eff6ff; color: #2563eb; }

            .stat-value {
                font-size: 32px;
                font-weight: 800;
                color: #1e293b;
                line-height: 1;
                letter-spacing: -1px;
            }

            .stat-label {
                color: #64748b;
                font-size: 14px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-top: 4px;
            }

            .stat-trend {
                font-size: 12px;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 50px;
                margin-top: 12px;
            }

            .trend-up { background: #dcfce7; color: #166534; }

            /* --- TABLE CARDS --- */
            .data-card {
                background: white;
                border-radius: 20px;
                border: 1px solid #e2e8f0;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                margin-bottom: 32px;
            }

            .data-header {
                padding: 24px;
                border-bottom: 1px solid #f1f5f9;
                display: flex;
                justify-content: space-between;
                align-items: center;
                background: white;
            }

            .data-header h5 {
                font-weight: 700;
                color: #0f172a;
                margin: 0;
                font-size: 1.1rem;
            }

            .table-responsive {
                margin: 0;
            }

            .table {
                width: 100%;
                margin-bottom: 0;
                vertical-align: middle;
            }

            .table th {
                background: #f8fafc;
                color: #64748b;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.5px;
                padding: 16px 24px;
                border-bottom: 1px solid #e2e8f0;
                border-top: none;
            }

            .table td {
                padding: 16px 24px;
                border-bottom: 1px solid #f1f5f9;
                color: #334155;
                font-size: 0.9rem;
            }

            .table tr:last-child td {
                border-bottom: none;
            }

            .table tr:hover td {
                background-color: #f8fafc;
            }

            /* --- COMPONENTS --- */
            .user-avatar-sm {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid #fff;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            .badge-soft {
                padding: 6px 12px;
                border-radius: 50px;
                font-weight: 600;
                font-size: 0.75rem;
            }

            .bg-soft-primary { background: #e0e7ff; color: #4338ca; }
            .bg-soft-success { background: #dcfce7; color: #15803d; }
            .bg-soft-warning { background: #fef9c3; color: #a16207; }
            .bg-soft-danger { background: #fee2e2; color: #b91c1c; }
            .bg-soft-dark { background: #f1f5f9; color: #334155; }

            .btn-icon {
                width: 34px;
                height: 34px;
                border-radius: 10px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s;
                border: none;
                background: transparent;
            }

            .btn-icon:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }

            .btn-view { background: #e0f2fe; color: #0284c7; }
            .btn-delete { background: #fee2e2; color: #dc2626; }

            /* Activity Feed */
            .activity-item {
                padding: 16px 24px;
                border-bottom: 1px solid #f1f5f9;
                display: flex;
                align-items: flex-start;
                gap: 16px;
            }

            .activity-icon {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: #f1f5f9;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }
        </style>

        <div class="container py-5">

            {{-- HEADER DASHBOARD --}}
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h6 class="text-uppercase text-muted fw-bold ls-1 mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">Admin Console</h6>
                    <h2 class="fw-bold text-dark mb-0">Dashboard Overview</h2>
                </div>
                <div class="d-none d-md-block">
                    <span class="bg-white border px-3 py-2 rounded-pill text-muted small shadow-sm">
                        <i class="far fa-calendar me-2"></i> {{ now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>

            {{-- 1. STATS GRID --}}
            <div class="stats-grid">
                {{-- User Stat --}}
                <div class="stat-card" style="color: #4f46e5;">
                    <div class="stat-content">
                        <div class="stat-header">
                            <div class="stat-icon icon-purple"><i class="fa-solid fa-users"></i></div>
                            <div class="stat-trend trend-up"><i class="fa-solid fa-arrow-trend-up"></i> Aktif</div>
                        </div>
                        <div class="stat-value">{{ $stats['total_users'] }}</div>
                        <div class="stat-label">Total Pengguna</div>
                    </div>
                </div>

                {{-- Event Stat --}}
                <div class="stat-card" style="color: #16a34a;">
                    <div class="stat-content">
                        <div class="stat-header">
                            <div class="stat-icon icon-green"><i class="fa-solid fa-calendar-check"></i></div>
                            <div class="stat-trend trend-up"><i class="fa-solid fa-check"></i> {{ $stats['active_events'] }} Open</div>
                        </div>
                        <div class="stat-value">{{ $stats['total_events'] }}</div>
                        <div class="stat-label">Total Event</div>
                    </div>
                </div>

                {{-- Application Stat --}}
                <div class="stat-card" style="color: #ca8a04;">
                    <div class="stat-content">
                        <div class="stat-header">
                            <div class="stat-icon icon-yellow"><i class="fa-solid fa-file-contract"></i></div>
                        </div>
                        <div class="stat-value">{{ $stats['total_applications'] }}</div>
                        <div class="stat-label">Total Lamaran</div>
                    </div>
                </div>

                {{-- Organizer Stat --}}
                <div class="stat-card" style="color: #2563eb;">
                    <div class="stat-content">
                        <div class="stat-header">
                            <div class="stat-icon icon-blue"><i class="fa-solid fa-building"></i></div>
                        </div>
                        <div class="stat-value">{{ $stats['organizers'] }}</div>
                        <div class="stat-label">Organizer</div>
                    </div>
                </div>
            </div>

            {{-- 2. MAIN CONTENT (TABLES) --}}
            <div class="row">

                {{-- KOLOM KIRI: USER TERBARU --}}
                <div class="col-lg-8">
                    <div class="data-card h-100">
                        <div class="data-header">
                            <h5><i class="fa-solid fa-user-plus me-2 text-primary"></i>Pengguna Terbaru</h5>
                            <button class="btn btn-sm btn-light rounded-pill px-3 fw-bold text-muted small">Lihat Semua</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="ps-4">User</th>
                                        <th>Role</th>
                                        <th>Tanggal Join</th>
                                        <th class="text-end pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestUsers as $user)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff" 
                                                         class="user-avatar-sm me-3">
                                                    <div>
                                                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $user->name }}</div>
                                                        <div class="text-muted small" style="font-size: 0.75rem;">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($user->role == 'admin')
                                                    <span class="badge-soft bg-soft-dark">Admin</span>
                                                @elseif($user->role == 'organizer')
                                                    <span class="badge-soft bg-soft-primary">Organizer</span>
                                                @else
                                                    <span class="badge-soft bg-soft-success">Volunteer</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted small fw-medium">{{ $user->created_at->format('d M Y') }}</span>
                                            </td>
                                            <td class="text-end pe-4">
                                                @if($user->role != 'admin') {{-- Jangan hapus admin sendiri --}}
                                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn-icon btn-delete" title="Hapus User">
                                                            <i class="fa-solid fa-trash-can fa-sm"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: EVENT TERBARU --}}
                <div class="col-lg-4">
                    <div class="data-card h-100">
                        <div class="data-header">
                            <h5><i class="fa-solid fa-clock-rotate-left me-2 text-warning"></i>Event Baru</h5>
                        </div>

                        {{-- List Event (Card Style biar muat di kolom kecil) --}}
                        <div>
                            @foreach($latestEvents as $event)
                                <div class="activity-item hover-bg-light transition-all">
                                    <div class="activity-icon bg-primary bg-opacity-10 text-primary">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <h6 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 150px;">
                                                <a href="{{ route('events.show', $event->id) }}" target="_blank" class="text-decoration-none text-dark">
                                                    {{ $event->title }}
                                                </a>
                                            </h6>
                                            @if($event->status == 'open')
                                                <span class="badge bg-success rounded-circle p-1" style="width: 8px; height: 8px;"></span>
                                            @else
                                                <span class="badge bg-secondary rounded-circle p-1" style="width: 8px; height: 8px;"></span>
                                            @endif
                                        </div>
                                        <p class="mb-1 text-muted small">{{ $event->organizer->name }}</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="badge-soft bg-soft-primary px-2 py-1" style="font-size: 0.65rem;">
                                                {{ $event->applications_count }} Pelamar
                                            </span>

                                            <form action="{{ route('admin.event.delete', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus event?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-danger border-0 bg-transparent p-0 small" style="font-size: 0.75rem;">
                                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-3 text-center border-top">
                            <a href="{{ route('events.index') }}" class="text-decoration-none fw-bold small text-primary">Lihat Semua Event</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection