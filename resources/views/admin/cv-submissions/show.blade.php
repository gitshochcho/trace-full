@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0">CV Submission #{{ $submission->id }}</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.cv-submissions.index') }}">CV Submissions</a></li>
                    <li class="breadcrumb-item active">#{{ $submission->id }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">{{ $submission->name }}</h3>
                        <a href="{{ route('admin.cv-submissions.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Back
                        </a>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4 text-secondary">Full Name</dt>
                            <dd class="col-sm-8">{{ $submission->name }}</dd>

                            <dt class="col-sm-4 text-secondary">Email</dt>
                            <dd class="col-sm-8"><a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a></dd>

                            <dt class="col-sm-4 text-secondary">Phone</dt>
                            <dd class="col-sm-8">{{ $submission->phone }}</dd>

                            <dt class="col-sm-4 text-secondary">Submitted At</dt>
                            <dd class="col-sm-8">{{ $submission->created_at->format('d M Y, h:i A') }}</dd>

                            <dt class="col-sm-4 text-secondary">CV File</dt>
                            <dd class="col-sm-8">
                                @if($submission->cvUrl())
                                    <a href="{{ $submission->cvUrl() }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="bi bi-file-earmark-pdf me-1"></i>Open PDF
                                    </a>
                                @else
                                    <span class="text-muted">No file found</span>
                                @endif
                            </dd>
                        </dl>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <form action="{{ route('admin.cv-submissions.destroy', $submission) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Delete this submission?')">
                                <i class="bi bi-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection