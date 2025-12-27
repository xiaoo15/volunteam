<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Application;
use App\Models\Message; // Pastikan Model Message sudah dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewMessageNotification;

class ApplicationController extends Controller
{
    // 1. KIRIM LAMARAN (VOLUNTEER)
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        // Security Check
        if ($user->role !== 'volunteer') {
            return back()->with('error', 'Hanya akun Volunteer yang bisa mendaftar event.');
        }

        if ($event->status !== 'open') {
            return back()->with('error', 'Maaf, pendaftaran event ini sudah ditutup.');
        }

        $exists = Application::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Kamu sudah melamar di event ini!');
        }

        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
            'message' => 'nullable|string|max:1000',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv_files', 'public');
        }

        Application::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'pending',
            'cv' => $cvPath,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim! Tunggu kabar selanjutnya.');
    }

    // 2. UPDATE STATUS (ORGANIZER)
    public function update(Request $request, Application $application)
    {
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
    public function sendMessage(Request $request, Application $application)
    {
        // Validasi akses (Security)
        if (Auth::id() !== $application->user_id && Auth::id() !== $application->event->organizer_id) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        // 1. Simpan Pesan ke Database
        $application->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // 2. LOGIKA NOTIFIKASI 🔥
        // Tentukan siapa penerimanya (Lawan bicara)
        if (Auth::id() == $application->user_id) {
            // Kalau yg kirim Volunteer, penerimanya Organizer
            $recipient = $application->event->organizer;
        } else {
            // Kalau yg kirim Organizer, penerimanya Volunteer
            $recipient = $application->user;
        }

        // Kirim Notifikasi
        $recipient->notify(new NewMessageNotification(
            $request->message,
            Auth::user(),
            $application->id
        ));

        return back()->with('success', 'Pesan terkirim.');
    }

    // 4. RIWAYAT LAMARAN (VOLUNTEER) 🔥 INI YANG TADI HILANG 🔥
    public function history()
    {
        // Cek: Cuma Volunteer yang boleh akses
        if (Auth::user()->role !== 'volunteer') {
            return redirect()->route('home');
        }

        // Ambil semua lamaran user ini, urutkan dari terbaru
        // Eager load 'event' dan 'event.organizer' biar loading cepat
        $applications = Application::with('event.organizer')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('applications.history', compact('applications'));
    }
}
