@extends('frontend.layout.app')



@push('custome-css')
<style>

/* =========================================
   HERO
========================================= */
.service-hero {
    position: relative;
    height: 420px;
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

.hero-content p,
.hero-content div p,
.hero-content-text,
.hero-content-text p {
    font-size: 14px;
    color: #cbd5e1;
    line-height: 1.7;
    margin-bottom: 20px;
    max-width: 440px;
}

.hero-content-text ul,
.hero-content-text ol {
    margin: 0 0 20px 20px;
    padding-left: 0;
    color: #cbd5e1;
}

.hero-content-text li {
    margin-bottom: 8px;
    color: #cbd5e1;
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

/* CKEditor Content Styling */
.service-box .editor-content p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.75;
    margin-bottom: 14px;
}

.service-box .editor-content p:last-child {
    margin-bottom: 0;
}

.service-box .editor-content ul,
.service-box .editor-content ol {
    margin-left: 24px;
    margin-bottom: 14px;
    color: #64748b;
}

.service-box .editor-content li {
    margin-bottom: 8px;
    line-height: 1.75;
    color: #64748b;
}

.service-box .editor-content strong {
    font-weight: 700;
    color: #334155;
}

.service-box .editor-content em {
    font-style: italic;
}

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
   RESPONSIVE
========================================= */

@media (min-width: 992px) {
    .col-lg-4 {
        position: relative;
    }

    /* Sideer wrapper jeta scroll korle atkay thakbe */
    .sidebar-sticky-wrapper {
        position: sticky;
        top: 90px; /* Matha theke koto niche thakbe */
        align-self: start; /* Flex container er bhetore height adjust korbe */
    }
}
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

.service-breadcrumb {
    background: #F8F9FB;
    min-height: 43px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #E5E9ED;
}
.service-breadcrumb .breadcrumb-links { font-size: 13px; color: #64748B; }
.service-breadcrumb .breadcrumb-links a { color: #64748B; text-decoration: none; }
.service-breadcrumb .breadcrumb-links .sep { margin: 0 10px; color: #CBD5E1; }
.service-breadcrumb .breadcrumb-links .active { color: #01354B; font-weight: 600; }

</style>
@endpush

@section('content')
@php
    use Illuminate\Support\Str;

    $heroImage       = $service->imageUrl() ?? '';
    $heroTitle       = $service->heading ?: $service->service_name;
    $heroDesignWord  = $service->design_word ?? '';
    $heroDescription = $service->description ?? '';

    $overviewPlainText = trim((string) ($service->overview ?? ''));

    $includeItems  = $service->details;
    $solutionItems = $service->solutions;

    $sidebarServices = $otherServices;
@endphp

{{-- ==============================
     BREADCRUMB
============================== --}}
<nav class="service-breadcrumb">
    <div class="page-align-container" style="padding: 0 24px;">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">›</span>
            <a href="{{ route('services') }}">Services</a>
            <span class="sep">›</span>
            <span class="active">{{ $heroTitle }}</span>
        </div>
    </div>
</nav>

{{-- ==============================
     HERO
============================== --}}
<section class="service-hero">

    <div class="hero-bg">
        <img src="{{ $heroImage }}" alt="{{ $heroTitle }}">
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-container">
        <div class="hero-content">
            <h1>
                {{ Str::before($heroTitle, $heroDesignWord) }}
                @if(Str::contains($heroTitle, $heroDesignWord))
                    <span>{{ $heroDesignWord }}</span>{{ Str::after($heroTitle, $heroDesignWord) }}
                @else
                    <span>{{ $heroDesignWord }}</span>
                @endif
            </h1>
            <div class="hero-content-text">{!! $heroDescription !!}</div>
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
                    <div class="editor-content">{!! nl2br(e($overviewPlainText)) !!}</div>
                </div>

                {{-- SERVICES INCLUDE --}}
                <div class="service-box">
                    <h3>Our Services Include</h3>

                    <div class="include-list">
                        @foreach($includeItems as $item)
                        <div class="include-item">
                            <span class="check-icon">
                                @if(is_object($item) && method_exists($item, 'iconUrl') && $item->iconUrl())
                                    <img src="{{ $item->iconUrl() }}" alt="icon" style="width: 12px; height: 12px; object-fit: contain;">
                                @else
                                    <svg viewBox="0 0 12 12">
                                        <polyline points="2,6 5,9 10,3"/>
                                    </svg>
                                @endif
                            </span>
                            {{ is_object($item) ? strip_tags((string) $item->text) : strip_tags((string) $item) }}
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- PRODUCTS --}}
                <div class="service-box">
                    <h3>Products & Solutions</h3>
                    <p class="product-sub">
                        {{ $service->sub_heading ?? '' }}
                    </p>

                    <div class="row g-3">
                        @foreach($solutionItems as $index => $product)
                        <div class="col-12 col-sm-6">
                            <div class="product-card">
                                <span class="prod-num">Product {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h4>{{ is_object($product) ? $product->heading : $product['heading'] }}</h4>
                                <span class="prod-tag">{{ is_object($product) ? ($product->sub_heading ?? 'PRODUCT') : ($product['sub_heading'] ?? 'PRODUCT') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>{{-- end left --}}

            {{-- ===== RIGHT SIDEBAR ===== --}}
<div class="col-12 col-lg-4">
    <div class="sidebar-sticky-wrapper">

        {{-- NEED THIS SERVICE --}}
        <div class="sidebar-cta">
            <h4>Need this service?</h4>
            <p>Get in touch and our team will walk you through our solutions.</p>
            <a href="{{ route('contact') }}" class="btn-expert">Talk to Our Experts</a>
        </div>

        {{-- OTHER SERVICES --}}
        <div class="sidebar-box">
            <h4>Other Services</h4>

                    @forelse($sidebarServices as $svc)
                    <a href="{{ route('serviceDetails', ['id' => $svc->id]) }}" class="other-item">
                        <span class="item-left">
                            <span>{{ $svc->section ?: $svc->service_name }}</span>
                        </span>
                        <span class="arrow-right">›</span>
                    </a>
                    @empty
                    <p class="mb-0 text-muted">No services found.</p>
                    @endforelse

                </div>{{-- end sidebar-box --}}

            </div>{{-- end right --}}

        </div>{{-- end row --}}
    </div>
</section>

@include('frontend.layout.cta')

@endsection