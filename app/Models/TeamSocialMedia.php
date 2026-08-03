<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TeamSocialMedia extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'team_social_media';

    protected $fillable = [
        'team_id',
        'title',
        'social_link',
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
            ->performOnCollections('social_icon')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('social_icon');
    }

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('social_icon', 'avif') ?: $this->getFirstMediaUrl('social_icon', 'webp') ?: $this->getFirstMediaUrl('social_icon');

        return $url !== '' ? $url : null;
    }
}
