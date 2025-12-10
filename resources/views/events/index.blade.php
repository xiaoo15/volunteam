@extends('layouts.app')

@section('content')

    <style>
        /* Hero Section Gradient */
        .hero-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            padding: 60px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Stats Card */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            color: #4f46e5;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
        }

        /* Filter Sidebar */
        .filter-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #334155;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .form-select,
        .form-control {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 10px;
            font-size: 0.95rem;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        /* JOB CARD STYLE (DeepSeek Version) */
        .job-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #818cf8;
        }

        /* Garis warna di kiri kartu */
        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, #4f46e5, #818cf8);
            border-radius: 4px 0 0 4px;
        }

        .job-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: #1e293b;
            text-decoration: none;
        }

        .job-company {
            color: #4f46e5;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
            color: #64748b;
            font-size: 0.9rem;
        }

        .job-meta i {
            color: #94a3b8;
        }

        /* Badges */
        .badge-soft-primary {
            background-color: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
        }

        .badge-soft-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .badge-soft-secondary {
            background-color: rgba(100, 116, 139, 0.1);
            color: #64748b;
        }
    </style>

    <div class="hero-section mb-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-7">
                    <span class="badge badge-soft-primary px-3 py-2 rounded-pill mb-3 fw-bold">🚀 Platform #1 SMK</span>
                    <h1 class="display-4 fw-bold text-dark mb-3" style="letter-spacing: -1px;">
                        Temukan Karir & <br>Misi Sosial Impianmu
                    </h1>
                    <p class="lead text-muted mb-4">
                        Bergabung dengan ekosistem VolunTeam. Cari pengalaman magang, volunteer, atau kerja full-time yang
                        sesuai passion kamu.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#list-lowongan" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                            <i class="fa-solid fa-magnifying-glass me-2"></i> Mulai Mencari
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4">
                            <i class="fa-solid fa-user-plus me-2"></i> Gabung Talent
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <i class="fa-solid fa-rocket text-primary opacity-10"
                        style="font-size: 15rem; transform: rotate(-15deg);"></i>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center h-100">
                        <div class="stat-value">{{ $events->count() }}+</div>
                        <div class="stat-label">Lowongan Aktif</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center h-100">
                        <div class="stat-value">500+</div>
                        <div class="stat-label">Perusahaan & Org</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center h-100">
                        <div class="stat-value">1,2k</div>
                        <div class="stat-label">Talent Bergabung</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center h-100">
                        <div class="stat-value">98%</div>
                        <div class="stat-label">Success Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5" id="list-lowongan">
        <div class="row">

            <div class="col-lg-3 mb-4">
                <div class="filter-card p-4 sticky-top" style="top: 100px; z-index: 10;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0"><i class="fa-solid fa-sliders me-2"></i> Filter</h5>
                        <a href="{{ route('events.index') }}"
                            class="text-decoration-none small text-danger fw-bold">Reset</a>
                    </div>

                    <form action="{{ route('events.index') }}" method="GET">
                        <div class="mb-4">
                            <label class="form-label">Kata Kunci</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0"
                                    placeholder="Posisi, event..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Lokasi</label>
                            <select name="location" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Lokasi</option>
                                <option value="Jakarta" {{ request('location') == 'Jakarta' ? 'selected' : '' }}>Jakarta
                                </option>
                                <option value="Surabaya" {{ request('location') == 'Surabaya' ? 'selected' : '' }}>Surabaya
                                </option>
                                <option value="Bandung" {{ request('location') == 'Bandung' ? 'selected' : '' }}>Bandung
                                </option>
                                <option value="Sidoarjo" {{ request('location') == 'Sidoarjo' ? 'selected' : '' }}>Sidoarjo
                                </option>
                                <option value="Online" {{ request('location') == 'Online' ? 'selected' : '' }}>Online / Remote
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label mb-2">Kategori</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" value="" id="cat_all" {{ request('category') == '' ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="cat_all">Semua</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" value="Teknologi" id="cat_tech"
                                    {{ request('category') == 'Teknologi' ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="cat_tech">Teknologi & IT</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" value="Sosial" id="cat_soc" {{ request('category') == 'Sosial' ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="cat_soc">Sosial & Lingkungan</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" value="Kreatif" id="cat_des" {{ request('category') == 'Kreatif' ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="cat_des">Desain & Kreatif</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold shadow-sm">
                            Terapkan Filter
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0">
                        Menampilkan <span class="text-primary">{{ $events->count() }}</span> Lowongan
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-white border dropdown-toggle rounded-pill px-3 text-muted" type="button"
                            data-bs-toggle="dropdown">
                            Urutkan: Terbaru
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="#">Paling Baru</a></li>
                            <li><a class="dropdown-item" href="#">Gaji Tertinggi</a></li>
                        </ul>
                    </div>
                </div>

                @forelse($events as $event)
                    <div class="job-card p-0 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-3 position-relative">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid h-100 object-fit-cover"
                                        style="min-height: 200px; width: 100%;" alt="Poster">
                                @else
                                    <div class="bg-light h-100 d-flex align-items-center justify-content-center text-muted"
                                        style="min-height: 200px;">
                                        <div class="text-center">
                                            <i class="fa-regular fa-image fa-3x mb-2"></i>
                                            <br>No Image
                                        </div>
                                    </div>
                                @endif

                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-white text-dark shadow-sm">{{ $event->category ?? 'Umum' }}</span>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="p-4 h-100 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h4 class="mb-1 font-weight-bold">
                                                <a href="{{ route('events.show', $event->id) }}"
                                                    class="text-dark text-decoration-none stretched-link">
                                                    {{ $event->title }}
                                                </a>
                                            </h4>
                                            <div class="text-primary fw-bold small mb-2">
                                                <i class="fa-solid fa-building me-1"></i> {{ $event->organizer->name }}
                                            </div>
                                        </div>
                                        @if($event->salary)
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                                {{ $event->salary }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-muted small flex-grow-1">
                                        {{ Str::limit($event->description, 120) }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                        <div class="small text-muted">
                                            <i class="fa-solid fa-location-dot me-1"></i> {{ $event->location }} &bull;
                                            <i class="fa-regular fa-clock me-1"></i> {{ $event->created_at->diffForHumans() }}
                                        </div>
                                        <button class="btn btn-primary rounded-pill px-4 btn-sm">Lihat Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

                <div class="mt-4 d-flex justify-content-center">
                </div>
            </div>
        </div>
    </div>
@endsection