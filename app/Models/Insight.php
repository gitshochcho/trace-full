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
        // 'type_id',
        'video_link',
        'heading',
        'sub_heading',
        'description',
        'sort_order',
        'active',
        'published_at',
        'source_name',
    ];

    protected $casts = [
        'active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function videoUrl(): ?string
{
    // Priority 1: Direct Video Link (YouTube/Vimeo etc.)
    if (!empty($this->video_link)) {
        return $this->video_link;
    }

    // Priority 2: Uploaded Video File (Attachment)
    return $this->attachmentUrl();
}

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
    $typeCategory = strtolower(str_replace(' ', '_', $this->insightType?->type_category ?? 'read'));

    if ($typeCategory === 'read_on') {
        $sourceName = $this->source_name 
            ? parse_url($this->source_name, PHP_URL_HOST) 
            : 'Source';
      
        $sourceName = preg_replace('/^www\./', '', $sourceName ?? 'Source');
        return 'Read on ' . ucwords(str_replace(['.com', '.net', '.org', '.bd'], '', $sourceName));
    }

    return match(true) {
        $typeCategory === 'download' => 'Download',
        in_array($typeCategory, ['watch', 'video', 'video_watch']) => 'Watch',
        default => 'Read',
    };
}

public function articleImageUrl(): ?string
{
    $url = $this->getFirstMediaUrl('article_image');
    return $url !== '' ? $url : null;
}
}
