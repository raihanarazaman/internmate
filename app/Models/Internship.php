<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Internship extends Model
{
    protected $fillable = [
        'company_id',
         'status', 
        'job_name',
        'position',
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