<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
     use Notifiable;
    protected $fillable = [
        'student_id', 'full_name', 'course', 'cgpa', 'interests', 'user_id',  
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}