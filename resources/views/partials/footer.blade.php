<footer class="bg-white text-dark pt-5 pb-4 border-top mt-auto">
    <div class="container text-center text-md-start">
        <div class="row">
            
            <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
                <h5 class="fw-bold text-primary mb-3 d-flex align-items-center justify-content-center justify-content-md-start">
                    <i class="fa-solid fa-hand-holding-heart fa-lg me-2"></i> VolunTeam
                </h5>
                <p class="text-secondary small">
                    Wadah digital untuk menghubungkan semangat relawan muda dengan aksi sosial yang berdampak nyata.
                </p>
                <div class="mt-3">
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle me-1"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle me-1"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-3 text-dark">Eksplorasi</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('events.index') }}" class="text-secondary text-decoration-none footer-link">Cari Event</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none footer-link">Tentang Kami</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none footer-link">Cerita Relawan</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-3 text-dark">Akun</h6>
                <ul class="list-unstyled">
                    @guest
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-secondary text-decoration-none footer-link">Masuk</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}" class="text-secondary text-decoration-none footer-link">Daftar</a></li>
                    @else
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-secondary text-decoration-none footer-link">Dashboard</a></li>
                    @endguest
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none footer-link">Bantuan</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold mb-3 text-dark">Hubungi Kami</h6>
                <p class="text-secondary small mb-2"><i class="fas fa-home me-2 text-primary"></i> SMKS PGRI 2 Sidoarjo</p>
                <p class="text-secondary small mb-2"><i class="fas fa-envelope me-2 text-primary"></i> help@volunteam.com</p>
                <p class="text-secondary small"><i class="fas fa-phone me-2 text-primary"></i> +62 812-3456-7890</p>
            </div>
        </div>
    </div>

    <div class="text-center py-3 mt-4 border-top bg-light">
        <small class="text-muted">
            &copy; {{ date('Y') }} <strong>VolunTeam</strong>. Dibuat oleh <strong>Revan</strong>.
        </small>
    </div>
</footer>

<style>
    .footer-link {
        transition: all 0.3s ease;
    }
    .footer-link:hover {
        color: #4f46e5 !important; /* Warna Ungu Utama */
        padding-left: 5px; /* Efek geser dikit */
    }
</style>