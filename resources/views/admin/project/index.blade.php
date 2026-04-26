@extends('layouts.app')

@section('content')

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Projects Manager</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Projects Manager</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @if(session('message'))
                <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <h3 class="card-title mb-0">All Projects ({{ $projects->count() }})</h3>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="text" id="projectSearch" class="form-control form-control-sm" placeholder="Search by title, client or status..." style="width:260px;">
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create Project
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped align-middle mb-0" id="projectTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Client</th>
                                <th>Standard</th>
                                <th>Status</th>
                                <th>Duration</th>
                                <th>Services</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <td data-search="{{ strtolower($project->project_title) }}">{{ $project->project_title }}</td>
                                    <td data-search="{{ strtolower($project->client ?? '') }}">{{ $project->client ?: '-' }}</td>
                                    <td>{{ $project->project_standard ?: '-' }}</td>
                                    <td data-search="{{ strtolower($project->project_status) }}">
                                        <span class="badge text-bg-info">{{ $project->project_status }}</span>
                                    </td>
                                    <td>{{ $project->durationLabel() ?: '-' }}</td>
                                    <td>{{ $project->services->count() }}</td>
                                    <td>{{ $project->sort_order }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning" title="Edit" data-bs-toggle="tooltip">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display: inline;"
                                                onsubmit="return confirm('Delete this project?')">
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
                                <tr id="emptyRow">
                                    <td colspan="8" class="text-center text-muted py-4">No projects found yet.</td>
                                </tr>
                            @endforelse
                            <tr id="noResultsRow" style="display: none;">
                                <td colspan="8" class="text-center text-muted py-4">No results match your search.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('custome-js')
<script>
(function () {
    const searchInput = document.getElementById('projectSearch');
    const tableBody   = document.querySelector('#projectTable tbody');
    const noResults   = document.getElementById('noResultsRow');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            let visibleCount = 0;

            tableBody.querySelectorAll('tr:not(#noResultsRow):not(#emptyRow)').forEach(function (row) {
                const cells = row.querySelectorAll('td[data-search]');
                const match = !q || Array.from(cells).some(function (td) {
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
