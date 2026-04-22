@extends('layouts.app') @section('content')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-header">
                    <h5 class="mb-0">Add New Partner</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Partner Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter partner name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Link (Optional)</label>
                            <input type="url" name="link" class="form-control" placeholder="https://example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (Optional)</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Partner Logo</label>
                            <input type="file" name="image" id="partnerImage" class="form-control" accept="image/*" onchange="previewImage(this)" required>
                            
                            <div id="imagePreviewContainer" class="mt-3" style="display:none;">
                                <img id="preview" src="#" alt="Logo Preview" style="max-height: 100px; border: 1px solid #ddd; padding: 5px;">
                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="resetImage()">Cancel</button>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save Partner</button>
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
</script>
@endsection