@extends('layouts.app')

@section('content')

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Content Manager</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Content Manager</li>
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
                        <h3 class="card-title mb-0">All Content Blocks ({{ $contents->count() }})</h3>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="text" id="contentSearch" class="form-control form-control-sm" placeholder="Search by slug, heading, section or type..." style="width: 280px;">
                            <a href="{{ route('admin.content.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create Content
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped align-middle mb-0" id="contentTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Slug</th>
                                <th>Heading</th>
                                <th>Section</th>
                                <th>Type</th>
                                <th>Media</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contents as $item)
                                <tr>
                                    <td data-search="{{ strtolower($item->slug) }}">{{ $item->slug }}</td>
                                    <td data-search="{{ strtolower($item->heading ?? '') }}">{{ $item->heading ?: '-' }}</td>
                                    <td data-search="{{ strtolower($item->section ?? '') }}">{{ $item->section ?: '-' }}</td>
                                    <td data-search="{{ strtolower($item->type ?? '') }}">{{ $item->type ?: '-' }}</td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            @if($item->iconUrl())
                                                <img src="{{ $item->iconUrl() }}" alt="icon" style="width: 26px; height: 26px; object-fit: contain;">
                                            @endif
                                            @if($item->imageUrl())
                                                <img src="{{ $item->imageUrl() }}" alt="image" style="width: 40px; height: 26px; object-fit: cover;">
                                            @endif
                                            @if(!$item->iconUrl() && !$item->imageUrl())
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.content.edit', $item) }}" class="btn btn-warning" title="Edit" data-bs-toggle="tooltip">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.content.destroy', $item) }}" method="POST" style="display: inline;"
                                                onsubmit="return confirm('Delete this content?')">
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
                                    <td colspan="6" class="text-center text-muted py-4">No content found yet.</td>
                                </tr>
                            @endforelse
                            <tr id="noResultsRow" style="display: none;">
                                <td colspan="6" class="text-center text-muted py-4">No results match your search.</td>
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
    const searchInput = document.getElementById('contentSearch');
    const tableBody   = document.querySelector('#contentTable tbody');
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
