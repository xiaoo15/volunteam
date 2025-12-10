<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Cek apakah user itu admin? Kalau bukan, tendang!
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Anda bukan Admin!');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // 1. STATISTIK UTAMA
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $totalApplications = \App\Models\Application::count();
        $totalOrganizations = User::where('role', 'organizer')->count();

        // 2. DATA TABEL
        // Ambil 5 User terbaru (selain admin)
        $users = User::where('role', '!=', 'admin')->latest()->take(5)->get();
        
        // Ambil 5 Event terbaru
        $events = Event::with('organizer')->withCount('applications')->latest()->take(5)->get();

        // 3. RECENT ACTIVITY (Simulasi Log)
        // Kita gabungin user baru & event baru jadi satu timeline sederhana
        $recentUsers = User::latest()->take(3)->get()->map(function($u){
            $u->type = 'User'; $u->desc = 'User baru mendaftar: ' . $u->name; return $u;
        });
        $recentEvents = Event::latest()->take(3)->get()->map(function($e){
            $e->type = 'Event'; $e->desc = 'Event baru dibuat: ' . $e->title; return $e;
        });
        
        $recentActivities = $recentUsers->merge($recentEvents)->sortByDesc('created_at');

        return view('admin.dashboard', compact(
            'totalUsers', 'totalEvents', 'totalApplications', 'totalOrganizations',
            'users', 'events', 'recentActivities'
        ));
    }

    // Fitur Hapus User (Banned)
    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus dari muka bumi.');
    }

    // Fitur Hapus Event (Take down)
    public function deleteEvent(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event berhasil di-takedown.');
    }
}