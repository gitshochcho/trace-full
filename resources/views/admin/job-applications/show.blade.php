@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Application Details</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.job-applications.index') }}">Applications</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($application->name, 30) }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Applicant Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <strong>Name:</strong> {{ $application->name }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Email:</strong> <a href="mailto:{{ $application->email }}">{{ $application->email }}</a>
                                </div>
                                <div class="col-md-6">
                                    <strong>Phone:</strong> <a href="tel:{{ $application->phone }}">{{ $application->phone }}</a>
                                </div>
                                <div class="col-md-6">
                                    <strong>Applied Date:</strong> {{ $application->created_at->format('M d, Y H:i') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Job Position:</strong>
                                    <a href="{{ route('admin.job-postings.show', $application->jobPosting) }}" class="text-decoration-none">
                                        {{ $application->jobPosting->title }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong>
                                    <span class="badge bg-{{ $application->is_reviewed ? 'success' : 'warning' }}">
                                        {{ $application->is_reviewed ? 'Reviewed' : 'Pending' }}
                                    </span>
                                </div>
                                @if($application->cover_letter)
                                <div class="col-12">
                                    <strong>Cover Letter:</strong>
                                    <div class="mt-2 p-3 bg-light rounded">{!! nl2br(e($application->cover_letter)) !!}</div>
                                </div>
                                @endif
                                @if($application->cv_path)
                                <div class="col-12">
                                    <strong>CV/Resume:</strong>
                                    <div class="mt-2">
                                        <a href="{{ route('admin.job-applications.download-cv', $application) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-download"></i> Download CV
                                        </a>
                                        <small class="text-muted ms-2">File: {{ basename($application->cv_path) }}</small>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer d-flex gap-2">
                            @if(!$application->is_reviewed)
                            <form action="{{ route('admin.job-applications.mark-reviewed', $application) }}" method="POST" class="me-auto">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Mark as Reviewed
                                </button>
                            </form>
                            @else
                            <span class="badge bg-success align-self-center me-auto">
                                <i class="fas fa-check-circle"></i> Already Reviewed
                            </span>
                            @endif
                            <a href="{{ route('admin.job-applications.download-cv', $application) }}" class="btn btn-primary">
                                <i class="fas fa-download"></i> Download CV
                            </a>
                            <a href="{{ route('admin.job-applications.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Job Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <strong>Position:</strong> {{ $application->jobPosting->title }}
                            </div>
                            <div class="mb-2">
                                <strong>Department:</strong> {{ $application->jobPosting->department }}
                            </div>
                            <div class="mb-2">
                                <strong>Type:</strong> {{ $application->jobPosting->employment_type }}
                            </div>
                            <div class="mb-2">
                                <strong>Location:</strong> {{ $application->jobPosting->location }}
                            </div>
                            <div class="mb-2">
                                <strong>Experience:</strong> {{ $application->jobPosting->experience_level }}
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.job-postings.show', $application->jobPosting) }}" class="btn btn-info btn-sm w-100">
                                    <i class="fas fa-external-link-alt"></i> View Job Details
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card card-outline card-warning mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Quick Actions</h3>
                        </div>
                        <div class="card-body">
                            <a href="mailto:{{ $application->email }}" class="btn btn-primary btn-sm w-100 mb-2">
                                <i class="fas fa-envelope"></i> Send Email
                            </a>
                            <a href="tel:{{ $application->phone }}" class="btn btn-success btn-sm w-100">
                                <i class="fas fa-phone"></i> Call Applicant
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection