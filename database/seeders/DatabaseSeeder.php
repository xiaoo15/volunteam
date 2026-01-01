<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Application;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. AKUN UTAMA (JANGAN DIUBAH)
        // ==========================================

        // Admin
        User::create([
            'name' => 'Administrator Pusat',
            'email' => 'admin@volunteam.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'avatar' => null,
        ]);

        // Organizer Utama
        $mainOrganizer = User::create([
            'name' => 'Yayasan Aksi Cepat Tanggap',
            'email' => 'organizer@volunteam.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
        ]);

        // Volunteer Utama (Revan)
        $revan = User::create([
            'name' => 'Revan Andi Laksono',
            'email' => 'revan@volunteam.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
        ]);

        // Organizer Tambahan
        $orgNames = ['Dompet Dhuafa', 'Rumah Zakat', 'Greenpeace Indonesia', 'Palang Merah Indonesia', 'Wahana Lingkungan Hidup'];
        $organizers = [];
        foreach ($orgNames as $name) {
            $organizers[] = User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '', $name)) . '@org.com',
                'password' => Hash::make('password'),
                'role' => 'organizer',
            ]);
        }
        $organizers[] = $mainOrganizer;

        // ==========================================
        // 2. DATA EVENT REAL (BAHASA INDONESIA BAKU)
        // ==========================================

        // KUMPULAN TEMPLATE EVENT NYATA
        $templates = [
            [
                'category' => 'Bencana',
                'title' => 'Tanggap Darurat: Banjir Bandang Sumatera Barat',
                'desc' => "Bencana banjir lahar dingin dan longsor melanda wilayah Kabupaten Agam dan Tanah Datar. Ribuan warga terdampak dan membutuhkan bantuan segera. Kami membuka posko dapur umum dan layanan kesehatan darurat.",
                'resp' => "- Membantu distribusi logistik ke daerah terisolir\n- Memasak di dapur umum (500 porsi/hari)\n- Membersihkan lumpur di fasilitas umum",
                'req' => "- Fisik prima dan tidak memiliki riwayat asma\n- Siap menginap di tenda posko selama 5 hari\n- Diutamakan memiliki sertifikat SAR Dasar",
                'loc' => 'Kab. Agam, Sumatera Barat',
                'img' => 'https://unair.ac.id/wp-content/uploads/2025/12/1000055358-1-1024x683.jpg'
            ],
            [
                'category' => 'Pendidikan',
                'title' => 'Relawan Pengajar: Sekolah Rimba Jambi',
                'desc' => "Anak-anak Suku Anak Dalam di Jambi membutuhkan akses pendidikan dasar. Kami mencari relawan muda yang berani tinggal di pedalaman untuk mengajarkan calistung (baca, tulis, hitung) dengan metode yang menyenangkan.",
                'resp' => "- Mengajar kelas pagi (08.00 - 12.00)\n- Membuat alat peraga edukatif dari bahan alam\n- Mengadakan kegiatan dongeng sore",
                'req' => "- Mahasiswa/Alumni jurusan Pendidikan (diutamakan)\n- Menyukai anak-anak dan sabar\n- Bersedia tidak memegang HP selama jam mengajar",
                'loc' => 'Taman Nasional Bukit Duabelas, Jambi',
                'img' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1000&auto=format&fit=crop'
            ],
            [
                'category' => 'Lingkungan',
                'title' => 'Operasi Semut: Bersih Pantai Kuta',
                'desc' => "Musim angin barat membawa ton sampah plastik kiriman ke pesisir Bali. Mari bergabung dalam aksi bersih pantai terbesar tahun ini untuk menyelamatkan penyu dan ekosistem laut kita.",
                'resp' => "- Memungut sampah plastik di sepanjang garis pantai\n- Memilah sampah organik dan anorganik\n- Mencatat data jenis sampah untuk riset",
                'req' => "- Membawa botol minum sendiri (Tumblr)\n- Memakai topi dan sunblock\n- Semangat tinggi!",
                'loc' => 'Pantai Kuta, Bali',
                'img' => 'https://radarsukabumi.com/wp-content/uploads/2024/04/Forkopimcam-Cisolok-Sukabumi.jpg'
            ],
            [
                'category' => 'Kesehatan',
                'title' => 'Donor Darah Masal & Cek Kesehatan Gratis',
                'desc' => "Stok darah PMI menipis. Kami mengadakan event donor darah masal sekaligus pemeriksaan kesehatan gratis untuk lansia (Gula darah, Asam Urat, Tensi). Kami butuh tenaga medis dan non-medis.",
                'resp' => "- Registrasi peserta donor\n- Membantu tensi darah (khusus relawan medis)\n- Membagikan konsumsi pasca-donor",
                'req' => "- Mahasiswa Kedokteran/Keperawatan (untuk tim medis)\n- Umum (untuk tim registrasi)\n- Ramah dan komunikatif",
                'loc' => 'Gelora Bung Karno, Jakarta',
                'img' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?q=80&w=1000&auto=format&fit=crop'
            ],
            [
                'category' => 'Teknologi',
                'title' => 'Bootcamp Coding untuk Anak Panti Asuhan',
                'desc' => "Mempersiapkan masa depan anak yatim dengan skill digital. Kita akan mengajarkan dasar-dasar HTML dan CSS agar mereka bisa membuat website sederhana sendiri.",
                'resp' => "- Menjadi mentor pendamping (1 mentor pegang 3 anak)\n- Membantu instalasi software di laptop lab\n- Sharing session tentang dunia kerja IT",
                'req' => "- Menguasai HTML/CSS Dasar\n- Membawa laptop sendiri\n- Sabar dalam membimbing pemula",
                'loc' => 'Panti Asuhan Mizan Amanah, Bandung',
                'img' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1000&auto=format&fit=crop'
            ],
            [
                'category' => 'Sosial',
                'title' => 'Jumat Berkah: Berbagi 1000 Nasi Bungkus',
                'desc' => "Gerakan berbagi makanan rutin setiap hari Jumat. Sasaran utama adalah tukang becak, pemulung, dan ojek online di sekitar jalan protokol Surabaya.",
                'resp' => "- Membungkus makanan di dapur umum\n- Distribusi menggunakan motor secara konvoi\n- Dokumentasi kegiatan",
                'req' => "- Memiliki kendaraan roda dua (SIM C)\n- Hadir tepat waktu jam 07.00 WIB\n- Ikhlas beramal",
                'loc' => 'Masjid Al-Akbar, Surabaya',
                'img' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1000&auto=format&fit=crop'
            ],
            [
                'category' => 'Lingkungan',
                'title' => 'Penanaman kembali sawit 3.1 juta hektar di Papua dan Aceh',
                'desc' => "Cegah abrasi pantai utara Jawa dengan sabuk hijau. Kami mengajak kamu turun langsung ke lumpur untuk menanam bibit bakau demi masa depan anak cucu.",
                'resp' => "- Menanam bibit sesuai instruksi ahli\n- Memasang ajir (penyangga bambu)\n- Membersihkan area tanam dari sampah",
                'req' => "- Tidak takut kotor/lumpur\n- Membawa baju ganti\n- Fisik kuat berjalan di area berlumpur",
                'loc' => 'Pesisir Brebes, Jawa Tengah',
                'img' => 'https://sawit-notif.s3.ap-southeast-1.amazonaws.com/2019/08/22093826/Cara-Menanam-Kelapa-Sawit-yang-Baik-dan-Benar.jpg'
            ],
            [
                'category' => 'Pendidikan',
                'title' => 'Festival Literasi Jalanan',
                'desc' => "Membuka lapak baca buku gratis di area Car Free Day. Tujuannya meningkatkan minat baca masyarakat dan menyediakan akses buku berkualitas secara cuma-cuma.",
                'resp' => "- Menata buku di rak display\n- Mengajak pengunjung untuk mampir membaca\n- Merapikan kembali buku setelah acara selesai",
                'req' => "- Suka membaca buku\n- Supel dan berani menyapa orang asing\n- Komitmen hadir hari Minggu pagi",
                'loc' => 'Bundaran HI, Jakarta Pusat',
                'img' => 'https://www.kemendikdasmen.go.id/mendikbud/image/12976'
            ]
        ];

        // LOOPING PEMBUATAN EVENT DARI TEMPLATE
        // Kita buat agak banyak dengan tanggal yang beda-beda
        foreach ($templates as $index => $t) {
            // Kita duplikasi event biar database rame, tapi tanggal & lokasinya divariasikan dikit
            for ($i = 0; $i < 2; $i++) {
                Event::create([
                    'organizer_id' => $organizers[array_rand($organizers)]->id,
                    'title' => $t['title'] . ($i > 0 ? ' (Gelombang ' . ($i + 2) . ')' : ''),
                    'category' => $t['category'],
                    'description' => $t['desc'],
                    'responsibilities' => $t['resp'],
                    'requirements' => $t['req'],
                    'event_date' => Carbon::now()->addDays(rand(2, 60)),
                    'location' => $t['loc'],
                    'salary' => rand(0, 1) ? 'Transport & Konsumsi' : 'Sertifikat & Relasi',
                    'status' => 'open',
                    'image' => $t['img'],
                ]);
            }
        }

        // ==========================================
        // 3. RIWAYAT LAMARAN UNTUK DEMO
        // ==========================================

        // Ambil Event Banjir Sumatra (Pasti ada karena di loop pertama)
        $sumatraEvent = Event::where('title', 'like', '%Banjir Bandang%')->first();

        if ($sumatraEvent) {
            // Lamaran DITERIMA (Revan)
            Application::create([
                'user_id' => $revan->id,
                'event_id' => $sumatraEvent->id,
                'status' => 'accepted',
                'message' => 'Saya siap berangkat, kebetulan saya punya pengalaman logistik bencana 2 tahun.',
                'cv' => 'dummy-cv.pdf',
                'created_at' => Carbon::now()->subDays(2),
            ]);

            // Pesan Chat dari Organizer
            $app = Application::where('user_id', $revan->id)->where('event_id', $sumatraEvent->id)->first();
            Message::create([
                'application_id' => $app->id,
                'user_id' => $sumatraEvent->organizer_id, // Organizer
                'message' => 'Halo Revan, terima kasih. Tim kami akan menghubungi via WA untuk briefing keberangkatan.',
                'is_read' => false,
            ]);
        }

        // Buat satu event SELESAI biar bisa demo download sertifikat
        $doneEvent = Event::create([
            'organizer_id' => $mainOrganizer->id,
            'title' => 'Relawan Gempa Cianjur (Batch 1)',
            'category' => 'Bencana',
            'description' => 'Membantu pemulihan trauma healing anak-anak korban gempa.',
            'responsibilities' => "- Mengajak main anak-anak\n- Membagikan snack",
            'requirements' => "- Psikolog/Mahasiswa Psikologi",
            'event_date' => Carbon::now()->subMonths(1), // Masa lalu
            'location' => 'Cianjur, Jawa Barat',
            'salary' => 'Sertifikat Nasional',
            'status' => 'completed',
            'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?q=80&w=1000&auto=format&fit=crop',
        ]);

        // Lamaran SELESAI (Revan)
        Application::create([
            'user_id' => $revan->id,
            'event_id' => $doneEvent->id,
            'status' => 'completed', // Status penting buat sertifikat
            'message' => 'Izin bergabung kak.',
            'created_at' => Carbon::now()->subMonths(1)->addDay(),
        ]);

        // Tambahan Pelamar Lain (Dummy User)
        $users = User::factory(5)->create(['role' => 'volunteer']);
        foreach ($users as $usr) {
            if ($sumatraEvent) {
                Application::create([
                    'user_id' => $usr->id,
                    'event_id' => $sumatraEvent->id,
                    'status' => 'pending',
                    'message' => 'Saya sangat ingin membantu saudara kita di Sumatera.',
                ]);
            }
        }
    }
}
