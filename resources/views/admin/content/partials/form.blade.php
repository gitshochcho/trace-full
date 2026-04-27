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
    <div class="col-12">
        <div class="card card-primary card-outline mb-2">
            <div class="card-header py-2">
                <div class="card-title">Quick Presets</div>
            </div>
            <div class="card-body py-3">
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" id="applyTeamPagePreset" class="btn btn-sm btn-outline-primary">Team Page</button>
                    <button type="button" id="applyInsightsPagePreset" class="btn btn-sm btn-outline-primary">Insights Page</button>
                    <button type="button" id="applyProjectsPagePreset" class="btn btn-sm btn-outline-primary">Projects Page</button>
                    <button type="button" id="applyProjectLocationPreset" class="btn btn-sm btn-outline-primary">Project Location</button>
                    <button type="button" id="applyProjectPhasePreset" class="btn btn-sm btn-outline-primary">Project Phase</button>
                    <button type="button" id="applyProjectOutcomePreset" class="btn btn-sm btn-outline-primary">Project Outcome</button>
                    <button type="button" id="applyProjectsWorkWithUsPreset" class="btn btn-sm btn-outline-primary">Projects CTA Toggle</button>
                    <button type="button" id="applyWorkWithUsPreset" class="btn btn-sm btn-primary">Work With Us</button>

                    <button type="button" id="applyAboutHeaderPreset" class="btn btn-sm btn-outline-primary">About Header</button>
<button type="button" id="applyAboutTracePreset" class="btn btn-sm btn-outline-primary">About Trace</button>
<button type="button" id="applyWhoWeArePreset" class="btn btn-sm btn-outline-primary">Who We Are</button>
<button type="button" id="applyOurMissionPreset" class="btn btn-sm btn-outline-primary">Our Mission</button>
<button type="button" id="applyPartnersPreset" class="btn btn-sm btn-outline-primary">About Partners</button>
                </div>

                <button type="button" id="applyHomeAboutTracePreset" class="btn btn-sm btn-outline-secondary">Home About Trace</button>
<button type="button" id="applyHomeAboutTraceOnePreset" class="btn btn-sm btn-outline-secondary">Home About Item 1</button>
<button type="button" id="applyHomeAboutTraceTwoPreset" class="btn btn-sm btn-outline-secondary">Home About Item 2</button>
<button type="button" id="applyHomeAboutTraceThreePreset" class="btn btn-sm btn-outline-secondary">Home About Item 3</button>
<button type="button" id="applyHomeYearsPreset" class="btn btn-sm btn-outline-secondary">Home Years Expertise</button>

                <hr class="my-3">

                <div class="d-flex flex-wrap gap-2">
                    <button type="button" id="applyAboutCommitmentPreset" class="btn btn-sm btn-outline-info">About Commitment</button>
                    <button type="button" id="applyAboutFrameworkPreset" class="btn btn-sm btn-outline-info">About How We Work</button>
                    <button type="button" id="applyAboutInsightPreset" class="btn btn-sm btn-outline-info">About Insight</button>
                    <button type="button" id="applyAboutStrategyPreset" class="btn btn-sm btn-outline-info">About Strategy</button>
                    <button type="button" id="applyAboutImpactPreset" class="btn btn-sm btn-outline-info">About Impact</button>
                    <button type="button" id="applyAboutUniqueFeaturesPreset" class="btn btn-sm btn-outline-info">About Unique Features</button>
                    <button type="button" id="applyAboutIndustryNetworkPreset" class="btn btn-sm btn-outline-info">About Industry Network</button>
                    <button type="button" id="applyAboutSustainablePreset" class="btn btn-sm btn-outline-info">About Sustainable Approach</button>
                    <button type="button" id="applyAboutTailoredPreset" class="btn btn-sm btn-outline-info">About Tailored Innovation</button>
                    <button type="button" id="applyAboutEndToEndPreset" class="btn btn-sm btn-outline-info">About End-to-End</button></div> </br>
                    
                    <div class="d-flex flex-wrap gap-2 fw-bold">Career </div>
                    <hr class="">
                    <button type="button" id="applyCareerHeaderPreset" class="btn btn-sm btn-outline-primary mb-3">Career Header</button>

                    </br>
                    
                    <div class="d-flex flex-wrap gap-2 fw-bold">Contact </div>
                    <hr class="">
                    <button type="button" id="applyContactHeaderPreset" class="btn btn-sm btn-outline-primary">Contact Header</button>
                

                </div>
            </div>
        </div>
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
        <div class="mt-2 d-flex align-items-center gap-2">
            <img id="icon-preview" src="{{ $currentIconUrl }}" alt="icon" style="width: 56px; height: 56px; object-fit: contain; border-radius: 6px; border: 1px solid #dee2e6;">
            <div>
                <button type="button" class="btn btn-sm btn-outline-danger" id="remove-icon-btn">
                    <i class="fas fa-trash-alt me-1"></i> Remove
                </button>
                <input type="hidden" name="remove_icon" id="remove_icon_input" value="0">
            </div>
        </div>
    @endif
