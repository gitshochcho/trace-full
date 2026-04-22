<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InsightArticle;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Insight extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'type',
        'heading',
        'sub_heading',
        'description',
        'sort_order',
        'active',
        'published_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(InsightArticle::class)->orderBy('sort_order')->latest('id');
    }

    public function insightType()
    {
        return $this->belongsTo(InsightType::class, 'type', 'id');
    }   

    public function imageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('image');

        return $url !== '' ? $url : null;
    }

    public function attachmentUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('attachment');

        return $url !== '' ? $url : null;
    }

    public function actionLabel(): string
    {
        return match (strtolower((string) $this->type)) {
            'download' => 'Download',
            'video', 'watch', 'video_watch', 'watch_video' => 'Watch',
            default => 'Read',
        };
    }
}
