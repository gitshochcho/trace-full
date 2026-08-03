<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('icon', 'image')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('icon', 'image');

        $this->addMediaConversion('image_sm')
            ->format('webp')
            ->width(400)
            ->quality(80)
            ->performOnCollections('image');

        $this->addMediaConversion('image_md')
            ->format('webp')
            ->width(800)
            ->quality(80)
            ->performOnCollections('image');
    }

    protected $fillable = [
        'slug',
        'service_name',
        'section',
        'heading',
        'design_word',
        'description',
        'overview',
        'sort_order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // Automatically strip editor paragraph tags before storing overview.
    public function setOverviewAttribute($value): void
    {
        $value = (string) ($value ?? '');
        $value = preg_replace("/<p[^>]*>/i", "", $value);
        $value = preg_replace("/<\/p>/i", "\n", (string) $value);
        $value = preg_replace("/<br\s*\/?>/i", "\n", (string) $value);

        $clean = trim(strip_tags((string) $value));
        $this->attributes['overview'] = $clean === '' ? null : $clean;
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function details()
    {
        return $this->hasMany(ServiceDetail::class)->orderBy('sort_order');
    }

    public function heroPillars()
    {
        return $this->hasMany(ServiceHeroPillar::class)->orderBy('sort_order');
    }

    public function solutions()
    {
        return $this->hasMany(ServiceProductSolution::class)->orderBy('sort_order');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_services');
    }

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('icon', 'avif') ?: $this->getFirstMediaUrl('icon', 'webp') ?: $this->getFirstMediaUrl('icon');

        return $url !== '' ? $url : null;
    }

    public function imageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('image', 'avif') ?: $this->getFirstMediaUrl('image', 'webp') ?: $this->getFirstMediaUrl('image');

        return $url !== '' ? $url : null;
    }

    public function imageSrcset(): ?string
    {
        $media = $this->getFirstMedia('image');

        if (! $media) {
            return null;
        }

        $variants = [];
        foreach (['image_sm' => 400, 'image_md' => 800] as $conversion => $width) {
            if ($media->hasGeneratedConversion($conversion)) {
                $variants[] = $media->getUrl($conversion) . ' ' . $width . 'w';
            }
        }

        return $variants ? implode(', ', $variants) : null;
    }

    public function heroContent(): ?Content
    {
        return $this->content;
    }
}