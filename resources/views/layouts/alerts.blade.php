
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; max-width: 400px;">

    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 rounded-4 d-flex align-items-center gap-3 mb-3 bg-white" role="alert" style="border-left: 5px solid #198754 !important;">
            <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                <i class="fa-solid fa-check-circle fa-lg"></i>
            </div>
            <div class="text-dark">
                <h6 class="fw-bold mb-0 text-success" style="font-size: 0.9rem;">Berhasil!</h6>
                <small class="text-muted" style="font-size: 0.85rem;">{{ session('success') }}</small>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0 rounded-4 d-flex align-items-center gap-3 mb-3 bg-white" role="alert" style="border-left: 5px solid #dc3545 !important;">
            <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                <i class="fa-solid fa-circle-exclamation fa-lg"></i>
            </div>
            <div class="text-dark">
                <h6 class="fw-bold mb-0 text-danger" style="font-size: 0.9rem;">Gagal!</h6>
                <small class="text-muted" style="font-size: 0.85rem;">{{ session('error') }}</small>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show shadow-lg border-0 rounded-4 d-flex align-items-center gap-3 mb-3 bg-white" role="alert" style="border-left: 5px solid #ffc107 !important;">
            <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                <i class="fa-solid fa-triangle-exclamation fa-lg"></i>
            </div>
            <div class="text-dark">
                <h6 class="fw-bold mb-0 text-warning" style="font-size: 0.9rem;">Perhatian!</h6>
                <small class="text-muted" style="font-size: 0.85rem;">{{ session('warning') }}</small>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0 rounded-4 mb-3 bg-white" role="alert" style="border-left: 5px solid #dc3545 !important;">
            <div class="d-flex align-items-start gap-3">
                <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-2 d-flex align-items-center justify-content-center mt-1" style="width: 40px; height: 40px; flex-shrink: 0;">
                    <i class="fa-solid fa-bug fa-lg"></i>
                </div>
                <div class="text-dark w-100">
                    <h6 class="fw-bold mb-1 text-danger" style="font-size: 0.9rem;">Ada Input yang Salah:</h6>
                    <ul class="mb-0 ps-3 text-muted small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                // Gunakan Bootstrap Alert Instance untuk menutup dengan animasi
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000); // 5000ms = 5 Detik
    });
</script>