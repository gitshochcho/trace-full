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

            {{-- Filter Category Order Card --}}
            <div class="card card-outline card-warning mb-4">
                <div class="card-header" style="cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#categoryOrderPanel">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"><i class="fas fa-sort me-2"></i>Projects Filter — Category Order</h3>
                        <small class="text-muted">Click to expand / collapse</small>
                    </div>
                </div>
                <div class="collapse" id="categoryOrderPanel">
                    <div class="card-body">
                        <p class="text-muted small mb-3">Change the number to reorder categories in the Projects page filter. Lower number = appears first.</p>
                        <div class="row g-3">
                            @foreach($services as $service)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="d-flex align-items-center gap-2 border rounded px-3 py-2 bg-light">
                                    <input type="number" class="form-control form-control-sm text-center cat-sort-input"
                                           value="{{ $service->sort_order }}"
                                           data-url="{{ route('admin.services.sort-order', $service) }}"
                                           min="0" style="width:70px; flex-shrink:0;">
                                    <div>
                                        <div class="fw-semibold" style="font-size:13px;">{{ $service->section ?: $service->service_name }}</div>
                                        <div class="text-muted" style="font-size:11px;">{{ $service->projects_count }} project(s)</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="catSaveMsg" class="mt-2 text-success small" style="display:none;">Saved!</div>
                    </div>
                </div>
            </div>

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
document.querySelectorAll('.cat-sort-input').forEach(function (input) {
    input.addEventListener('change', function () {
        const url = this.dataset.url;
        const val = parseInt(this.value, 10);
        fetch(url, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ sort_order: val }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const msg = document.getElementById('catSaveMsg');
                if (msg) { msg.style.display = ''; setTimeout(() => msg.style.display = 'none', 1500); }
                this.classList.add('border-success');
                setTimeout(() => this.classList.remove('border-success'), 1200);
            }
        })
        .catch(() => { this.classList.add('border-danger'); });
    });
});

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
