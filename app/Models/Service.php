<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'content_id',
        'slug',
        'service_name',
        'overview',
        'sort_order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // Automatically strip editor paragraph tags before storing overview.
    public function setOverviewAttribute($value): void
    {
        $value = (string) ($value ?? '');
        $value = preg_replace("/<p[^>]*>/i", "", $value);
        $value = preg_replace("/<\/p>/i", "\n", (string) $value);
        $value = preg_replace("/<br\s*\/?>/i", "\n", (string) $value);

        $clean = trim(strip_tags((string) $value));
        $this->attributes['overview'] = $clean === '' ? null : $clean;
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function details()
    {
        return $this->hasMany(ServiceDetail::class)->orderBy('sort_order');
    }

    public function solutions()
    {
        return $this->hasMany(ServiceProductSolution::class)->orderBy('sort_order');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_services');
    }

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('icon');

        return $url !== '' ? $url : null;
    }

    public function imageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('image');

        return $url !== '' ? $url : null;
    }

    public function heroContent(): ?Content
    {
        return $this->content;
    }
}