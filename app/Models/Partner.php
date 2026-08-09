<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Partner extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['name', 'description', 'link', 'sort_order', 'active'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('partner_image')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('partner_image');
    }

    public function imageUrl()
    {
        return $this->getFirstMediaUrl('partner_image', 'avif') ?: $this->getFirstMediaUrl('partner_image', 'webp') ?: $this->getFirstMediaUrl('partner_image');
    }
}