@extends('frontend.layout.app')


@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root {
    --primary-orange: #F47735;
    --accent-teal: #22c1c3;
    --dark-blue: #0f172a;
}

.custom-container {
    max-width: 1072px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 15px;
    padding-right: 15px;
}

.hero-text-box {
    max-width: 1072px;
    margin: 0 auto;
    width: 100%;
}

/* --- Hero Section --- */
.about-hero {
    position: relative;
    height: 600px;
    width: 100%;
    overflow: hidden;
}

.about-hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center 15%;
}

.about-hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(95.66deg, rgba(1, 53, 75, 0.4) 0%, rgba(1, 53, 75, 0.2) 100%);
}

.about-hero-content {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
}

.about-hero-content h1 {
    font-family: "Sora", sans-serif;
    font-weight: 800;
    font-size: clamp(32px, 5vw, 58px); 
    line-height: 1.15;
    color: #ffffff;
}

.about-hero-content h1 span { color: var(--accent-teal); }

.hero-line {
    width: 145px;
    height: 5px;
    background: var(--primary-orange);
    border-radius: 2px;
}

/* --- About Content Section --- */
.about-tag {
    font-size: 12px;
    letter-spacing: 2px;
    color: var(--primary-orange);
    position: relative;
    padding-left: 45px;
    display: inline-block;
    font-weight: 700;
}

.about-tag::before {
    content: "";
    position: absolute;
    left: 0;
    top: 50%;
    width: 35px;
    height: 2px;
    background: var(--primary-orange);
}

.about-title {
    font-family: "Sora", sans-serif;
    font-weight: 800;
    font-size: clamp(28px, 4vw, 40px);
    color: var(--dark-blue);
}

.about-title span { color: var(--accent-teal); }

.about-divider {
    width: 40px;
    height: 3px;
    background: var(--primary-orange);
}

.about-right img {
    width: 100%;
    height: auto;
    max-height: 650px;
    object-fit: cover;
    border-radius: 20px;
}

.btn-primary-custom {
    background: var(--primary-orange);
    color: white;
    border-radius: 100px;
    padding: 12px 30px;
    border: none;
    transition: 0.3s;
}

.btn-outline-custom {
    background: transparent;
    border: 1px solid #cbd5e1;
    border-radius: 100px;
    padding: 12px 30px;
    transition: 0.3s;
}

/* Responsive Fix for Left Margin */
@media (min-width: 1200px) {
    .hero-container-offset {
        margin-left: 15%; 
    }
}

/* ================= COMMITMENT SECTION ================= */
.commitment {
    position: relative;
    width: 100%;
    min-height: 598px;
    overflow: hidden;
    background-color: #0f172a;
}

.commitment-bg-wrap {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.commitment-bg-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.6;
}

.commitment::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.85);
    z-index: 1;
}

.commitment-left-img {
    position: absolute;
    left: 0;
    top: 0;
    width: 50%;
    height: 100%;
    z-index: 2;
    display: block;
}

.commitment-left-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    mask-image: linear-gradient(to right, black 70%, transparent 100%);
    -webkit-mask-image: linear-gradient(to right, black 70%, transparent 100%);
}

.commitment-content-area {
    position: relative;
    z-index: 3;
    padding: 80px 0;
}

.commitment-content-box {
    max-width: 441px;
    /* Grid lines effect */
    background-image: 
        linear-gradient(to right, rgba(255,255,255,0.05) 1px, transparent 1px),
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px);
    background-size: 80px 100%, 100% 80px;
    padding: 20px;
}

.commitment-content-box h2 {
    font-family: "Sora", sans-serif;
    font-size: 36px;
    font-weight: 600;
    color: #fff;
}

.commitment-content-box ul {
    list-style: none;
    padding: 0;
}

.commitment-content-box ul li {
    color: #e2e8f0;
    font-size: 14px;
    margin-bottom: 12px;
    padding-left: 25px;
    position: relative;
}

.commitment-content-box ul li::before {
    content: "→";
    position: absolute;
    left: 0;
    color: #F47735;
    font-weight: bold;
}

/* ================= FRAMEWORK SECTION ================= */
.framework-section {
    width: 100%;
    padding: 100px 0;
    background: #F8F9FB;
}

