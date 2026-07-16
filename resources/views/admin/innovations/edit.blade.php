@extends('layouts.app') @section('content')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-header">
                    <h5 class="mb-0">Edit Innovation</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.innovations.update', $innovation) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $innovation->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $innovation->category) }}">
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div> -->

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $innovation->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Website Link</label>
                            <input type="url" name="website_link" class="form-control @error('website_link') is-invalid @enderror" value="{{ old('website_link', $innovation->website_link) }}">
                            @error('website_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $innovation->sort_order) }}" min="0">
                        </div>

                        <div class="mb-3 d-flex align-items-center gap-4">
                            <div class="form-check form-switch mb-0">
                                <input type="hidden" name="active" value="0">
                                <input class="form-check-input" type="checkbox" name="active" value="1" id="activeSwitch" {{ old('active', $innovation->active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="activeSwitch">Active</label>
                            </div>
                            <div class="form-check form-switch mb-0">
                                <input type="hidden" name="show_on_home" value="0">
                                <input class="form-check-input" type="checkbox" name="show_on_home" value="1" id="showOnHomeSwitch" {{ old('show_on_home', $innovation->show_on_home) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-warning" for="showOnHomeSwitch">Show on Homepage</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Innovation Image</label>
                            @if($innovation->imageUrl())
                                <div class="mb-2">
                                    <img src="{{ $innovation->imageUrl() }}" alt="{{ $innovation->title }}" style="max-height: 140px; border: 1px solid #ddd; padding: 5px;">
                                </div>
                            @endif
                            <input type="file" name="image" id="innovationImage" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Leave empty to keep the current image.</small>

                            <div id="imagePreviewContainer" class="mt-3" style="display:none;">
                                <img id="preview" src="#" alt="Preview" style="max-height: 140px; border: 1px solid #ddd; padding: 5px;">
                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="resetImage()">Cancel</button>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.innovations.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update Innovation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreviewContainer').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function resetImage() {
    document.getElementById('innovationImage').value = "";
    document.getElementById('imagePreviewContainer').style.display = 'none';
}
</script>
@endsection
