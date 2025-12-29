<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // 🔥 FIX 1: CEK ROLE DULU SEBELUM JALANIN LOGIKA AI 🔥
        
        // Kalau Admin, lempar ke Dashboard Admin
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Kalau Organizer, lempar ke Halaman "My Events" (Mission Control)
        if ($user->role == 'organizer') {
            return redirect()->route('organizer.events');
        }

        // ==========================================
        // DARI SINI KE BAWAH KHUSUS VOLUNTEER (AI)
        // ==========================================

        // 1. Cek Kategori Favorit User
        $favoriteCategory = Application::where('user_id', $user->id)
            ->join('events', 'applications.event_id', '=', 'events.id')
            ->select('events.category', DB::raw('count(*) as total'))
            ->groupBy('events.category')
            ->orderByDesc('total')
            ->value('events.category');

        // 2. Query Rekomendasi
        if ($favoriteCategory) {
            $recommendations = Event::where('category', $favoriteCategory)
                ->where('status', 'open')
                ->whereDoesntHave('applications', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->inRandomOrder()
                ->take(3)
                ->get();
            
            $aiMessage = "Berdasarkan minatmu di bidang " . $favoriteCategory;
        } else {
            $recommendations = Event::withCount('applications')
                ->where('status', 'open')
                ->orderByDesc('applications_count')
                ->take(3)
                ->get();
            
            $aiMessage = "Misi paling diminati relawan saat ini";
        }

        // Data statistik dashboard
        $totalApplications = Application::where('user_id', $user->id)->count();
        $totalHours = Application::where('user_id', $user->id)->where('status', 'completed')->count() * 5;

        return view('home', compact('recommendations', 'aiMessage', 'totalApplications', 'totalHours'));
    }
}