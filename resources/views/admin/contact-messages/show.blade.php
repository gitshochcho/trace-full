@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Contact Message Details</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.contact-messages.index') }}">Contact Messages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Message #{{ $message->id }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Message from {{ $message->first_name }} {{ $message->last_name }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-secondary">Sender Information</h5>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <p>{{ $message->first_name }} {{ $message->last_name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <p>
                                            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Mobile Number</label>
                                        <p>
                                            <a href="tel:{{ $message->mobile_number }}">{{ $message->mobile_number }}</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-secondary">Message Information</h5>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Organization</label>
                                        <p>{{ $message->organization ?? 'Not provided' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Subject</label>
                                        <p>{{ $message->subject }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date Received</label>
                                        <p>{{ $message->created_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="mb-4">
                                <h5 class="text-secondary">Message Content</h5>
                                <div class="card card-light">
                                    <div class="card-body">
                                        <p>{{ nl2br(e($message->message)) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
                                        <i class="bi bi-trash"></i> Delete Message
                                    </button>
                                </form>
                                <a href="mailto:{{ $message->email }}" class="btn btn-success">
                                    <i class="bi bi-envelope"></i> Reply via Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
