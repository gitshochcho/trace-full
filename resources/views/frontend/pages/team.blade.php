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
    box-shadow: 0px 8px 40px 0px rgba(1, 53, 75, 0.13); /* আপনার দেওয়া শ্যাডো */
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
.social-links a:hover { background: #01354B; color: #fff; }
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
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
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

   
    .team-content {
        padding: 24px;
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
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #F1F5F9;
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

<nav class="service-breadcrumb">
    <div class="custom-container">
        <div class="breadcrumb-links">
            <a href="\">Home</a>
            <span class="sep">›</span>
            <span class="active">Our Team</span>
        </div>
    </div>
</nav>

<section class="experts-hero">
    <div class="custom-container"> <div class="row">
            <div class="col-lg-7 text-start"> 
                <div class="hero-content-wrapper ms-0"> <div class="hero-tag">
                        <span class="orange-line-hero"></span> THE PEOPLE BEHIND THE WORK
                    </div>
                    <h1 class="hero-title">Experts who <br> <span>drive change.</span></h1>
                    <p class="hero-desc">
                        TRACE brings together a permanent core team of trade specialists, researchers, and technologists — supported by a network of domain experts engaged on specific projects and engagements.
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
                        <img src="{{ asset('assets/img/fuad.png') }}" alt="Fuad M Khalid Hossen">
                        <span class="leader-badge">MD & CEO</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="leader-info">
                        <h3 class="name">Fuad M Khalid Hossen</h3>
                        <p class="role">Managing Director & Chief Executive Officer</p>
                        <p class="company">Trace Consulting Limited · Dhaka, Bangladesh</p>
                        
                        <div class="orange-divider"></div>
                        
                        <p class="bio">
                            Fuad brings over 15 years of hands-on experience in trade facilitation, customs modernisation, and development consulting across South and Southeast Asia. He holds an official MoU with B-ADVANCY Certification Ltd, UK, and has personally led WTO TFA implementation advisory, ISO/IEC 17025 laboratory accreditation programmes, and digital trade infrastructure projects across the region.
                        </p>

                        <div class="skill-tags">
                            <span>Trade Facilitation</span>
                            <span>WTO TFA</span>
                            <span>Customs Reform</span>
                            <span>Policy</span>
                            <span>Lab Accreditation</span>
                            <span>Digital Trade</span>
                        </div>

                        <div class="leader-card-footer">
                            <div class="social-links">
                                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                <a href="#"><i class="fa-regular fa-envelope"></i></a>
                            </div>
                            <a href="/teamdetails" class="btn-profile">View Full Profile →</a>
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
            @php
                $team = [
                    [
                        'name' => 'ASM Saifullah',
                        'role' => 'Senior Trade Policy Specialist',
                        'sub' => 'Trade Facilitation & Policy',
                        'desc' => '10+ years advising governments
and development agencies on
WTO compliance, trade policy…',
                        'img' => 'assets/img/saifullah.png',
                        'tags' => ['WTO TFA', 'Policy Reform', 'Advocacy']
                    ],
                    [
                        'name' => 'Tahsina Shiva',
                        'role' => 'Technology Solutions Lead',
                        'sub' => 'Digital & Tech Systems',
                        'desc' => 'Full-stack developer and systems
architect specialising in LIMS,
trade single window platforms,…
and customs automation for
government agencies.',
                        'img' => 'assets/img/Shiva.png',
                        'tags' => ['LIMS', 'Single Window', 'Systems']
                    ],
                    [
                        'name' => 'Nabeel Khan',
                        'role' => 'Laboratory Quality Specialist',
                        'sub' => 'Laboratory Services',
                        'desc' => 'ISO/IEC 17025 accreditation
expert guiding public and private
laboratories through QMS…
development and assessment
preparation.',
                        'img' => 'assets/img/nabeel.png',
                        'tags' => ['ISO 17025', 'QMS', 'Accreditation']
                    ],
                    [
                        'name' => 'Md. Mahbubul Alam',
                        'role' => 'Research & Assessments Lead',
                        'sub' => 'Research & Evaluation',
                        'desc' => 'Economist and trade researcher
with expertise in trade facilitation
assessments, value chain…
analysis, and M&E framework
development.',
                        'img' => 'assets/img/mahbub.png',
                        'tags' => ['Research', 'M&E', 'Economics']
                    ],
                    [
                        'name' => 'Tanvir Kabir',
                        'role' => 'Capacity Building Coordinator',
                        'sub' => 'Training & Development',
                        'desc' => 'Training design and facilitation specialist delivering programmes for customs officials, lab technicians, and private sector',
                        'img' => 'assets/img/tanvir.png',
                        'tags' => ['Training', 'Facilitation', 'Curriculum']
                    ],
                    [
                        'name' => 'Mobarak Uddin Ahmed',
                        'role' => 'Cold Chain & Logistics Specialist',
                        'sub' => 'Supply Chain Systems',
                        'desc' => 'Temperature-controlled logistics
expert advising exporters and
pharmaceutical companies on…
cold chain infrastructure and',
                        'img' => 'assets/img/mobarak.png',
                        'tags' => ['Cold Chain', 'Logistics', 'Compliance']
                    ],
                    [
                        'name' => 'Md. Mahmudur Rahman',
                        'role' => 'Project Manager',
                        'sub' => 'Project Management Office',
                        'desc' => 'PMP-certified project manager
overseeing multi-donor trade
reform engagements with a…
consistent track record of on-
time, on-budget delivery.',
                        'img' => 'assets/img/mahmud.png',
                        'tags' => ['PMP', 'Donor Reporting', 'RBM']
                    ],
                    [
                        'name' => 'Mimma Afrin',
                        'role' => 'Technical Lead, Laboratory Operations',
                        'sub' => 'Trade Information & Data',
                        'desc' => 'Data analyst and portal developer
specialising in HS code
databases, trade transparency…',
                        'img' => 'assets/img/mimma.png',
                        'tags' => ['Data Systems', 'HS Codes', 'Portal Dev']
                    ]
                    
                ];
            @endphp

@foreach($team as $member)
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="team-card h-100 shadow-sm">
            <div class="team-img-box">
                <img src="{{ asset($member['img']) }}" alt="{{ $member['name'] }}">
                
                <div class="team-social">
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" title="Email"><i class="far fa-envelope"></i></a>
                </div>
            </div>
            
            <div class="team-content">
                <h4 class="name">{{ $member['name'] }}</h4>
                <h5 class="role">{{ $member['role'] }}</h5>
                <span class="sub">{{ $member['sub'] }}</span>
                <div class="divider"></div>
                <p class="bio">{{ $member['desc'] }}</p>
                <div class="tags">
                    @foreach($member['tags'] as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach
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

       @php
    $experts = [
        [
            'name' => 'Michael J Parr',
            'role' => 'Trade Economics & WTO Law Specialist',
            'badge' => 'ADVISORY',
            'badge_class' => 'orange',
            'img' => 'assets/img/michael.png',
            'desc' => 'Former WTO dispute settlement consultant with 20+ years of expertise in trade law, multilateral negotiations, and TFA implementation advisory across LDCs.',
            'tags' => ['WTO Law', 'Trade Economics', 'LDC Policy']
        ],
        [
            'name' => 'Nittya Ranjan Biswas',
            'role' => 'Aquaculture and Sanitary Compliance Systems',
            'badge' => 'TECHNICAL EXPERT',
            'badge_class' => 'cyan',
            'img' => 'assets/img/nittya.png',
            'desc' => 'ISO/IEC 17025 lead assessor with 18 years of QMS implementation and food safety testing expertise. Supports TRACE\'s laboratory accreditation projects.',
            'tags' => ['ISO 17025', 'Food Safety', 'QMS']
        ],
        [
            'name' => 'Syed Rezaul Karim',
            'role' => 'Customs Reform & Modernisation Specialist',
            'badge' => 'ADVISORY',
            'badge_class' => 'orange',
            'img' => 'assets/img/Syed.png',
            'desc' => 'Retired senior customs official with 25 years of operational experience at the National Board of Revenue. Advises TRACE on practical customs reform implementation.',
            'tags' => ['Customs', 'NBR Systems', 'Risk Mgmt']
        ],
        [
            'name' => 'Dr. Tahmina Akter',
            'role' => 'Development Economics & M&E Specialist',
            'badge' => 'RESEARCH EXPERT',
            'badge_class' => 'blue',
            'img' => 'assets/img/tahmina.png',
            'desc' => 'Specialises in results-based evaluation of trade and development programmes. Leads TRACE\'s monitoring, evaluation, and research assessment work.',
            'tags' => ['Development Economics', 'M&E', 'Impact Evaluation']
        ],
        [
            'name' => 'Kazi Mahbubur Rahman',
            'role' => 'Cold Chain Infrastructure & Logistics Specialist',
            'badge' => 'PROJECT EXPERT',
            'badge_class' => 'cyan',
            'img' => 'assets/img/kazi.png',
            'desc' => '30 years of private sector experience in agricultural supply chains and refrigerated logistics. Advises TRACE on infrastructure projects for agro-exporters.',
            'tags' => ['Cold Chain', 'Agro-Export', 'Supply Chain']
        ],
        [
            'name' => 'Dr. Imran Chowdhury',
            'role' => 'Digital Trade & e-Government Systems Expert',
            'badge' => 'ADVISORY',
            'badge_class' => 'orange',
            'img' => 'assets/img/imran.png',
            'desc' => 'Expert in e-government system architecture and digital trade platform design. Advises TRACE on technical specifications for single window and LIMS projects.',
            'tags' => ['e-Government', 'Single Window', 'System Design']
        ]
    ];
@endphp

        <div class="row g-4 experts-grid">
            @foreach($experts as $expert)
            <div class="col-xl-6 col-lg-12">
                <div class="expert-card">
                    <div class="expert-left">
                        <img src="{{ asset($expert['img']) }}" alt="{{ $expert['name'] }}">
                        <div class="leader-social">
                            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#"><i class="fa-regular fa-envelope"></i></a>
                        </div>
                    </div>

                    <div class="expert-right">
                        <span class="expert-badge {{ $expert['badge_class'] }}">{{ $expert['badge'] }}</span>
                        <h4>{{ $expert['name'] }}</h4>
                        <p class="role">{{ $expert['role'] }}</p>
                        <p class="desc">{{ Str::limit($expert['desc'], 110) }}</p>
                        <div class="expert-tags">
                            @foreach($expert['tags'] as $tag)
                                <span>{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@include('frontend.layout.cta')
@endsection