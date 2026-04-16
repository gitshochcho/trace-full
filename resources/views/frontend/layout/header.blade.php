<div class="topbar d-none d-lg-block" style="background-color: #004051; color: #fff;">
    <div class="container-fluid px-5" style="max-width: 1072px; margin: 0 auto;">
        <div class="d-flex justify-content-between align-items-center py-2">
            <div class="topbar-left">
                <span style="font-size: 11px; opacity: 1;">✉ support@trace.com</span>
            </div>
            <div class="topbar-right d-flex align-items-center gap-3">
                <a href="#" class="text-decoration-none" style="font-size: 11px; color: #fff; opacity: 1;">Company news</a>
                <a href="#" class="text-decoration-none" style="font-size: 11px; color: #fff; opacity: 1;">Faq</a>
                <span class="text-white" style="opacity: 0.5;">|</span>
                <div class="social-icons d-flex gap-3">
                    <a href="#" style="color: #fff; font-size: 13px; opacity: 1;"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" style="color: #fff; font-size: 13px; opacity: 1;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #fff; font-size: 13px; opacity: 1;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: #fff; font-size: 13px; opacity: 1;"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3" style="height: 74px; opacity: 1;">
    <div class="container-fluid px-lg-5 d-flex justify-content-between" style="max-width: 1072px; margin: 0 auto;">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <x-logo />
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button class="btn-close d-lg-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" style="display: none !important;"></button>

        <div class="collapse navbar-collapse bg-white" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-4" style="font-size: 13px; font-weight: 600; letter-spacing: 0.3px;">
                <li class="nav-item">
                    <a class="nav-link text-dark px-0 {{ request()->is('about') ? 'active' : '' }}" href="/about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-0 {{ request()->is('services') ? 'active' : '' }}" href="/services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-0" href="#">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-0 {{ request()->is('team') ? 'active' : '' }}" href="/team">Our Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-0 {{ request()->is('insights') ? 'active' : '' }}" href="/insights">Insights</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark px-0 {{ request()->is('career') ? 'active' : '' }}" href="/career">Careers</a>
                </li>
            </ul>
            
            <div class="d-grid d-lg-block mt-3 mt-lg-0">
                <a href="/contact" class="btn rounded-pill py-2 px-4" 
                   style="background: #002D3A; color: #fff; font-size: 12px; font-weight: 700; text-decoration: none; box-shadow: none; border: none;">
                    Contact Us &rarr;
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* ছবির মতো মেনু আইটেমের হোভার ইফেক্ট */
    .nav-link {
        color: #1a2332 !important;
        transition: color 0.3s ease;
        position: relative;
    }
    
    .nav-link:hover {
        color: #004051 !important; /* টপবারের কালারের সাথে মিলিয়ে হোভার */
    }

    .nav-link.active {
        color: #004051 !important;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -6px;
        height: 3px;
        border-radius: 2px;
        background: #e85d26;
    }

    /* মোবাইল ভিউর জন্য কিছু কাস্টম ফিক্স */
    @media (max-width: 991px) {
        .navbar-collapse {
            margin-top: 15px;
            text-align: center;
            padding: 20px;
            background-color: white !important;
            position: absolute;
            top: 74px;
            left: 0;
            right: 0;
            width: 100%;
        }
        .navbar-toggler:not(.collapsed) ~ .btn-close {
            display: block !important;
        }
        .nav-item {
            border-bottom: 1px solid #f8f9fa;
            padding: 8px 0;
        }
        .nav-item:last-child {
            border-bottom: none;
        }
    }
</style>