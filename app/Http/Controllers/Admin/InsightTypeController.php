<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsightType;

class InsightTypeController extends Controller
{
    public function index()
    {
        $insights = InsightType::all();
        return view('admin.insight-type.index', compact('insights'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $validated['status'] = $request->has('status') ? 1 : 0;

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
            'type' => 'required|string|max:255',
        ]);

        $validated['status'] = $request->has('status') ? 1 : 0;

        $insightType->update($validated);

        return redirect()->route('admin.insight-types.index')->with('message', 'Insight type updated successfully');
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
