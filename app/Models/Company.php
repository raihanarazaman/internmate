<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    protected $fillable = [
        'company_email', 'company_name', 'location',  'user_id',  
    ];

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }
}