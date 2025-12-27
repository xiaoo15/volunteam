@extends('layouts.app')

@section('content')

    <style>
        .header-banner {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 1px solid #cbd5e1;
            padding: 40px 0;
        }

        .organizer-avatar-lg {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid white;
        }

        .content-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-right: 15px;
        }

        /* Hover effect pada gambar poster */
        .poster-hover:hover {
            opacity: 0.9;
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        /* Badge Soft Colors */
        .badge-soft-success { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }
        .badge-soft-warning { background-color: rgba(245, 158, 11, 0.1); color: #d97706; }
        .badge-soft-danger { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; }
        .badge-soft-primary { background-color: rgba(79, 70, 229, 0.1); color: #4f46e5; }
    </style>

    <div class="header-banner mb-5">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="me-4 d-none d-md-block">
                    <img src="https://ui-avatars.com/api/?name={{ $event->organizer->name }}&background=4f46e5&color=fff&size=128&bold=true"
                        class="organizer-avatar-lg">
                </div>

                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="fw-bold text-primary">{{ $event->organizer->name }}</span>
                        <i class="fa-solid fa-circle-check text-primary small" title="Verified"></i>
                        @if($event->status == 'open')
                            <span class="badge badge-soft-success rounded-pill px-3">Actively Hiring</span>
                        @else
                            <span class="badge badge-soft-secondary rounded-pill px-3">{{ ucfirst($event->status) }}</span>
                        @endif
                    </div>

                    <h1 class="fw-bold text-dark mb-2">{{ $event->title }}</h1>

                    <div class="text-muted small d-flex gap-4">
                        <span><i class="fa-solid fa-location-dot me-1"></i> {{ $event->location }}</span>
                        <span><i class="fa-solid fa-briefcase me-1"></i> Volunteer / Internship</span>
                        <span><i class="fa-regular fa-clock me-1"></i> Posted
                            {{ $event->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="d-none d-lg-block">
                    <button class="btn btn-white border rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fa-solid fa-share-nodes me-2"></i> Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row">

            <div class="col-lg-8">
                <div class="content-card">

                    {{-- POSTER EVENT (LIGHTBOX) --}}
                    @if($event->image)
                        <div class="mb-4 position-relative">
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 class="img-fluid rounded-4 w-100 object-fit-cover shadow-sm border poster-hover" 
                                 style="max-height: 400px; cursor: pointer;"
                                 data-bs-toggle="modal" data-bs-target="#posterModal"
                                 alt="Poster Event"
                                 title="Klik untuk memperbesar">
                            
                            <div class="position-absolute bottom-0 end-0 m-3">
                                <button class="btn btn-dark btn-sm rounded-circle opacity-75" data-bs-toggle="modal" data-bs-target="#posterModal">
                                    <i class="fa-solid fa-expand"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill">
                            <i class="fa-solid fa-tag me-1"></i> {{ $event->category ?? 'Umum' }}
                        </span>
                    </div>

                    <h5 class="fw-bold mb-3 text-dark">Tentang Lowongan Ini</h5>
                    <div class="text-secondary mb-5" style="line-height: 1.8;">
                        {!! nl2br(e($event->description)) !!}
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-list-check me-2 text-primary"></i>Apa yang akan kamu lakukan?</h5>
                        <div class="p-4 bg-light rounded-4 border">
                            <ul class="list-unstyled mb-0 text-secondary" style="line-height: 1.8;">
                                @foreach(explode("\n", $event->responsibilities) as $item)
                                    @if(trim($item))
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fa-solid fa-circle-check text-success mt-1 me-3 small"></i>
                                            <span>{{ str_replace('-', '', $item) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-user-check me-2 text-primary"></i>Kualifikasi Pelamar</h5>
                        <div class="p-4 bg-light rounded-4 border">
                            <ul class="list-unstyled mb-0 text-secondary" style="line-height: 1.8;">
                                @foreach(explode("\n", $event->requirements) as $req)
                                    @if(trim($req))
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fa-solid fa-caret-right text-primary mt-1 me-3"></i>
                                            <span>{{ str_replace('-', '', $req) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <hr class="my-4 opacity-10">

                    <h5 class="fw-bold mb-3">Benefit</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-white text-dark border p-2 fw-normal"><i class="fa-solid fa-medal me-1 text-warning"></i> Sertifikat</span>
                        <span class="badge bg-white text-dark border p-2 fw-normal"><i class="fa-solid fa-users me-1 text-info"></i> Relasi Baru</span>
                        <span class="badge bg-white text-dark border p-2 fw-normal"><i class="fa-solid fa-briefcase me-1 text-success"></i> Pengalaman Kerja</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                @if(Auth::check() && Auth::id() == $event->organizer_id)
                    {{-- 🔥 SIDEBAR ORGANIZER (CONTROL CENTER) 🔥 --}}
                    <div class="card border-0 shadow rounded-4 mb-4 bg-primary text-white position-sticky" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-1"><i class="fa-solid fa-users-gear me-2"></i>Control Center</h5>
                            <p class="opacity-75 small mb-4">Kelola pelamar untuk event ini.</p>

                            <div class="bg-white rounded-3 p-3 text-dark mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold small text-muted">TOTAL PELAMAR</span>
                                    <span class="badge bg-primary">{{ $event->applications->count() }} Orang</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar" style="width: {{ $event->applications->count() > 0 ? '100%' : '0%' }}"></div>
                                </div>
                            </div>

                            <div class="bg-white rounded-3 overflow-hidden text-dark">
                                <div class="p-3 border-bottom bg-light">
                                    <span class="fw-bold small">DAFTAR VOLUNTEER</span>
                                </div>
                                <div style="max-height: 400px; overflow-y: auto;">
                                    @forelse($event->applications as $app)
                                        <div class="p-3 border-bottom">
                                            <div class="d-flex align-items-center mb-2">
                                                <img src="https://ui-avatars.com/api/?name={{ $app->user->name }}" class="rounded-circle me-2" width="32">
                                                <div class="lh-1">
                                                    <div class="fw-bold small">
                                                        {{ $app->user->name }}
                                                        {{-- 🔥 LINK CV DIPERBAIKI ($app->cv) 🔥 --}}
                                                        @if($app->cv)
                                                            <a href="{{ asset('storage/' . $app->cv) }}" target="_blank" class="ms-1 text-danger" title="Lihat CV">
                                                                <i class="fa-solid fa-file-pdf"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <small class="text-muted" style="font-size: 10px;">{{ $app->created_at->diffForHumans() }}</small>
                                                </div>
                                                <span class="ms-auto badge badge-soft-{{ $app->status == 'accepted' ? 'success' : ($app->status == 'pending' ? 'warning' : ($app->status == 'completed' ? 'primary' : 'danger')) }}">
                                                    {{ ucfirst($app->status) }}
                                                </span>
                                            </div>

                                            {{-- TOMBOL AKSI ORGANIZER --}}
                                            <div class="d-flex gap-1 mt-2">
                                                @if($app->status == 'pending')
                                                    <form action="{{ route('applications.update', $app->id) }}" method="POST" class="flex-fill">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="accepted">
                                                        <button class="btn btn-sm btn-outline-success w-100 py-1" style="font-size: 11px;">Terima</button>
                                                    </form>
                                                    <form action="{{ route('applications.update', $app->id) }}" method="POST" class="flex-fill">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button class="btn btn-sm btn-outline-danger w-100 py-1" style="font-size: 11px;">Tolak</button>
                                                    </form>
                                                @elseif($app->status == 'accepted')
                                                    <form action="{{ route('applications.update', $app->id) }}" method="POST" class="w-100">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="status" value="completed">
                                                        <button class="btn btn-sm btn-primary w-100 py-1 shadow-sm" style="font-size: 11px;">Luluskan (Selesai)</button>
                                                    </form>
                                                @endif
                                            </div>

                                            {{-- CHAT BOX ORGANIZER --}}
                                            @if($app->status == 'accepted')
                                                <div class="mt-2 pt-2 border-top border-light">
                                                    @if($app->messages->count() > 0)
                                                        <div class="bg-light p-2 rounded mb-2 border" style="max-height: 100px; overflow-y: auto; font-size: 10px;">
                                                            @foreach($app->messages as $msg)
                                                                <div class="mb-1 {{ $msg->user_id == Auth::id() ? 'text-end' : 'text-start' }}">
                                                                    <span class="badge {{ $msg->user_id == Auth::id() ? 'bg-primary bg-opacity-75' : 'bg-secondary bg-opacity-75' }} fw-normal text-wrap text-start">
                                                                        {{ $msg->message }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <form action="{{ route('applications.message', $app->id) }}" method="POST">
                                                        @csrf
                                                        <div class="input-group input-group-sm">
                                                            {{-- 🔥 NAME INPUT MESSAGE DIPERBAIKI 🔥 --}}
                                                            <input type="text" name="message" class="form-control form-control-sm" placeholder="Kirim info..." required style="font-size: 11px;">
                                                            <button class="btn btn-dark btn-sm"><i class="fa-solid fa-paper-plane"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="p-4 text-center text-muted small">Belum ada pelamar.</div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <a href="{{ route('events.edit', $event->id) }}" class="text-white text-decoration-none small fw-bold">
                                    <i class="fa-solid fa-pen me-1"></i> Edit Event Ini
                                </a>
                            </div>
                        </div>
                    </div>

                @else
                    {{-- SIDEBAR VOLUNTEER (PUBLIC) --}}
                    <div class="content-card position-sticky" style="top: 100px;">
                        <h5 class="fw-bold mb-4">Ringkasan Event</h5>

                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon"><i class="fa-regular fa-calendar"></i></div>
                            <div>
                                <small class="text-muted fw-bold">TANGGAL PELAKSANAAN</small>
                                <div class="fw-bold text-dark">{{ $event->event_date->format('d F Y') }}</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <small class="text-muted fw-bold">LOKASI</small>
                                <div class="fw-bold text-dark">{{ $event->location }}</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon"><i class="fa-solid fa-money-bill-1-wave text-success"></i></div>
                            <div>
                                <small class="text-muted fw-bold">GAJI / BENEFIT</small>
                                <div class="fw-bold text-dark">{{ $event->salary ?? 'Unpaid / Sukarela' }}</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <div class="info-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <div>
                                <small class="text-muted fw-bold">PENYELENGGARA</small>
                                <div class="fw-bold text-dark">{{ $event->organizer->name }}</div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        @auth
                            @php
                                $application = \App\Models\Application::where('user_id', Auth::id())->where('event_id', $event->id)->first();
                            @endphp

                            @if($application)
                                <div class="alert alert-{{ $application->status == 'accepted' ? 'success' : ($application->status == 'rejected' ? 'danger' : 'warning') }} border-0 rounded-3 text-center mb-0">
                                    <div class="fw-bold mb-1">Status Lamaran:</div>
                                    <span class="badge bg-white text-dark border">{{ strtoupper($application->status) }}</span>
                                    <p class="small mt-2 mb-0">
                                        @if($application->status == 'pending') Lamaranmu sedang direview panitia.
                                        @elseif($application->status == 'accepted') Selamat! Cek email untuk info selanjutnya.
                                        @elseif($application->status == 'completed') Event selesai. <a href="{{ route('applications.history') }}">Download Sertifikat</a>
                                        @endif
                                    </p>
                                </div>

                            @elseif($event->status == 'open')
                                
                                {{-- 🟢 TOMBOL DAFTAR (BUKA MODAL) --}}
                                <button type="button" class="btn btn-primary w-100 btn-lg rounded-pill shadow fw-bold pulse-animation" data-bs-toggle="modal" data-bs-target="#applyModal">
                                    Daftar Sekarang
                                </button>
                                <small class="text-muted text-center d-block mt-3">
                                    <i class="fa-solid fa-lock me-1"></i> Data profilmu akan dikirim ke penyelenggara.
                                </small>

                            @else
                                <button class="btn btn-secondary w-100 btn-lg rounded-pill" disabled>Pendaftaran Ditutup</button>
                            @endif

                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 btn-lg rounded-pill fw-bold">Login untuk Mendaftar</a>
                            <small class="text-center d-block mt-3 text-muted">Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></small>
                        @endauth

                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- MODAL POSTER (LIGHTBOX) --}}
    @if($event->image)
    <div class="modal fade" id="posterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-body p-0 text-center position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3 bg-white p-2" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.8;"></button>
                    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid rounded shadow-lg" style="max-height: 85vh;">
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- 🔥 MODAL FORMULIR LAMARAN (POPUP DAFTAR) - VERSI FIXED 🔥 --}}
    @auth
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary" id="applyModalLabel">
                        <i class="fa-solid fa-paper-plane me-2"></i>Lengkapi Lamaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                {{-- Form punya enctype multipart buat upload PDF --}}
                <form action="{{ route('applications.store', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-light border small text-muted mb-4">
                            Kamu akan melamar untuk posisi <strong>{{ $event->title }}</strong>.
                        </div>

                        {{-- INPUT CV (WAJIB & NAMA 'cv') --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">UPLOAD CV (PDF WAJIB)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fa-solid fa-file-pdf text-danger"></i></span>
                                {{-- 🔥 NAME="CV" WAJIB SESUAI CONTROLLER --}}
                                <input type="file" name="cv" class="form-control" accept=".pdf" required>
                            </div>
                            <small class="text-muted" style="font-size: 11px;">
                                *Format PDF. Max 2MB. Wajib diisi agar Organizer bisa review profilmu.
                            </small>
                        </div>

                        {{-- INPUT PESAN (NAMA 'message') --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary">PESAN SINGKAT</label>
                            {{-- 🔥 NAME="MESSAGE" WAJIB SESUAI CONTROLLER --}}
                            <textarea name="message" class="form-control bg-light border-0" rows="3" placeholder="Contoh: Saya sangat tertarik karena..."></textarea>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                            Kirim Lamaran <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endauth

    <style>
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); }
            100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
        }
        .pulse-animation { animation: pulse 2s infinite; }
    </style>
@endsection