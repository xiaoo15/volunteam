<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Application;
use App\Models\Message; // 🔥 Pastikan bikin Model Message nanti
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // 1. KIRIM LAMARAN (VOLUNTEER)
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        // Security: Cuma Volunteer yang boleh daftar
        if ($user->role !== 'volunteer') {
            return back()->with('error', 'Hanya akun Volunteer yang bisa mendaftar event.');
        }

        // Security: Cek apakah event masih buka
        if ($event->status !== 'open') {
            return back()->with('error', 'Maaf, pendaftaran event ini sudah ditutup.');
        }

        // Security: Cek double submit
        $exists = Application::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Kamu sudah melamar di event ini!');
        }

        // Validasi Input
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048', // Max 2MB, PDF only
            'message' => 'nullable|string|max:1000',
        ]);

        // Upload CV
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv_files', 'public');
        }

        // Simpan ke Database
        Application::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'pending',
            'cv' => $cvPath,
            'message' => $request->message, // Pesan awal saat melamar
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim! Tunggu kabar selanjutnya.');
    }

    // 2. UPDATE STATUS (ORGANIZER)
    public function update(Request $request, Application $application)
    {
        // Security: Pastikan yang update adalah pemilik event
        if ($application->event->organizer_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected,completed'
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }

    // 3. KIRIM PESAN CHAT (ORGANIZER & VOLUNTEER)
    // Ini untuk fitur chat di dalam detail aplikasi
    public function sendMessage(Request $request, Application $application)
    {
        // Security: Pastikan yang kirim pesan cuma Pemilik Event ATAU Si Pelamar
        if (Auth::id() !== $application->user_id && Auth::id() !== $application->event->organizer_id) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        // Simpan Pesan (Butuh Model Message & Relasi)
        // Kita asumsikan kamu bikin tabel 'messages' nanti
        $application->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan terkirim.');
    }
}
