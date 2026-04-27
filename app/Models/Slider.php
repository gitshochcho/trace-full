<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'tagline',
        'title',
        'description',
        'design_word',
    ];

    public function imageUrls(): array
    {
        return $this->getMedia('slider_images')
            ->map(function ($media) {
                return $media->getUrl();
            })
            ->values()
            ->all();
    }
}