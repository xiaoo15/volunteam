@extends('layouts.app')

@section('content')
    <div class="bg-light min-vh-100 pb-5">

        {{-- 1. HEADER HERO --}}
        <div class="position-relative bg-dark text-white overflow-hidden"
            style="height: 250px; background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
            <div class="container position-relative h-100 d-flex align-items-center" style="z-index: 1;">
                <div>
                    <h2 class="fw-bold mb-1">Kelola Pengguna</h2>
                    <p class="text-white-50 mb-0">Manajemen data volunteer dan organizer.</p>
                </div>
            </div>
            {{-- Decorative Circle --}}
            <div class="position-absolute top-0 end-0 p-5 opacity-10">
                <i class="fa-solid fa-users-gear fa-10x"></i>
            </div>
        </div>

        {{-- 2. CONTENT AREA --}}
        <div class="container mt-n5 position-relative" style="z-index: 2;">
            <div class="row g-4">

                {{-- SIDEBAR --}}
                <div class="col-lg-3 d-none d-lg-block">
                    @include('partials.admin-sidebar')
                </div>

                {{-- MAIN CARD --}}
                <div class="col-lg-18">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                        {{-- Card Header --}}
                        <div
                            class="card-header bg-white border-bottom border-light py-4 px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0">Daftar Pengguna</h6>
                                <small class="text-muted">Total {{ $users->total() }} user terdaftar</small>
                            </div>

                            {{-- Search UI (Visual Only) --}}
                            <div class="position-relative" style="width: 250px;">
                                <input type="text" class="form-control form-control-sm rounded-pill ps-5 bg-light border-0"
                                    placeholder="Cari nama atau email...">
                                <i
                                    class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3 text-muted small"></i>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th
                                            class="ps-4 py-3 text-muted x-small text-uppercase border-0 fw-bold letter-spacing-1">
                                            Profil User</th>
                                        <th
                                            class="py-3 text-muted x-small text-uppercase border-0 fw-bold letter-spacing-1">
                                            Role</th>
                                        <th
                                            class="py-3 text-muted x-small text-uppercase border-0 fw-bold letter-spacing-1">
                                            Bergabung</th>
                                        <th
                                            class="pe-4 py-3 text-end text-muted x-small text-uppercase border-0 fw-bold letter-spacing-1">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            {{-- Kolom Profil --}}
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    {{-- Avatar (Pakai logic accessor yang sudah dibuat) --}}
                                                    <img src="{{ $user->avatar_url }}"
                                                        class="rounded-circle me-3 border border-white shadow-sm object-fit-cover"
                                                        width="45" height="45">
                                                    <div>
                                                        <div class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">
                                                            {{ $user->name }}</div>
                                                        <div class="text-muted x-small">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Kolom Role --}}
                                            <td class="py-3">
                                                @if($user->role == 'admin')
                                                    <span
                                                        class="badge bg-dark rounded-pill px-3 py-2 border border-secondary border-opacity-25 x-small">
                                                        <i class="fa-solid fa-shield-halved me-1"></i> Admin
                                                    </span>
                                                @elseif($user->role == 'organizer')
                                                    <span
                                                        class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 border border-primary border-opacity-10 x-small fw-bold">
                                                        <i class="fa-solid fa-briefcase me-1"></i> Organizer
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge bg-success-subtle text-success rounded-pill px-3 py-2 border border-success border-opacity-10 x-small fw-bold">
                                                        <i class="fa-solid fa-hand-holding-heart me-1"></i> Volunteer
                                                    </span>
                                                @endif
                                            </td>

                                            {{-- Kolom Tanggal --}}
                                            <td class="py-3">
                                                <span class="text-muted small">
                                                    <i class="far fa-calendar me-1 opacity-50"></i>
                                                    {{ $user->created_at->format('d M Y') }}
                                                </span>
                                            </td>

                                            {{-- Kolom Aksi --}}
                                            <td class="text-end pe-4 py-3">
                                                @if($user->id !== Auth::id())
                                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST"
                                                        onsubmit="return confirm('⚠️ PERINGATAN: Menghapus user ini akan menghapus semua data (lamaran/event) terkait!\n\nApakah Anda yakin?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-soft-danger"
                                                            title="Hapus User">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-light text-muted border px-2 py-1 x-small">Akun
                                                        Saya</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($users->hasPages())
                            <div class="card-footer bg-white border-0 py-4 d-flex justify-content-center">
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>

        .row.g-4 {
            row-gap: 1.5rem !important;
            column-gap: 1.5rem !important;
        }

        .mt-n5 {
            margin-top: -3.5rem;
        }

        .x-small {
            font-size: 0.75rem;
        }

        .letter-spacing-1 {
            letter-spacing: 0.5px;
        }

        /* Button Icons (Konsisten dengan Event Page) */
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

        /* Custom Badges Background */
        .bg-primary-subtle {
            background-color: #eef2ff !important;
        }

        .bg-success-subtle {
            background-color: #ecfdf5 !important;
        }

        /* Search Input Focus */
        .form-control:focus {
            box-shadow: none;
            border: 1px solid #6366f1;
            /* Warna Primary */
            background-color: white !important;
        }
    </style>
@endsection