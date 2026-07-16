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
    height: 70vh;
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
.about-hero-content p {
    color: rgba(255, 255, 255, 0.5) !important; /* text-white-50 er value */
    max-width: 480px;
    font-size: 17px;
    line-height: 30px;
    text-align: justify;
}

.about-hero-content h1 {
    font-family: "Sora", sans-serif;
    font-weight: 800;
    font-size: clamp(32px, 5vw, 58px);
    line-height: 1.15;
    color: #ffffff;
}

.hero-line {
    width: 145px;
    height: 5px;
    background: var(--primary-orange);
    border-radius: 2px;
}

.hero-title span {
    color: #4DC0C4 !important;
    display: inline-block; 
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

.about-title span {
        color: #01888c !important;
        font-weight: inherit;
    }

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

.about-rich-text,
.about-rich-text p,
.about-rich-text ul,
.about-rich-text ol,
.about-rich-text li {
    color: #6c757d;
    font-size: 15px;
    line-height: 1.8;
}

.about-rich-text p:last-child {
    margin-bottom: 0;
}

/* Buttons */
.btn-orange {
    background-color: #F47735 !important;
    color: #FFFFFF !important;
    border: 1px solid #F47735 !important;
    border-radius: 50px !important;
    padding: 10px 28px !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: none !important;
    transition: all 0.3s ease;
}

.btn-orange:hover {
    background-color: #d9632a !important;
    border-color: #d9632a !important;
    box-shadow: 0 4px 12px rgba(244, 119, 53, 0.2) !important;
}

.btn-outline-dark-custom {
    background-color: transparent !important;
    color: #0F172A !important;
    border: 1px solid #D1D5DB !important;
    border-radius: 50px !important;
    padding: 10px 28px !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    box-shadow: none !important;
    transition: all 0.3s ease;
}

.btn-outline-dark-custom:hover {
    background-color: #F8FAFC !important;
    border-color: #94A3B8 !important;
}

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

.framework-main-container {
    max-width: 1072px;
    width: 100%;
    margin: 0 auto;
    display: block;
    padding-left: 15px;
    padding-right: 15px;
}

.framework-right-box {
    width: 500px;
    background: #ffffff;
    border: 1px solid #E5E9ED;
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
}

.framework-main-container .row {
    margin: 0;
    display: flex;
    flex-wrap: nowrap;
    column-gap: 72px;
}

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
    text-align: justify;
}

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
    text-align: justify;
}

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
    text-align: justify;
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
    max-width: 1072px;
    width: 100%;
    margin: 0 auto;
    padding-left: 15px;
    padding-right: 15px;
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

.projects-grid {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.project-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    flex: 1 1 0;
    min-width: 300px;
}

