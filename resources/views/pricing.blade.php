@extends('layouts.app')

@section('content')


<div class="bg-primary pt-5 pb-5 text-white text-center position-relative overflow-hidden">
    <div class="container position-relative z-1">
        <h1 class="fw-bold display-5 mb-3">Investasi untuk Dampak Lebih Besar</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 600px;">
            Pilih paket yang sesuai untuk organisasi Anda. Mulai dari gratis untuk komunitas kecil hingga solusi canggih untuk perusahaan.
        </p>
    </div>
    
    <i class="fa-solid fa-rocket position-absolute top-50 start-0 translate-middle opacity-10 fa-10x" style="transform: rotate(45deg);"></i>
</div>

<div class="container py-5" style="margin-top: -60px;">
    <div class="row g-4 justify-content-center">
        
        
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden">
                <div class="card-header bg-white border-0 text-center pt-5 pb-0">
                    <h5 class="fw-bold text-muted text-uppercase ls-1 mb-0">Komunitas</h5>
                    <div class="my-3">
                        <span class="display-4 fw-bold text-dark">Rp 0</span>
                        <span class="text-muted">/ bulan</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-4 d-flex flex-column gap-3">
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-success me-2"></i> Unlimited Event Posting</li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-success me-2"></i> Maksimal 50 Relawan/Event</li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-success me-2"></i> Dashboard Dasar</li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-success me-2"></i> Verifikasi Manual</li>
                        <li class="d-flex align-items-center text-muted"><i class="fa-solid fa-times-circle me-2"></i> Laporan Analitik</li>
                        <li class="d-flex align-items-center text-muted"><i class="fa-solid fa-times-circle me-2"></i> Prioritas Support</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary w-100 rounded-pill py-3 fw-bold">Daftar Gratis</a>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden position-relative">
                
                <div class="position-absolute top-0 end-0 bg-warning text-dark fw-bold px-3 py-1 small rounded-bottom-start shadow-sm">
                    POPULAR
                </div>
                
                <div class="card-header bg-primary text-white border-0 text-center pt-5 pb-0">
                    <h5 class="fw-bold text-white-50 text-uppercase ls-1 mb-0">Corporate CSR</h5>
                    <div class="my-3">
                        <span class="display-4 fw-bold">Hubungi</span>
                        <span class="text-white-50">kami</span>
                    </div>
                </div>
                <div class="card-body p-4 bg-primary bg-opacity-10">
                    <ul class="list-unstyled mb-4 d-flex flex-column gap-3">
                        <li class="d-flex align-items-center fw-bold"><i class="fa-solid fa-check-circle text-primary me-2"></i> SEMUA FITUR GRATIS</li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-primary me-2"></i> Unlimited Relawan</li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-primary me-2"></i> Advanced Impact Analytics 📊</li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-primary me-2"></i> Export Data CSV/PDF</li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-primary me-2"></i> Featured Event (Sorotan)</li>
                        <li class="d-flex align-items-center"><i class="fa-solid fa-check-circle text-primary me-2"></i> Integrasi API Internal</li>
                    </ul>
                    <button onclick="premiumAlert()" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm hover-scale">
                        <i class="fa-solid fa-crown me-2 text-warning"></i> Upgrade ke Premium
                    </button>
                </div>
            </div>
        </div>

    </div>

    
    <div class="row justify-content-center mt-5 pt-5">
        <div class="col-lg-8 text-center">
            <h4 class="fw-bold mb-4">Pertanyaan Umum</h4>
            <div class="accordion shadow-sm rounded-3 overflow-hidden" id="faqAccordion">
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apakah relawan perlu membayar?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted text-start">
                            <strong>Tentu tidak!</strong> VolunTeam 100% gratis selamanya untuk relawan. Kami percaya kebaikan tidak boleh dipungut biaya.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana cara upgrade ke Corporate?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted text-start">
                            Saat ini fitur Corporate masih dalam tahap <em>Private Beta</em>. Silakan hubungi tim sales kami untuk demo eksklusif.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function premiumAlert() {
        Swal.fire({
            title: '✨ Fitur Premium',
            text: 'Modul Corporate CSR & Payment Gateway akan dirilis pada Q3 2025. Saat ini kami fokus pada pertumbuhan komunitas!',
            icon: 'info',
            confirmButtonText: 'Siap Menunggu!',
            confirmButtonColor: '#4f46e5'
        });
    }
</script>

<style>
    .hover-scale:hover { transform: scale(1.02); transition: 0.2s; }
    .ls-1 { letter-spacing: 1px; }
</style>

@endsection