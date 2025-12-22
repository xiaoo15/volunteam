<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Application;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = Auth::user();
        
        // 1. Logic Khusus Organizer (Tampilkan Dashboard Statistik)
        if ($user->role == 'organizer') {
            
            $totalEvents = Event::where('organizer_id', $user->id)->count();
            
            $totalApplicants = Application::whereHas('event', function($q) use ($user) {
                $q->where('organizer_id', $user->id);
            })->count();
            
            $pendingApplicants = Application::whereHas('event', function($q) use ($user) {
                $q->where('organizer_id', $user->id);
            })->where('status', 'pending')->count();
            
            return view('home', compact('totalEvents', 'totalApplicants', 'pendingApplicants'));
        }

        // 2. Logic Khusus Volunteer (Langsung arahkan ke halaman Lowongan)
        return redirect()->route('events.index');
    }
}