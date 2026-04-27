<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SliderController extends Controller
{
    public function edit()
    {
        $slider = Slider::with('media')->first();

        return view('admin.slider', compact('slider'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tagline' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'design_word' => ['nullable', 'string', 'max:255'],
            'slider_images' => ['nullable'],
            'slider_images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'removed_image_ids' => ['nullable', 'array'],
            'removed_image_ids.*' => ['integer'],
        ]);

        $slider = Slider::with('media')->first() ?? new Slider();
        $slider->fill([
            'tagline' => $validated['tagline'] ?? null,
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'design_word' => $validated['design_word'] ?? null,
        ]);
        $slider->save();

        if ($request->hasFile('slider_images')) {
            $images = Arr::wrap($request->file('slider_images'));

            foreach ($images as $image) {
                if ($image) {
                    $slider->addMedia($image)->toMediaCollection('slider_images');
                }
            }
        }

        $removedImageIds = collect($request->input('removed_image_ids', []))
            ->filter(fn ($id) => is_numeric($id))
            ->map(fn ($id) => (int) $id)
            ->values();

        if ($removedImageIds->isNotEmpty()) {
            $slider->media()
                ->where('collection_name', 'slider_images')
                ->whereIn('id', $removedImageIds->all())
                ->get()
                ->each(function ($media) {
                    $media->delete();
                });
        }

        return redirect()
            ->route('admin.slider.edit')
            ->with([
                'message' => 'Slider updated successfully',
                'alert-type' => 'success',
            ]);
    }
}