@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Insight Types Manager</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Insight Types</li>
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
                            <h3 class="card-title mb-0">All Insight Types ({{ $insights->total() }})</h3>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="text" id="typeSearch" class="form-control form-control-sm" placeholder="Search by type or category..." style="width: 240px;">
                                <a href="{{ route('admin.insight-types.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Type
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Type Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="typeTableBody">
                                @forelse($insights as $insight)
                                <tr data-search="{{ strtolower($insight->type . ' ' . $insight->type_category) }}">
                                    <td>{{ ucfirst(str_replace('_', ' ', $insight->type)) }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $insight->type_category }}</span></td>
                                    <td>
                                        <span class="badge bg-{{ $insight->status ? 'success' : 'secondary' }}">
                                            {{ $insight->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.insight-types.edit', $insight) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.insight-types.destroy', $insight) }}" method="POST"
                                                  onsubmit="return confirm('Delete this insight type?')" style="display:inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No insight types found yet.</td>
                                </tr>
                                @endforelse
                                <tr id="noResultsRow" style="display:none">
                                    <td colspan="4" class="text-center text-muted py-3">No results match your search.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if($insights->hasPages())
                    <div class="card-footer">
                        {{ $insights->links() }}
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
document.getElementById('typeSearch').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    let visible = 0;
    document.querySelectorAll('#typeTableBody tr[data-search]').forEach(function (row) {
        const match = row.dataset.search.includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('noResultsRow').style.display = (visible === 0) ? '' : 'none';
});
</script>
@endpush
