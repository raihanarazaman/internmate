<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    protected $fillable = [
        'email', 'company_name', 'location', 'password'
    ];

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }
}