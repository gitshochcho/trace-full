@extends('frontend.layout.app')


@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

.custom-container-inner {
    max-width: 1072px; 
    margin: 0 auto; 
    width: 100%;
    padding: 0 15px; 
}

/* Breadcrumb Styles */
.breadcrumb-container {
    background: #F8F9FB;
    height: 43px; 
    display: flex;
    align-items: center;
    border-bottom: 1px solid #E5E9ED;
    width: 100%;
}

.breadcrumb-links { 
    font-size: 13px; 
    color: #64748B; 
    text-align: left; 
}

.breadcrumb-links a { 
    color: #64748B; 
    text-decoration: none; 
    transition: 0.3s;
}

.breadcrumb-links a:hover {
    color: #01354B;
}

.breadcrumb-links .sep { 
    margin: 0 10px; 
    color: #CBD5E1; 
}

.breadcrumb-links .active { 
    color: #01354B; 
    font-weight: 600; 
}

@media (max-width: 1072px) {
    .custom-container-inner {
        padding: 0 20px;
    }
}


/* Hero Section Styles */
.hero-details-section {
    position: relative;
    background-color: #01354B;
    background-size: cover;
    background-position: center;
    padding: 80px 0 60px 0;
    color: white;
    min-height: 520px;
}

/* Dark Image Overlay */
.hero-overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    z-index: 1;
}

.z-index-2 { z-index: 2; }

