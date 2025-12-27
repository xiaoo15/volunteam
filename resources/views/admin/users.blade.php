@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100 pb-5">
    
    {{-- HEADER HERO --}}
    <div class="position-relative bg-dark text-white overflow-hidden" style="height: 250px; background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
        <div class="container position-relative h-100 d-flex align-items-center" style="z-index: 1;">
            <div>
                <h2 class="fw-bold mb-1">Kelola Pengguna</h2>
                <p class="text-white-50 mb-0">Manajemen data volunteer dan organizer.</p>
            </div>
        </div>
        <div class="position-absolute top-0 end-0 p-5 opacity-10">
            <i class="fa-solid fa-users-gear fa-10x"></i>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="container mt-n5 position-relative" style="z-index: 2;">
        <div class="row g-4">
            
            {{-- SIDEBAR --}}
            <div class="col-lg-3 d-none d-lg-block">
                @include('partials.admin-sidebar')
            </div>

            {{-- CONTENT AREA --}}
            <div class="col-lg-9">
                <div class="data-card h-100 bg-white rounded-4 shadow-sm border overflow-hidden">
                    <div class="data-header p-4 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-users me-2 text-primary"></i>Daftar Pengguna ({{ $users->total() }})</h5>
                        {{-- Search (Optional UI) --}}
                        <div class="d-none d-md-block">
                            <input type="text" class="form-control form-control-sm rounded-pill px-3" placeholder="Cari user..." disabled style="width: 200px;">
                        </div>
                    </div>
                    
                    {{-- USER LIST (CARD STYLE) --}}
                    <div>
                        @foreach($users as $user)
                            <div class="activity-item p-4 border-bottom hover-bg-light transition-all d-flex align-items-center gap-3">
                                {{-- Avatar --}}
                                <div class="activity-icon bg-light text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff" 
                                         class="rounded-circle w-100 h-100 object-fit-cover shadow-sm">
                                </div>

                                {{-- Info --}}
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0">{{ $user->name }}</h6>
                                            <div class="text-muted small">{{ $user->email }}</div>
                                        </div>
                                        
                                        {{-- Role Badge --}}
                                        @if($user->role == 'admin')
                                            <span class="badge bg-dark rounded-pill x-small px-3">Admin</span>
                                        @elseif($user->role == 'organizer')
                                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill x-small px-3 border border-info border-opacity-25">Organizer</span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill x-small px-3 border border-success border-opacity-25">Volunteer</span>
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <small class="text-muted x-small">
                                            <i class="far fa-calendar-alt me-1"></i> Bergabung {{ $user->created_at->format('d M Y') }}
                                        </small>
                                        
                                        {{-- Delete Button --}}
                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light text-danger fw-bold x-small rounded-pill px-3 hover-danger border">
                                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted x-small fst-italic">Akun Anda</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    .mt-n5 { margin-top: -3.5rem; }
    .x-small { font-size: 0.75rem; }
    .hover-bg-light:hover { background-color: #f8fafc; }
    .hover-danger:hover { background-color: #fee2e2 !important; color: #dc2626 !important; border-color: #fca5a5 !important; }
    .transition-all { transition: all 0.2s; }
</style>
@endsection