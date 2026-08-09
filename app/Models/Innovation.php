<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Innovation extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title', 'category', 'description', 'website_link', 'sort_order', 'active', 'show_on_home'];

    protected $casts = [
        'active'       => 'boolean',
        'show_on_home' => 'boolean',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('innovation_image')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('innovation_image');

        $this->addMediaConversion('image_sm')
            ->format('webp')
            ->width(400)
            ->quality(80)
            ->performOnCollections('innovation_image');

        $this->addMediaConversion('image_md')
            ->format('webp')
            ->width(800)
            ->quality(80)
            ->performOnCollections('innovation_image');
    }

    public function imageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('innovation_image', 'avif') ?: $this->getFirstMediaUrl('innovation_image', 'webp') ?: $this->getFirstMediaUrl('innovation_image');

        return $url !== '' ? $url : null;
    }

    public function imageSrcset(): ?string
    {
        $media = $this->getFirstMedia('innovation_image');

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
}
