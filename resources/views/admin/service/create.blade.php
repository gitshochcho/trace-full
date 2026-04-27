@extends('layouts.app')

@section('content')
    @php
        $details   = old('details',   [['id' => null, 'text' => '']]);
        $solutions = old('solutions',  [['id' => null, 'heading' => '', 'sub_heading' => '']]);
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
                                    <div class="col-12">
                                        <label class="form-label">Related Content Block</label>
                                        <select name="content_id" class="form-select @error('content_id') is-invalid @enderror">
                                            <option value="">-- Select --</option>
                                            @foreach($contents as $content)
                                                <option value="{{ $content->id }}" @selected(old('content_id') == $content->id)>{{ $content->slug }} | {{ $content->heading }}</option>
                                            @endforeach
                                        </select>
                                        @error('content_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Overview Description</label>
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
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 800×600px (max 4MB)</small>
                                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Service Icon</label>
                                        <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 128×128px square (max 2MB)</small>
                                        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: Details + Solutions --}}
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
                                                    <input type="file" name="details_icons[{{ $index }}]" class="form-control" accept="image/*">
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
                    <input type="file" name="__DETAIL_ICON_NAME__" class="form-control" accept="image/*">
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
(function () {
    const activeEditors  = new Map();
    const form           = document.querySelector('form');
    const detailWrapper  = document.getElementById('detailsWrapper');
    const solutionWrapper = document.getElementById('solutionsWrapper');
    const detailTemplate  = document.getElementById('detailRowTemplate');
    const solutionTemplate = document.getElementById('solutionRowTemplate');

    function normalizeEditorHtml(html) {
        if (!html) return '';
        let text = html;
        text = text.replace(/<p[^>]*>/gi, '');
        text = text.replace(/<\/p>/gi, "\n");
        text = text.replace(/<br\s*\/?>/gi, "\n");
        text = text.replace(/&nbsp;/gi, ' ');
        text = text.replace(/<[^>]*>/g, '');
        text = text.replace(/\n{3,}/g, "\n\n");
        return text.trim();
    }

    function initEditors() {
        document.querySelectorAll('.overview-editor, .detail-editor').forEach(function (el) {
            if (el.dataset.editorReady) return;
            el.dataset.editorReady = '1';
            ClassicEditor.create(el)
                .then(function (editor) { activeEditors.set(el, editor); })
                .catch(function (err) { console.error(err); });
        });
    }

    initEditors();

    if (form) {
        form.addEventListener('submit', function () {
            activeEditors.forEach(function (editor, textarea) {
                textarea.value = normalizeEditorHtml(editor.getData());
            });
        });
    }

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
        solutionWrapper.insertAdjacentHTML('beforeend',
            solutionTemplate.innerHTML.replaceAll('__SOLUTION_NAME__', 'solutions[' + index + ']'));
    });

    document.addEventListener('click', function (e) {
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
})();
</script>
@endpush
