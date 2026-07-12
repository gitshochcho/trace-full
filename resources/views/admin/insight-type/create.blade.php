@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Add Insight Type</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.insight-types.index') }}">Insight Types</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Type</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Type Details</h3>
                    </div>
                    <form action="{{ route('admin.insight-types.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Type Name <span class="text-danger">*</span></label>
                                    <input type="text" name="type" value="{{ old('type') }}" class="form-control @error('type') is-invalid @enderror" required>
                                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Type Category <span class="text-danger">*</span></label>
                                    <input type="text" name="type_category" value="{{ old('type_category') }}" class="form-control @error('type_category') is-invalid @enderror" placeholder="e.g. read, watch, listen" required>
                                    @error('type_category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Display Order <span class="text-muted small">(lower number = appears first)</span></label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control @error('sort_order') is-invalid @enderror" min="0">
                                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="status" value="0">
                                        <input class="form-check-input" type="checkbox" name="status" value="1" id="activeSwitch" @checked(old('status', '1') == '1')>
                                        <label class="form-check-label" for="activeSwitch">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.insight-types.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Type</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
