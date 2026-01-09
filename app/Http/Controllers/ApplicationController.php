<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Application;
use App\Models\ApplicationMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewMessageNotification;
use App\Notifications\NewApplicantNotification;
use App\Notifications\ApplicationStatusNotification;

class ApplicationController extends Controller
{
    // 1. KIRIM LAMARAN (VOLUNTEER)
    // Perhatikan parameternya: ganti (Event $event) jadi ($id)
    public function store(Request $request, $id)
    {
        // 1. CARI MANUAL (Biar Pasti Dapat Datanya)
        $event = Event::findOrFail($id);

        $user = Auth::user();

        // --- VALIDASI (Sama seperti sebelumnya) ---

        // Cek Role
        if ($user->role !== 'volunteer') {
            return back()->with('error', 'Hanya akun Volunteer yang bisa mendaftar event.');
        }

        // Cek Status (Sekarang datanya pasti ada isinya)
        // Kita pakai trim dan strtolower biar aman dari spasi/huruf besar
        if (trim(strtolower($event->status)) !== 'open') {
            return back()->with('error', 'Gagal Daftar! Status event saat ini: ' . $event->status);
        }

        // Cek Tanggal
        if ($event->event_date < now()->startOfDay()) {
            return back()->with('error', 'Event ini sudah lewat tanggal pelaksanaannya.');
        }

        // Cek Duplikasi
        $exists = Application::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Kamu sudah mengirim lamaran untuk event ini!');
        }

        // --- SIMPAN DATA ---

        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
            'message' => 'nullable|string|max:1000',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv_files', 'public');
        }

        $application = Application::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'pending',
            'cv' => $cvPath,
            'message' => $request->message,
        ]);

        // Kirim notifikasi ke Organizer bahwa ada pelamar baru
        $event->organizer->notify(new NewApplicantNotification($application));

        return back()->with('success', 'Lamaran berhasil dikirim! Tunggu kabar dari Organizer.');
    }

    // 2. UPDATE STATUS (ORGANIZER)
    public function updateStatus(Request $request, Application $application)
    {
        // Validasi Kepemilikan Event
        if ($application->event->organizer_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status ini.');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected,completed'
        ]);

        $application->update(['status' => $request->status]);

        // Kirim notifikasi ke Volunteer tentang status lamaran mereka
        $application->user->notify(new ApplicationStatusNotification($application));

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }

    // 3. KIRIM PESAN CHAT
    public function sendMessage(Request $request, Application $application)
    {
        // 1. Validasi
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // 2. Cek Otorisasi (Sender harus Volunteer ATAU Organizer)
        if (Auth::id() !== $application->user_id && Auth::id() !== $application->event->organizer_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // 3. Simpan Pesan
        $chat = $application->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_read' => false,
        ]);

        // --- 🔥 BAGIAN BARU: KIRIM NOTIFIKASI 🔥 ---

        // Tentukan siapa penerimanya
        $recipient = null;

        if (Auth::id() == $application->user_id) {
            // Kalau yang ngirim PELAMAR, notif ke ORGANIZER
            $recipient = $application->event->organizer;
        } else {
            // Kalau yang ngirim ORGANIZER, notif ke PELAMAR
            $recipient = $application->user;
        }

        // Kirim Notif (Jika penerima valid)
        if ($recipient) {
            $recipient->notify(new NewMessageNotification($chat));
        }

        // -------------------------------------------

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan terkirim',
            'data' => [
                'message' => $chat->message,
                'time' => $chat->created_at->format('H:i'),
                'is_me' => true,
            ]
        ]);
    }

    // 4. RIWAYAT LAMARAN (VOLUNTEER)
    public function history()
    {
        if (Auth::user()->role !== 'volunteer') {
            return redirect()->route('home');
        }

        // Ambil data lamaran + Pesan terakhir (untuk notif badge di view jika perlu)
        $applications = Application::with(['event.organizer', 'messages'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('applications.history', compact('applications'));
    }

    public function markChatRead(Application $application)
    {
        // Validasi Akses
        if (Auth::id() !== $application->user_id && Auth::id() !== $application->event->organizer_id) {
            abort(403);
        }

        // Update semua pesan dari LAWAN BICARA yang belum dibaca jadi terbaca
        $application->messages()
            ->where('user_id', '!=', Auth::id()) // Pesan dari orang lain
            ->where('is_read', false)            // Yang belum dibaca
            ->update(['is_read' => true]);       // Tandai jadi TRUE

        return response()->json(['success' => true]);
    }

    // 5. DOWNLOAD SERTIFIKAT
    public function certificate(Application $application)
    {
        // Validasi Akses (Hanya pemilik lamaran yang boleh lihat)
        if (Auth::id() !== $application->user_id) {
            abort(403);
        }

        // Validasi Status (Hanya yang sudah selesai/diterima)
        // Kita izinkan 'accepted' juga jaga-jaga kalau organizer lupa klik 'completed'
        if (!in_array($application->status, ['accepted', 'completed'])) {
            return back()->with('error', 'Sertifikat belum tersedia untuk status ini.');
        }

        // Load relasi agar data di view sertifikat lengkap
        $application->load(['event.organizer', 'user']);

        return view('applications.certificate', compact('application'));
    }

    // 6. BATALKAN EVENT (ORGANIZER)
    public function cancelEvent(Event $event)
    {
        // Validasi: Hanya Organizer pemilik event
        if (Auth::id() !== $event->organizer_id) {
            abort(403);
        }

        // Update Status Event
        $event->status = 'canceled';
        $event->save();

        // Notifikasi ke semua pelamar
        foreach ($event->applications as $app) {
            $app->user->notify(new \App\Notifications\EventCancelledNotification($event));
        }

        return back()->with('success', 'Event berhasil dibatalkan dan semua pelamar telah diberitahu.');
    }
    public function printCertificate(\App\Models\Application $application)
    {
        // Validasi: Harus milik user login
        if ($application->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Bukan milik Anda.');
        }

        // Validasi: Status harus completed
        if ($application->status !== 'completed') {
            abort(403, 'Misi belum selesai, sertifikat belum terbit.');
        }

        return view('applications.certificate', compact('application'));
    }
}
