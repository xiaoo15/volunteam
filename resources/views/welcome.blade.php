@extends('layouts.app')

@section('content')

    <style>
        /* HERO SECTION */
        .hero-wrapper {
            background: linear-gradient(120deg, #f0f9ff 0%, #e0f2fe 100%);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
            background: linear-gradient(to right, #1e293b, #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-blob {
            position: absolute;
            width: 600px; height: 600px;
            background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);
            opacity: 0.1;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        /* IMPACT CARDS */
        .impact-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .impact-card:hover { transform: translateY(-10px); border-color: #cbd5e1; }
        .impact-number {
            font-size: 3rem;
            font-weight: 900;
            color: #4f46e5;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* TESTIMONIAL */
        .testi-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 40px;
            position: relative;
        }
        .quote-icon {
            position: absolute; top: 20px; left: 20px;
            font-size: 3rem; color: #e2e8f0;
        }
    </style>

    {{-- HERO SECTION --}}
    <div class="hero-wrapper">
        <div class="hero-blob" style="top: -200px; right: -100px;"></div>
        <div class="hero-blob" style="bottom: -200px; left: -100px; background: #fbbf24; opacity: 0.15;"></div>

        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="badge bg-white text-primary border px-3 py-2 rounded-pill shadow-sm mb-4 fw-bold">
                        👋 Halo, Generasi Perubahan!
                    </span>
                    <h1 class="hero-title mb-4">
                        Kebaikan Kecil,<br>
                        <span class="text-primary" style="-webkit-text-fill-color: #4f46e5;">Dampak Besar.</span>
                    </h1>
                    <p class="lead text-secondary mb-5" style="line-height: 1.8;">
                        VolunTeam bukan sekadar platform cari kegiatan. Ini adalah ekosistem bagi kamu yang ingin 
                        mengubah dunia, satu aksi dalam satu waktu. Temukan misimu sekarang.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
                            <i class="fa-solid fa-rocket me-2"></i> Mulai Aksi
                        </a>
                        <a href="#impact" class="btn btn-white border btn-lg rounded-pill px-5 py-3 fw-bold text-dark hover-bg-light">
                            Pelajari Dampak
                        </a>
                    </div>

                    {{-- Trusted By --}}
                    <div class="mt-5 pt-4 border-top border-secondary-subtle">
                        <small class="text-uppercase fw-bold text-muted mb-3 d-block" style="font-size: 0.7rem; letter-spacing: 2px;">Dipercaya Oleh Komunitas:</small>
                        <div class="d-flex gap-4 opacity-50 grayscale-hover">
                            <i class="fa-brands fa-google fa-2x"></i>
                            <i class="fa-brands fa-aws fa-2x"></i>
                            <i class="fa-brands fa-spotify fa-2x"></i>
                            <i class="fa-brands fa-microsoft fa-2x"></i>
                        </div>
                    </div>
                </div>

                {{-- Hero Image / Illustration --}}
                <div class="col-lg-6 text-center">
                    <div class="position-relative d-inline-block">
                        <div class="position-absolute top-50 start-50 translate-middle bg-primary rounded-circle" 
                             style="width: 400px; height: 400px; opacity: 0.1; filter: blur(40px);"></div>

                        {{-- Ganti image ini dengan ilustrasi 3D kalau ada, kalau gak pake Icon FontAwesome aja --}}
                        <i class="fa-solid fa-earth-americas text-primary" 
                           style="font-size: 20rem; transform: rotate(-15deg); filter: drop-shadow(0 20px 50px rgba(79, 70, 229, 0.4));"></i>

                        {{-- Floating Card 1 --}}
                        <div class="card position-absolute top-0 start-0 border-0 shadow-lg p-3 rounded-4 floating-anim" style="width: 180px;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-green-100 text-green-600 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #dcfce7;">
                                    <i class="fa-solid fa-tree text-success"></i>
                                </div>
                                <div class="text-start">
                                    <div class="fw-bold small">1.2k Pohon</div>
                                    <div class="x-small text-muted">Ditanam</div>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Card 2 --}}
                        <div class="card position-absolute bottom-0 end-0 border-0 shadow-lg p-3 rounded-4 floating-anim-delayed" style="width: 200px;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-blue-100 text-blue-600 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #dbeafe;">
                                    <i class="fa-solid fa-graduation-cap text-primary"></i>
                                </div>
                                <div class="text-start">
                                    <div class="fw-bold small">500+ Anak</div>
                                    <div class="x-small text-muted">Terbantu Sekolah</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- IMPACT SECTION --}}
    <div class="py-5 bg-white" id="impact">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-2">Impact Meter</h6>
                <h2 class="fw-bold display-6">Jejak Kebaikan Kita Bersama</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="impact-card text-center">
                        <div class="mb-3">
                            <i class="fa-solid fa-hand-holding-heart fa-3x text-danger opacity-75"></i>
                        </div>
                        <div class="impact-number counter" data-target="{{ \App\Models\Event::count() + 150 }}">0</div>
                        <h5 class="fw-bold text-dark">Misi Terlaksana</h5>
                        <p class="text-muted small px-4">Program sosial yang telah berhasil dijalankan di seluruh Indonesia.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="impact-card text-center">
                        <div class="mb-3">
                            <i class="fa-solid fa-users fa-3x text-primary opacity-75"></i>
                        </div>
                        <div class="impact-number counter" data-target="{{ \App\Models\User::count() + 1200 }}">0</div>
                        <h5 class="fw-bold text-dark">Relawan Bergabung</h5>
                        <p class="text-muted small px-4">Anak muda yang memilih untuk peduli dan turun tangan langsung.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="impact-card text-center">
                        <div class="mb-3">
                            <i class="fa-solid fa-clock fa-3x text-warning opacity-75"></i>
                        </div>
                        <div class="impact-number counter" data-target="8500">0</div>
                        <h5 class="fw-bold text-dark">Jam Kontribusi</h5>
                        <p class="text-muted small px-4">Total waktu yang didonasikan untuk kegiatan sosial dan kemanusiaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TESTIMONIAL SECTION --}}
    <div class="py-5 bg-light position-relative">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="fw-bold display-6 mb-4">Kata Mereka Tentang <span class="text-primary">VolunTeam</span></h2>
                    <p class="text-muted mb-4 lead">
                        "Platform ini mengubah cara saya melihat dunia. Dari sekadar mengisi waktu luang, menjadi sebuah panggilan hati."
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Putri&background=random" class="rounded-circle shadow-sm" width="60">
                        <div>
                            <h6 class="fw-bold mb-0">Sarah Putri</h6>
                            <small class="text-primary fw-bold">Mahasiswi UI & Relawan Pendidikan</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-4">
                        {{-- Testi 1 --}}
                        <div class="col-md-6">
                            <div class="testi-card h-100 bg-white shadow-sm border-0">
                                <i class="fa-solid fa-quote-left text-primary opacity-25 fs-1 mb-3"></i>
                                <p class="text-dark small mb-0">"Sertifikatnya sangat membantu untuk portofolio beasiswa saya. Valid dan desainnya profesional!"</p>
                                <div class="d-flex align-items-center gap-2 mt-3 pt-3 border-top">
                                    <small class="fw-bold">Rizky (SMK 1 Jakarta)</small>
                                </div>
                            </div>
                        </div>
                        {{-- Testi 2 --}}
                        <div class="col-md-6">
                            <div class="testi-card h-100 bg-white shadow-sm border-0">
                                <i class="fa-solid fa-quote-left text-primary opacity-25 fs-1 mb-3"></i>
                                <p class="text-dark small mb-0">"Fitur chat dengan organizer bikin komunikasi lancar. Gak bingung lagi kalau mau tanya detail acara."</p>
                                <div class="d-flex align-items-center gap-2 mt-3 pt-3 border-top">
                                    <small class="fw-bold">Budi (Relawan Lingkungan)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA SECTION --}}
    <div class="py-5" style="background: #1e293b;">
        <div class="container text-center py-5">
            <h2 class="text-white fw-bold mb-4">Siap Menjadi Bagian dari Perubahan?</h2>
            <p class="text-white-50 mb-5 col-lg-6 mx-auto">
                Jangan tunggu nanti. Ribuan komunitas membutuhkan uluran tangan dan keahlianmu sekarang juga.
            </p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg glow-effect">
                    Buat Akun Sekarang
                </a>
            @else
                <a href="{{ route('events.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg glow-effect">
                    Cari Misi Baru
                </a>
            @endguest
        </div>
    </div>

    <style>
        /* ANIMATION UTILS */
        .floating-anim { animation: float 3s ease-in-out infinite; }
        .floating-anim-delayed { animation: float 3s ease-in-out infinite 1.5s; }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .glow-effect {
            animation: glow 2s infinite;
        }

        @keyframes glow {
            0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(79, 70, 229, 0); }
            100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
        }
    </style>

    <script>
        // Simple Counter Animation
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const duration = 2000; // ms
                const increment = target / (duration / 16); // 60fps

                let current = 0;
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.innerText = Math.ceil(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target.toLocaleString() + "+";
                    }
                };
                updateCounter();
            });
        });
    </script>
@endsection