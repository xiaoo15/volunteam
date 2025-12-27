@extends('layouts.app')

@section('content')
    <div class="bg-light min-vh-100 pb-5">

        {{-- 1. HEADER HERO --}}
        <div class="position-relative bg-dark text-white overflow-hidden"
            style="height: 250px; background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
            <div class="container position-relative h-100 d-flex align-items-center" style="z-index: 1;">
                <div>
                    <h2 class="fw-bold mb-1">Kelola Event</h2>
                    <p class="text-white-50 mb-0">Monitor semua lowongan volunteer yang tersedia.</p>
                </div>
            </div>
            {{-- Decorative Circle --}}
            <div class="position-absolute top-0 end-0 p-5 opacity-10">
                <i class="fa-solid fa-calendar-check fa-10x"></i>
            </div>
        </div>

        {{-- 2. MAIN CONTENT --}}
        <div class="container mt-n5 position-relative" style="z-index: 2;">
            <div class="row g-4">

                {{-- SIDEBAR --}}
                <div class="col-lg-3 d-none d-lg-block">
                    @include('partials.admin-sidebar')
                </div>

                {{-- CONTENT AREA --}}
                <div class="col-lg-9">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                        {{-- Card Header --}}
                        <div
                            class="card-header bg-white border-bottom border-light py-4 px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0">Daftar Event</h6>
                                <small class="text-muted">Total {{ $events->total() }} event terdaftar</small>
                            </div>
                            {{-- (Optional) Search Bar Placeholder --}}
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-light rounded-pill px-3"><i
                                        class="fa-solid fa-filter me-1"></i> Filter</button>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th
                                            class="ps-4 py-3 text-muted x-small text-uppercase border-0 fw-bold letter-spacing-1">
                                            Detail Event</th>
                                        <th
                                            class="py-3 text-muted x-small text-uppercase border-0 fw-bold letter-spacing-1">
                                            Organizer</th>
                                        <th
                                            class="py-3 text-muted x-small text-uppercase border-0 text-center fw-bold letter-spacing-1">
                                            Pelamar</th>
                                        <th
                                            class="py-3 text-muted x-small text-uppercase border-0 fw-bold letter-spacing-1">
                                            Status</th>
                                        <th
                                            class="pe-4 py-3 text-end text-muted x-small text-uppercase border-0 fw-bold letter-spacing-1">
                                            Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($events as $event)
                                        <tr>
                                            {{-- Kolom Event --}}
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 text-primary d-flex align-items-center justify-content-center shadow-sm"
                                                        style="width: 48px; height: 48px;">
                                                        <i class="fa-regular fa-calendar-check fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark text-truncate mb-1"
                                                            style="max-width: 220px; font-size: 0.95rem;">
                                                            {{ $event->title }}
                                                        </div>
                                                        <div class="text-muted x-small">
                                                            <i class="fa-solid fa-location-dot me-1 text-secondary"></i>
                                                            {{ Str::limit($event->location, 25) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Kolom Organizer --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($event->organizer->name) }}&background=e0e7ff&color=4f46e5"
                                                        class="rounded-circle me-2 border border-white shadow-sm" width="32"
                                                        height="32">
                                                    <div class="small fw-semibold text-dark">{{ $event->organizer->name }}</div>
                                                </div>
                                            </td>

                                            {{-- Kolom Pelamar --}}
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-normal">
                                                    <i class="fa-solid fa-user-group me-1 text-muted"></i>
                                                    {{ $event->applications_count }}
                                                </span>
                                            </td>

                                            {{-- Kolom Status --}}
                                            <td>
                                                @if($event->status == 'open')
                                                    <span
                                                        class="badge bg-success-subtle text-success rounded-pill px-3 py-2 border border-success border-opacity-10">
                                                        <i class="fa-solid fa-circle me-1 x-small text-success"></i> Open
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 border border-secondary border-opacity-10">
                                                        <i class="fa-solid fa-circle me-1 x-small text-secondary"></i> Closed
                                                    </span>
                                                @endif
                                            </td>

                                            {{-- Kolom Aksi --}}
                                            <td class="text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('events.show', $event->id) }}" target="_blank"
                                                        class="btn btn-icon btn-soft-primary" title="Lihat Detail">
                                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                    </a>

                                                    <form action="{{ route('admin.event.delete', $event->id) }}" method="POST"
                                                        onsubmit="return confirm('⚠️ PERINGATAN: Menghapus event ini akan menghapus semua data pelamar terkait!\n\nApakah Anda yakin ingin melanjutkan?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-soft-danger"
                                                            title="Hapus Permanen">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <div class="mb-2"><i class="fa-regular fa-folder-open fa-3x opacity-25"></i>
                                                </div>
                                                <small>Belum ada event yang terdaftar.</small>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($events->hasPages())
                            <div class="card-footer bg-white border-0 py-4 d-flex justify-content-center">
                                {{ $events->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .mt-n5 {
            margin-top: -3.5rem;
        }

        .x-small {
            font-size: 0.75rem;
        }

        .letter-spacing-1 {
            letter-spacing: 0.5px;
        }

        /* Button Icons */
        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-soft-primary {
            background: #e0f2fe;
            color: #0284c7;
        }

        .btn-soft-primary:hover {
            background: #0284c7;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(2, 132, 199, 0.2);
        }

        .btn-soft-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-soft-danger:hover {
            background: #dc2626;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(220, 38, 38, 0.2);
        }

        /* Badges */
        .bg-success-subtle {
            background-color: #ecfdf5 !important;
        }

        .bg-secondary-subtle {
            background-color: #f1f5f9 !important;
        }
    </style>
@endsection