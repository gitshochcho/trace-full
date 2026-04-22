@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Job Postings</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Job Postings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">All Job Postings ({{ $jobs->total() }})</h3>
                                <a href="{{ route('admin.job-postings.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create Job Posting
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Type</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Applications</th>
                                        <th>Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jobs as $job)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.job-postings.show', $job) }}" class="text-decoration-none">
                                                {{ Str::limit($job->title, 40) }}
                                            </a>
                                        </td>
                                        <td>{{ $job->department }}</td>
                                        <td>{{ $job->employment_type }}</td>
                                        <td>{{ $job->location }}</td>
                                        <td>
                                            <span class="badge bg-{{ $job->is_active ? 'success' : 'secondary' }}">
                                                {{ $job->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $job->applications->count() }}</td>
                                        <td>{{ $job->posted_date->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.job-postings.show', $job) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.job-postings.edit', $job) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.job-postings.destroy', $job) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this job posting?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <p class="mb-3">No job postings found.</p>
                                            <a href="{{ route('admin.job-postings.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Create Your First Job Posting
                                            </a>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($jobs->hasPages())
                        <div class="card-footer">
                            {{ $jobs->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection