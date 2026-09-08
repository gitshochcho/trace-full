<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomMeta;
use App\Models\PageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class PageSettingController extends Controller
{
    public function index()
    {
        $pageSettings = PageSetting::with(['media', 'pageMetas'])->orderBy('page_name')->get();

        return view('admin.page-settings.index', compact('pageSettings'));
    }

    public function edit(PageSetting $pageSetting)
    {
        $pageSetting->load(['media', 'pageMetas']);
        $defaults = PageSetting::PAGE_DEFAULTS[$pageSetting->page_slug] ?? [];
        $customMetas = $pageSetting->customMetas()->orderBy('id')->get();

        return view('admin.page-settings.edit', compact('pageSetting', 'defaults', 'customMetas'));
    }

    public function update(Request $request, PageSetting $pageSetting): RedirectResponse
    {
        $validated = $request->validate([
            'meta_title'          => ['nullable', 'string', 'max:255'],
            'meta_description'    => ['nullable', 'string', 'max:500'],
            'canonical_url'       => ['nullable', 'url', 'max:255'],
            'robots'              => ['nullable', Rule::in(array_keys(PageSetting::ROBOTS_OPTIONS))],
            'author'              => ['nullable', 'string', 'max:255'],
            'og_type'             => ['nullable', Rule::in(PageSetting::OG_TYPE_OPTIONS)],
            'og_title'            => ['nullable', 'string', 'max:255'],
            'og_description'      => ['nullable', 'string', 'max:500'],
            'og_locale'           => ['nullable', 'string', 'max:20'],
            'og_image_alt'        => ['nullable', 'string', 'max:255'],
            'og_image'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_og_image'     => ['nullable', 'boolean'],
            'twitter_card'        => ['nullable', Rule::in(PageSetting::TWITTER_CARD_OPTIONS)],
            'twitter_title'       => ['nullable', 'string', 'max:255'],
            'twitter_description' => ['nullable', 'string', 'max:500'],
            'twitter_site'        => ['nullable', 'string', 'max:60'],
            'twitter_creator'     => ['nullable', 'string', 'max:60'],
            'twitter_image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_twitter_image' => ['nullable', 'boolean'],
        ]);

        $pageSetting->fill([
            'meta_title'          => $validated['meta_title'] ?? null,
            'meta_description'    => $validated['meta_description'] ?? null,
            'canonical_url'       => $validated['canonical_url'] ?? null,
            'robots'              => $validated['robots'] ?? 'index,follow',
            'author'              => $validated['author'] ?? null,
            'og_type'             => $validated['og_type'] ?? 'website',
            'og_title'            => $validated['og_title'] ?? null,
            'og_description'      => $validated['og_description'] ?? null,
            'og_locale'           => $validated['og_locale'] ?? 'en_US',
            'og_image_alt'        => $validated['og_image_alt'] ?? null,
            'twitter_card'        => $validated['twitter_card'] ?? 'summary_large_image',
            'twitter_title'       => $validated['twitter_title'] ?? null,
            'twitter_description' => $validated['twitter_description'] ?? null,
            'twitter_site'        => $validated['twitter_site'] ?? null,
            'twitter_creator'     => $validated['twitter_creator'] ?? null,
        ]);
        $pageSetting->save();

        if ($request->hasFile('og_image')) {
            $pageSetting->clearMediaCollection('og_image');
            $pageSetting->addMedia($request->file('og_image'))->toMediaCollection('og_image');
        } elseif ($request->boolean('remove_og_image')) {
            $pageSetting->clearMediaCollection('og_image');
        }

        if ($request->hasFile('twitter_image')) {
            $pageSetting->clearMediaCollection('twitter_image');
            $pageSetting->addMedia($request->file('twitter_image'))->toMediaCollection('twitter_image');
        } elseif ($request->boolean('remove_twitter_image')) {
            $pageSetting->clearMediaCollection('twitter_image');
        }

        Cache::forget("page_setting_{$pageSetting->page_slug}");
        Cache::forget("custom_metas_page_{$pageSetting->page_slug}");

        return redirect()
            ->route('admin.pageSettings.index')
            ->with([
                'message' => 'Page settings updated successfully',
                'alert-type' => 'success',
            ]);
    }

    public function storeCustomMeta(Request $request, PageSetting $pageSetting): RedirectResponse
    {
        $validated = $request->validate([
            'type'  => ['required', Rule::in(CustomMeta::TYPES)],
            'key'   => [
                'required', 'string', 'max:100', 'regex:' . CustomMeta::KEY_PATTERN,
                Rule::notIn(CustomMeta::RESERVED_KEYS),
                Rule::unique('custom_metas')->where('page_route_name', $pageSetting->page_slug),
            ],
            'value' => ['required', 'string', 'max:1000'],
        ], [
            'key.not_in' => 'This key is already managed by the SEO/Open Graph/Twitter tabs above — use those fields instead.',
            'key.unique' => 'A custom meta tag with this key already exists for this page.',
        ]);

        CustomMeta::create([
            'page_route_name' => $pageSetting->page_slug,
            'type'  => $validated['type'],
            'key'   => $validated['key'],
            'value' => strip_tags($validated['value']),
        ]);

        Cache::forget("custom_metas_page_{$pageSetting->page_slug}");

        return redirect()
            ->route('admin.pageSettings.edit', $pageSetting)
            ->with([
                'message' => 'Custom meta tag added',
                'alert-type' => 'success',
            ]);
    }

    public function destroyCustomMeta(PageSetting $pageSetting, CustomMeta $customMeta): RedirectResponse
    {
        abort_unless($customMeta->page_route_name === $pageSetting->page_slug, 404);

        $customMeta->delete();

        Cache::forget("custom_metas_page_{$pageSetting->page_slug}");

        return redirect()
            ->route('admin.pageSettings.edit', $pageSetting)
            ->with([
                'message' => 'Custom meta tag removed',
                'alert-type' => 'success',
            ]);
    }
}
