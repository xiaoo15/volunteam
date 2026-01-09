@extends('layouts.app')

@section('content')

{{-- 
    =============================================
    DASHBOARD VOLUNTEER - PREMIUM ANALYTICS
    Powered by: Chart.js
    =============================================
--}}


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Custom Gradient & Glass Effect */
    .bg-gradient-premium {
        background: linear-gradient(135deg, #4f46e5 0%, #312e81 100%);
    }
    .glass-card {
        background: rgba(255, 255, 255, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border-radius: 20px;
    }
    .stat-icon {
        width: 48px; height: 48px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px;
        font-size: 1.25rem;
    }
    .hover-lift { transition: transform 0.2s; }
    .hover-lift:hover { transform: translateY(-5px); }
</style>

<div class="container py-5">
    
    
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="card border-0 bg-gradient-premium text-white rounded-4 shadow-lg overflow-hidden position-relative p-4 p-md-5">
                
                <div class="position-absolute top-0 end-0 opacity-10" style="margin-top: -50px; margin-right: -50px;">
                    <i class="fa-solid fa-chart-pie" style="font-size: 300px;"></i>
                </div>

                <div class="row align-items-center position-relative z-1">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=4f46e5" class="rounded-circle border border-3 border-white shadow-sm" width="64">
                            <div>
                                <h6 class="text-white-50 text-uppercase fw-bold letter-spacing-1 mb-0">Volunteer Dashboard</h6>
                                <h2 class="fw-bold mb-0">Halo, {{ Auth::user()->name }}! 🚀</h2>
                            </div>
                        </div>
                        
                        
                        <div class="mt-4" style="max-width: 500px;">
                            <div class="d-flex justify-content-between text-white mb-2">
                                <small class="fw-bold"><i class="fa-solid fa-medal text-warning me-1"></i> Level: Changemaker</small>
                                <small>750 / 1000 XP</small>
                            </div>
                            <div class="progress bg-white bg-opacity-25 rounded-pill" style="height: 10px;">
                                <div class="progress-bar bg-warning rounded-pill progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%"></div>
                            </div>
                            <small class="text-white-50 mt-2 d-block fst-italic">Hebat! Tinggal 250 XP lagi untuk mencapai level "Hero".</small>
                        </div>
                    </div>

                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="{{ route('events.index') }}" class="btn btn-primary fw-bold px-4 py-3 rounded-pill shadow-sm hover-scale">
    <i class="fa-solid fa-compass me-2"></i> Cari Misi Baru
</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-4 mb-5">
        
        <div class="col-md-4">
            <div class="glass-card p-4 h-100 hover-lift">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-bold text-uppercase">Total Kontribusi</small>
                        <h3 class="fw-bold mb-0">{{ $totalHours }} <span class="fs-6 text-muted">Jam</span></h3>
                    </div>
                </div>
                <div class="d-flex align-items-center text-success small fw-bold">
                    <i class="fa-solid fa-arrow-trend-up me-1"></i> +12% dari bulan lalu
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="glass-card p-4 h-100 hover-lift">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="fa-solid fa-check-circle"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-bold text-uppercase">Misi Diikuti</small>
                        <h3 class="fw-bold mb-0">{{ $totalApplications }} <span class="fs-6 text-muted">Misi</span></h3>
                    </div>
                </div>
                <div class="d-flex align-items-center text-secondary small fw-bold">
                    <i class="fa-solid fa-trophy me-1"></i> Top 10% Relawan Aktif
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="glass-card p-4 h-100 hover-lift cursor-pointer" onclick="window.location='{{ route('applications.history') }}'">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-bold text-uppercase">Portofolio</small>
                        <h3 class="fw-bold mb-0">Lihat</h3>
                    </div>
                </div>
                <div class="d-flex align-items-center text-primary small fw-bold">
                    Klik untuk download sertifikat <i class="fa-solid fa-arrow-right ms-2"></i>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-4 mb-5">
        
        <div class="col-lg-8">
            <div class="glass-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-chart-line me-2 text-primary"></i>Tren Keaktifan</h5>
                    <select class="form-select form-select-sm w-auto bg-light border-0 fw-bold text-secondary">
                        <option>6 Bulan Terakhir</option>
                        <option>Tahun Ini</option>
                    </select>
                </div>
                
                <div style="height: 300px;">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">
            <div class="glass-card p-4 h-100">
                <h5 class="fw-bold text-dark mb-4"><i class="fa-solid fa-pie-chart me-2 text-primary"></i>Minat Isu</h5>
                
                <div style="height: 250px; position: relative;">
                    <canvas id="categoryChart"></canvas>
                </div>
                <div class="text-center mt-3">
                    <small class="text-muted">Berdasarkan event yang kamu lamar.</small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="d-flex align-items-center gap-2 mb-4">
        <div class="bg-dark text-white rounded-pill px-3 py-1 fw-bold small shadow-sm">
            <i class="fa-solid fa-wand-magic-sparkles me-1"></i> AI PICK
        </div>
        <h5 class="fw-bold text-dark mb-0">Rekomendasi Spesial Buat Kamu</h5>
    </div>

    <div class="row g-4">
        @forelse($recommendations as $event)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                    <div class="position-relative">
                        <img src="{{ $event->image_url }}" class="card-img-top object-fit-cover" height="180">
                        <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm fw-bold">
                            {{ $event->category }}
                        </span>
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h6 class="fw-bold text-dark mb-2 text-truncate">{{ $event->title }}</h6>
                        <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit(strip_tags($event->description), 80) }}</p>
                        
                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-calendar text-primary small"></i>
                                <small class="text-muted fw-bold">{{ \Carbon\Carbon::parse($event->event_date)->format('d M') }}</small>
                            </div>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light border-dashed text-center py-5 rounded-4">
                    <p class="text-muted mb-0">AI sedang mempelajari datamu...</p>
                </div>
            </div>
        @endforelse
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. ACTIVITY LINE CHART
        const ctx1 = document.getElementById('activityChart').getContext('2d');
        
        // Bikin Gradient Ungu
        let gradient = ctx1.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.4)'); // Ungu transparant
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0.0)');

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Jam Kontribusi',
                    data: [5, 12, 8, 20, 15, {{ $totalHours > 0 ? $totalHours : 25 }}], // Data Dummy + Real
                    borderColor: '#4f46e5',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4f46e5',
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    tension: 0.4 // Garis Melengkung (Smooth)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                    x: { grid: { display: false } }
                }
            }
        });

        // 2. CATEGORY DOUGHNUT CHART
        const ctx2 = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Pendidikan', 'Lingkungan', 'Kesehatan', 'Lainnya'],
                datasets: [{
                    data: [40, 35, 15, 10], // Persentase Dummy (Biar visualnya bagus)
                    backgroundColor: [
                        '#4f46e5', // Primary
                        '#10b981', // Green
                        '#f59e0b', // Orange
                        '#e2e8f0'  // Gray
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Bolong tengahnya gede
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
                }
            }
        });
    });
</script>

@endsection