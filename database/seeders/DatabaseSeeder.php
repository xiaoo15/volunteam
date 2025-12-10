<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Bikin Akun ORGANIZER (Panitia)
        User::create([
            'name' => 'Revan Organizer',
            'email' => 'organizer@volunteam.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'organizer',
            'bio' => 'Kami adalah organisasi pecinta lingkungan sekolah.',
            'skills' => null, // Organizer gak butuh skill
        ]);

        // 2. Bikin Akun VOLUNTEER (Siswa)
        User::create([
            'name' => 'Siswa Semangat',
            'email' => 'volunteer@volunteam.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
            'bio' => 'Saya suka ikut kegiatan sosial.',
            'skills' => 'Desain,Fotografi',
        ]);

        // 3. Bikin 1 Event Contoh
        // Kita butuh ID organizer yg baru dibuat. Karena id=1 (auto increment), kita tembak manual aja.
        Event::create([
            'organizer_id' => 1, // ID-nya Revan Organizer
            'title' => 'Festival Musik Amal 2024',
            'description' => 'Dicari volunteer untuk menjaga booth tiket dan dokumentasi acara.',
            'event_date' => '2024-12-25',
            'location' => 'Aula Utama SMK',
            'status' => 'open',
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@volunteam.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'bio' => 'Saya yang punya kawasan.',
            'skills' => 'Ngatur Orang,Hapus Data',
        ]);
    }
}
