<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Innovation extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title', 'category', 'description', 'website_link', 'sort_order', 'active', 'show_on_home'];

    protected $casts = [
        'active'       => 'boolean',
        'show_on_home' => 'boolean',
    ];

    public function imageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('innovation_image');

        return $url !== '' ? $url : null;
    }
}
