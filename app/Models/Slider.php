<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('slider_images')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('slider_images');
    }

    protected $fillable = [
        'tagline',
        'title',
        'description',
        'design_word',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            cache()->forget('slider_data');
            cache()->forget('slider_items_data');
        });

        static::deleted(function () {
            cache()->forget('slider_data');
            cache()->forget('slider_items_data');
        });
    }

    public function imageUrls(): array
    {
        return $this->getMedia('slider_images')
            ->map(function ($media) {
                $url = $media->getUrl();

                if ($media->hasGeneratedConversion('webp')) {
                    $url = $media->getUrl('webp');
                }

                if ($media->hasGeneratedConversion('avif')) {
                    $url = $media->getUrl('avif');
                }

                return $url;
            })
            ->values()
            ->all();
    }
}