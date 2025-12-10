<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationMessage extends Model
{
    protected $fillable = ['application_id', 'user_id', 'message', 'is_organizer'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    //
}
