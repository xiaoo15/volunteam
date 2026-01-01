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

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            // Gambar Default jika kosong
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->title) . '&background=random&color=fff&size=500';
        }

        // Jika gambar adalah URL eksternal (dari Seeder)
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Jika gambar hasil upload (masuk storage)
        return asset('storage/' . $this->image);
    }
}
