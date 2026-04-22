@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ $jobPosting->title }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.job-postings.index') }}">Job Postings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($jobPosting->title, 30) }}</li>
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
                            <h3 class="card-title">Job Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <strong>Title:</strong> {{ $jobPosting->title }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Department:</strong> {{ $jobPosting->department }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Type:</strong> {{ $jobPosting->employment_type }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Location:</strong> {{ $jobPosting->location }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Experience:</strong> {{ $jobPosting->experience_level }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Posted:</strong> {{ $jobPosting->posted_date->format('M d, Y') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong>
                                    <span class="badge bg-{{ $jobPosting->is_active ? 'success' : 'secondary' }}">
                                        {{ $jobPosting->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Applications:</strong> {{ $jobPosting->applications->count() }}
                                </div>
                                <div class="col-12">
                                    <strong>Description:</strong>
                                    <div class="mt-2">{!! nl2br(e($jobPosting->description)) !!}</div>
                                </div>
                                @if($jobPosting->responsibilities)
                                <div class="col-12">
                                    <strong>Responsibilities:</strong>
                                    <div class="mt-2">{!! nl2br(e($jobPosting->responsibilities)) !!}</div>
                                </div>
                                @endif
                                @if($jobPosting->requirements)
                                <div class="col-12">
                                    <strong>Requirements:</strong>
                                    <div class="mt-2">{!! nl2br(e($jobPosting->requirements)) !!}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.job-postings.edit', $jobPosting) }}" class="btn btn-warning">Edit Job</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Quick Actions</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('careerdetails', $jobPosting->id) }}" target="_blank" class="btn btn-info btn-sm w-100 mb-2">
                                <i class="fas fa-external-link-alt"></i> View on Frontend
                            </a>
                            <a href="{{ route('admin.job-applications.index') }}" class="btn btn-secondary btn-sm w-100">
                                <i class="fas fa-users"></i> View All Applications
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Job Applications ({{ $applications->total() }})</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Applied Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($applications as $application)
                                    <tr>
                                        <td>{{ $application->name }}</td>
                                        <td>{{ $application->email }}</td>
                                        <td>{{ $application->phone }}</td>
                                        <td>{{ $application->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $application->is_reviewed ? 'success' : 'warning' }}">
                                                {{ $application->is_reviewed ? 'Reviewed' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.job-applications.show', $application) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.job-applications.download-cv', $application) }}" class="btn btn-sm btn-primary" title="Download CV">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                @if(!$application->is_reviewed)
                                                <form action="{{ route('admin.job-applications.mark-reviewed', $application) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Mark as Reviewed">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <p class="mb-0">No applications received yet.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($applications->hasPages())
                        <div class="card-footer">
                            {{ $applications->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection