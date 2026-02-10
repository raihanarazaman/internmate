<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'company_id',
        'job_name',
        'position_title',
        'description',
        'job_scope',
        'requirements',
        'course_required',
        'min_cgpa',
        'location',
        'work_type',
        'duration',
        'allowance',
        'hostel_provided',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}