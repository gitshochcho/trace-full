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
                                    <strong>End Date:</strong>
                                    @if($jobPosting->end_date)
                                        {{ $jobPosting->end_date->format('M d, Y') }}
                                        @if($jobPosting->end_date->isPast())
                                            <span class="badge bg-danger ms-1">Expired</span>
                                        @endif
                                    @else
                                        <span class="text-muted">Open-ended</span>
                                    @endif
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
                        <div class="card-footer d-flex gap-2">
                            <a href="{{ route('admin.job-postings.edit', $jobPosting) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Job
                            </a>
                            <a href="{{ route('admin.job-postings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Quick Actions</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('careerdetails', $jobPosting->id) }}" target="_blank" class="btn btn-info btn-sm w-100 mb-2" data-bs-toggle="tooltip" title="Preview on frontend">
                                <i class="fas fa-external-link-alt"></i> Preview on Frontend
                            </a>
                            <a href="{{ route('admin.job-applications.index') }}?job={{ $jobPosting->id }}" class="btn btn-success btn-sm w-100 mb-2">
                                <i class="fas fa-users"></i> Applications ({{ $jobPosting->applications->count() }})
                            </a>
                            @if($jobPosting->is_active)
                            <button type="button" class="btn btn-outline-success btn-sm w-100" disabled>
                                <i class="fas fa-check-circle"></i> Active
                            </button>
                            @else
                            <button type="button" class="btn btn-outline-secondary btn-sm w-100" disabled>
                                <i class="fas fa-times-circle"></i> Inactive
                            </button>
                            @endif
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
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.job-applications.show', $application) }}" class="btn btn-info" title="View" data-bs-toggle="tooltip">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('admin.job-applications.download-cv', $application) }}" class="btn btn-primary" title="Download CV" data-bs-toggle="tooltip">
                                                    <i class="fas fa-download"></i> CV
                                                </a>
                                                <form action="{{ route('admin.job-applications.mark-reviewed', $application) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @if(!$application->is_reviewed)
                                                    <button type="submit" class="btn btn-success btn-sm" title="Mark as Reviewed" data-bs-toggle="tooltip">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                    @else
                                                    <button type="submit" class="btn btn-warning btn-sm" title="Mark as Pending" data-bs-toggle="tooltip">
                                                        <i class="fas fa-undo"></i> Pending
                                                    </button>
                                                    @endif
                                                </form>
                                                <form action="{{ route('admin.job-applications.destroy', $application) }}" method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this application?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" data-bs-toggle="tooltip">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
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