<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function edit()
    {
        $setting = Setting::with('media')->first();

        return view('admin.settings', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'logo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'logo_text' => ['nullable', 'string', 'max:255'],
            'logo_tagline' => ['nullable', 'string', 'max:255'],
            'social_links' => ['nullable', 'array'],
            'social_links.*.title' => ['nullable', 'string', 'max:255'],
            'social_links.*.link' => ['nullable', 'string', 'max:2048'],
            'social_links.*.media_key' => ['nullable', 'string', 'max:64'],
            'social_links_icons' => ['nullable', 'array'],
            'social_links_icons.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'footer_contact_mobile' => ['nullable', 'string', 'max:255'],
            'footer_contact_email' => ['nullable', 'email', 'max:255'],
            'footer_contact_location' => ['nullable', 'string'],
            'footer_description' => ['nullable', 'string'],
        ]);

        $setting = Setting::with('media')->first() ?? new Setting();

        $incomingLinks = collect($request->input('social_links', []))->values();
        $uploadedIcons = $request->file('social_links_icons', []);

        $preparedSocialLinks = [];
        $keptMediaKeys = [];

        foreach ($incomingLinks as $index => $item) {
            $title = trim((string) ($item['title'] ?? ''));
            $link = trim((string) ($item['link'] ?? ''));
            $mediaKey = (string) ($item['media_key'] ?? '');

            if ($mediaKey === '') {
                $mediaKey = Str::uuid()->toString();
            }

            $collectionName = 'social_icon_' . $mediaKey;
            $hasUploadedIcon = isset($uploadedIcons[$index]);
            $hasExistingIcon = $setting->getFirstMedia($collectionName) !== null;

            if ($title === '' && $link === '' && ! $hasUploadedIcon && ! $hasExistingIcon) {
                continue;
            }

            $preparedSocialLinks[] = [
                'title' => $title,
                'link' => $link,
                'media_key' => $mediaKey,
            ];

            $keptMediaKeys[] = $mediaKey;

            if ($hasUploadedIcon) {
                $setting->clearMediaCollection($collectionName);
                $setting->addMedia($uploadedIcons[$index])->toMediaCollection($collectionName);
            }
        }

        DB::transaction(function () use ($setting, $validated, $preparedSocialLinks) {
            $setting->fill([
                'logo_text' => $validated['logo_text'] ?? null,
                'logo_tagline' => $validated['logo_tagline'] ?? null,
                'social_links' => $preparedSocialLinks,
                'footer_contact_mobile' => $validated['footer_contact_mobile'] ?? null,
                'footer_contact_email' => $validated['footer_contact_email'] ?? null,
                'footer_contact_location' => $validated['footer_contact_location'] ?? null,
                'footer_description' => $validated['footer_description'] ?? null,
            ]);
            $setting->save();
        });

        if ($request->hasFile('logo_image')) {
            $setting->clearMediaCollection('logo_image');
            $setting->addMedia($request->file('logo_image'))->toMediaCollection('logo_image');
        }

        $setting->refresh();
        $setting->load('media');

        $setting->media
            ->filter(function ($media) {
                return str_starts_with($media->collection_name, 'social_icon_');
            })
            ->each(function ($media) use ($keptMediaKeys) {
                $mediaKey = str_replace('social_icon_', '', $media->collection_name);

                if (! in_array($mediaKey, $keptMediaKeys, true)) {
                    $media->delete();
                }
            });

        Cache::forget('site_settings');

        return redirect()
            ->route('admin.settings.edit')
            ->with([
                'message' => 'Settings updated successfully',
                'alert-type' => 'success',
            ]);
    }
}