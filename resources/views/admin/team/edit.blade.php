@extends('layouts.app')

@section('content')
    @php
        $selectedProjects = old('projects', $team->projects->pluck('id')->values()->all());

        $experties = old('experties', $team->experties->map(function ($expertise) {
            return [
                'id' => $expertise->id,
                'heading' => $expertise->heading,
                'description' => $expertise->description,
                'icon_url' => $expertise->iconUrl(),
            ];
        })->values()->all());

        $socialMediaRows = old('social_media', $team->socialMedia->map(function ($social) {
            return [
                'id' => $social->id,
                'title' => $social->title,
                'social_link' => $social->social_link,
                'icon_url' => $social->iconUrl(),
            ];
        })->values()->all());

        // Default empty rows initialization soriye deya hoyeche jate blank row na dekha jay
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Team Member</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.teams.index') }}">Team Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data" id="teamForm">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-12 col-xl-4">
                        <div class="card card-outline card-primary">
                            <div class="card-header"><h3 class="card-title">Team Information</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first_name" value="{{ old('first_name', $team->first_name) }}" class="form-control @error('first_name') is-invalid @enderror">
                                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="last_name" value="{{ old('last_name', $team->last_name) }}" class="form-control @error('last_name') is-invalid @enderror">
                                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Type</label>
                                        <select name="type" class="form-select">
                                            <option value="1" {{ old('type', $team->type) == 1 ? 'selected' : '' }}>Team Member</option>
                                            <option value="2" {{ old('type', $team->type) == 2 ? 'selected' : '' }}>Advisor</option>
                                        </select>
                                    </div>
                                     <div class="col-md-6">
                                        <label class="form-label">Department</label>
                                        <input type="text" name="headtitle" value="{{ old('headtitle', $team->headtitle) }}" class="form-control @error('headtitle') is-invalid @enderror">
                                        @error('headtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label">Designation</label>
                                        <input type="text" name="designation" value="{{ old('designation', $team->designation) }}" class="form-control @error('designation') is-invalid @enderror">
                                        @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', $team->sort_order) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Short Description</label>
                                        <textarea name="short_description" rows="3" maxlength="500" class="form-control @error('short_description') is-invalid @enderror" placeholder="Brief intro shown on team cards (max 500 chars)">{{ old('short_description', $team->short_description) }}</textarea>
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Shown on the team card preview. Keep it short and punchy.</small>
                                        @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" rows="6" class="form-control team-description-editor @error('description') is-invalid @enderror">{{ old('description', $team->description) }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Team Image</label>
                                        <div class="mb-2 d-flex gap-2 align-items-center flex-wrap">
                                            <button type="button" id="addTeamImageRow" class="btn btn-sm btn-outline-primary">+ Add Image</button>
                                            @if($team->imageUrl())
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="removeCurrentImage">
                                                    <label class="form-check-label" for="removeCurrentImage">Remove current image</label>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" id="teamImageInput" name="image" class="d-none" accept="image/*" data-max-size="4096" data-max-width="600" data-max-height="600">
                                        <small class="text-muted d-block mb-2"><i class="fas fa-info-circle"></i> Recommended: 600×600px square portrait (max 4MB)</small>
                                        <div id="teamImageQueue" class="d-grid gap-2 mb-2">
                                            @if($team->imageUrl())
                                                <div class="border rounded p-2 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>Current image</strong>
                                                        <div class="small text-muted">Will remain unless removed or replaced</div>
                                                    </div>
                                                    <img src="{{ $team->imageUrl() }}" alt="current image" style="width: 56px; height: 56px; object-fit: cover; border-radius: 8px;">
                                                </div>
                                            @endif
                                        </div>
                                        @error('image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Related Projects</label>
                                        <select name="projects[]" class="form-select" multiple size="7">
                                            @foreach($projects as $projectItem)
                                                <option value="{{ $projectItem->id }}" @selected(in_array($projectItem->id, $selectedProjects))>{{ $projectItem->project_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-8">
                        <div class="card card-outline card-secondary mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Team Experties</h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addExpertiseRow">Add Row</button>
                            </div>
                            <div class="card-body">
                                <div id="expertiesWrapper" class="d-grid gap-3">
                                    @foreach($experties as $index => $expertise)
                                        <div class="border rounded p-3 expertise-row">
                                            <div class="row g-2 align-items-end">
                                                <div class="col-md-3">
                                                    <label class="form-label">Heading</label>
                                                    <input type="hidden" name="experties[{{ $index }}][id]" value="{{ $expertise['id'] ?? '' }}">
                                                    <input type="text" name="experties[{{ $index }}][heading]" value="{{ $expertise['heading'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" name="experties[{{ $index }}][description]" value="{{ $expertise['description'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Icon</label>
                                                    <input type="file" name="experties_icons[{{ $index }}]" class="form-control" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                                                    <small class="text-muted"><i class="fas fa-info-circle"></i> 64×64px square</small>
                                                    @if(!empty($expertise['icon_url']))
                                                        <img src="{{ $expertise['icon_url'] }}" alt="icon" style="width: 24px; height: 24px; object-fit: contain; margin-top: 6px;">
                                                    @endif
                                                </div>
                                                <div class="col-md-1 d-grid">
                                                    <button type="button" class="btn btn-outline-danger remove-expertise-row">&times;</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card card-outline card-secondary">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Team Social Media</h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addSocialRow">Add Row</button>
                            </div>
                            <div class="card-body">
                                <div id="socialWrapper" class="d-grid gap-3">
                                    @foreach($socialMediaRows as $index => $social)
                                        <div class="border rounded p-3 social-row">
                                            <div class="row g-2 align-items-end">
                                                <div class="col-md-3">
                                                    <label class="form-label">Title</label>
                                                    <input type="hidden" name="social_media[{{ $index }}][id]" value="{{ $social['id'] ?? '' }}">
                                                    <input type="text" name="social_media[{{ $index }}][title]" value="{{ $social['title'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Social Link</label>
                                                    <input type="text" name="social_media[{{ $index }}][social_link]" value="{{ $social['social_link'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Social Icon</label>
                                                    <input type="file" name="social_media_icons[{{ $index }}]" class="form-control" accept="image/*" data-max-size="512" data-max-width="32" data-max-height="32">
                                                    <small class="text-muted"><i class="fas fa-info-circle"></i> 32×32px square</small>
                                                    @if(!empty($social['icon_url']))
                                                        <img src="{{ $social['icon_url'] }}" alt="icon" style="width: 24px; height: 24px; object-fit: contain; margin-top: 6px;">
                                                    @endif
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

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">Update Team Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <template id="expertiseRowTemplate">
        <div class="border rounded p-3 expertise-row">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Heading</label>
                    <input type="hidden" name="__EXPERTISE_NAME__[id]" value="">
                    <input type="text" name="__EXPERTISE_NAME__[heading]" class="form-control">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Description</label>
                    <input type="text" name="__EXPERTISE_NAME__[description]" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Icon</label>
                    <input type="file" name="__EXPERTISE_ICON_NAME__" class="form-control" accept="image/*" data-max-size="2048" data-max-width="64" data-max-height="64">
                    <small class="text-muted"><i class="fas fa-info-circle"></i> 64×64px square</small>
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
                    <input type="text" name="__SOCIAL_NAME__[title]" class="form-control">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Social Link</label>
                    <input type="text" name="__SOCIAL_NAME__[social_link]" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Social Icon</label>
                    <input type="file" name="__SOCIAL_ICON_NAME__" class="form-control" accept="image/*" data-max-size="512" data-max-width="32" data-max-height="32">
                    <small class="text-muted"><i class="fas fa-info-circle"></i> 32×32px square</small>
                </div>
                <div class="col-md-1 d-grid">
                    <button type="button" class="btn btn-outline-danger remove-social-row">&times;</button>
                </div>
            </div>
        </div>
    </template>
@endsection

@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    (function () {
        // ── CKEditor for description ─────────────────────────────────
        const descEditorEl = document.querySelector('.team-description-editor');
        let descEditor = null;

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

        if (descEditorEl) {
            ClassicEditor.create(descEditorEl)
                .then(function (editor) { descEditor = editor; })
                .catch(function (err) { console.error(err); });

            const teamForm = document.getElementById('teamForm');
            if (teamForm) {
                teamForm.addEventListener('submit', function () {
                    if (descEditor) {
                        descEditorEl.value = normalizeEditorHtml(descEditor.getData());
                    }
                });
            }
        }

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
            if (!imageQueue) return;

            const selectedCard = imageQueue.querySelector('[data-selected-image="1"]');
            if (selectedCard) selectedCard.remove();

            if (!imageInput.files || imageInput.files.length === 0) return;

            const file = imageInput.files[0];
            const card = document.createElement('div');
            card.dataset.selectedImage = '1';
            card.className = 'border rounded p-2 d-flex justify-content-between align-items-center';
            const fileSize = (file.size / 1024).toFixed(1) + ' KB';
            card.innerHTML = '<div><strong>' + file.name + '</strong><div class="small text-muted">' + fileSize + '</div></div>' +
                '<button type="button" class="btn btn-sm btn-outline-danger" id="removeTeamImage">Remove</button>';
            imageQueue.prepend(card);

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
            if (!event.target.classList.contains('remove-expertise-row')) return;
            event.target.closest('.expertise-row').remove();
            reindexExpertiseRows();
        });

        socialWrapper.addEventListener('click', function (event) {
            if (!event.target.classList.contains('remove-social-row')) return;
            event.target.closest('.social-row').remove();
            reindexSocialRows();
        });

        reindexExpertiseRows();
        reindexSocialRows();
    })();
</script>
@endpush