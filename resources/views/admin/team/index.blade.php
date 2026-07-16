@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Team Manager</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Team Manager</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            {{-- Success message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <h3 class="card-title mb-0">Team Members ({{ $teams->count() }})</h3>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="text" id="teamSearch" class="form-control form-control-sm" placeholder="Search by name or designation..." style="width: 240px;">
                            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add Team Member
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped align-middle mb-0" id="teamTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Type</th>
                                <th>Projects</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teams as $team)
                                <tr>
                                    <td>
                                        @if($team->imageUrl())
                                            <img src="{{ $team->imageUrl() }}" alt="{{ $team->fullName() }}" style="width: 42px; height: 42px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td data-search="{{ strtolower($team->fullName()) }}">{{ $team->fullName() }}</td>
                                    <td data-search="{{ strtolower($team->designation ?? '') }}">{{ $team->designation ?: '-' }}</td>
                                    <td>{{ $team->type == 1 ? 'Team Member' : 'Advisor' }}</td>
                                    <td>{{ $team->projects->count() }}</td>
                                    <td>{{ $team->sort_order }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-warning" title="Edit" data-bs-toggle="tooltip">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" style="display: inline;"
                                                onsubmit="return confirm('Delete this team member?')">
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
                                    <td colspan="7" class="text-center text-muted py-4">No team members found.</td>
                                </tr>
                            @endforelse
                            <tr id="noResultsRow" style="display: none;">
                                <td colspan="7" class="text-center text-muted py-4">No results match your search.</td>
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
    // ── Real-time search ─────────────────────────────────────────────
    const searchInput = document.getElementById('teamSearch');
    const tableBody   = document.querySelector('#teamTable tbody');
    const noResults   = document.getElementById('noResultsRow');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            let visibleCount = 0;

            tableBody.querySelectorAll('tr:not(#noResultsRow):not(#emptyRow)').forEach(function (row) {
                const name        = (row.querySelector('td[data-search]')?.dataset.search || '');
                const designation = (row.querySelectorAll('td[data-search]')[1]?.dataset.search || '');
                const match = !q || name.includes(q) || designation.includes(q);
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
