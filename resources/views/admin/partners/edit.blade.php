@extends('layouts.app') @section('content')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-header">
                    <h5 class="mb-0">Edit Partner</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Partner Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $partner->name }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="url" name="link" class="form-control" value="{{ $partner->link }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Logo</label><br>
                            <img src="{{ $partner->imageUrl() }}" alt="Current Logo" style="max-height: 80px;" class="mb-2">
                            <input type="file" name="image" id="partnerImage" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 300×150px (transparent PNG preferred, max 2MB)</small>

                            <div id="imagePreviewContainer" class="mt-3" style="display:none;">
                                <p>New Logo Preview:</p>
                                <img id="preview" src="#" alt="New Logo" style="max-height: 100px; border: 1px solid #ddd; padding: 5px;">
                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="resetImage()">Cancel</button>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update Partner</button>
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
    document.getElementById('partnerImage').value = "";
    document.getElementById('imagePreviewContainer').style.display = 'none';
}

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
    document.getElementById('partnerImage').value = "";
    document.getElementById('imagePreviewContainer').style.display = 'none';
}
</script>
@endsection