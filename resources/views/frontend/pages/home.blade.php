@extends('frontend.layout.app')

@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">

<style>
/* =========================================
   GLOBAL
========================================= */
* { box-sizing: border-box; margin: 0; padding: 0; }

/* =========================================
   HERO
========================================= */
.hero {
    width: 100%;
    height: 100vh;
    min-height: 500px;
    position: relative;
    overflow: hidden;
}

.hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.75) 100%);
    z-index: 1;
    pointer-events: none;
}

/* SLIDER */
.slides { position: absolute; inset: 0; z-index: 0; }

.slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    z-index: 0;
    transition: opacity 0.8s ease, transform 0.8s ease;
}
.slide.active {
    opacity: 1;
    z-index: 1;
    transform: scale(1);
}

.slide img {
    width: 100%;
    height: 100vh;
    min-height: 500px;
    object-fit: cover;
    object-position: center;
}

.hero-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    max-width: 1072px;
    padding: 0 20px;
    z-index: 10;
    text-align: center;
}

.hero-tag-box {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 20px;
}
.hero-tag-box .tag-line { width: 40px; height: 2px; background: #F47735; display: inline-block; }
.hero-tag { color: #F47735; font-size: 12px; letter-spacing: 2px; }

.hero-content h1 { font-size: 64px; line-height: 1.15; color: white; margin-bottom: 20px; }
.hero-content h1 span { color: #22c1c3; }

.hero-content .hero-desc {
    max-width: 750px;
    font-size: 16px;
    line-height: 1.6;
    color: #e2e8f0;
    margin: 0 auto 25px;
}

.hero-btns { display: flex; gap: 15px; justify-content: center; margin-bottom: 25px; }

.btn-hero-primary {
    background: #F47735;
    color: white;
    border: none;
    padding: 12px 22px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    cursor: pointer;
    transition: .3s;
    text-decoration: none;
}
.btn-hero-primary:hover { background: #d9622a; color: white; }

.btn-hero-secondary {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.5);
    color: white;
    padding: 12px 22px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: .3s;
    text-decoration: none;
}
.btn-hero-secondary:hover { background: rgba(255,255,255,0.1); color: white; }

.slider-line { display: flex; gap: 10px; justify-content: center; margin-top: 10px; }
.slider-line .ind { width: 28px; height: 2px; background: rgba(255,255,255,0.5); display: inline-block; cursor: pointer; transition: .3s; }
.slider-line .ind.active { width: 55px; background: #F47735; }

@media (max-width: 576px) {
    .hero { height: 360px; min-height: 360px; }
    .slide img { height: 360px; object-fit: cover; object-position: center top; }
    .hero::after { background: linear-gradient(180deg, rgba(0,0,0,.10) 0%, rgba(0,0,0,.20) 50%, rgba(0,0,0,.45) 100%); }
    .hero-content { top: 52%; }
    .hero-content h1 { font-size: 24px; line-height: 1.3; }
    .hero-tag { font-size: 10px; letter-spacing: 1px; }
    .hero-tag-box .tag-line { width: 20px; }
    .hero-desc, .hero-btns, .slider-line { display: none !important; }
}

@media (max-width: 992px) {
    .hero-content h1 { font-size: 42px; }
    .hero-desc { font-size: 14px; }
}

    /* Tag with Orange Line */
    .about-tag {
        color: #e85d26;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        position: relative;
        padding-left: 35px;
    }
    .about-tag::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        width: 25px;
        height: 2px;
        background-color: #e85d26;
        transform: translateY(-50%);
    }

    /* Titles and Typography */
    .about-title {
        font-size: 40px;
        font-weight: 800;
        color: #1a2332;
        line-height: 1.2;
    }
    .text-teal {
        color: #00898e;
    }
    .about-desc {
        color: #64748b;
        font-size: 15px;
        line-height: 1.6;
    }

    /* List Styling */
    .about-item {
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 20px;
    }
    .about-item:last-child {
        border-bottom: none;
    }
    .about-num {
        color: #e85d26;
        font-weight: 700;
        font-size: 14px;
        margin-top: 4px;
    }
    .item-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a2332;
        margin-bottom: 6px;
    }
    .item-text {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 0;
    }

    /* Learn Button */
    .learn-btn {
        color: #1a2332;
        font-weight: 700;
        font-size: 14px;
        transition: 0.3s;
    }
    .learn-btn:hover {
        color: #e85d26;
        transform: translateX(5px);
    }

    /* Image Badge */
    .about-badge {
        position: absolute;
        bottom: 30px;
        left: -20px;
        background-color: #004051; /* ছবির গাঢ় টিয়াল কালার */
        color: #fff;
        padding: 15px 25px;
        border-radius: 12px;
        text-align: center;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .about-title { font-size: 32px; }
        .about-badge {
            left: 20px;
            bottom: 20px;
        }
        .about-img-wrap {
            text-align: center;
        }
    }

    /* Section Header Styles */
    .tag-dot {
        width: 8px;
        height: 8px;
        background-color: #e85d26;
        border-radius: 50%;
    }
    .section-tag-pill {
        color: #00898e;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        background: #e6f4f4;
        padding: 4px 12px;
        border-radius: 20px;
    }
    .section-title {
        font-size: 34px;
        font-weight: 800;
        color: #1a2332;
    }
    .text-teal { color: #00898e; }
    .section-desc { color: #64748b; font-size: 14px; }

    /* All Services Button */
    .circle-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        background: #f1f5f9;
        border-radius: 50%;
        color: #64748b;
        transition: 0.3s;
    }
    .all-link:hover .circle-arrow {
        background: #004051;
        color: #fff;
    }

    /* Service Card Styles (Same to Same Image) */
    .service-card {
        background: #fff;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .card-img-wrapper {
        height: 220px;
        overflow: hidden;
    }
    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .card-cat {
        font-size: 11px;
        font-weight: 700;
        color: #00898e;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .card-title {
        color: #1a2332;
        line-height: 1.4;
        min-height: 50px;
    }
    .card-text {
        font-size: 13.5px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .read-more-btn {
        color: #00898e;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
        transition: 0.2s;
    }
    .read-more-btn:hover {
        color: #1a2332;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .section-title { font-size: 28px; }
    }

    /* Header Styles */
    .tag-dot { width: 8px; height: 8px; background-color: #e85d26; border-radius: 50%; }
    .project-tag-pill {
        color: #00898e; font-size: 11px; font-weight: 700; letter-spacing: 1px;
        background: #e6f4f4; padding: 4px 12px; border-radius: 20px;
    }
    .section-title { font-size: 34px; font-weight: 800; color: #1a2332; }
    .text-teal { color: #00898e; }
    .section-desc { color: #64748b; font-size: 14px; }

    /* All Projects Link */
    .circle-arrow {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; background: #f1f5f9; border-radius: 50%;
        color: #64748b; transition: 0.3s; font-size: 14px;
    }
    .all-link:hover .circle-arrow { background: #004051; color: #fff; }

    /* Project Card Design (Same to Same) */
    .project-card {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        height: 320px; /* কার্ডের একটি নির্দিষ্ট উচ্চতা */
    }
    .project-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }
    .project-card:hover img {
        transform: scale(1.1); /* হোভার করলে ছবি জুম হবে */
    }

    /* Overlay - ছবির নিচের কালো শ্যাডো ইফেক্ট */
    .proj-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 45, 58, 0.9) 10%, rgba(0,0,0,0) 60%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 25px 20px;
        color: #fff;
    }

    /* Badge Design (Left orange bar style) */
    .proj-badge-box {
        background: #e85d26;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 0 4px 4px 0;
        display: inline-block;
        width: fit-content;
        margin-left: -20px; /* ওভারলে প্যাডিং অ্যাডজাস্ট করতে */
        margin-bottom: 12px;
    }

    .proj-title {
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 8px;
    }

    .proj-sub {
        font-size: 12px;
        opacity: 0.8;
        margin-bottom: 0;
    }

    /* Mobile Responsive */
    @media (max-width: 576px) {
        .project-card { height: 280px; }
        .section-title { font-size: 28px; }
    }

    /* PARTNERS SLIDER */
    .partners-section {
        background: #fff;
    }
    .partners-title {
        color: #64748b;
        font-size: 12px;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }
    .partner-slider {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 0 1rem;
    }
    .partner-logos-wrapper {
        flex: 1;
        max-width: 920px;
        margin: 0 auto;
        overflow: hidden;
        display: flex;
        width: 100%;
        padding: 0.25rem 0;
    }
    .partner-logos {
        display: flex;
        align-items: center;
        gap: 3rem;
        min-width: max-content;
        animation: partner-marquee 24s linear infinite;
    }
    .partner-logos:hover {
        animation-play-state: paused;
    }
    .partner-logos img {
        height: 50px;
        max-width: 120px;
        object-fit: contain;
        filter: grayscale(100%);
        opacity: .75;
        transition: filter .3s ease, opacity .3s ease, transform .3s ease;
    }
    .partner-logos img:hover {
        filter: grayscale(0);
        opacity: 1;
        transform: translateY(-2px);
    }
    @keyframes partner-marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .partners-arrow {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 1px solid rgba(0,0,0,.08);
        background: #fff;
        color: #004051;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }
    .partners-arrow:hover {
        background: #f8f9fa;
        transform: translateX(1px);
    }
    .partners-prev {
        margin-left: -1rem;
    }
    .partners-next {
        margin-right: -1rem;
    }
    @media (max-width: 991px) {
        .partner-logos {
            justify-content: center;
        }
    }
    @media (max-width: 767px) {
        .partners-arrow {
            display: none !important;
        }
    }
    @media (max-width: 576px) {
        .partner-logos {
            gap: 1.25rem;
        }
        .partner-logos img {
            height: 48px;
            max-width: 100px;
        }
    }

</style>
@endpush

@section('content')
<section class="hero">
    {{-- SLIDES --}}
    <div class="slides">
        <div class="slide active"><img src="/assets/img/image 11.png" alt="Hero 1"></div>
        <div class="slide"><img src="/assets/img/ship.jpeg" alt="Hero 2"></div>
        <div class="slide"><img src="/assets/img/hero3.jpeg" alt="Hero 3"></div>
        <div class="slide"><img src="/assets/img/hero4.jpeg" alt="Hero 4"></div>
    </div>

    {{-- CONTENT --}}
    <div class="hero-content">

        {{-- TAG --}}
        <div class="hero-tag-box">
            <span class="tag-line"></span>
            <span class="hero-tag">INTERNATIONAL DEVELOPMENT CONSULTING</span>
            <span class="tag-line"></span>
        </div>

        {{-- TITLE --}}
        <h1>
            Empowering Change through <br>
            <span>Insightful</span> Consulting
        </h1>

        {{-- DESC --}}
        <p class="hero-desc">
            Trace Consulting partners with governments, regulatory agencies, and development organizations to reform systems,
            build capacity, and deliver technology that lasts.
        </p>

        {{-- BUTTONS --}}
        <div class="hero-btns">
            <a href="/services" class="btn-hero-primary">Explore Services <span>→</span></a>
            <a href="#" class="btn-hero-secondary">View Our Work</a>
        </div>

        {{-- SLIDER INDICATOR --}}
        <div class="slider-line">
            <span class="ind active"></span>
            <span class="ind"></span>
            <span class="ind"></span>
            <span class="ind"></span>
        </div>

    </div>

</section>

{{-- ==============================
      ABOUT SECTION
============================== --}}
<section class="about-section py-5 my-lg-4">
    <div class="container" style="max-width:1140px;">
        <div class="row align-items-center gy-5">

            {{-- LEFT CONTENT --}}
            <div class="col-12 col-lg-6 pe-lg-5">
                <div class="about-tag-wrapper mb-3">
                    <span class="about-tag">ABOUT TRACE</span>
                </div>

                <h2 class="about-title mb-4">
                    Transforming Challenges <br>
                    into <span class="text-teal">Opportunities</span>
                </h2>

                <p class="about-desc mb-5">
                    TRACE focuses on international trade, policy reform, and development, working with governments,
                    business groups, and the private sector to strengthen market systems.
                </p>

                {{-- LIST ITEMS --}}
                <div class="about-list">
                    <div class="about-item d-flex gap-3 mb-4">
                        <span class="about-num">01</span>
                        <div class="about-content">
                            <h4 class="item-title">Multi-Sector Expertise & Global Reach</h4>
                            <p class="item-text">Deep knowledge across industries, backed by an objective perspective and access to global networks.</p>
                        </div>
                    </div>

                    <div class="about-item d-flex gap-3 mb-4">
                        <span class="about-num">02</span>
                        <div class="about-content">
                            <h4 class="item-title">Proven Methodologies, Policy to Practice</h4>
                            <p class="item-text">Rigorous, scalable approaches that translate evidence into implementable reforms.</p>
                        </div>
                    </div>

                    <div class="about-item d-flex gap-3 mb-4">
                        <span class="about-num">03</span>
                        <div class="about-content">
                            <h4 class="item-title">Change Management & Creative Innovation</h4>
                            <p class="item-text">Combining structured change management with innovative, context-driven solutions.</p>
                        </div>
                    </div>
                </div>

                <a href="/about" class="learn-btn mt-3 d-inline-block text-decoration-none">Learn About Us &rarr;</a>
            </div>

            {{-- RIGHT IMAGE --}}
            <div class="col-12 col-lg-6">
                <div class="about-img-wrap position-relative">
                    <img src="/assets/img/bg.png" alt="About Trace" class="img-fluid rounded-4 shadow-sm">
                    
                    <div class="about-badge shadow-lg">
                        <h3 class="m-0 fw-bold">8+</h3>
                        <p class="m-0 small opacity-75">Years of expertise</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ==============================
      SERVICES SECTION
============================== --}}
<section class="services-section py-5 bg-light-subtle">
    <div class="container" style="max-width:1200px;">

        {{-- HEADER --}}
        <div class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="tag-dot"></span>
                <span class="section-tag-pill">WHAT WE DO</span>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
                <div style="max-width:540px;">
                    <h2 class="section-title mb-2">Our <span class="text-teal">Core Services</span></h2>
                    <p class="section-desc mb-0">
                        Deep expertise across six domains — helping institutions modernise,
                        improve transparency, and deliver lasting outcomes.
                    </p>
                </div>
                <a href="/services" class="all-link text-decoration-none">
                    <span class="fw-bold text-dark me-2">All Services</span>
                    <span class="circle-arrow">&rarr;</span>
                </a>
            </div>
        </div>

        {{-- GRID --}}
        <div class="row g-4">
            @php
            $services = [
                ['img' => 'Trade and Customs.png', 'tag' => 'TRADE FACILITATION & CUSTOMS', 'title' => 'Strengthening Cross-Border Trade & Customs Systems', 'desc' => 'Supports implementing trade facilitation commitments, promoting trade harmonization, simplifying process ...'],

                ['img' => 'Lab Accreditation.png', 'tag' => 'Policy Advocacy', 'title' => 'Evidence-Based Policy Reform & Advocacy', 'desc' => 'We deliver evidence-based policy advocacy and recommendations to help governments design actionable, impactful reforms —'],

                ['img' => 'Technology Solutions.png', 'tag' => 'Research & Assessments', 'title' => 'In-Depth Trade, Economic & Development Research', 'desc' => 'We conduct rigorous research, assessments, and evaluations on trade, economics, and development issues to drive informed decision-making.'],

                ['img' => 'Governance.png', 'tag' => 'Capacity Building', 'title' => 'Need-Based Training for Public & Private Sector', 'desc' => 'We build the capacity of public and private sector stakeholders through targeted, need-based training on trade, markets.'],

                ['img' => 'Infrastructure Design.png', 'tag' => 'Project Management', 'title' => 'End-to-End Project Design, Management & Implementation', 'desc' => 'We design, manage, and implement tailor-made projects that address trade, economic, and market access challenges ...'],

                ['img' => 'Technology Solutions.png', 'tag' => 'Technology Solutions', 'title' => 'Technology-Driven Trade Systems & Digital Platforms', 'desc' => 'We design and deploy technology-driven trade systems — including LIMS, certification platforms, single windows, and custom ...'],

                ['img' => 'Governance (2).png', 'tag' => 'Laboratory Services', 'title' => 'Lab Accreditation, QMS & Testing Capacity Development', 'desc' => 'We support public and private laboratories to establish quality management systems ...'],

                ['img' => 'Infrastructure Design (1).png', 'tag' => 'Trade Information Systems', 'title' => 'Online Portals, Databases & Transparency Platforms', 'desc' => 'We enhance transparency in export–import by developing online portals, trade information databases, notification systems.'],

                ['img' => 'Capacity Building (2).png', 'tag' => 'Cold Chain & Logistics', 'title' => 'Temperature-Controlled Logistics & Supply Chain Systems', 'desc' => 'We design and strengthen cold chain and logistics systems — from temperature-controlled storage to last-mile delivery —'],
            ];
            @endphp

            @foreach($services as $service)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="service-card h-100 shadow-sm">
                    <div class="card-img-wrapper">
                        <img src="/assets/img/{{ $service['img'] }}" class="card-img-top" alt="{{ $service['tag'] }}">
                    </div>
                    <div class="card-body p-4">
                        <span class="card-cat mb-2 d-inline-block">{{ $service['tag'] }}</span>
                        <h3 class="card-title h5 fw-bold mb-3">{{ $service['title'] }}</h3>
                        <p class="card-text text-muted mb-4">{{ $service['desc'] }}</p>
                        <a href="#" class="read-more-btn">Read More &rarr;</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==============================
      PROJECTS SECTION
============================== --}}
<section class="projects-section py-5 bg-white">
    <div class="container" style="max-width:1200px;">

        {{-- HEADER --}}
        <div class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="tag-dot"></span>
                <span class="project-tag-pill">WORK THAT CREATES IMPACT</span>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
                <div style="max-width:520px;">
                    <h2 class="section-title mb-2">Our <span class="text-teal">Projects</span></h2>
                    <p class="section-desc mb-0">
                        From laboratory accreditation to digital infrastructure — built to
                        deliver measurable, lasting results.
                    </p>
                </div>
                <a href="#" class="all-link text-decoration-none">
                    <span class="fw-bold text-dark me-1" style="font-size: 13px;">All Projects</span>
                    <span class="circle-arrow">&rarr;</span>
                </a>
            </div>
        </div>

        {{-- GRID --}}
        <div class="row g-4">
            @php
            $projects = [
                ['img' => 'Lab Project.png', 'badge' => 'LAB ACCREDITATION', 'title' => 'ISO/IEC 17025:2017 Accreditation Support to PRTC, CVASU', 'sub' => 'Chattogram Veterinary & Animal Sciences University'],
                ['img' => 'Infrastructure Project.png', 'badge' => 'INFRASTRUCTURE DESIGN', 'title' => 'Seven-Storey Advanced Customs Laboratory Layout Design', 'sub' => 'Customs Authority, Chattogram'],
                ['img' => 'BAFISA Project.png', 'badge' => 'DIGITAL SOLUTIONS', 'title' => 'HS Code Import Database & BAFISA Website Upgrade', 'sub' => 'Bangladesh Freight Forwarders & Shipping'],
            ];
            @endphp

            @foreach($projects as $project)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="project-card shadow-sm">
                    <img src="/assets/img/{{ $project['img'] }}" alt="{{ $project['title'] }}" class="img-fluid">
                    <div class="proj-overlay">
                        <div class="proj-badge-box">{{ $project['badge'] }}</div>
                        <h3 class="proj-title">{{ $project['title'] }}</h3>
                        <p class="proj-sub">{{ $project['sub'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==============================
     PARTNERS
============================== --}}
<section class="partners-section py-5">
    <div class="container" style="max-width:1200px;">

            <p class="partners-title mb-4 text-center">TRUSTED BY LEADING INSTITUTIONS</p>

        <div class="partner-slider position-relative">
            <div class="partner-logos-wrapper">
                <div class="partner-logos d-flex align-items-center gap-4">
                    <img src="assets/img/bafisa.png" alt="BAFISA">
                    <img src="assets/img/lir 2.png" alt="LIR">
                    <img src="assets/img/bijem.png" alt="BIJEM">
                    <img src="assets/img/sanem 2.png" alt="SANEM">
                    <img src="assets/img/build.png" alt="BUILD">
                    <img src="assets/img/b-advancy.png" alt="B-Advancy">
                    <img src="assets/img/bafisa.png" alt="BAFISA">
                    <img src="assets/img/lir 2.png" alt="LIR">
                    <img src="assets/img/bijem.png" alt="BIJEM">
                    <img src="assets/img/sanem 2.png" alt="SANEM">
                    <img src="assets/img/build.png" alt="BUILD">
                    <img src="assets/img/b-advancy.png" alt="B-Advancy">
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('custome-js')
<script>
// ====== HERO SLIDER ======
(function () {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.slider-line .ind');
    let current = 0;

    function goTo(n) {
        slides[current].classList.remove('active');
        indicators[current]?.classList.remove('active');
        current = (n + slides.length) % slides.length;
        slides[current].classList.add('active');
        indicators[current]?.classList.add('active');
    }

    // Auto-advance every 4s
    setInterval(() => goTo(current + 1), 4000);

    // Click indicators
    indicators.forEach((ind, i) => ind.addEventListener('click', () => goTo(i)));
})();


</script>
@endpush

