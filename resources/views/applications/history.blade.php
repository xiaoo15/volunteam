@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 border-0">
                <h4 class="fw-bold text-primary mb-0"><i class="fa-solid fa-clock-rotate-left me-2"></i> Riwayat Lamaran Saya</h4>
            </div>
            <div class="card-body">
                @if($applications->isEmpty())
                    <div class="text-center py-5">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png" alt="Empty" style="width: 200px; opacity: 0.5">
                        <p class="text-muted mt-3">Kamu belum melamar event apapun.</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill">Cari Event Sekarang</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Event</th>
                                    <th>Tanggal Event</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $app)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $app->event->title }}</span><br>
                                        <small class="text-muted">by {{ $app->event->organizer->name }}</small>
                                    </td>
                                    <td>{{ $app->event->event_date->format('d M Y') }}</td>
                                    <td>
                                        @if($app->status == 'pending')
                                            <span class="badge bg-warning text-dark"><i class="fa-regular fa-clock"></i> Menunggu</span>
                                        @elseif($app->status == 'accepted')
                                            <span class="badge bg-success"><i class="fa-solid fa-check"></i> Diterima</span>
                                        @elseif($app->status == 'rejected')
                                            <span class="badge bg-danger"><i class="fa-solid fa-xmark"></i> Ditolak</span>
                                        @elseif($app->status == 'completed')
                                            <span class="badge bg-primary"><i class="fa-solid fa-medal"></i> Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($app->status == 'completed')
                                            <a href="{{ route('certificate.download', $app->id) }}" class="btn btn-sm btn-outline-primary rounded-pill" target="_blank">
                                                <i class="fa-solid fa-file-pdf"></i> Unduh Sertifikat
                                            </a>
                                        @else
                                            <button class="btn btn-sm btn-light text-muted" disabled>Belum tersedia</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection