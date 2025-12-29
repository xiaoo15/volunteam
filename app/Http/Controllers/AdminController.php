<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // 1. STATISTIK UTAMA (KARTU ATAS)
        $stats = [
            'total_users' => User::count(),
            'volunteers' => User::where('role', 'volunteer')->count(),
            'organizers' => User::where('role', 'organizer')->count(),
            'total_events' => Event::count(),
            'active_events' => Event::where('status', 'open')->count(),
            'total_applications' => Application::count(),
            'pending_apps' => Application::where('status', 'pending')->count(),
            'completed_apps' => Application::where('status', 'completed')->count(),
        ];

        // 2. SMART DATA: DISTRIBUSI KATEGORI EVENT
        // Menghitung kategori apa yang paling populer (misal: Pendidikan, Lingkungan)
        $categoryStats = Event::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->take(4) // Ambil top 4 kategori
            ->get();

        // 3. SMART DATA: TOP ORGANIZER
        // Siapa organizer yang paling rajin bikin event?
        $topOrganizers = User::where('role', 'organizer')
            ->withCount('events')
            ->orderByDesc('events_count')
            ->take(3)
            ->get();

        // 4. DATA TABEL TERBARU
        $latestUsers = User::latest()->take(5)->get();
        
        $latestEvents = Event::with('organizer')
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats', 
            'latestUsers', 
            'latestEvents', 
            'categoryStats', 
            'topOrganizers'
        ));
    }

    // ... method manageUsers, deleteUser, dll (biarkan tetap sama) ...
    public function manageUsers()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function manageEvents()
    {
        $events = Event::with('organizer')->withCount('applications')->latest()->paginate(10);
        return view('admin.events', compact('events'));
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        if ($event->image && \Illuminate\Support\Facades\Storage::exists('public/' . $event->image)) {
            \Illuminate\Support\Facades\Storage::delete('public/' . $event->image);
        }
        $event->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }
}