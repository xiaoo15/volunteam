<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Menampilkan semua event (Bisa diakses Volunteer & Organizer)
    public function index(Request $request)
    {
        // Mulai query, ambil event dengan relasi organizer
        $query = Event::with('organizer'); // Jangan pakai latest() disini dulu, nanti tabrakan sama sorting

        // 1. Logic Filter Search (Judul / Deskripsi)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // 2. Logic Filter Lokasi
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // 3. Logic Filter Kategori
        if ($request->filled('category')) {
            $category = $request->category;
            $query->where('description', 'like', '%' . $category . '%');
        }

        // 4. 🔥 LOGIC SORTING (BARU) 🔥
        if ($request->filled('sort')) {
            if ($request->sort == 'salary_desc') {
                // Sorting berdasarkan Gaji (String based, simple approach)
                $query->orderBy('salary', 'desc');
            } elseif ($request->sort == 'oldest') {
                $query->orderBy('created_at', 'asc');
            } else {
                $query->latest(); // Default: Terbaru
            }
        } else {
            $query->latest(); // Default kalau gak milih sort
        }

        // 5. 🔥 PAGINATION (Ganti get() jadi paginate()) 🔥
        // withQueryString() penting biar pas pindah halaman, filter gak ilang!
        $events = $query->paginate(6)->withQueryString();

        return view('events.index', compact('events'));
    }

    // Form buat bikin event baru
    public function create()
    {
        return view('events.create');
    }

    // SIMPAN EVENT BARU
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string',
            'description' => 'required',
            'requirements' => 'required',
            'responsibilities' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'salary' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'organizer_id' => Auth::id(),
            'title' => $request->title,
            'image' => $imagePath,
            'category' => $request->category,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'responsibilities' => $request->responsibilities,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'salary' => $request->salary ?? 'Unpaid',
            'status' => 'open',
        ]);

        return redirect()->route('organizer.events')->with('success', 'Event berhasil dibuat! 🔥');
    }
    
    // Form edit event
    public function edit(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Eits, ini bukan event kamu!');
        }
        return view('events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, Event $event)
    {
        if ($event->organizer_id !== Auth::id()) { abort(403); }

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'status' => 'required|in:open,closed,canceled',
            'salary' => 'nullable|string',
        ]);

        $event->update($request->all());
        return redirect()->route('organizer.events')->with('success', 'Event berhasil diupdate!');
    }

    // Hapus event
    public function destroy(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) { abort(403); }
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event dihapus.');
    }

    // Lihat detail event
    public function show(Event $event)
    {
        $event->load('applications.user');
        
        // Cek status lamaran user yang login (biar view bersih)
        $userApplication = null;
        if(Auth::check()) {
            $userApplication = \App\Models\Application::where('user_id', Auth::id())
                ->where('event_id', $event->id)
                ->first();
        }

        return view('events.show', compact('event', 'userApplication'));
    }

    public function myEvents()
    {
        $events = Event::where('organizer_id', Auth::id())
            ->withCount('applications')
            ->latest()
            ->get();

        return view('events.my_events', compact('events'));
    }
}