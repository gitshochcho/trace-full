<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Free-form key/value meta tags an admin can attach to a static page (via page_route_name)
 * or a detail-page entity (via entity_type + entity_id), without a schema change per new tag.
 * Rendered as a name= or property= meta tag depending on the key prefix (og, article, fb, twitter).
 */
class CustomMeta extends Model
{
    use HasFactory;

    public const TYPES = ['meta', 'og', 'twitter', 'custom'];

    /**
     * Only lowercase letters, digits, colons, hyphens and underscores — blocks HTML/attribute
     * injection via the key (e.g. `content="x" onerror="..."`) since the key is rendered
     * as a raw attribute name in the frontend <meta> tag.
     */
    public const KEY_PATTERN = '/^[a-z0-9:_-]+$/i';

    /**
     * Keys already rendered by resources/views/frontend/layout/meta.blade.php — an admin
     * cannot add a custom meta under one of these, since it would produce a duplicate tag.
     */
    public const RESERVED_KEYS = [
        'description', 'robots', 'author', 'og:type', 'og:url', 'og:title', 'og:description',
        'og:image', 'og:image:alt', 'og:site_name', 'og:locale', 'fb:app_id',
        'article:author', 'article:section', 'article:published_time', 'article:modified_time',
        'twitter:card', 'twitter:title', 'twitter:description', 'twitter:image', 'twitter:site', 'twitter:creator',
    ];

    protected $fillable = [
        'page_route_name',
        'entity_type',
        'entity_id',
        'type',
        'key',
        'value',
    ];

    /**
     * Property-style keys (og:*, article:*, fb:*, twitter:*) render as
     * <meta property="key" ...>; everything else renders as <meta name="key" ...>,
     * matching standard HTML meta tag conventions.
     */
    public function usesPropertyAttribute(): bool
    {
        return (bool) preg_match('/^(og|article|fb|product|book|profile):/i', $this->key);
    }
}
