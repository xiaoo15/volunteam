<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string',
            'skills' => 'nullable|string',
            // Validasi gambar: Harus gambar, max 2MB
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->skills = $request->skills;

        // 🔥 LOGIC UPLOAD GAMBAR 🔥
        if ($request->hasFile('avatar')) {
            // 1. Hapus gambar lama kalau ada (biar server gak penuh sampah)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // 2. Simpan gambar baru ke folder 'avatars' di storage public
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Update password kalau diisi
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function showPublicProfile(\App\Models\User $user)
    {
        // 1. Data Dasar
        $stats = [];
        $events = [];
        $badges = []; // 🔥 Array Badge Baru

        // 2. LOGIKA BADGE & STATS
        if ($user->role == 'organizer') {
            // --- LOGIKA ORGANIZER ---
            $eventCount = $user->events()->count();

            // Ambil event aktif
            $events = \App\Models\Event::where('organizer_id', $user->id)
                ->where('status', 'open')
                ->latest()
                ->get();

            $stats = [
                'Total Misi' => $eventCount,
                'Relawan Dibantu' => \App\Models\Application::whereHas('event', function ($q) use ($user) {
                    $q->where('organizer_id', $user->id);
                })->where('status', 'completed')->count(),
            ];

            // 🏆 BADGES ORGANIZER
            $badges[] = ['name' => 'Official Organizer', 'icon' => 'fa-building-circle-check', 'color' => 'primary', 'desc' => 'Akun organisasi terverifikasi.'];

            if ($eventCount >= 1) {
                $badges[] = ['name' => 'Inisiator', 'icon' => 'fa-lightbulb', 'color' => 'warning', 'desc' => 'Telah membuat misi pertamanya.'];
            }
            if ($eventCount >= 5) {
                $badges[] = ['name' => 'Penggerak Komunitas', 'icon' => 'fa-users-gear', 'color' => 'success', 'desc' => 'Aktif membuat dampak massal.'];
            }
            if ($eventCount >= 10) {
                $badges[] = ['name' => 'Change Maker', 'icon' => 'fa-earth-asia', 'color' => 'info', 'desc' => 'Legenda perubahan sosial.'];
            }
        } else {
            // --- LOGIKA VOLUNTEER ---
            $completedMissions = $user->applications()->where('status', 'completed')->count();

            $stats = [
                'Misi Selesai' => $completedMissions,
                'Jam Kontribusi' => $completedMissions * 5, // Asumsi 1 event = 5 jam
                'Bergabung' => $user->created_at->diffForHumans(),
            ];

            // 🏆 BADGES VOLUNTEER
            $badges[] = ['name' => 'Relawan Terdaftar', 'icon' => 'fa-id-card', 'color' => 'secondary', 'desc' => 'Anggota resmi VolunTeam.'];

            if ($completedMissions >= 1) {
                $badges[] = ['name' => 'Aksi Pertama', 'icon' => 'fa-hand-holding-heart', 'color' => 'primary', 'desc' => 'Menyelesaikan misi kebaikan pertama.'];
            }
            if ($completedMissions >= 3) {
                $badges[] = ['name' => 'Si Paling Aktif', 'icon' => 'fa-person-running', 'color' => 'warning', 'desc' => 'Konsisten membantu sesama.'];
            }
            if ($completedMissions >= 10) {
                $badges[] = ['name' => 'Pahlawan Sosial', 'icon' => 'fa-medal', 'color' => 'danger', 'desc' => 'Dedikasi tingkat tinggi.'];
            }
        }

        return view('profile.show', compact('user', 'events', 'stats', 'badges'));
    }
}