</div>

    <div class="col-md-6">
    <label class="form-label">Main Image</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if($currentImageUrl)
        <div class="mt-2 d-flex align-items-center gap-3">
            <img id="image-preview" src="{{ $currentImageUrl }}" alt="image" style="width: 140px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6;">
            <div>
                <button type="button" class="btn btn-sm btn-outline-danger" id="remove-image-btn">
                    <i class="fas fa-trash-alt me-1"></i> Remove
                </button>
                <input type="hidden" name="remove_image" id="remove_image_input" value="0">
            </div>
        </div>
    @endif
</div>
</div>

@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    (function () {
        const field = document.getElementById('content_description');
        const teamPagePresetBtn = document.getElementById('applyTeamPagePreset');
        const insightsPagePresetBtn = document.getElementById('applyInsightsPagePreset');
        const projectsPagePresetBtn = document.getElementById('applyProjectsPagePreset');
        const projectLocationPresetBtn = document.getElementById('applyProjectLocationPreset');
        const projectPhasePresetBtn = document.getElementById('applyProjectPhasePreset');
        const projectOutcomePresetBtn = document.getElementById('applyProjectOutcomePreset');
        const projectsWorkWithUsPresetBtn = document.getElementById('applyProjectsWorkWithUsPreset');
        const presetBtn = document.getElementById('applyWorkWithUsPreset');
        const aboutCommitmentPresetBtn = document.getElementById('applyAboutCommitmentPreset');
        const aboutFrameworkPresetBtn = document.getElementById('applyAboutFrameworkPreset');
        const aboutInsightPresetBtn = document.getElementById('applyAboutInsightPreset');
        const aboutStrategyPresetBtn = document.getElementById('applyAboutStrategyPreset');
        const aboutImpactPresetBtn = document.getElementById('applyAboutImpactPreset');
        const aboutUniqueFeaturesPresetBtn = document.getElementById('applyAboutUniqueFeaturesPreset');
        const aboutIndustryNetworkPresetBtn = document.getElementById('applyAboutIndustryNetworkPreset');
        const aboutSustainablePresetBtn = document.getElementById('applyAboutSustainablePreset');
        const aboutTailoredPresetBtn = document.getElementById('applyAboutTailoredPreset');
        const aboutEndToEndPresetBtn = document.getElementById('applyAboutEndToEndPreset');
        const slugField = document.getElementById('content_slug');
        const sectionField = document.getElementById('content_section');
        const headingField = document.getElementById('content_heading');
        const subHeadingField = document.getElementById('content_sub_heading');
        const designWordField = document.getElementById('content_design_word');
        const typeField = document.getElementById('content_type');
        const descriptionField = document.getElementById('content_description');
        const homeAboutTracePresetBtn      = document.getElementById('applyHomeAboutTracePreset');
const homeAboutTraceOnePresetBtn   = document.getElementById('applyHomeAboutTraceOnePreset');
const homeAboutTraceTwoPresetBtn   = document.getElementById('applyHomeAboutTraceTwoPreset');
const homeAboutTraceThreePresetBtn = document.getElementById('applyHomeAboutTraceThreePreset');
const homeYearsPresetBtn           = document.getElementById('applyHomeYearsPreset');

        let contentEditor = null;

        function setDescriptionValue(value) {
            const nextValue = value || '';
            if (descriptionField) {
                descriptionField.value = nextValue;
            }
            if (contentEditor) {
                contentEditor.setData(nextValue);
            }
        }

        // ── Remove Icon ──
const removeIconBtn   = document.getElementById('remove-icon-btn');
const removeIconInput = document.getElementById('remove_icon_input');
const iconPreview     = document.getElementById('icon-preview');

if (removeIconBtn) {
    removeIconBtn.addEventListener('click', function () {
        iconPreview.style.opacity     = '0.3';
        iconPreview.style.filter      = 'grayscale(100%)';
        removeIconInput.value         = '1';
        removeIconBtn.innerHTML       = '<i class="fas fa-undo me-1"></i> Undo';
        removeIconBtn.classList.replace('btn-outline-danger', 'btn-outline-secondary');
        removeIconBtn.dataset.removed = 'true';
    });

    // Undo support
    removeIconBtn.addEventListener('click', function () {
        if (removeIconBtn.dataset.removed === 'true') {
            // already handled above — but swap to undo logic on second click
        }
    });
}

// ── Remove Main Image ──
const removeImageBtn   = document.getElementById('remove-image-btn');
const removeImageInput = document.getElementById('remove_image_input');
const imagePreview     = document.getElementById('image-preview');

if (removeImageBtn) {
    removeImageBtn.addEventListener('click', function () {
        if (removeImageInput.value === '0') {
            // Mark for removal
            imagePreview.style.opacity      = '0.3';
            imagePreview.style.filter       = 'grayscale(100%)';
            removeImageInput.value          = '1';
            removeImageBtn.innerHTML        = '<i class="fas fa-undo me-1"></i> Undo';
            removeImageBtn.classList.replace('btn-outline-danger', 'btn-outline-secondary');
        } else {
            // Undo
            imagePreview.style.opacity      = '1';
            imagePreview.style.filter       = 'none';
            removeImageInput.value          = '0';
            removeImageBtn.innerHTML        = '<i class="fas fa-trash-alt me-1"></i> Remove';
            removeImageBtn.classList.replace('btn-outline-secondary', 'btn-outline-danger');
        }
    });
}

// Same undo toggle for icon
if (removeIconBtn) {
    removeIconBtn.onclick = function () {
        if (removeIconInput.value === '0') {
            iconPreview.style.opacity  = '0.3';
            iconPreview.style.filter   = 'grayscale(100%)';
            removeIconInput.value      = '1';
            removeIconBtn.innerHTML    = '<i class="fas fa-undo me-1"></i> Undo';
            removeIconBtn.classList.replace('btn-outline-danger', 'btn-outline-secondary');
        } else {
            iconPreview.style.opacity  = '1';
            iconPreview.style.filter   = 'none';
            removeIconInput.value      = '0';
            removeIconBtn.innerHTML    = '<i class="fas fa-trash-alt me-1"></i> Remove';
            removeIconBtn.classList.replace('btn-outline-secondary', 'btn-outline-danger');
        }
    };
}

        if (field) {
            ClassicEditor.create(field)
                .then(function (editor) {
                    contentEditor = editor;
                })
                .catch(function (error) {
                    console.error(error);
                });
        }

        if (teamPagePresetBtn) {
            teamPagePresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'team-page';
                if (sectionField) sectionField.value = 'THE PEOPLE BEHIND THE WORK';
                if (headingField) headingField.value = 'Experts who';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = 'drive change.';
                if (typeField) typeField.value = 'Hero';
                setDescriptionValue('TRACE brings together a permanent core team of trade specialists, researchers, and technologists - supported by a network of domain experts engaged on specific projects and engagements.');
            });
        }

        if (insightsPagePresetBtn) {
            insightsPagePresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'insights-page';
                if (sectionField) sectionField.value = 'KNOWLEDGE & RESEARCH';
                if (headingField) headingField.value = 'Ideas that';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = 'move trade forward.';
                if (typeField) typeField.value = 'Hero';
                setDescriptionValue('Op-eds in national newspapers, in-house research, policy publications, and expert videos - TRACE\'s full body of published work.');
            });
        }

        if (projectsPagePresetBtn) {
            projectsPagePresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'projects-page';
                if (sectionField) sectionField.value = 'OUR PROJECTS';
                if (headingField) headingField.value = 'Work that';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = 'changes systems.';
                if (typeField) typeField.value = 'Hero';
                setDescriptionValue('TRACE has delivered trade facilitation reform, laboratory accreditation, digital systems, and policy advisory projects across South Asia — for governments, development banks, and regulatory bodies.');
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
                setDescriptionValue('Locations where this project has been implemented or delivered.');
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
                setDescriptionValue('Phase-wise implementation milestones and downloadable documents.');
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
                setDescriptionValue('Measurable results and outcomes delivered through this project.');
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
                setDescriptionValue('Use type=show to display CTA on project details page; type=hide to hide CTA.');
            });
        }

        if (aboutCommitmentPresetBtn) {
            aboutCommitmentPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_section_3';
                if (sectionField) sectionField.value = 'OUR COMMITMENT';
                if (headingField) headingField.value = 'OUR COMMITMENT';
                if (subHeadingField) subHeadingField.value = 'We are committed to';
                if (designWordField) designWordField.value = 'At Trace Consulting, we do not just advise, we collaborate to create lasting change.';
                if (typeField) typeField.value = 'Section';
                setDescriptionValue('<ul><li>Integrity and transparency in every engagement</li><li>Delivering measurable outcomes, not just recommendations</li><li>Building local capacity and ownership</li><li>Promoting innovation and sustainability in every project</li></ul>');
            });
        }

        if (aboutFrameworkPresetBtn) {
            aboutFrameworkPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_how_we_work';
                if (sectionField) sectionField.value = 'OUR FRAMEWORK';
                if (headingField) headingField.value = 'How We\nWork';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Section';
                setDescriptionValue('Our proven three-stage framework turns complex trade and policy challenges into measurable, lasting outcomes for every client we serve.');
            });
        }

        if (aboutInsightPresetBtn) {
            aboutInsightPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_insight';
                if (sectionField) sectionField.value = 'ABOUT FRAMEWORK ITEM';
                if (headingField) headingField.value = 'Insight';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Framework Item';
                setDescriptionValue('We turn complex trade and policy issues into clear insights using research, data, and deep expertise to transform challenges and risks into well-defined opportunities ready for action.');
            });
        }

        if (aboutStrategyPresetBtn) {
            aboutStrategyPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_strategy';
                if (sectionField) sectionField.value = 'ABOUT FRAMEWORK ITEM';
                if (headingField) headingField.value = 'Strategy';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Framework Item';
                setDescriptionValue('We formulate insights into strategies, devising evidence and technology-driven solutions that meet global standards, align with institutional realities, and drive sustainable growth.');
            });
        }

        if (aboutImpactPresetBtn) {
            aboutImpactPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_impact';
                if (sectionField) sectionField.value = 'ABOUT FRAMEWORK ITEM';
                if (headingField) headingField.value = 'Impact';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Framework Item';
                setDescriptionValue('We deliver measurable and lasting results by reducing barriers, enhancing competitiveness, driving reforms, and embedding the tools clients need to sustain change independently.');
            });
        }

        if (aboutUniqueFeaturesPresetBtn) {
            aboutUniqueFeaturesPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_we_make_trace_different';
                if (sectionField) sectionField.value = 'OUR UNIQUE FEATURES';
                if (headingField) headingField.value = 'What Makes TRACE\nDifferent';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Section';
                setDescriptionValue('TRACE delivers connected, sustainable, and tailored solutions from policy to practice that streamline processes, strengthen institutions, and empower growth.');
            });
        }

        if (aboutIndustryNetworkPresetBtn) {
            aboutIndustryNetworkPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_industry_wide_network';
                if (sectionField) sectionField.value = 'ABOUT UNIQUE FEATURE ITEM';
                if (headingField) headingField.value = 'Industry-wide Network';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Feature Item';
                setDescriptionValue("With proven networks across government agencies and private sector stakeholders, TRACE consistently bridges policy leadership and business realities, enabling reforms prioritising client's need.");
            });
        }

        if (aboutSustainablePresetBtn) {
            aboutSustainablePresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_sustainable_approach';
                if (sectionField) sectionField.value = 'ABOUT UNIQUE FEATURE ITEM';
                if (headingField) headingField.value = 'Sustainable Approach';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Feature Item';
                setDescriptionValue('TRACE works with partners to build sustainable solutions, embedding facilitation tools into legislation, training mechanisms, and digital systems that outlast the engagement.');
            });
        }

        if (aboutTailoredPresetBtn) {
            aboutTailoredPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_tailored_innovation';
                if (sectionField) sectionField.value = 'ABOUT UNIQUE FEATURE ITEM';
                if (headingField) headingField.value = 'Tailored Innovation';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Feature Item';
                setDescriptionValue('From tech-driven trade systems, lab-accreditation roadmaps, or temperature-controlled logistics, TRACE designs solutions customised to sectoral realities and institutional capacity.');
            });
        }

        if (aboutEndToEndPresetBtn) {
            aboutEndToEndPresetBtn.addEventListener('click', function () {
                if (slugField) slugField.value = 'about_us_end_to_end_integrated_solutions';
                if (sectionField) sectionField.value = 'ABOUT UNIQUE FEATURE ITEM';
                if (headingField) headingField.value = 'End-to-End Integrated Solutions';
                if (subHeadingField) subHeadingField.value = '';
                if (designWordField) designWordField.value = '';
                if (typeField) typeField.value = 'Feature Item';
                setDescriptionValue('TRACE provides fully integrated support from strategic design through implementation and evaluation, ensuring every solution works as a connected, coherent whole.');
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
                setDescriptionValue(descriptionField ? descriptionField.value : '');
            });
        }

        if (homeAboutTracePresetBtn) {
    homeAboutTracePresetBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'home_about_trace';
        if (sectionField) sectionField.value = 'ABOUT TRACE';
        if (headingField) headingField.value = 'Transforming Challenges into Opportunities';
        if (subHeadingField) subHeadingField.value = '';
        if (designWordField) designWordField.value = 'Opportunities';
        if (typeField) typeField.value = 'About Section';
        setDescriptionValue('TRACE focuses on international trade, policy reform, and development, working with governments, business groups, and the private sector to strengthen market systems.');
    });
}

