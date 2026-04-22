<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('icon');

        return $url !== '' ? $url : null;
    }
}
