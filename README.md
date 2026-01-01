# 🤝 VolunTeam
**Platform Manajemen Relawan & Event**

Selamat datang di repositori **VolunTeam**. Dokumen ini berisi panduan lengkap untuk instalasi, konfigurasi, dan pengujian aplikasi di lingkungan lokal.

> **Catatan Penting:** Demi efisiensi ukuran file, folder `vendor` (PHP Dependencies) dan `node_modules` (JS Dependencies) **tidak disertakan**. Mohon ikuti langkah instalasi di bawah ini untuk mengunduhnya.

---

## 💻 1. Prasyarat Sistem (System Requirements)
Pastikan perangkat Anda telah terinstall *software* berikut agar aplikasi berjalan 100% lancar:

* **PHP** >= 8.1
* **Composer**
* **Node.js & NPM**
* **MySQL Database** (via XAMPP, Laragon, atau DB Manager lainnya)

---

## ⚙️ 2. Langkah Instalasi (Backend & Dependencies)

Silakan buka terminal (CMD/PowerShell/Git Bash) dan arahkan ke direktori project `1_Source_Code`.

### Step 1: Install Dependencies
Jalankan perintah berikut secara berurutan untuk mengunduh library yang dibutuhkan:

```bash
# 1. Install Library PHP (Backend)
composer install

# 2. Install Library JavaScript (Frontend)
npm install

# 3. Compile Aset Frontend (Agar tampilan CSS/JS rapi)
npm run build
🔧 3. Konfigurasi Environment & DatabaseStep 1: Setup File .envDuplikat file konfigurasi contoh, lalu ubah namanya menjadi .env.Bashcp .env.example .env
(Atau lakukan rename manual melalui File Explorer)Step 2: Konfigurasi DatabaseBuka file .env dengan Text Editor, lalu sesuaikan konfigurasi database Anda:Cuplikan kodeDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=volunteam
DB_USERNAME=root
DB_PASSWORD=
Step 3: Generate App Key & Import DatabaseJalankan perintah ini di terminal:Bash# Generate kunci enkripsi aplikasi (Wajib agar tidak Error 500)
php artisan key:generate
Langkah Import SQL:Buka phpMyAdmin atau Database Client Anda.Buat database baru dengan nama: volunteam.Import file SQL yang terletak di: 2_Database/volunteam.sql.Step 4: Storage Link (PENTING ⚠️)Agar foto profil dan banner event dapat muncul dengan benar, jalankan:Bashphp artisan storage:link
🚀 4. Menjalankan AplikasiSetelah semua konfigurasi selesai, jalankan server lokal:Bashphp artisan serve
Buka browser favorit Anda dan akses:👉 http://127.0.0.1:8000🔑 5. Akun Demo (Siap Pakai)Gunakan kredensial berikut untuk pengujian agar tidak perlu melakukan registrasi ulang.Tipe AkunRoleEmailPasswordOrganizerPenyelenggara Eventorganizer@volunteam.compasswordVolunteerRelawanrevan@volunteam.compasswordSuper AdminAdministrator Paneladmin@volunteam.compassword🛠 6. TroubleshootingJika Anda menemui kendala seperti Error 500 atau tampilan layout berantakan, jalankan perintah pembersihan cache berikut:Bashphp artisan optimize:clear
php artisan config:cache
Jika masalah berlanjut, pastikan file database .sql telah ter-import sepenuhnya tanpa error.<p align="center">Dibuat dengan ❤️ oleh <b>Revan Andi Laksono</b></p>
