@extends('frontend.layout.app')


@push('custome-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
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

/* ================= UPDATED IMAGE BOX ================= */
.team-image-box {
    width: 340px;  /* Your specific width */
    height: 440px; /* Your specific height */
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    /* Your Gradient Background */
    background: linear-gradient(155.69deg, rgba(1, 53, 75, 0.0288) 15.56%, rgba(1, 53, 75, 0.0592) 75.7%);
}

.team-image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures image fills the 340x440 box nicely */
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

/* Push content slightly right on large screens */
@media (min-width: 992px) {
    .ps-lg-5 {
        padding-left: 60px !important; /* adjust this to move content even more right */
    }
}

/* Other Styles (Same as before but keeping it consistent) */
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
    padding: 8px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}

.btn-social {
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #fff;
}

.btn-social:hover {
    background: #01979B;
    border-color: #01979B;
}

.btn-email {
    background: #01979B;
    color: #fff;
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .team-image-box {
        width: 300px; /* scaling down slightly for tablet */
        height: 388px;
    }
    .profile-name {
        font-size: 36px;
        line-height: 42px;
    }
}

/* Container Fix */
.custom-container-1080 {
    max-width: 1080px !important;
    margin: 0 auto;
}

/* Titles */
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

.about-description p {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    line-height: 1.7;
    color: #475569;
    margin-bottom: 20px;
    text-align: justify;
}

/* Expertise Cards */
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

.icon-box-small svg {
    width: 20px;
    height: 20px;
    transition: transform 0.3s ease;
}

.expertise-card:hover .icon-box-small svg {
    transform: scale(1.1); /* হোভার করলে আইকন একটু বড় হবে */
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
}

/* Sidebar CTA */
.sidebar-container {
    position: sticky;
    top: 20px;
}

.cta-card {
    background: #01354B;
    border-radius: 20px;
    padding: 35px 25px;
}

.cta-icon-box {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}

.btn-orange {
    background: #F47735;
    border: none;
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
}

.btn-orange:hover {
    background: #d9632a;
    color: white;
}

/* Other Team Members Sidebar */
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

.team-sidebar-item:hover .arrow-icon {
    color: #F47735;
    transform: translateX(3px);
}

/* Responsive */
@media (max-width: 991px) {
    .sidebar-container { margin-top: 40px; }
}

</style>
@endpush


@section('content')

<section class="service-breadcrumb d-flex align-items-center">
    <div class="container custom-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Our Team</a></li>
                <li class="breadcrumb-item active" aria-current="page">Fuad M Khalid Hossen</li>
            </ol>
        </nav>
    </div>
</section>

