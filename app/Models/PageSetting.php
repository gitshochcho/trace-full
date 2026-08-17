<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Represents one of the site's static pages (Home, About, Services, ...) plus its SEO metadata.
 *
 * The fixed page-registry columns (page_slug, page_name) are real columns, but everything
 * SEO-related (meta_title, robots, og_type, twitter_card, ...) is stored as (key, value) rows
 * in page_meta — see PageMeta. This means a brand new SEO field never requires a migration:
 * just add its key to KNOWN_KEYS below (for admin-UI/validation support) and start reading/
 * writing it like any other attribute, e.g. $pageSetting->my_new_field.
 *
 * getAttribute()/setAttribute() are overridden so existing code (controllers, Blade views)
 * can keep using plain property access — $pageSetting->meta_title works exactly as it did
 * when meta_title was a real column, it's just backed by an EAV row underneath.
 */
class PageSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * Original hardcoded SEO copy each page shipped with, keyed by page_slug.
     * Single source of truth for both the seeder and the admin "Reset to Default" button.
     */
    public const PAGE_DEFAULTS = [
        'home' => [
            'page_name' => 'Home Page',
            'meta_title' => 'TRACE Consulting',
            'meta_description' => 'TRACE Consulting is a strategic advisory firm specializing in international trade, economic policy, and regulatory reform.',
        ],
        'about' => [
            'page_name' => 'About Us',
            'meta_title' => 'About TRACE Consulting | Our Mission & Team',
            'meta_description' => "Learn about TRACE Consulting's mission, team and approach to regulatory reform, technical capacity building and development advisory.",
        ],
        'team' => [
            'page_name' => 'Team Page',
            'meta_title' => 'Our Team & Leadership | TRACE Consulting',
            'meta_description' => "Meet the leadership, core team and advisors driving TRACE Consulting's regulatory reform and development advisory work forward.",
        ],
        'projects' => [
            'page_name' => 'Projects Page',
            'meta_title' => 'Our Projects | TRACE Consulting',
            'meta_description' => "Browse TRACE Consulting's portfolio of regulatory reform, technical assistance and development advisory projects across Bangladesh and beyond.",
        ],
        'services' => [
            'page_name' => 'Services Page',
            'meta_title' => 'Our Services | TRACE Consulting',
            'meta_description' => "Explore TRACE Consulting's advisory services spanning regulatory reform, technical capacity building and digital infrastructure.",
        ],
        'insights' => [
            'page_name' => 'Insights Page',
            'meta_title' => 'Insights & Publications | TRACE Consulting',
            'meta_description' => 'Read the latest publications, articles and insights from TRACE Consulting on regulatory reform, trade facilitation and development.',
        ],
        'latestUpdates' => [
            'page_name' => 'Latest Updates',
            'meta_title' => 'Latest Updates | TRACE Consulting',
            'meta_description' => 'Stay up to date with the latest news, projects, insights and career opportunities from TRACE Consulting across Bangladesh and beyond.',
        ],
        'innovations' => [
            'page_name' => 'Our Innovations',
            'meta_title' => 'Our Innovations | TRACE Consulting',
            'meta_description' => "Discover TRACE Consulting's digital innovations and technology-driven solutions built to modernize regulatory and development systems.",
        ],
        'career' => [
            'page_name' => 'Careers Page',
            'meta_title' => 'Careers & Job Openings | TRACE Consulting',
            'meta_description' => 'Explore current job openings and career opportunities at TRACE Consulting, and join our team of regulatory and development experts.',
        ],
        'contact' => [
            'page_name' => 'Contact Us',
            'meta_title' => 'Contact Us | TRACE Consulting Bangladesh',
            'meta_description' => 'Get in touch with TRACE Consulting for regulatory reform, technical capacity building and digital infrastructure advisory.',
        ],
    ];

    /**
     * Robots directive choices offered in the admin dropdown.
     */
    public const ROBOTS_OPTIONS = [
        'index,follow'     => 'Index, Follow (default — visible in search, links followed)',
        'index,nofollow'   => 'Index, No Follow',
        'noindex,follow'   => 'No Index, Follow',
        'noindex,nofollow' => 'No Index, No Follow (hidden from search entirely)',
    ];

    /**
     * OG types relevant to this site. 'article' only makes sense on the Insights/Latest Updates
     * page since that's the only static page with feed-like article content.
     */
    public const OG_TYPE_OPTIONS = ['website', 'article'];

    public const TWITTER_CARD_OPTIONS = ['summary', 'summary_large_image'];

    /**
     * Every EAV key the system currently knows about, with a default value applied when a
     * page has no row for that key yet. This is the ONE place to touch when adding a plain
     * text/select SEO field — no migration needed. (Image fields stay as Spatie media
     * collections, not EAV rows — see ogImageUrl()/twitterImageUrl().)
     */
    public const KNOWN_KEYS = [
        'meta_title'          => null,
        'meta_description'    => null,
        'canonical_url'       => null,
        'robots'              => 'index,follow',
        'author'              => null,
        'og_type'             => 'website',
        'og_title'            => null,
        'og_description'      => null,
        'og_locale'           => 'en_US',
        'og_image_alt'        => null,
        'twitter_card'        => 'summary_large_image',
        'twitter_title'       => null,
        'twitter_description' => null,
        'twitter_site'        => null,
        'twitter_creator'     => null,
    ];

    /**
     * Real columns are always fillable; EAV keys are appended in the constructor from
     * KNOWN_KEYS (see __construct()) so the two lists can never drift apart. Eloquent's
     * isFillable() check runs BEFORE setAttribute() is ever called during mass assignment
     * (fill()/create()/updateOrCreate()) — a key missing from $fillable is silently dropped
     * and never reaches setAttribute(), so every EAV key must be listed here too.
     */
    protected $fillable = [
        'page_slug',
        'page_name',
    ];

    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, array_keys(self::KNOWN_KEYS));

        parent::__construct($attributes);
    }

    /**
     * Buffers writes to unknown-to-Eloquent attributes (i.e. EAV keys) until save(),
     * so `$pageSetting->fill([...]); $pageSetting->save();` still works in one call
     * exactly like it did when these were real columns.
     *
     * @var array<string, string|null>
     */
    protected array $pendingMeta = [];

    /**
     * Loaded page_meta rows for this instance, keyed by meta key. Populated on first
     * access and reused for the rest of the request — avoids one query per attribute read.
     *
     * @var array<string, string|null>|null
     */
    protected ?array $metaCache = null;

    public function pageMetas()
    {
        return $this->hasMany(PageMeta::class);
    }

    public function customMetas()
    {
        return $this->hasMany(CustomMeta::class, 'page_route_name', 'page_slug');
    }

    public function getAttribute($key)
    {
        if (array_key_exists($key, self::KNOWN_KEYS)) {
            return $this->getMeta($key);
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if (array_key_exists($key, self::KNOWN_KEYS)) {
            $this->pendingMeta[$key] = $value;

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Reads one EAV attribute, loading + caching all of this page's meta rows on first access.
     */
    public function getMeta(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, $this->pendingMeta)) {
            return $this->pendingMeta[$key];
        }

        $this->loadMetaCache();

        if (array_key_exists($key, $this->metaCache) && $this->metaCache[$key] !== null) {
            return $this->metaCache[$key];
        }

        return $default ?? (self::KNOWN_KEYS[$key] ?? null);
    }

    /**
     * Writes one EAV attribute immediately (upsert), independent of the batched
     * fill()+save() flow — useful for one-off updates outside a form submission.
     */
    public function setMeta(string $key, ?string $value): void
    {
        $this->pageMetas()->updateOrCreate(['key' => $key], ['value' => $value]);

        if ($this->metaCache !== null) {
            $this->metaCache[$key] = $value;
        }
    }

    private function loadMetaCache(): void
    {
        if ($this->metaCache !== null) {
            return;
        }

        $this->metaCache = $this->relationLoaded('pageMetas')
            ? $this->pageMetas->pluck('value', 'key')->all()
            : $this->pageMetas()->pluck('value', 'key')->all();
    }

    public function save(array $options = [])
    {
        $saved = parent::save($options);

        if ($saved && $this->pendingMeta !== []) {
            foreach ($this->pendingMeta as $key => $value) {
                // Store null/empty as an explicit empty row rather than deleting it, so
                // isCustomized() and "has this ever been set" checks stay simple and cheap.
                $this->pageMetas()->updateOrCreate(['key' => $key], ['value' => $value === '' ? null : $value]);

                if ($this->metaCache !== null) {
                    $this->metaCache[$key] = $value === '' ? null : $value;
                }
            }

            $this->pendingMeta = [];
        }

        return $saved;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('og_image', 'twitter_image')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('og_image', 'twitter_image');
    }

    public function ogImageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('og_image', 'avif')
            ?: ($this->getFirstMediaUrl('og_image', 'webp') ?: $this->getFirstMediaUrl('og_image'));

        return $url !== '' ? $url : null;
    }

    public function twitterImageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('twitter_image', 'avif')
            ?: ($this->getFirstMediaUrl('twitter_image', 'webp') ?: $this->getFirstMediaUrl('twitter_image'));

        return $url !== '' ? $url : null;
    }

    public function isCustomized(): bool
    {
        return filled($this->getMeta('meta_title')) || filled($this->getMeta('meta_description')) || $this->getFirstMedia('og_image') !== null;
    }

    public function defaultMetaTitle(): ?string
    {
        return self::PAGE_DEFAULTS[$this->page_slug]['meta_title'] ?? null;
    }

    public function defaultMetaDescription(): ?string
    {
        return self::PAGE_DEFAULTS[$this->page_slug]['meta_description'] ?? null;
    }
}
