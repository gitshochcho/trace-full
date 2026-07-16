<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class ProjectLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'location',
        'sort_order',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}