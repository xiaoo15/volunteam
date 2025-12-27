<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $message;
    public $senderName;
    public $applicationId;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $senderName, $applicationId)
    {
        $this->message = $message;
        $this->senderName = $senderName;
        $this->applicationId = $applicationId;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // Biar masuk ke Lonceng Notifikasi (Database)
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            // Pesan yang muncul di dropdown notifikasi
            'message' => 'Pesan baru dari ' . $this->senderName,
            'url' => route('applications.history'), // Link kalau diklik
            'application_id' => $this->applicationId,
            'full_message' => $this->message // Simpan pesan lengkapnya juga
        ];
    }
}