if (homeAboutTraceOnePresetBtn) {
    homeAboutTraceOnePresetBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'home_about_trace_one';
        if (sectionField) sectionField.value = 'HOME ABOUT ITEM';
        if (headingField) headingField.value = 'Multi-Sector Expertise & Global Reach';
        if (subHeadingField) subHeadingField.value = '';
        if (designWordField) designWordField.value = '';
        if (typeField) typeField.value = 'List Item';
        setDescriptionValue('Deep knowledge across industries, backed by an objective perspective and access to global networks.');
    });
}

if (homeAboutTraceTwoPresetBtn) {
    homeAboutTraceTwoPresetBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'home_about_trace_two';
        if (sectionField) sectionField.value = 'HOME ABOUT ITEM';
        if (headingField) headingField.value = 'Proven Methodologies, Policy to Practice';
        if (subHeadingField) subHeadingField.value = '';
        if (designWordField) designWordField.value = '';
        if (typeField) typeField.value = 'List Item';
        setDescriptionValue('Rigorous, scalable approaches that translate evidence into implementable reforms.');
    });
}

if (homeAboutTraceThreePresetBtn) {
    homeAboutTraceThreePresetBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'home_about_trace_three';
        if (sectionField) sectionField.value = 'HOME ABOUT ITEM';
        if (headingField) headingField.value = 'Change Management & Creative Innovation';
        if (subHeadingField) subHeadingField.value = '';
        if (designWordField) designWordField.value = '';
        if (typeField) typeField.value = 'List Item';
        setDescriptionValue('Combining structured change management with innovative, context-driven solutions.');
    });
}

