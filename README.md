========================================================================
PANDUAN INSTALASI & MENJALANKAN PROJECT - VOLUNTEAM
Oleh: Revan Andi Laksono
========================================================================

Terima kasih telah meninjau proyek VolunTeam.
Agar aplikasi berjalan lancar 100%, mohon ikuti langkah-langkah di bawah ini.

Catatan: Folder 'vendor' dan 'node_modules' tidak disertakan untuk efisiensi ukuran file.

------------------------------------------------------------------------
1. PRASYARAT SISTEM (SYSTEM REQUIREMENTS)
------------------------------------------------------------------------
Pastikan di komputer Juri sudah terinstall:
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL (XAMPP / Laragon)

------------------------------------------------------------------------
2. LANGKAH INSTALASI (BACKEND & DEPENDENCIES)
------------------------------------------------------------------------
1. Buka Terminal / CMD, arahkan ke folder '1_Source_Code'.
2. Install Library PHP (Wajib):
   Ketik: composer install

3. Install Library JavaScript (Wajib):
   Ketik: npm install

4. Build Aset Frontend (Agar tampilan rapi):
   Ketik: npm run build

------------------------------------------------------------------------
3. KONFIGURASI ENV & DATABASE
------------------------------------------------------------------------
1. Duplikat file .env.example dan ubah namanya menjadi .env
2. Buka file .env tersebut dengan Notepad/Text Editor.
3. Pastikan pengaturan database sesuai (biasanya seperti ini):
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=volunteam
   DB_USERNAME=root
   DB_PASSWORD=

4. Generate App Key (Penting agar tidak error 500):
   Di terminal, ketik: php artisan key:generate

5. Setup Database MySQL:
   - Buka phpMyAdmin (localhost/phpmyadmin).
   - Buat database baru dengan nama: volunteam
   - Klik menu 'Import'.
   - Pilih file 'volunteam.sql' yang ada di dalam folder '2_Database'.
   - Klik 'Go' / 'Kirim'.

6. Aktifkan Penyimpanan Gambar (PENTING):
   Agar foto profil dan event muncul, ketik di terminal:
   php artisan storage:link

------------------------------------------------------------------------
4. MENJALANKAN APLIKASI
------------------------------------------------------------------------
1. Di terminal folder '1_Source_Code', jalankan server:
   Ketik: php artisan serve

2. Buka browser (Chrome/Edge) dan akses:
   http://127.0.0.1:8000, atau
   http://localhost:8000/

------------------------------------------------------------------------
5. AKUN DEMO (SIAP PAKAI)
------------------------------------------------------------------------
Gunakan akun ini untuk pengujian agar tidak perlu register ulang:

A. AKUN ORGANIZER (Penyelenggara Event)
   Email    : organizer@volunteam.com
   Password : password

B. AKUN VOLUNTEER (Relawan)
   Email    : revan@volunteam.com
   Password : password

C. AKUN ADMIN (Panel Admin)
   Email    : admin@volunteam.com
   Password : password
------------------------------------------------------------------------
6. TROUBLESHOOTING (JIKA ADA ERROR)
------------------------------------------------------------------------
Jika terjadi error "500 Server Error" atau tampilan berantakan:
1. Coba bersihkan cache dengan perintah:
   php artisan optimize:clear
   php artisan config:cache

2. Pastikan file database (.sql) sudah sukses di-import sepenuhnya.

========================================================================
Terima Kasih! - Revan Andi Laksono
========================================================================
