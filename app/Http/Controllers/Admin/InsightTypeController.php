<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsightType;

class InsightTypeController extends Controller
{
    public function index()
    {
        $insights = InsightType::orderBy('sort_order')->orderBy('id')->paginate(20);
        return view('admin.insight-type.index', compact('insights'));
    }

    public function create()
    {
        return view('admin.insight-type.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'         => 'required|string|max:255',
            'type_category'=> 'required|string|max:255',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        $validated['status']     = $request->has('status') ? 1 : 0;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        InsightType::create($validated);

        return redirect()->route('admin.insight-types.index')->with('message', 'Insight type created successfully');
    }

    public function edit(InsightType $insightType)
    {
        return view('admin.insight-type.edit', compact('insightType'));
    }

    public function update(Request $request, InsightType $insightType)
    {
        $validated = $request->validate([
            'type'         => 'required|string|max:255',
            'type_category'=> 'required|string|max:255',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        $validated['status']     = $request->has('status') ? 1 : 0;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $insightType->update($validated);

        return redirect()->route('admin.insight-types.index')->with('message', 'Insight type updated successfully');
    }

    public function updateSortOrder(Request $request, InsightType $insightType)
    {
        $request->validate(['sort_order' => 'required|integer|min:0']);
        $insightType->update(['sort_order' => $request->sort_order]);
        return response()->json(['success' => true]);
    }

    public function destroy(InsightType $insightType)
    {
        if ($insightType->insights()->count() > 0) {
            return redirect()->route('admin.insight-types.index')->with('error', 'Cannot delete insight type with associated insights');
        }

        $insightType->delete();

        return redirect()->route('admin.insight-types.index')->with('message', 'Insight type deleted successfully');
    }
}
