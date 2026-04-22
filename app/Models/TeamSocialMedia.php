<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('social_icon');

        return $url !== '' ? $url : null;
    }
}
