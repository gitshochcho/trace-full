<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Team extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('image')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('image');

        $this->addMediaConversion('image_sm')
            ->format('webp')
            ->width(320)
            ->quality(80)
            ->performOnCollections('image');

        $this->addMediaConversion('image_md')
            ->format('webp')
            ->width(640)
            ->quality(80)
            ->performOnCollections('image');
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'designation',
        'short_description',
        'description',
        'sort_order',
        'type',
        'headtitle',
        'expertise_label',
    ];

    public function experties()
    {
        return $this->hasMany(TeamExpertise::class)->orderBy('sort_order');
    }

    public function socialMedia()
    {
        return $this->hasMany(TeamSocialMedia::class)->orderBy('sort_order');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'team_project_table');
    }

    public function insightArticles()
    {
        return $this->hasMany(InsightArticle::class, 'author_team_id')->orderBy('sort_order');
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
        foreach (['image_sm' => 320, 'image_md' => 640] as $conversion => $width) {
            if ($media->hasGeneratedConversion($conversion)) {
                $variants[] = $media->getUrl($conversion) . ' ' . $width . 'w';
            }
        }

        return $variants ? implode(', ', $variants) : null;
    }

    public function fullName(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }
}
