<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectLocation;
use App\Models\ProjectOutcome;
use App\Models\ProjectPhaseDetail;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'project_title',
        'client',
        'project_standard',
        'overview',
        'start_date',
        'end_date',
        'project_status',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'project_services');
    }

    public function locations()
    {
        return $this->hasMany(ProjectLocation::class)->orderBy('sort_order');
    }

    public function phaseDetails()
    {
        return $this->hasMany(ProjectPhaseDetail::class)->orderBy('sort_order');
    }

    public function outcomes()
    {
        return $this->hasMany(ProjectOutcome::class)->orderBy('sort_order');
    }

    public function imageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('images');

        return $url !== '' ? $url : null;
    }

    public function galleryImageUrls()
    {
        return $this->getMedia('images')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
            ];
        })->values();
    }

    public function durationLabel(): ?string
    {
        if (! $this->start_date && ! $this->end_date) {
            return null;
        }

        $start = $this->start_date?->format('M Y');
        $end = $this->end_date?->format('M Y');

        if ($start && $end) {
            return $start . ' - ' . $end;
        }

        return $start ?: $end;
    }
}