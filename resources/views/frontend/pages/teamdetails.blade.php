@extends('frontend.layout.app')

@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
/* Custom Container for 1072px width */
.custom-container {
    max-width: 1012px !important;
    margin: 0 auto;
}


/* ================= BREADCRUMB ================= */
.service-breadcrumb {
    width: 100%;
    height: 43px;
    background: #F8F9FB;
    border-bottom: 1px solid #E5E9ED;
}

.breadcrumb-item, .breadcrumb-item a {
    font-family: "Inter", sans-serif;
    font-size: 13px;
    color: #94A3B8;
    text-decoration: none;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: #CBD5E1;
}

.breadcrumb-item.active {
    color: #0F172A;
    font-weight: 500;
}

/* ================= HERO SECTION ================= */
.team-hero {
    background: #01354B;
    padding: 80px 0;
    min-height: 512px;
}

.team-image-box {
    width: 340px;
    height: 440px;
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    background: linear-gradient(155.69deg, rgba(1, 53, 75, 0.0288) 15.56%, rgba(1, 53, 75, 0.0592) 75.7%);
}

.team-image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.team-role {
    position: absolute;
    bottom: 0;
    width: 100%;
    background: #01979B;
    color: #fff;
    text-align: center;
    padding: 12px 0;
    font-size: 13px;
    font-family: "Inter", sans-serif;
    letter-spacing: 1px;
    font-weight: 600;
}

/* ================= CONTENT SPACING ================= */
.profile-name {
    font-family: "Sora", sans-serif;
    font-size: 48px;
    line-height: 56px;
    margin-bottom: 15px;
}

@media (min-width: 992px) {
    .ps-lg-5 {
        padding-left: 60px !important;
    }
}

.team-tag .line {
    width: 20px;
    height: 2px;
    background: #F47735;
    margin-right: 10px;
}

.tag-text {
    font-size: 12px;
    letter-spacing: 2px;
    color: #4DC0C4;
    font-weight: 600;
}

.sub-title {
    font-family: "DM Sans", sans-serif;
    font-size: 18px;
    color: #4DC0C4;
}

.team-location {
    font-family: "DM Sans", sans-serif;
    font-size: 15px;
    color: #9FB3BD;
}