.project-card {
    position: relative;
    width: 100%;
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

@media (max-width: 1080px) {
    .projects-main-container { width: 95%; }
    .projects-grid { justify-content: center; }
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
    max-width: 1072px;
    width: 100%;
    margin: 0 auto;
    padding-left: 15px;
    padding-right: 15px;
}

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

.insights-grid {
    display: grid;
    grid-template-columns: 516px 1fr 1fr;
    column-gap: 20px;
    row-gap: 16px;
}

.insight-card-link {
    text-decoration: none;
    color: inherit;
}

/* Big card link — direct grid child, spans both rows */
.insights-grid > .insight-card-link:first-child {
    grid-row: span 2;
    display: flex;
    flex-direction: column;
}

.big-card {
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

.big-card .card-img-box img { height: 260px; object-fit: cover; transition: transform 0.5s ease; }

.small-card {
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

.small-img img { height: 120px; object-fit: cover; transition: transform 0.5s ease; }

.insight-card-link:hover .big-card,
.insight-card-link:hover .small-card {
    box-shadow: 0 10px 28px rgba(1, 53, 75, 0.16);
    transform: translateY(-4px);
    border-color: #4CC3C3;
}

.insight-card-link:hover .card-img-box img { transform: scale(1.05); }

.insight-card-link:hover .footer-link { color: #01354B; }

.card-img-box { position: relative; overflow: hidden; }

.img-overlay-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(142.06deg, rgba(1, 53, 75, 0.6) 0%, rgba(1, 136, 140, 0.3) 100%);
}

.in-badge-custom {
    position: absolute;
    bottom: 12px;
    left: 12px;
    background: #F47735;
    color: #fff;
    font-size: 10px;
    padding: 3px 10px;
    border-radius: 100px;
}

.card-body { padding: 24px; flex-grow: 1; }
.card-body-small { padding: 18px 20px 12px; flex: 1; }

.card-h { font-size: 18px; font-weight: 600; color: #01354B; line-height: 1.4; }
.card-h-small { font-size: 14px; font-weight: 700; color: #01354B; line-height: 1.4; margin-bottom: 0; }

.card-p { font-size: 13px; color: #64748B; margin-top: 12px; line-height: 1.6; }

.card-footer { padding: 15px 24px; border-top: 1px solid #F1F5F9; display: flex; justify-content: space-between; }
.card-footer-small { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-top: 1px solid #F1F5F9; }

.meta-text { font-size: 11px; color: #94A3B8; }
.footer-link { font-size: 12px; color: #01888C; font-weight: 700; text-decoration: none; }

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
    min-height: 120px;
}

.all-box-link:hover { background: #E6F7F8; }

.all-text { color: #01888C; font-size: 11px; text-transform: uppercase; font-weight: 700; }
.insights-link-text { color: #01888C; font-size: 20px; font-weight: 800; margin: 2px 0; }
.arrow-icon { color: #01354B; font-size: 24px; }

@media (max-width: 900px) {
    .insights-container { width: 95%; }
    .insights-grid { grid-template-columns: 1fr 1fr; }
    .insights-grid > .insight-card-link:first-child { grid-column: span 2; grid-row: auto; }
    .big-card { height: auto; }
}

@media (max-width: 600px) {
    .insights-grid { grid-template-columns: 1fr; }
    .insights-grid > .insight-card-link:first-child { grid-column: auto; }
}

/* ================= PARTNERS SECTION =================
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


/* ── Partners Slider ── */
.partners-slider-wrapper {
    overflow: hidden;
    border: 1px solid #E5E9ED;
    border-radius: 16px;
    margin-top: 52px;
}
 
.partners-track {
    display: flex;
    transition: transform 0.5s ease;
    will-change: transform;
}
 
.partner-slide {
    min-width: 25%;   /* 4 per row default */
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 30px;
    border-right: 1px solid #E5E9ED;
    background: #fff;
    flex-shrink: 0;
    transition: background 0.3s;
}
 
.partner-slide:hover { background: #F8FAFC; }
 
.partner-slide a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}
 
.partner-slide img {
    max-height: 45px;
    max-width: 100%;
    object-fit: contain;
    transition: 0.3s;
}
 
.partner-slide:hover img {
    filter: grayscale(0%);
    opacity: 1;
}
 
.partner-name-text {
    font-size: 13px;
    font-weight: 700;
    color: #94A3B8;
    text-align: center;
}
 
/* dots */
.dots-box { display: flex; gap: 8px; align-items: center; }
.dot { width: 8px; height: 8px; background: #E2E8F0; border-radius: 50%; display: inline-block; cursor: pointer; transition: 0.3s; }
.dot.active { background: #01888C; width: 12px; border-radius: 10px; }
 
/* Responsive */
@media (max-width: 992px) { .partner-slide { min-width: 33.333%; } }
@media (max-width: 640px) { .partner-slide { min-width: 50%; } }


@media (max-width: 1200px) {
    .partners-container { width: 100%; padding: 0 20px; }
    .logo-grid { grid-template-columns: repeat(2, 1fr); }
    .partner-logo-wrapper:nth-child(2) { border-right: none; }
    .partner-logo-wrapper { border-bottom: 1px solid #E5E9ED; }
} */

.mission-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: auto;
    height: 46px;
    padding: 12px 28px;
    border-radius: 100px;
    border: 2px solid #FF6B00;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    opacity: 1;
    white-space: nowrap;
    transition: background-color 0.25s ease, color 0.25s ease, transform 0.2s ease;
}

.mission-btn-white {
    background-color: #ffffff;
    color: #000000;
    border: 2px solid #D0D8DE;
}
.mission-btn-white:hover {
    background-color: #FF6B00;
    color: #ffffff;
    transform: translateY(-2px);
}
</style>
@endpush


@section('content')
@php
    $aboutSection    = $aboutPageContent?->section     ?? '';
    $aboutHeading    = $aboutPageContent?->heading     ?? '';
    $aboutSubHeading = $aboutPageContent?->sub_heading ?? '';
    $aboutDescription= $aboutPageContent?->description ?? '';
    $aboutImage      = $aboutPageContent?->imageUrl()  ?? '';

    $aboutProjects = $aboutProjects ?? collect();
    $aboutInsights = $aboutInsights ?? collect();

    $aboutCommitmentContent = $aboutCommitmentContent ?? null;
    $aboutFrameworkContent = $aboutFrameworkContent ?? null;
    $frameworkItems = $frameworkItems ?? collect();
    $aboutUniqueFeaturesContent = $aboutUniqueFeaturesContent ?? null;
    $uniqueFeatureCards = $uniqueFeatureCards ?? collect();

    $commitmentHeading    = $aboutCommitmentContent?->heading     ?? '';
    $commitmentSubHeading = $aboutCommitmentContent?->sub_heading ?? '';
    $commitmentImage      = $aboutCommitmentContent?->imageUrl()  ?? '';
    $commitmentRawDescription = (string) ($aboutCommitmentContent?->description ?: '');

    $commitmentPoints = collect();
    $commitmentBottomText = '';

    if ($commitmentRawDescription !== '') {
        preg_match_all('/<li[^>]*>(.*?)<\/li>/si', $commitmentRawDescription, $listMatches);
        $listItems = collect($listMatches[1] ?? [])
            ->map(fn ($item) => trim(strip_tags($item)))
            ->filter();

        if ($listItems->isNotEmpty()) {
            $commitmentPoints = $listItems;

            $withoutLists = preg_replace('/<ul\b[^>]*>.*?<\/ul>/si', '', $commitmentRawDescription);
            $commitmentBottomText = trim(strip_tags((string) $withoutLists));
        } else {
            $plainDescription = html_entity_decode(strip_tags(str_ireplace(['<br>', '<br/>', '<br />'], "\n", $commitmentRawDescription)));
            $lines = collect(preg_split('/\r\n|\r|\n/', $plainDescription ?: ''))
                ->map(fn ($line) => trim($line))
                ->filter();

            if ($lines->count() > 1) {
                $commitmentPoints = $lines;
            } else {
                $commitmentBottomText = $lines->first() ?: '';
            }
        }
    }

    $commitmentBottomText = $commitmentBottomText ?: ($aboutCommitmentContent?->design_word ?? '');

    $frameworkTag         = $aboutFrameworkContent?->section     ?? '';
    $frameworkHeadingRaw  = $aboutFrameworkContent?->heading     ?? '';
    $frameworkDesignWord  = $aboutFrameworkContent?->design_word ?? '';
    $frameworkHeading     = $frameworkDesignWord
        ? str_ireplace($frameworkDesignWord, "<span>{$frameworkDesignWord}</span>", $frameworkHeadingRaw)
        : $frameworkHeadingRaw;
    $frameworkDescription = $aboutFrameworkContent?->description ?? '';
    $frameworkDisplayItems = $frameworkItems->map(fn ($item) => [
        'title'       => $item->heading ?? '',
        'description' => strip_tags((string) $item->description),
        'icon'        => $item->iconUrl(),
    ]);

    $featuresTag         = $aboutUniqueFeaturesContent?->section     ?? '';
    $featuresHeadingRaw  = $aboutUniqueFeaturesContent?->heading     ?? '';
    $featuresDesignWord  = $aboutUniqueFeaturesContent?->design_word ?? '';
    $featuresHeading     = $featuresDesignWord
        ? str_ireplace($featuresDesignWord, "<span>{$featuresDesignWord}</span>", $featuresHeadingRaw)
        : $featuresHeadingRaw;
    $featuresDescription = $aboutUniqueFeaturesContent?->description ?? '';
    $featureDisplayCards = $uniqueFeatureCards->map(fn ($item) => [
        'title'       => $item->heading ?? '',
        'description' => strip_tags((string) $item->description),
        'icon'        => $item->iconUrl(),
    ]);

    $featuredInsight = $aboutInsights->first();
    $secondaryInsights = $aboutInsights->slice(1, 3);
@endphp

<section class="about-hero">
    <img src="{{ $aboutHeader?->imageUrl() ?? asset('') }}" alt="Hero">
    <div class="container-fluid about-hero-content">
        <div class="custom-container"> 
            <div class="row">
                <div class="col-lg-8">
                   <h1 class="hero-title">
               @php
        $heading = $aboutHeader->heading ?? '';
        $designWord = $aboutHeader?->design_word; 

        if ($designWord) {
           
            $formattedHeading = str_ireplace($designWord, "<span>{$designWord}</span>", $heading);
        } else {
            $formattedHeading = $heading;
        }
    @endphp

    {!! $formattedHeading !!}
</h1>
                    <p class="text-white-50 mt-3" style="max-width: 480px; font-size: 17px; line-height: 30px;">
                        {!! $aboutHeader?->description ?? '' !!}
                    </p>
                    <div class="hero-line mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-3 my-md-2">
    <div class="custom-container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6 pe-lg-5">
                <span class="about-tag mb-3">ABOUT TRACE</span>
                
                <h2 class="about-title mb-4">
                    @php
                        $heading = $aboutTrace->heading ?? '';
                        $designWord = trim($aboutTrace?->design_word ?? '');
                        $formattedHeading = $heading;

                        if ($designWord) {
                            $words = array_filter(preg_split('/\s+/', $designWord));
                            foreach ($words as $word) {
                                $formattedHeading = preg_replace(
                                    '/(' . preg_quote($word, '/') . ')/iu',
                                    '<span>$1</span>',
                                    $formattedHeading
                                );
                            }
                        }
                    @endphp
                    {!! $formattedHeading !!}
                </h2>

                <div class="about-info mt-4">
                    {{-- Who We Are Section --}}
                    <div class="mb-4">
                        <h4 class="fw-bold" style="font-size: 18px;">{{ $whoWeAre?->heading ?? '' }}</h4>
                        <div class="text-secondary" style="text-align: justify; margin-top: 14px;">
                            {{-- Editor theke asha p tag remove korbe ebong data display korbe --}}
                            {!! ($whoWeAre?->description ?? '') !!}
                        </div>
                    </div>

                    <div class="about-divider mb-4"></div>

                    {{-- Our Mission Section --}}
                    <div class="mb-4">
                        <h4 class="fw-bold" style="font-size: 18px;">{{ $ourMission?->heading ?? '' }}</h4>
                        <div class="text-secondary" style="text-align: justify; margin-top: 14px;">
                            {!! ($ourMission?->description ?? '') !!}
                         
                        </div>
                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <a href="{{ route('contact') }}" class="mission-btn mission-btn-white">Work With Us →</a>
                            <a href="{{ route('services') }}" class="mission-btn mission-btn-white">Our Services</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 about-right text-end">
                <img src="{{ $aboutTrace?->imageUrl() ?? asset('') }}" 
                     class="img-fluid shadow-lg" 
                     alt="Team" 
                     style="width: 500px; height: 600px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<section class="commitment">
    <div class="commitment-bg-wrap">
        <img src="{{ asset('assets/img/Background (8).png') }}" alt="Background">
    </div>
    <div class="commitment-left-img">
        <img src="{{ $commitmentImage }}" alt="{{ strip_tags($commitmentHeading) }}">
    </div>

    <div class="custom-container commitment-content-area">
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <div class="commitment-content-box">
                    <h2>{!! nl2br(e($commitmentHeading)) !!}</h2>
                    <div class="underline" style="width:32px; height:3px; background:#F47735; margin-bottom:22px;"></div>

                    <p class="small mb-3 text-uppercase fw-bold text-info" style="font-size: 13px; letter-spacing: 1px;">
                        {{ strip_tags($commitmentSubHeading) }}
                    </p>

                 <ul>
                   @foreach($commitmentPoints as $point)
                       <li>{!! $point !!}</li>
                   @endforeach
               </ul>
               

                    <p class="bottom-text mt-4" style="color:#cbd5e1; font-style: italic;">
                        {{ $commitmentBottomText }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="framework-section py-5">
    <div class="framework-main-container">
        <div class="row align-items-center">
            <div class="col-lg-5 p-0">
                <div class="framework-tag d-flex align-items-center gap-2 mb-3">
                    <span class="line"></span>
                    <span class="tag-text">{{ $frameworkTag }}</span>
                </div>
                <h2 class="framework-title mb-4">
                    {!! nl2br($frameworkHeading) !!}
                </h2>
                <p class="framework-desc mb-4">
                    {!! strip_tags($frameworkDescription) !!}
                </p>
                <a href="{{ route('contact') }}" class="btn-get-started">
                    Get Started &rarr;
                </a>
            </div>

            <div class="col-lg-7 p-0">
                <div class="framework-right-box shadow-sm">
                    @php
                        $frameworkFallbackIcons = ['fa-regular fa-lightbulb', 'fa-solid fa-gear', 'fa-solid fa-rocket'];
                    @endphp
                    @foreach($frameworkDisplayItems as $index => $item)
                        <div class="framework-item">
                            <div class="num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="icon-box">
                                @if(!empty($item['icon']))
                                    <img src="{{ $item['icon'] }}" alt="{{ $item['title'] }}" style="width:24px; height:24px; object-fit:contain; margin-top:10px;">
                                @else
                                    <i class="{{ $frameworkFallbackIcons[$index] ?? 'fa-regular fa-circle' }}"></i>
                                @endif
                            </div>
                            <div class="content">
                                <h4>{!! $item['title'] !!}</h4>
                                <p>{!! $item['description'] !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features-section py-3">
    <div class="custom-container">
        <div class="row align-items-end mb-5 gy-4">
            <div class="col-lg-5">
                <div class="features-tag mb-2">
                    <span class="line"></span>
                    {{ $featuresTag }}
                </div>
                <h2 class="features-title">
                    {!! nl2br($featuresHeading) !!}
                </h2>
            </div>
            <div class="col-lg-7">
                <p class="text-secondary mb-0" style="font-size: 15px; line-height: 1.8; max-width: 600px; text-align: justify; ">
                    {!! strip_tags($featuresDescription) !!}
                </p>
            </div>
        </div>

        <div class="row g-4">
            @php
                $featureFallbackIcons = [
                    'fa-solid fa-users-viewfinder',
                    'fa-regular fa-clock',
                    'fa-solid fa-arrow-trend-up',
                    'fa-regular fa-sun',
                ];
            @endphp

            @foreach($featureDisplayCards as $index => $feature)
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card shadow-sm h-100">
                        <div class="icon-wrapper mb-4">
                            @if(!empty($feature['icon']))
                                <img src="{{ $feature['icon'] }}" alt="{{ $feature['title'] }}" style="width:24px; height:24px; object-fit:contain;">
                            @else
                                <i class="{{ $featureFallbackIcons[$index] ?? 'fa-regular fa-circle' }}"></i>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-3">{{ $feature['title'] }}</h5>
                        <p class="text-secondary small line-height-relaxed" style="text-align: justify;">
                            {!! $feature['description'] !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="projects-section py-3 my-lg-3">
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
                <a href="{{ route('projects') }}" class="all-projects-link">
                    All Projects <span class="arrow-circle">→</span>
                </a>
            </div>
        </div>

        <div class="projects-grid">
            @forelse($aboutProjects as $project)
                @php
                    $projectImage  = $project->heroImageUrl() ?? '';
                     $firstSvc         = $project->services->first();
                      $projectCategory  = $firstSvc?->section ?? $firstSvc?->service_name ?? 
                    $projectBadge  = strtoupper($project->services->first()?->service_name ?? $project->project_standard ?? '');
                    $projectClient = $project->client ?? '';
                @endphp

                <a href="{{ route('projectdetails', $project) }}" class="project-card-link">
                    <div class="project-card">
                        <img src="{{ $projectImage }}" alt="{{ $project->project_title }}">
                        <div class="project-overlay">
                            <span class="project-badge">{{ $projectCategory }}</span>
                            <h3 class="project-h">{{ $project->project_title }}</h3>
                            <div class="project-meta">
                                <span class="meta-line"></span>
                                <p>{{ $projectClient }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="w-100">
                    <div class="border rounded-3 bg-white p-4 text-muted">No projects have been added yet.</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="insights-section py-4">
    <div class="insights-container">
        <div class="insights-header mb-5">
            <div class="header-left">
                <div class="insights-tag">
                    <span class="orange-line"></span> INSIGHTS
                </div>
                <h2 class="insights-title">Ideas and <span>perspectives</span></h2>
                <p class="insights-desc">Thought leadership, research publications, and knowledge resources from our team.</p>
            </div>
            <div class="header-right py-5">
                <a href="{{ route('insights') }}" class="all-insights-btn">All Insights &rarr;</a>
            </div>
        </div>

        <div class="insights-grid">
            @if($featuredInsight)
                @php
                    $featuredLeadArticle = $featuredInsight->articles->first();
                    $featuredImage       = $featuredInsight->imageUrl() ?: $featuredInsight->articleImageUrl() ?: asset('assets/img/Op-Ed.png');
                    $featuredTypeCategory = strtolower((string) ($featuredInsight->insightType?->type_category ?? ''));
                    $featuredType        = strtoupper((string) ($featuredInsight->insightType?->type ?? 'INSIGHT'));
                    $featuredTitle       = $featuredInsight->heading ?? $featuredLeadArticle?->title ?? '';
                    $featuredDescription = \Illuminate\Support\Str::limit(strip_tags($featuredInsight->description ?? $featuredLeadArticle?->description ?? ''), 180);
                    $featuredAction      = $featuredInsight->actionLabel();
                    $featuredMetaDate    = optional($featuredInsight->published_at)->format('M Y') ?? '';
                    $featuredMetaDuration = $featuredLeadArticle?->read_minutes ? $featuredLeadArticle->read_minutes . ' min read' : 'Quick read';

                    $featuredLink = '#';
                    $featuredExternal = false;
                    if ($featuredTypeCategory === 'read' && $featuredLeadArticle) {
                        $featuredLink = route('articleDetails', $featuredLeadArticle);
                    } elseif ($featuredTypeCategory === 'download') {
                        $featuredLink = $featuredInsight->attachmentUrl() ?: ($featuredLeadArticle?->attachmentUrl() ?: '#');
                    } elseif (in_array($featuredTypeCategory, ['watch', 'video', 'video_watch'], true)) {
                        $featuredLink = $featuredInsight->videoUrl() ?: '#';
                        $featuredExternal = true;
                    } elseif ($featuredTypeCategory === 'read_on') {
                        $featuredLink = $featuredInsight->source_name ?: '#';
                        $featuredExternal = true;
                    }
                @endphp

                <a href="{{ $featuredLink }}" class="insight-card-link" @if($featuredExternal) target="_blank" rel="noopener" @endif>
                    <div class="insight-card big-card">
                        <div class="card-img-box">
                            <img src="{{ $featuredImage }}" alt="{{ $featuredTitle }}" class="w-100">
                            <div class="img-overlay-gradient"></div>
                            <span class="in-badge-custom">{{ $featuredType }}</span>
                        </div>
                        <div class="card-body">
                            <h4 class="card-h">{{ $featuredTitle }}</h4>
                            <p class="card-p">{{ $featuredDescription }}</p>
                        </div>
                        <div class="card-footer">
                            <span class="meta-text">{{ $featuredMetaDate }} · {{ $featuredMetaDuration }}</span>
                            <span class="footer-link">{{ $featuredAction }} &rarr;</span>
                        </div>
                    </div>
                </a>
            @else
                <div class="big-card d-flex align-items-center justify-content-center p-4 text-muted">
                    No insights have been published yet.
                </div>
            @endif

            @foreach($secondaryInsights as $insight)
                @php
                    $leadArticle = $insight->articles->first();
                    $insightImage    = $insight->imageUrl() ?: $insight->articleImageUrl() ?: asset('assets/img/Op-Ed.png');
                    $insightTypeCategory = strtolower((string) ($insight->insightType?->type_category ?? ''));
                    $insightType     = strtoupper((string) ($insight->insightType?->type ?? 'INSIGHT'));
                    $insightTitle    = $insight->heading ?? $leadArticle?->title ?? '';
                    $insightAction   = $insight->actionLabel();
                    $insightMetaDate = optional($insight->published_at)->format('M Y') ?? '';
                    $insightMetaDuration = $leadArticle?->read_minutes ? $leadArticle->read_minutes . ' min' : 'Quick read';

                    $insightLink = '#';
                    $insightExternal = false;
                    if ($insightTypeCategory === 'read' && $leadArticle) {
                        $insightLink = route('articleDetails', $leadArticle);
                    } elseif ($insightTypeCategory === 'download') {
                        $insightLink = $insight->attachmentUrl() ?: ($leadArticle?->attachmentUrl() ?: '#');
                    } elseif (in_array($insightTypeCategory, ['watch', 'video', 'video_watch'], true)) {
                        $insightLink = $insight->videoUrl() ?: '#';
                        $insightExternal = true;
                    } elseif ($insightTypeCategory === 'read_on') {
                        $insightLink = $insight->source_name ?: '#';
                        $insightExternal = true;
                    }
                @endphp

                <a href="{{ $insightLink }}" class="insight-card-link" @if($insightExternal) target="_blank" rel="noopener" @endif>
                    <div class="insight-card small-card">
                        <div class="card-img-box small-img">
                            <img src="{{ $insightImage }}" alt="{{ $insightTitle }}" class="w-100">
                            <div class="img-overlay-gradient"></div>
                            <span class="in-badge-custom" style="background: #01888C;">{{ $insightType }}</span>
                        </div>
                        <div class="card-body-small">
                            <h4 class="card-h-small">{{ $insightTitle }}</h4>
                        </div>
                        <div class="card-footer-small">
                            <span class="meta-text">{{ $insightMetaDate }} · {{ $insightMetaDuration }}</span>
                            <span class="footer-link">{{ $insightAction }} &rarr;</span>
                        </div>
                    </div>
                </a>
            @endforeach

            <a href="{{ route('insights') }}" class="all-box-link">
                <span class="all-text">All</span>
                <h4 class="insights-link-text">Insights</h4>
                <div class="arrow-icon">&rarr;</div>
            </a>
        </div>
    </div>
</section>

<!-- <section class="partners-section py-4">
    <div class="custom-container">
        <div class="row align-items-end mb-5">
            <div class="col-lg-6">
                <div class="partners-tag">
                    <span class="orange-line"></span> OUR PARTNERS
                </div>
                <h2 class="partners-title">
                    @php
                        $pHeading    = $partnersContent?->heading     ?? '';
                        $pDesignWord = $partnersContent?->design_word ?? '';
                        if ($pDesignWord && Str::contains($pHeading, $pDesignWord)) {
                            $pHeading = Str::before($pHeading, $pDesignWord)
                                . '<span>' . $pDesignWord . '</span>'
                                . Str::after($pHeading, $pDesignWord);
                        }
                    @endphp
                    {!! $pHeading !!}
                </h2>
            </div>
            <div class="col-lg-6" style="text-align: justify;">
                <p class="partners-desc">
                    {!! $partnersContent?->description
                        ?: '' !!}
                </p>
            </div>
        </div>
 
        {{-- Slider --}}
        <div class="partners-slider-wrapper">
            <div class="partners-track" id="partnersTrack">
                @if(isset($partners) && $partners->count() > 0)
                    {{-- Original items --}}
                    @foreach($partners as $partner)
                        <div class="partner-slide">
                            <a href="{{ $partner->link ?: '#' }}" target="_blank" rel="noopener" title="{{ $partner->name }}">
                                @if($partner->imageUrl())
                                    <img src="{{ $partner->imageUrl() }}" alt="{{ $partner->name }}">
                                @else
                                    <span class="partner-name-text">{{ $partner->name }}</span>
                                @endif
                            </a>
                        </div>
                    @endforeach
                    {{-- Cloned items for infinite loop --}}
                    @foreach($partners as $partner)
                        <div class="partner-slide">
                            <a href="{{ $partner->link ?: '#' }}" target="_blank" rel="noopener" title="{{ $partner->name }}">
                                @if($partner->imageUrl())
                                    <img src="{{ $partner->imageUrl() }}" alt="{{ $partner->name }}">
                                @else
                                    <span class="partner-name-text">{{ $partner->name }}</span>
                                @endif
                            </a>
                        </div>
                    @endforeach
                @else
                    {{-- Fallback static --}}
                    @php $logos = ['bafisa.png', 'lir 2.png', 'bijem.png', 'build.png']; @endphp
                    @foreach(array_merge($logos, $logos) as $logo)
                        <div class="partner-slide">
                            <img src="{{ asset('assets/img/' . $logo) }}" alt="Partner">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
 
        {{-- Controls --}}
        <div class="slider-controls mt-4">
            <button class="arrow-btn" id="partnerPrev">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <div class="dots-box" id="partnerDots"></div>
            <button class="arrow-btn" id="partnerNext">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
</section> -->

@include('frontend.layout.cta')


<script>
(function () {
    const track       = document.getElementById('partnersTrack');
    const prevBtn     = document.getElementById('partnerPrev');
    const nextBtn     = document.getElementById('partnerNext');
    const dotsBox     = document.getElementById('partnerDots');
 
    if (!track) return;
 
    // কতটি slide per view দেখাবে
    function slidesPerView() {
        if (window.innerWidth <= 640)  return 2;
        if (window.innerWidth <= 992)  return 3;
        return 4;
    }
 
    const allSlides   = track.querySelectorAll('.partner-slide');
    const totalReal   = allSlides.length / 2;  // clone বাদে real count
    let perView       = slidesPerView();
    let current       = 0;
    let autoTimer     = null;
 
    // Dots তৈরি করো
    function buildDots() {
        dotsBox.innerHTML = '';
        const pages = Math.ceil(totalReal / perView);
        for (let i = 0; i < pages; i++) {
            const d = document.createElement('span');
            d.className = 'dot' + (i === 0 ? ' active' : '');
            d.addEventListener('click', () => goTo(i * perView));
            dotsBox.appendChild(d);
        }
    }
 
    function updateDots() {
        const dots  = dotsBox.querySelectorAll('.dot');
        const page  = Math.floor(current / perView);
        dots.forEach((d, i) => d.classList.toggle('active', i === page));
    }
 
    function slideWidth() {
        return track.parentElement.offsetWidth / perView;
    }
 
    function goTo(index) {
        current = index;
        // infinite loop reset
        if (current >= totalReal) current = 0;
        if (current < 0) current = totalReal - perView;
 
        track.style.transform = `translateX(-${current * slideWidth()}px)`;
        updateDots();
    }
 
    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1 < 0 ? totalReal - perView : current - 1); }
 
    // Slide width গুলো set করো
    function setSlideWidths() {
        perView = slidesPerView();
        const w = slideWidth();
        allSlides.forEach(s => s.style.minWidth = w + 'px');
        goTo(current);
        buildDots();
    }
 
    // Auto slide
    function startAuto() {
        clearInterval(autoTimer);
        autoTimer = setInterval(next, 3000);
    }
 
    function stopAuto() { clearInterval(autoTimer); }
 
    // Events
    prevBtn?.addEventListener('click', () => { prev(); stopAuto(); startAuto(); });
    nextBtn?.addEventListener('click', () => { next(); stopAuto(); startAuto(); });
 
    track.parentElement.addEventListener('mouseenter', stopAuto);
    track.parentElement.addEventListener('mouseleave', startAuto);
 
    window.addEventListener('resize', setSlideWidths);
 
    // Init
    setSlideWidths();
    startAuto();
})();
</script>
 
@endsection