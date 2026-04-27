@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Job Posting</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.job-postings.index') }}">Job Postings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                            <h3 class="card-title">Job Posting Details</h3>
                        </div>
                        <form action="{{ route('admin.job-postings.update', $jobPosting) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" value="{{ old('title', $jobPosting->title) }}" class="form-control @error('title') is-invalid @enderror" required>
                                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Department <span class="text-danger">*</span></label>
                                        <input type="text" name="department" value="{{ old('department', $jobPosting->department) }}" class="form-control @error('department') is-invalid @enderror" required>
                                        @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Employment Type <span class="text-danger">*</span></label>
                                        <select name="employment_type" class="form-control @error('employment_type') is-invalid @enderror" required>
                                            <option value="">Select Type</option>
                                            <option value="Full-Time" {{ old('employment_type', $jobPosting->employment_type) == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                                            <option value="Contract" {{ old('employment_type', $jobPosting->employment_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                            <option value="Part-Time" {{ old('employment_type', $jobPosting->employment_type) == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                        </select>
                                        @error('employment_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" name="location" value="{{ old('location', $jobPosting->location) }}" class="form-control @error('location') is-invalid @enderror" required>
                                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Experience Level <span class="text-danger">*</span></label>
                                        <input type="text" name="experience_level" value="{{ old('experience_level', $jobPosting->experience_level) }}" class="form-control @error('experience_level') is-invalid @enderror" placeholder="e.g., 2-4 years experience" required>
                                        @error('experience_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Posted Date <span class="text-danger">*</span></label>
                                        <input type="date" name="posted_date" value="{{ old('posted_date', $jobPosting->posted_date->format('Y-m-d')) }}" class="form-control @error('posted_date') is-invalid @enderror" required>
                                        @error('posted_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">End Date (Application Deadline)</label>
                                        <input type="date" name="end_date" value="{{ old('end_date', $jobPosting->end_date?->format('Y-m-d')) }}" class="form-control @error('end_date') is-invalid @enderror">
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Last date to accept applications. Leave blank for open-ended.</small>
                                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Order</label>
                                        <input type="number" name="order" value="{{ old('order', $jobPosting->order) }}" class="form-control @error('order') is-invalid @enderror">
                                        @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="is_active" value="0">
                                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $jobPosting->is_active) ? 'checked' : '' }} class="form-check-input" id="is_active" role="switch">
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $jobPosting->description) }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Responsibilities</label>
                                        <textarea name="responsibilities" rows="4" class="form-control @error('responsibilities') is-invalid @enderror">{{ old('responsibilities', $jobPosting->responsibilities) }}</textarea>
                                        @error('responsibilities')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Requirements</label>
                                        <textarea name="requirements" rows="4" class="form-control @error('requirements') is-invalid @enderror">{{ old('requirements', $jobPosting->requirements) }}</textarea>
                                        @error('requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.job-postings.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Job Posting</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection