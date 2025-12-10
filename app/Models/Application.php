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
        'cv_file',      // <--- TAMBAH INI
        'message_note'  // <--- TAMBAH INI
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
}
