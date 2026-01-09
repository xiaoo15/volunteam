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
            
            // 1. Prioritas: Jika ada URL spesifik di data notifikasi (misal: pelamar baru / status update)
            if (!empty($notification->data['url'])) {
                return redirect($notification->data['url']);
            }

            // 2. Fallback: Jika tipe chat (karena chat gak bawa URL di payloadnya)
            if (isset($notification->data['type']) && $notification->data['type'] == 'chat') {
                // Jika Organizer, arahkan ke event terkait
                if ($user->role == 'organizer') {
                     $appId = $notification->data['application_id'] ?? null;
                     if ($appId) {
                         $app = \App\Models\Application::find($appId);
                         return redirect()->route('events.show', $app->event_id);
                     }
                     return redirect()->route('organizer.events');
                }
                return redirect()->route('applications.history');
            }
        }
        return back();
    }
}