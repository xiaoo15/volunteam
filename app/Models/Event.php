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
        'image',
        'category', // <--- BARU
        'description',
        'requirements', // <--- BARU
        'responsibilities', // <--- BARU
        'event_date',
        'location',
        'status',
        'salary',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    // --- RELATIONSHIPS ---

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
