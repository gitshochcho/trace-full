@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0">Partner Manager</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Partner Manager</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">

            {{-- CREATE FORM --}}
            <div class="col-12 col-xl-4">
                <div class="card card-outline card-primary">
                    <div class="card-header"><h3 class="card-title">Add Partner</h3></div>
                    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="USAID">
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" rows="2" class="form-control @error('description') is-invalid @enderror" placeholder="Short description...">{{ old('description') }}</textarea>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Website Link</label>
                                    <input type="text" name="link" value="{{ old('link') }}" class="form-control @error('link') is-invalid @enderror" placeholder="https://...">
                                    @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="active" value="1" id="activeCreate" @checked(old('active', true))>
                                        <label class="form-check-label" for="activeCreate">Active</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Logo Image</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Partner</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- PARTNERS LIST --}}
            <div class="col-12 col-xl-8">
                <div class="card card-outline card-secondary">
                    <div class="card-header"><h3 class="card-title">Existing Partners</h3></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:70px">Logo</th>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Order</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($partners as $partner)
                                    <tr>
                                        <td>
                                            @if($partner->imageUrl())
                                                <img src="{{ $partner->imageUrl() }}" alt="{{ $partner->name }}" style="height:40px;max-width:80px;object-fit:contain;">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $partner->name }}</strong>
                                            @if($partner->description)
                                                <div class="small text-muted">{{ Str::limit($partner->description, 50) }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($partner->link)
                                                <a href="{{ $partner->link }}" target="_blank" class="small">{{ Str::limit($partner->link, 30) }}</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $partner->sort_order }}</td>
                                        <td>
                                            <span class="badge {{ $partner->active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $partner->active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $partner->id }}">Edit</button>
                                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this partner?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editModal{{ $partner->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Partner: {{ $partner->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" name="name" value="{{ $partner->name }}" class="form-control" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Description</label>
                                                                <textarea name="description" rows="2" class="form-control">{{ $partner->description }}</textarea>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Website Link</label>
                                                                <input type="text" name="link" value="{{ $partner->link }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Sort Order</label>
                                                                <input type="number" name="sort_order" value="{{ $partner->sort_order }}" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-end">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="active" value="1" id="activeEdit{{ $partner->id }}" @checked($partner->active)>
                                                                    <label class="form-check-label" for="activeEdit{{ $partner->id }}">Active</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Logo Image</label>
                                                                @if($partner->imageUrl())
                                                                    <div class="mb-2 d-flex align-items-center gap-3">
                                                                        <img src="{{ $partner->imageUrl() }}" alt="{{ $partner->name }}" style="height:50px;max-width:120px;object-fit:contain;">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="removeImg{{ $partner->id }}">
                                                                            <label class="form-check-label" for="removeImg{{ $partner->id }}">Remove</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <input type="file" name="image" class="form-control" accept="image/*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update Partner</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No partners added yet.</td>
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
</div>
@endsection