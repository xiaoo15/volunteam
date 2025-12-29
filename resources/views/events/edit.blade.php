@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-12 mb-4">
            <h2 class="fw-bold text-dark mb-1">Edit Event / Lowongan</h2>
            <p class="text-muted">Perbarui informasi event agar pelamar mendapatkan info terbaru.</p>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0 text-primary"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Data Lowongan</h5>
                </div>

                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                <strong>Gagal menyimpan perubahan!</strong>
                            </div>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING: Method PUT untuk Update --}}
                        
                        {{-- GAMBAR --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">POSTER / BANNER EVENT</label>
                            
                            <div class="mb-3 text-center bg-light border rounded-3 p-3 position-relative" style="min-height: 200px; border-style: dashed !important;">
                                
                                {{-- Preview Gambar Lama/Baru --}}
                                <img id="img-preview" 
                                     src="{{ $event->image ? asset('storage/' . $event->image) : '#' }}" 
                                     alt="Preview" 
                                     class="img-fluid rounded shadow-sm {{ $event->image ? '' : 'd-none' }}" 
                                     style="max-height: 300px; width: 100%; object-fit: cover;">

                                {{-- Placeholder text (muncul kalau ga ada gambar) --}}
                                <div id="placeholder-text" class="d-flex flex-column justify-content-center align-items-center text-muted {{ $event->image ? 'd-none' : '' }}" style="height: 100%; min-height: 200px;">
                                    <i class="fa-regular fa-image fa-3x mb-2 opacity-50"></i>
                                    <small>Preview gambar baru akan muncul disini</small>
                                </div>
                            </div>

                            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                        </div>

                        <div class="row mb-4">
                            {{-- JUDUL --}}
                            <div class="col-md-7">
                                <label class="form-label fw-bold small text-secondary">JUDUL POSISI</label>
                                <input type="text" name="title" class="form-control bg-light border-0" value="{{ old('title', $event->title) }}" required>
                            </div>
                            {{-- KATEGORI --}}
                            <div class="col-md-5">
                                <label class="form-label fw-bold small text-secondary">KATEGORI</label>
                                <select name="category" class="form-select bg-light border-0" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach(['Teknologi', 'Pendidikan', 'Sosial', 'Kreatif', 'Kesehatan', 'Bisnis'] as $cat)
                                        <option value="{{ $cat }}" {{ (old('category', $event->category) == $cat) ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- STATUS (Tambahan Penting buat Edit) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">STATUS EVENT</label>
                            <select name="status" class="form-select bg-light border-0 fw-bold {{ $event->status == 'open' ? 'text-success' : ($event->status == 'closed' ? 'text-secondary' : 'text-danger') }}">
                                <option value="open" class="text-success" {{ $event->status == 'open' ? 'selected' : '' }}>🟢 Open Hiring (Buka)</option>
                                <option value="closed" class="text-secondary" {{ $event->status == 'closed' ? 'selected' : '' }}>⚫ Closed (Tutup)</option>
                                <option value="canceled" class="text-danger" {{ $event->status == 'canceled' ? 'selected' : '' }}>🔴 Canceled (Dibatalkan)</option>
                            </select>
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">DESKRIPSI SINGKAT</label>
                            <textarea name="description" class="form-control bg-light border-0" rows="3" required>{{ old('description', $event->description) }}</textarea>
                        </div>

                        {{-- TANGGUNG JAWAB --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">TANGGUNG JAWAB</label>
                            <textarea name="responsibilities" class="form-control bg-light border-0" rows="4" required>{{ old('responsibilities', $event->responsibilities) }}</textarea>
                        </div>

                        {{-- KUALIFIKASI --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary">KUALIFIKASI PELAMAR</label>
                            <textarea name="requirements" class="form-control bg-light border-0" rows="4" required>{{ old('requirements', $event->requirements) }}</textarea>
                        </div>

                        <div class="row">
                            {{-- DEADLINE --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold small text-secondary">DEADLINE</label>
                                {{-- Format tanggal wajib Y-m-d untuk input date --}}
                                <input type="date" name="event_date" class="form-control bg-light border-0" 
                                       value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d')) }}" required>
                            </div>
                            {{-- LOKASI --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold small text-secondary">LOKASI</label>
                                <input type="text" name="location" class="form-control bg-light border-0" value="{{ old('location', $event->location) }}" required>
                            </div>
                            {{-- GAJI --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold small text-secondary">GAJI / BENEFIT</label>
                                <input type="text" name="salary" class="form-control bg-light border-0" value="{{ old('salary', $event->salary) }}">
                            </div>
                        </div>

                        <hr class="my-4 opacity-10">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('organizer.events') }}" class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
                            
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow">
                                <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar Tips --}}
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 bg-info bg-opacity-10 text-dark">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-info"><i class="fa-solid fa-circle-info me-2"></i>Info Edit</h5>
                    <ul class="list-unstyled mb-0 small opacity-75 d-flex flex-column gap-3">
                        <li><strong>Status Event:</strong>
                            <ul>
                                <li><span class="text-success fw-bold">Open:</span> Menerima lamaran baru.</li>
                                <li><span class="text-secondary fw-bold">Closed:</span> Tidak menerima lamaran, tapi proses seleksi masih berjalan.</li>
                                <li><span class="text-danger fw-bold">Canceled:</span> Event batal, pelamar akan diberitahu.</li>
                            </ul>
                        </li>
                        <li><strong>Gambar:</strong> Tidak perlu upload ulang jika tidak ingin menggantinya.</li>
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