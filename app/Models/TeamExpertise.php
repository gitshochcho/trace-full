<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TeamExpertise extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'team_id',
        'heading',
        'description',
        'sort_order',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('icon')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('icon');
    }

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('icon', 'avif') ?: $this->getFirstMediaUrl('icon', 'webp') ?: $this->getFirstMediaUrl('icon');

        return $url !== '' ? $url : null;
    }
}