/* Back Link */
.back-link {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.7);
    transition: 0.3s;
}
.back-link:hover { color: #4CC3C3; }

/* Badges */
.badge-custom {
    font-size: 11px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 4px;
    letter-spacing: 0.5px;
}
.badge-teal { background: #008080; color: white; }
.badge-outline-green { 
    background: rgba(76, 195, 195, 0.1); 
    border: 1px solid #4CC3C3; 
    color: #4CC3C3; 
}

/* Headings */
.sub-heading { font-size: 32px; font-weight: 700; color: white; }
.main-heading { font-size: 56px; font-weight: 700; line-height: 1.1; margin-top: -5px; }

/* Footer Meta */
.project-meta-footer { border-top: 1px solid rgba(255,255,255,0.1); }
.meta-item {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    gap: 8px;
}
.meta-item i { color: rgba(255,255,255,0.4); }

/* Responsive */
@media (max-width: 991px) {
    .main-heading { font-size: 36px; }
    .hero-details-section { padding-top: 60px; }
}

/* Container Fix (1072px base) */
.custom-container {
    max-width: 1072px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Titles with Accent Line */
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
    background-color: #F47735; /* Orange accent from image */
}

/* Gallery Container Fix */
.project-gallery-wrapper {
    width: 676px;
    height: 372.31px;
    display: flex;
    gap: 12px; /* column-gap: 12px */
    margin-bottom: 3rem;
}

/* Main Image Container (Column 1) */
.col-gallery-main {
    width: 442.66px;
    height: 372.31px;
}

.gallery-img-main {
    width: 100%;
    height: 100%;
    object-fit: cover;
     border-radius: 16px 0px 0px 16px; 
}


.col-gallery-side {
    width: 221.33px;
    height: 372.31px;
}

.gap-custom {
    gap: 12px; 
}

.gallery-img-side {
    width: 221.33px;
    height: 180.16px; 
    object-fit: cover;
    border-radius: 0px 16px 16px 0px; 
}

@media (max-width: 768px) {
    .project-gallery-wrapper {
        width: 100%;
        height: auto;
        flex-direction: column;
    }
    .col-gallery-main, .col-gallery-side, .gallery-img-side {
        width: 100%;
        height: auto;
    }
}

/* Overview and Outcomes Text */
.overview-content p, .outcomes-list li {
    font-size: 15px;
    line-height: 1.6;
    color: #4B5563;
}
.outcomes-list li {
    margin-bottom: 15px;
    display: flex;
    align-items: flex-start;
}
.outcomes-list i {
    color: #4CC3C3; /* Teal color for icons */
    margin-top: 4px;
}
/* Responsive Fixes */
@media (max-width: 991px) {
    .facts-card { margin-top: 40px; }
    .sticky-top { position: relative !important; top: 0 !important; }
}

/* Sidebar Container */
.project-sidebar {
    gap: 20px;
    display: flex;
    flex-direction: column;
}

/* 1. Project Facts Card */
.facts-card {
    border: 1px solid #E5E9ED;
    border-radius: 12px;
    overflow: hidden;
    background: white;
    width: 340px;
}
.facts-header {
    background: #01354B;
    padding: 16px 20px;
}
.extra-small { font-size: 11px; }

.facts-body { padding: 8px 20px 20px; }
.fact-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #F1F4F7;
    font-size: 13px;
}
.fact-row .label { color: #64748B; }
.fact-row .value { color: #01354B; font-weight: 600; }

.status-badge {
    color: #10B981;
    font-weight: 600;
    font-size: 13px;
    float: right;
}
.status-badge .dot {
    height: 8px; width: 8px;
    background: #10B981;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
}

/* 2. CTA Sidebar Dark (Gradient) */
.cta-sidebar-dark {
    width: 340px;
    height: 191.5px; /* আপনার দেওয়া হাইট */
    border-radius: 16px;
    background: linear-gradient(133.37deg, #01354B 0%, #014D6A 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.cta-sidebar-dark h5 { font-size: 16px; line-height: 1.4; }

/* Orange Button */
.btn-expert-orange {
    width: 243px;
    height: 41px;
    background: #F55F1A; /* আপনার দেওয়া কালার */
    color: white;
    border-radius: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: 0.3s;
}
.btn-expert-orange:hover {
    background: #d44d15;
    color: white;
    transform: translateY(-2px);
}

/* Mobile Responsive */
@media (max-width: 380px) {
    .project-sidebar, .cta-sidebar-dark {
        width: 100%;
    }
    .btn-expert-orange {
        width: 90%;
    }
}

/* Section Background & Padding */
.more-projects-section {
    width: 100%;
    background: #F8F9FB;
    border-top: 1px solid #E5E9ED;
    padding: 72px 0; /* আপনার দেওয়া প্যাডিং টপ ও বটম */
}

/* Content Box Fix (1200px Max with 60px padding) */
.custom-container-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 60px; /* আপনার রিকোয়ারমেন্ট অনুযায়ী */
}

/* Header Styles */
.section-title {
    font-size: 24px;
    font-weight: 700;
    color: #01354B;
}

.view-all-link {
    font-size: 14px;
    font-weight: 600;
    color: #008080; /* Teal color from image */
    transition: 0.3s;
}
.view-all-link:hover {
    color: #01354B;
}

/* Mini Card Styles */
.project-mini-card {
    background: #FFFFFF;
    border-radius: 12px;
    overflow: hidden;
    height: 100%;
    border: 1px solid #E5E9ED;
    transition: transform 0.3s ease;
}

.project-mini-card:hover {
    transform: translateY(-5px);
}

.card-img-wrapper {
    height: 180px;
    overflow: hidden;
}
.card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-content {
    padding: 20px;
}

.client-name {
    font-size: 11px;
    font-weight: 700;
    color: #008080;
    letter-spacing: 0.5px;
    display: block;
    margin-bottom: 8px;
}

.project-mini-title {
    font-size: 15px;
    font-weight: 700;
    color: #01354B;
    line-height: 1.4;
    margin-bottom: 12px;
}

.project-mini-meta {
    font-size: 12px;
    color: #64748B;
    margin-bottom: 0;
}

/* Responsive Fixes */
@media (max-width: 1199px) {
    .custom-container-content {
        padding: 0 30px;
    }
}

@media (max-width: 768px) {
    .more-projects-section {
        padding: 40px 0;
    }
    .section-title { font-size: 20px; }
}
</style>
@endpush


@section('content')
<nav class="breadcrumb-container">
    <div class="custom-container-inner">
        <div class="breadcrumb-links">
            <a href="/">Home</a>
            <span class="sep">›</span>
            <a href="/projects">Projects</a>
            <span class="sep">›</span>
            <span class="active">ISO/IEC 17025 Accreditation — PRTC, CVASU</span>
        </div>
    </div>
</nav>

<section class="hero-details-section" style="background-image: url('{{ asset('assets/img/projecthero.png') }}');">
    <div class="hero-overlay"></div>
    
    <div class="custom-container-inner position-relative z-index-2">
        <a href="/projects" class="back-link mb-5 d-inline-block text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i> Back to All Projects
        </a>

        <div class="d-flex gap-2 mb-4">
            <span class="badge-custom badge-teal">LABORATORY SERVICES</span>
            <span class="badge-custom badge-outline-green"><i class="fas fa-check me-1"></i> COMPLETED</span>
        </div>

        <div class="project-title-wrapper">
            <h2 class="sub-heading mb-0">ISO/IEC 17025:2017</h2>
            <h1 class="main-heading">Accreditation Consultancy <br> Support to PRTC, CVASU</h1>
        </div>

        <div class="client-meta mb-5">
            <p class="mb-0 text-white-50">Client: <span class="text-white fw-medium">Plant Research & Training Centre (PRTC), Chittagong Veterinary and Animal Sciences University</span></p>
        </div>

        <div class="project-meta-footer d-flex flex-wrap gap-4 pt-4 border-top border-white-5">
            <div class="meta-item">
                <i class="far fa-calendar-alt"></i> 2024 – 2025
            </div>
            <div class="meta-item">
                <i class="fas fa-map-marker-alt"></i> Chattogram, Bangladesh
            </div>
            <div class="meta-item">
                <i class="fas fa-briefcase"></i> PRTC / CVASU
            </div>
            <div class="meta-item">
                <i class="fas fa-layer-group"></i> 5 Deliverable Phases
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
                    <p class="mt-4">
                        TRACE was engaged to provide comprehensive ISO/IEC 17025:2017 accreditation consultancy support to the Plant Research and Training Centre (PRTC) at Chittagong Veterinary and Animal Sciences University (CVASU) — one of Bangladesh's leading veterinary and agricultural sciences institutions.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis nisi sit amet elit dictum tempor. Nunc vulputate ultrices efficitur. Quisque eu est non turpis suscipit ullamcorper. Mauris vel vulputate lectus, quis aliquam velit. Mauris dictum nulla sed tortor pharetra lacinia. Maecenas consectetur turpis ac sollicitudin fringilla.
                    </p>
                    <p>
                        Nulla id metus ac arcu condimentum hendrerit sit amet id est. Aliquam et turpis porttitor, pellentesque arcu quis, faucibus nulla. Vestibulum varius quis lacus nec cursus. Nunc tincidunt aliquet tellus auctor lobortis. Pellentesque viverra sed diam nec lobortis. Etiam ullamcorper.
                    </p>
                </div>

<div class="row g-3 mb-5 project-gallery-wrapper" style="width: 676px;">
    <div class="col-gallery-main">
        <img src="{{ asset('assets/img/Governance.png') }}" 
             class="img-fluid gallery-img-main" 
             alt="Team Discussion">
    </div>
    
    <div class="col-gallery-side">
        <div class="d-flex flex-column gap-custom">
            <img src="{{ asset('assets/img/Lab Project.png') }}" 
                 class="img-fluid gallery-img-side" 
                 alt="Lab Work">
            <img src="{{ asset('assets/img/Lab training.png') }}" 
                 class="img-fluid gallery-img-side" 
                 alt="Cells View">
        </div>
    </div>
</div>

                <div class="outcomes-content">
                    <h3 class="section-title-accent">Key Outcomes</h3>
                    <ul class="outcomes-list list-unstyled mt-4">
                        <li><i class="fas fa-check-circle me-2"></i> Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc non diam pellentesque pharetra.</li>
                        <li><i class="fas fa-check-circle me-2"></i> Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.</li>
                        <li><i class="fas fa-check-circle me-2"></i> Nulla eros nisl, blandit sollicitudin eleifend nec, facilisis quis metus. Suspendisse volutpat nunc justo, sit amet consectetur nunc tincidunt ac.</li>
                        <li><i class="fas fa-check-circle me-2"></i> Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc.</li>
                        <li><i class="fas fa-check-circle me-2"></i> Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus.</li>
                        <li><i class="fas fa-check-circle me-2"></i> Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.</li>
                    </ul>
                </div>
            </div>
<aside class="project-sidebar" style="width: 340px;">
    <div class="facts-card mb-4 shadow-sm">
        <div class="facts-header">
            <h6 class="mb-1 fw-bold text-white">Project Facts</h6>
            <p class="mb-0 extra-small text-white-50">ISO/IEC 17025 — PRTC, CVASU</p>
        </div>
        <div class="facts-body">
            <div class="fact-row">
                <span class="label">Client</span>
                <span class="value text-end">PRTC, CVASU</span>
            </div>
            <div class="fact-row">
                <span class="label">Sector</span>
                <span class="value text-end">Laboratory Services</span>
            </div>
            <div class="fact-row">
                <span class="label">Standard</span>
                <span class="value text-end">ISO/IEC 17025:2017</span>
            </div>
            <div class="fact-row">
                <span class="label">Location</span>
                <span class="value text-end">Chattogram, Bangladesh</span>
            </div>
            <div class="fact-row">
                <span class="label">Duration</span>
                <span class="value text-end">2024 – 2025</span>
            </div>
            <div class="fact-row border-0">
                <span class="label">Phases</span>
                <span class="value text-end">5 Deliverable Phases</span>
            </div>
            <div class="status-row pt-3 mt-2 border-top">
                <span class="label text-muted">Status</span>
                <span class="status-badge">
                    <span class="dot"></span> Completed
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
            @php
                // উদাহরণস্বরূপ ডাটা অ্যারে (এটি আপনার কন্ট্রোলার থেকে আসতে পারে)
                $moreProjects = [
                    [
                        'client' => 'MINISTRY OF COMMERCE',
                        'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                        'sector' => 'Trade Facilitation',
                        'year' => '2022–2023',
                        'image' => 'Trace team.png'
                    ],
                    [
                        'client' => 'BAFISA',
                        'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                        'sector' => 'Technology',
                        'year' => '2023–2024',
                        'image' => 'Time Release Study_ Chattogram Port — Baseline Report 2024.png'
                    ],
                    [
                        'client' => 'DCCI / PRIVATE SECTOR',
                        'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                        'sector' => 'Trade Facilitation',
                        'year' => '2023',
                        'image' => 'Trade and Customs.png'
                    ]
                ];
            @endphp

            @foreach($moreProjects as $item)
            <div class="col-lg-4 col-md-6">
                <div class="project-mini-card">
                    <div class="card-img-wrapper">
                        <img src="{{ asset('assets/img/' . $item['image']) }}" alt="Project Image" class="img-fluid">
                    </div>
                    <div class="card-content">
                        <span class="client-name text-uppercase">{{ $item['client'] }}</span>
                        <h4 class="project-mini-title">{{ $item['title'] }}</h4>
                        <p class="project-mini-meta">{{ $item['sector'] }} · {{ $item['year'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@include('frontend.layout.cta')
@endsection