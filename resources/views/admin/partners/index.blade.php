@extends('layouts.app') @section('content')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Partners List</h5>
                    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary btn-sm">Add New Partner</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($partners as $partner)
                                <tr>
                                    <td>
                                        <img src="{{ $partner->imageUrl() }}" alt="Logo" style="height: 50px; width: auto;">
                                    </td>
                                    <td>{{ $partner->name }}</td>
                                    <td><a href="{{ $partner->link }}" target="_blank">{{ $partner->link }}</a></td>
                                    <td>
                                        <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
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
@endsection