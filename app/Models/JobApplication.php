<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_posting_id',
        'name',
        'email',
        'phone',
        'cv_path',
        'is_reviewed',
    ];

    protected $casts = [
        'is_reviewed' => 'boolean',
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
