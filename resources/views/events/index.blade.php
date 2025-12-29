@extends('layouts.app')

@section('content')

    <style>
        /* HEADER GRADIENT */
        .page-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 80px 0 120px; /* Padding bawah gede buat tempat search bar nempel */
            color: white;
            position: relative;
            overflow: hidden;
        }

        /* UNIFIED SEARCH BAR (ALa Airbnb) */
        .search-container-floating {
            margin-top: -80px; /* Tarik ke atas biar nempel header */
            position: relative;
            z-index: 10;
        }

        .unified-search-bar {
            background: white;
            border-radius: 50px; /* Bulat banget */
            box-shadow: 0 20px 50px -10px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            padding: 8px;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .search-segment {
            flex: 1;
            padding: 10px 25px;
            position: relative;
            border-right: 1px solid #e2e8f0;
            transition: background 0.2s;
            border-radius: 30px;
        }
        
        .search-segment:last-child { border-right: none; }
        .search-segment:hover { background-color: #f8fafc; }
        .search-segment:focus-within { background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); z-index: 2; }

        .segment-label {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 2px;
            display: block;
            text-transform: uppercase;
        }

        .segment-input {
            border: none;
            width: 100%;
            font-weight: 600;
            color: #1e293b;
            outline: none;
            background: transparent;
            font-size: 0.95rem;
            padding: 0;
        }

        /* TOMBOL CARI BULAT */
        .btn-search-round {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            flex-shrink: 0; /* Biar gak gepeng */
        }
        .btn-search-round:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
        }

        /* SMART PILLS (TAGS DI BAWAH SEARCH) */
        .smart-pills {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .pill-item {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0,0,0,0.05);
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            text-decoration: none;
        }
        .pill-item:hover {
            transform: translateY(-2px);
            background: white;
            color: #4f46e5;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .pill-item i { color: #818cf8; margin-right: 6px; }

        /* LIST CARD STYLES */
        .job-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 24px;
            overflow: hidden;
        }
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
            border-color: #e2e8f0;
        }
        .hover-text-primary:hover { color: #4f46e5 !important; }

        /* ANIMASI TYPEWRITER */
        .typewriter-cursor {
            display: inline-block;
            width: 2px;
            background-color: #4f46e5;
            animation: blink 1s infinite;
        }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .unified-search-bar { flex-direction: column; border-radius: 20px; padding: 15px; }
            .search-segment { width: 100%; border-right: none; border-bottom: 1px solid #f1f5f9; padding: 10px 0; }
            .search-segment:last-child { border-bottom: none; }
            .btn-search-round { width: 100%; border-radius: 15px; margin-top: 10px; height: 50px; }
            .search-container-floating { margin-top: -40px; }
        }
    </style>

    {{-- HEADER HALAMAN --}}
    <div class="page-header text-center">
        <div class="container position-relative z-2">
            <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 rounded-pill px-3 py-2 mb-3 fw-bold small backdrop-blur">
                <i class="fa-solid fa-sparkles text-warning me-1"></i> Powered by Smart Recommendation
            </span>
            <h1 class="fw-bold display-5 mb-2">Mulai Misi Kebaikanmu</h1>
            <p class="lead opacity-75 mb-0" style="font-weight: 300;">Temukan ribuan cara untuk membuat dunia tersenyum hari ini.</p>
        </div>
        {{-- Background Hiasan --}}
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>

    {{-- SEARCH BAR (Airbnb Style) --}}
    <div class="container search-container-floating" id="list-misi">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11">
                
                <form action="{{ route('events.index') }}" method="GET">
                    <div class="unified-search-bar">
                        
                        {{-- 1. Keyword (Dengan Typewriter Effect) --}}
                        <div class="search-segment flex-grow-1">
                            <label class="segment-label">Cari Aktivitas</label>
                            <input type="text" name="search" id="typing-input" class="segment-input" placeholder="Cth: Mengajar..." value="{{ request('search') }}" autocomplete="off">
                        </div>

                        {{-- 2. Lokasi --}}
                        <div class="search-segment" style="flex: 0 0 25%;">
                            <label class="segment-label">Lokasi</label>
                            <input type="text" name="location" class="segment-input" placeholder="Semua Kota" value="{{ request('location') }}">
                        </div>

                        {{-- 3. Kategori --}}
                        <div class="search-segment" style="flex: 0 0 25%;">
                            <label class="segment-label">Kategori</label>
                            <select name="category" class="segment-input cursor-pointer" style="appearance: none;">
                                <option value="">Semua Isu</option>
                                @foreach(['Pendidikan', 'Lingkungan', 'Kesehatan', 'Sosial', 'Teknologi'] as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tombol Cari --}}
                        <button type="submit" class="btn-search-round" title="Cari Misi">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                {{-- Smart Tags (Quick Filters) --}}
                <div class="smart-pills">
                    <span class="text-white small fw-bold mt-2 text-shadow-sm d-none d-md-block">Saran Cepat:</span>
                    <a href="{{ route('events.index', ['category' => 'Lingkungan']) }}" class="pill-item"><i class="fa-solid fa-tree"></i> Lingkungan</a>
                    <a href="{{ route('events.index', ['category' => 'Pendidikan']) }}" class="pill-item"><i class="fa-solid fa-book-open"></i> Pendidikan</a>
                    <a href="{{ route('events.index', ['location' => 'Jakarta']) }}" class="pill-item"><i class="fa-solid fa-map-pin"></i> Di Jakarta</a>
                    <a href="{{ route('events.index', ['sort' => 'salary_desc']) }}" class="pill-item"><i class="fa-solid fa-gift"></i> Ada Benefit</a>
                </div>

            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="container py-5 mt-4">
        
        {{-- Header Result --}}
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h5 class="fw-bold text-dark mb-1">Misi Tersedia <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill ms-2 align-middle" style="font-size: 0.7rem;">{{ $events->total() }}</span></h5>
                @if(request()->anyFilled(['search', 'location', 'category']))
                    <small class="text-muted">Menampilkan hasil pencarian. <a href="{{ route('events.index') }}" class="fw-bold text-danger text-decoration-none">Reset Filter</a></small>
                @endif
            </div>
            
            {{-- Simple Sort --}}
            <form action="{{ route('events.index') }}" method="GET" class="d-none d-md-block">
                @foreach(request()->except('sort') as $key => $val)
                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                @endforeach
                <select name="sort" class="form-select border-0 bg-light rounded-pill fw-bold small text-secondary px-4" onchange="this.form.submit()">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select>
            </form>
        </div>

        {{-- LIST EVENTS --}}
        <div class="row">
            <div class="col-12">
                @forelse($events as $event)
                    <div class="job-card p-0 position-relative">
                        <div class="row g-0">
                            {{-- GAMBAR --}}
                            <div class="col-md-3 position-relative overflow-hidden">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="w-100 h-100 object-fit-cover transition-scale" style="min-height: 180px;" alt="Poster">
                                @else
                                    <div class="bg-light h-100 d-flex align-items-center justify-content-center text-muted" style="min-height: 180px;">
                                        <i class="fa-regular fa-image fa-3x opacity-25"></i>
                                    </div>
                                @endif
                                <span class="badge bg-white text-dark shadow-sm fw-bold px-3 py-1 rounded-pill position-absolute top-0 start-0 m-3 small border">
                                    {{ $event->category }}
                                </span>
                            </div>

                            {{-- KONTEN --}}
                            <div class="col-md-9">
                                <div class="p-4 h-100 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h5 class="mb-1 font-weight-bold">
                                                <a href="{{ route('events.show', $event->id) }}" class="text-dark text-decoration-none stretched-link hover-text-primary transition-all">
                                                    {{ $event->title }}
                                                </a>
                                            </h5>
                                            <div class="text-muted fw-medium x-small d-flex align-items-center flex-wrap gap-3">
                                                <span><i class="fa-solid fa-building text-primary me-1"></i> {{ $event->organizer->name }}</span>
                                                <span><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $event->location }}</span>
                                            </div>
                                        </div>
                                        @if($event->salary)
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 d-none d-md-inline-block">
                                                Benefit Tersedia
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-secondary small flex-grow-1 mb-3 opacity-75" style="line-height: 1.6;">
                                        {{ Str::limit(strip_tags($event->description), 130) }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top border-light">
                                        <div class="x-small text-muted fw-bold">
                                            <i class="fa-regular fa-clock me-1"></i> {{ $event->created_at->diffForHumans() }}
                                            @if($event->applications_count > 0)
                                                <span class="mx-2">•</span> <i class="fa-solid fa-user-group me-1"></i> {{ $event->applications_count }} Pelamar
                                            @endif
                                        </div>
                                        <span class="text-primary fw-bold small group-hover-arrow">
                                            Lihat Detail <i class="fa-solid fa-arrow-right ms-1 transition-transform"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="mb-3"><i class="fa-solid fa-wind fa-4x text-muted opacity-25"></i></div>
                        <h5 class="fw-bold text-dark">Yah, belum ketemu...</h5>
                        <p class="text-muted">Coba cari kata kunci lain atau gunakan kategori berbeda.</p>
                        <a href="{{ route('events.index') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Lihat Semua Misi</a>
                    </div>
                @endforelse

                <div class="mt-5 d-flex justify-content-center">
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT TYPEWRITER EFFECT UNTUK SEARCH --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('typing-input');
            // Cuma jalanin efek kalau input kosong (user belum ngetik)
            if (!input || input.value !== '') return;

            const placeholders = [
                "Cari: Mengajar anak jalanan...",
                "Cari: Tanam bakau...",
                "Cari: Relawan medis...",
                "Cari: Bersih pantai...",
                "Cari: Desain grafis..."
            ];

            let textIndex = 0;
            let charIndex = 0;
            let isDeleting = false;
            let typeSpeed = 100;

            function typeWriter() {
                const currentText = placeholders[textIndex];
                
                if (isDeleting) {
                    input.setAttribute('placeholder', currentText.substring(0, charIndex - 1));
                    charIndex--;
                    typeSpeed = 50; // Hapus lebih cepet
                } else {
                    input.setAttribute('placeholder', currentText.substring(0, charIndex + 1));
                    charIndex++;
                    typeSpeed = 100; // Ngetik normal
                }

                if (!isDeleting && charIndex === currentText.length) {
                    isDeleting = true;
                    typeSpeed = 2000; // Tahan sebentar pas udah ketik semua
                } else if (isDeleting && charIndex === 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % placeholders.length;
                    typeSpeed = 500;
                }

                setTimeout(typeWriter, typeSpeed);
            }

            typeWriter();
        });
    </script>

    <style>
        .transition-scale:hover { transform: scale(1.05); transition: 5s ease; }
        .group-hover-arrow:hover .transition-transform { transform: translateX(5px); }
        .transition-transform { transition: 0.2s; display: inline-block; }
        .x-small { font-size: 0.8rem; }
    </style>
@endsection