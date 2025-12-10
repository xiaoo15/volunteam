@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-12 mb-4">
            <h2 class="fw-bold text-dark mb-1">Buat Event / Lowongan Baru</h2>
            <p class="text-muted">Lengkapi detail kualifikasi dan tanggung jawab agar pelamar paham.</p>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0 text-primary"><i class="fa-solid fa-pen-to-square me-2"></i>Detail Lowongan</h5>
                </div>

                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                <strong>Waduh, ada yang belum pas nih!</strong>
                            </div>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">POSTER / BANNER EVENT</label>
                            
                            <div class="mb-3 text-center bg-light border rounded-3 p-3 position-relative" style="min-height: 200px; border-style: dashed !important;">
                                <div id="placeholder-text" class="d-flex flex-column justify-content-center align-items-center text-muted" style="height: 100%;">
                                    <i class="fa-regular fa-image fa-3x mb-2 opacity-50"></i>
                                    <small>Preview gambar akan muncul disini</small>
                                </div>
                                
                                <img id="img-preview" src="#" alt="Preview" class="img-fluid rounded shadow-sm d-none" style="max-height: 300px; width: 100%; object-fit: cover;">
                            </div>

                            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted d-block mt-1">Format: JPG, PNG. Max: 10MB. (Opsional tapi disarankan)</small>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-7">
                                <label class="form-label fw-bold small text-secondary">JUDUL POSISI</label>
                                <input type="text" name="title" class="form-control bg-light border-0" placeholder="Contoh: Staff Administrasi Magang" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold small text-secondary">KATEGORI</label>
                                <select name="category" class="form-select bg-light border-0" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Teknologi">Teknologi & IT</option>
                                    <option value="Pendidikan">Pendidikan</option>
                                    <option value="Sosial">Sosial & Lingkungan</option>
                                    <option value="Kreatif">Desain & Kreatif</option>
                                    <option value="Kesehatan">Kesehatan</option>
                                    <option value="Bisnis">Bisnis & Marketing</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">DESKRIPSI SINGKAT</label>
                            <textarea name="description" class="form-control bg-light border-0" rows="3" placeholder="Jelaskan secara umum tentang kegiatan ini..." required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">TANGGUNG JAWAB (APA YANG DILAKUKAN?)</label>
                            <textarea name="responsibilities" class="form-control bg-light border-0" rows="4" placeholder="- Mengelola data entry&#10;- Membantu tim lapangan&#10;- Membuat laporan harian" required></textarea>
                            <small class="text-muted">Gunakan tanda (-) untuk membuat list point.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">KUALIFIKASI PELAMAR</label>
                            <textarea name="requirements" class="form-control bg-light border-0" rows="4" placeholder="- Minimal SMK Jurusan RPL/TKJ&#10;- Usia minimal 17 tahun&#10;- Bisa bekerja dalam tim" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold small text-secondary">DEADLINE</label>
                                <input type="date" name="event_date" class="form-control bg-light border-0" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold small text-secondary">LOKASI</label>
                                <input type="text" name="location" class="form-control bg-light border-0" placeholder="Kota / Remote" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold small text-secondary">GAJI / BENEFIT</label>
                                <input type="text" name="salary" class="form-control bg-light border-0" placeholder="Cth: 500.000">
                            </div>
                        </div>

                        <hr class="my-4 opacity-10">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('organizer.events') }}" class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
                            
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow">
                                <i class="fa-solid fa-paper-plane me-2"></i> Terbitkan Lowongan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-lightbulb me-2 text-warning"></i>Tips Penulisan</h5>
                    <ul class="list-unstyled mb-0 small opacity-75 d-flex flex-column gap-3">
                        <li><strong>Tanggung Jawab:</strong> Jelaskan tugas sehari-hari. Contoh: "Membuat desain poster harian".</li>
                        <li><strong>Syarat:</strong> Spesifik lebih baik. Contoh: "Wajib menguasai Canva".</li>
                        <li><strong>Format:</strong> Gunakan tanda strip (-) di awal baris agar muncul sebagai poin-poin yang rapi.</li>
                        <li><strong>Gambar:</strong> Gunakan gambar landscape (mendatar) agar pas di kartu lowongan.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function previewImage(input) {
        var preview = document.getElementById('img-preview');
        var placeholder = document.getElementById('placeholder-text');
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none'); // Munculkan gambar
                placeholder.classList.add('d-none'); // Sembunyikan text placeholder
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            preview.classList.add('d-none');
            placeholder.classList.remove('d-none');
        }
    }
</script>
@endsection