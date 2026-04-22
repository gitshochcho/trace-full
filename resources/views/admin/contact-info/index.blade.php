@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Contact Information</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Information</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Contact Information</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.contact-info.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> Add New Contact Info
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($contactInfos->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Title</th>
                                                <th>Primary Text</th>
                                                <th>Secondary Text</th>
                                                <th>Order</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactInfos as $info)
                                                <tr>
                                                    <td>
                                                        <span class="badge bg-{{ $info->type === 'phone' ? 'info' : ($info->type === 'email' ? 'success' : 'warning') }}">
                                                            {{ ucfirst($info->type) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $info->title }}</td>
                                                    <td>{{ $info->primary_text }}</td>
                                                    <td>{{ $info->secondary_text ?? '-' }}</td>
                                                    <td>{{ $info->order }}</td>
                                                    <td>
                                                        @if ($info->is_active)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-secondary">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.contact-info.edit', $info->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="bi bi-pencil"></i> Edit
                                                        </a>
                                                        <form action="{{ route('admin.contact-info.destroy', $info->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">No contact information found. <a href="{{ route('admin.contact-info.create') }}">Add one now</a>.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
