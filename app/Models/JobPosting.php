<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'department',
        'employment_type',
        'location',
        'experience_level',
        'responsibilities',
        'requirements',
        'is_active',
        'show_on_home',
        'posted_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_home' => 'boolean',
        'posted_date' => 'date',
        'end_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('posted_date', 'desc');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
