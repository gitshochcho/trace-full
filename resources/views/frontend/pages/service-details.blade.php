@extends('frontend.layout.app')

@push('custome-css')
<style>
/* =========================================
   HERO
========================================= */
.service-hero {
    position: relative;
    min-height: 420px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.hero-bg { position: absolute; inset: 0; z-index: 0; }
.hero-bg img { width: 100%; height: 100%; object-fit: cover; object-position: center center; }
.hero-overlay {
    position: absolute; inset: 0; z-index: 1;
    background: linear-gradient(
        90deg,
        rgba(0,20,40,0.95) 0%,
        rgba(0,25,48,0.82) 40%,
        rgba(0,15,35,0.45) 70%,
        rgba(0,10,25,0.20) 100%
    );
}

/* Title + subtitle area */
.hero-container {
    position: relative; z-index: 2;
    width: 100%; max-width: 1072px; margin: 0 auto;
    padding: 52px 24px 40px;
    flex: 1;
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
}
.hero-content { max-width: 520px; text-align: left; }

.hero-content h1 {
    font-size: 56px; font-weight: 900; color: #fff;
    line-height: 1.0; margin-bottom: 0;
    text-transform: uppercase; letter-spacing: -1px;
}
.hero-content h1 span { color: #22c1c3; }

/* Teal horizontal line under h1 */
.hero-title-line {
    width: 120px; height: 3px;
    background: #22c1c3;
    margin: 14px 0 16px;
}

.hero-subtitle-wrap { margin: 0; }
.hero-content-text { margin: 0; }
.hero-content-text p {
    font-size: 13px; color: #c8dce8;
    line-height: 1.65; margin-bottom: 2px;
}
.hero-content-text p:first-child { font-weight: 600; color: #ddeaf3; font-style: normal; }
.hero-content-text p:last-child  { font-style: italic; margin-bottom: 0; }

/* Pillars strip — bottom of hero */
.hero-pillars {
    position: relative; z-index: 2;
    background: transparent;
    padding: 0 0 36px;
}
.hero-pillars-inner {
    max-width: 1072px; margin: 0 auto; padding: 0 24px;
    display: flex; flex-wrap: nowrap; justify-content: flex-start;
}
.pillar-item {
    display: flex; flex-direction: column; align-items: center; text-align: center;
    flex: 0 1 220px;
    gap: 10px;
    padding: 0 14px;
    border-right: 1px solid rgba(255,255,255,0.18);
}
.pillar-item:not(:first-child) { padding-left: 14px; }
.pillar-item:last-child { border-right: none; }
.pillar-desc { max-width: 165px; margin: 0 auto; }

.pillar-icon {
    width: 52px; height: 52px; flex-shrink: 0;
    border: 1.5px solid rgba(255,255,255,0.50);
    border-radius: 50%;
    background: transparent;
    display: flex; align-items: center; justify-content: center;
}
.pillar-icon img { width: 30px; height: 30px; object-fit: contain; filter: brightness(0) invert(1); }
.pillar-icon svg { width: 24px; height: 24px; stroke: #fff; fill: none; stroke-width: 1.8; }

.pillar-text-wrap { display: flex; flex-direction: column; gap: 4px; }
.pillar-title {
    font-size: 12px; font-weight: 800; color: #fff;
    text-transform: uppercase; letter-spacing: 0.6px; line-height: 1.3;
}
.pillar-desc {
    font-size: 12px; color: #a9c2d0; line-height: 1.5;
}

/* =========================================
   BREADCRUMB
========================================= */
.service-breadcrumb {
    background: #F8F9FB; min-height: 43px;
    display: flex; align-items: center;
    border-bottom: 1px solid #E5E9ED; width: 100%;
}
.service-breadcrumb .breadcrumb-links { font-size: 13px; color: #64748B; }
.service-breadcrumb .breadcrumb-links a { color: #64748B; text-decoration: none; }
.service-breadcrumb .breadcrumb-links .sep { margin: 0 10px; color: #CBD5E1; }
.service-breadcrumb .breadcrumb-links .active { color: #01354B; font-weight: 600; }

/* =========================================
   OVERVIEW + SERVICES (two-col)
========================================= */
.overview-section {
    background: #fff;
    padding: 48px 0 36px;
}
.overview-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    align-items: stretch;
}
.overview-grid > div:first-child {
    padding-right: 56px;
    border-right: 2px solid #E4EAF0;
}
.overview-grid > div:last-child {
    padding-left: 56px;
}
.section-title {
    font-family: 'Manrope', sans-serif;
    font-size: 20px; font-weight: 800;
    color: #003054; text-transform: uppercase;
    letter-spacing: 0.88px; margin-bottom: 12px; line-height: 1;
}
.section-divider {
    width: 13%; height: 3px;
    background: #18909C; margin-bottom: 24px;
}
.overview-text {
    font-size: 15px; color: #4B5563; line-height: 1.82; text-align: justify;
}
.overview-text p { margin-bottom: 20px; }
.overview-text p:last-child { margin-bottom: 0; }
.overview-text ul, .overview-text ol { margin-left: 20px; margin-bottom: 16px; }
.overview-text li { margin-bottom: 6px; }

/* Include list */
.include-list { display: flex; flex-direction: column; }
.include-item {
    display: flex; align-items: center; gap: 14px;
    padding-bottom: 13px; border-bottom: 1px solid #E4EAF0;
    margin-bottom: 0;
}
.include-item:not(:first-child) { padding-top: 13px; }
.include-item:last-child { border-bottom: none; padding-bottom: 0; }
.include-icon {
    width: 36px; height: 36px; border-radius: 50%;
    background: #003054;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; overflow: hidden;
}
.include-icon img {
    width: 22px; height: 22px; object-fit: contain;
    filter: brightness(0) invert(1);
}
.include-icon svg {
    width: 14px; height: 14px;
    stroke: #fff; fill: none; stroke-width: 2;
}
.include-text {
    font-size: 15px; color: #4B5563; line-height: 1.53;
}

/* =========================================
   PRODUCTS & SOLUTIONS
========================================= */
.products-section {
    background: #fff;
    border-top: 1px solid #E4EAF0;
    padding: 36px 0 56px;
}
.products-header {
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 52px;
}
.products-header .line { flex: 1; height: 2px; background: #18909C; }
.products-header h2 {
    font-family: 'Manrope', sans-serif;
    font-size: 20px; font-weight: 800;
    color: #003054; text-transform: uppercase;
    letter-spacing: 0.88px; white-space: nowrap; line-height: 1;
}
.products-grid {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0;
}
.prod-card {
    flex: 1 1 0;
    min-width: 120px;
    max-width: 180px;
    display: flex; flex-direction: column;
    align-items: center; text-align: center; gap: 11px;
    padding: 0 16px 14px;
    border-right: 2px solid #E4EAF0;
}
.prod-card:last-child {
    border-right: none;
}
.prod-icon-box {
    width: 62px; height: 62px; border-radius: 14px;
    background: transparent; border: 1.5px solid #003054;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; overflow: hidden;
    transition: border-color 0.3s ease;
}
/* .prod-card:hover .prod-icon-box {
    border-color: #F47735;
} */
.prod-icon-box img {
    width: 42px; height: 42px; object-fit: contain;
}
.prod-icon-box svg {
    width: 26px; height: 26px;
    stroke: #fff; fill: none; stroke-width: 1.6;
}
.prod-card h4 {
    font-family: 'Manrope', sans-serif;
    font-size: 11.5px; font-weight: 800;
    color: #003054; text-transform: uppercase;
    letter-spacing: 0.46px; line-height: 1.3;
    margin: 0;
}
.prod-card p {
    font-size: 12px; color: #6B7280;
    line-height: 1.55; margin: 0;
}

/* =========================================
   SIDEBAR (CTA — kept for future use via include)
========================================= */
.page-align-container { max-width: 1072px; margin: 0 auto; }

/* =========================================
   RESPONSIVE
========================================= */
@media (max-width: 1100px) {
    .products-grid { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 992px) {
    .service-hero { min-height: 320px; }
    .hero-content h1 { font-size: 36px; }
    .overview-grid { grid-template-columns: 1fr; gap: 0; }
    .overview-grid > div:first-child { padding-right: 0; border-right: none; border-bottom: 1px solid #E4EAF0; padding-bottom: 36px; margin-bottom: 36px; }
    .overview-grid > div:last-child { padding-left: 0; }
    .prod-card { min-width: 30%; max-width: 33%; }
    .prod-card:nth-child(3n) { border-right: none; }
    .prod-card { padding-bottom: 20px; margin-bottom: 8px; }
}
@media (max-width: 768px) {
    .hero-container { padding-top: 36px; padding-bottom: 24px; }
    .hero-content h1 { font-size: 32px; }
    .hero-pillars-inner { flex-wrap: wrap; }
    .pillar-item { flex: 1 1 45%; border-right: none; border-bottom: 1px solid rgba(255,255,255,0.18); padding: 16px 12px; }
    .pillar-item:nth-child(odd) { border-right: 1px solid rgba(255,255,255,0.18); }
    .pillar-item:last-child { border-bottom: none; }
    .overview-section { padding: 36px 0 44px; }
    .prod-card { min-width: 45%; max-width: 50%; }
    .prod-card:nth-child(2n) { border-right: none; }
}
@media (max-width: 576px) {
    .hero-content h1 { font-size: 26px; }
    .hero-overlay {
    position: absolute; inset: 0; z-index: 1;
    background: linear-gradient(
        90deg,
        rgba(0,20,40,0.95) 0%,
        rgba(0,25,48,0.82) 40%,
        rgba(0,15,35,0.45) 70%,
        rgba(0,10,25,0.20) 100%
    );
}
    .prod-card { min-width: 45%; max-width: 50%; }
}
.custom-container {
    max-width: 1072px !important; margin: 0 auto;
    padding-left: 15px; padding-right: 15px;
}
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

    /* Hero pillars from dedicated admin input; all details → services list */
    $heroPillars  = $service->heroPillars;
    $servicesList = $includeItems;

    $defaultPillarIcons = [
        '<svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>',
        '<svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        '<svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
        '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
    ];

    $defaultProdIcon = '<svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>';
@endphp

{{-- BREADCRUMB --}}
<nav class="service-breadcrumb">
    <div class="container custom-container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">›</span>
            <a href="{{ route('services') }}">Services</a>
            <span class="sep">›</span>
            <span class="active">{{ $heroTitle }}</span>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="service-hero">
    <div class="hero-bg">
        <img src="{{ $heroImage }}" alt="{{ $heroTitle }}">
    </div>
    <div class="hero-overlay"></div>

    <div class="hero-container">
        <div class="hero-content">
            <h1>
                {{ Str::before($heroTitle, $heroDesignWord) }}
                @if($heroDesignWord && Str::contains($heroTitle, $heroDesignWord))
                    <span>{{ $heroDesignWord }}</span>{{ Str::after($heroTitle, $heroDesignWord) }}
                @elseif($heroDesignWord)
                    <span>{{ $heroDesignWord }}</span>
                @endif
            </h1>
            <div class="hero-title-line"></div>
            @if($heroDescription)
            <div class="hero-subtitle-wrap">
                <div class="hero-content-text">{!! $heroDescription !!}</div>
            </div>
            @endif
        </div>
    </div>

    @if($heroPillars->count())
    <div class="hero-pillars">
        <div class="hero-pillars-inner">
            @foreach($heroPillars as $i => $pillar)
            @php
                $pTitle   = strtoupper(trim($pillar->title));
                $pDesc    = trim($pillar->description ?? '');
                $pIconSrc = $pillar->iconUrl();
            @endphp
            <div class="pillar-item">
                <div class="pillar-icon">
                    @if($pIconSrc)
                        <img src="{{ $pIconSrc }}" alt="{{ $pTitle }}">
                    @else
                        {!! $defaultPillarIcons[$i % 4] !!}
                    @endif
                </div>
                <div class="pillar-text-wrap">
                    <div class="pillar-title">{{ $pTitle }}</div>
                    @if($pDesc)<div class="pillar-desc">{{ $pDesc }}</div>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>

{{-- OVERVIEW + SERVICES INCLUDE --}}
<section class="overview-section">
    <div class="container custom-container">
        <div class="overview-grid">

            {{-- Overview --}}
            <div>
                <h3 class="section-title">Overview</h3>
                <div class="section-divider"></div>
                <div class="overview-text">
                    <!-- @foreach(array_filter(explode("\n", $overviewPlainText)) as $para)
                        <p>{{ trim($para) }}</p>
                    @endforeach -->

                     @foreach(array_filter(explode("\n", $overviewPlainText)) as $para)
                            <p>{{ trim(html_entity_decode($para)) }}</p>
                     @endforeach
                </div>
            </div>


            {{-- Our Services Include --}}
            <div>
                <h3 class="section-title">Our Services Include</h3>
                <div class="section-divider"></div>
                <div class="include-list">
                    @foreach($servicesList as $item)
                    @php
                        $itemText = trim(html_entity_decode(is_object($item) ? strip_tags((string) $item->text) : strip_tags((string) $item)));
                        $itemIcon = is_object($item) && method_exists($item, 'iconUrl') ? $item->iconUrl() : null;
                    @endphp
                    <div class="include-item">
                        <div class="include-icon">
                            @if($itemIcon)
                                <img src="{{ $itemIcon }}" alt="icon">
                            @endif
                        </div>
                        <p class="include-text">{{ $itemText }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- PRODUCTS & SOLUTIONS --}}
@if($solutionItems->count())
<section class="products-section">
    <div class="container custom-container">

        <div class="products-header">
            <div class="line"></div>
            <h2>Products &amp; Solutions</h2>
            <div class="line"></div>
        </div>

        <div class="products-grid">
            @foreach($solutionItems as $product)
            @php
                $pHeading = is_object($product) ? $product->heading : $product['heading'];
                $pSub     = is_object($product) ? ($product->sub_heading ?? '') : ($product['sub_heading'] ?? '');
                $pIcon    = is_object($product) && method_exists($product, 'iconUrl') ? $product->iconUrl() : null;
            @endphp
            <div class="prod-card">
                <div class="prod-icon-box">
                    @if($pIcon)
                        <img src="{{ $pIcon }}" alt="{{ $pHeading }}">
                    @else
                        {!! $defaultProdIcon !!}
                    @endif
                </div>
                <h4>{{ $pHeading }}</h4>
                @if($pSub)
                <p>{{ $pSub }}</p>
                @endif
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif

@include('frontend.layout.cta')

@endsection