<section class="team-hero">
    <div class="container custom-container">
        <div class="row align-items-center gap-lg-5">
            
            <div class="col-lg-auto d-flex justify-content-center mb-4 mb-lg-0">
                <div class="team-image-box">
                    <img src="{{ asset('assets/img/fuad.png') }}" alt="Fuad M Khalid Hossen">
                    <div class="team-role text-uppercase">
                        Managing Director & CEO
                    </div>
                </div>
            </div>

            <div class="col-lg-7 text-center text-md-start ps-lg-5">
                <div class="team-content">
                    <div class="team-tag d-flex align-items-center justify-content-center justify-content-md-start">
                        <span class="line"></span>
                        <span class="tag-text">TEAM MEMBER</span>
                    </div>

                    <h1 class="profile-name fw-bold text-white">Fuad M <br class="d-none d-md-block"> Khalid Hossen</h1>
                    
                    <h5 class="sub-title mb-2">Managing Director & Chief Executive Officer</h5>
                    
                    <p class="team-location mb-4">
                        Trace Consulting Limited · Dhaka, Bangladesh
                    </p>

                    <div class="team-tags d-flex flex-wrap justify-content-center justify-content-md-start gap-2 mb-4">
                        <span class="badge-custom">Trade Facilitation</span>
                        <span class="badge-custom">WTO TFA</span>
                        <span class="badge-custom">Customs Modernisation</span>
                        <span class="badge-custom">Policy Reform</span>
                        <span class="badge-custom">ISO/IEC 17025</span>
                        <span class="badge-custom">Digital Trade</span>
                    </div>

                    <div class="team-social d-flex flex-wrap justify-content-center justify-content-md-start gap-3">
                        <a href="#" class="btn-social">LinkedIn</a>
                        <a href="#" class="btn-social">Twitter</a>
                        <a href="mailto:example@trace.com" class="btn-email">Email</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="about-section py-5">
    <div class="container custom-container-1080">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="about-left-content">
                    <div class="about-title-box mb-4">
                        <span class="orange-line"></span>
                        <h3 class="fw-bold section-heading">About Fuad M.</h3>
                    </div>

                    <div class="about-description">
                        <p>Fuad M Khalid Hossen, currently serving as Managing Director and CEO of TRACE Consulting, is widely recognized as Bangladesh’s leading expert in digital trade facilitation and trade policy reform, with over 12 years of experience in system modernization, export-led growth, and regulatory reform. He has demonstrated strong technical leadership in advancing WTO Trade Facilitation Agreement (TFA) measures, trade service automation, and institutional capacity building across public and private sectors.</p>
                        
                        <p>Most recently, Fuad led the $32.4 million USDA-funded Bangladesh Trade Facilitation Project as Deputy Chief of Party and Technical Lead, driving national reforms to modernize cross-border trade with a focus on food and agriculture. He collaborated directly with over 50 public and private entities, including the Ministry of Commerce, National Board of Revenue, BSTI, DLS, DoF, DAE, trade-related laboratories, and other SPS and standards agencies, as well as FBCCI and several sectoral chambers.</p>

                        <p>Under his leadership, the project delivered more than 30 policy and regulatory reforms spanning Export and Import Policies, SPS and quarantine regulations, Customs rules, the TCL framework, and the Veterinary Drug Act. It also deployed 14 automated trade-service IT systems, enabling the digital issuance of over one million certificates, licenses, and permits (CLPs) annually. Fuad also supported the government in establishing seven specialized trade units and risk management systems, which are expected to replace blanket inspections with risk-based clearance across key border agencies. He helped upgrade 12 laboratories, including the establishment of the National Halal Laboratory at BSTI, and introduced over 10 export compliance protocols, covering contract farming automation, traceability, good production practices, national residue control plans, and e-health certification, to strengthen SPS compliance and export readiness. His leadership enabled government agencies to submit formal notifications to the WTO, enhancing transparency and reinforcing Bangladesh’s credibility within the multilateral trading system.</p>

                        <p>Earlier, as a Trade Facilitation Consultant with the IFC–World Bank Group, Fuad contributed to large-scale trade reform initiatives, including the Online Licensing Module (OLM) for CCI&E, the Bangladesh National Single Window, tariff reforms, and Customs modernization, initiatives that strengthened WTO TFA compliance and improved Bangladesh’s ease-of-doing-business ranking. He also played technical and leadership roles in multiple FCDO-funded programs, focusing on automation, export diversification, and regulatory simplification.</p>

                        <p>Fuad holds a Bachelor’s degree in Public Administration and a Master’s degree in Public Administration, specializing in Public Policy, from Jahangirnagar University. He is passionate about leveraging technology and policy innovation to enhance Bangladesh’s export competitiveness and strengthen the country’s integration into the global trading system.</p>
                    </div>

                    <div class="expertise-section mt-5">
                        <div class="about-title-box mb-4">
                            <span class="orange-line"></span>
                            <h3 class="fw-bold section-heading">Areas of Expertise</h3>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="expertise-card d-flex gap-3">
                                    <div class="icon-box-small"><i class="bi bi-buildings"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M2 20V4C2 3.44772 2.44772 3 3 3H9C9.55228 3 10 3.44772 10 4V20M2 20H22M2 20V21C2 21.5523 2.44772 22 3 22H21C21.5523 22 22 21.5523 22 21V10C22 9.44772 21.5523 9 21 9H10M14 13H18M14 17H18" stroke="#01888C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></i></div>
                                    
                                    <div class="card-text">
                                        <h6>Trade Facilitation & Customs</h6>
                                        <p>WTO TFA implementation, customs automation, risk management, AEO programmes.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-card d-flex gap-3">
                                    <div class="icon-box-small"><i class="bi bi-file-earmark-text"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M9 12H15M9 16H13M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H12.5858C12.851 3 13.1054 3.10536 13.2929 3.29289L18.7071 8.70711C18.8946 8.89464 19 9.149 19 9.41421V19C19 20.1046 18.1046 21 17 21Z" stroke="#01888C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></i></div>
                                    <div class="card-text">
                                        <h6>Policy Reform & Advocacy</h6>
                                        <p>Legislative review, policy gap analysis, stakeholder consultation.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-card d-flex gap-3">
                                    <div class="icon-box-small"><i class="bi bi-vial"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M9 3H15M10 9H14M3 20L9 3M21 20L15 3M3 20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20" stroke="#01888C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></i></div>
                                    <div class="card-text">
                                        <h6>Laboratory Accreditation</h6>
                                        <p>ISO/IEC 17025 QMS development, gap analysis, accreditation support.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-card d-flex gap-3">
                                    <div class="icon-box-small"><i class="bi bi-laptop"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect x="2" y="3" width="20" height="14" rx="2" stroke="#01888C" stroke-width="2"/>
  <path d="M8 21H16M12 17V21M7 8L10 11L17 4" stroke="#01888C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></i></div>
                                    <div class="card-text">
                                        <h6>Digital Trade Systems</h6>
                                        <p>Single window development, LIMS, trade transparency portals.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-card d-flex gap-3">
                                    <div class="icon-box-small"><i class="bi bi-people"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM23 21V19C22.9993 18.1137 22.7044 17.2524 22.1614 16.5523C21.6184 15.8522 20.8581 15.3516 20 15.13M19 3.13C19.8604 3.35031 20.623 3.85071 21.1676 4.55232C21.7122 5.25392 22.0078 6.11768 22.0078 7.005C22.0078 7.89232 21.7122 8.75608 21.1676 9.45768C20.623 10.1593 19.8604 10.6597 19 10.88" stroke="#01888C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></i></div>
                                    <div class="card-text">
                                        <h6>Capacity Building</h6>
                                        <p>Training design, programme facilitation, e-learning development.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="expertise-card d-flex gap-3">
                                    <div class="icon-box-small"><i class="bi bi-graph-up-arrow"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M21 21L15.8033 15.8033M15.8033 15.8033C17.1605 14.4461 18 12.5711 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18C12.5711 18 14.4461 17.1605 15.8033 15.8033ZM7 11L9 13L13 9" stroke="#01888C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></i></div>
                                    <div class="card-text">
                                        <h6>Research & Assessment</h6>
                                        <p>Trade facilitation needs assessments, economic impact evaluation.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <aside class="sidebar-container">
                    <div class="cta-card text-center text-white mb-4">
                        <div class="cta-icon-box mx-auto mb-3">
                            <i class="bi bi-chat-dots-fill"> <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <path d="M4 6h16M4 12h16M4 18h10" stroke="#fff" stroke-width="2" />
                        </svg></i>
                        </div>
                        <h5 class="fw-bold">Work with Our Team</h5>
                        <p class="small opacity-75">Reach out to discuss how TRACE can support your institution's trade reform objectives.</p>
                        <a href="#" class="btn btn-orange w-100 mt-2">Get in Touch <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>

                    <div class="other-team-card">
                        <h6 class="fw-bold mb-4">Other Team Members</h6>
                        
                        <a href="#" class="team-sidebar-item">
                            <img src="{{ asset('assets/img/nadia.png') }}" class="member-img" alt="Nadia">
                            <div class="member-info">
                                <h6>Nadia Rahman</h6>
                                <span>Senior Trade Policy Specialist</span>
                            </div>
                            <i class="bi bi-arrow-right arrow-icon"></i>
                        </a>

                        <a href="#" class="team-sidebar-item">
                            <img src="{{ asset('assets/img/arif.png') }}" class="member-img" alt="Arif">
                            <div class="member-info">
                                <h6>Arif Hossain</h6>
                                <span>Technology Solutions Lead</span>
                            </div>
                            <i class="bi bi-arrow-right arrow-icon"></i>
                        </a>

                        <a href="#" class="team-sidebar-item">
                            <img src="{{ asset('assets/img/tasnim.png') }}" class="member-img" alt="Tasnim">
                            <div class="member-info">
                                <h6>Tasnim Akter</h6>
                                <span>Laboratory Quality Specialist</span>
                            </div>
                            <i class="bi bi-arrow-right arrow-icon"></i>
                        </a>

                        <hr class="my-3 opacity-10">

                        <a href="#" class="team-sidebar-item view-all-link">
                            <div class="view-all-icon"><i class="bi bi-people"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM23 21V19C22.9993 18.1137 22.7044 17.2524 22.1614 16.5523C21.6184 15.8522 20.8581 15.3516 20 15.13M19 3.13C19.8604 3.35031 20.623 3.85071 21.1676 4.55232C21.7122 5.25392 22.0078 6.11768 22.0078 7.005C22.0078 7.89232 21.7122 8.75608 21.1676 9.45768C20.623 10.1593 19.8604 10.6597 19 10.88" stroke="#01888C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></i></div>
                            <div class="member-info">
                                <h6 class="mb-0">View Full Team</h6>
                                <span class="small">All 8 team members</span>
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