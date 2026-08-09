<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectLocation;
use App\Models\ProjectOutcome;
use App\Models\ProjectPhaseDetail;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('hero', 'images')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('hero', 'images');

        // Responsive width variants for the hero banner (largest, most-loaded image on project pages).
        $this->addMediaConversion('hero_sm')
            ->format('webp')
            ->width(640)
            ->quality(80)
            ->performOnCollections('hero');

        $this->addMediaConversion('hero_md')
            ->format('webp')
            ->width(1024)
            ->quality(80)
            ->performOnCollections('hero');

        $this->addMediaConversion('hero_lg')
            ->format('webp')
            ->width(1600)
            ->quality(80)
            ->performOnCollections('hero');
    }

    protected $fillable = [
        'project_title',
        'client',
        'project_standard',
        'overview',
        'start_date',
        'end_date',
        'project_status',
        'sort_order',
        'show_on_home',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'show_on_home' => 'boolean',
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

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_project_table');
    }

    public function heroImageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('hero', 'avif') ?: $this->getFirstMediaUrl('hero', 'webp') ?: $this->getFirstMediaUrl('hero');

        if ($url !== '') {
            return $url;
        }

        return $this->imageUrl();
    }

    public function heroSrcset(): ?string
    {
        $media = $this->getFirstMedia('hero');

        if (! $media) {
            return null;
        }

        $variants = [];
        foreach (['hero_sm' => 640, 'hero_md' => 1024, 'hero_lg' => 1600] as $conversion => $width) {
            if ($media->hasGeneratedConversion($conversion)) {
                $variants[] = $media->getUrl($conversion) . ' ' . $width . 'w';
            }
        }

        return $variants ? implode(', ', $variants) : null;
    }

    public function imageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('images', 'avif') ?: $this->getFirstMediaUrl('images', 'webp') ?: $this->getFirstMediaUrl('images');

        return $url !== '' ? $url : null;
    }

    public function galleryImageUrls()
    {
        return $this->getMedia('images')->map(function ($media) {
            $url = $media->getUrl();

            if ($media->hasGeneratedConversion('webp')) {
                $url = $media->getUrl('webp');
            }

            if ($media->hasGeneratedConversion('avif')) {
                $url = $media->getUrl('avif');
            }

            return [
                'id' => $media->id,
                'url' => $url,
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