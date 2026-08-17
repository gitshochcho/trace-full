<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->filteredQuery($request);

        $applications = $query->latest()->paginate(15)->withQueryString();

        // Live search: the filter form fires this same route via fetch() with this header
        // set, and only wants the table partial re-rendered — not a full page reload.
        if ($request->ajax()) {
            return response()->json([
                'table_html' => view('admin.job-applications._table', compact('applications'))->render(),
                'total' => $applications->total(),
            ]);
        }

        return view('admin.job-applications.index', compact('applications'));
    }

    /**
     * Shared search/status filtering used by both the paginated index listing
     * and the "Download All" ZIP export, so the ZIP always matches what's on screen.
     */
    private function filteredQuery(Request $request)
    {
        $query = JobApplication::with('jobPosting');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('jobPosting', function ($q) use ($search) {
                      $q->where('title', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'reviewed') {
                $query->where('is_reviewed', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_reviewed', false);
            }
        }

        return $query;
    }

    public function show(JobApplication $application)
    {
        $application->load('jobPosting');
        return view('admin.job-applications.show', compact('application'));
    }

    public function downloadCv(JobApplication $application)
    {
        if (!Storage::disk('public')->exists($application->cv_path)) {
            return back()->with('error', 'CV file not found.');
        }

        // Older applications submitted before original filenames were tracked fall back
        // to the stored path's basename (the previous, unnamed behavior).
        $downloadName = $application->cv_original_name ?: basename($application->cv_path);

        return Storage::disk('public')->download($application->cv_path, $downloadName);
    }

    /**
     * Returns the id list for every application matching the current search/status filter
     * that has a CV on file. The "Download All" button on the index page uses this to fire
     * one browser download per file (via the existing downloadCv route) instead of building
     * a ZIP server-side — avoids any dependency on the PHP zip extension being installed.
     */
    public function downloadAllCv(Request $request)
    {
        $applications = $this->filteredQuery($request)
            ->whereNotNull('cv_path')
            ->latest()
            ->get(['id', 'name']);

        return response()->json([
            'applications' => $applications->map(fn ($application) => [
                'id' => $application->id,
                'name' => $application->name,
                'download_url' => route('admin.job-applications.download-cv', $application),
            ]),
        ]);
    }

    public function markReviewed(JobApplication $application)
    {
        $application->update(['is_reviewed' => !$application->is_reviewed]);

        $message = $application->is_reviewed ? 'Application marked as reviewed.' : 'Application marked as pending.';

        return back()->with('success', $message);
    }

    public function destroy(JobApplication $application)
    {
        if ($application->cv_path && Storage::disk('public')->exists($application->cv_path)) {
            Storage::disk('public')->delete($application->cv_path);
        }

        $application->delete();

        return back()->with('success', 'Application deleted successfully.');
    }
}