{{-- Cek Error Validasi Form (Tetap tampil sebagai list merah biar jelas salahnya dimana) --}}
@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
        <div class="d-flex align-items-center fw-bold text-danger mb-2">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> Ups, ada yang kurang:
        </div>
        <ul class="mb-0 small text-secondary ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- CSS KHUSUS BIAR NOTIF GAK BIRU & LEBIH ELEGANT --}}
<style>
    /* Paksa background jadi Putih Bersih & Ada Bayangan */
    div.swal2-toast {
        background-color: #ffffff !important;
        color: #1e293b !important;
        /* Text Dark Blue/Grey */
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        border: 1px solid #e2e8f0 !important;
        border-left: 5px solid !important;
        /* Garis warna di kiri */
    }

    /* Warna Garis Samping Sesuai Tipe */
    div.swal2-icon-success {
        border-left-color: #10b981 !important;
    }

    div.swal2-icon-error {
        border-left-color: #ef4444 !important;
    }

    div.swal2-icon-warning {
        border-left-color: #f59e0b !important;
    }

    div.swal2-icon-info {
        border-left-color: #3b82f6 !important;
    }

    /* Progress Bar Warna Abu Soft (Bukan Biru) */
    .swal2-timer-progress-bar {
        background: rgba(0, 0, 0, 0.1) !important;
    }

    /* Judul Notif Lebih Tebal */
    .swal2-title {
        font-weight: 600 !important;
        font-size: 0.95rem !important;
    }
</style>

{{-- SCRIPT SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Konfigurasi Toast "Mahal"
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end', // Muncul di pojok kanan atas
        showConfirmButton: false,
        timer: 4000, // Hilang dalam 4 detik
        timerProgressBar: true,
        iconColor: 'auto', // Warna ikon ngikutin tipe (Hijau/Merah/dll)
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // 1. Notifikasi SUKSES (Hijau)
    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif

    // 2. Notifikasi ERROR (Merah)
    @if(session('error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}'
        });
    @endif

    // 3. Notifikasi WARNING (Kuning/Orange)
    @if(session('warning'))
        Toast.fire({
            icon: 'warning',
            title: '{{ session('warning') }}'
        });
    @endif

    // 4. Notifikasi INFO (Biru tapi Background Putih)
    @if(session('info'))
        Toast.fire({
            icon: 'info',
            title: '{{ session('info') }}'
        });
    @endif
</script>