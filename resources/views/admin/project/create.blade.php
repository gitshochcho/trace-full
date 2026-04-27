@extends('layouts.app')

@section('content')
    @php
        $statusOptions    = ['Completed', 'Ongoing', 'Planned', 'On Hold'];
        $selectedServices = old('services', []);
        $locations        = old('locations', [['id' => null, 'location' => '']]);
        $phases           = old('phases',    [['id' => null, 'phase_description' => '', 'attachment_url' => null, 'attachment_name' => null]]);
        $outcomes         = old('outcomes',  [['id' => null, 'icon' => '', 'text' => '']]);
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Create Project</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">

                    {{-- LEFT: Project Info + Images --}}
                    <div class="col-12 col-xl-4">

                        <div class="card card-outline card-primary mb-4">
                            <div class="card-header"><h3 class="card-title">Project Information</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Project Title</label>
                                        <input type="text" name="project_title" value="{{ old('project_title') }}" class="form-control @error('project_title') is-invalid @enderror" placeholder="Work that changes systems.">
                                        @error('project_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Client</label>
                                        <input type="text" name="client" value="{{ old('client') }}" class="form-control @error('client') is-invalid @enderror" placeholder="Client name">
                                        @error('client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Project Standard</label>
                                        <input type="text" name="project_standard" value="{{ old('project_standard') }}" class="form-control @error('project_standard') is-invalid @enderror" placeholder="ISO/IEC 17025:2017">
                                        @error('project_standard')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Overview</label>
                                        <textarea name="overview" class="form-control project-text-editor @error('overview') is-invalid @enderror" rows="7">{{ old('overview') }}</textarea>
                                        @error('overview')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror">
                                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror">
                                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Project Status</label>
                                        <select name="project_status" class="form-select @error('project_status') is-invalid @enderror">
                                            @foreach($statusOptions as $status)
                                                <option value="{{ $status }}" @selected(old('project_status', 'Completed') === $status)>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        @error('project_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Related Services</label>
                                        <input type="text" id="projectServiceSearch" class="form-control mb-2" placeholder="Search services...">
                                        <select name="services[]" class="form-select @error('services') is-invalid @enderror" multiple size="7">
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" data-service-label="{{ strtolower($service->service_name) }}" @selected(in_array($service->id, $selectedServices))>{{ $service->service_name }} ({{ $service->projects_count }})</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted mt-1 d-block">Hold Ctrl/Cmd to select multiple</small>
                                        @error('services')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-outline card-secondary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Project Images</h3>
                                <button type="button" id="addProjectImageRow" class="btn btn-sm btn-outline-primary">+ Add Image</button>
                            </div>
                            <div class="card-body">
                                <input type="file" id="projectImageInput" name="images[]" class="d-none" accept="image/*" multiple>
                                <div id="projectImageQueue" class="d-grid gap-3"></div>
                                <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> Recommended: 1600×900px (16:9 aspect ratio, max 4MB each)</small>
                                @error('images')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>

                    </div>

                    {{-- RIGHT: Locations + Phases + Outcomes --}}
                    <div class="col-12 col-xl-8">

                        <div class="card card-outline card-secondary mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Project Locations</h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addLocationRow">Add Location</button>
                            </div>
                            <div class="card-body">
                                <div id="locationsWrapper" class="d-grid gap-3">
                                    @foreach($locations as $index => $location)
                                        <div class="border rounded p-3 location-row">
                                            <div class="row g-3 align-items-start">
                                                <div class="col-12">
                                                    <input type="hidden" name="locations[{{ $index }}][id]" value="{{ $location['id'] ?? '' }}">
                                                    <label class="form-label">Location</label>
                                                    <textarea name="locations[{{ $index }}][location]" class="form-control project-text-editor" rows="4">{{ $location['location'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-12 d-grid d-md-flex justify-content-md-end">
                                                    <button type="button" class="btn btn-outline-danger remove-location-row">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card card-outline card-secondary mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Project Phase Details</h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addPhaseRow">Add Phase</button>
                            </div>
                            <div class="card-body">
                                <div id="phasesWrapper" class="d-grid gap-3">
                                    @foreach($phases as $index => $phase)
                                        <div class="border rounded p-3 phase-row">
                                            <div class="row g-3 align-items-start">
                                                <div class="col-12">
                                                    <input type="hidden" name="phases[{{ $index }}][id]" value="{{ $phase['id'] ?? '' }}">
                                                    <label class="form-label">Phase Description</label>
                                                    <textarea name="phases[{{ $index }}][phase_description]" class="form-control project-text-editor" rows="4">{{ $phase['phase_description'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-md-10">
                                                    <label class="form-label">PDF Attachment</label>
                                                    <input type="file" name="phases[{{ $index }}][attachment]" class="form-control" accept="application/pdf">
                                                </div>
                                                <div class="col-md-2 d-grid">
                                                    <button type="button" class="btn btn-outline-danger remove-phase-row">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card card-outline card-secondary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Project Outcomes</h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addOutcomeRow">Add Outcome</button>
                            </div>
                            <div class="card-body">
                                <div id="outcomesWrapper" class="d-grid gap-3">
                                    @foreach($outcomes as $index => $outcome)
                                        <div class="border rounded p-3 outcome-row">
                                            <div class="row g-3 align-items-start">
                                                <div class="col-12 col-md-3">
                                                    <input type="hidden" name="outcomes[{{ $index }}][id]" value="{{ $outcome['id'] ?? '' }}">
                                                    <label class="form-label">Icon Class</label>
                                                    <input type="text" name="outcomes[{{ $index }}][icon]" value="{{ $outcome['icon'] ?? '' }}" class="form-control" placeholder="fas fa-check-circle">
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <label class="form-label">Text</label>
                                                    <textarea name="outcomes[{{ $index }}][text]" class="form-control project-text-editor" rows="4">{{ $outcome['text'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-12 col-md-2 d-grid">
                                                    <button type="button" class="btn btn-outline-danger remove-outcome-row">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Save Project
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <template id="locationRowTemplate">
        <div class="border rounded p-3 location-row">
            <div class="row g-3 align-items-start">
                <div class="col-12">
                    <input type="hidden" name="__LOCATION_NAME__[id]" value="">
                    <label class="form-label">Location</label>
                    <textarea name="__LOCATION_NAME__[location]" class="form-control project-text-editor" rows="4"></textarea>
                </div>
                <div class="col-12 d-grid d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-danger remove-location-row">Remove</button>
                </div>
            </div>
        </div>
    </template>

    <template id="phaseRowTemplate">
        <div class="border rounded p-3 phase-row">
            <div class="row g-3 align-items-start">
                <div class="col-12">
                    <input type="hidden" name="__PHASE_NAME__[id]" value="">
                    <label class="form-label">Phase Description</label>
                    <textarea name="__PHASE_NAME__[phase_description]" class="form-control project-text-editor" rows="4"></textarea>
                </div>
                <div class="col-md-10">
                    <label class="form-label">PDF Attachment</label>
                    <input type="file" name="__PHASE_ATTACHMENT_NAME__" class="form-control" accept="application/pdf">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="button" class="btn btn-outline-danger remove-phase-row">Remove</button>
                </div>
            </div>
        </div>
    </template>

    <template id="outcomeRowTemplate">
        <div class="border rounded p-3 outcome-row">
            <div class="row g-3 align-items-start">
                <div class="col-12 col-md-3">
                    <input type="hidden" name="__OUTCOME_NAME__[id]" value="">
                    <label class="form-label">Icon Class</label>
                    <input type="text" name="__OUTCOME_NAME__[icon]" class="form-control" placeholder="fas fa-check-circle">
                </div>
                <div class="col-12 col-md-7">
                    <label class="form-label">Text</label>
                    <textarea name="__OUTCOME_NAME__[text]" class="form-control project-text-editor" rows="4"></textarea>
                </div>
                <div class="col-12 col-md-2 d-grid">
                    <button type="button" class="btn btn-outline-danger remove-outcome-row">Remove</button>
                </div>
            </div>
        </div>
    </template>

@endsection

@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
(function () {
    const activeEditors   = new Map();
    const form            = document.querySelector('form');
    const locationWrapper = document.getElementById('locationsWrapper');
    const phaseWrapper    = document.getElementById('phasesWrapper');
    const outcomeWrapper  = document.getElementById('outcomesWrapper');
    const locationTemplate = document.getElementById('locationRowTemplate');
    const phaseTemplate    = document.getElementById('phaseRowTemplate');
    const outcomeTemplate  = document.getElementById('outcomeRowTemplate');
    const serviceSearch   = document.getElementById('projectServiceSearch');
    const serviceSelect   = document.querySelector('select[name="services[]"]');
    const addImageBtn     = document.getElementById('addProjectImageRow');
    const imageInput      = document.getElementById('projectImageInput');
    const imageQueue      = document.getElementById('projectImageQueue');
    const selectedImages  = [];

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
        document.querySelectorAll('.project-text-editor').forEach(function (el) {
            if (el.dataset.editorReady) return;
            el.dataset.editorReady = '1';
            ClassicEditor.create(el)
                .then(function (editor) { activeEditors.set(el, editor); })
                .catch(function (err) { console.error(err); });
        });
    }

    function destroyEditorFromRow(row) {
        const textarea = row ? row.querySelector('.project-text-editor') : null;
        if (textarea && activeEditors.has(textarea)) {
            activeEditors.get(textarea).destroy();
            activeEditors.delete(textarea);
        }
    }

    initEditors();

    if (form) {
        form.addEventListener('submit', function () {
            activeEditors.forEach(function (editor, textarea) {
                textarea.value = normalizeEditorHtml(editor.getData());
            });
            if (imageInput) {
                const dt = new DataTransfer();
                selectedImages.forEach(function (file) { dt.items.add(file); });
                imageInput.files = dt.files;
            }
        });
    }

    // ── Service search ───────────────────────────────────────────────
    if (serviceSearch && serviceSelect) {
        serviceSearch.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();
            Array.from(serviceSelect.options).forEach(function (opt) {
                opt.hidden = q !== '' && !(opt.dataset.serviceLabel || opt.textContent.toLowerCase()).includes(q);
            });
        });
    }

    // ── Image queue ──────────────────────────────────────────────────
    function renderImageQueue() {
        imageQueue.innerHTML = '';
        if (!selectedImages.length) {
            const empty = document.createElement('p');
            empty.className = 'text-muted small mb-0';
            empty.textContent = 'No images selected yet.';
            imageQueue.appendChild(empty);
            return;
        }
        selectedImages.forEach(function (file, index) {
            const row = document.createElement('div');
            row.className = 'border rounded p-3 d-flex gap-3 align-items-center image-queue-row';
            row.dataset.index = String(index);
            const preview = document.createElement('img');
            preview.src = URL.createObjectURL(file);
            preview.style.cssText = 'width:84px;height:64px;object-fit:cover;';
            preview.className = 'rounded';
            const meta = document.createElement('div');
            meta.className = 'flex-grow-1';
            meta.innerHTML = '<div class="fw-semibold">' + file.name + '</div><div class="text-muted small">' + Math.round(file.size / 1024) + ' KB</div>';
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-sm btn-outline-danger remove-image-row';
            removeBtn.textContent = 'Remove';
            row.appendChild(preview);
            row.appendChild(meta);
            row.appendChild(removeBtn);
            imageQueue.appendChild(row);
        });
    }

    if (addImageBtn && imageInput) {
        addImageBtn.addEventListener('click', function () { imageInput.click(); });
        imageInput.addEventListener('change', function (e) {
            Array.from(e.target.files || []).forEach(function (f) { selectedImages.push(f); });
            imageInput.value = '';
            renderImageQueue();
        });
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-image-row')) {
            const row = e.target.closest('.image-queue-row');
            if (row) {
                selectedImages.splice(Number(row.dataset.index), 1);
                renderImageQueue();
            }
        }
    });

    renderImageQueue();

    // ── Dynamic rows ─────────────────────────────────────────────────
    document.getElementById('addLocationRow').addEventListener('click', function () {
        const index = locationWrapper.querySelectorAll('.location-row').length;
        locationWrapper.insertAdjacentHTML('beforeend',
            locationTemplate.innerHTML.replaceAll('__LOCATION_NAME__', 'locations[' + index + ']'));
        initEditors();
    });

    document.getElementById('addPhaseRow').addEventListener('click', function () {
        const index = phaseWrapper.querySelectorAll('.phase-row').length;
        phaseWrapper.insertAdjacentHTML('beforeend',
            phaseTemplate.innerHTML
                .replaceAll('__PHASE_NAME__', 'phases[' + index + ']')
                .replaceAll('__PHASE_ATTACHMENT_NAME__', 'phases[' + index + '][attachment]'));
        initEditors();
    });

    document.getElementById('addOutcomeRow').addEventListener('click', function () {
        const index = outcomeWrapper.querySelectorAll('.outcome-row').length;
        outcomeWrapper.insertAdjacentHTML('beforeend',
            outcomeTemplate.innerHTML.replaceAll('__OUTCOME_NAME__', 'outcomes[' + index + ']'));
        initEditors();
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-location-row')) {
            const row = e.target.closest('.location-row');
            destroyEditorFromRow(row);
            if (row) row.remove();
        }
        if (e.target.classList.contains('remove-phase-row')) {
            const row = e.target.closest('.phase-row');
            destroyEditorFromRow(row);
            if (row) row.remove();
        }
        if (e.target.classList.contains('remove-outcome-row')) {
            const row = e.target.closest('.outcome-row');
            destroyEditorFromRow(row);
            if (row) row.remove();
        }
    });
})();
</script>
@endpush
