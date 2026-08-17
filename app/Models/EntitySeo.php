<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Per-record SEO overrides for the site's 5 detail-page entity types.
 * One row per entity, looked up via (entity_type, entity_id) — see the entitySeo()
 * helper in app/Helper/helpers.php for the read path used by HomeController.
 */
class EntitySeo extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'entity_seo';

    /**
     * entity_type values this system understands, mapped to a human label and whether
     * article-specific OG fields (author/published/modified/section) apply.
     */
    public const TYPES = [
        'service' => ['label' => 'Service', 'model' => Service::class, 'article_fields' => false],
        'project' => ['label' => 'Project', 'model' => Project::class, 'article_fields' => false],
        'article' => ['label' => 'Insight Article', 'model' => InsightArticle::class, 'article_fields' => true],
        'job'     => ['label' => 'Job Posting', 'model' => JobPosting::class, 'article_fields' => false],
        'team'    => ['label' => 'Team Member', 'model' => Team::class, 'article_fields' => false],
    ];

    protected $fillable = [
        'entity_type',
        'entity_id',
        'meta_title',
        'meta_description',
        'canonical_url',
        'robots',
        'og_title',
        'og_description',
        'og_type',
        'og_image_alt',
        'twitter_title',
        'twitter_description',
        'article_section',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp')
            ->quality(82)
            ->performOnCollections('og_image')
            ->nonQueued();

        $this->addMediaConversion('avif')
            ->format('avif')
            ->quality(70)
            ->performOnCollections('og_image');
    }

    public function ogImageUrl(): ?string
    {
        $url = $this->getFirstMediaUrl('og_image', 'avif')
            ?: ($this->getFirstMediaUrl('og_image', 'webp') ?: $this->getFirstMediaUrl('og_image'));

        return $url !== '' ? $url : null;
    }

    public function customMetas()
    {
        return CustomMeta::query()
            ->where('entity_type', $this->entity_type)
            ->where('entity_id', $this->entity_id);
    }

    public function isCustomized(): bool
    {
        return filled($this->meta_title) || filled($this->meta_description) || $this->getFirstMedia('og_image') !== null;
    }
}
