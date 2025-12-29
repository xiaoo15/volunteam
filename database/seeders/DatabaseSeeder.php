<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Application;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Pakai Faker bahasa Indonesia

        // ==========================================
        // 1. BUAT USER UTAMA (PEMERAN UTAMA)
        // ==========================================

        // Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@volunteam.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Organizer Utama (Akun Demo Juri)
        $mainOrganizer = User::create([
            'name' => 'Yayasan Tunas Bangsa',
            'email' => 'organizer@volunteam.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'avatar' => null,
        ]);

        // Volunteer Utama (Akun Revan)
        $revan = User::create([
            'name' => 'Revan Aditama',
            'email' => 'revan@volunteam.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
        ]);

        // ==========================================
        // 2. BUAT ORGANIZER & VOLUNTEER DUMMY
        // ==========================================

        $organizers = [];
        // Buat 10 Organizer Tambahan
        for ($i = 0; $i < 10; $i++) {
            $organizers[] = User::create([
                'name' => $faker->company, // Nama Yayasan/PT
                'email' => $faker->unique()->companyEmail,
                'password' => Hash::make('password'),
                'role' => 'organizer',
            ]);
        }
        // Masukkan Organizer Utama ke array biar dia juga punya event
        $organizers[] = $mainOrganizer;

        // Buat 20 Volunteer Tambahan
        $volunteers = User::factory(20)->create(['role' => 'volunteer']);


        // ==========================================
        // 3. GENERATOR EVENT (KOLEKSI JUDUL KEREN)
        // ==========================================

        $categories = ['Pendidikan', 'Lingkungan', 'Kesehatan', 'Sosial', 'Teknologi', 'Bencana'];

        $eventTitles = [
            'Pendidikan' => [
                'Relawan Pengajar Anak Jalanan',
                'Mentor Coding Panti Asuhan',
                'Gerakan Literasi Desa',
                'Guru Tamu SMK Terpencil',
                'Donasi Buku & Mengajar',
                'Kelas Inspirasi Muda'
            ],
            'Lingkungan' => [
                'Bersih Pantai Nusantara',
                'Tanam 1000 Mangrove',
                'Patroli Penyu',
                'Recycle Ranger: Pilah Sampah',
                'Ekspedisi Hutan Lindung',
                'Kampanye Zero Waste'
            ],
            'Kesehatan' => [
                'Relawan Vaksinasi Lansia',
                'Penyuluhan Gizi Balita',
                'Donor Darah Masal',
                'Pendamping Pasien Kanker',
                'Tim Medis Bencana',
                'Senam Sehat Lansia'
            ],
            'Sosial' => [
                'Dapur Umum Jumat Berkah',
                'Bantuan Korban Banjir',
                'Sahabat Difabel',
                'Renovasi Rumah Yatim',
                'Berbagi Nasi Bungkus',
                'Kakak Asuh Online'
            ],
            'Teknologi' => [
                'Pembuatan Website Desa',
                'Pelatihan Digital Marketing UMKM',
                'Service Laptop Gratis',
                'Instalasi Internet Desa',
                'Data Entry Kemanusiaan',
                'Desainer Grafis NGO'
            ],
            'Bencana' => [
                'Relawan Trauma Healing',
                'Tim SAR & Evakuasi',
                'Distribusi Logistik Gempa',
                'Dapur Umum Darurat',
                'Bersih Puing Pasca Banjir',
                'Medis Lapangan'
            ]
        ];

        // LOOPING PEMBUATAN 50 EVENT
        for ($i = 0; $i < 50; $i++) {
            // Pilih Organizer Acak
            $randomOrg = $organizers[array_rand($organizers)];

            // Pilih Kategori Acak
            $cat = $categories[array_rand($categories)];

            // Pilih Judul berdasarkan Kategori
            $title = $eventTitles[$cat][array_rand($eventTitles[$cat])];

            // Tentukan Status (Banyakan Open, dikit Closed/Canceled)
            $statusList = ['open', 'open', 'open', 'open', 'closed', 'closed', 'canceled'];
            $status = $statusList[array_rand($statusList)];

            // Tentukan Tanggal (Kalau closed/canceled berarti masa lalu, kalau open masa depan)
            $date = $status == 'open' ? Carbon::now()->addDays(rand(1, 60)) : Carbon::now()->subDays(rand(1, 30));

            $event = Event::create([
                'organizer_id' => $randomOrg->id,
                'title' => $title . ' #' . rand(100, 999), // Tambah angka biar unik
                'category' => $cat,
                'description' => $faker->paragraph(3), // Deskripsi panjang dummy
                'responsibilities' => "- " . $faker->sentence() . "\n- " . $faker->sentence() . "\n- " . $faker->sentence(),
                'requirements' => "- Usia minimal 17 tahun\n- " . $faker->sentence(),
                'event_date' => $date,
                'location' => $faker->city, // Kota Indonesia (Dummy)
                'salary' => rand(0, 1) ? 'Sertifikat & Transport' : 'Unpaid / Sukarela',
                'status' => $status,
                'image' => null, // Biarkan null biar pakai placeholder icon
            ]);

            // ==========================================
            // 4. GENERATE PELAMAR (APPLICATIONS)
            // ==========================================

            // Setiap event punya 0-8 pelamar acak
            $numApplicants = rand(0, 8);
            if ($numApplicants > 0) {
                // Ambil volunteer acak
                $randomVolunteers = $volunteers->random(min($numApplicants, $volunteers->count()));

                foreach ($randomVolunteers as $vol) {
                    // Status Lamaran Acak
                    $appStatusList = ['pending', 'pending', 'accepted', 'rejected', 'completed'];
                    $appStatus = $appStatusList[array_rand($appStatusList)];

                    // Pastikan kalau event belum lewat, status gak mungkin completed (kecuali testing)
                    if ($event->event_date > now() && $appStatus == 'completed') {
                        $appStatus = 'accepted';
                    }

                    Application::create([
                        'user_id' => $vol->id,
                        'event_id' => $event->id,
                        'status' => $appStatus,
                        'cv' => null,
                        'message' => $faker->sentence(),
                        'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                    ]);
                }
            }
        }

        // ==========================================
        // 5. DATA SPESIAL BUAT DEMO (REVAN)
        // ==========================================

        // Buat 1 Event Spesial yang sudah Completed buat Revan (Biar bisa demo sertifikat)
        $specialEvent = Event::create([
            'organizer_id' => $mainOrganizer->id,
            'title' => 'Relawan Gempa Cianjur (Spesial)',
            'category' => 'Bencana',
            'description' => 'Membantu pemulihan pasca gempa.',
            'responsibilities' => "- Logistik\n- Medis",
            'requirements' => "- Fisik kuat",
            'event_date' => Carbon::now()->subDays(10),
            'location' => 'Cianjur, Jawa Barat',
            'salary' => 'Sertifikat Nasional',
            'status' => 'closed',
        ]);

        Application::create([
            'user_id' => $revan->id,
            'event_id' => $specialEvent->id,
            'status' => 'completed', // PENTING: Biar sertifikat muncul
            'message' => 'Saya siap membantu.',
        ]);

        // Buat 1 Event yang Accepted buat Demo Chat
        $chatEvent = Event::create([
            'organizer_id' => $mainOrganizer->id,
            'title' => 'Konservasi Penyu Bali',
            'category' => 'Lingkungan',
            'description' => 'Menjaga telur penyu dari predator.',
            'responsibilities' => "- Patroli malam",
            'requirements' => "- Suka hewan",
            'event_date' => Carbon::now()->addDays(5),
            'location' => 'Denpasar, Bali',
            'salary' => 'Transport & Makan',
            'status' => 'open',
        ]);

        $appChat = Application::create([
            'user_id' => $revan->id,
            'event_id' => $chatEvent->id,
            'status' => 'accepted', // Accepted biar tombol chat muncul
            'message' => 'Impian saya ke Bali kak.',
        ]);

        // Isi Chat Palsu
        Message::create([
            'application_id' => $appChat->id,
            'user_id' => $mainOrganizer->id,
            'message' => 'Halo Revan, selamat bergabung! Kapan bisa briefing?',
            'is_read' => false,
        ]);
    }
}
