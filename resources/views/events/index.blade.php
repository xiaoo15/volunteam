@extends('layouts.app')

@section('content')

    {{-- CUSTOM CSS UNTUK HALAMAN INI --}}
    <style>
        /* Hero Section Gradient */
        .hero-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            padding: 80px 0 100px 0; /* Padding bawah dilebihin buat space search bar */
            border-bottom: 1px solid #e2e8f0;
            position: relative;
        }

        /* Stats Card */
        .stat-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            border: 1px solid #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Search Container Floating */
        .search-container-floating {
            margin-top: -60px; /* Biar naik ke atas hero */
            z-index: 10;
            position: relative;
        }

        /* Search Form Styling */
        .search-card {
            background: #ffffff;
            border-radius: 50px; /* Bentuk Pill */
            box-shadow: 0 20px 60px -10px rgba(79, 70, 229, 0.15);
            border: 1px solid rgba(0,0,0,0.05);
            padding: 10px;
        }

        .search-label {
            font-size: 0.65rem;
            letter-spacing: 1px;
            color: #94a3b8;
            font-weight: 700;
            display: block;
            margin-bottom: 2px;
            text-transform: uppercase;
        }

        .search-input {
            border: none;
            background: transparent;
            padding: 0;
            font-weight: 600;
            font-size: 1rem;
            color: #1e293b;
            width: 100%;
            outline: none;
        }

        .search-input::placeholder { color: #cbd5e1; font-weight: 500; }

        .search-select {
            border: none;
            background: transparent;
            padding: 0;
            font-weight: 600;
            font-size: 1rem;
            color: #1e293b;
            width: 100%;
            outline: none;
            cursor: pointer;
            -webkit-appearance: none;
            background-image: none;
        }

        .field-divider {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 40%;
            width: 1px;
            background-color: #e2e8f0;
        }

        /* Hover Effects Input Group */
        .search-group {
            border-radius: 30px;
            transition: all 0.2s;
        }
        .search-group:hover {
            background-color: #f8fafc;
        }

        /* Filter Sidebar */
        .filter-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            position: sticky;
            top: 100px; /* Sticky Sidebar */
        }

        /* JOB CARD STYLE */
        .job-card {
            background: white;
            border-radius: 16px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
            border-color: #c7d2fe;
        }

        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, #4f46e5, #818cf8);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .job-card:hover::before { opacity: 1; }

        .salary-badge {
            background: #ecfdf5;
            color: #059669;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 8px;
        }

        /* Pagination Custom */
        .page-item.active .page-link {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
        .page-link { color: #4f46e5; border-radius: 8px; margin: 0 2px; }
        .page-link:hover { background-color: #e0e7ff; color: #3730a3; }

    </style>

    {{-- HERO SECTION --}}
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-7">
                    <span class="badge bg-white text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">
                        🚀 Platform Karir #1 untuk SMK
                    </span>
                    <h1 class="display-4 fw-bold text-dark mb-3" style="letter-spacing: -1px; line-height: 1.2;">
                        Temukan Karir & <br><span class="text-primary">Misi Sosial</span> Impianmu
                    </h1>
                    <p class="lead text-muted mb-4 pe-lg-5">
                        Bergabung dengan ekosistem VolunTeam. Cari pengalaman magang, volunteer, atau kerja full-time yang
                        sesuai passion kamu.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#list-lowongan" class="btn btn-primary btn-lg rounded-pill px-5 shadow-lg fw-bold">
                            <i class="fa-solid fa-magnifying-glass me-2"></i> Mulai Mencari
                        </a>
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-white border btn-lg rounded-pill px-5 fw-bold text-primary hover-bg-light">
                            <i class="fa-solid fa-user-plus me-2"></i> Gabung Talent
                        </a>
                        @endguest
                    </div>
                </div>
                {{-- Ilustrasi Hero --}}
                <div class="col-lg-5 d-none d-lg-block text-center position-relative">
                    <div class="position-absolute top-50 start-50 translate-middle w-75 h-75 bg-primary opacity-25 rounded-circle" style="filter: blur(80px);"></div>
                    <i class="fa-solid fa-rocket text-primary position-relative z-1"
                        style="font-size: 15rem; transform: rotate(-15deg); filter: drop-shadow(0 20px 30px rgba(79, 70, 229, 0.3));"></i>
                </div>
            </div>

            {{-- Stats (Data Real) --}}
            <div class="row g-4 mt-5">
                <div class="col-6 col-md-3">
                    <div class="stat-card text-center h-100">
                        <div class="stat-value">{{ \App\Models\Event::where('status', 'open')->count() }}+</div>
                        <div class="stat-label">Lowongan Aktif</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card text-center h-100">
                        <div class="stat-value">{{ \App\Models\User::where('role', 'organizer')->count() }}+</div>
                        <div class="stat-label">Mitra Perusahaan</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card text-center h-100">
                        <div class="stat-value">{{ \App\Models\User::where('role', 'volunteer')->count() }}</div>
                        <div class="stat-label">Talent Bergabung</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card text-center h-100">
                        <div class="stat-value">{{ \App\Models\Application::where('status', 'completed')->count() }}</div>
                        <div class="stat-label">Alumni Sukses</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SEARCH BAR FLOATING --}}
    <div class="container search-container-floating" id="list-lowongan">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="search-card">
                    <form action="{{ route('events.index') }}" method="GET">
                        <div class="row g-0 align-items-center">
                            
                            {{-- 1. Keyword --}}
                            <div class="col-lg-4 position-relative">
                                <div class="d-flex align-items-center px-4 py-3 search-group">
                                    <i class="fas fa-search text-primary fs-5 me-3"></i>
                                    <div class="w-100">
                                        <label class="search-label">CARI LOWONGAN</label>
                                        <input type="text" name="search" class="search-input" 
                                               placeholder="Cth: Desain Grafis, IT Support..." 
                                               value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="field-divider d-none d-lg-block"></div>
                            </div>

                            {{-- 2. Lokasi --}}
                            <div class="col-lg-3 position-relative">
                                <div class="d-flex align-items-center px-4 py-3 search-group">
                                    <i class="fas fa-map-marker-alt text-danger fs-5 me-3"></i>
                                    <div class="w-100">
                                        <label class="search-label">LOKASI</label>
                                        <input type="text" name="location" class="search-input" 
                                               placeholder="Semua Kota" 
                                               value="{{ request('location') }}">
                                    </div>
                                </div>
                                <div class="field-divider d-none d-lg-block"></div>
                            </div>

                            {{-- 3. Kategori --}}
                            <div class="col-lg-3 position-relative">
                                <div class="d-flex align-items-center px-4 py-3 search-group">
                                    <i class="fas fa-tag text-warning fs-5 me-3"></i>
                                    <div class="w-100">
                                        <label class="search-label">KATEGORI</label>
                                        <select name="category" class="search-select text-dark cursor-pointer">
                                            <option value="">Semua Kategori</option>
                                            @foreach(['Pendidikan', 'Lingkungan', 'Kesehatan', 'Sosial', 'Teknologi'] as $cat)
                                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- 4. Tombol Cari --}}
                            <div class="col-lg-2 ps-2 pe-2">
                                <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold h-100 d-flex align-items-center justify-content-center shadow-md">
                                    <i class="fas fa-arrow-right me-2"></i> CARI
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT (LISTING & SIDEBAR) --}}
    <div class="container py-5 mt-4">
        <div class="row">
            
            {{-- SIDEBAR FILTERS (Visual Only / Simple) --}}
            <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="filter-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="fas fa-sliders-h text-primary me-2"></i> Filter
                        </h5>
                        @if(request()->anyFilled(['search', 'location', 'category', 'sort']))
                            <a href="{{ route('events.index') }}" class="text-danger fw-bold text-decoration-none small">
                                RESET
                            </a>
                        @endif
                    </div>

                    <form action="{{ route('events.index') }}" method="GET">
                        {{-- Keep search params --}}
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        
                        {{-- Kategori (Radio Button Style) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small mb-3">KATEGORI UTAMA</label>
                            <div class="d-flex flex-column gap-2">
                                <label class="form-check-label d-flex align-items-center p-2 rounded hover-bg-light cursor-pointer">
                                    <input type="radio" name="category" value="" class="form-check-input me-2" {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()">
                                    Semua
                                </label>
                                @foreach(['Pendidikan', 'Lingkungan', 'Kesehatan', 'Sosial', 'Teknologi'] as $cat)
                                    <label class="form-check-label d-flex align-items-center p-2 rounded hover-bg-light cursor-pointer">
                                        <input type="radio" name="category" value="{{ $cat }}" class="form-check-input me-2" {{ request('category') == $cat ? 'checked' : '' }} onchange="this.form.submit()">
                                        {{ $cat }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Sorting --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small mb-3">URUTKAN</label>
                            <select name="sort" class="form-select bg-light border-0 py-2" onchange="this.form.submit()">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Paling Baru</option>
                                <option value="salary_desc" {{ request('sort') == 'salary_desc' ? 'selected' : '' }}>Gaji Tertinggi</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            </select>
                        </div>
                    </form>

                    {{-- Banner Promo Kecil --}}
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4 mt-4 text-center">
                        <i class="fa-solid fa-crown text-primary fa-2x mb-2"></i>
                        <h6 class="fw-bold text-dark">Upgrade Skill?</h6>
                        <p class="small text-muted mb-2">Dapatkan akses ke event eksklusif.</p>
                        <button class="btn btn-sm btn-primary rounded-pill w-100">Pelajari Lebih Lanjut</button>
                    </div>
                </div>
            </div>

            {{-- JOB LISTINGS --}}
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4 ps-2">
                    <h5 class="fw-bold text-dark mb-0">
                        Menampilkan <span class="text-primary fw-bolder" style="font-size: 1.2em;">{{ $events->total() }}</span> Lowongan
                    </h5>
                    <div class="text-muted small">
                        Halaman {{ $events->currentPage() }} dari {{ $events->lastPage() }}
                    </div>
                </div>

                @forelse($events as $event)
                    <div class="job-card p-0">
                        <div class="row g-0">
                            {{-- Image Section --}}
                            <div class="col-md-3 position-relative">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid h-100 object-fit-cover"
                                         style="min-height: 200px; width: 100%; border-right: 1px solid #f1f5f9;" alt="Poster">
                                @else
                                    <div class="bg-light h-100 d-flex align-items-center justify-content-center text-muted"
                                         style="min-height: 200px; border-right: 1px solid #f1f5f9;">
                                        <div class="text-center">
                                            <i class="fa-regular fa-image fa-3x mb-2 opacity-50"></i>
                                            <br><small>No Image</small>
                                        </div>
                                    </div>
                                @endif
                                
                                {{-- Badge Category Overlay --}}
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-white text-dark shadow-sm fw-bold px-3 py-2 rounded-pill border">
                                        {{ $event->category ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content Section --}}
                            <div class="col-md-9">
                                <div class="p-4 h-100 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h4 class="mb-1 font-weight-bold">
                                                <a href="{{ route('events.show', $event->id) }}" class="text-dark text-decoration-none stretched-link hover-text-primary transition-all">
                                                    {{ $event->title }}
                                                </a>
                                            </h4>
                                            <div class="text-muted fw-medium small mb-2 d-flex align-items-center">
                                                <span class="text-primary me-2"><i class="fa-solid fa-building"></i> {{ $event->organizer->name }}</span>
                                                <span class="mx-2">•</span>
                                                <span><i class="fa-solid fa-location-dot text-danger"></i> {{ $event->location }}</span>
                                            </div>
                                        </div>
                                        @if($event->salary)
                                            <div class="salary-badge shadow-sm">
                                                {{ $event->salary }}
                                            </div>
                                        @endif
                                    </div>

                                    <p class="text-secondary small flex-grow-1 mb-3" style="line-height: 1.6;">
                                        {{ Str::limit(strip_tags($event->description), 140) }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top border-light">
                                        <div class="small text-muted d-flex gap-3">
                                            <span><i class="fa-regular fa-clock me-1"></i> Posted {{ $event->created_at->diffForHumans() }}</span>
                                            <span><i class="fa-solid fa-user-group me-1"></i> {{ $event->applications_count ?? 0 }} Pelamar</span>
                                        </div>
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary rounded-pill px-4 btn-sm position-relative z-2 fw-bold shadow-sm">
                                            Lihat Detail <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- EMPTY STATE --}}
                    <div class="text-center py-5 bg-white rounded-4 border border-dashed">
                        <div class="mb-3">
                            <i class="fa-solid fa-magnifying-glass-minus fa-4x text-muted opacity-25"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Yah, belum ada lowongan nih.</h4>
                        <p class="text-muted mb-4">Coba ganti kata kunci atau filter lainnya ya.</p>
                        <a href="{{ route('events.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-redo me-2"></i> Reset Filter
                        </a>
                    </div>
                @endforelse

                {{-- PAGINATION --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- ADDITIONAL STYLES FOR DETAILS --}}
    <style>
        .hover-text-primary:hover { color: #4f46e5 !important; }
        .hover-bg-light:hover { background-color: #f8fafc; }
        .cursor-pointer { cursor: pointer; }
        .border-dashed { border-style: dashed !important; }
        .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
    </style>

@endsection