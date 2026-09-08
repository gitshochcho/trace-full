@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Page Settings</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Page Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('message'))
                        <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">SEO / Meta Settings per Page</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">
                                Set the Meta Title, Meta Description and OG Image shown for each public page.
                                Leave a field empty to keep using the site's default value.
                            </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Page</th>
                                            <th>Meta Title</th>
                                            <th>OG Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pageSettings as $pageSetting)
                                            <tr>
                                                <td>{{ $pageSetting->page_name }}</td>
                                                <td>{{ $pageSetting->meta_title ?: '—' }}</td>
                                                <td>{{ $pageSetting->og_type }}</td>
                                                <td>
                                                    @if ($pageSetting->isCustomized())
                                                        <span class="badge bg-success">Customized</span>
                                                    @else
                                                        <span class="badge bg-secondary">Using Default</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.pageSettings.edit', $pageSetting) }}" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
