<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::with('media')->latest()->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $partner = Partner::create($validated);

        if ($request->hasFile('image')) {
            $partner->addMedia($request->file('image'))->toMediaCollection('partner_image');
        }

        return redirect()->route('admin.partners.index')->with([
            'message' => 'Partner added successfully',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }
    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $partner->update($validated); 
        $partner->save();

        if ($request->hasFile('image')) {
            $partner->clearMediaCollection('partner_image');
            $partner->addMedia($request->file('image'))->toMediaCollection('partner_image');
        }
        return redirect()->route('admin.partners.edit', $partner)->with([
            'message' => 'Partner updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->clearMediaCollection('partner_image');
        $partner->delete();
        return redirect()->route('admin.partners.index')->with([
            'message' => 'Partner deleted successfully',
            'alert-type' => 'success'
        ]);
    }

}
