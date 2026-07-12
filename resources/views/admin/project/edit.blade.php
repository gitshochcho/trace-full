@extends('layouts.app')

@section('content')
    @php
        $statusOptions = ['Completed', 'Ongoing', 'Planned', 'On Hold'];

        $selectedServices = old('services', $project->services->pluck('id')->values()->all());

        $locations = old('locations', $project->locations->map(function ($location) {
            return [
                'id' => $location->id,
                'location' => $location->location,
            ];
        })->values()->all());

        $phases = old('phases', $project->phaseDetails->map(function ($phase) {
            return [
                'id' => $phase->id,
                'phase_description' => $phase->phase_description,
                'attachment_url' => $phase->attachmentUrl(),
                'attachment_name' => $phase->attachment ? basename($phase->attachment) : null,
            ];
        })->values()->all());

        $outcomes = old('outcomes', $project->outcomes->map(function ($outcome) {
            return [
                'id' => $outcome->id,
                'icon' => $outcome->icon,
                'text' => $outcome->text,
            ];
        })->values()->all());

        if (empty($locations)) {
            $locations = [['id' => null, 'location' => '']];
        }
        if (empty($phases)) {
            $phases = [['id' => null, 'phase_description' => '', 'attachment_url' => null, 'attachment_name' => null]];
        }
        if (empty($outcomes)) {
            $outcomes = [['id' => null, 'icon' => '', 'text' => '']];
        }

        $heroMedia     = $project->getFirstMedia('hero');
        $heroImageUrl  = $heroMedia ? $heroMedia->getUrl() : null;
        $heroMediaId   = $heroMedia ? $heroMedia->id : null;
        $galleryImages = $project->galleryImageUrls();
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Project</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-12 col-xl-4">

                        {{-- Project Info --}}
                        <div class="card card-outline card-primary mb-4">
                            <div class="card-header"><h3 class="card-title">Project Information</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Project Title <span class="text-danger">*</span></label>
                                        <input type="text" name="project_title" value="{{ old('project_title', $project->project_title) }}" class="form-control @error('project_title') is-invalid @enderror">
                                        @error('project_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Client</label>
                                        <input type="text" name="client" value="{{ old('client', $project->client) }}" class="form-control @error('client') is-invalid @enderror">
                                        @error('client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Project Standard</label>
                                        <input type="text" name="project_standard" value="{{ old('project_standard', $project->project_standard) }}" class="form-control @error('project_standard') is-invalid @enderror">
                                        @error('project_standard')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Overview</label>
                                        <textarea name="overview" class="form-control project-text-editor @error('overview') is-invalid @enderror" rows="7">{{ old('overview', $project->overview) }}</textarea>
                                        @error('overview')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}" class="form-control @error('start_date') is-invalid @enderror">
                                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}" class="form-control @error('end_date') is-invalid @enderror">
                                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Project Status</label>
                                        <select name="project_status" class="form-select @error('project_status') is-invalid @enderror">
                                            @foreach($statusOptions as $status)
                                                <option value="{{ $status }}" @selected(old('project_status', $project->project_status) === $status)>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        @error('project_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end pb-1">
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="show_on_home" value="0">
                                            <input class="form-check-input" type="checkbox" name="show_on_home" value="1" id="showOnHomeSwitch" {{ old('show_on_home', $project->show_on_home) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold text-warning" for="showOnHomeSwitch">Show on Homepage</label>
                                        </div>
                                    </div>

                                    {{-- Related Services: tag-style --}}
                                    <div class="col-12">
                                        <label class="form-label">Related Services</label>
                                        <div id="servicesTagContainer" class="d-flex flex-wrap gap-2 p-2 border rounded" style="min-height:48px;">
                                            @foreach($services as $service)
                                                @php $sid = $service->id; $label = $service->section ?: $service->service_name; @endphp
                                                <span class="service-tag badge rounded-pill px-3 py-2 {{ in_array($sid, $selectedServices) ? 'bg-primary' : 'bg-secondary' }}"
                                                      data-id="{{ $sid }}"
                                                      style="cursor:pointer;font-size:13px;user-select:none;">
                                                    {{ $label }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <div id="servicesHiddenInputs">
                                            @foreach($selectedServices as $sid)
                                                <input type="hidden" name="services[]" value="{{ $sid }}">
                                            @endforeach
                                        </div>
                                        <small class="text-muted mt-1 d-block">Click to select / deselect services</small>
                                        @error('services')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Hero Image --}}
                        <div class="card card-outline card-warning mb-4">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Hero Image</h3>
                                <small class="text-muted d-block mt-1">Shown on project list cards &amp; project page header. Single image.</small>
                            </div>
                            <div class="card-body">
                                {{-- Existing hero image --}}
                                @if($heroImageUrl)
                                    <div id="existingHeroWrap" class="mb-3 position-relative d-inline-block w-100">
                                        <img id="existingHeroImg" src="{{ $heroImageUrl }}" alt="Hero image"
                                             class="img-fluid rounded border"
                                             style="max-height:160px;width:100%;object-fit:cover;">
                                        <button type="button"
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center"
                                            id="deleteHeroBtn"
                                            data-media-id="{{ $heroMediaId }}"
                                            data-delete-url="{{ route('admin.projects.images.destroy', [$project, $heroMediaId]) }}"
                                            style="width:26px;height:26px;font-size:14px;" title="Delete hero image">
                                            &times;
                                        </button>
                                    </div>
                                @endif
                                {{-- New hero upload --}}
                                <div id="heroNewPreviewWrap" class="mb-2 d-none">
                                    <div class="position-relative d-inline-block w-100">
                                        <img id="heroNewPreview" src="" alt="New hero"
                                             class="img-fluid rounded"
                                             style="max-height:160px;width:100%;object-fit:cover;">
                                        <button type="button" id="clearNewHeroBtn"
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center"
                                            style="width:26px;height:26px;font-size:14px;">&times;</button>
                                    </div>
                                </div>
                                <input type="file" id="heroImageInput" name="hero_image" accept="image/*" class="form-control @error('hero_image') is-invalid @enderror">
                                <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> Recommended: 1600×900px, max 4MB. Upload to replace existing.</small>
                                @error('hero_image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- Gallery Images --}}
                        <div class="card card-outline card-secondary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="card-title mb-0">Gallery Images</h3>
                                    <small class="text-muted">Shown in the overview section. Max 3 images.</small>
                                </div>
                                <button type="button" id="addGalleryImageBtn" class="btn btn-sm btn-outline-primary">+ Add</button>
                            </div>
                            <div class="card-body">
                                {{-- Existing gallery images --}}
                                <div id="existingGalleryGrid" class="row g-2 mb-3">
                                    @foreach($galleryImages as $image)
                                        <div class="col-6 col-md-4 existing-gallery-item" id="gallery-item-{{ $image['id'] }}">
                                            <div class="position-relative">
                                                <img src="{{ $image['url'] }}" alt="Gallery image"
                                                     class="img-fluid rounded border"
                                                     style="width:100%;height:90px;object-fit:cover;">
                                                <button type="button"
                                                    class="delete-gallery-btn btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center"
                                                    data-media-id="{{ $image['id'] }}"
                                                    data-delete-url="{{ route('admin.projects.images.destroy', [$project, $image['id']]) }}"
                                                    style="width:22px;height:22px;font-size:13px;" title="Delete image">
                                                    &times;
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- New gallery uploads --}}
                                <input type="file" id="galleryImageInput" accept="image/*" multiple class="d-none">
                                <div id="galleryImageQueue" class="row g-2 mb-2"></div>
                                <div id="galleryCount" class="text-muted small">
                                    {{ count($galleryImages) }} / 3 images
                                </div>
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
                                                    @if(! empty($phase['attachment_url']))
                                                        <a href="{{ $phase['attachment_url'] }}" target="_blank" class="d-inline-block mt-2 small">{{ $phase['attachment_name'] ?? 'Current attachment' }}</a>
                                                    @endif
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
                                        @php
                                            $isIconPath = !empty($outcome['icon']) && str_starts_with($outcome['icon'], 'projects/');
                                            $iconImgUrl = $isIconPath ? Storage::url($outcome['icon']) : null;
                                        @endphp
                                        <div class="border rounded p-3 outcome-row">
                                            <div class="row g-3 align-items-start">
                                                <div class="col-12 col-md-3">
                                                    <input type="hidden" name="outcomes[{{ $index }}][id]" value="{{ $outcome['id'] ?? '' }}">
                                                    <label class="form-label">Icon Image</label>
                                                    @if($iconImgUrl)
                                                        <div class="existing-outcome-icon mb-2">
                                                            <img src="{{ $iconImgUrl }}" alt="Current icon"
                                                                 class="rounded border"
                                                                 style="width:48px;height:48px;object-fit:contain;">
                                                            <div class="small text-muted mt-1">Current icon. Upload new to replace.</div>
                                                        </div>
                                                    @endif
                                                    <input type="file" name="outcomes[{{ $index }}][icon_image]" class="form-control outcome-icon-input" accept="image/*">
                                                    <div class="outcome-icon-preview mt-2 d-none">
                                                        <img src="" alt="New icon preview" class="rounded border" style="width:48px;height:48px;object-fit:contain;">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-7">
                                                    <label class="form-label">Text</label>
                                                    <textarea name="outcomes[{{ $index }}][text]" class="form-control project-text-editor" rows="4">{{ $outcome['text'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-12 col-md-2 d-grid align-items-end">
                                                    <button type="button" class="btn btn-outline-danger remove-outcome-row">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">Update Project</button>
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
                    <label class="form-label">Icon Image</label>
                    <input type="file" name="__OUTCOME_NAME__[icon_image]" class="form-control outcome-icon-input" accept="image/*">
                    <div class="outcome-icon-preview mt-2 d-none">
                        <img src="" alt="Icon preview" class="rounded border" style="width:48px;height:48px;object-fit:contain;">
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <label class="form-label">Text</label>
                    <textarea name="__OUTCOME_NAME__[text]" class="form-control project-text-editor" rows="4"></textarea>
                </div>
                <div class="col-12 col-md-2 d-grid align-items-end">
                    <button type="button" class="btn btn-outline-danger remove-outcome-row">Remove</button>
                </div>
            </div>
        </div>
    </template>
@endsection

@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const activeEditors    = new Map();
    const form             = document.querySelector('form[action*="projects-manager"]');
    const locationWrapper  = document.getElementById('locationsWrapper');
    const phaseWrapper     = document.getElementById('phasesWrapper');
    const outcomeWrapper   = document.getElementById('outcomesWrapper');
    const locationTemplate = document.getElementById('locationRowTemplate');
    const phaseTemplate    = document.getElementById('phaseRowTemplate');
    const outcomeTemplate  = document.getElementById('outcomeRowTemplate');

    function initEditors() {
        document.querySelectorAll('.project-text-editor').forEach(function (el) {
            if (el.dataset.editorReady) return;
            el.dataset.editorReady = '1';
            ClassicEditor.create(el, {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo'],
            })
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

                .catch(function (err) { console.error('CKEditor error:', err); });
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
                textarea.value = editor.getData();
            });
            const dt = new DataTransfer();
            galleryFiles.forEach(function (f) { dt.items.add(f); });
            const oldInputs = form.querySelectorAll('input[name="images[]"]');
            oldInputs.forEach(function (inp) { inp.remove(); });
            if (galleryFiles.length > 0) {
                const combined = document.createElement('input');
                combined.type = 'file';
                combined.name = 'images[]';
                combined.multiple = true;
                combined.classList.add('d-none');
                combined.files = dt.files;
                form.appendChild(combined);
            }
        });
    }

    // ── CSRF helper ──────────────────────────────────────────────────
    function csrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    // ── Related Services Tags ────────────────────────────────────────
    const tagContainer = document.getElementById('servicesTagContainer');
    const hiddenInputs = document.getElementById('servicesHiddenInputs');

    if (tagContainer && hiddenInputs) {
        tagContainer.addEventListener('click', function (e) {
            const tag = e.target.closest('.service-tag');
            if (!tag) return;
            const id = tag.dataset.id;
            const isActive = tag.classList.contains('bg-primary');
            if (isActive) {
                tag.classList.replace('bg-primary', 'bg-secondary');
                const inp = hiddenInputs.querySelector('input[value="' + id + '"]');
                if (inp) inp.remove();
            } else {
                tag.classList.replace('bg-secondary', 'bg-primary');
                const inp = document.createElement('input');
                inp.type = 'hidden';
                inp.name = 'services[]';
                inp.value = id;
                hiddenInputs.appendChild(inp);
            }
        });
    }

    // ── Hero Image: AJAX delete existing ────────────────────────────
    const deleteHeroBtn = document.getElementById('deleteHeroBtn');
    if (deleteHeroBtn) {
        deleteHeroBtn.addEventListener('click', function () {
            if (!confirm('Delete the hero image?')) return;
            const url = this.dataset.deleteUrl;
            fetch(url, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (data.success) {
                    const wrap = document.getElementById('existingHeroWrap');
                    if (wrap) wrap.remove();
                } else {
                    alert('Failed to delete image.');
                }
            })
            .catch(function () { alert('Error deleting image.'); });
        });
    }

    // ── Hero Image: new upload preview ───────────────────────────────
    const heroInput        = document.getElementById('heroImageInput');
    const heroNewPreviewWrap = document.getElementById('heroNewPreviewWrap');
    const heroNewPreview   = document.getElementById('heroNewPreview');
    const clearNewHeroBtn  = document.getElementById('clearNewHeroBtn');

    if (heroInput) {
        heroInput.addEventListener('change', function () {
            const file = this.files[0];
            const existingWrap = document.getElementById('existingHeroWrap');

            if (!file) {
                heroNewPreviewWrap.classList.add('d-none');
                heroNewPreview.src = '';
                if (existingWrap) existingWrap.classList.remove('d-none');
                return;
            }

            heroNewPreview.src = URL.createObjectURL(file);
            heroNewPreviewWrap.classList.remove('d-none');
            if (existingWrap) existingWrap.classList.add('d-none');
        });
    }
    if (clearNewHeroBtn) {
        clearNewHeroBtn.addEventListener('click', function () {
            heroInput.value = '';
            heroNewPreviewWrap.classList.add('d-none');
            heroNewPreview.src = '';
            const existingWrap = document.getElementById('existingHeroWrap');
            if (existingWrap) existingWrap.classList.remove('d-none');
        });
    }

    // ── Gallery Images: AJAX delete existing ────────────────────────
    const existingGalleryGrid = document.getElementById('existingGalleryGrid');
    const galleryCountEl      = document.getElementById('galleryCount');
    const galleryFiles        = [];
    let existingGalleryCount  = document.querySelectorAll('.existing-gallery-item').length;

    function updateGalleryCount() {
        const total = existingGalleryCount + galleryFiles.length;
        if (galleryCountEl) galleryCountEl.textContent = total + ' / 3 images';
        const addBtn = document.getElementById('addGalleryImageBtn');
        if (addBtn) addBtn.disabled = total >= 3;
    }

    existingGalleryGrid && existingGalleryGrid.addEventListener('click', function (e) {
        const btn = e.target.closest('.delete-gallery-btn');
        if (!btn) return;
        if (!confirm('Delete this image?')) return;
        const url     = btn.dataset.deleteUrl;
        const mediaId = btn.dataset.mediaId;
        fetch(url, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            if (data.success) {
                const item = document.getElementById('gallery-item-' + mediaId);
                if (item) item.remove();
                existingGalleryCount = Math.max(0, existingGalleryCount - 1);
                updateGalleryCount();
            } else {
                alert('Failed to delete image.');
            }
        })
        .catch(function () { alert('Error deleting image.'); });
    });

    // ── Gallery Images: new uploads ──────────────────────────────────
    const addGalleryBtn  = document.getElementById('addGalleryImageBtn');
    const galleryInput   = document.getElementById('galleryImageInput');
    const galleryQueue   = document.getElementById('galleryImageQueue');

    function renderNewGallery() {
        galleryQueue.innerHTML = '';
        galleryFiles.forEach(function (file, idx) {
            const col = document.createElement('div');
            col.className = 'col-6 col-md-4 position-relative new-gallery-item';
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'img-fluid rounded border';
            img.style.cssText = 'width:100%;height:90px;object-fit:cover;';
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.dataset.idx = String(idx);
            btn.className = 'remove-new-gallery btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center';
            btn.style.cssText = 'width:22px;height:22px;font-size:13px;';
            btn.innerHTML = '&times;';
            col.appendChild(img);
            col.appendChild(btn);
            galleryQueue.appendChild(col);
        });
        updateGalleryCount();
    }

    if (addGalleryBtn && galleryInput) {
        addGalleryBtn.addEventListener('click', function () { galleryInput.click(); });
        galleryInput.addEventListener('change', function (e) {
            Array.from(e.target.files || []).forEach(function (f) {
                if (existingGalleryCount + galleryFiles.length < 3) galleryFiles.push(f);
            });
            galleryInput.value = '';
            renderNewGallery();
        });
    }

    galleryQueue && galleryQueue.addEventListener('click', function (e) {
        const btn = e.target.closest('.remove-new-gallery');
        if (!btn) return;
        galleryFiles.splice(Number(btn.dataset.idx), 1);
        renderNewGallery();
    });

    updateGalleryCount();

    // ── Outcome Icon Preview ─────────────────────────────────────────
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('outcome-icon-input')) {
            const file = e.target.files[0];
            const col  = e.target.closest('.col-12.col-md-3, .col-md-3');
            const preview = col ? col.querySelector('.outcome-icon-preview') : null;
            if (!preview) return;
            if (file) {
                preview.querySelector('img').src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            } else {
                preview.classList.add('d-none');
            }
        }
    });

    // ── Dynamic Rows ─────────────────────────────────────────────────
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
});
</script>
@endpush
