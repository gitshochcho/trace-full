<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CvSubmission;

class CvSubmissionController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $search      = $request->input('search', '');
        $perPageInput = $request->input('per_page', '10');
        $perPage     = $perPageInput === 'all' ? 99999 : max(1, (int) $perPageInput);

        $submissions = CvSubmission::with('media')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.cv-submissions.index', compact('submissions', 'search', 'perPageInput'));
    }

    public function show(CvSubmission $cvSubmission)
    {
        if (!$cvSubmission->is_read) {
            $cvSubmission->update(['is_read' => true]);
        }
        return view('admin.cv-submissions.show', ['submission' => $cvSubmission]);
    }

    public function destroy(CvSubmission $cvSubmission)
    {
        $cvSubmission->clearMediaCollection('cv_pdf');
        $cvSubmission->delete();
        return redirect()->route('admin.cv-submissions.index')
            ->with(['message' => 'CV submission deleted', 'alert-type' => 'success']);
    }
}