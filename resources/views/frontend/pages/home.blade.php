@extends('frontend.layout.app')

@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
@php
    $firstSlideForPreload = $sliderItems->first() ?? null;
    $firstSlideImgPreload = $firstSlideForPreload && method_exists($firstSlideForPreload, 'imageUrl')
        ? $firstSlideForPreload->imageUrl()
        : ($slider?->imageUrls()[0] ?? null);
@endphp
@if($firstSlideImgPreload)
<link rel="preload" as="image" href="{{ $firstSlideImgPreload }}" fetchpriority="high">
@endif

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
    height: 70vh; 
    display: flex;
    align-items: center;        
    min-height: 480px;
    max-height: 900px;    
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

/* HERO VIDEO BG */
.hero-video-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}
.hero-video-bg video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    pointer-events: none;
}
.hero-video-bg video::-webkit-media-controls { display: none !important; }
.hero-video-bg video::-webkit-media-controls-enclosure { display: none !important; }

/* SLIDER (shown only when no video) */
.slides {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.slide {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    z-index: 0;
    transition: opacity 1.2s ease;
}

.slide.active {
    opacity: 1;
    z-index: 1;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transform: scale(1.04);
    transition: transform 6s ease;
}

.slide.active img {
    transform: scale(1);
}

/* TEXT TRANSITIONS */
#heroTagline,
#heroTitle,
#heroDesc,
.hero-btns,
.slider-line {
    transition: opacity 0.45s ease, transform 0.45s ease;
}

.hero-text-fading #heroTagline,
.hero-text-fading #heroTitle,
.hero-text-fading #heroDesc,
.hero-text-fading .hero-btns {
    opacity: 0;
    transform: translateY(14px);
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

/* .hero-tag-box {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 20px;
} */
/* .hero-tag-box .tag-line { width: 40px; height: 2px; background: #F47735; display: inline-block; } */
.hero-tag {
    color: #F47735;
    font-size: clamp(10px, 0.9vw, 13px);
    letter-spacing: 2px;
}

.hero-tag-box {
    margin-bottom: clamp(10px, 1.8vh, 22px);
}

.hero-content h1 {
 font-size: clamp(35px, 6vw, 65px) !important; 
    line-height: 1.2;
    color: white;
    margin-bottom: clamp(10px, 1.5vh, 24px);
}
.hero-content h1 span { color: #22c1c3; }

.hero-content .hero-desc {
    max-width: 750px;
    font-size: clamp(26px, 1.5vw, 20px) !important;
    line-height: 1.6;
    color: #e2e8f0;
    margin: 0 auto clamp(12px, 2vh, 28px);
}

.hero-content .hero-desc p {
    margin: 0;
    color: inherit;
    font-size: clamp(16px, 1.5vw, 20px) !important; 
    line-height: inherit;
}

.hero-content .hero-desc p + p {
    margin-top: 10px;
}

.hero-content .hero-desc ul,
.hero-content .hero-desc ol {
    margin: 10px 0 0;
    padding-left: 20px;
}

.hero-content .hero-desc li {
    margin-bottom: 6px;
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

.btn-hero-primary,
.btn-hero-secondary {
    padding: clamp(9px, 1vh, 13px) clamp(14px, 1.5vw, 24px);
    font-size: clamp(12px, 1vw, 15px);
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
   .hero { height: 55vw; min-height: 300px; } 
    .slide img { height: 100%; }
    .hero::after { background: linear-gradient(180deg, rgba(0,0,0,.10) 0%, rgba(0,0,0,.20) 50%, rgba(0,0,0,.45) 100%); }
    .hero-content { top: 52%; }
    .hero-content h1 { font-size: 24px; line-height: 1.3; }
    .hero-tag { font-size: 20px; letter-spacing: 1px; }
    /* .hero-tag-box .tag-line { width: 20px; } */
    .hero-desc, .hero-btns, .slider-line { display: none !important; }
}

@media (max-width: 992px) {
    .hero-content h1 { font-size: 42px; }
    .hero-desc { font-size: 14px; }
}

@media (max-width: 300) {
    .hero-content h1 { font-size: 22px; }
    
}


/* tablet */
@media (min-width: 577px) and (max-width: 992px) {
    .hero { height: 65vh; }
}
.container {
    max-width: 1072px !important; /* সব সেকশনের জন্য কার্যকর */
    margin: 0 auto;
    padding-left: 15px;
    padding-right: 15px;
}
    /* Tag with Orange Line */
    
    .about-tag {
        color: #01888C;
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
        text-align: justify;
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
        text-align: justify;
    }

    /* Learn Button */
    .learn-btn {
        color: #1a2332;
        font-weight: 700;
        font-size: 16px;
        gap: 10px;
        margin-top: -4px;
        transition: 0.3s;
    }
    .learn-btn:hover {
        color: #e85d26;
        transform: translateX(5px);
    }
    .learn-btn-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #1a2332;
        font-size: 16px;
        transition: 0.3s;
        flex-shrink: 0;
    }
    .learn-btn:hover .learn-btn-arrow {
        background: #e85d26;
        color: #fff;
    }

    /* About Section Animations */
    .anim-fade-up {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }
    .anim-fade-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .anim-fade-right {
        opacity: 0;
        transform: translateX(50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .anim-visible {
        opacity: 1 !important;
        transform: none !important;
    }
    .anim-delay-1 { transition-delay: 0.1s; }
    .anim-delay-2 { transition-delay: 0.2s; }
    .anim-delay-3 { transition-delay: 0.35s; }
    .anim-delay-4 { transition-delay: 0.5s; }
    .anim-delay-5 { transition-delay: 0.65s; }
    @media (prefers-reduced-motion: reduce) {
        .anim-fade-up, .anim-fade-left, .anim-fade-right { opacity: 1; transform: none; }
    }

    /* Image Badge */
    /* .about-badge {
        position: absolute;
        bottom: 30px;
        left: -20px;
        background-color: #004051; 
        color: #fff;
        padding: 15px 25px;
        border-radius: 12px;
        text-align: center;
    } */

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
        background-color: #01888C;
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
    .section-desc { color: #64748b; font-size: 14px; text-align: justify; }

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

   .service-card {
    background: #fff;
    border: none;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    /* Extra logic to make cards equal height */
    display: flex;
    flex-direction: column;
    height: 100%;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
}

.card-img-wrapper {
    height: 220px;
    overflow: hidden;
}

.card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.service-card:hover .card-img-wrapper img {
    transform: scale(1.08); 
}

/* Updated Card Body */
.card-body {
    padding: 1.5rem; /* p-4 bootstrap standard */
    display: flex;
    flex-direction: column;
    flex-grow: 1; /* Eta empty space consume korbe */
}

.card-cat {
    font-size: 15px;
    font-weight: 700;
    color: #6c757d; 
    letter-spacing: 0.8px;
    text-transform: uppercase;
    transition: color 0.3s ease;
}

.service-card:hover .card-cat {
    color: #00898e; 
}

.card-title {
    color: #1a2332;
    line-height: 1.4;
    min-height: 50px;
}

.animated-line {
    height: 2px;
    width: 100%;
    background: #e9ecef; 
    position: relative;
    overflow: hidden;
}

.animated-line::after {
    content: '';
    position: absolute;
    left: -100%; 
    top: 0;
    width: 100%;
    height: 100%;
    background: #00898e; 
    transition: left 0.5s ease;
}

.service-card:hover .animated-line::after {
    left: 0; 
}

/* Updated Card Text */
.card-text {
    font-size: 14px;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    /* Pushes everything below it to the bottom */
    flex-grow: 1; 
    margin-bottom: 1.5rem !important; 
}

.read-more-btn {
    color: #1a2332; 
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    /* Fixed alignment */
    margin-top: auto; 
    width: fit-content;
}

.service-card:hover .read-more-btn {
    color: #00898e; 
    transform: translateX(5px); 
}

    @media (max-width: 768px) {
        .section-title { font-size: 28px; }
        .card-img-wrapper { height: 180px; }
    }

    .projects-section .container,
.services-section .container,
.about-section .container {
    max-width: 1072px !important;
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

    
    .project-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        transition: box-shadow 0.3s, transform 0.3s;
    }
    .project-card:hover {
        box-shadow: 0 6px 28px rgba(0,0,0,0.14);
        transform: translateY(-3px);
    }
    .proj-img-box {
        position: relative;
        height: 200px;
        background: #f1f4f7;
        overflow: hidden;
    }
    .proj-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .project-card:hover .proj-img-box img {
        transform: scale(1.05);
    }

    /* Badge on image top-left */
    .proj-badge-box {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #e85d26;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 100px;
        display: inline-block;
        z-index: 2;
    }

    /* Content below image */
    .proj-content {
        padding: 16px 18px 18px;
    }

    .proj-title {
        font-size: 15px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 6px;
        color: #01354B;
    }

    .proj-sub {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 0;
    }

    /* Mobile Responsive */
    @media (max-width: 576px) {
        .proj-img-box { height: 180px; }
        .section-title { font-size: 28px; }
    }

    /* PARTNERS SLIDER */
    .partners-section {
        background: #fff;
    }
    .partners-title {
        color: #64748b;
        font-size: 20px;
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
        height: 80px;
        max-width: 120px;
        object-fit: contain;
        /* filter: grayscale(100%); */
        /* opacity: .75; */
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

    /* =========================================
       LATEST NEWS & FEATURES SECTION
    ========================================= */
    .news-grid {
        display: grid;
        grid-template-columns: 516px 1fr 1fr;
        column-gap: 20px;
        row-gap: 16px;
    }
    .news-card-link {
        text-decoration: none;
        color: inherit;
    }
    .news-grid > .news-card-link:first-child {
        grid-row: span 2;
        display: flex;
        flex-direction: column;
    }
    .news-big-card {
        flex: 1;
        width: 100%;
        height: 100%;
        background: #fff;
        border: 1px solid #E3E8EB;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0px 10px 36px 0px #01354B1A;
        transition: box-shadow 0.3s, transform 0.3s, border-color 0.3s;
    }
    .news-big-card .news-card-img-box img { height: 260px; object-fit: cover; transition: transform 0.5s ease; }
    .news-small-card {
        width: 100%;
        height: 100%;
        background: #fff;
        border: 1px solid #E3E8EB;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.3s, transform 0.3s, border-color 0.3s;
    }
    .news-card-link:hover .news-big-card,
    .news-card-link:hover .news-small-card {
        box-shadow: 0 10px 28px rgba(1, 53, 75, 0.16);
        transform: translateY(-4px);
        border-color: #4CC3C3;
    }
    .news-card-link:hover .news-card-img-box img {
        transform: scale(1.05);
    }
    .news-card-link:hover .news-footer-link {
        color: #01354B;
    }
    .news-small-img img { height: 120px; object-fit: cover; transition: transform 0.5s ease; }
    .news-card-img-box { position: relative; background: #f1f4f7; overflow: hidden; }
    .news-card-img-box img { width: 100%; display: block; }
    .news-card-img-box.no-image { display: flex; align-items: center; justify-content: center; min-height: 120px; }
    .news-card-img-box.no-image i { font-size: 32px; color: #cbd5e1; }
    .news-img-overlay-gradient {
        position: absolute;
        inset: 0;
        /* background: linear-gradient(142.06deg, rgba(1, 53, 75, 0.6) 0%, rgba(1, 136, 140, 0.3) 100%); */
    }
    .news-badge-custom {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: #F47735;
        color: #fff;
        font-size: 10px;
        padding: 3px 10px;
        border-radius: 100px;
    }
    .news-card-body { padding: 24px; flex-grow: 1; }
    .news-card-body-small { padding: 18px 20px 12px; flex: 1; }
    .news-card-h { font-size: 18px; font-weight: 600; color: #01354B; line-height: 1.4; }
    .news-card-h-small { font-size: 14px; font-weight: 700; color: #01354B; line-height: 1.4; margin-bottom: 0; }
    .news-card-p {
        font-size: 13px;
        color: #64748B;
        margin-top: 12px;
        line-height: 1.6;
        text-align: justify;
    }
    .news-small-card .news-card-p {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-card-footer { padding: 15px 24px; border-top: 1px solid #F1F5F9; display: flex; justify-content: space-between; }
    .news-card-footer-small { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-top: 1px solid #F1F5F9; }
    .news-meta-text { font-size: 11px; color: #94A3B8; }
    .news-footer-link { font-size: 12px; color: #01888C; font-weight: 700; text-decoration: none; transition: color 0.3s; }
    .news-all-box-link {
        background: #F1F5F9;
        border: 1px solid #E3E8EB;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        transition: 0.3s;
        min-height: 120px;
    }
    .news-all-box-link:hover { background: #E6F7F8; }
    .news-all-text { color: #01888C; font-size: 11px; text-transform: uppercase; font-weight: 700; }
    .news-all-link-text { color: #01888C; font-size: 20px; font-weight: 800; margin: 2px 0; }
    .news-arrow-icon { color: #01354B; font-size: 24px; }
    @media (max-width: 900px) {
        .news-grid { grid-template-columns: 1fr 1fr; }
        .news-grid > .news-card-link:first-child { grid-column: span 2; grid-row: auto; }
        .news-big-card { height: auto; }
    }
    @media (max-width: 600px) {
        .news-grid { grid-template-columns: 1fr; }
        .news-grid > .news-card-link:first-child { grid-column: auto; }
    }

</style>
@endpush

@section('content')
@php
    use Illuminate\Support\Str;

    $heroSlides = $sliderItems ?? collect();

   // Fallback to old slider if no new items
if ($heroSlides->isEmpty() && isset($slider)) {
    $heroSlides = collect([
        (object)[
            'tagline'     => $slider?->tagline     ?? '',
            'title'       => $slider?->title       ?? '',
            'design_word' => $slider?->design_word ?? '',
            'description' => $slider?->description ?? '',
            '_image_url'  => $slider?->imageUrls()[0] ?? null,  
        ]
    ]);
}

    $firstSlide      = $heroSlides->first();
    $heroDesignWord  = $firstSlide?->design_word ?? '';
    $heroTitle       = $firstSlide?->title       ?? '';
    $hasDesignWord   = filled($heroDesignWord) && Str::contains($heroTitle, $heroDesignWord);
    $heroTitleBefore = $hasDesignWord ? Str::before($heroTitle, $heroDesignWord) : $heroTitle;
    $heroTitleAfter  = $hasDesignWord ? Str::after($heroTitle, $heroDesignWord)  : '';

    // First slide with an uploaded video becomes the hero video background
    $heroVideoUrl = '';
    foreach ($heroSlides as $slide) {
        if (method_exists($slide, 'videoUrl') && $slide->videoUrl()) {
            $heroVideoUrl = $slide->videoUrl();
            break;
        }
    }

    // Main about block
    $aTag        = $homeAboutTrace?->section     ?? '';
    $aHeading    = $homeAboutTrace?->heading     ?? '';
    $aDesignWord = $homeAboutTrace?->design_word ?? '';
    $aDesc       = $homeAboutTrace?->description ?? '';
    $aImage      = $homeAboutTrace?->imageUrl()  ?? '';

    // Three list items
    $items = [];
    if ($homeAboutTraceOne?->heading || $homeAboutTraceOne?->description) {
        $items[] = ['num' => '01', 'title' => $homeAboutTraceOne?->heading ?? '', 'text' => $homeAboutTraceOne?->description ?? ''];
    }
    if ($homeAboutTraceTwo?->heading || $homeAboutTraceTwo?->description) {
        $items[] = ['num' => '02', 'title' => $homeAboutTraceTwo?->heading ?? '', 'text' => $homeAboutTraceTwo?->description ?? ''];
    }
    if ($homeAboutTraceThree?->heading || $homeAboutTraceThree?->description) {
        $items[] = ['num' => '03', 'title' => $homeAboutTraceThree?->heading ?? '', 'text' => $homeAboutTraceThree?->description ?? ''];
    }

    // Badge
    $badgeNum  = $homeYearsExpertise?->heading     ?? '';
    $badgeText = $homeYearsExpertise?->description ?? '';
@endphp

<section class="hero">

    @if($heroVideoUrl)
    {{-- VIDEO BACKGROUND --}}
    @php $videoPoster = method_exists($firstSlide, 'imageUrl') ? $firstSlide->imageUrl() : ''; @endphp
    <div class="hero-video-bg">
        <video autoplay loop muted playsinline disablepictureinpicture controlslist="nodownload nofullscreen noremoteplayback" {{ $videoPoster ? 'poster="'.$videoPoster.'"' : '' }}>
            <source src="{{ $heroVideoUrl }}" type="video/mp4">
        </video>
    </div>
    @else
    {{-- SLIDES (fallback when no video) --}}
        <div class="slides">
            @foreach($heroSlides as $index => $slide)
                <div class="slide {{ $index === 0 ? 'active' : '' }}">
                    @php
                        $slideImg = method_exists($slide, 'imageUrl') ? $slide->imageUrl() : ($slide->_image_url ?? '');
                    @endphp
                    @if($index === 0)
                    <img src="{{ $slideImg }}" alt="Hero {{ $index + 1 }}" fetchpriority="high" loading="eager" decoding="sync">
                    @else
                    <img src="{{ $slideImg }}" alt="Hero {{ $index + 1 }}" loading="lazy" decoding="async">
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- CONTENT --}}
    <div class="hero-content">

        {{-- TAG --}}
        <div class="hero-tag-box">
            <span class="tag-line"></span>
            <span class="hero-tag" id="heroTagline">{{ $firstSlide?->tagline ?? '' }}</span>
            <span class="tag-line"></span>
        </div>

        {{-- TITLE --}}
        <h1 id="heroTitle">
            {{ $heroTitleBefore }}
            @if($hasDesignWord)
                <span id="heroDesignWord">{{ $heroDesignWord }}</span>{{ $heroTitleAfter }}
            @endif
        </h1>

        {{-- DESC --}}
        <div class="hero-desc" id="heroDesc">
            {!! $firstSlide?->description ?? '' !!}
        </div>

        {{-- BUTTONS --}}
        <div class="hero-btns">
            <a href="/services" class="btn-hero-primary">Explore Services <span>→</span></a>
            <a href="/projects" class="btn-hero-secondary">View Our Work</a>
        </div>

        {{-- SLIDER INDICATOR --}}
        <div class="slider-line">
            @foreach($heroSlides as $index => $slide)
                <span class="ind {{ $index === 0 ? 'active' : '' }}"></span>
            @endforeach
        </div>

    </div>

</section>

{{-- Slider data for JS text switching --}}
@php
    $heroSliderMapped = $heroSlides->map(fn($s) => [
        'tagline'     => $s->tagline     ?? '',
        'title'       => $s->title       ?? '',
        'design_word' => $s->design_word ?? '',
        'description' => $s->description ?? '',
    ]);
@endphp
<script>
const heroSliderData = @json($heroSliderMapped);
</script>

{{-- ==============================
      ABOUT SECTION
============================== --}}


<section class="about-section py-3 my-lg-2">
    <div class="container" style="max-width: 1072px; margin: 0 auto; padding: 0 15px;">
        <div class="row align-items-center gy-5">
 
            {{-- LEFT CONTENT --}}
            <div class="col-12 col-lg-6 pe-lg-5">
                <div class="about-tag-wrapper mb-3 anim-fade-up">
                    <span class="about-tag">{{ $aTag }}</span>
                </div>

                <h2 class="about-title mb-4 anim-fade-up anim-delay-1">
                    @if($aDesignWord && Str::contains($aHeading, $aDesignWord))
                        {!! nl2br(e(Str::before($aHeading, $aDesignWord))) !!}<span class="text-teal">{{ $aDesignWord }}</span>{!! nl2br(e(Str::after($aHeading, $aDesignWord))) !!}
                    @else
                        {{ $aHeading }}
                    @endif
                </h2>

                <div class="about-desc mb-5 anim-fade-up anim-delay-2">
                    {!! $aDesc !!}
                </div>

                {{-- LIST ITEMS --}}
                <div class="about-list">
                    @foreach($items as $i => $item)
                        <div class="about-item d-flex gap-3 mb-4 anim-fade-up anim-delay-{{ $i + 3 }}">
                            <span class="about-num">{{ $item['num'] }}</span>
                            <div class="about-content">
                                <h4 class="item-title">{{ $item['title'] }}</h4>
                                <div class="item-text">{!! $item['text'] !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="/about" class="learn-btn d-inline-flex align-items-center text-decoration-none anim-fade-up anim-delay-5">
                    <span>Learn About Us</span>
                    <span class="learn-btn-arrow">&rarr;</span>
                </a>
            </div>

            {{-- RIGHT IMAGE --}}
            <div class="col-12 col-lg-6">
                <div class="about-img-wrap position-relative anim-fade-right">
                    <img src="{{ $aImage }}" alt="{{ strip_tags($aHeading) }}" class="img-fluid rounded-4 shadow-sm">
 
                    <!-- <div class="about-badge shadow-lg">
                        <h3 class="m-0 fw-bold">{{ $badgeNum }}</h3>
                        <p class="m-0 small opacity-75">{{ strip_tags($badgeText) }}</p>
                    </div> -->
                </div>
            </div>
 
        </div>
    </div>
</section>

{{-- ==============================
      SERVICES SECTION
============================== --}}
<section class="services-section py-3 bg-light-subtle">
    <div class="container" style="max-width: 1072px; margin: 0 auto; padding: 0 15px;">

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
                        TRACE delivers consultancy, research, and advocacy services to support governments and businesses in advancing policy and regulatory reform.
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

<!-- @foreach($services as $service)
<div class="col-12 col-sm-6 col-lg-4">
    <div class="service-card h-100 shadow-sm">
        <div class="card-img-wrapper">
            <img src="/assets/img/{{ $service['img'] }}" class="card-img-top" alt="{{ $service['tag'] }}">
        </div>
        <div class="card-body p-4">
            <span class="card-cat mb-2 d-inline-block">{{ $service['tag'] }}</span>
            <h3 class="card-title h5 fw-bold mb-2">{{ $service['title'] }}</h3>
            
            <div class="animated-line mb-3"></div>
            
            <p class="card-text text-muted mb-4">{{ $service['desc'] }}</p>
            <a href="#" class="read-more-btn">Read More &rsaquo;</a>
        </div>
    </div>
</div>
@endforeach -->

@forelse($homeServices as $service)
@php
    $imageUrl = $service->imageUrl() ?? '';
    $tag      = $service->section ?? $service->service_name ?? '';
    $title    = $service->service_name ?? '';
    $desc     = strip_tags($service->description ?? '');
@endphp
  
<div class="col-12 col-sm-6 col-lg-4">
        <a href="{{ route('serviceDetails', $service->id) }}" class="text-decoration-none text-dark">
    <div class="service-card h-100 shadow-sm">
        <div class="card-img-wrapper">
            <img src="{{ $imageUrl }}" alt="{{ $tag }}">
        </div>
        <div class="card-body">
            <span class="card-cat d-inline-block mb-2">{{ $tag }}</span>
            <div class="animated-line mb-3"></div>
            <h3 class="card-title-text h5 fw-bold mb-2">{{ $title }}</h3>
            <p class="card-text-desc text-muted" style="text-align: justify;">
                {{ Str::limit($desc, 120) }}
            </p>
            <a href="{{ route('serviceDetails', $service->id) }}" class="read-more-btn">Read More ›</a>
        </div>
    </div>
       </a>
</div>

@empty
{{-- fallback static cards --}}
@endforelse
        </div>
    </div>
</section>

{{-- ==============================
      PROJECTS SECTION
============================== --}}
<section class="projects-section py-4 bg-white">
    <div class="container" style="max-width: 1072px; margin: 0 auto; padding: 0 15px;">

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
                        TRACE has delivered trade facilitation reform, laboratory accreditation, digital systems, and policy advisory projects across South Asia for governments, development banks, and regulatory bodies.
                    </p>
                </div>
                <a href="/projects" class="all-link text-decoration-none">
                    <span class="fw-bold text-dark me-1" style="font-size: 13px;">All Projects</span>
                    <span class="circle-arrow">&rarr;</span>
                </a>
            </div>
        </div>

        {{-- GRID --}}
        <div class="row g-4">
            @forelse($homeProjects as $project)
            @php
                $pImg    = $project->heroImageUrl() ?? '';
                $pSvc    = $project->services->first();
                $pCat    = $pSvc?->section ?: ($pSvc?->service_name ?? '');
                $pClient = abbreviateClientName($project->client) ?? '';
            @endphp
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('projectdetails', $project) }}" class="text-decoration-none">
                    <div class="project-card">
                        <div class="proj-img-box">
                            <img src="{{ $pImg }}" alt="{{ $project->project_title }}">
                            @if($pCat)
                            <div class="proj-badge-box">{{ strtoupper($pCat) }}</div>
                            @endif
                        </div>
                        <div class="proj-content">
                            <h3 class="proj-title">{{ $project->project_title }}</h3>
                            @if($pClient)
                            <p class="proj-sub">{{ $pClient }}</p>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</section>

{{-- ==============================
     LATEST NEWS & FEATURES
============================== --}}
@if($homeLatestNews->isNotEmpty())
@php
    $newsHeading    = $homeLatestNewsHeading?->heading     ?? 'News & Features';
    $newsDesignWord = $homeLatestNewsHeading?->design_word ?? '';
    $newsDesc       = strip_tags($homeLatestNewsHeading?->description ?? '');
    $sourceIconMap  = ['project' => 'fa-folder-open', 'job' => 'fa-briefcase', 'insight' => 'fa-newspaper'];
@endphp
<section class="latest-news-section py-4 bg-light-subtle">
    <div class="container" style="max-width: 1072px; margin: 0 auto; padding: 0 15px;">

        {{-- HEADER --}}
        <div class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="tag-dot"></span>
                <span class="section-tag-pill">LATEST UPDATES</span>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
                <div style="max-width:520px;">
                    <h2 class="section-title mb-2">
                        @if($newsDesignWord && str_contains($newsHeading, $newsDesignWord))
                            {{ \Illuminate\Support\Str::before($newsHeading, $newsDesignWord) }}<span class="text-teal">{{ $newsDesignWord }}</span>{{ \Illuminate\Support\Str::after($newsHeading, $newsDesignWord) }}
                        @else
                            {{ $newsHeading }}
                        @endif
                    </h2>
                    @if($newsDesc)<p class="section-desc mb-0">{{ $newsDesc }}</p>@endif
                </div>
                <a href="{{ route('latestUpdates') }}" class="all-link text-decoration-none">
                    <span class="fw-bold text-dark me-1" style="font-size: 13px;">Show All</span>
                    <span class="circle-arrow">&rarr;</span>
                </a>
            </div>
        </div>

        {{-- GRID --}}
        <div class="news-grid">
            @foreach($homeLatestNews->take(5) as $index => $item)
            @php
                $itemDate  = $item->date instanceof \Carbon\Carbon ? $item->date->format('M d, Y') : ($item->date ? \Carbon\Carbon::parse($item->date)->format('M d, Y') : '');
                $typeIcon  = $sourceIconMap[$item->source] ?? 'fa-newspaper';
                $isFeatured = $index === 0;
            @endphp
            @if($isFeatured)
                <a href="{{ $item->link }}" class="news-card-link" @if($item->is_external) target="_blank" rel="noopener" @endif>
                    <div class="news-card news-big-card">
                        <div class="news-card-img-box {{ !$item->image ? 'no-image' : '' }}">
                            @if($item->image)
                                <img src="{{ $item->image }}" alt="{{ $item->heading }}" loading="lazy">
                                <div class="news-img-overlay-gradient"></div>
                            @else
                                <i class="fas {{ $typeIcon }}"></i>
                            @endif
                            <span class="news-badge-custom">{{ strtoupper($item->badge_label) }}</span>
                        </div>
                        <div class="news-card-body">
                            <h4 class="news-card-h">{{ $item->heading }}</h4>
                            @if($item->description)
                                <p class="news-card-p">{{ $item->description }}</p>
                            @endif
                        </div>
                        <div class="news-card-footer">
                            <span class="news-meta-text">{{ $itemDate }}{{ $itemDate && $item->extra ? ' · ' : '' }}{{ $item->extra }}</span>
                            <span class="news-footer-link">{{ $item->action_label }} &rarr;</span>
                        </div>
                    </div>
                </a>
            @else
                <a href="{{ $item->link }}" class="news-card-link" @if($item->is_external) target="_blank" rel="noopener" @endif>
                    <div class="news-card news-small-card">
                        <div class="news-card-img-box news-small-img {{ !$item->image ? 'no-image' : '' }}">
                            @if($item->image)
                                <img src="{{ $item->image }}" alt="{{ $item->heading }}" loading="lazy">
                                <div class="news-img-overlay-gradient"></div>
                            @else
                                <i class="fas {{ $typeIcon }}"></i>
                            @endif
                            <span class="news-badge-custom" style="background: #01888C;">{{ strtoupper($item->badge_label) }}</span>
                        </div>
                        <div class="news-card-body-small">
                            <h4 class="news-card-h-small">{{ $item->heading }}</h4>
                        </div>
                        <div class="news-card-footer-small">
                            <span class="news-meta-text">{{ $itemDate }}{{ $itemDate && $item->extra ? ' · ' : '' }}{{ $item->extra }}</span>
                            <span class="news-footer-link">{{ $item->action_label }} &rarr;</span>
                        </div>
                    </div>
                </a>
            @endif
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ==============================
     PARTNERS
============================== --}}
<section class="partners-section py-3">
    <div class="container" style="max-width:1200px;">

        <p class="partners-title mb-4 text-center">OUR PARTNERS</p>

        <div class="partner-slider position-relative">
            <div class="partner-logos-wrapper">
                @php
                    // Marquee এর জন্য logos দুইবার render করতে হবে
                    $partnerList = $partners;
                @endphp

                <div class="partner-logos d-flex align-items-center gap-4">
                    {{-- First set --}}
                    @foreach($partnerList as $partner)
                        @php
                            $logoUrl = isset($partner->_fallback)
                                ? asset($partner->_fallback)
                                : ($partner->getFirstMediaUrl('partner_image') ?: null);
                        @endphp
                        @if($logoUrl)
                            <img src="{{ $logoUrl }}"
                                 alt="{{ $partner->name }}"
                                 title="{{ $partner->name }}">
                        @endif
                    @endforeach

                    {{-- Duplicate set for seamless marquee loop --}}
                    @foreach($partnerList as $partner)
                        @php
                            $logoUrl = isset($partner->_fallback)
                                ? asset($partner->_fallback)
                                : ($partner->getFirstMediaUrl('partner_image') ?: null);
                        @endphp
                        @if($logoUrl)
                            <img src="{{ $logoUrl }}"
                                 alt="{{ $partner->name }}"
                                 title="{{ $partner->name }}">
                        @endif
                    @endforeach
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
    const slides      = document.querySelectorAll('.slide');
    const indicators  = document.querySelectorAll('.slider-line .ind');
    const heroContent = document.querySelector('.hero-content');
    const taglineEl   = document.getElementById('heroTagline');
    const titleEl     = document.getElementById('heroTitle');
    const descEl      = document.getElementById('heroDesc');
    const hasVideo    = !!document.querySelector('.hero-video-bg');
    const total       = typeof heroSliderData !== 'undefined' ? heroSliderData.length : 0;

    let current   = 0;
    let animating = false;

    function updateText(idx) {
        if (!heroSliderData || !heroSliderData[idx]) return;
        const d          = heroSliderData[idx];
        const title      = d.title       || '';
        const designWord = d.design_word || '';
        const tagline    = d.tagline     || '';

        if (taglineEl) taglineEl.textContent = tagline;

        if (titleEl) {
            if (designWord && title.includes(designWord)) {
                const before = title.split(designWord)[0];
                const after  = title.split(designWord).slice(1).join(designWord);
                titleEl.innerHTML = `${before}<span style="color:#22c1c3">${designWord}</span>${after}`;
            } else {
                titleEl.textContent = title;
            }
        }

        if (descEl) descEl.innerHTML = d.description || '';
    }

    function goTo(n) {
        if (animating || total <= 1) return;
        animating = true;

        const prev = current;
        current = ((n % total) + total) % total;

        // Fade out text
        if (heroContent) heroContent.classList.add('hero-text-fading');

        // Image slides — only switch when no video
        if (!hasVideo) {
            slides[prev]?.classList.remove('active');
            slides[current]?.classList.add('active');
        }

        // Update indicators
        indicators[prev]?.classList.remove('active');
        indicators[current]?.classList.add('active');

        setTimeout(() => {
            updateText(current);
            if (heroContent) heroContent.classList.remove('hero-text-fading');
            animating = false;
        }, 450);
    }

    // Auto-advance every 5s
    let timer = setInterval(() => goTo(current + 1), 5000);

    // Click indicators
    indicators.forEach((ind, i) => {
        ind.addEventListener('click', () => {
            clearInterval(timer);
            goTo(i);
            timer = setInterval(() => goTo(current + 1), 5000);
        });
    });
})();

// ====== SCROLL ANIMATIONS ======
(function () {
    const els = document.querySelectorAll('.anim-fade-up, .anim-fade-left, .anim-fade-right');
    if (!els.length) return;
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('anim-visible');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.15 });
    els.forEach(el => observer.observe(el));
})();

</script>
@endpush

