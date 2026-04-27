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
                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <h3 class="card-title mb-0">All Job Postings ({{ $jobs->total() }})</h3>
                                <div class="d-flex gap-2 align-items-center">
                                    <input type="text" id="jobSearch" class="form-control form-control-sm" placeholder="Search by title, department, location or type..." style="width: 300px;">
                                    <a href="{{ route('admin.job-postings.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Create Job Posting
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0" id="jobTable">
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
                                        <td data-search="{{ strtolower($job->title) }}">
                                            <a href="{{ route('admin.job-postings.show', $job) }}" class="text-decoration-none">
                                                {{ Str::limit($job->title, 40) }}
                                            </a>
                                        </td>
                                        <td data-search="{{ strtolower($job->department ?? '') }}">{{ $job->department }}</td>
                                        <td data-search="{{ strtolower($job->employment_type ?? '') }}">{{ $job->employment_type }}</td>
                                        <td data-search="{{ strtolower($job->location ?? '') }}">{{ $job->location }}</td>
                                        <td>
                                            <span class="badge bg-{{ $job->is_active ? 'success' : 'secondary' }}">
                                                {{ $job->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $job->applications->count() }}</td>
                                        <td>{{ $job->posted_date->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.job-postings.show', $job) }}" class="btn btn-info" title="View Details" data-bs-toggle="tooltip">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('admin.job-postings.edit', $job) }}" class="btn btn-warning" title="Edit Job" data-bs-toggle="tooltip">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('careerdetails', $job->id) }}" class="btn btn-primary" title="Preview" target="_blank" data-bs-toggle="tooltip">
                                                    <i class="fas fa-external-link-alt"></i> Preview
                                                </a>
                                                <form action="{{ route('admin.job-postings.destroy', $job) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Delete Job"
                                                            onclick="return confirm('Are you sure you want to delete this job posting?')"
                                                            data-bs-toggle="tooltip">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr id="emptyRow">
                                        <td colspan="8" class="text-center py-4">
                                            <p class="mb-3">No job postings found.</p>
                                            <a href="{{ route('admin.job-postings.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Create Your First Job Posting
                                            </a>
                                        </td>
                                    </tr>
                                    @endforelse
                                    <tr id="noResultsRow" style="display: none;">
                                        <td colspan="8" class="text-center text-muted py-4">No results match your search.</td>
                                    </tr>
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

@push('custome-js')
<script>
(function () {
    const searchInput = document.getElementById('jobSearch');
    const tableBody   = document.querySelector('#jobTable tbody');
    const noResults   = document.getElementById('noResultsRow');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            let visibleCount = 0;

            tableBody.querySelectorAll('tr:not(#noResultsRow):not(#emptyRow)').forEach(function (row) {
                const match = !q || Array.from(row.querySelectorAll('td[data-search]')).some(function (td) {
                    return td.dataset.search.includes(q);
                });
                row.style.display = match ? '' : 'none';
                if (match) visibleCount++;
            });

            if (noResults) {
                noResults.style.display = (visibleCount === 0 && q !== '') ? '' : 'none';
            }
        });
    }
})();
</script>
@endpush