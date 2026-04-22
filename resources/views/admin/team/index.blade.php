@extends('layouts.app')

@section('content')
    @php
        $selectedProjects = old('projects', []);
        $experties = old('experties', [['id' => null, 'heading' => '', 'description' => '']]);
        $socialMediaRows = old('social_media', [['id' => null, 'title' => '', 'social_link' => '']]);
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Team Manager</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Team Manager</li>
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
                            <h3 class="card-title">Create Team Member</h3>
                        </div>
                        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data" id="teamForm">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror">
                                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror">
                                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Designation</label>
                                        <input type="text" name="designation" value="{{ old('designation') }}" class="form-control @error('designation') is-invalid @enderror">
                                        @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Team Image</label>
                                        <button type="button" id="addTeamImageRow" class="btn btn-sm btn-outline-primary mb-2">+ Add Image</button>
                                        <input type="file" id="teamImageInput" name="image" class="d-none" accept="image/*">
                                        <div id="teamImageQueue" class="d-grid gap-2"></div>
                                        @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Related Projects</label>
                                        <select name="projects[]" class="form-select" multiple size="6">
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}" @selected(in_array($project->id, $selectedProjects))>{{ $project->project_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label mb-0">Team Experties</label>
                                            <button type="button" class="btn btn-sm btn-outline-primary" id="addExpertiseRow">Add Row</button>
                                        </div>
                                        <div id="expertiesWrapper" class="d-grid gap-3">
                                            @foreach($experties as $index => $expertise)
                                                <div class="border rounded p-3 expertise-row">
                                                    <div class="row g-2 align-items-end">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Heading</label>
                                                            <input type="hidden" name="experties[{{ $index }}][id]" value="{{ $expertise['id'] ?? '' }}">
                                                            <input type="text" name="experties[{{ $index }}][heading]" value="{{ $expertise['heading'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label class="form-label">Description</label>
                                                            <input type="text" name="experties[{{ $index }}][description]" value="{{ $expertise['description'] ?? '' }}" class="form-control">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">Icon</label>
                                                            <input type="file" name="experties_icons[{{ $index }}]" class="form-control" accept="image/*">
                                                        </div>
                                                        <div class="col-md-1 d-grid">
                                                            <button type="button" class="btn btn-outline-danger remove-expertise-row">&times;</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label mb-0">Team Social Media</label>
                                            <button type="button" class="btn btn-sm btn-outline-primary" id="addSocialRow">Add Row</button>
                                        </div>
                                        <div id="socialWrapper" class="d-grid gap-3">
                                            @foreach($socialMediaRows as $index => $social)
                                                <div class="border rounded p-3 social-row">
                                                    <div class="row g-2 align-items-end">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Title</label>
                                                            <input type="hidden" name="social_media[{{ $index }}][id]" value="{{ $social['id'] ?? '' }}">
                                                            <input type="text" name="social_media[{{ $index }}][title]" value="{{ $social['title'] ?? '' }}" class="form-control" placeholder="LinkedIn">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Social Link</label>
                                                            <input type="text" name="social_media[{{ $index }}][social_link]" value="{{ $social['social_link'] ?? '' }}" class="form-control" placeholder="https://...">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">Icon</label>
                                                            <input type="file" name="social_media_icons[{{ $index }}]" class="form-control" accept="image/*">
                                                        </div>
                                                        <div class="col-md-1 d-grid">
                                                            <button type="button" class="btn btn-outline-danger remove-social-row">&times;</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Team Member</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-xl-7">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Existing Team Members</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Projects</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($teams as $team)
                                        <tr>
                                            <td>
                                                @if($team->imageUrl())
                                                    <img src="{{ $team->imageUrl() }}" alt="{{ $team->fullName() }}" style="width: 42px; height: 42px; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $team->fullName() }}</td>
                                            <td>{{ $team->designation ?: '-' }}</td>
                                            <td>{{ $team->projects->count() }}</td>
                                            <td>{{ $team->sort_order }}</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" onsubmit="return confirm('Delete this team member?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No team data found yet.</td>
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

    <template id="expertiseRowTemplate">
        <div class="border rounded p-3 expertise-row">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Heading</label>
                    <input type="hidden" name="__EXPERTISE_NAME__[id]" value="">
                    <input type="text" name="__EXPERTISE_NAME__[heading]" class="form-control">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Description</label>
                    <input type="text" name="__EXPERTISE_NAME__[description]" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Icon</label>
                    <input type="file" name="__EXPERTISE_ICON_NAME__" class="form-control" accept="image/*">
                </div>
                <div class="col-md-1 d-grid">
                    <button type="button" class="btn btn-outline-danger remove-expertise-row">&times;</button>
                </div>
            </div>
        </div>
    </template>

    <template id="socialRowTemplate">
        <div class="border rounded p-3 social-row">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Title</label>
                    <input type="hidden" name="__SOCIAL_NAME__[id]" value="">
                    <input type="text" name="__SOCIAL_NAME__[title]" class="form-control" placeholder="LinkedIn">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Social Link</label>
                    <input type="text" name="__SOCIAL_NAME__[social_link]" class="form-control" placeholder="https://...">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Icon</label>
                    <input type="file" name="__SOCIAL_ICON_NAME__" class="form-control" accept="image/*">
                </div>
                <div class="col-md-1 d-grid">
                    <button type="button" class="btn btn-outline-danger remove-social-row">&times;</button>
                </div>
            </div>
        </div>
    </template>
@endsection

@push('custome-js')
<script>
    (function () {
        const expertiseWrapper = document.getElementById('expertiesWrapper');
        const addExpertiseBtn = document.getElementById('addExpertiseRow');
        const expertiseTemplate = document.getElementById('expertiseRowTemplate');

        const socialWrapper = document.getElementById('socialWrapper');
        const addSocialBtn = document.getElementById('addSocialRow');
        const socialTemplate = document.getElementById('socialRowTemplate');

        const imageInput = document.getElementById('teamImageInput');
        const addImageBtn = document.getElementById('addTeamImageRow');
        const imageQueue = document.getElementById('teamImageQueue');

        function renderImageQueue() {
            imageQueue.innerHTML = '';
            if (!imageInput.files || imageInput.files.length === 0) {
                return;
            }

            const file = imageInput.files[0];
            const card = document.createElement('div');
            card.className = 'border rounded p-2 d-flex justify-content-between align-items-center';
            const fileSize = (file.size / 1024).toFixed(1) + ' KB';
            card.innerHTML = '<div><strong>' + file.name + '</strong><div class="small text-muted">' + fileSize + '</div></div>' +
                '<button type="button" class="btn btn-sm btn-outline-danger" id="removeTeamImage">Remove</button>';
            imageQueue.appendChild(card);

            const removeBtn = document.getElementById('removeTeamImage');
            if (removeBtn) {
                removeBtn.addEventListener('click', function () {
                    imageInput.value = '';
                    renderImageQueue();
                });
            }
        }

        if (addImageBtn) {
            addImageBtn.addEventListener('click', function () {
                imageInput.click();
            });
        }

        if (imageInput) {
            imageInput.addEventListener('change', renderImageQueue);
        }

        function reindexExpertiseRows() {
            expertiseWrapper.querySelectorAll('.expertise-row').forEach(function (row, index) {
                row.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name
                        .replace(/experties\[\d+\]/, 'experties[' + index + ']')
                        .replace(/experties_icons\[\d+\]/, 'experties_icons[' + index + ']');
                });
            });
        }

        function reindexSocialRows() {
            socialWrapper.querySelectorAll('.social-row').forEach(function (row, index) {
                row.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name
                        .replace(/social_media\[\d+\]/, 'social_media[' + index + ']')
                        .replace(/social_media_icons\[\d+\]/, 'social_media_icons[' + index + ']');
                });
            });
        }

        if (addExpertiseBtn) {
            addExpertiseBtn.addEventListener('click', function () {
                const index = expertiseWrapper.querySelectorAll('.expertise-row').length;
                const html = expertiseTemplate.innerHTML
                    .replaceAll('__EXPERTISE_NAME__', 'experties[' + index + ']')
                    .replaceAll('__EXPERTISE_ICON_NAME__', 'experties_icons[' + index + ']');
                expertiseWrapper.insertAdjacentHTML('beforeend', html);
            });
        }

        if (addSocialBtn) {
            addSocialBtn.addEventListener('click', function () {
                const index = socialWrapper.querySelectorAll('.social-row').length;
                const html = socialTemplate.innerHTML
                    .replaceAll('__SOCIAL_NAME__', 'social_media[' + index + ']')
                    .replaceAll('__SOCIAL_ICON_NAME__', 'social_media_icons[' + index + ']');
                socialWrapper.insertAdjacentHTML('beforeend', html);
            });
        }

        expertiseWrapper.addEventListener('click', function (event) {
            if (!event.target.classList.contains('remove-expertise-row')) {
                return;
            }
            event.target.closest('.expertise-row').remove();
            reindexExpertiseRows();
        });

        socialWrapper.addEventListener('click', function (event) {
            if (!event.target.classList.contains('remove-social-row')) {
                return;
            }
            event.target.closest('.social-row').remove();
            reindexSocialRows();
        });

        reindexExpertiseRows();
        reindexSocialRows();
    })();
</script>
@endpush
