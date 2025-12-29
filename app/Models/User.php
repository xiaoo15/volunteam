<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens; 

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
        'avatar',
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
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function getAvatarUrlAttribute()
    {
        // 1. Cek apakah user punya file avatar kustom di database DAN filenya ada di storage
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            // Jika ada, kembalikan URL file tersebut
            return asset('storage/' . $this->avatar);
        }

        // 2. Jika tidak ada, gunakan API UI-Avatars.com
        // Kita standarkan style-nya di sini (Warna Ungu VolunTeam, Teks Putih, Bold)
        $name = urlencode($this->name); // Encode nama biar aman di URL
        $background = '6366f1'; // Warna Ungu VolunTeam (bisa diganti 'random' kalau mau)
        $color = 'ffffff'; // Warna Teks Putih

        return "https://ui-avatars.com/api/?name={$name}&background={$background}&color={$color}&bold=true&size=256";
    }
}
