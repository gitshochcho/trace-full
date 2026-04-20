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
    color: #FFFFFF;
}

.hero-title {
    font-size: 64px; /* বড় এবং বোল্ড টাইটেল */
    line-height: 1.1;
    letter-spacing: -1px;
}

.text-teal {
    color: var(--text-teal) !important;
}

.hero-description {
    font-size: 18px;
    line-height: 1.6;
    max-width: 650px;
    color: rgba(255, 255, 255, 0.7); /* হালকা সাদা টেক্সট */
}

/* Filter Nav Adjustments */
.filter-nav {
    background: #FFFFFF;
    height: 60px;
    border-bottom: 1px solid var(--border-color);
}

.filter-tabs .nav-link {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
    padding: 18px 20px;
    transition: all 0.3s;
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
    .filter-nav { height: auto; overflow-x: auto; }
    .filter-tabs { white-space: nowrap; flex-wrap: nowrap; }
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
<nav class="projects-breadcrumb">
    <div class="container-custom">
        <div class="breadcrumb-links">
            <a href="\">Home</a>
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
                <p class="text-uppercase small-tracking mb-0">Our Projects</p>
            </div>
            
            <h1 class="hero-title fw-bold">Work that <br><span class="text-teal">changes systems.</span></h1>
            
            <p class="hero-description mt-4">
                TRACE has delivered trade facilitation reform, laboratory accreditation, digital systems, and policy advisory projects across South Asia — for governments, development banks, and regulatory bodies.
            </p>
        </div>
    </div>
</section>

<section class="filter-nav">
    <div class="container-custom d-flex justify-content-between align-items-center h-100">
        <ul class="nav filter-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">All Projects <span class="badge">8</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Laboratory Services <span class="badge">2</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Trade Facilitation <span class="badge">2</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Technology <span class="badge">2</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Policy & Research <span class="badge">2</span></a>
            </li>
        </ul>
        <div class="project-count text-muted small">
            Showing <strong>8</strong> projects
        </div>
    </div>
</section>

<section class="project-grid-section py-5">
    <div class="container-custom">
<div class="row g-4">
    @php
        $projects = [
            [
                'title' => 'ISO/IEC 17025:2017 Accreditation Support to PRTC, CVASU',
                'category' => 'TECHNOLOGY SOLUTIONS',
                'year' => '2023-2024',
                'client' => 'PRTC, CVASU',
                'desc' => 'Mauris vel vulputate lectus, quis aliquam velit. Mauris dictum nulla sed tortor pharetra lacinia. Morbi augue est, finibus ut consequat.',
                'img' => 'assets/img/Time Release Study_ Chattogram Port — Baseline Report 2024.png', // আপনার ফোল্ডার পাথ অনুযায়ী
                'status' => 'Completed',
                'tags' => ['HS Code Database', 'Web Development', 'Member Portal']
            ],
            [
                'title' => 'Seven-Story Advanced Customs Laboratory — Schematic Design',
                'category' => 'LABORATORY SERVICES',
                'year' => '2024',
                'client' => 'CHATTOGRAM CUSTOMS AUTHORITY',
                'desc' => 'Expert design and infrastructure planning for advanced customs lab systems to ensure international standards.',
                'img' => 'assets/img/Op-Ed.png',
                'status' => 'Completed',
                'tags' => ['Lab Design', 'Schematic Layout', 'Customs']
            ],
            [
                'title' => 'HS Code Import Database & BAFISA Website Upgrade',
                'category' => 'TRADE FACILITATION',
                'year' => '2022-2023',
                'client' => 'FREIGHT FORWARDING ASSOCIATION',
                'desc' => 'Upgrading digital trade databases and transparency portals for better trade management.',
                'img' => 'assets/img/Trace team.png',
                'status' => 'Completed',
                'tags' => ['WTO TFA', 'NTFC', 'Trade Policy']
            ],
            [
                'title' => 'Customs Automation and Risk Management System Support',
                'category' => 'TECHNOLOGY SOLUTIONS',
                'year' => '2023',
                'client' => 'NATIONAL BOARD OF REVENUE',
                'desc' => 'Supporting digital infrastructure for risk-based customs inspections and automation.',
                'img' => 'assets/img/BAFISA Project.png',
                'status' => 'Completed',
                'tags' => ['Risk Management', 'NBR', 'Customs']
            ],
            [
                'title' => 'Needs Assessment and Time Release Study for Trade',
                'category' => 'POLICY & RESEARCH',
                'year' => '2022',
                'client' => 'WORLD BANK / IFC',
                'desc' => 'Comprehensive study on trade bottlenecks and time-bound cargo release improvements.',
                'img' => 'assets/img/Digital Trade Infrastructure in Bangladesh_ A Readiness Assessment.png',
                'status' => 'Completed',
                'tags' => ['Needs Assessment', 'TRS', 'World Bank']
            ],
            [
                'title' => 'Authorized Economic Operator (AEO) Framework Support',
                'category' => 'TRADE FACILITATION',
                'year' => '2023',
                'client' => 'DCCI / PRIVATE SECTOR',
                'desc' => 'Developing trust-based trade frameworks for high-compliance businesses.',
                'img' => 'assets/img/Trade and Customs.png',
                'status' => 'Completed',
                'tags' => ['AEO', 'WCO', 'Private Sector']
            ],
            [
                'title' => 'Export Licensing and Policy Reform for RMG Sector',
                'category' => 'POLICY & RESEARCH',
                'year' => '2024',
                'client' => 'BGMEA / DONOR-FUNDED',
                'desc' => 'Reforming license delivery and policy frameworks for the ready-made garment industry.',
                'img' => 'assets/img/Governance.png',
                'status' => 'Completed',
                'tags' => ['Policy Reform', 'RMG', 'Licensing']
            ],
            [
                'title' => 'Regional Connectivity and Logistics Policy Analysis',
                'category' => 'POLICY & RESEARCH',
                'year' => '2022',
                'client' => 'WORLD BANK / IFC',
                'desc' => 'Analysis of regional transport corridors and supply chain logistics.',
                'img' => 'assets/img/Governance (2).png',
                'status' => 'Completed',
                'tags' => ['Connectivity', 'Logistics', 'Policy']
            ]
        ];
    @endphp

    @foreach($projects as $project)
    <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="project-card h-100 shadow-sm">
            <div class="project-img-box">
                <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                <span class="category-tag">{{ $project['category'] }}</span>
                <span class="year-badge">{{ $project['year'] }}</span>
            </div>
            
            <div class="project-content">
                <h6 class="client-name text-uppercase">{{ $project['client'] }}</h6>
                <h4 class="project-title">{{ $project['title'] }}</h4>
                <p class="project-bio text-muted">{{ $project['desc'] }}</p>
                
                <div class="project-tags">
                    @foreach($project['tags'] as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
            
                
                <div class="project-footer d-flex justify-content-between align-items-center">
                    <span class="status text-muted">{{ $project['year'] }} • {{ $project['status'] }}</span>
                    <a href="/projectdetails" class="view-link">View Project <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
        </div>
    </div>
</section>

@include('frontend.layout.cta')
@endsection