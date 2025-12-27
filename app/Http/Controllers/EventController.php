<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function __construct()
    {
        // Require auth for everything except index and show
        $this->middleware('auth')->except(['index', 'show']);
    }

    // 1. HALAMAN PENCARIAN (PUBLIC)
    public function index(Request $request)
    {
        // Start query: Active events only
        $query = Event::with('organizer')->where('status', 'open');

        // 🔍 FILTER: Keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // 📍 FILTER: Location
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // 🏷️ FILTER: Category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 🔃 SORTING
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'salary_desc':
                    // Note: Ideally salary should be numeric/decimal column for correct sorting
                    $query->orderBy('salary', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $events = $query->paginate(9)->withQueryString();

        return view('events.index', compact('events'));
    }

    // 2. FORM BUAT EVENT
    public function create()
    {
        // Ensure user is organizer
        if (Auth::user()->role !== 'organizer') {
            abort(403, 'Hanya organizer yang bisa membuat event.');
        }
        return view('events.create');
    }

    // 3. SIMPAN EVENT
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'organizer') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'category' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'responsibilities' => 'required|string',
            'event_date' => 'required|date|after:today',
            'location' => 'required|string',
            'salary' => 'nullable|string',
        ]);

        // Handle File Upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $validated['organizer_id'] = Auth::id();
        $validated['status'] = 'open';

        Event::create($validated);

        return redirect()->route('organizer.events')->with('success', 'Event berhasil dibuat! 🚀');
    }

    // 4. FORM EDIT
    public function edit(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
        return view('events.edit', compact('event'));
    }

    // 5. UPDATE EVENT
    public function update(Request $request, Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'status' => 'required|in:open,closed,canceled',
            'salary' => 'nullable|string',
            // Add other fields validation if editable
        ]);

        // Handle Image Update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('organizer.events')->with('success', 'Event berhasil diperbarui! ✨');
    }

    // 6. DELETE EVENT
    public function destroy(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403);
        }

        // Delete image file
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();
        return redirect()->route('organizer.events')->with('success', 'Event berhasil dihapus.');
    }

    // 7. SHOW EVENT
    public function show(Event $event)
    {
        $event->load(['organizer', 'applications.user']);

        $userApplication = null;
        if (Auth::check()) {
            // Check existing application for current user
            $userApplication = Application::where('user_id', Auth::id())
                ->where('event_id', $event->id)
                ->first();
        }

        return view('events.show', compact('event', 'userApplication'));
    }

    // 8. LIST EVENT ORGANIZER
    public function myEvents()
    {
        if (Auth::user()->role !== 'organizer') {
            abort(403);
        }

        $events = Event::where('organizer_id', Auth::id())
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view('events.my_events', compact('events'));
    }
}
