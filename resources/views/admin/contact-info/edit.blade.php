@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Contact Information</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.contact-info.index') }}">Contact Info</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Contact Information</h3>
                        </div>
                        <form action="{{ route('admin.contact-info.update', $contactInfo->id) }}" method="POST" class="card-body">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <select name="type" class="form-select @error('type') is-invalid @enderror" required onchange="updateFields()">
                                    <option value="">Select Type</option>
                                    <option value="phone" @selected($contactInfo->type === 'phone')>Phone</option>
                                    <option value="email" @selected($contactInfo->type === 'email')>Email</option>
                                    <option value="address" @selected($contactInfo->type === 'address')>Address</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Icon Class (Font Awesome)</label>
                                <input type="text" name="icon_class" class="form-control @error('icon_class') is-invalid @enderror" 
                                    placeholder="e.g., fas fa-phone-alt" value="{{ old('icon_class', $contactInfo->icon_class) }}">
                                @error('icon_class') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                    placeholder="e.g., Head Office, General Enquiries" value="{{ old('title', $contactInfo->title) }}" required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" id="primaryLabel">Primary Text <span class="text-danger">*</span></label>
                                <input type="text" name="primary_text" class="form-control @error('primary_text') is-invalid @enderror" 
                                    placeholder="e.g., +880 1715-056952 or contact@example.com" value="{{ old('primary_text', $contactInfo->primary_text) }}" required>
                                @error('primary_text') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Secondary Text</label>
                                <input type="text" name="secondary_text" class="form-control @error('secondary_text') is-invalid @enderror" 
                                    placeholder="e.g., Dhaka or Head Office — Dhaka" value="{{ old('secondary_text', $contactInfo->secondary_text) }}">
                                @error('secondary_text') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Address Fields (Hidden by default) -->
                            <div id="addressFields" style="display: {{ $contactInfo->type === 'address' ? 'block' : 'none' }};">
                                <div class="mb-3">
                                    <label class="form-label">Office Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                        placeholder="e.g., Trace Consulting Limited" value="{{ old('name', $contactInfo->name) }}">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Full Address</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" 
                                        placeholder="Full address">{{ old('address', $contactInfo->address) }}</textarea>
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Office Hours</label>
                                    <input type="text" name="office_hours" class="form-control @error('office_hours') is-invalid @enderror" 
                                        placeholder="e.g., Sunday – Thursday, 9:00 AM – 6:00 PM" value="{{ old('office_hours', $contactInfo->office_hours) }}">
                                    @error('office_hours') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Map Location</label>
                                    <textarea name="map_location" class="form-control @error('map_location') is-invalid @enderror" rows="2" 
                                        placeholder="Google Maps embed code or coordinates">{{ old('map_location', $contactInfo->map_location) }}</textarea>
                                    @error('map_location') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link Value (tel:, mailto:, or URL)</label>
                                <input type="text" name="link_value" class="form-control @error('link_value') is-invalid @enderror" 
                                    placeholder="e.g., tel:+8801715056952 or mailto:contact@example.com" value="{{ old('link_value', $contactInfo->link_value) }}">
                                @error('link_value') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" 
                                    placeholder="0" value="{{ old('order', $contactInfo->order) }}">
                                @error('order') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" 
                                        @checked(old('is_active', $contactInfo->is_active))>
                                    <label class="form-check-label" for="isActive">Active</label>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('admin.contact-info.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Contact Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFields() {
            const type = document.querySelector('select[name="type"]').value;
            const addressFields = document.getElementById('addressFields');
            
            if (type === 'address') {
                addressFields.style.display = 'block';
            } else {
                addressFields.style.display = 'none';
            }
        }
        
        // Initialize on page load
        updateFields();
    </script>
@endsection
