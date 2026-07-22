@extends('layouts.app')

@push('custome-css')
<style>
    .icon-wrap-hidden { display: none !important; }
</style>
@endpush

@section('content')
    @php
        $details = old('details', $service->details->map(function ($detail) {
            return [
                'id' => $detail->id,
                'text' => $detail->text,
            ];
        })->values()->all());

        $heroPillars = old('hero_pillars', $service->heroPillars->map(function ($pillar) {
            return [
                'id'          => $pillar->id,
                'title'       => $pillar->title,
                'description' => $pillar->description,
                'icon_url'    => $pillar->iconUrl(),
            ];
        })->values()->all());

        if (empty($heroPillars)) {
            $heroPillars = [['id' => null, 'title' => '', 'description' => '', 'icon_url' => null]];
        }

        $solutions = old('solutions', $service->solutions->map(function ($solution) {
            return [
                'id'          => $solution->id,
                'heading'     => $solution->heading,
                'sub_heading' => $solution->sub_heading,
                'icon_url'    => $solution->iconUrl(),
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
                                        <textarea name="overview" class="form-control overview-editor" rows="6">{!! nl2br(e(old('overview', $service->overview ?? ''))) !!}</textarea>
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
                        <div class="card card-outline card-warning mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Hero Pillars <small class="text-muted fw-normal">(shows below hero image)</small></h3>
                                <button type="button" class="btn btn-sm btn-outline-warning" id="addPillarRow">Add Pillar</button>
                            </div>
                            <div class="card-body">
                                <div id="pillarsWrapper" class="d-grid gap-3">
                                    @foreach($heroPillars as $index => $pillar)
                                    <div class="border rounded p-3 pillar-row">
                                        <div class="row g-3 align-items-start">
                                            <div class="col-12 col-md-5">
                                                <input type="hidden" name="hero_pillars[{{ $index }}][id]" value="{{ $pillar['id'] ?? '' }}">
                                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                                <input type="text" name="hero_pillars[{{ $index }}][title]" value="{{ $pillar['title'] ?? '' }}" class="form-control" placeholder="BETTER POLICIES">
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <label class="form-label">Description</label>
                                                <input type="text" name="hero_pillars[{{ $index }}][description]" value="{{ $pillar['description'] ?? '' }}" class="form-control" placeholder="Evidence-based and inclusive">
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <label class="form-label">Icon Image</label>
                                                <input type="hidden" name="hero_pillars[{{ $index }}][remove_icon]" value="0" class="remove-icon-input">
                                                <input type="file" name="hero_pillars_icons[{{ $index }}]" class="form-control icon-file-input" accept="image/*" data-max-size="2048">
                                                <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
                                                <div class="mt-2 position-relative d-inline-block existing-icon-wrap {{ empty($pillar['icon_url']) ? 'icon-wrap-hidden' : '' }}" data-saved-icon-url="{{ $pillar['icon_url'] ?? '' }}">
                                                    <img src="{{ $pillar['icon_url'] ?? '' }}" alt="icon" style="width: 34px; height: 34px; object-fit: contain;">
                                                    <button type="button" class="btn btn-danger btn-sm remove-icon-btn position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:18px;height:18px;font-size:11px;line-height:1;" title="Remove icon">&times;</button>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2 d-grid">
                                                <button type="button" class="btn btn-outline-danger remove-pillar-row">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

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
                                                    <input type="hidden" name="details[{{ $index }}][remove_icon]" value="0" class="remove-icon-input">
                                                    <input type="file" name="details_icons[{{ $index }}]" class="form-control icon-file-input" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
                                                    @php
                                                        $detailModel = ! empty($detail['id']) ? $service->details->firstWhere('id', $detail['id']) : null;
                                                        $detailIconUrl = $detailModel?->iconUrl();
                                                    @endphp
                                                    <div class="mt-2 position-relative d-inline-block existing-icon-wrap {{ empty($detailIconUrl) ? 'icon-wrap-hidden' : '' }}" data-saved-icon-url="{{ $detailIconUrl ?? '' }}">
                                                        <img src="{{ $detailIconUrl ?? '' }}" alt="icon" style="width: 34px; height: 34px; object-fit: contain;">
                                                        <button type="button" class="btn btn-danger btn-sm remove-icon-btn position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:18px;height:18px;font-size:11px;line-height:1;" title="Remove icon">&times;</button>
                                                    </div>
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
                                                <div class="col-12 col-md-5">
                                                    <input type="hidden" name="solutions[{{ $index }}][id]" value="{{ $solution['id'] ?? '' }}">
                                                    <label class="form-label">Heading</label>
                                                    <input type="text" name="solutions[{{ $index }}][heading]" value="{{ $solution['heading'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <label class="form-label">Sub Heading <small class="text-muted">(description)</small></label>
                                                    <input type="text" name="solutions[{{ $index }}][sub_heading]" value="{{ $solution['sub_heading'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <label class="form-label">Icon Image</label>
                                                    <input type="hidden" name="solutions[{{ $index }}][remove_icon]" value="0" class="remove-icon-input">
                                                    <input type="file" name="solutions_icons[{{ $index }}]" class="form-control icon-file-input" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
                                                    <div class="mt-2 position-relative d-inline-block existing-icon-wrap {{ empty($solution['icon_url']) ? 'icon-wrap-hidden' : '' }}" data-saved-icon-url="{{ $solution['icon_url'] ?? '' }}">
                                                        <img src="{{ $solution['icon_url'] ?? '' }}" alt="icon" style="width: 34px; height: 34px; object-fit: contain;">
                                                        <button type="button" class="btn btn-danger btn-sm remove-icon-btn position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:18px;height:18px;font-size:11px;line-height:1;" title="Remove icon">&times;</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2 d-grid">
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

    <template id="pillarRowTemplate">
        <div class="border rounded p-3 pillar-row">
            <div class="row g-3 align-items-start">
                <div class="col-12 col-md-5">
                    <input type="hidden" name="__PILLAR_NAME__[id]" value="">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="__PILLAR_NAME__[title]" class="form-control" placeholder="BETTER POLICIES">
                </div>
                <div class="col-12 col-md-5">
                    <label class="form-label">Description</label>
                    <input type="text" name="__PILLAR_NAME__[description]" class="form-control" placeholder="Evidence-based and inclusive">
                </div>
                <div class="col-12 col-md-10">
                    <label class="form-label">Icon Image</label>
                    <input type="hidden" name="__PILLAR_NAME__[remove_icon]" value="0" class="remove-icon-input">
                    <input type="file" name="__PILLAR_ICON_NAME__" class="form-control icon-file-input" accept="image/*" data-max-size="2048">
                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
                    <div class="mt-2 position-relative d-inline-block existing-icon-wrap icon-wrap-hidden" data-saved-icon-url="">
                        <img src="" alt="icon" style="width: 34px; height: 34px; object-fit: contain;">
                        <button type="button" class="btn btn-danger btn-sm remove-icon-btn position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:18px;height:18px;font-size:11px;line-height:1;" title="Remove icon">&times;</button>
                    </div>
                </div>
                <div class="col-12 col-md-2 d-grid">
                    <button type="button" class="btn btn-outline-danger remove-pillar-row">Remove</button>
                </div>
            </div>
        </div>
    </template>

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
                    <input type="hidden" name="__DETAIL_NAME__[remove_icon]" value="0" class="remove-icon-input">
                    <input type="file" name="__DETAIL_ICON_NAME__" class="form-control icon-file-input" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
                    <div class="mt-2 position-relative d-inline-block existing-icon-wrap icon-wrap-hidden" data-saved-icon-url="">
                        <img src="" alt="icon" style="width: 34px; height: 34px; object-fit: contain;">
                        <button type="button" class="btn btn-danger btn-sm remove-icon-btn position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:18px;height:18px;font-size:11px;line-height:1;" title="Remove icon">&times;</button>
                    </div>
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
                <div class="col-12 col-md-5">
                    <input type="hidden" name="__SOLUTION_NAME__[id]" value="">
                    <label class="form-label">Heading</label>
                    <input type="text" name="__SOLUTION_NAME__[heading]" class="form-control">
                </div>
                <div class="col-12 col-md-5">
                    <label class="form-label">Sub Heading <small class="text-muted">(description)</small></label>
                    <input type="text" name="__SOLUTION_NAME__[sub_heading]" class="form-control">
                </div>
                <div class="col-12 col-md-10">
                    <label class="form-label">Icon Image</label>
                    <input type="hidden" name="__SOLUTION_NAME__[remove_icon]" value="0" class="remove-icon-input">
                    <input type="file" name="__SOLUTION_ICON_NAME__" class="form-control icon-file-input" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
                    <div class="mt-2 position-relative d-inline-block existing-icon-wrap icon-wrap-hidden" data-saved-icon-url="">
                        <img src="" alt="icon" style="width: 34px; height: 34px; object-fit: contain;">
                        <button type="button" class="btn btn-danger btn-sm remove-icon-btn position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:18px;height:18px;font-size:11px;line-height:1;" title="Remove icon">&times;</button>
                    </div>
                </div>
                <div class="col-12 col-md-2 d-grid">
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
                        editor.editing.view.document.on('keydown', function (evt, data) {
                            if (data.domEvent.key === 'Enter' && !data.domEvent.shiftKey) {
                                evt.stop();
                                data.preventDefault();
                                editor.execute('shiftEnter');
                            }
                        }, { priority: 'high' });
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

        const pillarWrapper   = document.getElementById('pillarsWrapper');
        const pillarTemplate  = document.getElementById('pillarRowTemplate');
        const detailWrapper   = document.getElementById('detailsWrapper');
        const solutionWrapper = document.getElementById('solutionsWrapper');
        const detailTemplate  = document.getElementById('detailRowTemplate');
        const solutionTemplate = document.getElementById('solutionRowTemplate');

        document.getElementById('addPillarRow').addEventListener('click', function () {
            const index = pillarWrapper.querySelectorAll('.pillar-row').length;
            const html = pillarTemplate.innerHTML
                .replaceAll('__PILLAR_NAME__', `hero_pillars[${index}]`)
                .replaceAll('__PILLAR_ICON_NAME__', `hero_pillars_icons[${index}]`);
            pillarWrapper.insertAdjacentHTML('beforeend', html);
        });

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
            const html = solutionTemplate.innerHTML
                .replaceAll('__SOLUTION_NAME__', `solutions[${index}]`)
                .replaceAll('__SOLUTION_ICON_NAME__', `solutions_icons[${index}]`);
            solutionWrapper.insertAdjacentHTML('beforeend', html);
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-pillar-row')) {
                event.target.closest('.pillar-row').remove();
            }
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
            if (event.target.classList.contains('remove-icon-btn')) {
                const wrap = event.target.closest('.existing-icon-wrap');
                const row = event.target.closest('.pillar-row, .detail-row, .solution-row');
                const fileInput = row ? row.querySelector('.icon-file-input') : null;
                const removeIconInput = row ? row.querySelector('.remove-icon-input') : null;
                const savedIconUrl = wrap ? wrap.dataset.savedIconUrl : '';

                if (fileInput) fileInput.value = '';

                if (savedIconUrl) {
                    if (removeIconInput) removeIconInput.value = '1';
                    if (wrap) wrap.classList.add('icon-wrap-hidden');
                } else if (wrap) {
                    wrap.classList.add('icon-wrap-hidden');
                    wrap.querySelector('img').src = '';
                }
            }
        });

        document.addEventListener('change', function (event) {
            if (!event.target.classList.contains('icon-file-input')) return;

            const input = event.target;
            const row = input.closest('.pillar-row, .detail-row, .solution-row');
            const wrap = row ? row.querySelector('.existing-icon-wrap') : null;
            const removeIconInput = row ? row.querySelector('.remove-icon-input') : null;
            if (!wrap) return;

            const img = wrap.querySelector('img');
            const savedIconUrl = wrap.dataset.savedIconUrl || '';

            if (input.files && input.files.length > 0) {
                if (removeIconInput) removeIconInput.value = '0';
                img.src = URL.createObjectURL(input.files[0]);
                wrap.classList.remove('icon-wrap-hidden');
            } else if (savedIconUrl) {
                if (removeIconInput) removeIconInput.value = '0';
                img.src = savedIconUrl;
                wrap.classList.remove('icon-wrap-hidden');
            } else {
                img.src = '';
                wrap.classList.add('icon-wrap-hidden');
            }
        });
});
</script>
@endpush