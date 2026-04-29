<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CvSubmission extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'email', 'phone', 'is_read'];

    protected $casts = ['is_read' => 'boolean'];

    public function cvUrl(): ?string
    {
        return $this->getFirstMediaUrl('cv_pdf') ?: null;
    }
}