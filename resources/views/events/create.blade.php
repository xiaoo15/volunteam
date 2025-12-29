@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 mb-4">
                <h2 class="fw-bold text-dark mb-1">Mulai Misi Kebaikan</h2>
                <p class="text-muted">Ajak ribuan relawan muda untuk bergabung dalam aksi nyatamu.</p>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="fw-bold mb-0 text-primary"><i class="fa-solid fa-bullhorn me-2"></i>Detail Misi</h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- GAMBAR --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-secondary">POSTER KEGIATAN</label>
                                <div class="mb-3 text-center bg-light border rounded-3 p-3 position-relative"
                                    style="border-style: dashed !important; min-height: 200px;">
                                    <div id="placeholder-text"
                                        class="d-flex flex-column justify-content-center align-items-center text-muted"
                                        style="height: 100%;">
                                        <i class="fa-regular fa-image fa-3x mb-2 opacity-50"></i>
                                        <small>Upload poster yang menggugah semangat</small>
                                    </div>
                                    <img id="img-preview" src="#" alt="Preview" class="img-fluid rounded shadow-sm d-none"
                                        style="max-height: 300px; width: 100%; object-fit: cover;">
                                </div>
                                <input type="file" name="image" class="form-control" accept="image/*"
                                    onchange="previewImage(this)">
                            </div>

                            <div class="row mb-4">
                                {{-- JUDUL --}}
                                <div class="col-md-7">
                                    <label class="form-label fw-bold small text-secondary">NAMA MISI / KEGIATAN</label>
                                    <input type="text" name="title" class="form-control bg-light border-0"
                                        placeholder="Cth: Gerakan Pungut Sampah Pesisir" required>
                                </div>
                                {{-- KATEGORI --}}
                                <div class="col-md-5">
                                    <label class="form-label fw-bold small text-secondary">ISU UTAMA</label>
                                    <select name="category" class="form-select bg-light border-0" required>
                                        <option value="">Pilih Fokus Isu</option>
                                        <option value="Lingkungan">Lingkungan & Alam</option>
                                        <option value="Pendidikan">Pendidikan & Literasi</option>
                                        <option value="Kesehatan">Kesehatan Masyarakat</option>
                                        <option value="Sosial">Bantuan Kemanusiaan</option>
                                        <option value="Teknologi">Teknologi untuk Kebaikan</option>
                                    </select>
                                </div>
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-secondary">CERITA & TUJUAN</label>
                                <textarea name="description" class="form-control bg-light border-0" rows="3"
                                    placeholder="Ceritakan mengapa misi ini penting dan dampak apa yang ingin dicapai..."
                                    required></textarea>
                            </div>

                            {{-- TANGGUNG JAWAB --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-secondary">AKSI YANG DILAKUKAN</label>
                                <textarea name="responsibilities" class="form-control bg-light border-0" rows="4"
                                    placeholder="- Mengajar calistung anak jalanan&#10;- Membagikan paket sembako&#10;- Dokumentasi kegiatan"
                                    required></textarea>
                                <small class="text-muted">Gunakan tanda strip (-) untuk poin-poin.</small>
                            </div>

                            {{-- SYARAT --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-secondary">KRITERIA RELAWAN</label>
                                <textarea name="requirements" class="form-control bg-light border-0" rows="4"
                                    placeholder="- Berjiwa sosial tinggi&#10;- Bisa bekerjasama dalam tim&#10;- Komitmen hadir di lokasi"
                                    required></textarea>
                            </div>

                            <div class="row">
                                {{-- DEADLINE --}}
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-bold small text-secondary">TANGGAL PELAKSANAAN</label>
                                    <input type="date" name="event_date" class="form-control bg-light border-0" required>
                                </div>
                                {{-- LOKASI --}}
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-bold small text-secondary">LOKASI KEGIATAN</label>
                                    <input type="text" name="location" class="form-control bg-light border-0"
                                        placeholder="Kota / Alamat Lengkap" required>
                                </div>
                                {{-- BENEFIT --}}
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-bold small text-secondary">BENEFIT RELAWAN</label>
                                    <input type="text" name="salary" class="form-control bg-light border-0"
                                        placeholder="Cth: Sertifikat, Transport, Konsumsi">
                                </div>
                            </div>

                            <hr class="my-4 opacity-10">

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('organizer.events') }}"
                                    class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow">
                                    <i class="fa-solid fa-rocket me-2"></i> Luncurkan Misi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- SIDEBAR TIPS --}}
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm rounded-4 bg-primary text-white">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-heart me-2 text-warning"></i>Tips Misi Viral</h5>
                        <ul class="list-unstyled mb-0 small opacity-75 d-flex flex-column gap-3">
                            <li><strong>Judul Menggugah:</strong> Pakai kata kerja kuat. Cth: "Selamatkan Penyu", "Bangun
                                Sekolah".</li>
                            <li><strong>Foto Emosional:</strong> Gunakan foto kegiatan asli yang menampilkan interaksi
                                manusia.</li>
                            <li><strong>Jelas & Padat:</strong> Relawan butuh kejelasan apa yang harus mereka lakukan.</li>
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
                    preview.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection