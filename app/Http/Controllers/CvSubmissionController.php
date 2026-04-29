<?php

namespace App\Http\Controllers;

use App\Models\CvSubmission;
use Illuminate\Http\Request;

class CvSubmissionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['nullable', 'email', 'max:255'],
            'phone'  => ['nullable', 'string', 'max:50'],
            'cv_pdf' => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $submission = CvSubmission::create([
            'name'  => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ]);

        $submission->addMedia($request->file('cv_pdf'))->toMediaCollection('cv_pdf');

        return back()->with('cv_success', 'Your CV has been submitted successfully. We will reach out when the right opportunity comes up!');
    }
}