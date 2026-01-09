@extends('layouts.app')

@section('content')

    <style>
        /* HEADER GRADIENT */
        .header-banner {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 1px solid #cbd5e1;
            padding: 60px 0;
            /* Padding lebih lega */
            position: relative;
            overflow: hidden;
        }

        /* Hiasan background header */
        .header-banner::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .organizer-avatar-lg {
            width: 100px;
            /* Sedikit lebih besar */
            height: 100px;
            border-radius: 20px;
            /* Lebih rounded */
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.15);
            border: 4px solid white;
            object-fit: cover;
        }

        .content-card {
            background: white;
            border-radius: 20px;
            /* Konsisten rounded */
            padding: 35px;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            /* Shadow lebih halus */
            border: 1px solid #f1f5f9;
            margin-bottom: 30px;
        }

        .info-icon {
            width: 48px;
            height: 48px;
            background: #f8fafc;
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            margin-right: 15px;
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .info-item:hover .info-icon {
            background: #e0e7ff;
            transform: scale(1.1);
        }

        .poster-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: zoom-in;
        }

        .poster-hover:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.2);
        }

        /* Badge Styles */
        .badge-soft-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .badge-soft-warning {
            background-color: #fef9c3;
            color: #854d0e;
            border: 1px solid #fde047;
        }

        .badge-soft-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .badge-soft-primary {
            background-color: #e0e7ff;
            color: #3730a3;
            border: 1px solid #c7d2fe;
        }

        /* Chat Styles */
        .message-bubble {
            max-width: 85%;
            font-size: 0.9rem;
            line-height: 1.5;
            padding: 12px 16px;
            border-radius: 16px;
        }

        .message-sent {
            border-bottom-right-radius: 4px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2);
        }

        .message-received {
            border-bottom-left-radius: 4px;
            background: #f1f5f9;
            color: #1e293b;
        }

        .chat-container::-webkit-scrollbar {
            width: 6px;
        }

        .chat-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        /* AI Text Animation */
        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .ai-text-animate {
            background: linear-gradient(90deg, #4f46e5, #ec4899, #4f46e5);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s infinite linear;
            font-weight: 800;
        }

        .ai-btn-glow {
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {
            0% {
                box-shadow: 0 0 0 0 rgba(236, 72, 153, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(236, 72, 153, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(236, 72, 153, 0);
            }
        }
    </style>

    
    <div class="header-banner mb-5">
        <div class="container position-relative z-1">
            <div class="d-flex align-items-center flex-wrap flex-md-nowrap">
                <div class="me-md-5 mb-3 mb-md-0 mx-auto mx-md-0">
                    <img src="{{ $event->organizer->avatar_url }}" class="organizer-avatar-lg">
                </div>

                <div class="flex-grow-1 text-center text-md-start">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-2 flex-wrap">
                        <a href="{{ route('profile.show', $event->organizer->id) }}"
                            class="fw-bold text-primary text-decoration-none hover-underline">
                            {{ $event->organizer->name }}
                        </a> <i class="fa-solid fa-circle-check text-primary small" title="Terverifikasi"
                            data-bs-toggle="tooltip"></i>
                        @if($event->status == 'open')
                            <span class="badge badge-soft-success rounded-pill px-3"><i class="fa-solid fa-door-open me-1"></i>
                                Mencari Relawan</span>
                        @elseif($event->status == 'canceled')
                            <span class="badge badge-soft-danger rounded-pill px-3"><i class="fa-solid fa-ban me-1"></i>
                                Dibatalkan</span>
                        @else
                            <span class="badge badge-soft-secondary rounded-pill px-3"><i class="fa-solid fa-lock me-1"></i>
                                Ditutup</span>
                        @endif
                    </div>

                    <h1 class="fw-bold text-dark mb-3 ls-tight">{{ $event->title }}</h1>

                    <div class="text-muted d-flex gap-3 flex-wrap justify-content-center justify-content-md-start">
                        <span class="d-flex align-items-center gap-1"><i class="fa-solid fa-location-dot text-danger"></i>
                            {{ $event->location }}</span>
                        <span class="d-flex align-items-center gap-1"><i class="fa-solid fa-tag text-info"></i>
                            {{ $event->category }}</span>
                        <span class="d-flex align-items-center gap-1"><i class="fa-regular fa-clock"></i>
                            {{ $event->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="d-none d-lg-block ms-auto">
                    <div class="dropdown">
                        <button
                            class="btn btn-white border rounded-pill px-4 py-2 fw-bold shadow-sm dropdown-toggle hover-scale"
                            type="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-share-nodes me-2 text-primary"></i> Bagikan
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2 p-2">
                            <li><a class="dropdown-item rounded-3 py-2"
                                    href="https://wa.me/?text={{ urlencode('Yuk ikut aksi: ' . $event->title . ' ' . request()->url()) }}"
                                    target="_blank"><i class="fa-brands fa-whatsapp text-success me-2 w-20"></i>
                                    WhatsApp</a></li>
                            <li><a class="dropdown-item rounded-3 py-2"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"><i class="fa-brands fa-facebook text-primary me-2 w-20"></i>
                                    Facebook</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><button class="dropdown-item rounded-3 py-2" onclick="copyLink(this)"><i
                                        class="fa-regular fa-copy text-secondary me-2 w-20"></i> Salin Link</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">

            
            <div class="col-lg-8">
                <div class="content-card">

                    
                    @if($event->image)
                        <div class="mb-5 position-relative overflow-hidden rounded-4">
                            <img src="{{ $event->image_url }}" class="img-fluid w-100 object-fit-cover shadow-sm poster-hover"
                                style="max-height: 450px;" data-bs-toggle="modal" data-bs-target="#posterModal">
                            <div class="position-absolute bottom-0 end-0 m-3">
                                <button class="btn btn-dark btn-sm rounded-circle opacity-75 shadow" data-bs-toggle="modal"
                                    data-bs-target="#posterModal">
                                    <i class="fa-solid fa-expand"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    <h4 class="fw-bold mb-4 text-dark d-flex align-items-center">
                        <span
                            class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 32px; height: 32px; font-size: 0.9rem;"><i
                                class="fa-solid fa-align-left"></i></span>
                        Tentang Misi Ini
                    </h4>
                    <div class="text-secondary mb-5 lh-lg fs-6">
                        {!! nl2br(e($event->description)) !!}
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100 border border-light-subtle">
                                <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                    <i class="fa-solid fa-hands-holding-circle text-primary me-2"></i>Aksi Yang Dilakukan
                                </h6>
                                <ul class="list-unstyled mb-0 text-secondary d-flex flex-column gap-2">
                                    @foreach(explode("\n", $event->responsibilities) as $item)
                                        @if(trim($item))
                                            <li class="d-flex align-items-start">
                                                <i class="fa-solid fa-check text-success mt-1 me-2 small"></i>
                                                <span class="small">{{ str_replace('-', '', $item) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light rounded-4 p-4 h-100 border border-light-subtle">
                                <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                    <i class="fa-solid fa-users text-primary me-2"></i>Kriteria Relawan
                                </h6>
                                <ul class="list-unstyled mb-0 text-secondary d-flex flex-column gap-2">
                                    @foreach(explode("\n", $event->requirements) as $req)
                                        @if(trim($req))
                                            <li class="d-flex align-items-start">
                                                <i class="fa-solid fa-caret-right text-primary mt-1 me-2"></i>
                                                <span class="small">{{ str_replace('-', '', $req) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="d-flex align-items-center gap-3 p-4 rounded-4 bg-primary bg-opacity-10 border border-primary border-opacity-25">
                        <div class="bg-white p-3 rounded-circle text-warning shadow-sm">
                            <i class="fa-solid fa-gift fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-primary mb-1">Benefit Relawan</h6>
                            <p class="mb-0 small text-primary text-opacity-75">
                                
                                {{ $event->salary ? $event->salary : 'Sertifikat, Relasi Baru, & Pengalaman Berharga' }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            
            <div class="col-lg-4">

                
                
                @auth
                    @if(Auth::user()->role == 'volunteer')
                        @php
                            // Logika "Gimmick" AI: Angka acak tapi konsisten per event/user
                            $score = 80 + (($event->id + Auth::id()) % 20); 
                        @endphp
                        <div class="content-card bg-dark text-white border-0 position-relative overflow-hidden mb-4">
                            
                            <div class="position-absolute top-0 end-0 p-4 opacity-25">
                                <i class="fa-solid fa-robot fa-6x text-white"></i>
                            </div>

                            <div class="position-relative z-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1 small"><i
                                            class="fa-solid fa-wand-magic-sparkles me-2 text-warning"></i>AI Match</h6>
                                    <span class="badge bg-white text-dark bg-opacity-90">Beta</span>
                                </div>

                                <div class="text-center py-2">
                                    <h1 class="display-3 fw-bolder mb-0 ai-text-animate">{{ $score }}%</h1>
                                    <p class="small text-white-50 fw-bold">Tingkat Kecocokan Kamu</p>
                                </div>

                                <div class="progress bg-white bg-opacity-10 rounded-pill mb-3" style="height: 6px;">
                                    <div class="progress-bar bg-gradient-primary rounded-pill" style="width: {{ $score }}%"></div>
                                </div>

                                <p class="small text-white-50 mb-0">
                                    <i class="fa-solid fa-check-circle text-success me-1"></i>
                                    Sistem merekomendasikan misi ini karena sesuai dengan minatmu di isu
                                    <strong>{{ $event->category }}</strong>.
                                </p>
                            </div>
                        </div>
                    @endif
                @endauth

                
                @if(Auth::check() && (Auth::user()->role == 'organizer' || Auth::user()->role == 'admin'))
                    @php
                        // 🔥 QUERY PAKSA: Ambil semua pelamar event ini 🔥
                        $manualApplicants = \App\Models\Application::where('event_id', $event->id)->with('user', 'messages')->latest()->get();
                    @endphp

                    <div class="content-card bg-primary text-white border-0 position-sticky shadow-lg"
                        style="top: 100px; z-index: 999;">
                        <h5 class="fw-bold mb-1"><i class="fa-solid fa-users-gear me-2"></i>Mission Control</h5>
                        <p class="opacity-75 small mb-4">Kelola relawan untuk misi ini.</p>

                        <div class="bg-white rounded-4 p-3 text-dark mb-3 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold small text-muted">TOTAL PELAMAR</span>
                                <span class="badge bg-primary rounded-pill">{{ $manualApplicants->count() }} Orang</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary"
                                    style="width: {{ $manualApplicants->count() > 0 ? '100%' : '0%' }}"></div>
                            </div>
                        </div>

                        
                        <div class="bg-white rounded-4 overflow-hidden text-dark shadow-sm">
                            <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                                <span class="fw-bold small text-uppercase">Daftar Relawan</span>
                                <i class="fa-solid fa-list-ul text-muted"></i>
                            </div>
                            <div style="max-height: 350px; overflow-y: auto;">
                                @forelse($manualApplicants as $app)
                                    <div class="p-3 border-bottom hover-bg-light">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($app->user->name) }}&background=random"
                                                class="rounded-circle me-2 border" width="32" height="32">
                                            <div class="lh-1 flex-grow-1">
                                                <div class="fw-bold small text-truncate" style="max-width: 120px;">
                                                    {{ $app->user->name }}
                                                </div>
                                                <small class="text-muted"
                                                    style="font-size: 10px;">{{ $app->created_at->diffForHumans() }}</small>
                                            </div>
                                            <span
                                                class="badge badge-soft-{{ $app->status == 'accepted' ? 'success' : ($app->status == 'pending' ? 'warning' : ($app->status == 'completed' ? 'primary' : 'danger')) }} rounded-pill"
                                                style="font-size: 0.65rem;">
                                                {{ ucfirst($app->status) }}
                                            </span>
                                        </div>

                                        
                                        @if($app->cv)
                                            <a href="{{ asset('storage/' . $app->cv) }}" target="_blank"
                                                class="d-block small text-decoration-none text-primary mb-2"><i
                                                    class="fa-solid fa-file-pdf me-1"></i> Lihat CV</a>
                                        @endif

                                        <button class="btn btn-sm btn-outline-primary w-100 mb-2 rounded-pill fw-bold position-relative btn-chat-organizer"
    data-id="{{ $app->id }}"
    data-bs-toggle="modal" data-bs-target="#chatModalOrganizer{{ $app->id }}"
    style="font-size: 0.75rem;">
    <i class="far fa-comments me-1"></i> Diskusi

    {{-- 🔥 LOGIKA NOTIFIKASI (TITIK MERAH) 🔥 --}}
    @php
        // Hitung pesan yang BUKAN dari saya (Auth::id()) dan BELUM dibaca
        $unread = $app->messages->where('user_id', '!=', Auth::id())->where('is_read', false)->count();
    @endphp

    @if($unread > 0)
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle notification-dot">
            <span class="visually-hidden">Pesan baru</span>
        </span>
    @endif
</button>

                                        <div class="d-flex gap-1">
                                            @if($app->status == 'pending')
                                                <form action="{{ route('applications.update', $app->id) }}" method="POST"
                                                    class="flex-fill">
                                                    @csrf @method('PATCH') <input type="hidden" name="status" value="accepted">
                                                    <button class="btn btn-sm btn-success w-100 py-1 rounded-pill"
                                                        style="font-size: 0.7rem;"><i class="fa-solid fa-check"></i></button>
                                                </form>
                                                <form action="{{ route('applications.update', $app->id) }}" method="POST"
                                                    class="flex-fill">
                                                    @csrf @method('PATCH') <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-sm btn-danger w-100 py-1 rounded-pill"
                                                        style="font-size: 0.7rem;"><i class="fa-solid fa-times"></i></button>
                                                </form>
                                            @elseif($app->status == 'accepted')
                                                <form action="{{ route('applications.update', $app->id) }}" method="POST" class="w-100">
                                                    @csrf @method('PATCH') <input type="hidden" name="status" value="completed">
                                                    <button class="btn btn-sm btn-light text-primary fw-bold w-100 py-1 rounded-pill"
                                                        style="font-size: 0.75rem;">✅ Tandai Selesai</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-4 text-center text-muted small">
                                        <i class="fa-regular fa-folder-open mb-2 fa-2x opacity-25"></i>
                                        <div>Belum ada pendaftar.</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mt-3 text-center d-flex justify-content-center gap-2">
                            <a href="{{ route('events.edit', $event->id) }}"
                                class="btn btn-sm btn-white border-white fw-bold rounded-pill px-3 shadow-sm btn-edit">
                                <i class="fa-solid fa-pen me-1"></i> Edit
                            </a>

                            @if($event->status != 'canceled')
                                <form action="{{ route('events.cancel', $event->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin batalkan event?');">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-light rounded-pill px-3 fw-bold"><i
                                            class="fa-solid fa-ban me-1"></i> Batal</button>
                                </form>
                            @endif
                        </div>
                    </div>

                @else
                    
                    <div class="content-card position-sticky" style="top: 100px;">
                        <h5 class="fw-bold mb-4">Ringkasan Misi</h5>

                        <div class="info-item d-flex align-items-center mb-3">
                            <div class="info-icon"><i class="fa-regular fa-calendar"></i></div>
                            <div>
                                <small class="text-muted fw-bold x-small letter-spacing-1">TANGGAL</small>
                                <div class="fw-bold text-dark">{{ $event->event_date->format('d M Y') }}</div>
                            </div>
                        </div>

                        <div class="info-item d-flex align-items-center mb-3">
                            <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <small class="text-muted fw-bold x-small letter-spacing-1">LOKASI</small>
                                <div class="fw-bold text-dark">{{ $event->location }}</div>
                            </div>
                        </div>

                        <div class="info-item d-flex align-items-center mb-4">
                            <div class="info-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <div>
                                <small class="text-muted fw-bold x-small letter-spacing-1">ORGANIZER</small>
                                <div class="fw-bold text-dark">{{ $event->organizer->name }}</div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        @auth
                            @php $application = \App\Models\Application::where('user_id', Auth::id())->where('event_id', $event->id)->first(); @endphp
                            @if($application)
                                <div
                                    class="alert alert-{{ $application->status == 'accepted' ? 'success' : ($application->status == 'rejected' ? 'danger' : 'warning') }} border-0 rounded-4 text-center mb-0 p-3 shadow-sm">
                                    <div class="fw-bold mb-1">Status Kamu:</div>
                                    <span
                                        class="badge bg-white text-dark border shadow-sm px-3 py-2 rounded-pill my-2">{{ strtoupper($application->status) }}</span>
                                    <p class="small mb-0 text-muted">
                                        @if($application->status == 'pending') Lamaran sedang direview.
                                        @elseif($application->status == 'accepted') Selamat! Cek email kamu.
                                        @elseif($application->status == 'completed') Misi selesai. <a
                                            href="{{ route('applications.history') }}" class="fw-bold">Ambil Sertifikat</a>
                                        @endif
                                    </p>
                                </div>
                            @elseif($event->status == 'open')
                                <button type="button"
                                    class="btn btn-primary w-100 btn-lg rounded-pill shadow-lg fw-bold pulse-animation mb-3"
                                    data-bs-toggle="modal" data-bs-target="#applyModal">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Gabung Aksi
                                </button>
                                <div class="text-center">
                                    <small class="text-muted"><i class="fa-solid fa-shield-halved me-1"></i> Data aman &
                                        terenkripsi.</small>
                                </div>
                            @else
                                <button class="btn btn-secondary w-100 btn-lg rounded-pill" disabled>Misi Ditutup</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 btn-lg rounded-pill fw-bold">Login
                                untuk Gabung</a>
                            <small class="text-center d-block mt-3 text-muted">Belum punya akun? <a href="{{ route('register') }}"
                                    class="fw-bold text-decoration-none">Daftar</a></small>
                        @endauth
                    </div>
                @endif

            </div>
        </div>
    </div>

    
    @if($event->image)
        <div class="modal fade" id="posterModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0 shadow-none">
                    <div class="modal-body p-0 text-center position-relative">
                        <button type="button"
                            class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3 bg-white p-2 rounded-circle"
                            data-bs-dismiss="modal" style="opacity: 0.9;"></button>
                        <img src="{{ $event->image_url }}"" class=" img-fluid rounded-4 shadow-lg" style="max-height: 85vh;">
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- 
    =============================================
    MODAL CHAT ORGANIZER - MODERN STYLE
    Style: WhatsApp Web / Telegram Premium Vibes
    =============================================
--}}

<style>
    /* CUSTOM SCROLLBAR UNTUK CHAT */
    .chat-scroll-area::-webkit-scrollbar { width: 5px; }
    .chat-scroll-area::-webkit-scrollbar-track { background: #f1f5f9; }
    .chat-scroll-area::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .chat-scroll-area::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    /* BUBBLE CHAT STYLES */
    .chat-bubble {
        max-width: 75%;
        padding: 12px 16px;
        position: relative;
        font-size: 0.95rem;
        line-height: 1.5;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    /* Bubble Orang Lain (Kiri) */
    .bubble-received {
        background-color: #ffffff;
        color: #1e293b;
        border-radius: 0px 15px 15px 15px; /* Lancip di kiri atas */
        border: 1px solid #e2e8f0;
    }

    /* Bubble Kita (Kanan) */
    .bubble-sent {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: white;
        border-radius: 15px 0px 15px 15px; /* Lancip di kanan atas */
    }

    /* Bubble Note Awal */
    .bubble-note {
        background-color: #fffbeb; /* Kuning muda */
        border: 1px dashed #fbbf24;
        color: #92400e;
        border-radius: 12px;
        font-size: 0.9rem;
        width: 100%;
        text-align: center;
    }
</style>

@if(isset($manualApplicants))
    @foreach($manualApplicants as $app)
        
        <div class="modal fade" id="chatModalOrganizer{{ $app->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-2xl overflow-hidden" style="height: 600px;">
                    
                    
                    <div class="modal-header border-bottom p-3 bg-white d-flex align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="position-relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($app->user->name) }}&background=e0e7ff&color=4f46e5"
                                     class="rounded-circle" width="45" height="45">
                                
                                <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle"></span>
                            </div>
                            <div class="lh-1">
                                <h6 class="fw-bold text-dark mb-1">{{ $app->user->name }}</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-light text-secondary border rounded-pill fw-normal" style="font-size: 0.7rem;">
                                        Pelamar #{{ $app->id }}
                                    </span>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        • {{ $app->event->title }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-2 ms-auto">
                            
                            @if($app->status == 'pending')
                                <form action="{{ route('applications.update', $app->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button class="btn btn-sm btn-success rounded-pill px-3 fw-bold" title="Terima Langsung">
                                        <i class="fas fa-check me-1"></i> Terima
                                    </button>
                                </form>
                            @endif
                            <button type="button" class="btn btn-light btn-sm rounded-circle" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    
                    <div class="modal-body p-4 bg-light chat-scroll-area" id="chatContainer{{ $app->id }}"
                         style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); background-color: #f8fafc;">
                        
                        
                        @if($app->message)
                            <div class="d-flex justify-content-center mb-4">
                                <div class="bubble-note p-3 shadow-sm">
                                    <div class="fw-bold mb-1"><i class="fas fa-quote-left me-2 opacity-50"></i>Pesan Lamaran</div>
                                    "{{ $app->message }}"
                                </div>
                            </div>
                        @endif

                        
                        @foreach($app->messages as $msg)
                            <div class="d-flex w-100 mb-3 {{ $msg->user_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="chat-bubble {{ $msg->user_id == Auth::id() ? 'bubble-sent' : 'bubble-received' }}">
                                    <div class="mb-1">{{ $msg->message }}</div>
                                    <div class="text-end lh-1" style="opacity: 0.7; font-size: 0.65rem; margin-bottom: -4px;">
                                        {{ $msg->created_at->format('H:i') }}
                                        @if($msg->user_id == Auth::id())
                                            <i class="fas fa-check-double ms-1"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        
                        <div style="height: 10px;"></div>
                    </div>

                    
                    <div class="modal-footer border-top p-3 bg-white">
                        <form action="{{ route('applications.message', $app->id) }}" method="POST" class="w-100 chat-form-organizer" data-id="{{ $app->id }}">
    @csrf
    <div class="input-group bg-light rounded-pill border overflow-hidden p-1">
        <input type="text" name="message" 
               class="form-control border-0 bg-transparent shadow-none px-3" 
               placeholder="Tulis pesan balasan..." required autocomplete="off">
        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold m-1 transition-all hover-scale">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
</form>
                    </div>

                </div>
            </div>
        </div>

        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalId = "#chatModalOrganizer{{ $app->id }}";
                const chatContainer = document.getElementById("chatContainer{{ $app->id }}");
                
                const myModal = document.querySelector(modalId);
                myModal.addEventListener('shown.bs.modal', function () {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });
            });
            
        </script>
    @endforeach
@endif

    
    @auth
        <div class="modal fade" id="applyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-2xl overflow-hidden">
            
            {{-- HEADER: Clean & Modern --}}
            <div class="modal-header border-0 p-4 pb-2 bg-white">
                <div>
                    <h5 class="modal-title fw-bolder text-dark mb-1" style="letter-spacing: -0.5px;">
                        Siap Beraksi? 🚀
                    </h5>
                    <p class="text-muted small mb-0">Lengkapi data untuk bergabung di misi ini.</p>
                </div>
                <button type="button" class="btn-close bg-light p-2 rounded-circle" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('applications.store', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 pt-3">
                    
                    {{-- EVENT INFO CARD --}}
                    <div class="d-flex align-items-center gap-3 p-3 mb-4 rounded-3 bg-primary bg-opacity-5 border border-primary border-opacity-10">
                        <div class="bg-white p-2 rounded-circle shadow-sm text-primary">
                            <i class="fa-solid fa-briefcase fa-lg"></i>
                        </div>
                        <div class="lh-1">
                            <small class="text-muted text-uppercase fw-bold" style="color: white; font-size: 0.65rem;">POSISI DILAMAR</small>
                            <div class="fw-bold text-white mt-1">{{ $event->title }}</div>
                        </div>
                    </div>

                    {{-- UPLOAD CV (CUSTOM STYLE) --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted mb-2">UPLOAD CV (PDF)</label>
                        <div class="upload-zone position-relative rounded-3 border-2 border-dashed text-center p-4 transition-all hover-border-primary">
                            <input type="file" name="cv" class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer" 
                                   accept=".pdf" required onchange="updateFileName(this)">
                            
                            <div class="upload-content transition-all">
                                <div class="mb-2">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fa-solid fa-cloud-arrow-up text-primary fs-5"></i>
                                    </div>
                                </div>
                                <h6 class="fw-bold text-dark mb-1 file-label">Klik atau Tarik File CV ke Sini</h6>
                                <p class="text-muted x-small mb-0">Maksimal 2MB (Format .PDF)</p>
                            </div>
                        </div>
                    </div>

                    {{-- MOTIVATION LETTER & AI BUTTON --}}
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold small text-muted mb-0">ALASAN BERGABUNG</label>
                            
                            {{-- AI Button yang lebih 'Compact' --}}
                            <button type="button" 
                                class="btn btn-sm btn-link text-decoration-none fw-bold ai-btn-glow px-0" 
                                onclick="generateCoverLetter()"
                                style="font-size: 0.8rem;">
                                <span class="bg-gradient-primary text-white px-2 py-1 rounded-pill shadow-sm d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i> 
                                    <span>Buatkan dengan AI</span>
                                </span>
                            </button>
                        </div>
                        
                        <div class="position-relative">
                            <textarea name="message" id="messageInput" 
                                class="form-control bg-light border-0 rounded-3 p-3 shadow-inner custom-scrollbar"
                                rows="5" 
                                placeholder="Ceritakan kenapa kamu orang yang tepat untuk misi ini..."
                                style="resize: none;"></textarea>
                            
                            {{-- Icon dekoratif di pojok textarea --}}
                            <div class="position-absolute bottom-0 end-0 p-3 opacity-25 pointer-events-none">
                                <i class="fa-solid fa-pen-nib"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-4 pt-0 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-lg hover-scale d-flex align-items-center gap-2">
                        <span>Kirim Lamaran</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL ERROR SIZE (Add this at the bottom of content) --}}
<div class="modal fade" id="fileSizeErrorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 rounded-4 shadow-lg text-center overflow-hidden">
            <div class="modal-body p-4">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle" 
                         style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                    </div>
                </div>
                <h6 class="fw-bold text-dark mb-2">File Terlalu Besar! 😫</h6>
                <p class="text-muted small mb-4" style="line-height: 1.5;">
                    Waduh, ukuran CV kamu lebih dari <strong>2MB</strong>. Kompres dulu ya biar server nggak keberatan!
                </p>
                <button type="button" class="btn btn-danger rounded-pill w-100 fw-bold shadow-sm" data-bs-dismiss="modal">
                    Oke, Aku Kecilin Dulu
                </button>
            </div>
        </div>
    </div>
</div>

{{-- CSS KHUSUS MODAL INI --}}
<style>
    /* Dashed Border untuk Upload Zone */
    .border-dashed { border-style: dashed !important; border-color: #cbd5e1; background-color: #f8fafc; }
    .hover-border-primary:hover { border-color: #4f46e5 !important; background-color: #eef2ff; }
    
    /* Cursor Pointer */
    .cursor-pointer { cursor: pointer; }
    
    /* Utility Font Size */
    .x-small { font-size: 0.75rem; }
    
    /* Inner Shadow untuk Textarea biar kelihatan 'deep' */
    .shadow-inner { box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05); }
    
    /* Transisi Halus */
    .transition-all { transition: all 0.3s ease; }
    
    /* Scrollbar Textarea */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
    
    /* Gradient Button AI */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #ec4899 100%);
        transition: filter 0.3s ease;
    }
    .bg-gradient-primary:hover {
        filter: brightness(1.1);
    }
</style>

{{-- SCRIPT SEDERHANA UNTUK UBAH NAMA FILE SAAT DI-UPLOAD --}}
<script>
    // Script Update File Name & Validasi Size
function updateFileName(input) {
    const label = input.parentElement.querySelector('.file-label');
    const icon = input.parentElement.querySelector('.fa-cloud-arrow-up');
    const maxSize = 2 * 1024 * 1024; // 2MB Limit

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // 1. CEK UKURAN FILE
        if (file.size > maxSize) {
            // Panggil Modal Error
            const errorModal = new bootstrap.Modal(document.getElementById('fileSizeErrorModal'));
            errorModal.show();

            // Reset Input
            input.value = ""; 
            
            // Balikin Tampilan ke Awal
            label.textContent = "Klik atau Tarik File CV ke Sini";
            label.classList.remove('text-primary');
            icon.classList.remove('fa-check-circle', 'text-success');
            icon.classList.add('fa-cloud-arrow-up', 'text-primary');
            return; 
        }

        // 2. FILE AMAN -> TAMPILKAN NAMA
        label.textContent = file.name;
        label.classList.remove('text-dark');
        label.classList.add('text-primary');
        
        icon.classList.remove('fa-cloud-arrow-up', 'text-primary');
        icon.classList.add('fa-check-circle', 'text-success');
    }
}
</script>
    @endauth

    <style>
        .btn-edit {
            color: white;
            transition:
                background-color 0.25s ease,
                color 0.25s ease,
                box-shadow 0.25s ease;
        }

        .btn-edit:hover {
            background-color: #f8f9fa;
            color: #000;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        }

        .hover-scale {
            transition: transform 0.2s;
        }

        .hover-scale:hover {
            transform: scale(1.03);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #ec4899 100%);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(79, 70, 229, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(79, 70, 229, 0);
            }
        }

        .w-20 {
            width: 20px;
            text-align: center;
        }

        .hover-bg-light:hover {
            background-color: #f8fafc;
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. INIT TOOLTIP & MODAL SCROLL
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Auto Scroll Chat ke Bawah
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function () {
                // Support untuk Modal Volunteer & Organizer
                const chatContainer = this.querySelector('.chat-scroll-area');
                if (chatContainer) chatContainer.scrollTop = chatContainer.scrollHeight;
            });
        });

        // 2. LOGIKA CHAT ORGANIZER (Anti Error)
        const chatFormsOrg = document.querySelectorAll('.chat-form-organizer');
        chatFormsOrg.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); 

                let input = this.querySelector('input[name="message"]');
                let message = input.value;
                let appId = this.getAttribute('data-id');
                let container = document.getElementById('chatContainer' + appId);
                let btn = this.querySelector('button');
                let formData = new FormData(this); // Pakai FormData biar simpel

                if(!message.trim()) return;

                // UI Loading
                let originalBtnHtml = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                btn.disabled = true;

                // Fetch API (Lebih Modern dari $.ajax)
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Sukses! Tambah Bubble Chat
                    input.value = '';
                    
                    let newBubble = `
                        <div class="d-flex w-100 mb-3 justify-content-end">
                            <div class="chat-bubble bubble-sent animate__fadeInUp">
                                <div class="mb-1">${data.data.message}</div>
                                <div class="text-end lh-1" style="opacity: 0.7; font-size: 0.65rem; margin-bottom: -4px;">
                                    ${data.data.time} <i class="fas fa-check-double ms-1"></i>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    container.insertAdjacentHTML('beforeend', newBubble);
                    container.scrollTop = container.scrollHeight;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("⚠️ Gagal kirim pesan. Cek koneksi!");
                })
                .finally(() => {
                    btn.innerHTML = originalBtnHtml;
                    btn.disabled = false;
                    input.focus();
                });
            });
        });

        // 3. TANDAI DIBACA (Hapus Titik Merah)
        const chatButtonsOrg = document.querySelectorAll('.btn-chat-organizer');
        chatButtonsOrg.forEach(button => {
            button.addEventListener('click', function () {
                const appId = this.getAttribute('data-id');
                const dot = this.querySelector('.notification-dot');

                if (dot) {
                    fetch(`/applications/${appId}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(res => res.json()).then(data => {
                        if (data.success) dot.remove();
                    });
                }
            });
        });
    });

    // ==========================================
    // 4. FITUR AI GENERATOR (VERSI AMAN)
    // ==========================================
    function generateCoverLetter() {
        const btn = document.querySelector('.ai-btn-glow');
        const textarea = document.getElementById('messageInput');
        
        // 🔥 FIX ERROR: Kita pakai Js::from() biar aman dari syntax error PHP 🔥
        const eventTitle = {{ \Illuminate\Support\Js::from($event->title) }};
        const organizerName = {{ \Illuminate\Support\Js::from($event->organizer->name) }};
        const myName = {{ \Illuminate\Support\Js::from(Auth::check() ? Auth::user()->name : 'Saya') }};

        // 1. Loading UI
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Meracik Kata...';
        btn.disabled = true;
        textarea.value = '';
        textarea.placeholder = '🤖 AI sedang mengetik...';

        // 2. Template Pilihan
        const templates = [
            `Halo Tim ${organizerName},\n\nPerkenalkan saya ${myName}. Saya sangat tertarik untuk bergabung di "${eventTitle}".\n\nSaya melihat visi misi kegiatan ini sangat inspiratif. Dengan semangat dan dedikasi yang saya miliki, saya siap berkontribusi penuh dan bekerja sama dengan tim untuk kesuksesan acara ini.\n\nTerima kasih atas kesempatannya!`,
            
            `Yth. Panitia ${organizerName},\n\nSaya ${myName}, ingin mendaftar sebagai relawan untuk "${eventTitle}".\n\nSaya adalah pribadi yang cekatan, mudah beradaptasi, dan senang bekerja di lapangan. Saya yakin bisa memberikan energi positif dan bantuan nyata bagi kelancaran kegiatan ini.\n\nBesar harapan saya untuk dapat bergabung.`,
            
            `Hai Tim ${organizerName}!\n\nIzinkan saya, ${myName}, menjadi bagian dari aksi keren "${eventTitle}".\n\nSaya memiliki komitmen tinggi dan siap mengikuti arahan koordinator dengan disiplin. Mari kita buat kegiatan ini berdampak luas bagi masyarakat!\n\nSalam semangat!`
        ];

        // Pilih Acak
        const chosenMessage = templates[Math.floor(Math.random() * templates.length)];

        // 3. Efek Ngetik (Typing Animation)
        setTimeout(() => {
            let i = 0;
            const typingSpeed = 15; // Makin kecil makin ngebut

            function typeWriter() {
                if (i < chosenMessage.length) {
                    textarea.value += chosenMessage.charAt(i);
                    textarea.scrollTop = textarea.scrollHeight; // Auto scroll ke bawah textarea
                    i++;
                    setTimeout(typeWriter, typingSpeed);
                } else {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                    textarea.focus();
                }
            }
            typeWriter();
        }, 1000);
    }

    // 5. COPY LINK
    function copyLink(btn) {
        navigator.clipboard.writeText(window.location.href).then(() => {
            let original = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-check text-success me-2 w-20"></i> Tersalin!';
            setTimeout(() => { btn.innerHTML = original; }, 2000);
        });
    }
</script>
@endsection