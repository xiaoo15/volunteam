<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Fungsi untuk menandai semua notifikasi sudah dibaca
    public function markAllRead()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return back(); // Kembali ke halaman sebelumnya
    }
    
    // Fungsi jika notifikasi diklik satu per satu (Optional)
    public function markAsRead($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $notification = $user->notifications()->find($id);
        if($notification) {
            $notification->markAsRead();
            
            // Redirect sesuai tipe notifikasi
            if (isset($notification->data['type']) && $notification->data['type'] == 'chat') {
                return redirect()->route('applications.history');
            }
        }
        return back();
    }
}