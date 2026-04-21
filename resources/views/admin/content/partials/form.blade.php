@php
    $currentContent = $content ?? null;
    $currentSlug = $currentContent ? $currentContent->slug : '';
    $currentSection = $currentContent ? $currentContent->section : '';
    $currentHeading = $currentContent ? $currentContent->heading : '';
    $currentSubHeading = $currentContent ? $currentContent->sub_heading : '';
    $currentDesignWord = $currentContent ? $currentContent->design_word : '';
    $currentType = $currentContent ? $currentContent->type : '';
    $currentDescription = $currentContent ? $currentContent->description : '';
    $currentIconUrl = $currentContent ? $currentContent->iconUrl() : null;
    $currentImageUrl = $currentContent ? $currentContent->imageUrl() : null;
@endphp

<div class="row g-3">
    <div class="col-12 d-flex flex-wrap justify-content-end gap-2">
        <button type="button" id="applyProjectsPagePreset" class="btn btn-sm btn-outline-secondary">Apply Projects Page Preset</button>
        <button type="button" id="applyProjectLocationPreset" class="btn btn-sm btn-outline-secondary">Apply Project Location Preset</button>
        <button type="button" id="applyProjectPhasePreset" class="btn btn-sm btn-outline-secondary">Apply Project Phase Preset</button>
        <button type="button" id="applyProjectOutcomePreset" class="btn btn-sm btn-outline-secondary">Apply Project Outcome Preset</button>
        <button type="button" id="applyProjectsWorkWithUsPreset" class="btn btn-sm btn-outline-secondary">Apply Projects Work With Us Toggle</button>
        <button type="button" id="applyWorkWithUsPreset" class="btn btn-sm btn-outline-primary">Apply Work With Us Preset</button>
    </div>

    <div class="col-md-6">
        <label class="form-label">Slug</label>
        <input type="text" id="content_slug" name="slug" value="{{ old('slug', $currentSlug) }}" class="form-control @error('slug') is-invalid @enderror" placeholder="work-with-us">
        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Section</label>
        <input type="text" id="content_section" name="section" value="{{ old('section', $currentSection) }}" class="form-control @error('section') is-invalid @enderror" placeholder="WORK WITH US">
        @error('section')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Heading</label>
        <input type="text" id="content_heading" name="heading" value="{{ old('heading', $currentHeading) }}" class="form-control @error('heading') is-invalid @enderror" placeholder="Have a project in mind?">
        @error('heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Sub Heading</label>
        <input type="text" id="content_sub_heading" name="sub_heading" value="{{ old('sub_heading', $currentSubHeading) }}" class="form-control @error('sub_heading') is-invalid @enderror" placeholder="Get in Touch">
        @error('sub_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Design Word</label>
        <input type="text" id="content_design_word" name="design_word" value="{{ old('design_word', $currentDesignWord) }}" class="form-control @error('design_word') is-invalid @enderror" placeholder="that lasts.">
        @error('design_word')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Type</label>
        <input type="text" id="content_type" name="type" value="{{ old('type', $currentType) }}" class="form-control @error('type') is-invalid @enderror" placeholder="Hero / CTA / Service Hero">
        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea id="content_description" name="description" rows="6" class="form-control @error('description') is-invalid @enderror">{{ old('description', $currentDescription) }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Icon Image</label>
        <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if($currentIconUrl)
            <div class="mt-2"><img src="{{ $currentIconUrl }}" alt="icon" style="width: 56px; height: 56px; object-fit: contain;"></div>
        @endif
    </div>

    <div class="col-md-6">
        <label class="form-label">Main Image</label>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if($currentImageUrl)
            <div class="mt-2"><img src="{{ $currentImageUrl }}" alt="image" style="width: 100%; max-width: 140px; height: 90px; object-fit: cover;"></div>
        @endif
    </div>
</div>

@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    (function () {
        const field = document.getElementById('content_description');
        const projectsPagePresetBtn = document.getElementById('applyProjectsPagePreset');
        const projectLocationPresetBtn = document.getElementById('applyProjectLocationPreset');
        const projectPhasePresetBtn = document.getElementById('applyProjectPhasePreset');
        const projectOutcomePresetBtn = document.getElementById('applyProjectOutcomePreset');
        const projectsWorkWithUsPresetBtn = document.getElementById('applyProjectsWorkWithUsPreset');
        const presetBtn = document.getElementById('applyWorkWithUsPreset');
        const slugField = document.getElementById('content_slug');
        const sectionField = document.getElementById('content_section');
        const headingField = document.getElementById('content_heading');
        const subHeadingField = document.getElementById('content_sub_heading');
        const designWordField = document.getElementById('content_design_word');
        const typeField = document.getElementById('content_type');
        const descriptionField = document.getElementById('content_description');

        if (field) {
            ClassicEditor.create(field).catch(function (error) { console.error(error); });
        }

        if (projectsPagePresetBtn) {
            projectsPagePresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'projects-page';
                if (sectionField) sectionField.value = 'OUR PROJECTS';
                if (headingField) headingField.value = 'Work that';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = 'changes systems.';
                if (typeField) typeField.value = 'Hero';
                if (descriptionField) descriptionField.value = 'TRACE has delivered trade facilitation reform, laboratory accreditation, digital systems, and policy advisory projects across South Asia — for governments, development banks, and regulatory bodies.';
            });
        }

        if (projectLocationPresetBtn) {
            projectLocationPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'project-location-section';
                if (sectionField) sectionField.value = 'PROJECT DETAILS';
                if (headingField) headingField.value = 'Project Locations';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Section';
                if (descriptionField) descriptionField.value = 'Locations where this project has been implemented or delivered.';
            });
        }

        if (projectPhasePresetBtn) {
            projectPhasePresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'project-phase-section';
                if (sectionField) sectionField.value = 'PROJECT DETAILS';
                if (headingField) headingField.value = 'Project Phases';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Section';
                if (descriptionField) descriptionField.value = 'Phase-wise implementation milestones and downloadable documents.';
            });
        }

        if (projectOutcomePresetBtn) {
            projectOutcomePresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'project-outcome-section';
                if (sectionField) sectionField.value = 'PROJECT DETAILS';
                if (headingField) headingField.value = 'Key Outcomes';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Section';
                if (descriptionField) descriptionField.value = 'Measurable results and outcomes delivered through this project.';
            });
        }

        if (projectsWorkWithUsPresetBtn) {
            projectsWorkWithUsPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'projects-work-with-us';
                if (sectionField) sectionField.value = 'PROJECT CTA TOGGLE';
                if (headingField) headingField.value = 'Projects Work With Us';
                if (subHeadingField) subHeadingField.value = 'Set type to show or hide';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'show';
                if (descriptionField) descriptionField.value = 'Use type=show to display CTA on project details page; type=hide to hide CTA.';
            });
        }

        if (presetBtn) {
            presetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'work-with-us';
                if (sectionField) sectionField.value = 'WORK WITH US';
                if (headingField) headingField.value = 'Have a project in mind?';
                if (subHeadingField) subHeadingField.value = 'Get in Touch';
                if (designWordField) designWordField.value = 'that lasts.';
                if (typeField) typeField.value = 'CTA';
            });
        }
    })();
</script>
@endpush