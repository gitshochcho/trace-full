@extends('layouts.app') @section('content')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Innovations List</h5>
                    <a href="{{ route('admin.innovations.create') }}" class="btn btn-primary btn-sm">Add New Innovation</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Website</th>
                                    <th>Sort Order</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($innovations as $innovation)
                                <tr>
                                    <td>
                                        @if($innovation->imageUrl())
                                            <img src="{{ $innovation->imageUrl() }}" alt="{{ $innovation->title }}" style="height: 50px; width: 70px; object-fit: cover; border-radius: 4px;">
                                        @endif
                                    </td>
                                    <td>{{ $innovation->title }}</td>
                                    <td>{{ $innovation->category }}</td>
                                    <td>
                                        @if($innovation->website_link)
                                            <a href="{{ $innovation->website_link }}" target="_blank">Visit</a>
                                        @endif
                                    </td>
                                    <td>{{ $innovation->sort_order }}</td>
                                    <td>
                                        @if($innovation->active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.innovations.edit', $innovation->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <form action="{{ route('admin.innovations.destroy', $innovation->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No innovations added yet.</td>
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
