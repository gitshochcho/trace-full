<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Insight;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class InsightArticle extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

   protected $fillable = [
    'type', 'video_link', 'heading', 'sub_heading', 'description',
    'sort_order', 'active', 'published_at',
    'read_minutes', 'image_description', 'social_links',  
];

    protected $casts = [
    'active'       => 'boolean',
    'published_at' => 'datetime',
    'read_minutes' => 'integer',  
    'social_links' => 'array',      
];

    public function insight()
    {
        return $this->belongsTo(Insight::class);
    }

    public function author()
    {
        return $this->belongsTo(Team::class, 'author_team_id');
    }

    public function insightType()
    {
        return $this->belongsTo(InsightType::class, 'type', 'id');
    }

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('icon');

        return $url !== '' ? $url : null;
    }
    
    public function registerMediaCollections(): void
{
    $this->addMediaCollection('image')->singleFile();
    $this->addMediaCollection('attachment')->singleFile();
    $this->addMediaCollection('article_image')->singleFile();
    $this->addMediaCollection('social_icons');
}

    public function attachmentUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('attachment');

        return $url !== '' ? $url : null;
    }

    public function actionLabel(): string
    {
        $typeString = $this->insightType ? strtolower($this->insightType->type) : 'read';
        return match ($typeString) {
            'download', 'publications' => 'Download',
            'video', 'watch', 'video_watch', 'watch_video', 'videos' => 'Watch',
            default => 'Read',
        };
    }
}
