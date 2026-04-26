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
        $query = JobApplication::with('jobPosting');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('jobPosting', function($q) use ($search) {
                      $q->where('title', 'like', "%{$search}%");
                  });
            });
        }

        // Status filter
        if ($request->has('status') && !empty($request->status)) {
            if ($request->status === 'reviewed') {
                $query->where('is_reviewed', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_reviewed', false);
            }
        }

        $applications = $query->latest()->paginate(15);

        return view('admin.job-applications.index', compact('applications'));
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

        return Storage::disk('public')->download($application->cv_path);
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