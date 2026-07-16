@extends('layouts.app')

@section('content')
    
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Insight Type</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.insight-types.index') }}">Insights Type Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-xl-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Type</h3>
                        </div>
                        <form action="{{ route('admin.insight-types.update', $insightType) }}" method="POST" enctype="multipart/form-data" id="insightTypeForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row g-3">
                                    
                                    <div class="col-12">
                                        <label class="form-label">Type Name</label>
                                        <input type="text" name="type" value="{{ old('type', $insightType->type) }}" class="form-control @error('type') is-invalid @enderror">
                                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Type Category</label>
                                        <input type="text" name="type_category" value="{{ old('type_category', $insightType->type_category) }}" class="form-control @error('type_category') is-invalid @enderror">
                                        @error('type_category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label">Display Order <span class="text-muted small">(lower number = appears first)</span></label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', $insightType->sort_order) }}" class="form-control @error('sort_order') is-invalid @enderror" min="0">
                                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" id="activeSwitch" @checked(old('status', $insightType->status) == '1')>
                                            <label class="form-check-label" for="activeSwitch">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('admin.insight-types.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Type</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
