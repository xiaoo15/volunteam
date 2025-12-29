@extends('layouts.app')

@section('content')
    {{-- 1. HEADER --}}
    <div class="position-relative overflow-hidden">
        <div class="header-gradient position-absolute top-0 start-0 w-100"
            style="height: 350px; z-index: 0; background: linear-gradient(135deg, #4f46e5 0%, #6366f1 50%, #8b5cf6 100%);">
        </div>
        <div class="position-absolute top-0 end-0 w-50 h-100" style="z-index: 0; opacity: 0.1;">
            <div class="position-absolute top-50 start-50 translate-middle" style="width: 800px; height: 800px;">
                <div class="rounded-circle w-100 h-100"
                    style="background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);"></div>
            </div>
        </div>
    </div>

    <div class="container position-relative py-5" style="z-index: 1; margin-top: 0px;">

        {{-- 2. TITLE --}}
        {{-- 2. TITLE & STATS SECTION (COLORFUL VERSION) --}}
        <div class="row align-items-end mb-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    {{-- Badge: Background Putih, Teks Ungu (High Contrast) --}}
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill mb-3 shadow-sm fw-bold">
                        <i class="fas fa-history me-2"></i>Volunteer Journey
                    </span>

                    {{-- Judul: Tetap Putih biar terbaca di atas Gradient --}}
                    <h1 class="display-5 fw-bold mb-3 tracking-tight text-black"
                        style="text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        Riwayat Lamaran
                    </h1>

                    {{-- Deskripsi: Putih agak pudar --}}
                    <p class="text-black text-opacity-75 mb-0 lead" style="max-width: 600px; font-weight: 300;">
                        Pantau status seleksi dan diskusi dengan organizer.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="d-flex gap-3 justify-content-lg-end">

                    {{-- Stat 1: Card Putih, Angka Ungu --}}
                    <div class="stat-box p-3 rounded-4 text-center w-100 shadow-lg" style="background: white;">
                        <h3 class="fw-bold mb-0 text-primary">{{ $applications->total() }}</h3>
                        <small class="text-uppercase x-small text-muted fw-bold ls-1">Total</small>
                    </div>

                    {{-- Stat 2: Card Putih, Angka Hijau --}}
                    <div class="stat-box p-3 rounded-4 text-center w-100 shadow-lg" style="background: white;">
                        <h3 class="fw-bold mb-0 text-success">{{ $applications->where('status', 'accepted')->count() }}</h3>
                        <small class="text-uppercase x-small text-muted fw-bold ls-1">Diterima</small>
                    </div>

                </div>
            </div>
        </div>

        {{-- 3. MAIN CARD --}}
        <div class="card border-0 shadow-2xl rounded-4 overflow-hidden mb-5 bg-white">
            <div class="card-header bg-white border-bottom border-light-subtle py-4 px-4 px-lg-5">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                    {{-- Filter Tabs Modern --}}
                    <div class="nav nav-pills nav-custom gap-2">
                        <button
                            class="nav-link active rounded-pill px-4 py-2 fw-bold x-small d-flex align-items-center gap-2 shadow-sm-active"
                            data-filter="all">
                            <i class="fas fa-layer-group "></i> Semua
                        </button>

                        <button class="nav-link rounded-pill px-4 py-2 fw-bold x-small d-flex align-items-center gap-2"
                            data-filter="pending">
                            <i class="far fa-clock"></i> Menunggu
                        </button>

                        <button class="nav-link rounded-pill px-4 py-2 fw-bold x-small d-flex align-items-center gap-2"
                            data-filter="accepted">
                            <i class="fas fa-check-circle"></i> Diterima
                        </button>

                        <button class="nav-link rounded-pill px-4 py-2 fw-bold x-small d-flex align-items-center gap-2"
                            data-filter="rejected">
                            <i class="fas fa-times-circle"></i> Ditolak
                        </button>
                    </div>

                    {{-- Tombol Cari Event --}}
                    <a href="{{ route('events.index') }}"
                        class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-flex align-items-center gap-2 hover-scale transition-all">
                        <i class="fas fa-search"></i>
                        <span>Cari Event</span>
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-subtle">
                        <tr>
                            <th class="ps-5 py-4 text-uppercase text-muted x-small fw-bold letter-spacing-1 border-0">Event
                            </th>
                            <th class="py-4 text-uppercase text-muted x-small fw-bold letter-spacing-1 border-0">Tanggal
                            </th>
                            <th class="py-4 text-uppercase text-muted x-small fw-bold letter-spacing-1 border-0">Status</th>
                            <th
                                class="pe-5 py-4 text-uppercase text-muted x-small fw-bold letter-spacing-1 border-0 text-end">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $app)
                            <tr class="application-item align-middle transition-all border-bottom border-light-subtle"
                                data-status="{{ $app->status }}">
                                <td class="ps-5 py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="event-icon rounded-4 me-3 d-flex align-items-center justify-content-center shadow-sm text-white fs-4"
                                            style="width: 56px; height: 56px; background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                            {{ substr($app->event->title, 0, 1) }}
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1 text-truncate" style="max-width: 250px;">
                                                <a href="{{ route('events.show', $app->event_id) }}"
                                                    class="text-decoration-none text-dark stretched-link-custom">
                                                    {{ $app->event->title }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">{{ $app->event->organizer->name }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold text-dark">{{ $app->created_at->format('d M, Y') }}</span>
                                        <small class="text-muted">{{ $app->created_at->format('H:i') }} WIB</small>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $badges = [
                                            'pending' => ['bg' => 'bg-warning-subtle', 'text' => 'text-warning', 'icon' => 'far fa-clock', 'label' => 'Menunggu'],
                                            'accepted' => ['bg' => 'bg-success-subtle', 'text' => 'text-success', 'icon' => 'fas fa-check-circle', 'label' => 'Diterima'],
                                            'rejected' => ['bg' => 'bg-danger-subtle', 'text' => 'text-danger', 'icon' => 'fas fa-times-circle', 'label' => 'Ditolak'],
                                            'completed' => ['bg' => 'bg-primary-subtle', 'text' => 'text-primary', 'icon' => 'fas fa-medal', 'label' => 'Selesai'],
                                        ];
                                        $status = $badges[$app->status] ?? $badges['pending'];
                                    @endphp
                                    <span
                                        class="badge {{ $status['bg'] }} {{ $status['text'] }} px-3 py-2 rounded-pill fw-bold border border-opacity-10">
                                        <i class="{{ $status['icon'] }} me-1"></i> {{ $status['label'] }}
                                    </span>
                                </td>
                                <td class="pe-5 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        {{-- Tombol Diskusi --}}
                                        <button
                                            class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold position-relative btn-chat"
                                            data-id="{{ $app->id }}" data-bs-toggle="modal"
                                            data-bs-target="#chatModal{{ $app->id }}">
                                            <i class="far fa-comments me-1"></i> Diskusi

                                            {{-- 🔥 LOGIKA BARU: Cuma muncul kalau ada pesan BELUM DIBACA 🔥 --}}
                                            @if($app->messages->where('user_id', '!=', Auth::id())->where('is_read', false)->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle notification-dot"></span>
                                            @endif
                                        </button>

                                        @if($app->status == 'completed' || $app->status == 'accepted')
                                            <a href="{{ route('applications.certificate', $app->id) }}" target="_blank"
                                                class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-bold d-flex align-items-center gap-2 hover-scale transition-all shadow-sm text-white position-relative" style="z-index: 2;">
                                                <i class="fas fa-download"></i>
                                                <span>Sertifikat</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="py-5 opacity-50">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p>Belum ada riwayat lamaran.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($applications->hasPages())
                <div class="card-footer bg-white border-0 py-4 d-flex justify-content-center border-top">
                    {{ $applications->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    {{-- 🔥 4. MODAL CHAT SECTION (DIPISAH DARI TABEL) 🔥 --}}
    {{-- Ini solusi dari bug layar freeze --}}
    @foreach($applications as $app)
        <div class="modal fade" id="chatModal{{ $app->id }}" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow-3xl overflow-hidden">
                    {{-- Modal Header --}}
                    <div class="modal-header border-0 p-4" style="background: linear-gradient(135deg, #4f46e5, #6366f1);">
                        <div class="d-flex align-items-center text-white">
                            <div class="position-relative me-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($app->event->organizer->name) }}&background=fff&color=4f46e5"
                                    class="rounded-circle border border-2 border-white shadow-sm" width="50" height="50">
                                <span
                                    class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle p-1"></span>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 fs-5">{{ $app->event->organizer->name }}</h6>
                                <div class="opacity-75 small d-flex align-items-center gap-1">
                                    <i class="fas fa-briefcase fa-xs"></i> Organizer • {{ Str::limit($app->event->title, 30) }}
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white opacity-75" data-bs-dismiss="modal"></button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="modal-body p-0 bg-light-subtle">
                        <div class="bg-white px-4 py-2 border-bottom d-flex justify-content-between align-items-center shadow-sm position-relative"
                            style="z-index: 2;">
                            <small class="text-muted fw-bold letter-spacing-1 x-small text-uppercase">Status: <span
                                    class="text-primary">{{ ucfirst($app->status) }}</span></small>
                            <small class="text-muted x-small">Melamar: {{ $app->created_at->format('d M Y') }}</small>
                        </div>

                        <div class="chat-container p-4"
                            style="height: 400px; overflow-y: auto; background-image: radial-gradient(#e0e7ff 1px, transparent 1px); background-size: 20px 20px;">
                            {{-- Pesan Awal --}}
                            @if($app->message)
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="message-bubble message-sent bg-primary text-white p-3 shadow-sm position-relative">
                                        <div
                                            class="d-flex align-items-center gap-2 mb-1 border-bottom border-white border-opacity-25 pb-1">
                                            <i class="fas fa-quote-left small opacity-75"></i>
                                            <span class="x-small fw-bold text-uppercase opacity-90">Cover Letter</span>
                                        </div>
                                        <p class="mb-1 text-break">{{ $app->message }}</p>
                                        <div class="text-end x-small opacity-75">{{ $app->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            @endif

                            {{-- Loop Pesan --}}
                            @foreach($app->messages as $msg)
                                <div
                                    class="mb-3 d-flex {{ $msg->user_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                    @if($msg->user_id != Auth::id())
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($app->event->organizer->name) }}&background=fff&color=4f46e5"
                                            class="rounded-circle me-2 align-self-end shadow-sm border border-white" width="32"
                                            height="32">


                                    @endif

                                    <div
                                        class="message-bubble {{ $msg->user_id == Auth::id() ? 'message-sent bg-primary text-white' : 'message-received bg-white text-dark border' }} p-3 shadow-sm">
                                        <p class="mb-1 text-break">{{ $msg->message }}</p>
                                        <div
                                            class="{{ $msg->user_id == Auth::id() ? 'text-end text-white-50' : 'text-end text-muted' }} x-small">
                                            {{ $msg->created_at->format('H:i') }}
                                            @if($msg->user_id == Auth::id()) <i class="fas fa-check-double ms-1"></i> @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Footer (Input) --}}
                    <div class="modal-footer border-0 p-3 bg-white shadow-lg-top">
                        <form action="{{ route('applications.message', $app->id) }}" method="POST"
                            class="w-100 position-relative">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="message"
                                    class="form-control form-control-lg bg-light border-0 ps-4 rounded-pill"
                                    placeholder="Tulis pesan balasan..." required autocomplete="off">
                                <button type="submit"
                                    class="btn btn-primary rounded-circle position-absolute top-50 end-0 translate-middle-y me-2 shadow-md hover-scale d-flex align-items-center justify-content-center"
                                    style="width: 42px; height: 42px; z-index: 5;">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .x-small {
            font-size: 0.7rem;
        }

        .letter-spacing-1 {
            letter-spacing: 1px;
        }

        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .shadow-3xl {
            box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.15);
        }

        .hover-scale {
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-scale:hover {
            transform: scale(1.03);
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .glass-stat {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-custom .nav-link {
            color: #64748b;
            /* Warna abu-abu slate */
            background-color: white;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-custom .nav-link:hover {
            background-color: #f8fafc;
            color: #334155;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        /* 🔥 STYLE TOMBOL ACTIVE (SAAT DIKLIK) 🔥 */
        .nav-custom .nav-link.active {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            /* Background Ungu */
            color: #ffffff !important;
            /* Teks jadi Putih */
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        /* 🔥 PASTIKAN IKON JUGA JADI PUTIH 🔥 */
        .nav-custom .nav-link.active i {
            color: #ffffff !important;
        }

        .message-bubble {
            max-width: 75%;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .message-sent {
            border-bottom-right-radius: 4px !important;
            border-top-left-radius: 20px !important;
            border-top-right-radius: 20px !important;
            border-bottom-left-radius: 20px !important;
        }

        .message-received {
            border-bottom-left-radius: 4px !important;
            border-top-left-radius: 20px !important;
            border-top-right-radius: 20px !important;
            border-bottom-right-radius: 20px !important;
        }

        .bg-warning-subtle {
            background-color: #fffbeb !important;
        }

        .text-warning {
            color: #b45309 !important;
        }

        .bg-success-subtle {
            background-color: #d1fae5 !important;
        }

        .text-success {
            color: #059669 !important;
        }

        .bg-danger-subtle {
            background-color: #fee2e2 !important;
        }

        .text-danger {
            color: #dc2626 !important;
        }

        .bg-primary-subtle {
            background-color: #e0e7ff !important;
        }

        .text-primary {
            color: #4338ca !important;
        }

        /* FIX MODAL Z-INDEX */
        .modal-backdrop {
            z-index: 1050;
        }

        .modal {
            z-index: 1060;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatButtons = document.querySelectorAll('.btn-chat');

            chatButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const appId = this.getAttribute('data-id');
                    const dot = this.querySelector('.notification-dot');

                    // Kalau ada titik merahnya, kita request ke server buat ilangin
                    if (dot) {
                        fetch(`/applications/${appId}/mark-read`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Hapus titik merahnya secara visual (langsung hilang tanpa refresh)
                                    dot.remove();
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
        // Filter Logic
        const filterButtons = document.querySelectorAll('[data-filter]');
        const appItems = document.querySelectorAll('.application-item');

        filterButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                filterButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filterValue = this.getAttribute('data-filter');
                appItems.forEach(item => {
                    const status = item.getAttribute('data-status');
                    item.style.display = (filterValue === 'all' || status === filterValue) ? '' : 'none';
                });
            });
        });

        // Chat Scroll Bottom
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function () {
                const chatContainer = this.querySelector('.chat-container');
                const input = this.querySelector('input[name="message"]');
                if (chatContainer) chatContainer.scrollTop = chatContainer.scrollHeight;
                if (input) input.focus();
            });
        });
    </script>
@endsection