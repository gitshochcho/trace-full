@extends('frontend.layout.app')


@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* Layout Constants */
:root {
    --bg-dark: #01354B;
    --text-teal: #4CC3C3;
    --accent-orange: #F47735;
    --border-color: #E5E9ED;
    --max-content-width: 1072px;
}

/* Centering Container */
.container-custom {
    max-width: var(--max-content-width);
    margin: 0 auto;
    padding: 0 15px; 
    
}

/* Breadcrumb */
.projects-breadcrumb {
    background: #F8F9FB;
    border-bottom: 1px solid #E5E9ED;
    padding: 12px 0;
}
.breadcrumb-links { font-size: 13px; color: #94A3B8; }
.breadcrumb-links a { color: #64748B; text-decoration: none; }
.breadcrumb-links .sep { margin: 0 8px; }
.breadcrumb-links .active { color: #01354B; font-weight: 600; }


/* Hero Section Adjustments */
.hero-dark {
    background: var(--bg-dark);
    height: 400px;
    padding-top: 60px; 
    color: white;
    position: relative;
    background-image: radial-gradient(circle at 100% 50%, rgba(255,255,255,0.05) 0%, transparent 60%); /* ডানদিকের হালকা সার্কেল ইফেক্ট */
}

.accent-line {
    width: 24px;
    height: 2px;
    background: var(--accent-orange);
    margin-right: 12px;
}

.small-tracking {
    letter-spacing: 1.5px;
    font-size: 13px;
    font-weight: 600;
    color: #4DC0C4;
}

.hero-title {
    font-size: 48px; /* বড় এবং বোল্ড টাইটেল */
    line-height: 1.1;
    letter-spacing: -1px;
}

.text-teal {
    color: var(--text-teal) !important;
}

.hero-description {
    font-size: 16px;
    line-height: 1.6;
    max-width: 650px;
    color: rgba(255, 255, 255, 0.7); /* হালকা সাদা টেক্সট */
}

/* Filter Nav Adjustments */
.filter-nav {
    background: #FFFFFF;
    height: 60px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: center;
}

.filter-nav-container {
    max-width: var(--max-content-width);
    width: 100%;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 15px;
}

.filter-tabs-wrapper {
    flex: 1;
    overflow: hidden;
    position: relative;
}

.filter-tabs {
    display: flex;
    white-space: nowrap;
    flex-wrap: nowrap;
    transition: transform 0.3s ease;
    gap: 0;
}

.filter-tabs .nav-item {
    flex-shrink: 0;
}

.filter-tabs .nav-link {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
    padding: 18px 20px;
    transition: all 0.3s;
    display: block;
    white-space: nowrap;
    position: relative;
}

.scroll-btn {
    background: #F47735;
    color: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    flex-shrink: 0;
}

.scroll-btn:hover {
    background: #d9622a;
    transform: scale(1.05);
}

.scroll-btn:disabled {
    background: #cccccc;
    cursor: not-allowed;
    opacity: 0.6;
}

.project-count {
    flex-shrink: 0;
    white-space: nowrap;
    font-size: 13px;
}

.filter-tabs .nav-link.active {
    color: #01354B !important;
    font-weight: 700;
}

.filter-tabs .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -1px; /* বর্ডারের সাথে মিশে থাকবে */
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--accent-orange);
}

.badge-count {
    background: #F0F2F5;
    color: #888;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 10px;
    margin-left: 6px;
    font-weight: normal;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .hero-dark { height: auto; padding: 60px 0; }
}

/* Card Styling */
.project-card {
    background: #fff;
    border: 1px solid #E5E9ED;
    border-radius: 16px; /* Image er moto ektu beshi round */
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.project-img-box {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.project-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.category-tag {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(1, 53, 75, 0.9);
    color: #fff;
    font-size: 10px;
    font-weight: bold;
    padding: 4px 10px;
    border-radius: 4px;
}

.year-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #FF8A5B;
    color: #fff;
    font-size: 10px;
    font-weight: bold;
    padding: 4px 10px;
    border-radius: 4px;
}

.project-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1; /* Eta empty space consume kore footer ke niche thakbe */
}

.client-name {
    color: #4CC3C3;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}

.project-title {
    font-size: 18px;
    font-weight: 700;
    color: #01354B;
    margin-bottom: 12px;
    line-height: 1.4;
}
.project-standard{
    font-size: 18px;
    font-weight: 700;
    color: #01354B;
    /* margin-bottom: 12px; */
    line-height: 1.4;
}
.project-footer {
    width: 100%; /* Apnar dewa width (approx) container onusare auto nibe */
    min-height: 31px;
    padding-top: 14px;
    margin-top: 20px; /* Magic: footer ke ekbare niche niye jabe */
    border-top: 1px solid #E5E9ED; /* Border-top visible kora */
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.project-bio {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 15px;
    flex-grow: 1; /* Content choto holeo footer niche thakbe */
}

.project-tags span {
    display: inline-block;
    background: #F1F4F7;
    color: #6c757d;
    font-size: 11px;
    padding: 3px 12px;
    border-radius: 20px;
    margin-right: 5px;
    margin-bottom: 5px;
}



.view-link {
    font-weight: 700;
    font-size: 13px;
    color: #00898e; /* Photo er teal color er moto */
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
}

.view-link:hover {
    color: #4CC3C3;
}

.status {
    font-size: 13px;
    color: #adb5bd; /* Photo er moto light gray */
}


</style>
@endpush


@section('content')
@php
    $projectsHero = $projectsHero ?? contentBlock('projects-page');
    $heroSection     = $projectsHero?->section     ?? '';
    $heroHeading     = $projectsHero?->heading     ?? '';
    $heroHighlight   = $projectsHero?->design_word ?? '';
    $heroDescription = $projectsHero?->description ?? '';
    $projectCount = is_countable($projects ?? null) ? count($projects) : 0;
@endphp

<nav class="projects-breadcrumb">
    <div class="container-custom">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">›</span>
            <span class="active">Our Projects</span>
        </div>
    </div>
</nav>

<section class="hero-dark">
    <div class="container-custom">
        <div class="hero-content">
            <div class="d-flex align-items-center mb-2">
                <div class="accent-line"></div>
                <p class="text-uppercase small-tracking mb-0">{{ $heroSection }}</p>
            </div>

            <h1 class="hero-title fw-bold">{{ $heroHeading }} <br><span class="text-teal">{{ $heroHighlight }}</span></h1>

            <p class="hero-description mt-4">
                {!! nl2br(e(strip_tags($heroDescription))) !!}
            </p>
        </div>
    </div>
</section>

<section class="filter-nav">
    <div class="filter-nav-container">
        <button class="scroll-btn scroll-left" id="scrollLeft" onclick="scrollTabs('left')" title="Scroll left">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="filter-tabs-wrapper">
            <ul class="nav filter-tabs" id="filterTabs">
                <li class="nav-item">
                    <a class="nav-link {{ empty($selectedService) ? 'active' : '' }}" href="{{ route('projects') }}">All Projects <span class="badge-count">{{ $projectCount }}</span></a>
                </li>
                @foreach($services as $service)
                    <li class="nav-item">
                        <a class="nav-link {{ (int) $selectedService === (int) $service->id ? 'active' : '' }}" href="{{ route('projects', ['service' => $service->id]) }}">
                            {{ $service->section ?: $service->service_name }} <span class="badge-count">{{ $service->projects_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <button class="scroll-btn scroll-right" id="scrollRight" onclick="scrollTabs('right')" title="Scroll right">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="project-count text-muted small">
            Showing <strong>{{ $projectCount }}</strong> projects
        </div>
    </div>
</section>

<script>
    function scrollTabs(direction) {
        const filterTabs = document.getElementById('filterTabs');
        const scrollAmount = 200;
        const currentTransform = parseInt(filterTabs.style.transform.match(/-?\d+/)?.[0] || 0);
        
        if (direction === 'left') {
            filterTabs.style.transform = `translateX(${currentTransform + scrollAmount}px)`;
        } else {
            filterTabs.style.transform = `translateX(${currentTransform - scrollAmount}px)`;
        }
        
        updateScrollButtons();
    }
    
    function updateScrollButtons() {
        const filterTabs = document.getElementById('filterTabs');
        const wrapper = document.querySelector('.filter-tabs-wrapper');
        const scrollLeftBtn = document.getElementById('scrollLeft');
        const scrollRightBtn = document.getElementById('scrollRight');
        
        const translateX = parseInt(filterTabs.style.transform.match(/-?\d+/)?.[0] || 0);
        const maxScroll = -(filterTabs.scrollWidth - wrapper.clientWidth);
        
        scrollLeftBtn.disabled = translateX >= 0;
        scrollRightBtn.disabled = translateX <= maxScroll;
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        updateScrollButtons();
        window.addEventListener('resize', updateScrollButtons);
    });
</script>

<section class="project-grid-section py-5">
    <div class="container-custom">
        <div class="row g-4">
            @forelse($projects as $project)
                @php
                    $projectImage     = $project->heroImageUrl() ?? '';
                    $projectYear      = $project->start_date?->format('Y');
                    $projectYearEnd   = $project->end_date?->format('Y');
                    $projectYearLabel = $projectYear && $projectYearEnd ? $projectYear . '-' . $projectYearEnd : ($projectYear ?? $projectYearEnd ?? '');
                    $firstSvc         = $project->services->first();
                    $projectCategory  = $firstSvc?->section ?? $firstSvc?->service_name ?? $project->project_standard ?? '';
                    $projectTags      = $project->services->take(3);
                    $projectDesc      = stripPTags($project->overview) ?? '';
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="project-card h-100 shadow-sm">
                        <div class="project-img-box">
                            <img src="{{ $projectImage }}" alt="{{ $project->project_title }}">
                            <span class="category-tag">{{ $projectCategory }}</span>
                            <span class="year-badge">{{ $projectYearLabel ?: ($project->project_status ?? '') }}</span>
                        </div>

                        <div class="project-content">
                            <h6 class="client-name text-uppercase">{{ abbreviateClientName($project->client) ?? '' }}</h6>
                            <h4 class="project-standard">{{ $project->project_standard ?: '' }}</h4>
                            <h4 class="project-title">{{ $project->project_title }}</h4>
                            <p class="project-bio text-muted">{{ \Illuminate\Support\Str::limit($projectDesc, 140) }}</p>

                            <div class="project-tags">
                                @forelse($projectTags as $tag)
                                    <span>{{ $tag->section ?: $tag->service_name }}</span>
                                @empty
                                    <span>{{ $project->project_standard ?: $project->project_status }}</span>
                                @endforelse
                            </div>

                            <div class="project-footer d-flex justify-content-between align-items-center">
                                <span class="status text-muted">{{ $projectYearLabel ?: 'Ongoing' }} • {{ $project->project_status }}</span>
                                <a href="{{ route('projectdetails', $project) }}" class="view-link">View Project <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 text-muted border rounded bg-white">
                        No projects found yet.
                    </div>
                </div>
            @endforelse
        </div>
        </div>
    </div>
</section>

@include('frontend.layout.cta')
@endsection