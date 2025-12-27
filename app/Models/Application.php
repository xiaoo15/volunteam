<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'cv',      // 🔥 MUST BE HERE
        'message',  // 🔥 MUST BE HERE
    ];

    // --- RELATIONSHIPS ---

    // Aplikasi milik satu Volunteer (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Aplikasi tertuju ke satu Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // 🔥 INI YANG HILANG! JANGAN SAMPAI HILANG LAGI YAA 🔥
    // Relasi ke tabel pesan (chat history)
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function history()
{
    // Cek: Cuma Volunteer yang boleh akses
    if (Auth::user()->role !== 'volunteer') {
        return redirect()->route('home');
    }

    // Ambil semua lamaran user ini, urutkan dari terbaru
    $applications = Application::with('event.organizer') // Eager load biar kenceng
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10); // Pakai pagination biar gak berat

    return view('applications.history', compact('applications'));
}
}
