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
                        <li class="breadcrumb-item active" aria-current="page">Insights Type Manager</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-xl-5">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Type</h3>
                        </div>
                        <form action="{{ route('admin.insight-types.store') }}" method="POST" enctype="multipart/form-data" id="insightTypeForm">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    
                                    <div class="col-12">
                                        <label class="form-label">Type Name</label>
                                        <input type="text" name="type" value="{{ old('type') }}" class="form-control @error('type') is-invalid @enderror">
                                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" id="activeSwitch" @checked(old('status', '1') == '1')>
                                            <label class="form-check-label" for="activeSwitch">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Type</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-xl-7">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Existing Insights</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($insights as $insight)
                                        <tr>
                                            <td>{{ strtoupper(str_replace('_', ' ', $insight->type)) }}</td>
                                            <td>
                                                @if($insight->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                                </td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('admin.insight-types.edit', $insight) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form action="{{ route('admin.insight-types.destroy', $insight) }}" method="POST" onsubmit="return confirm('Delete this insight type?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">No insight types found yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
