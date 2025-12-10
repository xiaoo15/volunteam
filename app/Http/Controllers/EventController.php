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
        $query = Event::with('organizer')->latest();

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

        // 3. Logic Filter Tipe/Kategori (Kita cari di deskripsi karena belum ada kolom khusus)
        // Ini trik biar filter kategori tetep jalan tanpa ubah database!
        if ($request->filled('category')) {
            $category = $request->category; // Misal: 'Teknologi'
            $query->where('description', 'like', '%' . $category . '%');
        }

        $events = $query->get();

        return view('events.index', compact('events'));
    }

    // Form buat bikin event baru
    public function create()
    {
        return view('events.create');
    }

    // Simpan event ke database
    // SIMPAN EVENT BARU
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'category' => 'required|string', // Validasi Kategori
        'description' => 'required',
        'requirements' => 'required', // Validasi Syarat
        'responsibilities' => 'required', // Validasi Tugas
        'event_date' => 'required|date',
        'location' => 'required|string',
        'salary' => 'nullable|string',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        // Simpan ke folder: storage/app/public/events
        $imagePath = $request->file('image')->store('events', 'public');
    }

    Event::create([
        'organizer_id' => Auth::id(),
        'title' => $request->title,
        'image' => $imagePath,
        'category' => $request->category, // Simpan Kategori
        'description' => $request->description,
        'requirements' => $request->requirements, // Simpan Syarat
        'responsibilities' => $request->responsibilities, // Simpan Tugas
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
        // Cek kepemilikan: Kalau bukan yang bikin, tendang!
        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Eits, ini bukan event kamu!');
        }

        return view('events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'status' => 'required|in:open,closed,canceled',
            'salary' => 'nullable|string', // <--- Validasi update
        ]);

        // Update semua data termasuk salary
        $event->update($request->all());

        return redirect()->route('organizer.events')->with('success', 'Event berhasil diupdate!');
    }


    // Hapus event
    public function destroy(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403);
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event dihapus.');
    }

    // Lihat detail event & siapa aja pelamarnya (Khusus Organizer)
    public function show(Event $event)
    {
        // Load relasi applications beserta user-nya
        $event->load('applications.user');
        return view('events.show', compact('event'));
    }

    public function myEvents()
    {
        // Ambil event milik user yang login + hitung jumlah pelamarnya
        $events = Event::where('organizer_id', Auth::id())
            ->withCount('applications') // Ini magic-nya Laravel (hitung otomatis)
            ->latest()
            ->get();

        return view('events.my_events', compact('events'));
    }
}
