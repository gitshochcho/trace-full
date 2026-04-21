<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class ProjectPhaseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'phase_description',
        'attachment',
        'sort_order',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function attachmentUrl(): ?string
    {
        if (! $this->attachment) {
            return null;
        }

        return asset('storage/' . ltrim($this->attachment, '/'));
    }
}