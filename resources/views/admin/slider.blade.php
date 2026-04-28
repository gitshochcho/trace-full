@extends('layouts.app')

@section('content')
    @php
        $sliderMedias = $slider?->getMedia('slider_images') ?? collect();
    @endphp

    {{-- ... header and breadcrumb sections remain same ... --}}

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-10">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Home Hero Slider Content</h3>
                        </div>
                        <form action="{{ route('admin.slider.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Tagline</label>
                                        {{-- Default text সরানো হয়েছে --}}
                                        <input type="text" name="tagline" value="{{ old('tagline', $slider->tagline ?? '') }}" 
                                               placeholder="Enter tagline..."
                                               class="form-control @error('tagline') is-invalid @enderror">
                                        @error('tagline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Design Word (Span Text)</label>
                                        {{-- Default text সরানো হয়েছে --}}
                                        <input type="text" name="design_word" value="{{ old('design_word', $slider->design_word ?? '') }}" 
                                               placeholder="e.g. Insightful"
                                               class="form-control @error('design_word') is-invalid @enderror">
                                        @error('design_word')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Title</label>
                                        {{-- Default text সরানো হয়েছে --}}
                                        <input type="text" name="title" value="{{ old('title', $slider->title ?? '') }}" 
                                               placeholder="Enter slider title..."
                                               class="form-control @error('title') is-invalid @enderror">
                                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <div class="form-text">`design_word` will be highlighted in the title automatically.</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        {{-- Default text সরানো হয়েছে --}}
                                        <textarea id="slider_description" name="description" rows="6" 
                                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $slider->description ?? '') }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    {{-- ... Slider images logic and JS remains the same as before ... --}}
                                    <div class="col-12">
                                        <label class="form-label">Slider Images (Multiple)</label>
                                        <input id="slider_images_input" type="file" name="slider_images[]" multiple class="form-control @error('slider_images') is-invalid @enderror" accept="image/*" data-max-size="4096" data-max-width="1920" data-max-height="800">
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 1920×800px wide banner (max 4MB each)</small>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div id="removedImageIdsContainer"></div>
                                        <div id="existingImagesGrid" class="slider-images-grid mb-3">
                                            @foreach($sliderMedias as $media)
                                                <div class="slider-image-card" data-existing-media-id="{{ $media->id }}">
                                                    <img src="{{ $media->getUrl() }}" class="slider-image-thumb">
                                                    <div class="slider-image-overlay">
                                                        <button type="button" class="btn btn-sm btn-light add-more-on-card">+ Add</button>
                                                        <button type="button" class="btn btn-sm btn-danger remove-existing-image">Delete</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div id="newImagesGrid" class="slider-images-grid"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Slider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    (function () {
        const descriptionField = document.querySelector('#slider_description');
        const fileInput = document.querySelector('#slider_images_input');
        const existingImagesGrid = document.querySelector('#existingImagesGrid');
        const newImagesGrid = document.querySelector('#newImagesGrid');
        const removedImageIdsContainer = document.querySelector('#removedImageIdsContainer');
        let selectedFiles = [];

        // CKEditor Initialization
        if (descriptionField) {
            ClassicEditor.create(descriptionField).catch(error => console.error(error));
        }

        // Sync File Input with JavaScript Array
        function syncFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        }

        function createFileKey(file) {
            return [file.name, file.size, file.lastModified].join('__');
        }

        // Render Preview for New Files
        function renderNewImagesPreview() {
            newImagesGrid.innerHTML = '';
            selectedFiles.forEach((file, index) => {
                const card = document.createElement('div');
                card.className = 'slider-image-card';
                
                const img = document.createElement('img');
                img.className = 'slider-image-thumb';
                img.src = URL.createObjectURL(file);

                const overlay = document.createElement('div');
                overlay.className = 'slider-image-overlay';

                const addBtn = document.createElement('button');
                addBtn.type = 'button';
                addBtn.className = 'btn btn-sm btn-light add-more-on-card';
                addBtn.textContent = '+ Add';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-sm btn-danger remove-new-image';
                removeBtn.dataset.index = index;
                removeBtn.textContent = 'Cancel';

                overlay.appendChild(addBtn);
                overlay.appendChild(removeBtn);
                card.appendChild(img);
                card.appendChild(overlay);
                newImagesGrid.appendChild(card);
            });
        }

        // Handle File Selection
        fileInput.addEventListener('change', function (e) {
            const files = Array.from(e.target.files);
            const existingKeys = new Set(selectedFiles.map(createFileKey));

            files.forEach(file => {
                const key = createFileKey(file);
                if (!existingKeys.has(key)) {
                    selectedFiles.push(file);
                }
            });

            syncFileInput();
            renderNewImagesPreview();
        });

        // Event Delegation for All Buttons
        document.addEventListener('click', function (e) {
            // 1. Add More Button (Trigger file input)
            if (e.target.classList.contains('add-more-on-card')) {
                fileInput.click();
            }

            // 2. Remove Existing Image (From Server/Database)
            if (e.target.classList.contains('remove-existing-image')) {
                const card = e.target.closest('.slider-image-card');
                const mediaId = card.dataset.existingMediaId;

                if (mediaId) {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'removed_image_ids[]';
                    hidden.value = mediaId;
                    removedImageIdsContainer.appendChild(hidden);
                    card.remove();
                }
            }

            // 3. Remove Newly Selected Image (Before Upload)
            if (e.target.classList.contains('remove-new-image')) {
                const index = e.target.dataset.index;
                selectedFiles.splice(index, 1);
                syncFileInput();
                renderNewImagesPreview();
            }
        });

    })();
</script>

<style>
    .slider-images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 12px;
    }

    .slider-image-card {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        height: 120px;
        background: #f8fafc;
    }

    .slider-image-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slider-image-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        opacity: 0;
        transition: opacity .2s ease;
    }

    .slider-image-card:hover .slider-image-overlay {
        opacity: 1;
    }
</style>
@endpush