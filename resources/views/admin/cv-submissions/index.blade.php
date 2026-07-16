@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0">CV Submissions</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">CV Submissions</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center g-2">
                    <div class="col-sm-4">
                        <h3 class="card-title mb-0">
                            All CV Submissions
                            <span class="badge bg-secondary ms-2">{{ $submissions->total() }}</span>
                        </h3>
                    </div>
                    <div class="col-sm-8">
                        <div class="d-flex gap-2 justify-content-sm-end align-items-center flex-wrap">
                            {{-- Per-page selector --}}
                            <form method="GET" action="{{ route('admin.cv-submissions.index') }}" class="d-flex align-items-center gap-1" id="perPageForm">
                                <input type="hidden" name="search" value="{{ $search }}">
                                <label class="mb-0 small text-muted text-nowrap">Show:</label>
                                <select name="per_page" class="form-select form-select-sm" style="width:auto;"
                                        onchange="document.getElementById('perPageForm').submit()">
                                    @foreach([10, 20, 30, 50, 'all'] as $opt)
                                    <option value="{{ $opt }}" {{ (string)$perPageInput === (string)$opt ? 'selected' : '' }}>
                                        {{ $opt === 'all' ? 'All' : $opt }}
                                    </option>
                                    @endforeach
                                </select>
                            </form>

                            {{-- Search form --}}
                            <form method="GET" action="{{ route('admin.cv-submissions.index') }}" class="d-flex gap-2">
                                <input type="hidden" name="per_page" value="{{ $perPageInput }}">
                                <input type="text" name="search" class="form-control form-control-sm"
                                       placeholder="Search by name..." value="{{ $search }}">
                                <button type="submit" class="btn btn-sm btn-primary px-3">
                                    <i class="bi bi-search"></i>
                                </button>
                                @if($search)
                                <a href="{{ route('admin.cv-submissions.index') }}?per_page={{ $perPageInput }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>CV File</th>
                                <th>Submitted</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($submissions as $submission)
                            <tr class="{{ $submission->is_read ? '' : 'table-warning fw-semibold' }}">
                                <td>{{ $submission->id }}</td>
                                <td>{{ $submission->name }}</td>
                                <td>
                                    @if($submission->email)
                                        <a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ $submission->phone ?: '—' }}</td>
                                <td>
                                    @if($submission->cvUrl())
                                        <a href="{{ $submission->cvUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-file-earmark-pdf me-1"></i>View PDF
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td class="text-nowrap">{{ $submission->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($submission->is_read)
                                        <span class="badge bg-success">Read</span>
                                    @else
                                        <span class="badge bg-warning text-dark">New</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.cv-submissions.show', $submission) }}"
                                           class="btn btn-sm btn-outline-info" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.cv-submissions.destroy', $submission) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"
                                                onclick="return confirm('Delete this CV submission?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    @if($search)
                                        No results found for "<strong>{{ $search }}</strong>".
                                    @else
                                        No CV submissions yet.
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer d-flex align-items-center justify-content-between flex-wrap gap-2">
                <small class="text-muted">
                    @if($submissions->total() > 0)
                        Showing {{ $submissions->firstItem() }}–{{ $submissions->lastItem() }} of {{ $submissions->total() }} entries
                        @if($perPageInput !== 'all')
                            &nbsp;|&nbsp; Page {{ $submissions->currentPage() }} of {{ $submissions->lastPage() }}
                        @endif
                    @else
                        No entries found
                    @endif
                </small>
                @if($submissions->hasPages())
                    {{ $submissions->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection