<footer class="bg-white pt-5 pb-4 mt-auto" style="border-top: 1px solid #f1f5f9;">
    <div class="container">
        <div class="row g-4 justify-content-between">
            
            {{-- 1. LOGO & TAGLINE --}}
            <div class="col-md-4">
                {{-- Logo Konsisten dengan Navbar --}}
                <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none mb-3">
                    <img src="{{ asset('images/logo_volunteam.png') }}" alt="VolunTeam" style="height: 36px; width: auto;">
                    <span class="logo-text">VolunTeam</span>
                </a>
                
                <p class="text-muted small lh-base mb-4" style="max-width: 320px;">
                    Wadah digital yang menghubungkan semangat relawan muda dengan aksi sosial yang berdampak nyata bagi komunitas.
                </p>

                {{-- Social Media Links Minimalis --}}
                <div class="d-flex gap-2">
                    <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            {{-- 2. NAVIGASI (Digabung jadi satu kolom lebar) --}}
            <div class="col-md-6 d-flex justify-content-md-end gap-5">
                {{-- Kolom Navigasi 1 --}}
                <div>
                    <h6 class="fw-bold text-dark mb-3">Platform</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('events.index') }}" class="footer-link">Cari Lowongan</a></li>
                        <li><a href="#" class="footer-link">Tentang Kami</a></li>
                        <li><a href="#" class="footer-link">Blog & Cerita</a></li>
                    </ul>
                </div>

                {{-- Kolom Navigasi 2 --}}
                <div>
                    <h6 class="fw-bold text-dark mb-3">Dukungan</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                        <li><a href="#" class="footer-link">Pusat Bantuan</a></li>
                        <li><a href="#" class="footer-link">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="footer-link">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- 3. COPYRIGHT --}}
        <div class="border-top mt-5 pt-4 d-flex justify-content-between align-items-center flex-wrap gap-3" style="border-color: #f1f5f9 !important;">
            <small class="text-muted fw-medium">
                &copy; {{ date('Y') }} VolunTeam. Dibuat dengan ❤️ oleh <span class="fw-bold text-dark">Revan</span>.
            </small>
            <small class="text-muted">
                SMKS PGRI 2 Sidoarjo
            </small>
        </div>
    </div>
</footer>

<style>
    /* === STYLE FOOTER MINIMALIS === */

    /* Style Logo Text (Sama seperti Navbar) */
    .logo-text {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        letter-spacing: -0.5px;
        background: linear-gradient(135deg, #1e293b 0%, #4f46e5 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Style Link Navigasi */
    .footer-link {
        color: #64748b; /* Slate-500 */
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .footer-link:hover {
        color: #4f46e5; /* Warna Ungu VolunTeam */
        transform: translateX(3px); /* Efek geser halus */
    }

    /* Style Social Media Buttons */
    .social-link {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px; /* Rounded Square */
        background-color: #f1f5f9;
        color: #64748b;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 1rem;
    }

    .social-link:hover {
        background-color: #4f46e5;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
</style>