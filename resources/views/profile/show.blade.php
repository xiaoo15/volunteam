@extends('layouts.app')

@section('content')

    {{--
    =============================================
    HALAMAN PROFIL PREMIUM + BADGES SYSTEM 🏆
    =============================================
    --}}

    <style>
        /* GLOBAL & BACKGROUNDS */
        .page-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }

        .header-gradient {
            background: linear-gradient(to right, #eff6ff, #eef2ff);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.9;
            z-index: 0;
        }

        /* AVATAR */
        .profile-avatar-container {
            position: relative;
            z-index: 2;
        }

        .profile-avatar {
            width: 180px;
            height: 180px;
            border-radius: 24px;
            border: 6px solid #ffffff;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }

        /* CARDS */
        .card-premium {
            background: white;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* BADGES BOX */
        .badge-box {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #f8fafc;
            transition: 0.2s;
        }

        .badge-box:hover {
            background-color: #f8fafc;
            border-color: #e2e8f0;
        }

        .badge-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        /* COLORS */
        .bg-soft-primary {
            background: #e0e7ff;
            color: #4f46e5;
        }

        .bg-soft-success {
            background: #dcfce7;
            color: #166534;
        }

        .bg-soft-warning {
            background: #fef9c3;
            color: #ca8a04;
        }

        .bg-soft-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        .bg-soft-info {
            background: #cffafe;
            color: #0891b2;
        }

        .bg-soft-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="page-bg pb-5">

        
        <div class="position-relative bg-white shadow-sm pb-5" style="padding-top: 60px;">
            <div class="header-gradient"></div>
            <div class="container position-relative z-1">
                <div class="row align-items-center">
                    
                    <div class="col-md-auto text-center text-md-start mb-4 mb-md-0">
                        <div class="profile-avatar-container d-inline-block position-relative">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="profile-avatar">
                            <div class="position-absolute start-50 translate-middle-x" style="bottom: -15px;">
                                <span
                                    class="badge rounded-pill bg-white text-dark shadow-sm border py-2 px-3 d-flex align-items-center gap-2">
                                    <span class="d-inline-block rounded-circle"
                                        style="width: 8px; height: 8px; background-color: {{ $user->role == 'organizer' ? '#9333ea' : ($user->role == 'admin' ? '#dc2626' : '#2563eb') }};"></span>
                                    <span class="text-uppercase fw-bold"
                                        style="font-size: 0.7rem; letter-spacing: 1px;">{{ $user->role }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md ms-md-4 text-center text-md-start">
                        <h1 class="fw-bold text-dark display-5 mb-2">{{ $user->name }}</h1>
                        <div
                            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-3 text-muted mb-4">
                            <div><i class="fa-regular fa-envelope me-1"></i> {{ $user->email }}</div>
                            <span class="d-none d-md-inline">•</span>
                            <div><i class="fa-regular fa-calendar me-1"></i> Member since
                                {{ $user->created_at->format('M Y') }}</div>
                        </div>
                        @if($user->bio)
                        <p class="text-secondary lead fs-6 mb-4" style="max-width: 600px;">{{ $user->bio }}</p> @endif

                        <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3">
                            @if(Auth::check() && Auth::id() == $user->id)
                                <a href="{{ route('profile.edit') }}"
                                    class="btn btn-dark rounded-3 px-4 py-2 fw-bold shadow-sm hover-lift"><i
                                        class="fa-solid fa-pen-to-square me-2"></i> Edit Profil</a>
                            @else
                                <button class="btn btn-primary rounded-3 px-4 py-2 fw-bold shadow-sm hover-lift" 
        data-bs-toggle="modal" data-bs-target="#sendMessageModal">
    <i class="fa-regular fa-paper-plane me-2"></i> Kirim Pesan
</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="container fade-in-up" style="margin-top: -40px; animation-delay: 0.2s;">
            <div class="row g-3 justify-content-center">
                @foreach($stats as $label => $value)
                    <div class="col-6 col-md-3">
                        <div class="card-premium p-4 text-center hover-lift h-100 d-flex flex-column justify-content-center">
                            <div class="display-6 fw-bold text-dark mb-1 counter" data-target="{{ $value }}">{{ $value }}</div>
                            <div class="text-muted small text-uppercase fw-bold">{{ $label }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        
        <div class="container mt-5 fade-in-up" style="animation-delay: 0.4s;">
            <div class="row g-4">

                
                <div class="col-lg-8">

                    
                    @if($user->role == 'organizer' && isset($events) && count($events) > 0)
                        <div class="card-premium overflow-hidden mb-4">
                            <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold text-dark mb-0">Active Campaigns</h5><small class="text-muted">Misi yang
                                        sedang berlangsung</small>
                                </div>
                                <i class="fa-solid fa-bullhorn text-muted opacity-25 fa-2x"></i>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach($events as $event)
                                    <a href="{{ route('events.show', $event->id) }}"
                                        class="list-group-item list-group-item-action p-4 border-bottom-0 hover-bg-light">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="rounded-3 overflow-hidden flex-shrink-0 border"
                                                style="width: 70px; height: 70px;">
                                                <img src="{{ $event->image_url }}" class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold text-dark mb-1">{{ $event->title }}</h6>
                                                <div class="text-muted small mb-2"><i
                                                        class="fa-solid fa-location-dot text-danger me-1"></i>
                                                    {{ Str::limit($event->location, 20) }} •
                                                    {{ $event->event_date->format('d M Y') }}</div>
                                                @if($event->status == 'open') <span
                                                class="badge bg-soft-success rounded-pill px-3">Open</span> @else <span
                                                    class="badge bg-secondary rounded-pill px-3">Closed</span> @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    
                    @if($user->role == 'volunteer')
                        <div class="card-premium overflow-hidden">
                            <div class="p-4 border-bottom bg-white">
                                <h5 class="fw-bold text-dark mb-0">Jejak Kebaikan Terakhir</h5>
                            </div>
                            <div class="p-4 text-center">
                                @php $apps = $user->applications()->with('event')->latest()->take(3)->get(); @endphp
                                @if($apps->count() > 0)
                                    <div class="list-group list-group-flush text-start">
                                        @foreach($apps as $app)
                                            <div class="d-flex gap-3 mb-4">
                                                <div class="rounded-circle bg-soft-primary d-flex align-items-center justify-content-center flex-shrink-0"
                                                    style="width: 45px; height: 45px;">
                                                    <i class="fa-solid fa-hand-holding-heart"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">{{ $app->event->title }}</h6>
                                                    <p class="text-muted small mb-0">{{ $app->event->organizer->name }} •
                                                        {{ $app->created_at->diffForHumans() }}</p>
                                                    <span
                                                        class="badge bg-light text-dark border mt-1">{{ ucfirst($app->status) }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="py-4"><i class="fa-solid fa-seedling fa-3x text-muted opacity-25 mb-3"></i>
                                        <p class="text-muted">Belum ada jejak kebaikan yang terekam.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                
                <div class="col-lg-4">

                    
                    <div class="card-premium p-4 mb-4">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <i class="fa-solid fa-trophy text-warning fa-lg"></i>
                            <h6 class="fw-bold text-dark mb-0">Penghargaan</h6>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            @forelse($badges as $badge)
                                <div class="badge-box">
                                    <div class="badge-icon bg-soft-{{ $badge['color'] }}">
                                        <i class="fa-solid {{ $badge['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark small">{{ $badge['name'] }}</div>
                                        <div class="text-muted" style="font-size: 0.7rem;">{{ $badge['desc'] }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted small py-3">Belum ada penghargaan.</div>
                            @endforelse
                        </div>
                    </div>

                    
                    <div class="card-premium p-4">
                        <h6 class="fw-bold text-dark mb-4">Informasi Kontak</h6>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-light rounded-3 p-2 text-muted"><i class="fa-regular fa-envelope fa-lg"></i>
                            </div>
                            <div class="overflow-hidden">
                                <small class="text-muted d-block text-uppercase fw-bold"
                                    style="font-size: 0.65rem;">EMAIL</small>
                                <div class="text-dark fw-medium text-truncate" title="{{ $user->email }}">{{ $user->email }}
                                </div>
                            </div>
                        </div>
                        @if($user->location)
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light rounded-3 p-2 text-muted"><i class="fa-solid fa-map-pin fa-lg"></i></div>
                                <div>
                                    <small class="text-muted d-block text-uppercase fw-bold"
                                        style="font-size: 0.65rem;">LOKASI</small>
                                    <div class="text-dark fw-medium">{{ $user->location }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    
<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
            <div class="modal-header border-0 bg-primary text-white p-4 position-relative">
                <div class="d-flex align-items-center gap-3 position-relative z-1">
                    <img src="{{ $user->avatar_url }}" class="rounded-circle border border-2 border-white" width="50" height="50">
                    <div>
                        <h6 class="mb-0 fw-bold">Kirim Pesan ke {{ explode(' ', $user->name)[0] }}</h6>
                        <small class="opacity-75">Biasanya membalas dalam 1 jam</small>
                    </div>
                </div>
                
                <div class="position-absolute top-0 end-0 opacity-10 p-2">
                    <i class="fa-regular fa-paper-plane fa-5x"></i>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-4">
                
                @if($user->phone)
                    <a href="https://wa.me/{{ $user->phone }}?text=Halo%20{{ $user->name }},%20saya%20melihat%20profil%20Anda%20di%20VolunTeam..." target="_blank" class="btn btn-outline-success w-100 rounded-3 mb-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="fa-brands fa-whatsapp fa-lg"></i> Chat via WhatsApp
                    </a>
                    <div class="text-center text-muted small mb-3 separator"><span>ATAU</span></div>
                @endif

                
                <form id="directMessageForm" onsubmit="sendFakeMessage(event)">
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold">PESAN ANDA</label>
                        <textarea class="form-control bg-light border-0 rounded-3" rows="4" placeholder="Halo, saya ingin berdiskusi tentang..." required></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light rounded-pill px-4 me-2 fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" id="btnSend">
                            <i class="fa-regular fa-paper-plane me-2"></i> Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .separator { position: relative; }
    .separator::before { content: ''; position: absolute; top: 50%; left: 0; right: 0; border-top: 1px solid #eee; }
    .separator span { background: white; position: relative; padding: 0 10px; }
</style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const duration = 1000;
                const increment = target / (duration / 16);
                let current = 0;
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.innerText = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCounter();
            });
        });

        // FUNGSI SIMULASI KIRIM PESAN
    function sendFakeMessage(e) {
        e.preventDefault(); // Mencegah refresh halaman
        
        const btn = document.getElementById('btnSend');
        const originalText = btn.innerHTML;
        
        // 1. Ubah tombol jadi loading
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...';
        btn.disabled = true;

        // 2. Tunggu 1.5 detik (Pura-pura connect server)
        setTimeout(() => {
            // 3. Tampilkan sukses
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-success');
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Terkirim!';

            // 4. Tutup modal & Reset setelah 1 detik
            setTimeout(() => {
                const modalEl = document.getElementById('sendMessageModal');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                // Reset form
                e.target.reset();
                btn.innerHTML = originalText;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-primary');
                btn.disabled = false;
                
                // Alert kecil (Opsional)
                alert('Pesan berhasil dikirim ke ' + "{{ $user->name }}");
            }, 1000);
        }, 1500);
    }
    </script>

@endsection