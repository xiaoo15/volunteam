<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // Import DomPDF
use App\Notifications\NewApplicantNotification;
use App\Notifications\ApplicationStatusNotification;

class ApplicationController extends Controller
{
    // Volunteer melamar ke event
    public function store(Request $request, $eventId)
    {
        // Cek apakah user udah pernah melamar di event ini?
        $existingApp = Application::where('user_id', Auth::id())
            ->where('event_id', $eventId)
            ->first();

        if ($existingApp) {
            return back()->with('error', 'Kamu sudah melamar di event ini sebelumnya!');
        }

        $request->validate([
            'cv_file' => 'nullable|mimes:pdf,jpg,png|max:2048',
            'message_note' => 'nullable|string|max:500'
        ]);

        $cvPath = null;
        if ($request->hasFile('cv_file')) {
            $cvPath = $request->file('cv_file')->store('cv_uploads', 'public');
        }

        // --- PERBAIKAN DISINI ---
        // Tambahkan '$application =' di depannya biar datanya tersimpan
        $application = Application::create([
            'user_id' => Auth::id(),
            'event_id' => $eventId,
            'status' => 'pending', // Default status
            'cv_file' => $cvPath, // Simpan path
            'message_note' => $request->message_note
        ]);

        // Kirim notif ke Organizer (pemilik event)
        $event = Event::find($eventId);

        // Sekarang $application sudah ada isinya, jadi aman dikirim ke notifikasi
        $event->organizer->notify(new NewApplicantNotification($application));

        return back()->with('success', 'Lamaran terkirim! Tunggu kabar dari panitia ya.');
    }

    // Organizer update status (Terima/Tolak/Selesai)
    public function updateStatus(Request $request, Application $application)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:accepted,rejected,completed',
            'cv_file' => 'nullable|mimes:pdf,jpg,png|max:2048',
            'message_note' => 'nullable|string|max:500'
        ]);

        // Pastikan yang nge-acc adalah pemilik event
        if ($application->event->organizer_id !== Auth::id()) {
            abort(403, 'Bukan wewenang Anda.');
        }

        $application->update([
            'status' => $request->status
        ]);

        // Kirim notif ke Volunteer (pelamar)
        $application->user->notify(new ApplicationStatusNotification($application));

        return back()->with('success', 'Status volunteer berhasil diubah.');
    }

    // Volunteer melihat history lamaran mereka
    public function history()
    {
        $applications = Application::with('event')->where('user_id', Auth::id())->latest()->get();
        return view('applications.history', compact('applications'));
    }

    // 🔥 GENERATE SERTIFIKAT (PDF) 🔥
    public function generateCertificate(Application $application)
    {
        // 1. Cek User: Harus user yang bersangkutan yang download
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        // 2. Cek Status: Harus 'completed' baru boleh dapet sertifikat
        if ($application->status !== 'completed') {
            return back()->with('error', 'Event belum selesai atau kamu belum lulus!');
        }

        // 3. Siapkan Data buat View PDF
        $data = [
            'name' => Auth::user()->name,
            'event_title' => $application->event->title,
            'date' => $application->event->event_date->format('d F Y'),
            'role' => 'Volunteer Terbaik'
        ];

        // 4. Load View khusus PDF
        $pdf = Pdf::loadView('pdf.certificate', $data);

        // 5. Set orientasi Landscape & Download/Stream
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Sertifikat-VolunTeam.pdf');
    }

    public function sendMessage(Request $request, Application $application)
    {
        $user = Auth::user();

        // 1. Validasi: Pesan gak boleh kosong
        $request->validate(['message' => 'required|string']);

        // 2. Cek Role & Izin
        $isOrganizer = $application->event->organizer_id == $user->id;
        $isVolunteer = $application->user_id == $user->id;

        if (!$isOrganizer && !$isVolunteer) {
            abort(403, 'Anda tidak punya akses di sini.');
        }

        // 3. LOGIC UNIK KAMU: Volunteer cuma boleh kirim 1x setelah diterima
        if ($isVolunteer) {
            if ($application->status !== 'accepted') {
                return back()->with('error', 'Eits, kamu harus diterima dulu baru bisa kirim pesan!');
            }

            // Cek apakah udah pernah kirim pesan sebelumnya?
            $hasSent = $application->messages()->where('user_id', $user->id)->exists();
            if ($hasSent) {
                return back()->with('error', 'Kesempatan kirim pesan hanya 1x ya!');
            }
        }

        // 4. Simpan Pesan
        $application->messages()->create([
            'user_id' => $user->id,
            'message' => $request->message,
            'is_organizer' => $isOrganizer
        ]);

        return back()->with('success', 'Pesan terkirim!');
    }
}
