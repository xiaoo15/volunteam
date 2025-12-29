<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'title',
        'category',
        'description',
        'requirements',
        'responsibilities',
        'event_date',
        'location',
        'salary', // Benefit
        'status',
        'image',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    // Relasi ke Pembuat Event (Organizer)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    // 🔥 INI YANG KURANG: Relasi ke Pelamar (Applications) 🔥
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
