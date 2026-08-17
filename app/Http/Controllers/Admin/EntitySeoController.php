<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomMeta;
use App\Models\EntitySeo;
use App\Models\InsightArticle;
use App\Models\JobPosting;
use App\Models\Project;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class EntitySeoController extends Controller
{
    /**
     * Lists every record across the 5 detail-page entity types, so the admin can jump
     * straight to any Service/Project/Article/Job/Team member's SEO override from one place
     * instead of hunting through 5 separate managers.
     */
    public function index()
    {
        $rows = collect();

        $rows = $rows->concat(Service::query()->get(['id', 'service_name'])->map(fn ($m) => [
            'entity_type' => 'service', 'entity_id' => $m->id, 'label' => $m->service_name,
        ]));
        $rows = $rows->concat(Project::query()->get(['id', 'project_title'])->map(fn ($m) => [
            'entity_type' => 'project', 'entity_id' => $m->id, 'label' => $m->project_title,
        ]));
        $rows = $rows->concat(InsightArticle::query()->get(['id', 'title'])->map(fn ($m) => [
            'entity_type' => 'article', 'entity_id' => $m->id, 'label' => $m->title ?: "Article #{$m->id}",
        ]));
        $rows = $rows->concat(JobPosting::query()->get(['id', 'title'])->map(fn ($m) => [
            'entity_type' => 'job', 'entity_id' => $m->id, 'label' => $m->title,
        ]));
        $rows = $rows->concat(Team::query()->get(['id', 'first_name', 'last_name'])->map(fn ($m) => [
            'entity_type' => 'team', 'entity_id' => $m->id, 'label' => $m->fullName(),
        ]));

        $customizedKeys = EntitySeo::query()
            ->get(['entity_type', 'entity_id'])
            ->map(fn ($row) => $row->entity_type . ':' . $row->entity_id)
            ->flip();

        $rows = $rows->map(function ($row) use ($customizedKeys) {
            $row['is_customized'] = $customizedKeys->has($row['entity_type'] . ':' . $row['entity_id']);
            return $row;
        })->sortBy('label')->values();

        return view('admin.entity-seo.index', [
            'rows' => $rows,
            'types' => EntitySeo::TYPES,
        ]);
    }

    public function edit(string $entityType, int $entityId)
    {
        abort_unless(array_key_exists($entityType, EntitySeo::TYPES), 404);

        $modelClass = EntitySeo::TYPES[$entityType]['model'];
        $entity = $modelClass::findOrFail($entityId);

        $entitySeo = EntitySeo::query()
            ->with('media')
            ->where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->first() ?? new EntitySeo(['entity_type' => $entityType, 'entity_id' => $entityId]);

        $customMetas = $entitySeo->exists
            ? $entitySeo->customMetas()->orderBy('id')->get()
            : collect();

        return view('admin.entity-seo.edit', [
            'entitySeo' => $entitySeo,
            'entity' => $entity,
            'entityType' => $entityType,
            'entityLabel' => EntitySeo::TYPES[$entityType]['label'],
            'showArticleFields' => EntitySeo::TYPES[$entityType]['article_fields'],
            'customMetas' => $customMetas,
        ]);
    }

    public function update(Request $request, string $entityType, int $entityId): RedirectResponse
    {
        abort_unless(array_key_exists($entityType, EntitySeo::TYPES), 404);

        $modelClass = EntitySeo::TYPES[$entityType]['model'];
        $modelClass::findOrFail($entityId);

        $validated = $request->validate([
            'meta_title'          => ['nullable', 'string', 'max:255'],
            'meta_description'    => ['nullable', 'string', 'max:500'],
            'canonical_url'       => ['nullable', 'url', 'max:255'],
            'robots'              => ['nullable', Rule::in(array_keys(\App\Models\PageSetting::ROBOTS_OPTIONS))],
            'og_title'            => ['nullable', 'string', 'max:255'],
            'og_description'      => ['nullable', 'string', 'max:500'],
            'og_type'             => ['nullable', Rule::in(\App\Models\PageSetting::OG_TYPE_OPTIONS)],
            'og_image_alt'        => ['nullable', 'string', 'max:255'],
            'og_image'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_og_image'     => ['nullable', 'boolean'],
            'twitter_title'       => ['nullable', 'string', 'max:255'],
            'twitter_description' => ['nullable', 'string', 'max:500'],
            'article_section'     => ['nullable', 'string', 'max:255'],
        ]);

        $entitySeo = EntitySeo::query()
            ->where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->first() ?? new EntitySeo(['entity_type' => $entityType, 'entity_id' => $entityId]);

        $entitySeo->fill([
            'meta_title'          => $validated['meta_title'] ?? null,
            'meta_description'    => $validated['meta_description'] ?? null,
            'canonical_url'       => $validated['canonical_url'] ?? null,
            'robots'              => $validated['robots'] ?? null,
            'og_title'            => $validated['og_title'] ?? null,
            'og_description'      => $validated['og_description'] ?? null,
            'og_type'             => $validated['og_type'] ?? null,
            'og_image_alt'        => $validated['og_image_alt'] ?? null,
            'twitter_title'       => $validated['twitter_title'] ?? null,
            'twitter_description' => $validated['twitter_description'] ?? null,
            'article_section'     => $validated['article_section'] ?? null,
        ]);
        $entitySeo->save();

        if ($request->hasFile('og_image')) {
            $entitySeo->clearMediaCollection('og_image');
            $entitySeo->addMedia($request->file('og_image'))->toMediaCollection('og_image');
        } elseif ($request->boolean('remove_og_image')) {
            $entitySeo->clearMediaCollection('og_image');
        }

        Cache::forget("entity_seo_{$entityType}_{$entityId}");
        Cache::forget("custom_metas_entity_{$entityType}_{$entityId}");

        return redirect()
            ->route('admin.entitySeo.edit', [$entityType, $entityId])
            ->with([
                'message' => 'SEO settings updated successfully',
                'alert-type' => 'success',
            ]);
    }

    public function storeCustomMeta(Request $request, string $entityType, int $entityId): RedirectResponse
    {
        abort_unless(array_key_exists($entityType, EntitySeo::TYPES), 404);

        $validated = $request->validate([
            'type'  => ['required', Rule::in(CustomMeta::TYPES)],
            'key'   => [
                'required', 'string', 'max:100', 'regex:' . CustomMeta::KEY_PATTERN,
                Rule::notIn(CustomMeta::RESERVED_KEYS),
                Rule::unique('custom_metas')->where('entity_type', $entityType)->where('entity_id', $entityId),
            ],
            'value' => ['required', 'string', 'max:1000'],
        ], [
            'key.not_in' => 'This key is already managed by the SEO/Open Graph/Twitter tabs above — use those fields instead.',
            'key.unique' => 'A custom meta tag with this key already exists for this record.',
        ]);

        CustomMeta::create([
            'entity_type' => $entityType,
            'entity_id'   => $entityId,
            'type'  => $validated['type'],
            'key'   => $validated['key'],
            'value' => strip_tags($validated['value']),
        ]);

        Cache::forget("custom_metas_entity_{$entityType}_{$entityId}");

        return redirect()
            ->route('admin.entitySeo.edit', [$entityType, $entityId])
            ->with([
                'message' => 'Custom meta tag added',
                'alert-type' => 'success',
            ]);
    }

    public function destroyCustomMeta(string $entityType, int $entityId, CustomMeta $customMeta): RedirectResponse
    {
        abort_unless($customMeta->entity_type === $entityType && $customMeta->entity_id === $entityId, 404);

        $customMeta->delete();

        Cache::forget("custom_metas_entity_{$entityType}_{$entityId}");

        return redirect()
            ->route('admin.entitySeo.edit', [$entityType, $entityId])
            ->with([
                'message' => 'Custom meta tag removed',
                'alert-type' => 'success',
            ]);
    }
}
