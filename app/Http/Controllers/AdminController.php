<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil Statistik Utama
        $stats = [
            'total_users' => User::count(),
            'volunteers' => User::where('role', 'volunteer')->count(),
            'organizers' => User::where('role', 'organizer')->count(),
            'total_events' => Event::count(),
            'active_events' => Event::where('status', 'open')->count(),
            'total_applications' => Application::count(),
        ];

        // 2. Ambil Data Terbaru untuk Tabel (Limit 5 aja biar ringkas)
        $latestUsers = User::latest()->take(5)->get();

        $latestEvents = Event::with('organizer')
            ->withCount('applications') // Hitung pelamar per event
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestUsers', 'latestEvents'));
    }
    public function manageUsers()
    {
        // Ambil user dengan pagination (10 per halaman)
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Validasi: Admin tidak boleh menghapus dirinya sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    // --- MANAGE EVENTS ---
    public function manageEvents()
    {
        // Ambil event + data organizer + hitung pelamar
        $events = Event::with('organizer')
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view('admin.events', compact('events'));
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        // Hapus gambar jika ada (opsional, best practice clean up storage)
        if ($event->image && \Illuminate\Support\Facades\Storage::exists('public/' . $event->image)) {
            \Illuminate\Support\Facades\Storage::delete('public/' . $event->image);
        }

        $event->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }
}
