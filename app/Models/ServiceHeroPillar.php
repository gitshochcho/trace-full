<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ServiceHeroPillar extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'service_id',
        'title',
        'description',
        'sort_order',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function iconUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('icon');

        return $url !== '' ? $url : null;
    }
}
