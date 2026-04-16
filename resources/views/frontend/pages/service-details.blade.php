@extends('frontend.layout.app')



@push('custome-css')
<style>

/* =========================================
   HERO
========================================= */
.service-hero {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.hero-bg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(1, 53, 75, 0.92) 0%,
        rgba(1, 53, 75, 0.75) 50%,
        rgba(1, 53, 75, 0.25) 100%
    );
    z-index: 1;
}

.hero-container {
    position: relative;
    z-index: 2;
    height: 100%;
    max-width: 1072px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    align-items: center;
}

.page-align-container { max-width: 1072px; margin: 0 auto; }

.hero-content {
    max-width: 520px;
}

.hero-content h1 {
    font-size: 48px;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.15;
    margin-bottom: 16px;
}

.hero-content h1 span {
    color: #22c1c3;
}

.hero-content p {
    font-size: 14px;
    color: #cbd5e1;
    line-height: 1.7;
    margin-bottom: 20px;
    max-width: 440px;
}

.hero-line {
    width: 48px;
    height: 3px;
    background: #F47735;
    border-radius: 2px;
}

/* =========================================
   DETAILS SECTION
========================================= */
.service-details-section {
    background: #ffffff;
    padding: 64px 0 80px;
}

/* =========================================
   LEFT — BOXES
========================================= */
.service-box {
    margin-bottom: 40px;
}

/* SECTION HEADING with orange left border */
.service-box h3 {
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    border-left: 3px solid #F47735;
    padding-left: 12px;
    margin-bottom: 18px;
    line-height: 1.3;
}

.service-box p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.75;
    margin-bottom: 14px;
}

.service-box p:last-child { margin-bottom: 0; }

/* ---- SERVICES INCLUDE ---- */
.include-list {
    display: flex;
    flex-direction: column;
    gap: 0;
    border: 1px solid #E5E9ED;
    border-radius: 10px;
    overflow: hidden;
}

.include-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 18px;
    font-size: 13.5px;
    color: #334155;
    line-height: 1.5;
    border-bottom: 1px solid #F1F4F7;
    transition: background .2s;
}

.include-item:last-child { border-bottom: none; }
.include-item:hover { background: #f8fafc; }

.include-item .check-icon {
    width: 20px;
    height: 20px;
    background: #E2F5F5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
}

.include-item .check-icon svg {
    width: 11px;
    height: 11px;
    stroke: #01888C;
    stroke-width: 2.5;
    fill: none;
}

/* ---- PRODUCTS GRID ---- */
.product-sub {
    font-size: 13px;
    color: #94a3b8;
    margin-bottom: 20px !important;
}

.product-card {
    border: 1px solid #E5E9ED;
    border-radius: 10px;
    padding: 18px 18px 16px;
    transition: box-shadow .25s, transform .25s;
    height: 100%;
}

.product-card:hover {
    box-shadow: 0 4px 20px rgba(1,53,75,.10);
    transform: translateY(-3px);
}

.product-card .prod-num {
    font-size: 11px;
    color: #94a3b8;
    letter-spacing: 1px;
    display: block;
    margin-bottom: 8px;
}

.product-card h4 {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.4;
    margin-bottom: 12px;
}

.prod-tag {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1px;
    padding: 4px 10px;
    border-radius: 4px;
    background: #E2F5F5;
    color: #01888C;
}

/* =========================================
   RIGHT SIDEBAR
========================================= */
.sidebar-box {
    background: #fff;
    border: 1px solid #E5E9ED;
    border-radius: 12px;
    padding: 22px;
    margin-bottom: 20px;
}

/* NEED THIS SERVICE — dark box */
.sidebar-cta {
    background: #01354B;
    border: none;
    border-radius: 12px;
    padding: 24px 22px;
    margin-bottom: 20px;
}

.sidebar-cta h4 {
    font-size: 17px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 8px;
}

.sidebar-cta p {
    font-size: 13px;
    color: #94a3b8;
    line-height: 1.6;
    margin-bottom: 18px;
}

.btn-expert {
    display: block;
    width: 100%;
    background: #F47735;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 12px;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    transition: background .3s;
    text-decoration: none;
}

.btn-expert:hover {
    background: #d9622a;
    color: #fff;
}

/* OTHER SERVICES */
.sidebar-box h4 {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 16px;
}

.other-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 11px 14px;
    font-size: 13px;
    color: #334155;
    border-radius: 7px;
    cursor: pointer;
    text-decoration: none;
    transition: background .2s, color .2s;
    margin-bottom: 4px;
}

