<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Content extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'slug',
        'section',
        'heading',
        'sub_heading',
        'description',
        'design_word',
        'type',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('icon', 'image')
            ->nonQueued();

        // AVIF encoding is ~8x slower than webp on GD, so it's queued instead of
        // blocking the upload request. Requires a running queue worker.
        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('icon', 'image');
    }

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('icon', 'avif') ?: ($this->getFirstMediaUrl('icon', 'webp') ?: $this->getFirstMediaUrl('icon'));

        return $url !== '' ? $url : null;
    }

    public function imageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('image', 'avif') ?: ($this->getFirstMediaUrl('image', 'webp') ?: $this->getFirstMediaUrl('image'));

        return $url !== '' ? $url : null;
    }
}