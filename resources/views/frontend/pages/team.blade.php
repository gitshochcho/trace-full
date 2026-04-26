@extends('frontend.layout.app')


@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>

/* Container Fix */
.custom-container {
    max-width: 1072px;
    margin: 0 auto;
    padding: 0 60px; 
}

/* Breadcrumb */
.service-breadcrumb {
    background: #F8F9FB;
    border-bottom: 1px solid #E5E9ED;
    padding: 12px 0;
}
.breadcrumb-links { font-size: 13px; color: #94A3B8; }
.breadcrumb-links a { color: #64748B; text-decoration: none; }
.breadcrumb-links .sep { margin: 0 8px; }
.breadcrumb-links .active { color: #01354B; font-weight: 600; }

/* Hero Section */
.experts-hero {
    background: #01354B;
    padding: 80px 0;
    color: white;
}
/* Hero Section Layout */
.experts-hero {
    background: #01354B;
    padding: 80px 0;
    color: white;
}


.hero-content-wrapper { 
    max-width: 550px; 
    margin: 0;       
    text-align: left;
}

.hero-tag { 
    color: #F47735; 
    font-size: 12px; 
    font-weight: 700; 
    letter-spacing: 1px;
    margin-bottom: 15px; 
}

.orange-line-hero { 
    display: inline-block; 
    width: 30px; 
    height: 2px; 
    background: #F47735; 
    vertical-align: middle; 
    margin-right: 10px; 
}

.hero-title { 
    font-size: 48px; 
    font-weight: 800; 
    line-height: 1.1;
    margin: 20px 0; 
}

.hero-title span { color: #2EC4B6; }

.hero-desc { 
    color: #A5B4C3; 
    font-size: 15px; 
    line-height: 1.7; 
}

/* Leadership Section */
.leadership-section { padding: 100px 0; background: #fff; }
.line-teal { width: 25px; height: 2px; background: #F47735; }
.tag-text { color: #01888C; font-weight: 700; font-size: 12px; }
.leadership-header .title { font-size: 36px; font-weight: 700; color: #000; }
.leadership-header .title span { color: #01888C; }
.leadership-header .desc { color: #64748B; max-width: 500px; }

.company {
    font-size: 13px;
    color: #000000; 
    background: transparent !important; 
    padding: 0; 
    display: block; 
}


.leader-card {
    background: #FFFFFF;
    border: 1px solid #E5E9ED;
    border-radius: 24px; 
    overflow: hidden;
    box-shadow: 0px 8px 40px 0px rgba(1, 53, 75, 0.13); 
}

.leader-img-box { height: 100%; min-height: 500px; position: relative; }
.leader-img-box img { width: 100%; height: 100%; object-fit: cover; }
.leader-badge {
    position: absolute; bottom: 20px; left: 20px;
    background: #F47735; color: #fff;
    padding: 5px 15px; border-radius: 20px; font-size: 11px; font-weight: 700;
}

.leader-info { padding: 50px; }
.leader-info .name { font-size: 32px; font-weight: 700; color: #01354B; }
.leader-info .role { color: #01888C; font-weight: 700; margin-bottom: 2px; }
.leader-info .company { color: #94A3B8; font-size: 13px; }
.orange-divider { width: 50px; height: 3px; background: #F47735; margin: 20px 0; }
.leader-info .bio { color: #475569; font-size: 15px; line-height: 1.7; }

/* Skill Tags */
.skill-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 25px; }
.skill-tags span {
    background: #E6F3F3; color: #01888C;
    padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;
}

/* Footer & Buttons */
.leader-card-footer {
    margin-top: 40px; padding-top: 25px;
    border-top: 1px solid #E5E9ED;
    display: flex; justify-content: space-between; align-items: center;
}
.social-links { display: flex; gap: 12px; }
.social-links a {
    width: 40px; height: 40px; border: 1px solid #E5E9ED;
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #64748B; text-decoration: none; transition: 0.3s;
}
.social-links a:hover { background: #C0C0C0; color: #fff; }
.btn-profile {
    background: #fff; border: 1px solid #E5E9ED;
    padding: 10px 25px; border-radius: 30px; font-size: 13px;
    font-weight: 600; color: #01354B; transition: 0.3s;
}
.btn-profile:hover { border-color: #01888C; color: #01888C; }

/* Responsive */
@media (max-width: 992px) {
    .custom-container { padding: 0 20px; }
    .leader-info { padding: 30px; }
    .hero-title { font-size: 32px; }
}

    .custom-container {
        max-width: 1072px;
        margin: 0 auto;
        padding: 0 15px;
    }

.team-section {
    background-color: #F8F9FB;
}

/* Header Styling */
.line-orange {
    width: 25px;
    height: 2px;
    background: #F47735;
}

.tag-text {
    color: #01888C;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 1.2px;
}

.team-header .title {
    font-size: 36px;
    font-weight: 800;
    color: #01354B;
    font-family: 'Sora', sans-serif;
}

.team-header .title span {
    color: #01888C;
}

.team-header .desc {
    color: #64748B;
    font-size: 15px;
    max-width: 550px;
}

/* Card Styling */

    .team-card {
    min-height: 480px; /* একটি মিনিমাম হাইট সেট করে দিন জেনো কার্ড দেখতে সুন্দর লাগে */
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #E5E9ED;
}


    
    .team-img-box {
        position: relative;
        height: 280px; 
        overflow: hidden;
    }

    .team-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

   
    .team-img-box::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(1, 53, 75, 0) 40%, rgba(1, 53, 75, 0.85) 100%);
        opacity: 0; 
        transition: opacity 0.3s ease;
    }

    .team-card:hover .team-img-box::after {
        opacity: 1; 
    }

    .team-card:hover .team-img-box img {
        transform: scale(1.05);
    }

   
    .team-social {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 12px;
        z-index: 10;
        opacity: 0;
        transform: translateY(20px); 
        transition: all 0.4s ease;
    }

    .team-card:hover .team-social {
        opacity: 1;
        transform: translateY(0);
    }

    .team-social a {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        color: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .team-social a:hover {
        background: #fff;
        color: #01354b;
    }

   
   
/* মাঝখানের কন্টেন্ট যা ফাঁকা জায়গা পূরণ করবে */
.team-content {
    padding: 20px;
    flex-grow: 1; /* কন্টেন্ট কম হলেও এটি জায়গা দখল করে রাখবে এবং নিচের বক্সকে নিচে ঠেলে দিবে */
}

    .team-content .name {
        font-size: 18px;
        font-weight: 700;
        color: #1a2332;
        margin-bottom: 4px;
    }

    .team-content .role {
        font-size: 14px;
        font-weight: 700;
        color: #00898e;
        margin-bottom: 2px;
    }

    .team-content .sub {
        font-size: 12px;
        color: #94a3b8;
        display: block;
        margin-bottom: 12px;
    }

    .team-content .divider {
        height: 1px;
        background: #f1f5f9;
        margin-bottom: 15px;
    }

    .team-content .bio {
        font-size: 13px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 20px;
        min-height: 60px;
    }

/* ইমেজ বক্সের ভেতর আইকন রাখার পজিশন */
.team-img-box {
    position: relative;
    overflow: hidden;
}

/* সোশ্যাল ওভারলে কন্টেইনার */
.team-social-overlay {
    position: absolute;
    bottom: 25px; /* নিচ থেকে কতটুকু উপরে থাকবে */
    left: 50%;
    transform: translateX(-50%) translateY(20px); /* শুরুতে একটু নিচে থাকবে */
    display: flex;
    gap: 12px;
    opacity: 0; /* শুরুতে দেখা যাবে না */
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    z-index: 5;
}

/* আইকনগুলোর স্টাইল (বক্স শেপ এবং ব্লার ইফেক্ট) */
.social-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 255);
     /* background: #ffffff; */
    /* backdrop-filter: blur(8px); */
    -webkit-backdrop-filter: blur(8px);
    border: 0.3px solid rgba(255, 255, 255, 0.15);
    color: white;
    border-radius: 8px; /* ছবি অনুযায়ী অল্প রাউন্ড */
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

/* .social-icon:hover {
    background: #ffffff;
    color: #8e3b00; 
} */

/* যখন কার্ড হোভার হবে তখন আইকন দেখাবে */
.team-card:hover .team-social-overlay {
    opacity: 1;
    transform: translateX(-50%) translateY(0); /* স্লাইড হয়ে উপরে আসবে */
}

/* View Profile বক্স যা কার্ডের নিচে ফিক্সড থাকবে */
.view-profile-box {
    width: 100%;
    height: 40px; /* আপনার পছন্দমতো হাইট */
    display: flex;
    align-items: center;
    padding-left: 21px;
    border-top: 1px solid #E5E9ED; /* আপনার রিকোয়ারমেন্ট অনুযায়ী টপ বর্ডার */
    background: #ffffff;
    margin-top: auto; /* এটিই মূলত বক্সটিকে একদম নিচে ফিক্সড করে রাখে */
}

.view-profile {
    font-size: 13px;
    font-weight: 600;
    color: #008080;
    text-decoration: none;
}

.view-profile:hover {
    color: #01354B;
}
    
    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tags span {
        background: #f1f5f9;
        color: #64748b;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
    }

/* Responsive */
@media (max-width: 1199px) {
    .custom-container { padding: 0 30px; }
}

/* Section Base */
.experts-section {
    width: 100%;
    padding: 80px 0;
    background: #fff;
    border-top: 1px solid #E5E9ED;
}

.experts-container {
    max-width: 1072px;
}

/* Heading Style */
.experts-top {
    max-width: 720px;
    margin-bottom: 52px;
}

.experts-tag {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    letter-spacing: 2px;
    font-weight: 700;
    color: #01888C;
}

.experts-tag .line {
    width: 20px;
    height: 2px;
    background: #F47735;
}

.experts-top h2 {
    font-family: "Sora", sans-serif;
    font-size: 34px;
    font-weight: 700;
    margin: 15px 0;
    color: #0F172A;
}

.experts-top h2 span {
    color: #01888C;
}

/* Expert Card Styling */
.expert-card {
    background: #FFFFFF;
    border: 1px solid #E5E9ED;
    border-radius: 24px;
    padding: 24px;
    height: 245px; 
    display: flex;
    gap: 20px;
    transition: all 0.3s ease;
}

.expert-card:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

/* Left Image & Social */
.expert-left {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}

.expert-left img {
    width: 72px;
    height: 72px;
    /* border-radius: 50%; */
    object-fit: cover;
    /* border: 4px solid #F1F5F9; */
}

.leader-social {
    display: flex;
    gap: 8px;
}

.leader-social a {
    width: 32px;
    height: 32px;
    background: #F8FAFC;
    border: 1px solid #E5E9ED;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94A3B8;
    font-size: 12px;
    text-decoration: none;
    transition: 0.3s;
}

.leader-social a:hover {
    background: #01354B;
    color: #fff;
    border-color: #01354B;
}

/* Right Content */
.expert-right {
    flex: 1;
}

.expert-badge {
    font-size: 10px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    margin-bottom: 8px;
    display: inline-block;
}

.badge-advisory { background: #FFF1EB; color: #F47735; }
.badge-technical { background: #E6F7F7; color: #01888C; }
.badge-research { background: #F1F5F9; color: #475569; }

.expert-right h4 {
    font-family: "Sora", sans-serif;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 4px;
    color: #0F172A;
}

.role {
    font-size: 13px;
    color: #01888C;
    font-weight: 600;
    margin-bottom: 12px;
}

.desc {
    font-size: 13.5px;
    color: #64748B;
    line-height: 1.5;
    margin-bottom: 15px;
}

.expert-tags span {
    font-size: 11px;
    background: #F1F5F9;
    color: #64748B;
    padding: 4px 10px;
    border-radius: 20px;
    margin-right: 5px;
}

/* Responsive */
@media (max-width: 991px) {
    .expert-card {
        height: auto; 
    }
}

</style>
@endpush


@section('content')

@php
    $heroTag         = $teamPageContent?->section     ?? '';
    $heroHeading     = $teamPageContent?->heading     ?? '';
    $heroDesignWord  = $teamPageContent?->design_word ?? '';
    $heroDescription = $teamPageContent?->description ?? '';

    $leader            = $leadTeam;
    $leaderImage       = $leader?->imageUrl()      ?? '';
    $leaderName        = $leader?->fullName()       ?? '';
    $leaderDesignation = $leader?->designation      ?? '';
    $leaderBio         = stripPTags($leader?->description) ?? '';

    $leaderSocials = $leader?->socialMedia ?? collect();
    $leaderExpertise = $leader?->experties ?? collect();

    $coreTeamMembers = ($coreTeams ?? collect())->take(8);
    $expertTeams = ($teams ?? collect())->take(6);

    $badgeClasses = ['badge-advisory', 'badge-technical', 'badge-research'];
    $expertLabels = ['ADVISORY', 'TECHNICAL EXPERT', 'RESEARCH EXPERT'];
@endphp

<nav class="service-breadcrumb">
    <div class="custom-container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">›</span>
            <span class="active">Our Team</span>
        </div>
    </div>
</nav>

<section class="experts-hero">
    <div class="custom-container"> <div class="row">
            <div class="col-lg-7 text-start"> 
                <div class="hero-content-wrapper ms-0"> <div class="hero-tag">
                        <span class="orange-line-hero"></span> {{ $heroTag }}
                    </div>
                    <h1 class="hero-title">{{ $heroHeading }} <br> <span>{{ $heroDesignWord }}</span></h1>
                    <p class="hero-desc">
                        {{ strip_tags($heroDescription) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="leadership-section">
    <div class="custom-container">
        <div class="leadership-header mb-5">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="line-teal"></span>
                <span class="tag-text">LEADERSHIP</span>
            </div>
            <h2 class="title">Managing <span>Director</span></h2>
            <p class="desc">Leading TRACE's vision of practical, high-impact consulting for governments and development partners.</p>
        </div>

        <div class="leader-card">
            <div class="row g-0">
                <div class="col-lg-5 position-relative">
                    <div class="leader-img-box">
                        <img src="{{ $leaderImage }}" alt="{{ $leaderName }}">
                        <span class="leader-badge">MD & CEO</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="leader-info">
                        <h3 class="name">{{ $leaderName }}</h3>
                        <p class="role">{{ $leaderDesignation }}</p>
                        <p class="company">Trace Consulting Limited · Dhaka, Bangladesh</p>
                        
                        <div class="orange-divider"></div>
                        
                        <p class="bio">
                            {{ \Illuminate\Support\Str::limit($leaderBio, 420) }}
                        </p>

                        <div class="skill-tags">
                            @forelse($leaderExpertise->take(6) as $expertise)
                                <span>{{ $expertise->heading }}</span>
                            @empty
                                <span>Team Leadership</span>
                            @endforelse
                        </div>

                        <div class="leader-card-footer">
                            <div class="social-links">
                                @forelse($leaderSocials->take(3) as $social)
                                    <a href="{{ $social->social_link ?: '#' }}" target="_blank" rel="noopener">
                                        @if($social->iconUrl())
                                            <img src="{{ $social->iconUrl() }}" alt="{{ $social->title ?: 'social' }}" style="width: 16px; height: 16px; object-fit: contain;">
                                        @else
                                            <i class="fa-solid fa-link"></i>
                                        @endif
                                    </a>
                                @empty
                                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                @endforelse
                            </div>
                            <a href="{{ route('teamdetails', $leader) }}" class="btn-profile">View Full Profile →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
         
<section class="team-section py-5">
    <div class="custom-container">
        <div class="team-header mb-5">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="line-orange"></span>
                <span class="tag-text">CORE TEAM</span>
            </div>
            <h2 class="title">Our <span>in-house specialists</span></h2>
            <p class="desc">Full-time TRACE staff with deep expertise across our nine service areas — the engine that runs every project.</p>
        </div>

        <div class="row g-4">
@forelse($coreTeamMembers as $member)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="team-card h-100 shadow-sm d-flex flex-column">
            
            <div class="team-img-box">
                <img src="{{ $member->imageUrl() ?: asset('assets/img/saifullah.png') }}" alt="{{ $member->fullName() }}">
                
                <div class="team-social-overlay">
                    @forelse($member->socialMedia->take(2) as $social)
                        <a href="{{ $social->social_link ?: '#' }}" class="social-icon" target="_blank" rel="noopener">
                            @if($social->iconUrl())
                                <img src="{{ $social->iconUrl() }}" alt="{{ $social->title ?: 'social' }}" style="width: 16px; height: 16px; object-fit: contain;">
                            @else
                                <i class="fas fa-link"></i>
                            @endif
                        </a>
                    @empty
                        <!-- <a href="#" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a> -->
                    @endforelse
                </div>
            </div>

            <div class="fixed-divider"></div>
            
            <div class="team-content flex-grow-1">
                <h4 class="name">{{ $member->fullName() }}</h4>
                <h5 class="role">{{ $member->designation ?? '' }}</h5>
                <span class="sub text-muted">{{ $member->experties->first()?->heading ?? '' }}</span>

                <p class="bio">{{ \Illuminate\Support\Str::limit(stripPTags($member->description), 150) }}</p>

                <div class="tags">
                    @forelse($member->experties->take(3) as $expertise)
                        <span>{{ $expertise->heading }}</span>
                    @empty
                    @endforelse
                </div>
            </div>

            <div class="view-profile-box mt-auto">
                <a href="{{ route('teamdetails', $member) }}" class="view-profile">
                    View Profile <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="border rounded-3 bg-white p-4 text-muted">No core team members have been added yet.</div>
    </div>
@endforelse
        </div>
    </div>
</section>

<section class="experts-section">
    <div class="container experts-container">
        
        <div class="experts-top">
            <div class="experts-tag">
                <span class="line"></span>
                OUR EXPERTS
            </div>
            <h2>The right expert, <span>for the right problem</span></h2>
            <p>
                TRACE works with a network of senior domain experts — professors, former government officials, 
                international trade lawyers, and sector specialists — who we bring in their knowledge 
                when a project demands their specific depth.
            </p>
        </div>

       <div class="row g-4 experts-grid">
    @forelse($advisors as $index => $expert)
    <div class="col-xl-6 col-lg-12">
        {{-- কার্ডের মেইন কন্টেইনারে position-relative যোগ করা হয়েছে --}}
        <div class="expert-card position-relative">
            
            {{-- এই অ্যাঙ্কর ট্যাগটি পুরো কার্ডকে ক্লিকেবল করবে --}}
            <a href="{{ route('teamdetails', $expert) }}" class="stretched-link"></a>

            <div class="expert-left">
                <img src="{{ $expert->imageUrl() ?: asset('assets/img/michael.png') }}" alt="{{ $expert->fullName() }}">
                
                {{-- সোশ্যাল লিঙ্কগুলোর z-index বাড়িয়ে দেওয়া হয়েছে যাতে stretched-link এর ওপর কাজ করে --}}
                <div class="leader-social position-relative" style="z-index: 2;">
                    @forelse($expert->socialMedia->take(2) as $social)
                        <a href="{{ $social->social_link ?: '#' }}" target="_blank" rel="noopener">
                            @if($social->iconUrl())
                                <img src="{{ $social->iconUrl() }}" alt="{{ $social->title ?: 'social' }}" style="width: 14px; height: 14px; object-fit: contain;">
                            @else
                                <i class="fa-solid fa-link"></i>
                            @endif
                        </a>
                    @empty
                        {{-- সোশ্যাল না থাকলে খালি থাকবে --}}
                    @endforelse
                </div>
            </div>

            <div class="expert-right">
                <span class="expert-badge {{ $badgeClasses[$index % count($badgeClasses)] }}">{{ $expertLabels[$index % count($expertLabels)] }}</span>
                <h4>{{ $expert->fullName() }}</h4>
                <p class="role">{{ $expert->designation ?? '' }}</p>
                <p class="desc">{{ \Illuminate\Support\Str::limit(stripPTags($expert->description), 110) }}</p>
                <div class="expert-tags">
                    @forelse($expert->experties->take(3) as $expertise)
                        <span>{{ $expertise->heading }}</span>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @empty
        <div class="col-12">
            <div class="border rounded-3 bg-white p-4 text-muted">No expert profiles have been added yet.</div>
        </div>
    @endforelse
</div>

    </div>
</section>

@include('frontend.layout.cta')
@endsection