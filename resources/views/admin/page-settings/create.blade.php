@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Page</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pageSettings.index') }}">Page Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Register a Page for SEO Settings</h3>
                        </div>
                        <form action="{{ route('admin.pageSettings.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <p class="text-muted">
                                    Use this only for a page that already exists in the app (i.e. its route has already
                                    been added to the code). This just registers it here so you can set its Meta Title,
                                    Meta Description, OG/Twitter fields and custom meta tags below.
                                </p>

                                <div class="mb-3">
                                    <label class="form-label">Page Route Name</label>
                                    <input type="text" name="page_slug" value="{{ old('page_slug') }}" class="form-control @error('page_slug') is-invalid @enderror" placeholder="e.g. about">
                                    @error('page_slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> This must exactly match the Laravel route name of the page (ask the developer if unsure).</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Page Name</label>
                                    <input type="text" name="page_name" value="{{ old('page_name') }}" class="form-control @error('page_name') is-invalid @enderror" placeholder="e.g. About Us">
                                    @error('page_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> A friendly label shown in the Page Settings list — doesn't affect the site.</small>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('admin.pageSettings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Add Page</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
