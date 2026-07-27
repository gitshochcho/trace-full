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
                            <input type="hidden" name="remove_image" value="0" id="removeImageInput">
                            @if($partner->imageUrl())
                                <div class="mb-2 position-relative d-inline-block" id="existingImageWrap">
                                    <img src="{{ $partner->imageUrl() }}" alt="Current Logo" style="max-height: 80px;">
                                    <button type="button" id="removeImageBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:22px;height:22px;font-size:12px;" title="Remove current logo">&times;</button>
                                </div>
                            @endif
                            <input type="file" name="image" id="partnerImage" class="form-control" accept="image/*" onchange="previewImage(this)" data-max-size="2048" data-max-width="300" data-max-height="150">
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
        var removeImageInput = document.getElementById('removeImageInput');
        if (removeImageInput) removeImageInput.value = '0';
    }
}

function resetImage() {
    document.getElementById('partnerImage').value = "";
    document.getElementById('imagePreviewContainer').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    var removeImageBtn = document.getElementById('removeImageBtn');
    var removeImageInput = document.getElementById('removeImageInput');

    if (removeImageBtn && removeImageInput) {
        removeImageBtn.addEventListener('click', function () {
            removeImageInput.value = '1';
            var wrap = document.getElementById('existingImageWrap');
            if (wrap) wrap.remove();
        });
    }
});
</script>
@endsection