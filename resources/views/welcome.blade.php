@extends('layouts.app')

@section('content')

    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #64748b;
            --dark: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* 1. BACKGROUND GRID PATTERN (TECH VIBES) */
        .hero-section {
            background-color: #f8fafc;
            background-image: linear-gradient(#e2e8f0 1px, transparent 1px), linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
            position: relative;
            padding: 120px 0 100px;
            overflow: hidden;
        }
        
        /* Fading effect di bawah hero */
        .hero-section::after {
            content: '';
            position: absolute; left: 0; right: 0; bottom: 0; height: 150px;
            background: linear-gradient(to bottom, transparent, white);
        }

        /* 2. TYPOGRAPHY KELAS ATAS */
        .display-title {
            font-size: 3.8rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--dark);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #9333ea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* 3. GLASSMORPHISM CARDS */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.05), 0 8px 16px -6px rgba(0, 0, 0, 0.05);
            border-radius: 24px;
        }

        /* 4. ANIMATIONS */
        .hover-scale { transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .hover-scale:hover { transform: scale(1.02) translateY(-5px); }

        .float-1 { animation: float 6s ease-in-out infinite; }
        .float-2 { animation: float 5s ease-in-out infinite 1s; }
        .float-3 { animation: float 7s ease-in-out infinite 2s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* UTILS */
        .btn-xl {
            padding: 18px 36px;
            font-size: 1.1rem;
            border-radius: 16px;
        }
        
        .blob {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.4;
        }
    </style>

    
    <section class="hero-section">
        
        <div class="blob bg-primary rounded-circle" style="width: 500px; height: 500px; top: -100px; right: -100px; opacity: 0.15;"></div>
        <div class="blob bg-info rounded-circle" style="width: 400px; height: 400px; bottom: 0; left: -100px; opacity: 0.1;"></div>

        <div class="container position-relative z-2">
            <div class="row align-items-center">
                
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-white border shadow-sm mb-4">
                        <span class="badge bg-primary rounded-pill">NEW</span>
                        <span class="small fw-bold text-secondary">Platform Relawan #1 di Indonesia</span>
                    </div>

                    <h1 class="display-title mb-4">
                        Ubah Niat Baik Jadi<br>
                        <span class="text-gradient">Aksi Nyata.</span>
                    </h1>
                    
                    <p class="lead text-secondary mb-5" style="max-width: 90%;">
                        VolunTeam menghubungkanmu dengan ribuan misi sosial yang butuh keahlianmu. 
                        Dilengkapi <strong>AI Matching</strong> untuk menemukan kegiatan yang paling pas buat kamu.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-primary btn-xl fw-bold shadow-lg hover-scale">
                                <i class="fa-solid fa-rocket me-2"></i> Gabung Sekarang
                            </a>
                        @else
                            <a href="{{ route('events.index') }}" class="btn btn-primary btn-xl fw-bold shadow-lg hover-scale">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> Cari Misi
                            </a>
                        @endguest
                        
                        <a href="#impact" class="btn btn-white border btn-xl fw-bold hover-scale text-dark">
                            <i class="fa-regular fa-circle-play me-2"></i> Lihat Impact
                        </a>
                    </div>

                    
                    <div class="mt-5 d-flex align-items-center gap-3">
                        <div class="d-flex">
                            <img src="https://ui-avatars.com/api/?name=A&background=c7d2fe&color=3730a3" class="rounded-circle border border-2 border-white" width="40">
                            <img src="https://ui-avatars.com/api/?name=B&background=bbf7d0&color=166534" class="rounded-circle border border-2 border-white" width="40" style="margin-left: -15px;">
                            <img src="https://ui-avatars.com/api/?name=C&background=fecaca&color=991b1b" class="rounded-circle border border-2 border-white" width="40" style="margin-left: -15px;">
                            <div class="rounded-circle border border-2 border-white bg-dark text-white d-flex align-items-center justify-content-center fw-bold small" style="width: 40px; height: 40px; margin-left: -15px;">+1k</div>
                        </div>
                        <div>
                            <div class="d-flex text-warning small">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            </div>
                            <small class="fw-bold text-secondary">Dipercaya 1,200+ Relawan</small>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-6 position-relative">
                    <div class="position-relative" style="height: 500px;">
                        
                        <div class="glass-card p-4 position-absolute top-50 start-50 translate-middle w-75 float-1" style="z-index: 2;">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-bold mb-0">🔥 Misi Trending</h6>
                                <span class="badge bg-success bg-opacity-10 text-success">Live</span>
                            </div>
                            
                            
                            <div class="d-flex gap-3 mb-3 align-items-center p-2 rounded hover-bg-light">
                                <div class="bg-primary bg-opacity-10 p-2 rounded text-primary"><i class="fa-solid fa-tree fa-lg"></i></div>
                                <div>
                                    <div class="fw-bold small">Tanam Sawit Di Aceh dan Papua</div>
                                    <div class="text-muted x-small">Lingkungan • 50 Slot</div>
                                </div>
                            </div>
                            
                            
                            <div class="d-flex gap-3 align-items-center p-2 rounded hover-bg-light">
                                <div class="bg-warning bg-opacity-10 p-2 rounded text-warning"><i class="fa-solid fa-book fa-lg"></i></div>
                                <div>
                                    <div class="fw-bold small">Mengajar Anak Jalanan</div>
                                    <div class="text-muted x-small">Pendidikan • 12 Slot</div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="glass-card position-absolute p-3 rounded-4 float-2" style="top: 10%; right: 0; width: 160px; z-index: 1;">
                            <div class="text-center">
                                <div class="bg-green-100 text-green-600 rounded-circle d-inline-flex p-3 mb-2" style="background: #dcfce7; color: #166534;">
                                    <i class="fa-solid fa-check fa-lg"></i>
                                </div>
                                <div class="fw-bold h5 mb-0">150+</div>
                                <div class="text-muted x-small fw-bold">Komunitas</div>
                            </div>
                        </div>

                        
                        <div class="glass-card position-absolute p-3 rounded-4 float-3" style="bottom: 15%; left: 0; width: 180px; z-index: 3;">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Revan&background=random" class="rounded-circle" width="40">
                                <div class="lh-1">
                                    <div class="fw-bold small">Revan Andi Laksono</div>
                                    <div class="text-primary x-small fw-bold mt-1">Baru bergabung!</div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="position-absolute top-50 start-50 translate-middle rounded-circle border border-primary border-opacity-10" style="width: 500px; height: 500px; border-style: dashed !important;"></div>
                        <div class="position-absolute top-50 start-50 translate-middle rounded-circle bg-primary bg-opacity-5" style="width: 350px; height: 350px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5 bg-white border-bottom" id="impact">
        <div class="container py-4">
            <div class="row g-4 text-center divide-x">
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="display-4 fw-bold text-primary mb-1 counter" data-target="{{ \App\Models\Event::count() + 150 }}">0</div>
                        <p class="text-secondary fw-bold text-uppercase ls-1 small">Misi Terlaksana</p>
                    </div>
                </div>
                <div class="col-md-4 border-start border-end">
                    <div class="p-3">
                        <div class="display-4 fw-bold text-primary mb-1 counter" data-target="{{ \App\Models\User::count() + 1200 }}">0</div>
                        <p class="text-secondary fw-bold text-uppercase ls-1 small">Relawan Aktif</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="display-4 fw-bold text-primary mb-1 counter" data-target="8500">0</div>
                        <p class="text-secondary fw-bold text-uppercase ls-1 small">Jam Kebaikan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase ls-1">Kenapa VolunTeam?</h6>
                <h2 class="fw-bold display-6">Teknologi untuk Kemanusiaan</h2>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100 hover-scale text-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3 mb-4">
                            <i class="fa-solid fa-wand-magic-sparkles fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">AI Matching</h4>
                        <p class="text-muted">Gak perlu scrolling lama. Algoritma kami mencarikan misi yang pas sesuai minatmu.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100 hover-scale text-center">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex p-3 mb-4">
                            <i class="fa-solid fa-medal fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Gamifikasi Seru</h4>
                        <p class="text-muted">Kumpulkan XP, naikkan level, dan dapatkan Badges keren untuk setiap aksi kebaikanmu.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100 hover-scale text-center">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex p-3 mb-4">
                            <i class="fa-solid fa-scroll fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Sertifikat Valid</h4>
                        <p class="text-muted">Dapatkan sertifikat digital otomatis dengan QR Code yang bisa dipakai untuk portofolio.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-5 bg-dark position-relative overflow-hidden">
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" 
             style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
             
        <div class="container position-relative z-1 text-center py-5">
            <h2 class="text-white fw-bold display-5 mb-4">Siap Berdampak Hari Ini?</h2>
            <p class="text-white-50 lead mb-5 mx-auto" style="max-width: 600px;">
                Jangan biarkan niat baikmu berhenti di pikiran. Gabung dengan ribuan relawan lainnya sekarang.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-xl rounded-pill fw-bold shadow-lg hover-scale">
                Daftar Gratis <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <script>
        // Smooth Counter Animation
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const duration = 2500;
                const increment = target / (duration / 16);
                let current = 0;
                
                const update = () => {
                    current += increment;
                    if (current < target) {
                        counter.innerText = Math.ceil(current).toLocaleString();
                        requestAnimationFrame(update);
                    } else {
                        counter.innerText = target.toLocaleString() + "+";
                    }
                };
                update();
            });
        });
    </script>

@endsection