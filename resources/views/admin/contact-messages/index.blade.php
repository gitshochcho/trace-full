@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Contact Messages</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Messages</li>
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
                            <h3 class="card-title">Contact Messages List</h3>
                        </div>
                        <div class="card-body">
                            @if ($contactMessages->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Subject</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactMessages as $message)
                                                <tr>
                                                    <td>{{ $message->id }}</td>
                                                    <td>{{ $message->first_name }} {{ $message->last_name }}</td>
                                                    <td>{{ $message->email }}</td>
                                                    <td>{{ $message->mobile_number }}</td>
                                                    <td>{{ $message->subject }}</td>
                                                    <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-sm btn-info">
                                                            <i class="bi bi-eye"></i> View
                                                        </a>
                                                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    {{ $contactMessages->links() }}
                                </div>
                            @else
                                <div class="alert alert-info">No contact messages found.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
