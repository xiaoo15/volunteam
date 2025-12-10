<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Application; // <--- 1. TAMBAHKAN IMPORT INI

class NewApplicantNotification extends Notification
{
    use Queueable;

    public Application $application; // <--- 2. KASIH TIPE DATA 'Application'

    // 3. KASIH TIPE DATA DI PARAMETER JUGA
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        // Sekarang VS Code tahu kalau 'user' itu ada di dalam Application
        return [
            'message' => 'Ada pelamar baru: ' . $this->application->user->name . ' untuk event ' . $this->application->event->title,
            'url' => route('events.show', $this->application->event_id),
            'icon' => 'fa-solid fa-user-plus text-primary'
        ];
    }
}