@extends('layouts.app')

@section('content')

    {{-- 1. MODERN HERO SECTION --}}
    <section class="position-relative overflow-hidden" style="
        background: linear-gradient(135deg, 
            rgba(79, 70, 229, 1) 0%, 
            rgba(99, 102, 241, 1) 50%, 
            rgba(129, 140, 248, 1) 100%);
        padding-top: 6rem;
        padding-bottom: 6rem;
    ">
        {{-- Background Particles --}}
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="
                background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMTAwMCAxMDAwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InJnYmEoMjU1LCAyNTUsIDI1NSwgMC4wNCkiPjwvcmVjdD48L3N2Zz4=');
                opacity: 0.3;
            "></div>

            {{-- Floating Elements --}}
            <div class="position-absolute"
                style="top: 20%; left: 10%; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; animation: float 20s infinite linear;">
            </div>
            <div class="position-absolute"
                style="top: 60%; right: 15%; width: 60px; height: 60px; background: rgba(255,255,255,0.05); border-radius: 50%; animation: float 25s infinite linear reverse;">
            </div>
            <div class="position-absolute"
                style="top: 40%; left: 20%; width: 30px; height: 30px; background: rgba(255,255,255,0.08); border-radius: 50%; animation: float 15s infinite linear;">
            </div>
        </div>

        <div class="container position-relative z-2">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <span
                            class="badge bg-white bg-opacity-25 border border-white border-opacity-25 rounded-pill px-4 py-2 mb-3 fw-bold d-inline-flex align-items-center">
                            <i class="fa-solid fa-bolt me-2"></i> Platform Pengembangan Karir #1
                        </span>
                        <h1 class="display-4 fw-bold text-white mb-4"
                            style="line-height: 1.2; text-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                            Bangun <span class="text-warning">Pengalaman</span> yang Bermakna
                        </h1>
                        <p class="lead text-white mb-5 opacity-75" style="font-size: 1.25rem;">
                            Temukan kesempatan magang, volunteer, dan proyek kolaborasi untuk mengasah skill dan memperluas
                            jaringan profesionalmu.
                        </p>

                        <div class="d-flex flex-wrap gap-3 mb-5">
                            <a href="{{ route('events.index') }}"
                                class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow-lg hover-lift">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> Jelajahi Lowongan
                            </a>
                            @guest
                                <a href="{{ route('register') }}"
                                    class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold border-2 hover-lift">
                                    <i class="fa-solid fa-user-plus me-2"></i> Gabung Gratis
                                </a>
                            @endguest
                        </div>

                        <div class="d-flex align-items-center text-white">
                            <div class="d-flex align-items-center me-4">
                                <div class="rounded-circle bg-white bg-opacity-25 p-2 me-2">
                                    <i class="fa-solid fa-check fa-sm"></i>
                                </div>
                                <small>100% Gratis</small>
                            </div>
                            <div class="d-flex align-items-center me-4">
                                <div class="rounded-circle bg-white bg-opacity-25 p-2 me-2">
                                    <i class="fa-solid fa-check fa-sm"></i>
                                </div>
                                <small>Sertifikat Resmi</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white bg-opacity-25 p-2 me-2">
                                    <i class="fa-solid fa-check fa-sm"></i>
                                </div>
                                <small>Jaringan Profesional</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="position-relative">
                        <div class="position-absolute top-50 start-50 translate-middle"
                            style="width: 500px; height: 500px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%); border-radius: 50%;">
                        </div>

                        <div class="position-relative">
                            {{-- Hero Illustration --}}
                            <div class="bg-white bg-opacity-10 border border-white border-opacity-20 rounded-4 p-4 shadow-lg"
                                style="backdrop-filter: blur(10px);">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="bg-white rounded-3 p-3 shadow-sm">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                    <i class="fa-solid fa-calendar-check text-primary"></i>
                                                </div>
                                                <span class="fw-bold">Event Aktif</span>
                                            </div>
                                            <h4 class="fw-bold text-dark mb-0">{{ $stats['events'] }}+</h4>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-white rounded-3 p-3 shadow-sm">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                                    <i class="fa-solid fa-users text-success"></i>
                                                </div>
                                                <span class="fw-bold">Volunteer</span>
                                            </div>
                                            <h4 class="fw-bold text-dark mb-0">{{ $stats['volunteers'] }}+</h4>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg-white rounded-3 p-4 shadow-sm">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-shrink-0">
                                                    <img src="https://ui-avatars.com/api/?name=User+Test&background=4f46e5&color=fff&size=50"
                                                        class="rounded-circle" alt="User">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="mb-1 fw-bold">"Bergabung di VolunTeam membuka banyak
                                                        kesempatan untuk berkembang!"</p>
                                                    <small class="text-muted">— Sarah, Mahasiswa Teknik</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Wave Divider --}}
        <div class="position-absolute bottom-0 start-0 w-100" style="overflow: hidden;">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: #ffffff; width: 100%; height: 70px;">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                </path>
            </svg>
        </div>
    </section>

    {{-- 2. ENHANCED STATISTICS SECTION --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                @php
                    $statsItems = [
                        ['count' => $stats['events'], 'label' => 'Lowongan Aktif', 'icon' => 'calendar-check', 'color' => 'primary'],
                        ['count' => $stats['volunteers'], 'label' => 'Talent Bergabung', 'icon' => 'users', 'color' => 'success'],
                        ['count' => $stats['organizers'], 'label' => 'Mitra Organizer', 'icon' => 'building', 'color' => 'warning'],
                        ['count' => '100%', 'label' => 'Gratis Selamanya', 'icon' => 'gem', 'color' => 'info']
                    ];
                @endphp

                @foreach($statsItems as $item)
                    <div class="col-md-3 col-6">
                        <div class="text-center p-4 hover-scale" style="transition: transform 0.3s ease;">
                            <div class="icon-wrapper mx-auto mb-3">
                                <div class="rounded-circle bg-{{ $item['color'] }} bg-opacity-10 p-3 d-inline-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="fa-solid fa-{{ $item['icon'] }} fa-2x text-{{ $item['color'] }}"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold text-dark mb-2 display-6">{{ $item['count'] }}</h3>
                            <p class="text-muted mb-0 fw-medium">{{ $item['label'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 3. PREMIUM FEATURES SECTION --}}
    <section class="py-6 bg-light position-relative">
        <div class="container position-relative z-1">
            <div class="text-center mb-6">
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3 fw-bold">
                    <i class="fa-solid fa-star me-1"></i> KEUNGGULAN KAMI
                </span>
                <h2 class="fw-bold text-dark mb-3 display-5">Mengapa Memilih VolunTeam?</h2>
                <p class="text-muted lead mx-auto" style="max-width: 700px;">Platform yang dirancang khusus untuk membantu
                    generasi muda membangun karir yang gemilang.</p>
            </div>

            <div class="row g-4">
                @php
                    $features = [
                        [
                            'icon' => 'certificate',
                            'title' => 'Sertifikat Digital Terverifikasi',
                            'desc' => 'Dapatkan sertifikat resmi dengan sistem verifikasi yang bisa diverifikasi oleh perusahaan.',
                            'color' => 'primary',
                            'points' => ['Valid secara nasional', 'Bisa di-share ke LinkedIn', 'Kode verifikasi unik']
                        ],
                        [
                            'icon' => 'users',
                            'title' => 'Jejaring Profesional',
                            'desc' => 'Bangun jaringan dengan mentor, rekan, dan profesional di berbagai bidang industri.',
                            'color' => 'success',
                            'points' => ['Komunitas eksklusif', 'Networking events', 'Mentor berpengalaman']
                        ],
                        [
                            'icon' => 'briefcase',
                            'title' => 'Persiapan Karir Lengkap',
                            'desc' => 'Dapatkan pengalaman nyata yang dicari perusahaan dan tingkatkan portofoliomu.',
                            'color' => 'warning',
                            'points' => ['Skill-based learning', 'Portofolio digital', 'Career guidance']
                        ],
                        [
                            'icon' => 'bolt',
                            'title' => 'Fleksibel & Terjangkau',
                            'desc' => 'Ikuti program sesuai jadwalmu tanpa biaya pendaftaran atau biaya tersembunyi.',
                            'color' => 'info',
                            'points' => ['Waktu fleksibel', '100% gratis', 'Akses seumur hidup']
                        ],
                        [
                            'icon' => 'chart-line',
                            'title' => 'Tracking Progress',
                            'desc' => 'Pantau perkembangan skill dan pencapaianmu dengan dashboard yang interaktif.',
                            'color' => 'danger',
                            'points' => ['Progress tracker', 'Skill assessment', 'Achievement badges']
                        ],
                        [
                            'icon' => 'handshake',
                            'title' => 'Partner Terpercaya',
                            'desc' => 'Berkolaborasi dengan organisasi dan perusahaan terkemuka di Indonesia.',
                            'color' => 'purple',
                            'points' => ['Perusahaan ternama', 'Organisasi nirlaba', 'Startup inovatif']
                        ]
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-lift feature-card">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-3 bg-{{ $feature['color'] }} bg-opacity-10 p-3">
                                            <i
                                                class="fa-solid fa-{{ $feature['icon'] }} fa-xl text-{{ $feature['color'] }}"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-bold text-dark mb-1">{{ $feature['title'] }}</h5>
                                        <p class="text-muted small mb-0">{{ $feature['desc'] }}</p>
                                    </div>
                                </div>

                                <ul class="list-unstyled mb-0">
                                    @foreach($feature['points'] as $point)
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fa-solid fa-check-circle text-{{ $feature['color'] }} me-2 fa-sm"></i>
                                            <small class="text-muted">{{ $point }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-{{ $feature['color'] }}" style="width: {{ rand(80, 100) }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. PREMIUM EVENT CARDS SECTION --}}
    <section class="py-6 bg-white">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-8">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-2 fw-bold">
                        <i class="fa-solid fa-fire me-1"></i> LOWONGAN POPULER
                    </span>
                    <h2 class="fw-bold text-dark mb-2 display-5">Kesempatan Terbaru</h2>
                    <p class="text-muted mb-0">Temukan lowongan yang sesuai dengan passion dan kemampuanmu</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('events.index') }}"
                        class="btn btn-outline-primary btn-lg rounded-pill px-4 fw-bold d-inline-flex align-items-center">
                        Lihat Semua
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                @foreach($latestEvents as $event)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 event-card">
                            <div class="position-relative">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top object-fit-cover"
                                        style="height: 220px;" alt="{{ $event->title }}">
                                @else
                                    <div class="bg-gradient-primary d-flex align-items-center justify-content-center text-white"
                                        style="height: 220px; background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);">
                                        <div class="text-center p-4">
                                            <i class="fa-solid fa-calendar-star fa-3x mb-3"></i>
                                            <h6 class="fw-bold mb-0">{{ $event->category }}</h6>
                                        </div>
                                    </div>
                                @endif

                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill">
                                        <i class="fa-solid fa-clock me-1"></i>
                                        {{ $event->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-dark bg-opacity-75 text-white px-3 py-2 rounded-pill">
                                        {{ $event->category }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <h5 class="card-title fw-bold text-dark mb-2" style="line-height: 1.4;">
                                        {{ Str::limit($event->title, 50) }}
                                    </h5>
                                    <div class="d-flex align-items-center text-muted mb-3">
                                        <i class="fa-solid fa-building me-2 fa-sm"></i>
                                        <small class="fw-medium">{{ $event->organizer->name }}</small>
                                    </div>
                                </div>

                                <div class="row g-2 mb-4">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center text-muted">
                                            <div class="rounded-circle bg-light p-2 me-2">
                                                <i class="fa-solid fa-location-dot fa-xs"></i>
                                            </div>
                                            <small>{{ $event->location }}</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center text-muted">
                                            <div class="rounded-circle bg-light p-2 me-2">
                                                <i class="fa-solid fa-calendar fa-xs"></i>
                                            </div>
                                            <small>{{ $event->event_date->format('d M') }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            <i class="fa-solid fa-users me-1"></i>
                                            {{ $event->applications_count ?? 0 }} Pendaftar
                                        </span>
                                    </div>
                                    <a href="{{ route('events.show', $event->id) }}"
                                        class="btn btn-primary rounded-pill px-4 fw-bold">
                                        Detail
                                        <i class="fa-solid fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 5. PREMIUM CTA SECTION --}}
    <section class="py-6 position-relative overflow-hidden"
        style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
            <div class="position-absolute" style="
                top: -100px; right: -100px; 
                width: 300px; height: 300px;
                background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 70%);
                border-radius: 50%;
            "></div>
            <div class="position-absolute" style="
                bottom: -150px; left: -150px; 
                width: 400px; height: 400px;
                background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, rgba(255,255,255,0) 70%);
                border-radius: 50%;
            "></div>
        </div>

        <div class="container position-relative z-2">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="bg-white bg-opacity-10 border border-white border-opacity-10 rounded-4 p-5 shadow-lg"
                        style="backdrop-filter: blur(10px);">
                        <span class="badge bg-white bg-opacity-25 text-white rounded-pill px-3 py-2 mb-4 fw-bold">
                            <i class="fa-solid fa-gem me-2"></i> LIMITED SPOTS AVAILABLE
                        </span>

                        <h2 class="text-white fw-bold display-5 mb-4">Mulai Perjalanan Karirmu Hari Ini!</h2>

                        <p class="text-white-50 lead mb-5" style="font-size: 1.25rem;">
                            Bergabung dengan <span class="fw-bold text-warning">ribuan talenta muda</span> yang sudah meraih
                            pengalaman berharga dan sertifikat profesional.
                        </p>

                        <div class="row g-4 justify-content-center">
                            <div class="col-md-6">
                                <div class="bg-white rounded-4 p-4 shadow">
                                    <h4 class="fw-bold text-dark mb-3">Untuk Talent</h4>
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fa-solid fa-check-circle text-success me-2"></i>
                                            <span class="text-muted">Akses ke semua event</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fa-solid fa-check-circle text-success me-2"></i>
                                            <span class="text-muted">Sertifikat digital</span>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="fa-solid fa-check-circle text-success me-2"></i>
                                            <span class="text-muted">Networking eksklusif</span>
                                        </li>
                                    </ul>
                                    <a href="{{ route('register') }}"
                                        class="btn btn-primary w-100 rounded-pill fw-bold py-3">
                                        Daftar sebagai Talent
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-white rounded-4 p-4 shadow">
                                    <h4 class="fw-bold text-dark mb-3">Untuk Organizer</h4>
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fa-solid fa-check-circle text-success me-2"></i>
                                            <span class="text-muted">Publikasi event</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fa-solid fa-check-circle text-success me-2"></i>
                                            <span class="text-muted">Manajemen peserta</span>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="fa-solid fa-check-circle text-success me-2"></i>
                                            <span class="text-muted">Sistem sertifikat otomatis</span>
                                        </li>
                                    </ul>
                                    <a href="{{ route('register') }}?type=organizer"
                                        class="btn btn-outline-primary w-100 rounded-pill fw-bold py-3">
                                        Daftar sebagai Organizer
                                    </a>
                                </div>
                            </div>
                        </div>

                        <p class="text-white-50 small mt-5 mb-0">
                            <i class="fa-solid fa-lock me-1"></i> Data Anda aman dengan kami • Tidak ada biaya pendaftaran
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .feature-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.15) !important;
        }

        .event-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
        }

        .event-card:hover .card-title {
            color: #4f46e5 !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);
        }

        .text-purple {
            color: #8b5cf6 !important;
        }

        .text-purple {
            color: #8b5cf6 !important;
        }

        .bg-purple {
            background-color: #8b5cf6 !important;
        }

        /* Ganti class aneh tadi jadi ini: */
        .bg-purple.bg-opacity-10 {
            background-color: rgba(139, 92, 246, 0.1) !important;
        }

        .bg-purple-bg-opacity-10 {
            background-color: rgba(139, 92, 246, 0.1) !important;
        }

        .py-6 {
            padding-top: 5rem !important;
            padding-bottom: 5rem !important;
        }

        .progress-bar {
            transition: width 1.5s ease-in-out;
        }

        .feature-card:hover .progress-bar {
            width: 100% !important;
        }
    </style>

@endsection