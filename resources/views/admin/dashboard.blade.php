@extends('layouts.app')

@section('content')

    <style>
        /* --- DASHBOARD CORE STYLE --- */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            .stat-card {
                background: white;
                border-radius: 16px;
                padding: 1.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                border: 1px solid rgba(226, 232, 240, 0.8);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }

            .stat-icon {
                width: 48px; height: 48px;
                border-radius: 12px;
                display: flex; align-items: center; justify-content: center;
                font-size: 1.25rem; margin-bottom: 1rem;
            }

            /* Warna Icon */
            .icon-indigo { background: #e0e7ff; color: #4f46e5; }
            .icon-emerald { background: #d1fae5; color: #059669; }
            .icon-amber { background: #fef3c7; color: #d97706; }
            .icon-rose { background: #ffe4e6; color: #e11d48; }

            .stat-value { font-size: 2rem; font-weight: 800; color: #1e293b; line-height: 1; letter-spacing: -1px; }
            .stat-label { font-size: 0.875rem; color: #64748b; font-weight: 600; margin-top: 0.5rem; }

            /* --- INSIGHT CARDS (BARIS KE-2) --- */
            .insight-card {
                background: white; border-radius: 16px;
                border: 1px solid #e2e8f0; height: 100%;
                display: flex; flex-direction: column;
            }
            .insight-header {
                padding: 1.25rem; border-bottom: 1px solid #f1f5f9;
                display: flex; justify-content: space-between; align-items: center;
            }
            .insight-body { padding: 1.25rem; flex-grow: 1; }

            /* Progress Bar Custom */
            .progress-label { display: flex; justify-content: space-between; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem; }
            .progress-sm { height: 6px; border-radius: 10px; background-color: #f1f5f9; margin-bottom: 1rem; }

            /* Top Organizer List */
            .organizer-item {
                display: flex; align-items: center; padding: 0.75rem 0;
                border-bottom: 1px solid #f8fafc;
            }
            .organizer-item:last-child { border-bottom: none; }
            .rank-badge {
                width: 24px; height: 24px; border-radius: 50%;
                background: #f1f5f9; color: #64748b; font-size: 0.7rem; font-weight: bold;
                display: flex; align-items: center; justify-content: center; margin-right: 1rem;
            }
            .rank-1 { background: #fef9c3; color: #ca8a04; } /* Gold */
            .rank-2 { background: #f1f5f9; color: #475569; } /* Silver */
            .rank-3 { background: #fff1f2; color: #be123c; } /* Bronze */

            /* --- TABLE STYLES --- */
            .custom-table th {
                background: #f8fafc; text-transform: uppercase;
                font-size: 0.7rem; font-weight: 700; color: #64748b; letter-spacing: 0.5px;
                padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0;
            }
            .custom-table td {
                padding: 1rem 1.5rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9;
                color: #334155; font-size: 0.9rem;
            }
            .badge-soft { padding: 4px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
            .bg-soft-success { background: #dcfce7; color: #166534; }
            .bg-soft-warning { background: #fef9c3; color: #854d0e; }
            .bg-soft-danger { background: #fee2e2; color: #991b1b; }

            .avatar-group { display: flex; }
            .avatar-group img {
                width: 32px; height: 32px; border-radius: 50%; border: 2px solid white;
                margin-left: -10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .avatar-group img:first-child { margin-left: 0; }

            .row.g-4 {
            row-gap: 1.5rem !important;
            column-gap: 1.5rem !important;
        }
        </style>

        <div class="bg-light min-vh-100 pb-5">

            {{-- HEADER --}}
            <div class="bg-dark text-white pt-4 pb-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3"></div> {{-- Spacer Sidebar --}}
                        <div class="col-lg-9 ps-lg-4">
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <h6 class="text-uppercase text-white-50 fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.8rem;">Command Center</h6>
                                    <h2 class="fw-bold mb-0">Dashboard Overview</h2>
                                </div>
                                <div class="d-none d-md-block">
                                    <button class="btn btn-outline-light btn-sm rounded-pill px-3" onclick="location.reload()">
                                        <i class="fas fa-sync-alt me-2"></i> Refresh Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-n5" style="margin-top: -30px;">
                <div class="row g-4">

                    {{-- SIDEBAR --}}
                    <div class="col-lg-3 d-none d-lg-block">
                        @include('partials.admin-sidebar')
                    </div>

                    {{-- MAIN CONTENT --}}
                    <div class="col-lg-19">

                        {{-- 1. BARIS KARTU STATISTIK (4 KARTU) --}}
                        <div class="stats-grid">
                            {{-- Total User --}}
                            <div class="stat-card">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="stat-icon icon-indigo"><i class="fa-solid fa-users"></i></div>
                                        <div class="stat-value">{{ $stats['total_users'] }}</div>
                                        <div class="stat-label">Total Pengguna</div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 small fw-bold">
                                            <i class="fa-solid fa-arrow-up"></i> 12%
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Total Event --}}
                            <div class="stat-card">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="stat-icon icon-emerald"><i class="fa-solid fa-calendar-day"></i></div>
                                        <div class="stat-value">{{ $stats['total_events'] }}</div>
                                        <div class="stat-label">Total Misi</div>
                                    </div>
                                    <div class="text-end">
                                        <span class="text-muted small fw-bold">{{ $stats['active_events'] }} Aktif</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Lamaran Masuk --}}
                            <div class="stat-card">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="stat-icon icon-amber"><i class="fa-solid fa-file-contract"></i></div>
                                        <div class="stat-value">{{ $stats['total_applications'] }}</div>
                                        <div class="stat-label">Total Lamaran</div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2 py-1 small fw-bold">
                                            {{ $stats['pending_apps'] }} Pending
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Lamaran Selesai --}}
                            <div class="stat-card">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="stat-icon icon-rose"><i class="fa-solid fa-award"></i></div>
                                        <div class="stat-value">{{ $stats['completed_apps'] }}</div>
                                        <div class="stat-label">Aksi Tuntas</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 2. BARIS SMART ANALYTICS & TOP ORGANIZER --}}
                        <div class="row g-4 mb-4">

                            {{-- Kiri: Distribusi Kategori (Visual Progress) --}}
                            <div class="col-md-7">
                                <div class="insight-card shadow-sm">
                                    <div class="insight-header">
                                        <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-chart-pie me-2 text-primary"></i>Tren Isu Sosial</h6>
                                    </div>
                                    <div class="insight-body">
                                        @foreach($categoryStats as $stat)
                                            @php 
                                                                                        // Hitung persentase sederhana
                                                $percent = ($stat->total / max($stats['total_events'], 1)) * 100;
                                                $color = match ($loop->index) { 0 => 'bg-primary', 1 => 'bg-success', 2 => 'bg-warning', default => 'bg-danger'};
                                            @endphp
                                            <div class="mb-3">
                                                <div class="progress-label">
                                                    <span>{{ $stat->category }}</span>
                                                    <span>{{ $stat->total }} Misi</span>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar {{ $color }}" style="width: {{ $percent }}%"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($categoryStats->isEmpty())
                                            <p class="text-muted small text-center my-4">Belum ada data kategori.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Kanan: Top Organizer --}}
                            <div class="col-md-5">
                                <div class="insight-card shadow-sm">
                                    <div class="insight-header">
                                        <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-trophy me-2 text-warning"></i>Top Organizer</h6>
                                    </div>
                                    <div class="insight-body p-0">
                                        <div class="list-group list-group-flush">
                                            @foreach($topOrganizers as $index => $org)
                                                <div class="organizer-item px-4">
                                                    <div class="rank-badge rank-{{ $index + 1 }}">{{ $index + 1 }}</div>
                                                    <img src="{{ $org->avatar_url }}" class="rounded-circle me-3 border" width="40" height="40">
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold text-dark small">{{ $org->name }}</div>
                                                        <div class="text-muted" style="font-size: 0.7rem;">{{ $org->events_count }} Misi Publik</div>
                                                    </div>
                                                    <i class="fa-solid fa-chevron-right text-muted opacity-25 small"></i>
                                                </div>
                                            @endforeach
                                            @if($topOrganizers->isEmpty())
                                                <div class="p-4 text-center text-muted small">Belum ada organizer aktif.</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. BARIS TABEL USER TERBARU (FULL WIDTH) --}}
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                            <div class="card-header bg-white p-4 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0"><i class="fa-solid fa-user-clock me-2 text-info"></i>Pengguna Terbaru</h6>
                                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-light fw-bold text-primary rounded-pill px-3">Lihat Semua</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Nama User</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Bergabung</th>
                                            <th class="text-end pe-4">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestUsers as $user)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $user->avatar_url }}" class="rounded-circle me-3 border shadow-sm" width="36" height="36">
                                                        <div>
                                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                                            <div class="text-muted small" style="font-size: 0.75rem;">{{ $user->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($user->role == 'admin') <span class="badge bg-dark">ADMIN</span>
                                                    @elseif($user->role == 'organizer') <span class="badge bg-primary bg-opacity-75">ORGANIZER</span>
                                                    @else <span class="badge bg-success bg-opacity-75">VOLUNTEER</span>
                                                    @endif
                                                </td>
                                                <td><span class="badge-soft bg-soft-success">Active</span></td>
                                                <td class="text-muted fw-medium">{{ $user->created_at->format('d M Y') }}</td>
                                                <td class="text-end pe-4">
                                                    @if($user->id !== Auth::id())
                                                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?');">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-light text-danger rounded-circle" style="width: 32px; height: 32px;"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- 4. BARIS EVENT BARU --}}
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header bg-white p-4 border-bottom">
                                <h6 class="fw-bold mb-0"><i class="fa-solid fa-bullhorn me-2 text-danger"></i>Misi Kebaikan Terbaru</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Judul Misi</th>
                                            <th>Organizer</th>
                                            <th>Pelamar</th>
                                            <th>Status</th>
                                            <th class="text-end pe-4">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestEvents as $event)
                                            <tr>
                                                <td class="ps-4 fw-bold text-dark">{{ Str::limit($event->title, 30) }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="{{ $event->organizer->avatar_url }}" class="rounded-circle border" width="24">
                                                        <span class="small">{{ $event->organizer->name }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-bold">{{ $event->applications_count }}</span>
                                                        <div class="progress flex-grow-1" style="width: 50px; height: 4px;">
                                                            <div class="progress-bar bg-primary" style="width: {{ min($event->applications_count * 5, 100) }}%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($event->status == 'open') <span class="badge-soft bg-soft-success">OPEN</span>
                                                    @elseif($event->status == 'closed') <span class="badge-soft bg-soft-dark">CLOSED</span>
                                                    @else <span class="badge-soft bg-soft-danger">CANCEL</span> @endif
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('events.show', $event->id) }}" target="_blank" class="btn btn-sm btn-light text-primary rounded-circle" style="width: 32px; height: 32px;"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection