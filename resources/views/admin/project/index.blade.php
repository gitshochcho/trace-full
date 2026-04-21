@extends('layouts.app')

@section('content')
    @php
        $selectedServices = old('services', []);
        $statusOptions = ['Completed', 'Ongoing', 'Planned', 'On Hold'];
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Projects Manager</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Projects Manager</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-xl-5">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Project</h3>
                        </div>
                        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
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
                                        <textarea name="overview" class="form-control project-overview-editor @error('overview') is-invalid @enderror" rows="7">{{ old('overview') }}</textarea>
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
                                        <select name="services[]" class="form-select @error('services') is-invalid @enderror" multiple size="6">
                                            @forelse($services as $service)
                                                <option value="{{ $service->id }}" data-service-label="{{ strtolower($service->service_name) }}" @selected(in_array($service->id, $selectedServices))>{{ $service->service_name }} ({{ $service->projects_count }})</option>
                                            @empty
                                                <option value="">No services found</option>
                                            @endforelse
                                        </select>
                                        @error('services')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Project Images</label>
                                        <button type="button" id="addProjectImageRow" class="btn btn-sm btn-outline-primary mb-3">+ Add Image</button>
                                        <input type="file" id="projectImageInput" name="images[]" class="d-none" accept="image/*" multiple>
                                        <div id="projectImageQueue" class="d-grid gap-3 mb-2"></div>
                                        @error('images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Project</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-xl-7">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Existing Projects</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Client</th>
                                        <th>Standard</th>
                                        <th>Status</th>
                                        <th>Duration</th>
                                        <th>Services</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($projects as $project)
                                        <tr>
                                            <td>{{ $project->project_title }}</td>
                                            <td>{{ $project->client ?: '-' }}</td>
                                            <td>{{ $project->project_standard ?: '-' }}</td>
                                            <td><span class="badge text-bg-info">{{ $project->project_status }}</span></td>
                                            <td>{{ $project->durationLabel() ?: '-' }}</td>
                                            <td>{{ $project->services->count() }}</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">No projects found yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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
        const activeEditors = new Map();
        const form = document.querySelector('form[action*="admin/projects-manager"]');
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
            document.querySelectorAll('.project-overview-editor').forEach(function (element) {
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

        renderImageQueue();
    })();
</script>
@endpush