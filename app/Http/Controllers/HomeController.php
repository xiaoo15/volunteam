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

        // --- 1. CEK ROLE (REDIRECT) ---
        // Kalau Admin, lempar ke Dashboard Admin
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Kalau Organizer, lempar ke Halaman "My Events"
        if ($user->role == 'organizer') {
            return redirect()->route('organizer.events');
        }

        // ==========================================
        //  KHUSUS VOLUNTEER (AI)
        // ==========================================

        // 2. ANALISIS MINAT USER
        $favoriteCategory = Application::where('user_id', $user->id)
            ->join('events', 'applications.event_id', '=', 'events.id')
            ->select('events.category', DB::raw('count(*) as total'))
            ->groupBy('events.category')
            ->orderByDesc('total')
            ->value('events.category');

        // Siapkan variabel default
        $recommendations = collect(); 
        $aiMessage = "";

        // 3. PLAN A: CARI SESUAI MINAT (IDEAL)
        if ($favoriteCategory) {
            $recommendations = Event::where('category', $favoriteCategory)
                ->where('status', 'open')
                ->whereDoesntHave('applications', function($q) use ($user) {
                    $q->where('user_id', $user->id); // Jangan rekomen yang udah dilamar
                })
                ->inRandomOrder()
                ->take(3)
                ->get();
            
            $aiMessage = "Spesial untukmu di bidang " . $favoriteCategory;
        }

        // 4. PLAN B: FALLBACK MECHANISM (JARING PENGAMAN)
        if ($recommendations->isEmpty()) {
            $recommendations = Event::where('status', 'open')
                ->whereDoesntHave('applications', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->inRandomOrder() // Acak biar fresh
                ->take(3)
                ->get();
            
            $aiMessage = "Misi terbaru yang mungkin kamu suka";
        }

        // 5. DATA STATISTIK DASHBOARD
        $totalApplications = Application::where('user_id', $user->id)->count();
        $totalHours = Application::where('user_id', $user->id)->where('status', 'completed')->count() * 5;

        return view('home', compact('recommendations', 'aiMessage', 'totalApplications', 'totalHours'));
    }
}