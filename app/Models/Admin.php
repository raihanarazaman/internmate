<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Admin extends Model
{
     use Notifiable;
    protected $fillable = [
        'user_id',
        'staff_id',
        'full_name', // ✅ added
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
