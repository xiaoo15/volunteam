<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'cv_file',
        'message_note'
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
        return $this->hasMany(ApplicationMessage::class);
    }
}