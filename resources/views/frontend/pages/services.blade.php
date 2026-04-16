@extends('frontend.layout.app')



@push('custome-css')
<style>

 .service-breadcrumb {
    background: #F8F9FB;
    border-bottom: 1px solid #E5E9ED;
    padding: 12px 0;
}
.breadcrumb-links { font-size: 13px; color: #94A3B8; }
.breadcrumb-links a { color: #64748B; text-decoration: none; }
.breadcrumb-links .sep { margin: 0 8px; }
.breadcrumb-links .active { color: #01354B; font-weight: 600; }   

/* =========================================
   HERO / SERVICES SECTION
========================================= */
.services-hero {
    background: #01354B;
    padding: 72px 0 64px;
}

.services-hero .label-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
}

.services-hero .orange-line {
    display: inline-block;
    width: 28px;
    height: 2px;
    background: #F47735;
}

.services-hero .top-label {
    font-size: 11px;
    letter-spacing: 2.5px;
    color: #F47735;
    font-weight: 600;
}

.services-hero .services-title {
    font-size: 48px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 20px;
    line-height: 1.15;
}

.services-hero .services-title .teal-text {
    color: #22c1c3;
}

.services-hero .services-description {
    font-size: 15px;
    color: #94a3b8;
    line-height: 1.7;
    max-width: 560px;
    margin: 0;
}

/* =========================================
   CARDS SECTION
========================================= */
.services-cards-section {
    background: #ffffff;
    padding: 72px 0 80px;
}

/* CARD */
.service-card {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #E5E9ED;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: box-shadow .3s ease, transform .3s ease;
}

.service-card:hover {
    box-shadow: 0 4px 16px rgba(1,53,75,.10), 0 16px 48px rgba(1,53,75,.14);
    transform: translateY(-4px);
}

/* IMAGE */
.service-card .card-img {
    width: 100%;
    height: 210px;
    object-fit: cover;
    display: block;
}

/* CARD CONTENT */
.card-content {
    padding: 22px 22px 10px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-tag {
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 1.5px;
    color: #22c1c3;
    margin-bottom: 12px;
    display: block;
}

.card-line {
    width: 100%;
    height: 1px;
    background: #E5E9ED;
    margin-bottom: 14px;
}

.card-content h3 {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.45;
    margin-bottom: 12px;
}

.card-content p {
    font-size: 13px;
    color: #64748b;
    line-height: 1.65;
    margin: 0;
    flex: 1;
}

/* CARD FOOTER */
.card-footer-bar {
    padding: 14px 22px;
    border-top: 1px solid #F1F4F7;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
}

.card-footer-bar .products-count {
    font-size: 12px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: 6px;
}

.card-footer-bar .dot {
    width: 7px;
    height: 7px;
    background: #F47735;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
}

.card-footer-bar a {
    font-size: 13px;
    font-weight: 600;
    color: #22c1c3;
    text-decoration: none;
    transition: color .25s;
}

.card-footer-bar a:hover {
    color: #01354B;
}

/* =========================================
   CTA SECTION
========================================= */
.cta-section {
    background: #01354B;
    padding: 72px 0;
}

.cta-section .label-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
}

.cta-section .orange-dash {
    display: inline-block;
    width: 24px;
    height: 2px;
    background: #F47735;
}

.cta-section .cta-label {
    font-size: 11px;
    letter-spacing: 2.5px;
    color: #F47735;
    font-weight: 600;
}

.cta-section .cta-title {
    font-size: 36px;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.3;
    margin-bottom: 16px;
}

.cta-section .cta-title .teal-text {
    color: #22c1c3;
}

.cta-section .cta-desc {
    font-size: 14px;
    color: #94a3b8;
    line-height: 1.7;
    max-width: 480px;
    margin: 0;
}

.btn-touch {
    display: inline-block;
    background: #F47735;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    padding: 14px 28px;
    border-radius: 6px;
    text-decoration: none;
    transition: background .3s;
    white-space: nowrap;
}

.btn-touch:hover {
    background: #d9622a;
    color: #fff;
}

/* =========================================
   RESPONSIVE
========================================= */
.page-align-container { max-width: 1072px; margin: 0 auto; }

@media (max-width: 992px) {
    .services-hero .services-title { font-size: 36px; }
    .cta-section .cta-title { font-size: 28px; }
    .cta-right { margin-top: 24px; }
}

@media (max-width: 768px) {
    .services-hero { padding: 52px 0 44px; }
    .services-hero .services-title { font-size: 30px; }
    .services-hero .services-description { font-size: 14px; }
    .service-card .card-img { height: 180px; }
    .cta-section { padding: 52px 0; }
    .cta-section .cta-title { font-size: 24px; }
}

@media (max-width: 576px) {
    .services-hero .services-title { font-size: 26px; }
    .cta-section .cta-title { font-size: 22px; }
    .card-content { padding: 16px 16px 8px; }
    .card-footer-bar { padding: 12px 16px; }
}

</style>
@endpush

@section('content')

<nav class="service-breadcrumb">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="breadcrumb-links">
            <a href="\">Home</a>
            <span class="sep">›</span>
            <span class="active">Services</span>
        </div>
    </div>
</nav>

{{-- ==============================
     HERO
============================== --}}
<section class="services-hero">
    <div class="container-fluid px-lg-5 page-align-container">

        <div class="label-wrapper">
            <span class="orange-line"></span>
            <span class="top-label">WHAT WE DO</span>
        </div>

        <h2 class="services-title">
            Our <span class="teal-text">Services</span>
        </h2>

        <p class="services-description">
            TRACE provides consultancy, research, and advocacy services that help government
            agencies and businesses reform policies, advance trade facilitation, expand
            market access, and strengthen laboratory and cold chain systems.
        </p>

    </div>
</section>

{{-- ==============================
     SERVICE CARDS
============================== --}}
<section class="services-cards-section">
    <div class="container-fluid px-lg-5 page-align-container">

        @php
        $services = [
            [
                'img'      => 'Trade and Customs.png',
                'tag'      => 'TRADE FACILITATION & CUSTOMS',
                'title'    => 'Strengthening Cross-Border Trade & Customs Systems',
                'desc'     => 'Supporting governments and trade bodies to modernise, simplify, and automate cross-border trade procedures in line with WTO Trade Facilitation Agreement commitments.',
                'products' => '6 Products',
            ],
            [
                'img'      => 'Lab Accreditation.png',
                'tag'      => 'POLICY ADVOCACY',
                'title'    => 'Evidence-Based Policy Reform & Advocacy',
                'desc'     => 'Delivering evidence-based policy advocacy and recommendations to help governments design actionable, impactful reforms that translate complex realities into clear policy direction.',
                'products' => '4 Products',
            ],
            [
                'img'      => 'Digital Trade Infrastructure in Bangladesh_ A Readiness Assessment.png',
                'tag'      => 'RESEARCH & ASSESSMENTS',
                'title'    => 'In-Depth Trade, Economic & Development Research',
                'desc'     => 'Conducting rigorous research, assessments, and evaluations on trade, economics, and development issues to drive informed decision-making for governments and development agencies.',
                'products' => '5 Products',
            ],
            [
                'img'      => 'Reforming Bangladesh\'s Export Licensing Framework_ Policy Brief 2024.png',
                'tag'      => 'CAPACITY BUILDING',
                'title'    => 'Need-Based Training for Public & Private Sector',
                'desc'     => 'Building the capacity of public and private sector stakeholders through targeted, need-based training on trade, markets, IT systems, and laboratory practices.',
                'products' => '4 Products',
            ],
            [
                'img'      => 'Infrastructure Project.png',
                'tag'      => 'PROJECT MANAGEMENT',
                'title'    => 'End-to-End Project Design, Management & Implementation',
                'desc'     => 'Designing, managing, and implementing tailor-made projects that address trade, economic, and market access challenges — delivering measurable results across the full lifecycle.',
                'products' => '3 Products',
            ],
            [
                'img'      => 'Capacity Building.png',
                'tag'      => 'TECHNOLOGY SOLUTIONS',
                'title'    => 'Technology-Driven Trade Systems & Digital Platforms',
                'desc'     => 'Designing and deploying technology-driven trade systems — LIMS, certification platforms, single windows, and custom digital tools — that make trade procedures faster and cost-effective.',
                'products' => '5 Products',
            ],
            [
                'img'      => 'Lab Project.png',
                'tag'      => 'LABORATORY SERVICES',
                'title'    => 'Lab Accreditation, QMS & Testing Capacity Development',
                'desc'     => 'Supporting public and private laboratories to establish quality management systems, obtain ISO/IEC 17025 accreditation, and enhance testing capacity to meet international standards.',
                'products' => '4 Products',
            ],
            [
                'img'      => 'Infrastructure Design (1).png',
                'tag'      => 'TRADE INFORMATION SYSTEMS',
                'title'    => 'Online Portals, Databases & Transparency Platforms',
                'desc'     => 'Enhancing transparency in export–import by developing online portals, trade information databases, notification systems, and digital platforms for accurate, timely, and reliable data.',
                'products' => '4 Products',
            ],
            [
                'img'      => 'Capacity Building (2).png',
                'tag'      => 'COLD CHAIN & LOGISTICS',
                'title'    => 'Temperature-Controlled Logistics & Supply Chain Systems',
                'desc'     => 'Designing and strengthening cold chain and logistics systems to help agricultural, pharmaceutical, and perishable goods sectors meet quality and compliance standards.',
                'products' => '4 Products',
            ],
        ];
        @endphp

        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="service-card">

                    <img
                        src="/assets/img/{{ $service['img'] }}"
                        alt="{{ $service['tag'] }}"
                        class="card-img">

                    <div class="card-content">
                        <span class="card-tag">{{ $service['tag'] }}</span>
                        <div class="card-line"></div>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['desc'] }}</p>
                    </div>

                    <div class="card-footer-bar">
                        <span class="products-count">
                            <span class="dot"></span>
                            {{ $service['products'] }}
                        </span>
                        <a href="{{ route('serviceDetails', ['id' => $loop->index + 1]) }}">View Service →</a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
<!-- 
{{-- ==============================
     CTA
============================== --}}
<section class="cta-section">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="row align-items-center gy-4">

            {{-- LEFT --}}
            <div class="col-12 col-lg-8">
                <div class="label-wrapper">
                    <span class="orange-dash"></span>
                    <span class="cta-label">WORK WITH US</span>
                </div>

                <h2 class="cta-title">
                    Have a project in mind? <br>
                    Let's build something <span class="teal-text">that lasts.</span>
                </h2>

                <p class="cta-desc">
                    Whether reforming a regulatory system, building technical capacity, or modernising
                    digital infrastructure — we'd like to hear from you.
                </p>
            </div>

            {{-- RIGHT --}}
            <div class="col-12 col-lg-4 cta-right d-flex justify-content-lg-end">
                <a href="#" class="btn-touch">Get in Touch &rarr;</a>
            </div>

        </div>
    </div>
</section> -->

@include('frontend.layout.cta')

@endsection