if (homeYearsPresetBtn) {
    homeYearsPresetBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'home_years_of_expertise';
        if (sectionField) sectionField.value = 'HOME BADGE';
        if (headingField) headingField.value = '8+';
        if (subHeadingField) subHeadingField.value = '';
        if (designWordField) designWordField.value = '';
        if (typeField) typeField.value = 'Badge';
        setDescriptionValue('Years of Expertise');
    });
}

        // About Header Preset
const aboutHeaderBtn = document.getElementById('applyAboutHeaderPreset');
if (aboutHeaderBtn) {
    aboutHeaderBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'about_us_header';
        if (sectionField) sectionField.value = 'ABOUT US';
        if (headingField) headingField.value = 'Empowering Change through Insightful Consulting';
        if (designWordField) designWordField.value = 'Insightful';
        if (typeField) typeField.value = 'Hero Section';
        setDescriptionValue('We deliver evidence-based policy recommendations and advocacy that help governments design actionable, impactful reforms from the ground up.');
    });
}

// About Trace Preset
const aboutTraceBtn = document.getElementById('applyAboutTracePreset');
if (aboutTraceBtn) {
    aboutTraceBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'about_trace';
        if (sectionField) sectionField.value = 'ABOUT TRACE';
        if (headingField) headingField.value = 'A firm built on insight, strategy, and lasting impact.';
        if (designWordField) designWordField.value = 'insight, strategy,';
        if (typeField) typeField.value = 'About Section';
        setDescriptionValue('A firm built on insight, strategy, and lasting impact.');
    });
}

