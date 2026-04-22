<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['name', 'description', 'link', 'sort_order', 'active'];

    public function imageUrl()
    {
        return $this->getFirstMediaUrl('partner_image');
    }
}