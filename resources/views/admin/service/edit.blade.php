@extends('layouts.app')

@section('content')
    @php
        $details = old('details', $service->details->map(function ($detail) {
            return [
                'id' => $detail->id,
                'text' => $detail->text,
            ];
        })->values()->all());

        $solutions = old('solutions', $service->solutions->map(function ($solution) {
            return [
                'id' => $solution->id,
                'heading' => $solution->heading,
                'sub_heading' => $solution->sub_heading,
            ];
        })->values()->all());

        if (empty($details)) {
            $details = [['id' => null, 'text' => '']];
        }

        if (empty($solutions)) {
            $solutions = [['id' => null, 'heading' => '', 'sub_heading' => '']];
        }
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Service</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-12 col-xl-5">
                        <div class="card card-outline card-primary">
                            <div class="card-header"><h3 class="card-title">Service Information</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label">Heading</label>
                                        <input type="text" name="heading" value="{{ old('heading', $service->heading) }}" class="form-control @error('heading') is-invalid @enderror" placeholder="Trade Facilitation">
                                        @error('heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Design Word</label>
                                        <input type="text" name="design_word" value="{{ old('design_word', $service->design_word) }}" class="form-control @error('design_word') is-invalid @enderror" placeholder="Facilitation">
                                        @error('design_word')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Section Tag</label>
                                        <input type="text" name="section" value="{{ old('section', $service->section) }}" class="form-control @error('section') is-invalid @enderror" placeholder="WHAT WE DO">
                                        @error('section')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description <small class="text-muted">(shows on card &amp; hero)</small></label>
                                        <textarea name="description" class="form-control description-editor @error('description') is-invalid @enderror" rows="5" data-raw="1">{{ old('description', $service->description ?? '') }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Overview <small class="text-muted">(shows on details page body)</small></label>
                                        <textarea name="overview" class="form-control overview-editor" rows="6">{{ old('overview', $service->overview ?? '') }}</textarea>
                                        @error('overview')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="form-control @error('slug') is-invalid @enderror">
                                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Service Name</label>
                                        <input type="text" name="service_name" value="{{ old('service_name', $service->service_name) }}" class="form-control @error('service_name') is-invalid @enderror">
                                        @error('service_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="active" value="1" id="activeEdit" @checked(old('active', $service->active))>
                                            <label class="form-check-label" for="activeEdit">Active</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Service Image</label>
                                        <input type="hidden" name="remove_image" value="0" id="serviceRemoveImageInput">
                                        <input type="file" id="serviceImageInput" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" data-max-size="4096" data-max-width="800" data-max-height="600">
                                        @if($service->imageUrl())
                                            <div id="existingServiceImageWrap" class="mt-2 position-relative d-inline-block w-100">
                                                <img src="{{ $service->imageUrl() }}" alt="current service image" class="img-fluid rounded border" style="max-height:160px;width:100%;object-fit:cover;">
                                                <button type="button" id="removeServiceImageBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:26px;height:26px;font-size:14px;" title="Remove current image">&times;</button>
                                            </div>
                                        @endif
                                        <div id="serviceImagePreviewWrap" class="mt-2 d-none position-relative d-inline-block w-100">
                                            <img id="serviceImagePreview" src="" alt="Selected service image" class="img-fluid rounded border" style="max-height:160px;width:100%;object-fit:cover;">
                                            <button type="button" id="clearServiceImageBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:26px;height:26px;font-size:14px;" title="Remove selected image">&times;</button>
                                        </div>
                                        <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> Recommended: 800×600px (max 4MB)</small>
                                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Service Icon</label>
                                        <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*" data-max-size="2048" data-max-width="128" data-max-height="128">
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 128×128px square (max 2MB)</small>
                                        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @if($service->iconUrl())
                                            <img src="{{ $service->iconUrl() }}" alt="icon" class="mt-2" style="width: 50px; height: 50px; object-fit: contain;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-7">
                        <div class="card card-outline card-secondary mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Service Details</h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addDetailRow">Add Detail</button>
                            </div>
                            <div class="card-body">
                                <div id="detailsWrapper" class="d-grid gap-3">
                                    @foreach($details as $index => $detail)
                                        <div class="border rounded p-3 detail-row">
                                            <div class="row g-3 align-items-start">
                                                <div class="col-12">
                                                    <input type="hidden" name="details[{{ $index }}][id]" value="{{ $detail['id'] ?? '' }}">
                                                    <label class="form-label">Text</label>
                                                    <textarea name="details[{{ $index }}][text]" class="form-control detail-editor" rows="4">{{ $detail['text'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-md-10">
                                                    <label class="form-label">Icon Image</label>
                                                    <input type="file" name="details_icons[{{ $index }}]" class="form-control" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
                                                    @if(! empty($detail['id']))
                                                        @php $detailModel = $service->details->firstWhere('id', $detail['id']); @endphp
                                                        @if($detailModel?->iconUrl())
                                                            <img src="{{ $detailModel->iconUrl() }}" alt="icon" class="mt-2" style="width: 34px; height: 34px; object-fit: contain;">
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="col-md-2 d-grid">
                                                    <button type="button" class="btn btn-outline-danger remove-detail-row">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card card-outline card-secondary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Products & Solutions</h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addSolutionRow">Add Solution</button>
                            </div>
                            <div class="card-body">
                                <div id="solutionsWrapper" class="d-grid gap-3">
                                    @foreach($solutions as $index => $solution)
                                        <div class="border rounded p-3 solution-row">
                                            <div class="row g-3 align-items-start">
                                                <div class="col-12 col-md-6">
                                                    <input type="hidden" name="solutions[{{ $index }}][id]" value="{{ $solution['id'] ?? '' }}">
                                                    <label class="form-label">Heading</label>
                                                    <input type="text" name="solutions[{{ $index }}][heading]" value="{{ $solution['heading'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="form-label">Sub Heading</label>
                                                    <input type="text" name="solutions[{{ $index }}][sub_heading]" value="{{ $solution['sub_heading'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-12 d-grid d-md-flex justify-content-md-end">
                                                    <button type="button" class="btn btn-outline-danger remove-solution-row">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">Update Service</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <template id="detailRowTemplate">
        <div class="border rounded p-3 detail-row">
            <div class="row g-3 align-items-start">
                <div class="col-12">
                    <input type="hidden" name="__DETAIL_NAME__[id]" value="">
                    <label class="form-label">Text</label>
                    <textarea name="__DETAIL_NAME__[text]" class="form-control detail-editor" rows="4"></textarea>
                </div>
                <div class="col-md-10">
                    <label class="form-label">Icon Image</label>
                    <input type="file" name="__DETAIL_ICON_NAME__" class="form-control" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="button" class="btn btn-outline-danger remove-detail-row">Remove</button>
                </div>
            </div>
        </div>
    </template>

    <template id="solutionRowTemplate">
        <div class="border rounded p-3 solution-row">
            <div class="row g-3 align-items-start">
                <div class="col-12 col-md-6">
                    <input type="hidden" name="__SOLUTION_NAME__[id]" value="">
                    <label class="form-label">Heading</label>
                    <input type="text" name="__SOLUTION_NAME__[heading]" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Sub Heading</label>
                    <input type="text" name="__SOLUTION_NAME__[sub_heading]" class="form-control">
                </div>
                <div class="col-12 d-grid d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-danger remove-solution-row">Remove</button>
                </div>
            </div>
        </div>
    </template>
@endsection

@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
        const activeEditors = new Map();
        const form = document.querySelector('form[action*="admin/services-manager"]');
        const serviceImageInput = document.getElementById('serviceImageInput');
        const serviceImagePreviewWrap = document.getElementById('serviceImagePreviewWrap');
        const serviceImagePreview = document.getElementById('serviceImagePreview');
        const clearServiceImageBtn = document.getElementById('clearServiceImageBtn');
        const removeServiceImageBtn = document.getElementById('removeServiceImageBtn');
        const serviceRemoveImageInput = document.getElementById('serviceRemoveImageInput');

        function renderServiceImagePreview() {
            if (!serviceImageInput || !serviceImagePreviewWrap || !serviceImagePreview) return;
            const existingWrap = document.getElementById('existingServiceImageWrap');

            if (!serviceImageInput.files || serviceImageInput.files.length === 0) {
                serviceImagePreviewWrap.classList.add('d-none');
                serviceImagePreview.src = '';
                if (existingWrap) existingWrap.classList.remove('d-none');
                return;
            }

            const file = serviceImageInput.files[0];
            serviceImagePreview.src = URL.createObjectURL(file);
            serviceImagePreviewWrap.classList.remove('d-none');
            if (existingWrap) existingWrap.classList.add('d-none');
        }

        if (serviceImageInput) {
            serviceImageInput.addEventListener('change', renderServiceImagePreview);
        }

        if (clearServiceImageBtn) {
            clearServiceImageBtn.addEventListener('click', function () {
                serviceImageInput.value = '';
                serviceImagePreviewWrap.classList.add('d-none');
                serviceImagePreview.src = '';
                const existingWrap = document.getElementById('existingServiceImageWrap');
                if (existingWrap) existingWrap.classList.remove('d-none');
            });
        }

        if (removeServiceImageBtn && serviceRemoveImageInput) {
            removeServiceImageBtn.addEventListener('click', function () {
                serviceRemoveImageInput.value = '1';
                const wrap = document.getElementById('existingServiceImageWrap');
                if (wrap) wrap.remove();
            });
        }

        function initEditors() {
            document.querySelectorAll('.overview-editor, .detail-editor, .description-editor').forEach(function (element) {
                if (element.dataset.editorReady) {
                    return;
                }
                element.dataset.editorReady = '1';
                ClassicEditor.create(element)
                    .then(editor => {
                        activeEditors.set(element, editor);
                    })
                    .catch(function (error) { console.error(error); });
            });
        }

        initEditors();

        if (form) {
            form.addEventListener('submit', function () {
                activeEditors.forEach(function (editor, textarea) {
                    textarea.value = editor.getData();
                });
            });
        }

        const detailWrapper = document.getElementById('detailsWrapper');
        const solutionWrapper = document.getElementById('solutionsWrapper');
        const detailTemplate = document.getElementById('detailRowTemplate');
        const solutionTemplate = document.getElementById('solutionRowTemplate');

        document.getElementById('addDetailRow').addEventListener('click', function () {
            const index = detailWrapper.querySelectorAll('.detail-row').length;
            const html = detailTemplate.innerHTML
                .replaceAll('__DETAIL_NAME__', `details[${index}]`)
                .replaceAll('__DETAIL_ICON_NAME__', `details_icons[${index}]`);
            detailWrapper.insertAdjacentHTML('beforeend', html);
            initEditors();
        });

        document.getElementById('addSolutionRow').addEventListener('click', function () {
            const index = solutionWrapper.querySelectorAll('.solution-row').length;
            const html = solutionTemplate.innerHTML.replaceAll('__SOLUTION_NAME__', `solutions[${index}]`);
            solutionWrapper.insertAdjacentHTML('beforeend', html);
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-detail-row')) {
                const row = event.target.closest('.detail-row');
                const textarea = row ? row.querySelector('.detail-editor') : null;

                if (textarea && activeEditors.has(textarea)) {
                    activeEditors.get(textarea).destroy();
                    activeEditors.delete(textarea);
                }

                if (row) {
                    row.remove();
                }
            }
            if (event.target.classList.contains('remove-solution-row')) {
                event.target.closest('.solution-row').remove();
            }
        });
});
</script>
@endpush