// Who We Are Preset
const whoWeAreBtn = document.getElementById('applyWhoWeArePreset');
if (whoWeAreBtn) {
    whoWeAreBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'about_us_who_we_are';
        if (sectionField) sectionField.value = 'ABOUT US DETAILS';
        if (headingField) headingField.value = 'Who We Are';
        if (designWordField) designWordField.value = '';
        if (typeField) typeField.value = 'Detail Item';
        setDescriptionValue('We work at the intersection of research, innovation, and implementation— empowering institutions with data-driven insights.');
    });
}

// Our Mission Preset
const ourMissionBtn = document.getElementById('applyOurMissionPreset');
if (ourMissionBtn) {
    ourMissionBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'about_us_our_mission';
        if (sectionField) sectionField.value = 'ABOUT US DETAILS';
        if (headingField) headingField.value = 'Our Mission';
        if (designWordField) designWordField.value = '';
        if (typeField) typeField.value = 'Detail Item';
        setDescriptionValue('Our mission is to provide high-quality, evidence-based consulting services.');
    });
}

// Partners Section Preset
const partnersBtn = document.getElementById('applyPartnersPreset');
if (partnersBtn) {
    partnersBtn.addEventListener('click', function () {
        document.getElementById('slug').value = 'about_us_partners'; // Slug oboshoy matching hote hobe
        document.getElementById('section').value = 'ABOUT US DETAILS';
        document.getElementById('heading').value = 'Trusted by Leading Institutions';
        document.getElementById('design_word').value = 'Institutions';
        document.getElementById('type').value = 'Partners Section';
        
        // Description value set kora
        if (typeof setDescriptionValue === "function") {
            setDescriptionValue('We work with governments, multilateral development organisations, regulatory bodies, and private sector leaders across the region — building long-term partnerships grounded in trust and results.');
        }
        
        toastr.success('Partners preset applied!');
    });
}

    // Career Page Header Preset
