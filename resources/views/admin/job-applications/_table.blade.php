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
                    <div class="d-flex flex-wrap gap-1">
                        <a href="{{ route('admin.job-applications.show', $application) }}" class="btn btn-info btn-sm" title="View Details" data-bs-toggle="tooltip">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('admin.job-applications.download-cv', $application) }}" class="btn btn-primary btn-sm" title="Download CV" data-bs-toggle="tooltip">
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
