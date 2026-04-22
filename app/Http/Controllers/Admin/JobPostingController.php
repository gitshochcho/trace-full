<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobPosting::withCount('applications')->latest()->paginate(15);
        return view('admin.job-postings.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.job-postings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|string|max:255',
            'employment_type' => 'required|in:Full-Time,Contract,Part-Time',
            'location' => 'required|string|max:255',
            'experience_level' => 'required|string|max:255',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'is_active' => 'boolean',
            'posted_date' => 'required|date',
        ]);

        JobPosting::create($validated);

        return redirect()->route('admin.job-postings.index')->with('success', 'Job posting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosting $jobPosting)
    {
        $jobPosting->load('applications');
        return view('admin.job-postings.show', compact('jobPosting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPosting $jobPosting)
    {
        return view('admin.job-postings.edit', compact('jobPosting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $jobPosting)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|string|max:255',
            'employment_type' => 'required|in:Full-Time,Contract,Part-Time',
            'location' => 'required|string|max:255',
            'experience_level' => 'required|string|max:255',
            'responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'is_active' => 'boolean',
            'posted_date' => 'required|date',
        ]);

        $jobPosting->update($validated);

        return redirect()->route('admin.job-postings.index')->with('success', 'Job posting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();

        return redirect()->route('admin.job-postings.index')->with('success', 'Job posting deleted successfully.');
    }
}
