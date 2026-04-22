<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsightTypeController extends Controller
{
    public function index()
    {
        $types = InsightType::all();
        return view('admin.insight-type.index', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        InsightType::create($validated);

        return redirect()->route('admin.insight-types.index')->with('message', 'Insight type created successfully');
    }

    public function update(Request $request, InsightType $insightType)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

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
