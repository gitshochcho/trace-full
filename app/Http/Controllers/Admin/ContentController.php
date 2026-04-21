<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::with('media')->latest()->get();

        return view('admin.content.index', compact('contents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'unique:contents,slug'],
            'section' => ['nullable', 'string', 'max:255'],
            'heading' => ['nullable', 'string', 'max:255'],
            'sub_heading' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'design_word' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
        ]);

        $content = Content::create($validated);

        if ($request->hasFile('icon')) {
            $content->addMedia($request->file('icon'))->toMediaCollection('icon');
        }

        if ($request->hasFile('image')) {
            $content->addMedia($request->file('image'))->toMediaCollection('image');
        }

        Cache::forget("content_block_{$content->slug}");
        Cache::forget('content_block_' . Str::slug($content->slug));

        return redirect()
            ->route('admin.content.index')
            ->with([
                'message' => 'Content created successfully',
                'alert-type' => 'success',
            ]);
    }

    public function edit(Content $content)
    {
        $contents = Content::with('media')->latest()->get();

        return view('admin.content.edit', compact('content', 'contents'));
    }

    public function update(Request $request, Content $content): RedirectResponse
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'unique:contents,slug,' . $content->id],
            'section' => ['nullable', 'string', 'max:255'],
            'heading' => ['nullable', 'string', 'max:255'],
            'sub_heading' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'design_word' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
        ]);

        $oldSlug = $content->slug;
        $content->fill($validated);
        $content->save();

        if ($request->hasFile('icon')) {
            $content->clearMediaCollection('icon');
            $content->addMedia($request->file('icon'))->toMediaCollection('icon');
        }

        if ($request->hasFile('image')) {
            $content->clearMediaCollection('image');
            $content->addMedia($request->file('image'))->toMediaCollection('image');
        }

        Cache::forget("content_block_{$oldSlug}");
        Cache::forget("content_block_{$content->slug}");
        Cache::forget('content_block_' . Str::slug($oldSlug));
        Cache::forget('content_block_' . Str::slug($content->slug));

        return redirect()
            ->route('admin.content.edit', $content)
            ->with([
                'message' => 'Content updated successfully',
                'alert-type' => 'success',
            ]);
    }

    public function destroy(Content $content): RedirectResponse
    {
        Cache::forget("content_block_{$content->slug}");
        Cache::forget('content_block_' . Str::slug($content->slug));
        $content->clearMediaCollection('icon');
        $content->clearMediaCollection('image');
        $content->delete();

        return redirect()
            ->route('admin.content.index')
            ->with([
                'message' => 'Content deleted successfully',
                'alert-type' => 'success',
            ]);
    }
}