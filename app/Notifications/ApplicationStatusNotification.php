<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApplicationStatusNotification extends Notification
{
    use Queueable;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $status = $this->application->status;
        $msg = '';
        $icon = '';

        if ($status == 'accepted') {
            $msg = 'Selamat! Lamaranmu di ' . $this->application->event->title . ' DITERIMA! 🎉';
            $icon = 'fa-solid fa-circle-check text-success';
        } elseif ($status == 'rejected') {
            $msg = 'Maaf, lamaranmu di ' . $this->application->event->title . ' belum lolos.';
            $icon = 'fa-solid fa-circle-xmark text-danger';
        } else {
            $msg = 'Status lamaranmu di ' . $this->application->event->title . ' telah diperbarui.';
            $icon = 'fa-solid fa-info-circle text-info';
        }

        return [
            'message' => $msg,
            'url' => route('applications.history'), // Link ke riwayat
            'icon' => $icon
        ];
    }
}
