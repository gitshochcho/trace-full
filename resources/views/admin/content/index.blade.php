@extends('layouts.app')

@section('content')
    @php
        $content = null;
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Content Manager</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Content Manager</li>
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
                            <h3 class="card-title">Create Content</h3>
                        </div>
                        <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @include('admin.content.partials.form', ['content' => $content])
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Content</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-xl-7">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Existing Content Blocks</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Slug</th>
                                        <th>Heading</th>
                                        <th>Section</th>
                                        <th>Type</th>
                                        <th>Media</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contents as $item)
                                        <tr>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->heading }}</td>
                                            <td>{{ $item->section }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                <div class="d-flex gap-2 align-items-center">
                                                    @if($item->iconUrl())
                                                        <img src="{{ $item->iconUrl() }}" alt="icon" style="width: 26px; height: 26px; object-fit: contain;">
                                                    @endif
                                                    @if($item->imageUrl())
                                                        <img src="{{ $item->imageUrl() }}" alt="image" style="width: 40px; height: 26px; object-fit: cover;">
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('admin.content.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form action="{{ route('admin.content.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this content?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No content found yet.</td>
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
