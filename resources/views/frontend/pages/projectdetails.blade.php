@extends('frontend.layout.app')


@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
.custom-container-inner,
.custom-container {
    max-width: 1072px;
    margin: 0 auto;
    width: 100%;
    padding: 0 15px;
}

.breadcrumb-container {
    background: #F8F9FB;
    min-height: 43px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #E5E9ED;
}

.breadcrumb-links { font-size: 13px; color: #64748B; }
.breadcrumb-links a { color: #64748B; text-decoration: none; }
.breadcrumb-links .sep { margin: 0 10px; color: #CBD5E1; }
.breadcrumb-links .active { color: #01354B; font-weight: 600; }

.hero-details-section {
    position: relative;
    background-color: #01354B;
    background-size: cover;
    background-position: center;
    padding: 80px 0 60px;
    color: #fff;
    min-height: 520px;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(1, 53, 75, 0.55);
    z-index: 1;
}

.z-index-2 { position: relative; z-index: 2; }
.back-link { font-size: 14px; color: rgba(255,255,255,0.75); }
.back-link:hover { color: #4CC3C3; }

.badge-custom {
    font-size: 11px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 4px;
    letter-spacing: .5px;
}

.badge-teal { background: #008080; color: #fff; }
.badge-outline-green {
    background: rgba(76,195,195,.1);
    border: 1px solid #4CC3C3;
    color: #4CC3C3;
}

.sub-heading { font-size: 32px; font-weight: 700; color: #fff; }
.main-heading { font-size: 56px; font-weight: 700; line-height: 1.1; }

.project-meta-footer { border-top: 1px solid rgba(255,255,255,.15); }
.meta-item {
    font-size: 14px;
    color: rgba(255,255,255,.86);
    display: flex;
    align-items: center;
    gap: 8px;
}

.section-title-accent {
    font-size: 20px;
    font-weight: 700;
    color: #01354B;
    position: relative;
    padding-left: 15px;
}

.section-title-accent::before {
    content: '';
    position: absolute;
    left: 0;
    top: 4px;
    width: 3px;
    height: 20px;
    background: #F47735;
}

.project-gallery-wrapper { display: flex; gap: 12px; }
.col-gallery-main { width: 442px; max-width: 100%; }
.col-gallery-side { width: 221px; max-width: 100%; }
.gap-custom { gap: 12px; }

.gallery-img-main,
.gallery-img-side {
    width: 100%;
    object-fit: cover;
    border-radius: 12px;
}

.gallery-img-main { height: 372px; }
.gallery-img-side { height: 180px; }

.overview-content p,
.outcomes-list li {
    font-size: 15px;
    line-height: 1.6;
    color: #4B5563;
}

.outcomes-list li {
    margin-bottom: 15px;
    display: flex;
    align-items: flex-start;
}

.outcomes-list i { color: #4CC3C3; margin-top: 4px; }

.project-sidebar {
    gap: 20px;
    display: flex;
    flex-direction: column;
    position: sticky;
    top: 20px;
    align-self: flex-start;
}

.facts-card {
    border: 1px solid #E5E9ED;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    width: 340px;
    max-width: 100%;
}

.facts-header { background: #01354B; padding: 16px 20px; }
.extra-small { font-size: 11px; }
.facts-body { padding: 8px 20px 20px; }

.fact-row {
    display: flex;
    justify-content: space-between;
    gap: 8px;
    padding: 12px 0;
    border-bottom: 1px solid #F1F4F7;
    font-size: 13px;
}

.fact-row .label { color: #64748B; }
.fact-row .value { color: #01354B; font-weight: 600; text-align: right; }

.status-badge {
    color: #10B981;
    font-weight: 600;
    font-size: 13px;
}

.status-badge .dot {
    height: 8px;
    width: 8px;
    background: #10B981;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
}

.cta-sidebar-dark {
    width: 340px;
    max-width: 100%;
    border-radius: 16px;
    background: linear-gradient(133.37deg, #01354B 0%, #014D6A 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.btn-expert-orange {
    width: 243px;
    max-width: 100%;
    height: 41px;
    background: #F55F1A;
    color: #fff;
    border-radius: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: .3s;
}

.btn-expert-orange:hover { background: #d44d15; color: #fff; }

.more-projects-section {
    width: 100%;
    background: #F8F9FB;
    border-top: 1px solid #E5E9ED;
    padding: 72px 0;
}

.custom-container-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 60px;
}

.section-title { font-size: 24px; font-weight: 700; color: #01354B; }
.view-all-link { font-size: 14px; font-weight: 600; color: #008080; }

.project-mini-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    height: 100%;
    border: 1px solid #E5E9ED;
}

.card-img-wrapper { height: 180px; overflow: hidden; }
.card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
.card-content { padding: 20px; }
.client-name { font-size: 11px; font-weight: 700; color: #008080; display: block; margin-bottom: 8px; }
.project-mini-title { font-size: 15px; font-weight: 700; color: #01354B; line-height: 1.4; margin-bottom: 12px; }
.project-mini-meta { font-size: 12px; color: #64748B; margin-bottom: 0; }

@media (max-width: 991px) {
    .main-heading { font-size: 36px; }
    .hero-details-section { padding-top: 60px; }
    .project-sidebar { position: static; }
}

@media (max-width: 768px) {
    .custom-container-content { padding: 0 20px; }
    .project-gallery-wrapper { flex-direction: column; width: 100% !important; }
    .col-gallery-main, .col-gallery-side { width: 100%; }
    .gallery-img-main, .gallery-img-side { height: auto; }
    .more-projects-section { padding: 40px 0; }
}
</style>
@endpush


@section('content')
@php
    $heroImage = $project->imageUrl() ?? '';
    $heroBadge = $project->services->first()?->service_name ?? $project->project_standard ?? '';
    $galleryImages = $project->galleryImageUrls();
    $galleryMain = $galleryImages[0]['url'] ?? $heroImage;
    $gallerySideOne = $galleryImages[1]['url'] ?? $galleryMain;
    $gallerySideTwo = $galleryImages[2]['url'] ?? $gallerySideOne;
    $locationSummary = $project->locations->first()?->location;
    $locationSummary = $locationSummary ? strip_tags($locationSummary) : 'Location available inside the project brief';
    $serviceNames = $project->services->pluck('service_name')->filter()->values();

    $locationSectionContent = contentBlock('project-location-section');
    $phaseSectionContent = contentBlock('project-phase-section');
    $outcomeSectionContent = contentBlock('project-outcome-section');

    $locationHeading     = $locationSectionContent?->heading     ?? '';
    $locationDescription = $locationSectionContent?->description ?? '';
    $phaseHeading        = $phaseSectionContent?->heading        ?? '';
    $phaseDescription    = $phaseSectionContent?->description    ?? '';
    $outcomeHeading      = $outcomeSectionContent?->heading      ?? '';
    $outcomeDescription  = $outcomeSectionContent?->description  ?? '';

    $projectWorkWithUsControl = contentBlock('projects-work-with-us');
    $showWorkWithUs = ! in_array(
        strtolower(trim((string) ($projectWorkWithUsControl?->type ?? 'show'))),
        ['hide', '0', 'false', 'off'],
        true
    );
@endphp

<nav class="breadcrumb-container">
    <div class="custom-container-inner">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">›</span>
            <a href="/projects">Projects</a>
            <span class="sep">›</span>
            <span class="active">{{ $project->project_title }}</span>
        </div>
    </div>
</nav>

<section class="hero-details-section" style="background-image: url('{{ $heroImage }}');">
    <div class="hero-overlay"></div>
    
    <div class="custom-container-inner position-relative z-index-2">
        <a href="{{ route('projects') }}" class="back-link mb-5 d-inline-block text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i> Back to All Projects
        </a>

        <div class="d-flex gap-2 mb-4">
            <span class="badge-custom badge-teal">{{ $heroBadge }}</span>
            <span class="badge-custom badge-outline-green"><i class="fas fa-check me-1"></i> {{ $project->project_status }}</span>
        </div>

        <div class="project-title-wrapper">
            <h2 class="sub-heading mb-0">{{ $project->project_standard ?? '' }}</h2>
            <h1 class="main-heading">{{ $project->project_title }}</h1>
        </div>

        <div class="client-meta mb-5">
            <p class="mb-0 text-white-50">Client: <span class="text-white fw-medium">{{ abbreviateClientName($project->client) ?? '' }}</span></p>
        </div>

        <div class="project-meta-footer d-flex flex-wrap gap-4 pt-4 border-top border-white-5">
            <div class="meta-item">
                <i class="far fa-calendar-alt"></i> {{ $project->durationLabel() ?? '' }}
            </div>
            <div class="meta-item">
                <i class="fas fa-map-marker-alt"></i> {{ $locationSummary }}
            </div>
            <div class="meta-item">
                <i class="fas fa-briefcase"></i> {{ $serviceNames->isNotEmpty() ? $serviceNames->take(2)->join(' / ') : 'Project Services' }}
            </div>
            <div class="meta-item">
                <i class="fas fa-layer-group"></i> {{ $project->phaseDetails->count() }} Deliverable Phases
            </div>
        </div>
    </div>
</section>

<section class="project-details-body py-5">
    <div class="custom-container">
        <div class="row gx-lg-5">
            <div class="col-lg-8">
                <div class="overview-content mb-5">
                    <h3 class="section-title-accent">Project Overview</h3>
                    <p class="mt-4">{{ stripPTags($project->overview) ?? '' }}</p>
                </div>

                {{-- <div class="mb-5">
                    <h3 class="section-title-accent">{{ $locationHeading }}</h3>
                    @if(!empty($locationDescription))
                        <p class="mt-3">{{ strip_tags($locationDescription) }}</p>
                    @endif
                    <div class="row g-3 mt-4">
                        @forelse($project->locations as $location)
                            <div class="col-md-6">
                                <div class="border rounded-3 bg-white p-4 h-100 shadow-sm">
                                    {!! nl2br(e(strip_tags($location->location))) !!}
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="border rounded-3 bg-white p-4 text-muted">
                                    No project locations have been added yet.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div> --}}

                <div class="row g-3 mb-5 project-gallery-wrapper" style="width: 676px;">
                    <div class="col-gallery-main">
                        <img src="{{ $galleryMain }}"
                             class="img-fluid gallery-img-main"
                             alt="{{ $project->project_title }}">
                    </div>

                    <div class="col-gallery-side">
                        <div class="d-flex flex-column gap-custom">
                            <img src="{{ $gallerySideOne }}"
                                 class="img-fluid gallery-img-side"
                                 alt="{{ $project->project_title }}">
                            <img src="{{ $gallerySideTwo }}"
                                 class="img-fluid gallery-img-side"
                                 alt="{{ $project->project_title }}">
                        </div>
                    </div>
                </div>

                {{-- <div class="mb-5">
                    <h3 class="section-title-accent">{{ $phaseHeading }}</h3>
                    @if(!empty($phaseDescription))
                        <p class="mt-3">{{ strip_tags($phaseDescription) }}</p>
                    @endif
                    <div class="d-grid gap-3 mt-4">
                        @forelse($project->phaseDetails as $phase)
                            <div class="border rounded-3 bg-white p-4 shadow-sm">
                                <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                    <div class="flex-grow-1">
                                        <div>{!! nl2br(e(strip_tags($phase->phase_description))) !!}</div>
                                    </div>
                                    @if($phase->attachmentUrl())
                                        <a href="{{ $phase->attachmentUrl() }}" target="_blank" class="view-link text-nowrap">
                                            PDF Attachment <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="border rounded-3 bg-white p-4 text-muted">
                                No phase details have been added yet.
                            </div>
                        @endforelse
                    </div>
                </div> --}}

                <div class="outcomes-content">
                    <h3 class="section-title-accent">{{ $outcomeHeading }}Key Outcomes</h3>
                    @if(!empty($outcomeDescription))
                        <p class="mt-3">{{ strip_tags($outcomeDescription) }}</p>
                    @endif
                    <ul class="outcomes-list list-unstyled mt-4">
                        @forelse($project->outcomes as $outcome)
                            <li>
                                <i class="{{ $outcome->icon ?? 'fas fa-check-circle' }} me-2"></i>
                                <span>{!! nl2br(e(strip_tags($outcome->text))) !!}</span>
                            </li>
                        @empty
                            <li><i class="fas fa-check-circle me-2"></i> No outcomes have been added yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
<aside class="project-sidebar" style="width: 340px;">
    <div class="facts-card mb-4 shadow-sm">
        <div class="facts-header">
            <h6 class="mb-1 fw-bold text-white">Project Facts</h6>
            <p class="mb-0 extra-small text-white-50">{{ $project->project_standard ?? '' }}{{ $project->project_standard && $project->client ? ' — ' : '' }}{{ abbreviateClientName($project->client) ?? '' }}</p>
        </div>
        <div class="facts-body">
            <div class="fact-row">
                <span class="label">Client</span>
                <span class="value text-end">{{ abbreviateClientName($project->client) ?? '' }}</span>
            </div>
            @if($project->project_standard)
            <div class="fact-row">
                <span class="label">Project Code</span>
                <span class="value text-end" style="font-family: monospace; font-size: 12px;">{{ $project->project_standard }}</span>
            </div>
            @endif
            <div class="fact-row">
                <span class="label">Sector</span>
                <span class="value text-end">{{ $heroBadge }}</span>
            </div>
            <div class="fact-row">
                <span class="label">Standard</span>
                <span class="value text-end">{{ $project->project_standard ?? '' }}</span>
            </div>
            <div class="fact-row">
                <span class="label">Location</span>
                <span class="value text-end">{{ \Illuminate\Support\Str::limit($locationSummary, 45) }}</span>
            </div>
            <div class="fact-row">
                <span class="label">Duration</span>
                <span class="value text-end">{{ $project->durationLabel() ?? '' }}</span>
            </div>
            <div class="fact-row border-0">
                <span class="label">Phases</span>
                <span class="value text-end">{{ $project->phaseDetails->count() }} Deliverable Phases</span>
            </div>
            <div class="status-row pt-3 mt-2 border-top">
                <span class="label text-muted">Status</span>
                <span class="status-badge">
                    <span class="dot"></span> {{ $project->project_status }}
                </span>
            </div>
        </div>
    </div>

    <div class="cta-sidebar-dark text-center">
        <h5 class="fw-bold text-white mb-2">Need accreditation support for your laboratory?</h5>
        <p class="small text-white-50 mb-4 px-3">Get in touch and our team will walk you through our solutions.</p>
        
        <a href="#" class="btn-expert-orange">
            Talk to Our Experts <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</aside>
</section>

<section class="more-projects-section">
    <div class="custom-container-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">More Projects</h2>
            <a href="/projects" class="view-all-link text-decoration-none">
                View all projects <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($relatedProjects as $item)
                @php
                    $itemImage     = $item->imageUrl() ?? '';
                    $itemSector    = $item->services->first()?->service_name ?? $item->project_standard ?? '';
                    $itemYear      = $item->start_date?->format('Y');
                    $itemYearEnd   = $item->end_date?->format('Y');
                    $itemYearLabel = $itemYear && $itemYearEnd ? $itemYear . '–' . $itemYearEnd : ($itemYear ?? $itemYearEnd ?? '');
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="project-mini-card">
                        <div class="card-img-wrapper">
                            <img src="{{ $itemImage }}" alt="{{ $item->project_title }}" class="img-fluid">
                        </div>
                        <div class="card-content">
                            <span class="client-name text-uppercase">{{ abbreviateClientName($item->client) ?? '' }}</span>
                            <h4 class="project-mini-title">{{ $item->project_title }}</h4>
                            <p class="project-mini-meta">{{ $itemSector }} · {{ $itemYearLabel ?: ($item->project_status ?? '') }}</p>
                            <a href="{{ route('projectdetails', $item) }}" class="view-link mt-2 d-inline-flex">View Project <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="border rounded-3 bg-white p-4 text-muted">
                        No related projects found.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@if($showWorkWithUs)
@include('frontend.layout.cta')
@endif
@endsection