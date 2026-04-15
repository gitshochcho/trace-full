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
</style>
@endpush

@section('content')
<section class="hero">
    {{-- SLIDES --}}
    <div class="slides">
        <div class="slide active"><img src="/assets/img/image 11.png" alt="Hero 1"></div>
        <div class="slide"><img src="/assets/img/Trade and Customs.png" alt="Hero 2"></div>
        <div class="slide"><img src="/assets/img/image 54.png" alt="Hero 3"></div>
        <div class="slide"><img src="/assets/img/image 55.png" alt="Hero 4"></div>
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
            <a href="#" class="btn-hero-primary">Explore Services <span>→</span></a>
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

                <a href="#" class="learn-btn mt-3 d-inline-block text-decoration-none">Learn About Us &rarr;</a>
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
     SERVICES
============================== --}}
<section class="services-section py-5">
    <div class="container" style="max-width:1200px;">

        {{-- HEADER --}}
        <div class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="tag-dot"></span>
                <span class="section-tag-pill">WHAT WE DO</span>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
                <div style="max-width:540px;">
                    <h2 class="section-title mb-2">Our <span>Core Services</span></h2>
                    <p class="section-desc mb-0">
                        Deep expertise across six domains — helping institutions modernise,
                        improve transparency, and deliver lasting outcomes.
                    </p>
                </div>
                <a href="#" class="all-link">
                    All Services
                    <span class="circle-arrow">→</span>
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
                <div class="service-card">
                    <img src="{{ asset('images/' . $service['img']) }}" alt="{{ $service['tag'] }}">
                    <div class="card-inner">
                        <span class="card-cat">{{ $service['tag'] }}</span>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['desc'] }}</p>
                        <a href="#">Read More →</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- ==============================
     PROJECTS
============================== --}}
<section class="projects-section py-5">
    <div class="container" style="max-width:1200px;">

        {{-- HEADER --}}
        <div class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="tag-dot"></span>
                <span class="project-tag">WORK THAT CREATES IMPACT</span>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
                <div style="max-width:520px;">
                    <h2 class="mb-0">Our <span>Projects</span></h2>
                    <p class="sub-text mb-0">
                        From laboratory accreditation to digital infrastructure — built to
                        deliver measurable, lasting results.
                    </p>
                </div>
                <a href="#" class="all-link">
                    All Projects
                    <span class="circle-arrow">→</span>
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
            <div class="col-12 col-md-4">
                <div class="project-card">
                    <img src="{{ asset('images/' . $project['img']) }}" alt="{{ $project['title'] }}">
                    <div class="proj-overlay">
                        <span class="proj-badge">{{ $project['badge'] }}</span>
                        <h3>{{ $project['title'] }}</h3>
                        <p>{{ $project['sub'] }}</p>
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

        <p class="partners-title mb-4">TRUSTED BY LEADING INSTITUTIONS</p>

        <div class="d-flex align-items-center gap-3">
            <button class="partners-arrow d-none d-md-flex">‹</button>

            <div class="partner-logos">
                <img src="{{ asset('images/bafisa.png') }}" alt="BAFISA">
                <img src="{{ asset('images/lir 2.png') }}" alt="LIR">
                <img src="{{ asset('images/bijem.png') }}" alt="BIJEM">
                <img src="{{ asset('images/sanem 2.png') }}" alt="SANEM">
                <img src="{{ asset('images/build.png') }}" alt="BUILD">
                <img src="{{ asset('images/b-advancy.png') }}" alt="B-Advancy">
            </div>

            <button class="partners-arrow d-none d-md-flex">›</button>
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

