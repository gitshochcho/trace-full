@extends('layouts.app')

@section('content')
    @php
        $heroPillars = old('hero_pillars', [['id' => null, 'title' => '', 'description' => '']]);
        $details     = old('details',   [['id' => null, 'text' => '']]);
        $solutions   = old('solutions',  [['id' => null, 'heading' => '', 'sub_heading' => '']]);
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Create Service</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">

                    {{-- LEFT: Service Info --}}
                    <div class="col-12 col-xl-5">
                        <div class="card card-outline card-primary">
                            <div class="card-header"><h3 class="card-title">Service Information</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label">Heading</label>
                                        <input type="text" name="heading" value="{{ old('heading') }}" class="form-control @error('heading') is-invalid @enderror" placeholder="Trade Facilitation">
                                        @error('heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Design Word</label>
                                        <input type="text" name="design_word" value="{{ old('design_word') }}" class="form-control @error('design_word') is-invalid @enderror" placeholder="Facilitation">
                                        @error('design_word')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Section Tag</label>
                                        <input type="text" name="section" value="{{ old('section') }}" class="form-control @error('section') is-invalid @enderror" placeholder="WHAT WE DO">
                                        @error('section')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description <small class="text-muted">(shows on card &amp; hero)</small></label>
                                        <textarea name="description" class="form-control description-editor @error('description') is-invalid @enderror" rows="5" data-raw="1">{{ old('description') }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Overview <small class="text-muted">(shows on details page body)</small></label>
                                        <textarea name="overview" class="form-control overview-editor @error('overview') is-invalid @enderror" rows="6">{{ old('overview') }}</textarea>
                                        @error('overview')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror" placeholder="trade-facilitation">
                                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Service Name</label>
                                        <input type="text" name="service_name" value="{{ old('service_name') }}" class="form-control @error('service_name') is-invalid @enderror" placeholder="Trade Facilitation">
                                        @error('service_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="active" value="1" id="activeCreate" @checked(old('active', true))>
                                            <label class="form-check-label" for="activeCreate">Active</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Service Image</label>
                                        <input type="file" id="serviceImageInput" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" data-max-size="4096" data-max-width="800" data-max-height="600">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: Details + Solutions --}}
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
                                                <input type="hidden" name="hero_pillars[{{ $index }}][id]" value="">
                                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                                <input type="text" name="hero_pillars[{{ $index }}][title]" value="{{ $pillar['title'] ?? '' }}" class="form-control" placeholder="BETTER POLICIES">
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <label class="form-label">Description</label>
                                                <input type="text" name="hero_pillars[{{ $index }}][description]" value="{{ $pillar['description'] ?? '' }}" class="form-control" placeholder="Evidence-based and inclusive">
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <label class="form-label">Icon Image</label>
                                                <input type="file" name="hero_pillars_icons[{{ $index }}]" class="form-control" accept="image/*" data-max-size="2048">
                                                <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
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
                                                    <input type="file" name="details_icons[{{ $index }}]" class="form-control" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
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
                                                    <input type="file" name="solutions_icons[{{ $index }}]" class="form-control" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
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

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Save Service
                        </button>
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
                    <input type="file" name="__PILLAR_ICON_NAME__" class="form-control" accept="image/*" data-max-size="2048">
                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
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
                    <input type="file" name="__SOLUTION_ICON_NAME__" class="form-control" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px square (max 2MB)</small>
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
    const activeEditors  = new Map();
    const form           = document.querySelector('form');
    const pillarWrapper   = document.getElementById('pillarsWrapper');
    const pillarTemplate  = document.getElementById('pillarRowTemplate');
    const detailWrapper   = document.getElementById('detailsWrapper');
    const solutionWrapper = document.getElementById('solutionsWrapper');
    const detailTemplate  = document.getElementById('detailRowTemplate');
    const solutionTemplate = document.getElementById('solutionRowTemplate');
    const serviceImageInput = document.getElementById('serviceImageInput');
    const serviceImagePreviewWrap = document.getElementById('serviceImagePreviewWrap');
    const serviceImagePreview = document.getElementById('serviceImagePreview');
    const clearServiceImageBtn = document.getElementById('clearServiceImageBtn');

    function renderServiceImagePreview() {
        if (!serviceImageInput || !serviceImagePreviewWrap || !serviceImagePreview) return;

        if (!serviceImageInput.files || serviceImageInput.files.length === 0) {
            serviceImagePreviewWrap.classList.add('d-none');
            serviceImagePreview.src = '';
            return;
        }

        const file = serviceImageInput.files[0];
        const objectUrl = URL.createObjectURL(file);
        serviceImagePreview.src = objectUrl;
        serviceImagePreviewWrap.classList.remove('d-none');

        if (clearServiceImageBtn && !clearServiceImageBtn.dataset.bound) {
            clearServiceImageBtn.dataset.bound = '1';
            clearServiceImageBtn.addEventListener('click', function () {
                serviceImageInput.value = '';
                serviceImagePreviewWrap.classList.add('d-none');
                serviceImagePreview.src = '';
            });
        }
    }

    if (serviceImageInput) {
        serviceImageInput.addEventListener('change', renderServiceImagePreview);
    }

    function initEditors() {
        document.querySelectorAll('.overview-editor, .detail-editor, .description-editor').forEach(function (el) {
            if (el.dataset.editorReady) return;
            el.dataset.editorReady = '1';
            ClassicEditor.create(el)
               
            .then(function (editor) {
                    activeEditors.set(el, editor);
                    editor.editing.view.document.on('keydown', function (evt, data) {
                        if (data.domEvent.key === 'Enter' && !data.domEvent.shiftKey) {
                            evt.stop();
                            data.preventDefault();
                            editor.execute('shiftEnter');
                        }
                    }, { priority: 'high' });
                })
                .catch(function (err) { console.error(err); });
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

    // ── Pillar dynamic rows ──────────────────────────────────────────
    document.getElementById('addPillarRow').addEventListener('click', function () {
        const index = pillarWrapper.querySelectorAll('.pillar-row').length;
        const html = pillarTemplate.innerHTML
            .replaceAll('__PILLAR_NAME__', `hero_pillars[${index}]`)
            .replaceAll('__PILLAR_ICON_NAME__', `hero_pillars_icons[${index}]`);
        pillarWrapper.insertAdjacentHTML('beforeend', html);
    });

    // ── Detail dynamic rows ──────────────────────────────────────────
    document.getElementById('addDetailRow').addEventListener('click', function () {
        const index = detailWrapper.querySelectorAll('.detail-row').length;
        const html = detailTemplate.innerHTML
            .replaceAll('__DETAIL_NAME__', 'details[' + index + ']')
            .replaceAll('__DETAIL_ICON_NAME__', 'details_icons[' + index + ']');
        detailWrapper.insertAdjacentHTML('beforeend', html);
        initEditors();
    });

    // ── Solution dynamic rows ────────────────────────────────────────
    document.getElementById('addSolutionRow').addEventListener('click', function () {
        const index = solutionWrapper.querySelectorAll('.solution-row').length;
        const html = solutionTemplate.innerHTML
            .replaceAll('__SOLUTION_NAME__', `solutions[${index}]`)
            .replaceAll('__SOLUTION_ICON_NAME__', `solutions_icons[${index}]`);
        solutionWrapper.insertAdjacentHTML('beforeend', html);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-pillar-row')) {
            e.target.closest('.pillar-row').remove();
        }
        if (e.target.classList.contains('remove-detail-row')) {
            const row = e.target.closest('.detail-row');
            const textarea = row ? row.querySelector('.detail-editor') : null;
            if (textarea && activeEditors.has(textarea)) {
                activeEditors.get(textarea).destroy();
                activeEditors.delete(textarea);
            }
            if (row) row.remove();
        }
        if (e.target.classList.contains('remove-solution-row')) {
            e.target.closest('.solution-row').remove();
        }
    });
});
</script>
@endpush
