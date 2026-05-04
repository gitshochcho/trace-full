@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Insights Manager</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Insights Manager</li>
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
                            <h3 class="card-title mb-0">All Insights ({{ $insights->total() }})</h3>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="text" id="insightSearch" class="form-control form-control-sm" placeholder="Search by heading, type..." style="width: 240px;">
                                <a href="{{ route('admin.insights.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Insight
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width:60px">Image</th>
                                    <th>Heading</th>
                                    <th>Type</th>
                                    <th>Sections</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="insightTableBody">
                                @forelse($insights as $insight)
                                <tr data-search="{{ strtolower($insight->heading . ' ' . ($insight->insightType?->type ?? '')) }}">
                                    <td>
                                        @php($thumbUrl = $insight->getFirstMediaUrl('image') ?: $insight->getFirstMediaUrl('article_image'))
                                        @if($thumbUrl)
                                            <img src="{{ $thumbUrl }}" alt="{{ $insight->heading }}"
                                                 style="width:42px;height:42px;object-fit:cover;border-radius:8px;">
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>{{ $insight->heading }}</td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $insight->insightType ? ucfirst(str_replace('_', ' ', $insight->insightType->type)) : '—' }}
                                        </span>
                                    </td>
                                    <td>{{ $insight->articles->count() }}</td>
                                    <td>{{ $insight->sort_order }}</td>
                                    <td>
                                        <span class="badge bg-{{ $insight->active ? 'success' : 'secondary' }}">
                                            {{ $insight->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.insights.edit', $insight) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.insights.destroy', $insight) }}" method="POST"
                                                  onsubmit="return confirm('Delete this insight?')" style="display:inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="noInsights">
                                    <td colspan="7" class="text-center text-muted py-4">No insights found yet.</td>
                                </tr>
                                @endforelse
                                <tr id="noResultsRow" style="display:none">
                                    <td colspan="7" class="text-center text-muted py-3">No results match your search.</td>
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
document.getElementById('insightSearch').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    let visible = 0;
    document.querySelectorAll('#insightTableBody tr[data-search]').forEach(function (row) {
        const match = row.dataset.search.includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('noResultsRow').style.display = (visible === 0) ? '' : 'none';
});
</script>
@endpush