/* Main Wrapper Box (Width: 1080px) */
.framework-main-container {
    width: 1080px; 
    margin: 0 auto;
    display: block;
}

/* Right Side Content Box (Width: 708px) */
.framework-right-box {
    width: 708px; 
    min-height: 524px;
    background: #ffffff;
    border: 1px solid #E5E9ED;
    border-radius: 16px; 
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
}

/* Row Adjustment for 72px Gap */
.framework-main-container .row {
    margin: 0;
    display: flex;
    flex-wrap: nowrap; 
}

/* Left Content Styles */
.framework-tag .line {
    width: 30px;
    height: 2px;
    background: #F47735;
}
.framework-tag .tag-text {
    color: #01888C;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 1.5px;
}
.framework-title {
    font-size: 42px;
    font-weight: 800;
    color: #01354B;
    line-height: 1.1;
}
.framework-title span { color: #01888C; }
.framework-desc {
    color: #64748B;
    font-size: 15px;
    line-height: 1.7;
}

/* Button */
.btn-get-started {
    display: inline-block;
    padding: 10px 28px;
    border: 2px solid #D0D8DE;
    border-radius: 50px;
    color: #01354B;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    transition: 0.3s;
}

/* Individual Items inside Right Box */
.framework-item {
    display: flex;
    gap: 20px;
    padding: 35px 40px;
    border-bottom: 1px solid #F1F5F9;
}
.framework-item:last-child { border-bottom: none; }
.framework-item .num {
    font-size: 40px;
    font-weight: 700;
    color: #E2E8F0;
}
.framework-item .icon-box i {
    font-size: 24px;
    color: #F47735;
    margin-top: 10px;
}
.framework-item h4 {
    font-size: 18px;
    font-weight: 700;
    color: #01354B;
}
.framework-item p {
    font-size: 14px;
    color: #64748B;
    margin: 0;
}

/* Responsive */
@media (max-width: 1100px) {
    .framework-main-container {
        width: 95%; 
    }
    .framework-right-box {
        width: 100%;
    }
    .framework-main-container .row {
        flex-wrap: wrap;
        gap: 40px !important;
    }
}

/* ================= FEATURES SECTION ================= */
.features-section {
    background: #F8F9FB;
    padding: 100px 0;
}

.features-tag {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: "Plus Jakarta Sans", sans-serif;
    font-size: 12px;
    font-weight: 700;
    color: #01888C;
    letter-spacing: 1px;
}

.features-tag .line {
    width: 20px;
    height: 2px;
    background: #F47735;
}

.features-title {
    font-family: "Plus Jakarta Sans", sans-serif;
    font-weight: 800;
    font-size: 36px;
    color: #0f172a;
}

.features-title span { color: #22c1c3; }

/* Feature Card Style */
.feature-card {
    background: #fff;
    padding: 40px 30px;
    border-radius: 16px; 
    border: 1px solid #f1f5f9;
    transition: all 0.3s ease;
}


.icon-wrapper {
    width: 55px;
    height: 55px;
    background-color: #e6f7f8; 
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-wrapper i {
    font-size: 24px;
    color: #01888C; 
}

.feature-card h5 {
    color: #0f172a;
    font-size: 18px;
}

.feature-card p {
    font-size: 14px;
    line-height: 1.6;
}

.icon-box {
    width: 52px;
    height: 52px;
    color: #E2F5F5;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 20px;
}

/* ================= PROJECTS SECTION ================= */
.projects-section {
    width: 100%;
    padding: 80px 0;
    background: #FFFFFF;
}

.projects-main-container {
    max-width: 1080px; 
    margin: 0 auto;
}

.orange-line {
    width: 20px;
    height: 2px;
    background: #F47735;
}

.projects-tag {
    color: #01888C;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
}

.project-title {
    font-family: 'Sora', sans-serif;
    font-size: 36px;
    font-weight: 700;
    color: #000;
}

.project-title .highlight {
    color: #01888C;
    padding: 0px 12px;
    border-radius: 6px;
    display: inline-block;
}

/* All Projects Button */
.all-projects-link {
    text-decoration: none;
    color: #01354B;
    font-weight: 700;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.arrow-circle {
    width: 32px;
    height: 32px;
    border: 1px solid #D0D8DE;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
}

/* Grid Layout */
.projects-grid {
    display: flex;
    gap: 20px; 
}

/* Project Card (Exact Size) */
.project-card {
    position: relative;
    width: 346.66px;
    height: 280px;    
    border-radius: 16px; 
    overflow: hidden;
    background: #01354B;
}

.project-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.8;
}

.project-overlay {
    position: absolute;
    inset: 0;
    padding: 20px;
    background: linear-gradient(180deg, rgba(1, 53, 75, 0) 0%, rgba(1, 53, 75, 0.9) 100%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.project-badge {
    background: #F47735;
    color: #fff;
    font-size: 9px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 4px;
    align-self: flex-start;
    margin-bottom: 10px;
}

.project-h {
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 8px;
}

.project-meta {
    display: flex;
    align-items: center;
    gap: 8px;
}

.meta-line {
    width: 12px;
    height: 1.5px;
    background: #F47735;
}

.project-meta p {
    color: #BDC3C7;
    font-size: 11px;
    margin: 0;
}

/* Responsive */
@media (max-width: 1080px) {
    .projects-main-container { width: 95%; }
    .projects-grid { flex-wrap: wrap; justify-content: center; }
}

/* ================= INSIGHTS SECTION ================= */
.insights-section {
    width: 100%;
    max-width: 1920px;
    background: #F8F9FB;
    padding: 100px 0;
    margin: 0 auto;
}

.insights-container {
    width: 1072px;
    margin: 0 auto;
}

/* Header Styles */
.insights-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.insights-tag {
    color: #01888C;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}

.orange-line {
    width: 20px;
    height: 2px;
    background: #F47735;
}

.insights-title {
    font-family: 'Sora', sans-serif;
    font-weight: 700;
    font-size: 40px;
    color: #01354B;
    margin-bottom: 10px;
}

.insights-title span { color: #01888C; }

.insights-desc {
    color: #64748B;
    font-size: 15px;
    max-width: 480px;
}

.all-insights-btn {
    color: #01354B;
    text-decoration: none;
    font-weight: 700;
    border-bottom: 2px solid #F47735;
    padding-bottom: 5px;
}

/* Grid Layout */
.insights-grid {
    display: grid;
    grid-template-columns: 516px 256px 256px; 
    grid-template-rows: repeat(2, auto);
    column-gap: 20px;
    row-gap: 20px;
}

/* Big Card Styling */
.big-card {
    grid-row: span 2; /* row-span: 2 */
    width: 516px;
    height: 482.8px;
    background: #fff;
    border: 1px solid #E3E8EB;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0px 10px 36px 0px #01354B1A;
}

.big-card .card-img-box img { height: 260px; object-fit: cover; }

/* Small Card Styling */
.small-card {
    width: 256px;
    height: auto;
    background: #fff;
    border: 1px solid #E3E8EB;
    border-radius: 10px;
    overflow: hidden;
}

.small-img img { height: 140px; object-fit: cover; }

/* Generic Card Elements */
.card-img-box { position: relative; }

.img-overlay-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(142.06deg, rgba(1, 53, 75, 0.6) 0%, rgba(1, 136, 140, 0.3) 100%);
}

.in-badge-custom {
    position: absolute;
    bottom: 12px;
    left: 12px;
    background: #F47735; /* Article badge color */
    color: #fff;
    font-size: 10px;
    padding: 3px 10px;
    border-radius: 100px;
}

.card-body { padding: 24px; flex-grow: 1; }
.card-body-small { padding: 18px 20px; }

.card-h { font-size: 18px; font-weight: 600; color: #01354B; line-height: 1.4; }
.card-h-small { font-size: 14px; font-weight: 700; color: #01354B; line-height: 1.4; margin-bottom: 15px; }

.card-p { font-size: 13px; color: #64748B; margin-top: 12px; line-height: 1.6; }

.card-footer { padding: 15px 24px; border-top: 1px solid #F1F5F9; display: flex; justify-content: space-between; }
.card-footer-small { display: flex; justify-content: space-between; align-items: center; margin-top: auto; }

.meta-text { font-size: 11px; color: #94A3B8; }
.footer-link { font-size: 12px; color: #01888C; font-weight: 700; text-decoration: none; }

/* All Insights Link Box */
.all-box-link {
    background: #F1F5F9;
    border: 1px solid #E3E8EB;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    transition: 0.3s;
}

.all-box-link:hover { background: #E6F7F8; }

.all-text { color: #01888C; font-size: 11px; text-transform: uppercase; font-weight: 700; }
.insights-link-text { color: #01888C; font-size: 20px; font-weight: 800; margin: 2px 0; }
.arrow-icon { color: #01354B; font-size: 24px; }

/* Responsive */
@media (max-width: 1100px) {
    .insights-container { width: 95%; }
    .insights-grid { grid-template-columns: 1fr; }
    .big-card, .small-card { width: 100%; height: auto; }
}

/* ================= PARTNERS SECTION ================= */
.partners-section {
    width: 100%;
    max-width: 1920px;
    background: #ffffff;
    padding: 100px 0; 
    border-top: 1px solid #E5E9ED;
    margin: 0 auto;
}

.partners-container {
    width: 1200px;
    max-width: 1200px;
    padding: 0 60px;
    margin: 0 auto;
}

.partners-tag {
    color: #01888C;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 2px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
}

.orange-line {
    width: 30px;
    height: 2px;
    background: #F47735;
}

.partners-title {
    font-family: 'Sora', sans-serif;
    font-weight: 700;
    font-size: 42px;
    color: #01354B;
    line-height: 1.2;
}

.partners-title span { color: #01888C; }

.partners-desc {
    color: #64748B;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 0;
}


.logo-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    border: 1px solid #E5E9ED;
    border-radius: 16px;
    overflow: hidden;
    margin-top: 52px;
}

.partner-logo-wrapper {
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
    border-right: 1px solid #E5E9ED;
    background: #fff;
    transition: 0.3s;
}

.partner-logo-wrapper:last-child { border-right: none; }

.partner-logo-wrapper img {
    max-height: 45px;
    max-width: 100%;
    filter: grayscale(100%);
    opacity: 0.6;
    transition: 0.3s;
}

.partner-logo-wrapper:hover img {
    filter: grayscale(0%);
    opacity: 1;
}

/* Slider Controls (Dots & Arrows) */
.slider-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 24px;
    margin-top: 30px;
}

.arrow-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid #E5E9ED;
    background: transparent;
    color: #94A3B8;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
}

.arrow-btn:hover {
    border-color: #01888C;
    color: #01888C;
}

.dots-box {
    display: flex;
    gap: 8px;
}

.dot {
    width: 8px;
    height: 8px;
    background: #E2E8F0;
    border-radius: 50%;
    display: inline-block;
}

.dot.active {
    background: #01888C;
    width: 12px;
    border-radius: 10px;
}

/* Responsive */
@media (max-width: 1200px) {
    .partners-container { width: 100%; padding: 0 20px; }
    .logo-grid { grid-template-columns: repeat(2, 1fr); }
    .partner-logo-wrapper:nth-child(2) { border-right: none; }
    .partner-logo-wrapper { border-bottom: 1px solid #E5E9ED; }
}


</style>
@endpush


@section('content')

<section class="about-hero">
    <img src="{{ asset('assets/img/Trade and Customs.png') }}" alt="Hero" class="img-fluid rounded-4 shadow-sm">
    <div class="container-fluid about-hero-content">
        <div class="custom-container"> 
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        Empowering Change <br>
                        through <span>Insightful</span> <br>
                        Consulting
                    </h1>
                    <p class="text-white-50 mt-3" style="max-width: 480px; font-size: 17px; line-height: 30px;">
                        We deliver evidence-based policy recommendations and advocacy that help
                        governments design actionable, impactful reforms from the ground up.
                    </p>
                    <div class="hero-line mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 my-md-5">
    <div class="custom-container">
        <div class="row align-items-center gy-5">
            
            <div class="col-lg-6 pe-lg-5">
                <span class="about-tag mb-3">ABOUT TRACE</span>
                <h2 class="about-title mb-4">
                    A firm built on <span>insight, strategy,</span> and lasting impact.
                </h2>

                <div class="about-info mt-4">
                    <div class="mb-4">
                        <h4 class="fw-bold" style="font-size: 18px;">Who We Are</h4>
                        <p class="text-secondary">
                            We work at the intersection of research, innovation, and implementation—
                            empowering institutions with data-driven insights.
                        </p>
                    </div>

                    <div class="about-divider mb-4"></div>

                    <div class="mb-4">
                        <h4 class="fw-bold" style="font-size: 18px;">Our Mission</h4>
                        <p class="text-secondary">
                            To deliver smart, sustainable, and inclusive solutions that drive economic
                            growth and strengthen institutions.
                        </p>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="btn btn-primary-custom">Work With Us &rarr;</a>
                    <a href="#" class="btn btn-outline-custom text-dark text-decoration-none">Our Services</a>
                </div>
            </div>

            <div class="col-lg-6 about-right text-end">
                <img src="{{ asset('assets/img/Trace team.png') }}" class="img-fluid shadow-lg" alt="Team" style="width: 500px; height: 600px; object-fit: cover;">
            </div>

        </div>
    </div>
</section>

<section class="commitment">
    <div class="commitment-bg-wrap">
        <img src="{{ asset('assets/img/Background (8).png') }}" alt="Background">
    </div>
    <div class="commitment-left-img">
        <img src="{{ asset('assets/img/Background (3).png') }}" alt="Chess Overlay">
    </div>

    <div class="custom-container commitment-content-area">
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <div class="commitment-content-box">
                    <h2>OUR COMMITMENT</h2>
                    <div class="underline" style="width:32px; height:3px; background:#F47735; margin-bottom:22px;"></div>
                    
                    <p class="small mb-3 text-uppercase fw-bold text-info" style="font-size: 13px; letter-spacing: 1px;">
                        We are committed to
                    </p>

                    <ul>
                        <li>Integrity and transparency in every engagement</li>
                        <li>Delivering measurable outcomes, not just recommendations</li>
                        <li>Building local capacity and ownership</li>
                        <li>Promoting innovation and sustainability in every project</li>
                    </ul>

                    <p class="bottom-text mt-4" style="color:#cbd5e1; font-style: italic;">
                        At Trace Consulting, we don’t just advise — we collaborate to create lasting change.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="framework-section">
    <div class="framework-main-container">
        <div class="row align-items-center" style="column-gap: 72px;">
            
            <div class="col-lg-5 p-0">
                <div class="framework-tag d-flex align-items-center gap-2 mb-3">
                    <span class="line"></span>
                    <span class="tag-text">OUR FRAMEWORK</span>
                </div>
                <h2 class="framework-title mb-4">
                    How We <br> <span>Work</span>
                </h2>
                <p class="framework-desc mb-4">
                    Our proven three-stage framework turns complex trade and policy challenges
                    into measurable, lasting outcomes for every client we serve.
                </p>
                <a href="#" class="btn-get-started">
                    Get Started &rarr;
                </a>
            </div>

            <div class="col-lg-7 p-0">
                <div class="framework-right-box shadow-sm">
                    <div class="framework-item">
                        <div class="num">01</div>
                        <div class="icon-box"><i class="fa-regular fa-lightbulb"></i></div>
                        <div class="content">
                            <h4>Insight</h4>
                            <p>We turn complex trade and policy issues into clear insights — using
research, data, and deep expertise to transform challenges and risks
into well-defined opportunities ready for action.</p>
                        </div>
                    </div>

                    <div class="framework-item">
                        <div class="num">02</div>
                        <div class="icon-box"><i class="fa-solid fa-gear"></i></div>
                        <div class="content">
                            <h4>Strategy</h4>
                            <p>We formulate insights into strategies — devising evidence and
technology-driven solutions that meet global standards, align with
institutional realities, and drive sustainable growth.</p>
                        </div>
                    </div>

                    <div class="framework-item">
                        <div class="num">03</div>
                        <div class="icon-box"><i class="fa-solid fa-rocket"></i></div>
                        <div class="content">
                            <h4>Impact</h4>
                            <p>We deliver measurable and lasting results by reducing barriers,
enhancing competitiveness, driving reforms, and embedding the tools
clients need to sustain change independently.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="features-section">
    <div class="custom-container">
        <div class="row align-items-end mb-5 gy-4">
            <div class="col-lg-5">
                <div class="features-tag mb-2">
                    <span class="line"></span>
                    OUR UNIQUE FEATURES
                </div>
                <h2 class="features-title">
                    What Makes TRACE <br> <span>Different</span>
                </h2>
            </div>
            <div class="col-lg-7">
                <p class="text-secondary mb-0" style="font-size: 15px; line-height: 1.8; max-width: 600px;">
                    TRACE delivers connected, sustainable, and tailored solutions from policy to practice that streamline processes, strengthen institutions, and empower growth.
                </p>
            </div>
        </div>

<div class="row g-4">
    @php
        $features = [
            [
                'icon' => 'fa-solid fa-users-viewfinder', 
                'title' => 'Industry-wide Network', 
                'desc' => "With proven networks across
government agencies and
private sector stakeholders,
TRACE consistently bridges
policy leadership and
business realities, enabling
reforms prioritising client's
need."
            ],
            [
                'icon' => 'fa-regular fa-clock', 
                'title' => 'Sustainable Approach', 
                'desc' => "TRACE works with partners
to build sustainable
solutions, embedding
facilitation tools into
legislation, training
mechanisms, and digital
systems that outlast the
engagement."
            ],
            [
                'icon' => 'fa-solid fa-arrow-trend-up',
                'title' => 'Tailored Innovation', 
                'desc' => "From tech-driven trade
systems, lab-accreditation
roadmaps, or temperature-
controlled logistics, TRACE
designs solutions
customised to sectoral
realities and institutional
capacity."
            ],
            [
                'icon' => 'fa-regular fa-sun', 
                'title' => 'End-to-End Integrated Solutions', 
                'desc' => "TRACE provides fully
integrated support — from
strategic design through
implementation and
evaluation — ensuring every
solution works as a
connected, coherent whole."
            ]
        ];
    @endphp

    @foreach($features as $feature)
    <div class="col-md-6 col-lg-3">
        <div class="feature-card shadow-sm h-100">
            <div class="icon-wrapper mb-4">
                <i class="{{ $feature['icon'] }}"></i>
            </div>
            <h5 class="fw-bold mb-3">{{ $feature['title'] }}</h5>
            <p class="text-secondary small line-height-relaxed">
                {{ $feature['desc'] }}
            </p>
        </div>
    </div>
    @endforeach
</div>
</section>

<section class="projects-section">
    <div class="projects-main-container">
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="orange-line"></span>
                    <span class="projects-tag">WORK THAT CREATES IMPACT</span>
                </div>
                <h2 class="project-title">
                    Our <span class="highlight">Projects</span>
                </h2>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="#" class="all-projects-link">
                    All Projects <span class="arrow-circle">→</span>
                </a>
            </div>
        </div>

        <div class="projects-grid">
            <div class="project-card">
                <img src="{{ asset('assets/img/Lab Project.png') }}" alt="Lab Project">
                <div class="project-overlay">
                    <span class="project-badge">LAB ACCREDITATION</span>
                    <h3 class="project-h">ISO/IEC 17025:2017 Accreditation Support to PRTC, CVASU</h3>
                    <div class="project-meta">
                        <span class="meta-line"></span>
                        <p>Chittagong Veterinary & Animal Sciences University</p>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="{{ asset('assets/img/Infrastructure Project.png') }}" alt="Infrastructure">
                <div class="project-overlay">
                    <span class="project-badge">INFRASTRUCTURE DESIGN</span>
                    <h3 class="project-h">Seven-Storey Customs Laboratory Layout Design, Chattogram</h3>
                    <div class="project-meta">
                        <span class="meta-line"></span>
                        <p>Customs Authority, Chattogram</p>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="{{ asset('assets/img/BAFISA Project.png') }}" alt="Digital Solutions">
                <div class="project-overlay">
                    <span class="project-badge">DIGITAL SOLUTIONS</span>
                    <h3 class="project-h">HS Code Import Database & BAFISA Website Upgrade</h3>
                    <div class="project-meta">
                        <span class="meta-line"></span>
                        <p>Bangladesh Freight Forwarders & Shipping Association</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="insights-section">
    <div class="insights-container">
        <div class="insights-header mb-5">
            <div class="header-left">
                <div class="insights-tag">
                    <span class="orange-line"></span> INSIGHTS
                </div>
                <h2 class="insights-title">Ideas and <span>perspectives</span></h2>
                <p class="insights-desc">Thought leadership, research publications, and knowledge resources from our team.</p>
            </div>
            <div class="header-right">
                <a href="#" class="all-insights-btn">All Insights &rarr;</a>
            </div>
        </div>

        <div class="insights-grid">
            <div class="insight-card big-card">
                <div class="card-img-box">
                    <img src="{{ asset('assets/img/Insight.png') }}" alt="Insight">
                    <div class="img-overlay-gradient"></div>
                    <span class="in-badge-custom">ARTICLE</span>
                </div>
                <div class="card-body">
                    <h4 class="card-h">Unlocking Animal Health & Nutrition Ecosystems to Power National Growth</h4>
                    <p class="card-p">Achieving international accreditation in resource-constrained settings requires more than documentation — it demands a cultural shift. This article draws on our direct experience...</p>
                </div>
                <div class="card-footer">
                    <span class="meta-text">March 2025 · 8 min read</span>
                    <a href="#" class="footer-link">Read article &rarr;</a>
                </div>
            </div>

            <div class="insight-card small-card">
                <div class="card-img-box small-img">
                    <img src="{{ asset('assets/img/WTO.png') }}" alt="WTO">
                    <div class="img-overlay-gradient"></div>
                    <span class="in-badge-custom">PUBLICATION</span>
                </div>
                <div class="card-body-small">
                    <h4 class="card-h-small">Trade Facilitation & WTO Agreement: Roadmap for South Asian Customs Agencies</h4>
                    <div class="card-footer-small">
                        <span class="meta-text">Feb 2025 · 24pp</span>
                        <a href="#" class="footer-link">Download &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="insight-card small-card">
                <div class="card-img-box small-img">
                    <img src="{{ asset('assets/img/Video.png') }}" alt="Video">
                    <div class="img-overlay-gradient"></div>
                    <span class="in-badge-custom" style="background: #01888C;">VIDEO</span>
                </div>
                <div class="card-body-small">
                    <h4 class="card-h-small">Single Window Systems: A Practitioner's Guide to Trade Digitalisation</h4>
                    <div class="card-footer-small">
                        <span class="meta-text">Jan 2025 · 18 min</span>
                        <a href="#" class="footer-link">Watch &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="insight-card small-card">
                <div class="card-img-box small-img">
                    <img src="{{ asset('assets/img/pr-BAFISA.png') }}" alt="BAFISA">
                    <div class="img-overlay-gradient"></div>
                    <span class="in-badge-custom">BROCHURE</span>
                </div>
                <div class="card-body-small">
                    <h4 class="card-h-small">BAFISA Unified Presentation for Exporting Countries & Delegations</h4>
                    <div class="card-footer-small">
                        <span class="meta-text">Dec 2024</span>
                        <a href="#" class="footer-link">Download &rarr;</a>
                    </div>
                </div>
            </div>

            <a href="#" class="all-box-link">
                <span class="all-text">All</span>
                <h4 class="insights-link-text">Insights</h4>
                <div class="arrow-icon">&rarr;</div>
            </a>
        </div>
    </div>
</section>
<section class="partners-section">
    <div class="partners-container">
        <div class="row align-items-center mb-5 gx-lg-5">
            <div class="col-lg-6">
                <div class="partners-tag">
                    <span class="orange-line"></span> OUR PARTNERS
                </div>
                <h2 class="partners-title">
                    Trusted by Leading <br> <span>Institutions</span>
                </h2>
            </div>
            <div class="col-lg-6">
                <p class="partners-desc">
                    We work with governments, multilateral development organisations, regulatory bodies, and private sector leaders across the region — building long-term partnerships grounded in trust and results.
                </p>
            </div>
        </div>

        <div class="partners-content-box">
            <div class="logo-grid">
                @php $logos = ['bafisa.png', 'lir 2.png', 'bijem.png', 'build.png']; @endphp
                @foreach($logos as $logo)
                <div class="partner-logo-wrapper">
                    <img src="{{ asset('assets/img/'.$logo) }}" alt="Partner Logo">
                </div>
                @endforeach
            </div>

            <div class="slider-controls">
                <button class="arrow-btn"><i class="fa-solid fa-arrow-left"></i></button>
                <div class="dots-box">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <button class="arrow-btn"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</section>

@include('frontend.layout.cta')
@endsection