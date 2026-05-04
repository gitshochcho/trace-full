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
                                
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#replyMailModal">
                                    <i class="bi bi-envelope"></i> Reply via Email
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="replyMailModal" tabindex="-1" aria-labelledby="replyMailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg border-0">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="replyMailModalLabel">
                        <i class="bi bi-reply-all-fill me-2"></i>Compose Reply
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.contact-messages.reply', $message->id) }}" method="POST"> @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="to_email" class="form-label fw-bold text-secondary">To:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                <input type="email" name="to_email" class="form-control bg-light" id="to_email" value="{{ $message->email }}" readonly>
                            </div>
                            <small class="text-muted italic">Replying to {{ $message->first_name }} {{ $message->last_name }}</small>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label fw-bold text-secondary">Subject:</label>
                            <input type="text" name="subject" class="form-control" id="subject" value="Re: {{ $message->subject }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="reply_message" class="form-label fw-bold text-secondary">Message Body:</label>
                            <textarea name="reply_message" class="form-control" id="reply_message" rows="10" placeholder="Type your reply here..." required style="resize: none;"></textarea>
                        </div>
                        
                        <div class="alert alert-info py-2" style="font-size: 0.85rem;">
                            <i class="bi bi-info-circle me-1"></i> This message will be sent directly to the sender's email address.
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top-0">
                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="replySubmitBtn" class="btn btn-success px-5">
                            <i class="bi bi-send-check-fill me-1"></i> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custome-js')
<script>
document.querySelector('#replyMailModal form')?.addEventListener('submit', function () {
    const btn = document.getElementById('replySubmitBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Sending...';
});
</script>
@endpush