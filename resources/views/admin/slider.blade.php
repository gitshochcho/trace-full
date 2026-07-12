@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0">Home Hero Slider</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Hero Slider</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="{{ route('admin.slider.update') }}" method="POST" enctype="multipart/form-data" id="sliderForm">
            @csrf
            <div id="removedItemIdsContainer"></div>

            <div class="card card-outline card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Slider Items</h3>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addSliderItemBtn">
                        <i class="fas fa-plus me-1"></i> Add More Slide
                    </button>
                </div>
                <div class="card-body">
                    <div id="sliderItemsWrapper" class="d-grid gap-4">

                        @forelse($items as $index => $item)
                        <div class="slider-item-row border rounded-3 p-4 bg-white shadow-sm" data-index="{{ $index }}">
                            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">

                            <div class="row g-3">
                                {{-- Image --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Slide Image</label>
                                    <div class="image-preview-wrap mb-2">
                                        @if($item->imageUrl())
                                            <img src="{{ $item->imageUrl() }}" class="img-thumbnail w-100 slide-preview-img" style="height:160px;object-fit:cover;" alt="Slide">
                                        @else
                                            <div class="img-thumbnail w-100 d-flex align-items-center justify-content-center text-muted slide-preview-img" style="height:160px;background:#f8f9fa;font-size:13px;">No image</div>
                                        @endif
                                    </div>
                                    @if($item->imageUrl())
                                    <div class="mb-2">
                                        <label class="d-flex align-items-center gap-1 small text-danger" style="cursor:pointer;">
                                            <input type="checkbox" name="remove_image[]" value="{{ $item->id }}" class="form-check-input mt-0">
                                            Remove image
                                        </label>
                                    </div>
                                    @endif
                                    <input type="file" name="item_images[{{ $index }}]" class="form-control form-control-sm item-image-input"
                                           accept="image/jpeg,image/png,image/webp,image/svg+xml">
                                    <small class="text-muted">1920×800px recommended (max 4MB)</small>
                                </div>

                                {{-- Text Fields --}}
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Tagline</label>
                                            <input type="text" name="items[{{ $index }}][tagline]"
                                                   value="{{ old("items.$index.tagline", $item->tagline) }}"
                                                   class="form-control" placeholder="e.g. INSIGHTS & ANALYTICS">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Design Word <span class="text-muted small">(highlighted in title)</span></label>
                                            <input type="text" name="items[{{ $index }}][design_word]"
                                                   value="{{ old("items.$index.design_word", $item->design_word) }}"
                                                   class="form-control" placeholder="e.g. Insightful">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="items[{{ $index }}][title]"
                                                   value="{{ old("items.$index.title", $item->title) }}"
                                                   class="form-control" placeholder="Slide title...">
                                            <small class="text-muted">The Design Word inside the title will be highlighted automatically.</small>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold">
                                                Background Video
                                                <span class="text-muted fw-normal small">(MP4/WebM, max 100MB — overrides image if set)</span>
                                            </label>
                                            @if($item->videoUrl())
                                            <div class="mb-2 d-flex align-items-center gap-3 p-2 border rounded bg-light">
                                                <video src="{{ $item->videoUrl() }}" style="height:60px;width:100px;object-fit:cover;border-radius:4px;" muted></video>
                                                <div class="flex-grow-1 small text-muted">Video uploaded</div>
                                                <label class="d-flex align-items-center gap-1 small text-danger" style="cursor:pointer;">
                                                    <input type="checkbox" name="remove_video[]" value="{{ $item->id }}" class="form-check-input mt-0">
                                                    Remove video
                                                </label>
                                            </div>
                                            @endif
                                            <input type="file" name="item_videos[{{ $index }}]"
                                                   class="form-control form-control-sm"
                                                   accept="video/mp4,video/webm,video/quicktime">
                                            <small class="text-muted">Leave empty to keep existing video. Leave both empty to use the image.</small>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <textarea name="items[{{ $index }}][description]"
                                                      class="form-control item-description-editor"
                                                      id="itemDesc_{{ $index }}"
                                                      rows="3">{{ old("items.$index.description", $item->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-slider-item">
                                        <i class="fas fa-trash me-1"></i> Remove Slide
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-muted text-center py-4" id="emptyNotice">
                            No slides yet. Click <strong>Add More Slide</strong> to add your first slide.
                        </div>
                        @endforelse

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-primary" id="addSliderItemBtnFooter">
                        <i class="fas fa-plus me-1"></i> Add More Slide
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save All Slides
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<template id="sliderItemTemplate">
    <div class="slider-item-row border rounded-3 p-4 bg-white shadow-sm" data-index="__INDEX__">
        <input type="hidden" name="items[__INDEX__][id]" value="">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Slide Image</label>
                <div class="image-preview-wrap mb-2">
                    <div class="img-thumbnail w-100 d-flex align-items-center justify-content-center text-muted slide-preview-img" style="height:160px;background:#f8f9fa;font-size:13px;">No image</div>
                </div>
                <input type="file" name="item_images[__INDEX__]" class="form-control form-control-sm item-image-input"
                       accept="image/jpeg,image/png,image/webp,image/svg+xml">
                <small class="text-muted">1920×800px recommended (max 4MB)</small>
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tagline</label>
                        <input type="text" name="items[__INDEX__][tagline]" class="form-control" placeholder="e.g. INSIGHTS & ANALYTICS">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Design Word <span class="text-muted small">(highlighted in title)</span></label>
                        <input type="text" name="items[__INDEX__][design_word]" class="form-control" placeholder="e.g. Insightful">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Title</label>
                        <input type="text" name="items[__INDEX__][title]" class="form-control" placeholder="Slide title...">
                        <small class="text-muted">The Design Word inside the title will be highlighted automatically.</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">
                            Background Video
                            <span class="text-muted fw-normal small">(MP4/WebM, max 100MB — overrides image if set)</span>
                        </label>
                        <input type="file" name="item_videos[__INDEX__]"
                               class="form-control form-control-sm"
                               accept="video/mp4,video/webm,video/quicktime">
                        <small class="text-muted">Leave empty to use the image above.</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="items[__INDEX__][description]" class="form-control item-description-editor"
                                  id="itemDesc___INDEX__" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-outline-danger remove-slider-item">
                    <i class="fas fa-trash me-1"></i> Remove Slide
                </button>
            </div>
        </div>
    </div>
</template>
@endsection

@push('custome-css')
<style>
.slider-item-row { border-left: 4px solid #0d6efd !important; }
.slider-item-row:nth-child(2n) { border-left-color: #0f766e !important; }
</style>
@endpush

@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const wrapper          = document.getElementById('sliderItemsWrapper');
    const tpl              = document.getElementById('sliderItemTemplate');
    const removedContainer = document.getElementById('removedItemIdsContainer');
    const emptyNotice      = document.getElementById('emptyNotice');
    const form             = document.getElementById('sliderForm');
    const ckEditors        = {};

    function getNextIndex() {
        const rows = wrapper.querySelectorAll('.slider-item-row');
        return rows.length;
    }

    function reindex() {
        wrapper.querySelectorAll('.slider-item-row').forEach((row, idx) => {
            row.dataset.index = idx;
            row.querySelectorAll('input, textarea').forEach(f => {
                if (f.name) {
                    f.name = f.name.replace(/items\[\d+\]/, `items[${idx}]`);
                    f.name = f.name.replace(/item_images\[\d+\]/, `item_images[${idx}]`);
                }
                if (f.tagName === 'TEXTAREA') {
                    const oldId = f.id;
                    f.id = `itemDesc_${idx}`;
                    if (ckEditors[oldId]) {
                        ckEditors[`itemDesc_${idx}`] = ckEditors[oldId];
                        delete ckEditors[oldId];
                    }
                }
            });
        });
        if (emptyNotice) emptyNotice.style.display = wrapper.querySelectorAll('.slider-item-row').length ? 'none' : '';
    }

    function initCKEditor(textarea) {
        if (!textarea || ckEditors[textarea.id]) return;
        ClassicEditor.create(textarea, {
            toolbar: { items: ['bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', '|', 'undo', 'redo'] }
        }).then(editor => {
            ckEditors[textarea.id] = editor;
            editor.editing.view.document.on('keydown', function (evt, data) {
                if (data.domEvent.key === 'Enter' && !data.domEvent.shiftKey) {
                    evt.stop();
                    data.preventDefault();
                    editor.execute('shiftEnter');
                }
            }, { priority: 'high' });
        }).catch(console.error);
    }

    // Init CKEditor on existing rows
    document.querySelectorAll('textarea.item-description-editor').forEach(initCKEditor);

    // Image preview on file change
    wrapper.addEventListener('change', function (e) {
        if (e.target.classList.contains('item-image-input')) {
            const file = e.target.files[0];
            if (!file) return;
            const wrap = e.target.closest('.slider-item-row').querySelector('.image-preview-wrap');
            const reader = new FileReader();
            reader.onload = ev => {
                wrap.innerHTML = `<img src="${ev.target.result}" class="img-thumbnail w-100 slide-preview-img" style="height:160px;object-fit:cover;" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        }
    });

    function addRow() {
        const idx = getNextIndex();
        const html = tpl.innerHTML.replaceAll('__INDEX__', idx);
        if (emptyNotice) emptyNotice.style.display = 'none';
        wrapper.insertAdjacentHTML('beforeend', html);
        reindex();
        const ta = document.getElementById(`itemDesc_${idx}`);
        setTimeout(() => initCKEditor(ta), 100);
    }

    document.getElementById('addSliderItemBtn').addEventListener('click', addRow);
    document.getElementById('addSliderItemBtnFooter').addEventListener('click', addRow);

    wrapper.addEventListener('click', function (e) {
        if (e.target.closest('.remove-slider-item')) {
            const row = e.target.closest('.slider-item-row');
            const idInput = row.querySelector('input[type="hidden"]');
            const existingId = idInput?.value;

            if (existingId) {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'removed_item_ids[]';
                hidden.value = existingId;
                removedContainer.appendChild(hidden);
            }

            const ta = row.querySelector('textarea.item-description-editor');
            if (ta && ckEditors[ta.id]) {
                ckEditors[ta.id].destroy();
                delete ckEditors[ta.id];
            }

            row.remove();
            reindex();
        }
    });

    // Sync CKEditor data before submit
    form.addEventListener('submit', function () {
        Object.values(ckEditors).forEach(editor => {
            if (editor.sourceElement) editor.sourceElement.value = editor.getData();
        });
    });
});
</script>
@endpush