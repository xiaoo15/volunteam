<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $message;
    public $sender;
    public $application_id;

    public function __construct($message, $sender, $application_id)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->application_id = $application_id;
    }

    public function via($notifiable)
    {
        return ['database']; // Kita simpan di database biar bisa dilist di navbar
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'sender_name' => $this->sender->name,
            'application_id' => $this->application_id,
            'type' => 'chat'
        ];
    }
}