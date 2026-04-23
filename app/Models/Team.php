<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Team extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'last_name',
        'designation',
        'description',
        'sort_order',
        'type',
        'headtitle'
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
        $url = $this->getFirstMediaUrl('image');

        return $url !== '' ? $url : null;
    }

    public function fullName(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }
}
