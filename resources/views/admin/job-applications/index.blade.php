@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Job Applications</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Job Applications</li>
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
                                <h3 class="card-title mb-0">All Applications ({{ $applications->total() }})</h3>
                                <div class="card-tools">
                                    <form method="GET" class="d-flex">
                                        <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search by name or email">
                                        <select name="status" class="form-control form-control-sm me-2">
                                            <option value="">All Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Job Position</th>
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
                                        <td>
                                            <a href="{{ route('admin.job-postings.show', $application->jobPosting) }}" class="text-decoration-none">
                                                {{ $application->jobPosting->title }}
                                            </a>
                                        </td>
                                        <td>{{ $application->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $application->is_reviewed ? 'success' : 'warning' }}">
                                                {{ $application->is_reviewed ? 'Reviewed' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.job-applications.show', $application) }}" class="btn btn-info" title="View Details" data-bs-toggle="tooltip">
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
                                        <td colspan="7" class="text-center py-4">
                                            <p class="mb-0">No applications found.</p>
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