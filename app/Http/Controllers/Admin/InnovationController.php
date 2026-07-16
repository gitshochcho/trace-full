<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Innovation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InnovationController extends Controller
{
    public function index()
    {
        $innovations = Innovation::with('media')->orderBy('sort_order')->latest('id')->get();
        return view('admin.innovations.index', compact('innovations'));
    }

    public function create()
    {
        return view('admin.innovations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'category'      => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'website_link'  => 'nullable|url',
            'sort_order'    => 'nullable|integer',
            'active'        => 'nullable|boolean',
            'show_on_home'  => 'nullable|boolean',
            'image'         => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $validated['active']       = $request->boolean('active');
        $validated['show_on_home'] = $request->boolean('show_on_home');

        $innovation = Innovation::create($validated);

        if ($request->hasFile('image')) {
            $innovation->addMedia($request->file('image'))->toMediaCollection('innovation_image');
        }

        return redirect()->route('admin.innovations.index')->with([
            'message'    => 'Innovation added successfully',
            'alert-type' => 'success',
        ]);
    }

    public function edit(Innovation $innovation)
    {
        return view('admin.innovations.edit', compact('innovation'));
    }

    public function update(Request $request, Innovation $innovation): RedirectResponse
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'category'      => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'website_link'  => 'nullable|url',
            'sort_order'    => 'nullable|integer',
            'active'        => 'nullable|boolean',
            'show_on_home'  => 'nullable|boolean',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $validated['active']       = $request->boolean('active');
        $validated['show_on_home'] = $request->boolean('show_on_home');

        $innovation->update($validated);

        if ($request->hasFile('image')) {
            $innovation->clearMediaCollection('innovation_image');
            $innovation->addMedia($request->file('image'))->toMediaCollection('innovation_image');
        }

        return redirect()->route('admin.innovations.edit', $innovation)->with([
            'message'    => 'Innovation updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(Innovation $innovation): RedirectResponse
    {
        $innovation->clearMediaCollection('innovation_image');
        $innovation->delete();

        return redirect()->route('admin.innovations.index')->with([
            'message'    => 'Innovation deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}
