<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Application;
use App\Models\User;

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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // app/Http/Controllers/HomeController.php

public function index()
{
    $user = Auth::user();

    if ($user->role == 'organizer') {
        
        // 1. Total Events
        $totalEvents = Event::where('organizer_id', $user->id)->count();
        
        // 2. Base Query for Applications
        $applications = Application::whereHas('event', function($q) use ($user) {
            $q->where('organizer_id', $user->id);
        });

        // 3. Application Stats
        $totalApplicants = (clone $applications)->count();
        $pendingApplicants = (clone $applications)->where('status', 'pending')->count();
        
        // 🔥 THESE TWO WERE MISSING IN COMPACT
        $acceptedApplicants = (clone $applications)->where('status', 'accepted')->count(); 
        $rejectedApplicants = (clone $applications)->where('status', 'rejected')->count(); 

        // 4. Recent Events
        $recentEvents = Event::where('organizer_id', $user->id)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        // 🔥 ADD THEM HERE IN COMPACT()
        return view('home', compact(
            'totalEvents', 
            'totalApplicants', 
            'pendingApplicants', 
            'acceptedApplicants', // <--- Add this
            'rejectedApplicants', // <--- Add this
            'recentEvents'
        ));
    }
    // Logic untuk Volunteer...
    return redirect()->route('events.index');
}
}
