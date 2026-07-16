<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SliderItem extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'tagline',
        'description',
        'design_word',
        'sort_order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
        $this->addMediaCollection('video')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('image')
            ->nonQueued();
    }

    public function imageUrl(): ?string
    {
        $webpUrl = $this->getFirstMediaUrl('image', 'webp');
        if ($webpUrl) {
            return $webpUrl;
        }

        return $this->getFirstMediaUrl('image') ?: null;
    }

    public function videoUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('video');
        return $url !== '' ? $url : null;
    }
}