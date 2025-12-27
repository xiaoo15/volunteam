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
}
