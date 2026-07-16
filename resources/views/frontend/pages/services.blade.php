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

/* CKEditor content in services hero */
.services-hero .editor-content,
.services-hero .editor-content p {
    font-size: 15px;
    color: #94a3b8;
    line-height: 1.7;
    margin: 0 0 14px 0;
    text-align: justify;
}

.services-hero .editor-content p:last-child {
    margin-bottom: 0;
}

.services-hero .editor-content ul,
.services-hero .editor-content ol {
    margin: 0 0 14px 20px;
    color: #94a3b8;
}

.services-hero .editor-content li {
    margin-bottom: 6px;
    line-height: 1.7;
    color: #94a3b8;
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
    font-size: 15px;
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
    text-align: justify;
}

/* CARD FOOTER */
.card-footer-bar {
    padding: 14px 22px;
    border-top: 1px solid #F1F4F7;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    margin-top: auto;
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
@php
    use Illuminate\Support\Str;

    $servicesHeroTag         = $servicesHero?->section     ?? '';
    $servicesHeroTitle       = $servicesHero?->heading     ?? '';
    $servicesHeroTitleWord   = $servicesHero?->design_word ?? '';
    $servicesHeroDescription = $servicesHero?->description ?? '';

    if (empty($serviceCards)) {
        $serviceCards = collect();
    }
@endphp

<nav class="service-breadcrumb">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}">Home</a>
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
            <span class="top-label">{{ $servicesHeroTag }}</span>
        </div>

        <h2 class="services-title">
            {{ Str::before($servicesHeroTitle, $servicesHeroTitleWord) }}
            @if(Str::contains($servicesHeroTitle, $servicesHeroTitleWord))
                <span class="teal-text">{{ $servicesHeroTitleWord }}</span>{{ Str::after($servicesHeroTitle, $servicesHeroTitleWord) }}
            @else
                <span class="teal-text"></span>
            @endif
        </h2>

        <div class="editor-content">
            {!! $servicesHeroDescription !!}
        </div>

    </div>
</section>

{{-- ==============================
     SERVICE CARDS
============================== --}}
<section class="services-cards-section">
    <div class="container-fluid px-lg-5 page-align-container">

        <div class="row g-4">
            @foreach($serviceCards as $service)
            <div class="col-12 col-sm-6 col-lg-4">
                 <a href="{{ route('serviceDetails', ['id' => $service['id']]) }}">
                <div class="service-card">

                   
                    <img
                        src="{{ $service['img'] }}"
                        alt="{{ $service['tag'] }}"
                        class="card-img">
                  

                    <div class="card-content">
                        <span class="card-tag">{{ $service['tag'] }}</span>
                        <div class="card-line"></div>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{!! $service['desc'] !!}</p>
                    </div>

                     <div class="card-footer-bar">
        <span class="products-count">
            <span class="dot"></span>
            {{ $service['products'] }}
        </span>

        <a href="{{ route('serviceDetails', ['id' => $service['id']]) }}">
            View Service →
        </a>
    </div>

                </div>
                </a>
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