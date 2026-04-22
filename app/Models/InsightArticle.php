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
        'insight_id',
        'author_team_id',
        'type',
        'title',
        'description',
        'sort_order',
        'read_minutes',
        'active',
        'published_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function insight()
    {
        return $this->belongsTo(Insight::class);
    }

    public function author()
    {
        return $this->belongsTo(Team::class, 'author_team_id');
    }

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('icon');

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
