<footer class="bg-white pt-5 pb-4 mt-auto border-top position-relative overflow-hidden" style="border-color: #e2e8f0 !important;">
    
    <div class="container position-relative" style="z-index: 1;">
        <div class="row g-5 justify-content-between">
            
            
            <div class="col-lg-4 col-md-6">
                <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none mb-4">
                    
                    <img src="{{ asset('images/logo_volunteam.png') }}" alt="VolunTeam" style="height: 38px; width: auto;"> 
                    
                    <span class="fs-3 fw-bold tracking-tight logo-text-gradient" style="font-family: 'Plus Jakarta Sans', sans-serif;">VolunTeam</span>
                </a>
                
                <p class="text-secondary mb-4 lh-lg" style="font-size: 0.95rem;">
                    Platform kolaborasi aksi sosial #1 di Indonesia. Kami menghubungkan semangat relawan muda dengan organisasi penggerak perubahan.
                </p>

                
                <div class="d-flex gap-2">
                    <a href="#" class="social-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-btn" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-btn" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-btn" aria-label="Youtube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="text-uppercase fw-bold mb-4 text-dark letter-spacing-1" style="font-size: 0.8rem;">Eksplorasi</h6>
                <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                    
                    <li><a href="{{ route('events.index') }}" class="footer-link">Cari Misi</a></li>
                    <li><a href="{{ route('pricing') }}" class="footer-link">Donasi & Pricing</a></li>
                    @guest
                        <li><a href="{{ route('login') }}" class="footer-link">Masuk Akun</a></li>
                        <li><a href="{{ route('register') }}" class="footer-link">Daftar Relawan</a></li>
                    @endguest
                </ul>
            </div>

            
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="text-uppercase fw-bold mb-4 text-dark letter-spacing-1" style="font-size: 0.8rem;">Fokus Isu</h6>
                <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                    <li><a href="{{ route('events.index', ['category' => 'Pendidikan']) }}" class="footer-link">Pendidikan</a></li>
                    <li><a href="{{ route('events.index', ['category' => 'Lingkungan']) }}" class="footer-link">Lingkungan</a></li>
                    <li><a href="{{ route('events.index', ['category' => 'Kesehatan']) }}" class="footer-link">Kesehatan</a></li>
                    <li><a href="{{ route('events.index', ['category' => 'Teknologi']) }}" class="footer-link">Teknologi</a></li>
                </ul>
            </div>

            
            <div class="col-lg-3 col-md-6">
                <h6 class="text-uppercase fw-bold mb-4 text-dark letter-spacing-1" style="font-size: 0.8rem;">Hubungi Kami</h6>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-start gap-3 text-secondary">
                        <i class="fa-solid fa-location-dot mt-1 text-primary"></i>
                        <span style="font-size: 0.9rem;">Jl. Lingkar Timur, Sidoarjo, Jawa Timur, Indonesia</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 text-secondary">
                        <i class="fa-solid fa-envelope text-primary"></i>
                        <span style="font-size: 0.9rem;">hello@volunteam.id</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 text-secondary">
                        <i class="fa-brands fa-whatsapp text-primary"></i>
                        <span style="font-size: 0.9rem;">+62 895-6280-9354-7</span>
                    </div>
                </div>
            </div>

        </div>

        <hr class="my-5" style="border-color: #f1f5f9;">

        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <small class="text-secondary fw-medium">
                &copy; {{ date('Y') }} <strong>VolunTeam</strong>. Dibuat oleh Revan Andi Laksono.
            </small>
        </div>
    </div>
</footer>

<style>
    /* STYLE FOOTER LIGHT/WHITE */

    /* Logo Text Gradient */
    .logo-text-gradient {
        background: linear-gradient(135deg, #1e293b 0%, #4f46e5 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Tombol Sosmed */
    .social-btn {
        width: 40px; height: 40px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px;
        background-color: #f8fafc;
        color: #64748b;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 1.1rem;
        border: 1px solid #f1f5f9;
    }
    .social-btn:hover {
        background-color: #4f46e5;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -10px rgba(79, 70, 229, 0.5);
        border-color: transparent;
    }

    /* Link Navigasi */
    .footer-link {
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-block;
    }
    .footer-link:hover {
        color: #4f46e5;
        transform: translateX(5px);
    }

    .letter-spacing-1 { letter-spacing: 1px; }
</style>