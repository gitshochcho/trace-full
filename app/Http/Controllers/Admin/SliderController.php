<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function edit()
    {
        $items = SliderItem::with('media')->orderBy('sort_order')->orderBy('id')->get();
        return view('admin.slider', compact('items'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'items'                  => ['nullable', 'array'],
            'items.*.id'             => ['nullable', 'integer'],
            'items.*.title'          => ['nullable', 'string', 'max:255'],
            'items.*.tagline'        => ['nullable', 'string', 'max:255'],
            'items.*.description'    => ['nullable', 'string'],
            'items.*.design_word'    => ['nullable', 'string', 'max:255'],
            'item_images'            => ['nullable', 'array'],
            'item_images.*'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'item_videos'            => ['nullable', 'array'],
            'item_videos.*'          => ['nullable', 'mimes:mp4,webm,mov', 'max:102400'],
            'remove_image'           => ['nullable', 'array'],
            'remove_image.*'         => ['nullable', 'integer'],
            'remove_video'           => ['nullable', 'array'],
            'remove_video.*'         => ['nullable', 'integer'],
            'removed_item_ids'       => ['nullable', 'array'],
            'removed_item_ids.*'     => ['integer'],
        ]);

        $rows    = $request->input('items', []);
        $keptIds = [];

        foreach (array_values($rows) as $index => $row) {
            $id   = !empty($row['id']) ? (int) $row['id'] : null;
            $item = ($id ? SliderItem::find($id) : null) ?? new SliderItem();

            $item->fill([
                'title'       => $row['title']       ?? null,
                'tagline'     => $row['tagline']      ?? null,
                'description' => $row['description']  ?? null,
                'design_word' => $row['design_word']  ?? null,
                'sort_order'  => $index,
                'active'      => true,
            ]);
            $item->save();

            $removeImageIds = $request->input('remove_image', []);
            if (in_array($item->id, array_map('intval', $removeImageIds))) {
                $item->clearMediaCollection('image');
            }

            if ($request->hasFile("item_images.$index")) {
                $item->clearMediaCollection('image');
                $item->addMedia($request->file("item_images.$index"))->toMediaCollection('image');
            }

            if ($request->hasFile("item_videos.$index")) {
                $item->clearMediaCollection('video');
                $item->addMedia($request->file("item_videos.$index"))->toMediaCollection('video');
            }

            $removeVideoIds = $request->input('remove_video', []);
            if (in_array($item->id, array_map('intval', $removeVideoIds))) {
                $item->clearMediaCollection('video');
            }

            $keptIds[] = $item->id;
        }

        $removedIds = collect($request->input('removed_item_ids', []))
            ->filter(fn($id) => is_numeric($id))
            ->map(fn($id) => (int) $id)
            ->values();

        if ($removedIds->isNotEmpty()) {
            SliderItem::whereIn('id', $removedIds->all())->get()->each(function (SliderItem $item) {
                $item->clearMediaCollection('image');
                $item->delete();
            });
        }

        return redirect()->route('admin.slider.edit')->with([
            'message'    => 'Slider updated successfully',
            'alert-type' => 'success',
        ]);
    }
}