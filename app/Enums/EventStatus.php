<?php

namespace App\Enums;

enum EventStatus: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';
    case CANCELED = 'canceled';
    
    public function label(): string {
        return match($this) {
            self::OPEN => 'Aktif',
            self::CLOSED => 'Tutup',
            self::CANCELED => 'Dibatalkan',
        };
    }
}