.other-item:last-child { margin-bottom: 0; }

.other-item:hover {
    background: #F0FAFA;
    color: #01888C;
}

.other-item .item-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.other-item .item-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #F1F4F7;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.other-item .item-icon svg {
    width: 14px;
    height: 14px;
    stroke: #64748b;
    fill: none;
    stroke-width: 1.8;
}

.other-item:hover .item-icon {
    background: #E2F5F5;
}

.other-item:hover .item-icon svg {
    stroke: #01888C;
}

.other-item .arrow-right {
    font-size: 13px;
    color: #94a3b8;
}

/* =========================================
   CTA SECTION
========================================= */
.cta-section {
    background: #01354B;
    padding: 72px 0;
}

.cta-section .orange-dash {
    display: inline-block;
    width: 24px;
    height: 2px;
    background: #F47735;
    vertical-align: middle;
    margin-right: 10px;
}

.cta-label {
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

.cta-section .cta-title .teal-text { color: #22c1c3; }

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
@media (max-width: 992px) {
    .service-hero { height: 260px; }
    .hero-content h1 { font-size: 36px; }
    .cta-section .cta-title { font-size: 28px; }
}

@media (max-width: 768px) {
    .service-hero { height: 220px; }
    .hero-content h1 { font-size: 28px; }
    .hero-content p { font-size: 13px; }
    .service-details-section { padding: 40px 0 60px; }
    .service-box h3 { font-size: 18px; }
    .cta-section { padding: 52px 0; }
    .cta-section .cta-title { font-size: 24px; }
}

@media (max-width: 576px) {
    .service-hero { height: 200px; }
    .hero-content h1 { font-size: 24px; }
    .hero-overlay {
        background: rgba(1, 53, 75, 0.85);
    }
    .cta-section .cta-title { font-size: 22px; }
}

</style>
@endpush

@section('content')

{{-- ==============================
     HERO
============================== --}}
<section class="service-hero">

    <div class="hero-bg">
        <img src="{{ asset('images/Trade and Customs.png') }}" alt="Trade Facilitation">
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-container">
        <div class="hero-content">
            <h1>Trade <span>Facilitation</span></h1>
            <p>
                TRACE supports governments, trade bodies, and private stakeholders
                to modernize, simplify, and automate cross-border trade procedures in
                line with global best practices and WTO TFA commitments.
            </p>
            <div class="hero-line"></div>
        </div>
    </div>

</section>

{{-- ==============================
     DETAILS SECTION
============================== --}}
<section class="service-details-section">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="row g-4 g-lg-5">

            {{-- ===== LEFT COLUMN ===== --}}
            <div class="col-12 col-lg-8">

                {{-- OVERVIEW --}}
                <div class="service-box">
                    <h3>Overview</h3>
                    <p>
                        TRACE supports governments, trade bodies, and private stakeholders to modernize,
                        simplify, and automate cross-border trade procedures in line with global best practices
                        and WTO Trade Facilitation Agreement (TFA) commitments. Our approach integrates
                        policy reform, digital transformation, and institutional strengthening.
                    </p>
                    <p>
                        By combining strategic policy insight with cutting-edge technical innovation, TRACE
                        bridges the gap between reform design and implementation, turning commitments into
                        real-world improvements at ports, borders, and trade agencies.
                    </p>
                </div>

                {{-- SERVICES INCLUDE --}}
                <div class="service-box">
                    <h3>Our Services Include</h3>

                    <div class="include-list">
                        @php
                        $includes = [
                            'Mapping and streamlining border processes',
                            'Introducing digital solutions for licensing and clearance',
                            'Promoting exports following international requirements',
                            'Reviewing legislative frameworks to identify bottlenecks',
                            'Supporting private sector trade facilitation services',
                            'Facilitating stakeholder consultations',
                            'Advising business chambers and associations',
                        ];
                        @endphp

                        @foreach($includes as $item)
                        <div class="include-item">
                            <span class="check-icon">
                                <svg viewBox="0 0 12 12">
                                    <polyline points="2,6 5,9 10,3"/>
                                </svg>
                            </span>
                            {{ $item }}
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- PRODUCTS --}}
                <div class="service-box">
                    <h3>Products & Solutions</h3>
                    <p class="product-sub">
                        Specific digital tools and deliverables TRACE designs and deploys under this service area.
                    </p>

                    @php
                    $products = [
                        ['num' => 'Product 01', 'title' => 'Online Pre-Arrival Processing System',         'tag' => 'DIGITAL PLATFORM'],
                        ['num' => 'Product 02', 'title' => 'Automated Risk Management System',             'tag' => 'TECHNOLOGY'],
                        ['num' => 'Product 03', 'title' => 'Authorized Economic Operator Facilities',      'tag' => 'CERTIFICATION'],
                        ['num' => 'Product 04', 'title' => 'Conducting Time Release Study (TRS)',          'tag' => 'ASSESSMENT'],
                        ['num' => 'Product 05', 'title' => 'Developing Trade Transparency Portal',         'tag' => 'DIGITAL PLATFORM'],
                        ['num' => 'Product 06', 'title' => 'Online Export Performance Management System',  'tag' => 'TECHNOLOGY'],
                    ];
                    @endphp

                    <div class="row g-3">
                        @foreach($products as $product)
                        <div class="col-12 col-sm-6">
                            <div class="product-card">
                                <span class="prod-num">{{ $product['num'] }}</span>
                                <h4>{{ $product['title'] }}</h4>
                                <span class="prod-tag">{{ $product['tag'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>{{-- end left --}}

            {{-- ===== RIGHT SIDEBAR ===== --}}
            <div class="col-12 col-lg-4">

                {{-- NEED THIS SERVICE --}}
                <div class="sidebar-cta">
                    <h4>Need this service?</h4>
                    <p>Get in touch and our team will walk you through our solutions.</p>
                    <a href="#" class="btn-expert">Talk to Our Experts</a>
                </div>

                {{-- OTHER SERVICES --}}
                <div class="sidebar-box">
                    <h4>Other Services</h4>

                    @php
                    $otherServices = [
                        ['label' => 'Policy Advocacy',                          'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                        ['label' => 'Research & Innovation',                    'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                        ['label' => 'Training & Capacity Building',             'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
                        ['label' => 'Technical Assistance & Project Management','icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                        ['label' => 'Tech Solutions',                           'icon' => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18'],
                        ['label' => 'Laboratory Services',                      'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                        ['label' => 'Temperature Controlled Logistics (TCL) Solution', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                        ['label' => 'Trade Transparency',                       'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064'],
                    ];
                    @endphp

                    @foreach($otherServices as $svc)
                    <a href="#" class="other-item">
                        <span class="item-left">
                            <span class="item-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $svc['icon'] }}"/>
                                </svg>
                            </span>
                            {{ $svc['label'] }}
                        </span>
                        <span class="arrow-right">›</span>
                    </a>
                    @endforeach

                </div>{{-- end sidebar-box --}}

            </div>{{-- end right --}}

        </div>{{-- end row --}}
    </div>
</section>

<!-- {{-- ==============================
     CTA
============================== --}}
<section class="cta-section">
    <div class="container" style="max-width: 1200px;">
        <div class="row align-items-center gy-4">

            <div class="col-12 col-lg-8">
                <div class="mb-3">
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

            <div class="col-12 col-lg-4 d-flex justify-content-lg-end">
                <a href="#" class="btn-touch">Get in Touch &rarr;</a>
            </div>

        </div>
    </div>
</section> -->
@include('frontend.layout.cta')

@endsection