const careerHeaderBtn = document.getElementById('applyCareerHeaderPreset');
if (careerHeaderBtn) {
    careerHeaderBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'career-heading';
        if (sectionField) sectionField.value = 'CAREER PAGE';
        if (headingField) headingField.value = 'Career at Trace Consultancy';
        if (designWordField) designWordField.value = 'Trace Consultancy';
        if (typeField) typeField.value = 'Hero Section';
        
        // Description field-e value boshano
        if (typeof setDescriptionValue === "function") {
            setDescriptionValue('TRACE is a growing team of trade specialists, researchers, technologists, and project managers working on some of the most consequential reform programmes in South Asia.');
        }
        
        toastr.success('Career Header preset applied!');
    });
}

// Contact Page Header Preset
const contactHeaderBtn = document.getElementById('applyContactHeaderPreset');
if (contactHeaderBtn) {
    contactHeaderBtn.addEventListener('click', function () {
        if (slugField) slugField.value = 'contact-us-head';
        if (sectionField) sectionField.value = 'CONTACT PAGE';
        if (headingField) headingField.value = "Let's start a conversation.";
        if (designWordField) designWordField.value = 'conversation.';
        if (typeField) typeField.value = 'Hero Section';
        
        if (typeof setDescriptionValue === "function") {
            setDescriptionValue("Whether you're a government agency, development partner, or private company — TRACE is ready to listen, advise, and collaborate. Reach out and we'll respond within one business day.");
        }
        
        toastr.success('Contact Header preset applied!');
    });
}


    })();
</script>
@endpush