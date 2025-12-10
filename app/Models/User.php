<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Pastikan package ini terinstall

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'bio',
        'skills',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --- RELATIONSHIPS ---

    // Jika user adalah ORGANIZER, dia punya banyak event
    public function events()
    {
        // Karena Event ada di namespace yang sama (App\Models), bisa langsung panggil
        return $this->hasMany(Event::class, 'organizer_id');
    }

    // Jika user adalah VOLUNTEER, dia punya banyak aplikasi lamaran
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}