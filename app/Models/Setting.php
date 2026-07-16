<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'logo_text',
        'logo_tagline',
        'social_links',
        'footer_contact_mobile',
        'footer_contact_email',
        'footer_contact_location',
        'footer_description',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function logoImageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('logo_image');

        return $url !== '' ? $url : null;
    }

    public function faviconImageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('favicon_image');

        return $url !== '' ? $url : null;
    }

    public function socialLinksWithIcons(): array
    {
        $links = is_array($this->social_links) ? $this->social_links : [];

        return collect($links)->map(function (array $item) {
            $mediaKey = $item['media_key'] ?? null;
            $iconUrl = null;

            if ($mediaKey) {
                $iconUrl = $this->getFirstMediaUrl('social_icon_' . $mediaKey);
                if ($iconUrl === '') {
                    $iconUrl = null;
                }
            }

            return [
                'title' => $item['title'] ?? null,
                'link' => $item['link'] ?? null,
                'media_key' => $mediaKey,
                'icon_url' => $iconUrl,
            ];
        })->all();
    }
}