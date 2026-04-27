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

        $projectImages = $project->galleryImageUrls();
        $removeImages = old('remove_images', []);
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
                        <div class="card card-outline card-primary mb-4">
                            <div class="card-header"><h3 class="card-title">Project Information</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Project Title</label>
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

                                    <div class="col-md-6">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" class="form-control @error('sort_order') is-invalid @enderror">
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
                                <div class="row g-3 mb-3">
                                    @forelse($projectImages as $image)
                                        <div class="col-6">
                                            <label class="d-block border rounded p-2 h-100">
                                                <img src="{{ $image['url'] }}" alt="Project image" class="img-fluid rounded mb-2" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $image['id'] }}" id="removeImage{{ $image['id'] }}" @checked(in_array($image['id'], $removeImages))>
                                                    <label class="form-check-label small" for="removeImage{{ $image['id'] }}">Remove</label>
                                                </div>
                                            </label>
                                        </div>
                                    @empty
                                        <div class="col-12 text-muted">No images uploaded yet.</div>
                                    @endforelse
                                </div>
                                <div id="projectImageQueue" class="d-grid gap-3"></div>
                                <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> Recommended: 1600×900px (16:9 aspect ratio, max 4MB each)</small>
                                @error('images')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

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
        const activeEditors = new Map();
        const form = document.querySelector('form[action*="admin/projects-manager"]');
        const locationWrapper = document.getElementById('locationsWrapper');
        const phaseWrapper = document.getElementById('phasesWrapper');
        const outcomeWrapper = document.getElementById('outcomesWrapper');
        const locationTemplate = document.getElementById('locationRowTemplate');
        const phaseTemplate = document.getElementById('phaseRowTemplate');
        const outcomeTemplate = document.getElementById('outcomeRowTemplate');
        const serviceSearch = document.getElementById('projectServiceSearch');
        const serviceSelect = document.querySelector('select[name="services[]"]');
        const addImageBtn = document.getElementById('addProjectImageRow');
        const imageInput = document.getElementById('projectImageInput');
        const imageQueue = document.getElementById('projectImageQueue');
        const selectedImages = [];

        function normalizeEditorHtml(html) {
            if (!html) {
                return '';
            }

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
            document.querySelectorAll('.project-text-editor').forEach(function (element) {
                if (element.dataset.editorReady) {
                    return;
                }

                element.dataset.editorReady = '1';

                ClassicEditor.create(element)
                    .then(function (editor) {
                        activeEditors.set(element, editor);
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
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
                    selectedImages.forEach(function (file) {
                        dt.items.add(file);
                    });
                    imageInput.files = dt.files;
                }
            });
        }

        if (serviceSearch && serviceSelect) {
            serviceSearch.addEventListener('input', function () {
                const query = serviceSearch.value.trim().toLowerCase();

                Array.from(serviceSelect.options).forEach(function (option) {
                    const label = option.dataset.serviceLabel || option.textContent.toLowerCase();
                    option.hidden = query !== '' && !label.includes(query);
                });
            });
        }

        function renderImageQueue() {
            imageQueue.innerHTML = '';

            if (!selectedImages.length) {
                const empty = document.createElement('p');
                empty.className = 'text-muted small mb-0';
                empty.textContent = 'No new images selected.';
                imageQueue.appendChild(empty);
                return;
            }

            selectedImages.forEach(function (file, index) {
                const row = document.createElement('div');
                row.className = 'border rounded p-3 d-flex gap-3 align-items-center image-queue-row';
                row.dataset.index = String(index);

                const preview = document.createElement('img');
                preview.src = URL.createObjectURL(file);
                preview.alt = file.name;
                preview.style.width = '84px';
                preview.style.height = '64px';
                preview.style.objectFit = 'cover';
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
            addImageBtn.addEventListener('click', function () {
                imageInput.click();
            });

            imageInput.addEventListener('change', function (event) {
                const files = Array.from(event.target.files || []);
                files.forEach(function (file) {
                    selectedImages.push(file);
                });
                imageInput.value = '';
                renderImageQueue();
            });
        }

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-image-row')) {
                const row = event.target.closest('.image-queue-row');
                const index = row ? Number(row.dataset.index) : -1;

                if (index > -1) {
                    selectedImages.splice(index, 1);
                    renderImageQueue();
                }
            }
        });

        document.getElementById('addLocationRow').addEventListener('click', function () {
            const index = locationWrapper.querySelectorAll('.location-row').length;
            const html = locationTemplate.innerHTML.replaceAll('__LOCATION_NAME__', `locations[${index}]`);
            locationWrapper.insertAdjacentHTML('beforeend', html);
            initEditors();
        });

        document.getElementById('addPhaseRow').addEventListener('click', function () {
            const index = phaseWrapper.querySelectorAll('.phase-row').length;
            const html = phaseTemplate.innerHTML
                .replaceAll('__PHASE_NAME__', `phases[${index}]`)
                .replaceAll('__PHASE_ATTACHMENT_NAME__', `phases[${index}][attachment]`);
            phaseWrapper.insertAdjacentHTML('beforeend', html);
            initEditors();
        });

        document.getElementById('addOutcomeRow').addEventListener('click', function () {
            const index = outcomeWrapper.querySelectorAll('.outcome-row').length;
            const html = outcomeTemplate.innerHTML.replaceAll('__OUTCOME_NAME__', `outcomes[${index}]`);
            outcomeWrapper.insertAdjacentHTML('beforeend', html);
            initEditors();
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-location-row')) {
                const row = event.target.closest('.location-row');
                destroyEditorFromRow(row);
                if (row) {
                    row.remove();
                }
            }

            if (event.target.classList.contains('remove-phase-row')) {
                const row = event.target.closest('.phase-row');
                destroyEditorFromRow(row);
                if (row) {
                    row.remove();
                }
            }

            if (event.target.classList.contains('remove-outcome-row')) {
                const row = event.target.closest('.outcome-row');
                destroyEditorFromRow(row);
                if (row) {
                    row.remove();
                }
            }
        });
    })();
</script>
@endpush