@extends('layouts.app')

@section('content')
    @php
        $sliderMedias = $slider?->getMedia('slider_images') ?? collect();
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Home Slider</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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
                                        <input type="text" name="tagline" value="{{ old('tagline', $slider->tagline ?? 'INTERNATIONAL DEVELOPMENT CONSULTING') }}" class="form-control @error('tagline') is-invalid @enderror">
                                        @error('tagline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Design Word (Span Text)</label>
                                        <input type="text" name="design_word" value="{{ old('design_word', $slider->design_word ?? 'Insightful') }}" class="form-control @error('design_word') is-invalid @enderror">
                                        @error('design_word')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" value="{{ old('title', $slider->title ?? 'Empowering Change through Consulting') }}" class="form-control @error('title') is-invalid @enderror">
                                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <div class="form-text">`design_word` will be highlighted in the title automatically.</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea id="slider_description" name="description" rows="6" class="form-control @error('description') is-invalid @enderror">{{ old('description', $slider->description ?? 'Trace Consulting partners with governments, regulatory agencies, and development organizations to reform systems, build capacity, and deliver technology that lasts.') }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Slider Images (Multiple)</label>
                                        <input id="slider_images_input" type="file" name="slider_images[]" multiple class="form-control @error('slider_images') is-invalid @enderror @error('slider_images.*') is-invalid @enderror" accept="image/*">
                                        @error('slider_images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @error('slider_images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <div class="form-text">You can select multiple files together (Ctrl/Shift + select), and select again to keep adding more images.</div>
                                    </div>

                                    <div class="col-12">
                                        <input type="hidden" name="removed_image_ids[]" id="removed_image_ids_template" disabled>
                                        <div id="removedImageIdsContainer"></div>

                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label class="form-label mb-0">Current Images</label>
                                            {{-- <button type="button" id="addMoreImageBtn" class="btn btn-sm btn-outline-primary">+ Add More Image</button> --}}
                                        </div>

                                        <div id="existingImagesGrid" class="slider-images-grid mb-3">
                                            @forelse($sliderMedias as $media)
                                                <div class="slider-image-card" data-existing-media-id="{{ $media->id }}">
                                                    <img src="{{ $media->getUrl() }}" alt="Slider image" class="slider-image-thumb">
                                                    <div class="slider-image-overlay">
                                                        <button type="button" class="btn btn-sm btn-light add-more-on-card">+ Add</button>
                                                        <button type="button" class="btn btn-sm btn-danger remove-existing-image">Cancel</button>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-muted small mb-0">No slider image uploaded yet.</p>
                                            @endforelse
                                        </div>

                                        {{-- <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label class="form-label mb-0">Newly Selected Images</label>
                                            <small class="text-muted">You can remove selected files before save.</small>
                                        </div> --}}
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
        const addMoreBtn = document.querySelector('#addMoreImageBtn');
        const existingImagesGrid = document.querySelector('#existingImagesGrid');
        const newImagesGrid = document.querySelector('#newImagesGrid');
        const removedImageIdsContainer = document.querySelector('#removedImageIdsContainer');
        const selectedFiles = [];

        if (!descriptionField) {
            return;
        }

        ClassicEditor.create(descriptionField).catch(function (error) {
            console.error(error);
        });

        if (!fileInput) {
            return;
        }

        function syncFileInputFromSelectedFiles() {
            const dt = new DataTransfer();

            selectedFiles.forEach(function (file) {
                dt.items.add(file);
            });

            fileInput.files = dt.files;
        }

        function createFileKey(file) {
            return [file.name, file.size, file.lastModified].join('__');
        }

        function renderNewImagesPreview() {
            newImagesGrid.innerHTML = '';

            if (!selectedFiles.length) {
                const emptyState = document.createElement('p');
                emptyState.className = 'text-muted small mb-0';
                emptyState.textContent = 'No new image selected.';
                newImagesGrid.appendChild(emptyState);
                return;
            }

            selectedFiles.forEach(function (file, index) {
                const card = document.createElement('div');
                card.className = 'slider-image-card';
                card.dataset.fileIndex = String(index);

                const img = document.createElement('img');
                img.className = 'slider-image-thumb';
                img.alt = file.name;
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
                removeBtn.textContent = 'Cancel';

                overlay.appendChild(addBtn);
                overlay.appendChild(removeBtn);

                card.appendChild(img);
                card.appendChild(overlay);
                newImagesGrid.appendChild(card);
            });
        }

        function appendRemovedImageId(mediaId) {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'removed_image_ids[]';
            hidden.value = String(mediaId);
            removedImageIdsContainer.appendChild(hidden);
        }

        fileInput.addEventListener('change', function (event) {
            const files = Array.from(event.target.files || []);
            const existingKeys = new Set(selectedFiles.map(createFileKey));

            files.forEach(function (file) {
                const key = createFileKey(file);

                if (!existingKeys.has(key)) {
                    selectedFiles.push(file);
                    existingKeys.add(key);
                }
            });

            syncFileInputFromSelectedFiles();
            renderNewImagesPreview();
        });

        addMoreBtn.addEventListener('click', function () {
            fileInput.click();
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('add-more-on-card')) {
                fileInput.click();
                return;
            }

            if (event.target.classList.contains('remove-existing-image')) {
                const card = event.target.closest('.slider-image-card');
                const mediaId = card ? card.dataset.existingMediaId : null;

                if (mediaId) {
                    appendRemovedImageId(mediaId);
                    card.remove();
                }
                return;
            }

            if (event.target.classList.contains('remove-new-image')) {
                const card = event.target.closest('.slider-image-card');
                const fileIndex = card ? Number(card.dataset.fileIndex) : -1;

                if (fileIndex > -1) {
                    selectedFiles.splice(fileIndex, 1);
                    syncFileInputFromSelectedFiles();
                    renderNewImagesPreview();
                }
            }
        });

        renderNewImagesPreview();
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
        min-height: 120px;
        background: #f8fafc;
    }

    .slider-image-thumb {
        width: 100%;
        height: 120px;
        object-fit: cover;
        display: block;
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