.badge-custom {
    background: rgba(11, 74, 94, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #CCE7EA;
    padding: 6px 14px;
    border-radius: 100px;
    font-size: 12px;
}

.btn-social, .btn-email {
    padding: 6px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    box-shadow: none !important;
}

.btn-social {
    border: 0.3px solid rgba(255, 255, 255, 0.3);
    color: #000000;
    background: #ffffff;
    font-weight: 700;
}

.btn-social:hover {
    background: #F47735 !important;
    border-color: #F47735 !important;
    color: #fff !important;
    transform: translateY(-2px);
}

.btn-email {
    border: 0.3px solid rgba(255, 255, 255, 0.3);
    color: #000000;
    background: #ffffff;
    font-weight: 700;
}

.btn-email:hover {
    background: #F47735 !important;
    border-color: #F47735 !important;
    color: #fff !important;
    transform: translateY(-2px);
}

.custom-container-1080 {
    max-width: 1080px !important;
    margin: 0 auto;
}

.about-title-box {
    display: flex;
    align-items: center;
    gap: 12px;
}

.orange-line {
    width: 4px;
    height: 24px;
    background: #F47735;
    display: inline-block;
    border-radius: 2px;
}

.section-heading {
    font-family: 'Sora', sans-serif;
    font-size: 24px;
    color: #0F172A;
    margin: 0;
}

.about-description{
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    line-height: 1.7;
    color: #475569;
    margin-bottom: 20px;
    text-align: justify;
}

.expertise-card {
    background: #FFFFFF;
    border: 1px solid #E5E9ED;
    border-radius: 16px;
    padding: 20px;
    height: 100%;
    transition: 0.3s;
}

.expertise-card:hover {
    border-color: #01354B;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.icon-box-small {
    width: 40px;
    height: 40px;
    background: #EBF7F7;
    color: #01888C;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 18px;
}

.card-text h6 {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #0F172A;
}

.card-text p {
    font-size: 12px;
    color: #64748B;
    margin: 0;
    line-height: 1.4;
    text-align: justify;
}

.sidebar-container {
    position: sticky;
    top: 20px;
}

.cta-card {
    background: #01354B;
    border-radius: 20px;
    padding: 35px 25px;
}

.btn-orange {
    background: #F47735 !important;
    border: none !important;
    color: white !important;
    padding: 12px !important;
    border-radius: 50px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: none !important;
}

.btn-orange:focus,
.btn-orange:focus-visible,
.btn-orange:active {
    box-shadow: none !important;
    outline: none !important;
}

.btn-orange:hover {
    background: #d9632a !important;
    transform: translateY(-2px);
}

.other-team-card {
    border: 1px solid #E5E9ED;
    border-radius: 20px;
    padding: 24px;
}

.team-sidebar-item {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    padding: 12px 0;
    transition: 0.2s;
}

.member-img {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
}

.view-all-icon {
    width: 44px;
    height: 44px;
    background: #F1F5F9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748B;
}

.member-info h6 {
    font-size: 14px;
    margin: 0;
    color: #0F172A;
    font-weight: 600;
}

.member-info span {
    font-size: 11px;
    color: #94A3B8;
}

.arrow-icon {
    margin-left: auto;
    color: #CBD5E1;
    font-size: 14px;
}

@media (max-width: 991px) {
    .team-image-box { width: 300px; height: 388px; }
    .profile-name { font-size: 36px; line-height: 42px; }
    .sidebar-container { margin-top: 40px; }
}
</style>
@endpush


@section('content')

@php
    $teamName        = $team->fullName()        ?? '';
    $teamImage       = $team->imageUrl()        ?? '';
    $teamDesignation = $team->designation       ?? '';
    $teamDescription = stripPTags($team->description);
    $descriptionParagraphs = collect(preg_split('/\n\s*\n/', (string) $teamDescription))
        ->map(fn ($paragraph) => trim($paragraph))
        ->filter();

    $expertiseItems = $team->experties->take(6);
    $socialItems = $team->socialMedia;
@endphp

<section class="service-breadcrumb d-flex align-items-center">
    <div class="container custom-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('team') }}">Our Team</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $teamName }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="team-hero">
    <div class="container custom-container">
        <div class="row align-items-center gap-lg-5">

            <div class="col-lg-auto d-flex justify-content-center mb-4 mb-lg-0">
                <div class="team-image-box">
                    <img src="{{ $teamImage }}" alt="{{ $teamName }}">
                    <div class="team-role text-uppercase">
                        {{ $teamDesignation }}
                    </div>
                </div>
            </div>

            <div class="col-lg-7 text-center text-md-start ps-lg-5">
                <div class="team-content">
                    <div class="team-tag d-flex align-items-center justify-content-center justify-content-md-start">
                        <span class="line"></span>
                        <span class="tag-text">TEAM MEMBER</span>
                    </div>

                    <h1 class="profile-name fw-bold text-white">{{ $teamName }}</h1>

                    <h5 class="sub-title mb-2">{{ $teamDesignation }}</h5>

                    <p class="team-location mb-4">
                        Trace Consulting. Dhaka, Bangladesh
                    </p>

                    <div class="team-tags d-flex flex-wrap justify-content-center justify-content-md-start gap-2 mb-4">
                        @foreach($expertiseItems as $expertise)
                            <span class="badge-custom">{{ $expertise->heading }}</span>
                        @endforeach
                    </div>

                    {{-- Social Media & Email Part --}}
                    <div class="team-social d-flex flex-wrap justify-content-center justify-content-md-start gap-3">
                        @foreach($socialItems as $social)
                            @php
                                $title = trim((string)$social->title);
                                $originalLink = trim((string)$social->social_link);

                                // ইমেইল কিনা চেক করার লজিক
                                $isEmail = str_contains(strtolower($title), 'email') ||
                                           filter_var($originalLink, FILTER_VALIDATE_EMAIL);

                                // যদি ইমেইল হয় এবং mailto: না থাকে, তবে mailto: যোগ করবে
                                if ($isEmail && !str_starts_with(strtolower($originalLink), 'mailto:')) {
                                    $socialUrl = 'mailto:' . $originalLink;
                                } else {
                                    $socialUrl = $originalLink ?: '#';
                                }

                                $iconPath = $social->iconUrl();
                            @endphp

                            @if(!empty($title) || $iconPath)
                                <a href="{{ $socialUrl }}"
                                   class="{{ $isEmail ? 'btn-email' : 'btn-social' }}"
                                   @if(!$isEmail) target="_blank" @endif
                                   rel="noopener"
                                   style="display: inline-flex; align-items: center; gap: 8px;">

                                    @if($iconPath)
                                        <img src="{{ $iconPath }}" alt="{{ $title }}" style="width: 18px; height: 18px; object-fit: contain;">
                                    @endif

                                    @if(!empty($title))
                                        {{ $title }}
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="about-section py-4">
    <div class="container custom-container-1080">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="about-left-content">
                    <div class="about-title-box mb-4">
                        <span class="orange-line"></span>
                        <h3 class="fw-bold section-heading">About {{ rtrim($team->first_name ?: $teamName, '.') }}</h3>
                    </div>

                    <div class="about-description">
                        {!! $team->description !!}
                    </div>

                    <div class="expertise-section mt-4">
                        <div class="about-title-box mb-4">
                            <span class="orange-line"></span>
                            <h3 class="fw-bold section-heading">Areas of Expertise</h3>
                        </div>

                        <div class="row g-3">
                            @forelse($expertiseItems as $expertise)
                                <div class="col-md-6">
                                    <div class="expertise-card d-flex gap-3">
                                        <div class="icon-box-small">
                                            @if($expertise->iconUrl())
                                                <img src="{{ $expertise->iconUrl() }}" alt="{{ $expertise->heading ?? '' }}" style="width: 20px; height: 20px; object-fit: contain;">
                                            @else
                                                <i class="fas fa-check"></i>
                                            @endif
                                        </div>
                                        <div class="card-text">
                                            <h6>{{ $expertise->heading ?? '' }}</h6>
                                            <p>{{ $expertise->description ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="border rounded-3 bg-white p-4 text-muted">No expertise details have been added yet.</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <aside class="sidebar-container">
                    <div class="cta-card text-center text-white mb-4">
                        <div class="cta-icon-box mx-auto mb-3">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                <path d="M4 6h16M4 12h16M4 18h10" stroke="#fff" stroke-width="2" />
                            </svg>
                        </div>
                        <h5 class="fw-bold">Work with Our Team</h5>
                        <p class="small opacity-75">Reach out to discuss how TRACE can support your institution's trade reform objectives.</p>
                        <a href="{{ route('contact') }}" class="btn btn-orange w-100 mt-2">Get in Touch <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>

                    <div class="other-team-card">
                        <h6 class="fw-bold mb-4">Other Team Members</h6>
                        @foreach($otherTeamMembers as $member)
                            <a href="{{ route('teamdetails', $member) }}" class="team-sidebar-item">
                                <img src="{{ $member->imageUrl() ?? '' }}" class="member-img" alt="{{ $member->fullName() }}">
                                <div class="member-info">
                                    <h6>{{ $member->fullName() }}</h6>
                                    <span>{{ $member->designation ?? '' }}</span>
                                </div>
                                <i class="bi bi-arrow-right arrow-icon"></i>
                            </a>
                        @endforeach

                        <hr class="my-3 opacity-10">

                        <a href="{{ route('team') }}" class="team-sidebar-item view-all-link">
                            <div class="view-all-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM23 21V19C22.9993 18.1137 22.7044 17.2524 22.1614 16.5523C21.6184 15.8522 20.8581 15.3516 20 15.13M19 3.13C19.8604 3.35031 20.623 3.85071 21.1676 4.55232C21.7122 5.25392 22.0078 6.11768 22.0078 7.005C22.0078 7.89232 21.7122 8.75608 21.1676 9.45768C20.623 10.1593 19.8604 10.6597 19 10.88" stroke="#01888C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="member-info">
                                <h6 class="mb-0">View Full Team</h6>
                                <span class="small">All {{ $allTeamMembersCount }} team members</span>
                            </div>
                            <i class="bi bi-arrow-right arrow-icon"></i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@endsection
