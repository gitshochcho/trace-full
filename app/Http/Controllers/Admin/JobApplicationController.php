<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipStream\ZipStream;

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

        // Not active()-scoped on purpose: admins need to filter/export applications tied
        // to closed or inactive postings too, not just the ones currently live on the site.
        $jobPostings = JobPosting::ordered()->get(['id', 'title']);

        return view('admin.job-applications.index', compact('applications', 'jobPostings'));
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

        if ($request->filled('job_posting_id')) {
            $query->where('job_posting_id', $request->job_posting_id);
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
     * Streams a ZIP of every CV matching the current search/status/job_posting_id filter —
     * the same filteredQuery() used by the index listing, so the ZIP always matches what's
     * on screen. Built with ZipStream (already installed as a spatie/laravel-medialibrary
     * dependency) so it streams straight to the response with no temp files and no
     * dependency on the PHP zip extension being enabled on the host.
     */
    public function downloadAllCv(Request $request)
    {
        $applications = $this->filteredQuery($request)
            ->whereNotNull('cv_path')
            ->latest()
            ->get(['id', 'name', 'cv_path', 'cv_original_name']);

        $applications = $applications->filter(
            fn ($application) => Storage::disk('public')->exists($application->cv_path)
        );

        if ($applications->isEmpty()) {
            return back()->with('error', 'No applications with a CV match the current filter.');
        }

        $zip = new ZipStream(outputName: 'job-application-cvs-' . now()->format('Y-m-d-His') . '.zip');

        $usedNames = [];

        foreach ($applications as $application) {
            $originalName = $application->cv_original_name ?: basename($application->cv_path);
            $entryName = $this->uniqueZipEntryName($application->name, $originalName, $usedNames);

            $zip->addFileFromPath(
                fileName: $entryName,
                path: Storage::disk('public')->path($application->cv_path),
            );
        }

        $zip->finish();

        exit;
    }

    /**
     * Builds a "<Applicant Name> - <original filename>" entry name and disambiguates it if
     * two applicants (or two applications) would otherwise collide — e.g. two people both
     * named "CV.pdf" become "Jane Doe - CV.pdf" and "Jane Doe - CV (2).pdf".
     */
    private function uniqueZipEntryName(string $applicantName, string $originalName, array &$usedNames): string
    {
        $safeApplicant = trim(preg_replace('/[\\\\\/:*?"<>|]/', '-', $applicantName));
        $base = $safeApplicant !== '' ? "{$safeApplicant} - {$originalName}" : $originalName;

        $entryName = $base;
        $suffix = 2;

        while (in_array($entryName, $usedNames, true)) {
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $filenameWithoutExt = $extension !== ''
                ? substr($base, 0, -(strlen($extension) + 1))
                : $base;
            $entryName = $extension !== ''
                ? "{$filenameWithoutExt} ({$suffix}).{$extension}"
                : "{$base} ({$suffix})";
            $suffix++;
        }

        $usedNames[] = $entryName;

        return $entryName;
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