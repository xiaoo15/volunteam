<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Message;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $chat;

    // Kita terima data pesan yang baru dibuat
    public function __construct(Message $chat)
    {
        $this->chat = $chat;
    }

    // Tentukan mau dikirim lewat apa (Database = Lonceng di web)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Susun isi notifikasi yang bakal masuk ke database
    public function toArray($notifiable)
    {
        return [
            'type' => 'chat', // Penanda kalau ini notif chat
            'application_id' => $this->chat->application_id,
            'sender_id' => $this->chat->user_id,
            'sender_name' => $this->chat->user->name, // Nama pengirim
            'message' => $this->chat->message, // Isi pesannya
        ];
    }
}