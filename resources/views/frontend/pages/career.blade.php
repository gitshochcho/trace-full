@extends('frontend.layout.app')

@push('custome-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
    /* TRACE Careers Custom Styles */
    :root {
        --dark-navy: #002d3a;
        --trace-cyan: #00bfc5;
        --trace-orange: #e85d26;
        --bg-gray: #f8fafc;
        --text-slate: #334155;
    }

    .careers-wrapper {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: #fff;
    }

    /* Hero Section */
    .hero-career {
        background-color: var(--dark-navy);
        color: #ffffff;
        padding: 80px 0;
    }
    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: var(--trace-orange);
        margin-bottom: 15px;
    }
    .hero-label::before {
        content: "";
        display: inline-block;
        width: 30px;
        height: 2px;
        background: var(--trace-orange);
    }
    .hero-career h1 {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 25px;
    }
    .hero-career h1 .highlight { color: var(--trace-cyan); }
    .hero-desc {
        font-size: 18px;
        line-height: 1.6;
        max-width: 800px;
        opacity: 0.85;
    }

    /* Sidebar Styling */
    .section-label {
        color: var(--trace-cyan);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    .sidebar-title {
        font-size: 32px;
        font-weight: 800;
        color: var(--dark-navy);
    }
    .sidebar-title .highlight { color: var(--trace-cyan); }
    
    .filter-section { margin-top: 40px; }
    .filter-title {
        font-size: 11px;
        font-weight: 700;
        color: #94a3b8;
        margin-bottom: 15px;
    }
    .filter-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 8px;
        cursor: pointer;
        transition: 0.3s;
    }
    .filter-item:hover { background: #f1f5f9; }
    .filter-item.active {
        background-color: #fff4ed;
        color: var(--dark-navy);
    }
    .filter-item .count {
        background: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 12px;
        color: #64748b;
        transition: background .2s, color .2s;
    }
    .filter-item.active .count {
        background: #fff;
        color: var(--trace-orange);
    }

    .cv-box {
        background-color: var(--dark-navy);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-top: 40px;
    }
    .cv-box h4 { font-weight: 700; margin-bottom: 15px; }
    .cv-box p { font-size: 14px; opacity: 0.8; margin-bottom: 20px; }
    .btn-cv {
        background: var(--trace-orange);
        border: none;
        color: white;
        font-weight: 700;
        padding: 10px 25px;
        border-radius: 50px;
        width: 100%;
    }

    .page-align-container { max-width: 1072px; margin: 0 auto; }

    /* Job Card Styling */
    .job-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 35px;
        margin-bottom: 24px;
        transition: 0.3s;
    }
    .job-card:hover { border-color: var(--trace-cyan); box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    
    .tag {
        font-size: 10px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 4px;
        margin-right: 8px;
    }
    .tag-fulltime { background: #e6f4f4; color: var(--trace-teal); }
    .tag-location { background: #f1f5f9; color: #64748b; }
    .tag-contract { background: #fff7ed; color: #c2410c; }
    .tag-hybrid { background: #f0fdf4; color: #15803d; }

    .btn-apply {
        background-color: var(--dark-navy);
        color: white;
        border-radius: 50px;
        padding: 8px 24px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }
    .btn-apply:hover { background-color: var(--trace-orange); }

    .job-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--dark-navy);
        margin: 15px 0 5px 0;
    }
    .job-dept {
        color: var(--trace-cyan);
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 15px;
    }
    .job-desc {
        color: #64748b;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 25px;
    }
    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        border-top: 1px solid #f1f5f9;
        padding-top: 20px;
        color: #94a3b8;
        font-size: 13px;
    }
    .meta-item i { margin-right: 8px; }

    @media (max-width: 991px) {
        .hero-career h1 { font-size: 32px; }
        .careers-sidebar { margin-bottom: 50px; }
    }

    /* Modal Improvements */
.modal-content {
    background-color: #ffffff;
}
#applicationForm .form-control:focus {
    background-color: #fff !important;
    box-shadow: 0 0 0 4px rgba(0, 191, 197, 0.1);
    border-color: var(--trace-cyan);
}
.border-dashed {
    transition: 0.3s;
}
.border-dashed:hover {
    border-color: var(--trace-cyan) !important;
    background-color: #f1f5f9 !important;
}
#phone {
    padding-left: 52px !important; 
}

#applicationForm input:not(#phone) {
    padding-left: 15px !important; 
}

.iti { width: 100% !important; }
.iti__flat-list { max-height: 200px; }
#applicationForm .form-control:focus {
    background-color: #fff !important;
    box-shadow: 0 0 0 4px rgba(0, 191, 197, 0.1);
    border-color: var(--trace-cyan);
}
.form-control.form-control-lg {
    padding-left: 50px !important; 
}
</style>
@endpush

@section('content')
<nav class="service-breadcrumb">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="breadcrumb-links">
            <a href="\">Home</a>
            <span class="sep">›</span>
            <span class="active">Careers</span>
        </div>
    </div>
</nav>

<div class="careers-wrapper">
    <section class="hero-career">
        <div class="container-fluid px-lg-5 page-align-container">
            <div class="hero-label">CAREER AT</div>
            <h1>Career at <span class="highlight">Trace Consultancy</span></h1>
            <p class="hero-desc">TRACE is a growing team of trade specialists, researchers, technologists, and project managers working on some of the most consequential reform programmes in South Asia. We're looking for people who want their work to matter.</p>
        </div>
    </section>

    <div class="container-fluid px-lg-5 page-align-container py-5 my-lg-5">
        <div class="row g-lg-5">
            <aside class="col-lg-4 careers-sidebar">
                <div class="sidebar-section">
                    <div class="section-label">OPEN POSITIONS</div>
                    <h2 class="sidebar-title">Current <span class="highlight">Openings</span></h2>
                    <p class="text-muted mt-3">We hire on a rolling basis. Roles span consultancy, research, technology, and project management.</p>
                </div>

                <div class="filter-section">
                    <div class="filter-title">FILTER BY TYPE</div>
                    <div class="filter-item active" data-filter="all">
                        <span>All Roles</span>
                        <span class="count">5</span>
                    </div>
                    <div class="filter-item" data-filter="fulltime">
                        <span>Full-Time</span>
                        <span class="count">3</span>
                    </div>
                    <div class="filter-item" data-filter="contract">
                        <span>Contract</span>
                        <span class="count">2</span>
                    </div>
                </div>

                <div class="cv-box">
                    <h4>Don't see your role?</h4>
                    <p>Send us your CV and we'll reach out when the right opportunity comes up.</p>
                    <button class="btn-cv">Send Your CV</button>
                </div>
            </aside>

            <div class="col-lg-8 job-listings">
                
                <div class="job-card" data-type="fulltime">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="job-tags">
                            <span class="tag tag-fulltime">FULL-TIME</span>
                            <span class="tag tag-location">DHAKA</span>
                        </div>
                        <button class="btn-apply d-none d-md-block">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                    <h3 class="job-title">Trade Facilitation Consultant</h3>
                    <div class="job-dept">Trade & Policy Division</div>
                    <p class="job-desc">We are looking for an experienced trade facilitation consultant to support our growing portfolio of WTO TFA implementation, customs modernisation, and border management reform projects across South Asia.</p>
                    <div class="job-meta">
                        <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</div>
                        <div class="meta-item"><i class="far fa-calendar"></i> Posted April 2025</div>
                        <div class="meta-item"><i class="far fa-clock"></i> 3-5 years experience</div>
                    </div>
                    <button class="btn-apply w-100 mt-4 d-md-none">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                </div>

                <div class="job-card" data-type="contract">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="job-tags">
                            <span class="tag tag-contract">CONTRACT</span>
                            <span class="tag tag-hybrid">HYBRID</span>
                        </div>
                        <button class="btn-apply d-none d-md-block">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                    <h3 class="job-title">Full-Stack Developer — Trade Systems</h3>
                    <div class="job-dept">Technology Solutions</div>
                    <p class="job-desc">Seeking a full-stack developer with experience in government systems, LIMS, or trade platform development. You'll design and build digital trade infrastructure for government clients.</p>
                    <div class="job-meta">
                        <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Dhaka / Remote</div>
                        <div class="meta-item"><i class="far fa-calendar"></i> Posted March 2025</div>
                        <div class="meta-item"><i class="far fa-clock"></i> 4+ years experience</div>
                    </div>
                    <button class="btn-apply w-100 mt-4 d-md-none">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                </div>

                <div class="job-card" data-type="fulltime">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="job-tags">
                            <span class="tag tag-fulltime">FULL-TIME</span>
                            <span class="tag tag-location">DHAKA</span>
                        </div>
                        <button class="btn-apply d-none d-md-block">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                    <h3 class="job-title">Research & Assessments Analyst</h3>
                    <div class="job-dept">Research & Evaluation</div>
                    <p class="job-desc">A rigorous analyst to support trade facilitation needs assessments, economic impact studies, and value chain analyses for government and donor clients. Strong quantitative and qualitative research skills required.</p>
                    <div class="job-meta">
                        <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</div>
                        <div class="meta-item"><i class="far fa-calendar"></i> Posted March 2025</div>
                        <div class="meta-item"><i class="far fa-clock"></i> 2-4 years experience</div>
                    </div>
                    <button class="btn-apply w-100 mt-4 d-md-none">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                </div>

                <div class="job-card" data-type="contract">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="job-tags">
                            <span class="tag tag-contract">CONTRACT</span>
                            <span class="tag tag-location">DHAKA</span>
                        </div>
                        <button class="btn-apply d-none d-md-block">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                    <h3 class="job-title">Laboratory Quality & Accreditation Specialist</h3>
                    <div class="job-dept">Laboratory Services</div>
                    <p class="job-desc">Experienced ISO/IEC 17025 specialist to support our laboratory accreditation advisory projects. You'll guide public and private lab clients through QMS development, gap analysis, and assessment preparation.</p>
                    <div class="job-meta">
                        <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</div>
                        <div class="meta-item"><i class="far fa-calendar"></i> Posted Feb 2025</div>
                        <div class="meta-item"><i class="far fa-clock"></i> 5+ years experience</div>
                    </div>
                    <button class="btn-apply w-100 mt-4 d-md-none">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                </div>

                <div class="job-card" data-type="fulltime">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="job-tags">
                            <span class="tag tag-fulltime">FULL-TIME</span>
                            <span class="tag tag-location">DHAKA</span>
                        </div>
                        <button class="btn-apply d-none d-md-block">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                    <h3 class="job-title">Junior Project Coordinator</h3>
                    <div class="job-dept">Project Management Office</div>
                    <p class="job-desc">An organised, proactive junior coordinator to support our project management team across multiple simultaneous engagements. Ideal for someone early in their development consulting career.</p>
                    <div class="job-meta">
                        <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</div>
                        <div class="meta-item"><i class="far fa-calendar"></i> Posted Feb 2025</div>
                        <div class="meta-item"><i class="far fa-clock"></i> 0-2 years experience</div>
                    </div>
                    <button class="btn-apply w-100 mt-4 d-md-none">Apply Now <i class="fas fa-arrow-right ms-2"></i></button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <div class="ps-2 pt-3">
                    <h4 class="modal-title fw-bold" id="applyModalLabel" style="color: var(--dark-navy);">Submit Your Application</h4>
                    <p class="text-muted small mb-0">Applying for: <span id="job-title-display" class="fw-bold text-info"></span></p>
                </div>
                <button type="button" class="btn-close me-2 mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="applicationForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="job_title" id="job_title_input">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Full Name</label>
                        <input type="text" class="form-control form-control-lg border-0 bg-light" placeholder="e.g. John Doe" required style="font-size: 15px;">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-secondary">Email Address</label>
                            <input type="email" class="form-control form-control-lg border-0 bg-light" placeholder="name@email.com" required style="font-size: 15px;">
                        </div>
                        
                    <div class="col-md-6 mb-3">
    <label class="form-label small fw-bold text-secondary">Phone Number</label>
    <div>
        <input type="tel" id="phone" name="phone" class="form-control form-control-lg border-0 bg-light w-100" required style="font-size: 15px;">
    </div>
</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Upload CV (PDF only)</label>
                        <div class="upload-area p-3 bg-light rounded text-center border-dashed" style="border: 2px dashed #cbd5e1;">
                            <input type="file" name="cv" id="cvUpload" class="form-control border-0 bg-transparent" accept=".pdf" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-cv py-3 shadow-sm border-0">Send Application <i class="fas fa-paper-plane ms-2"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@push('custome-js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filters = document.querySelectorAll('.filter-item');
        const jobCards = document.querySelectorAll('.job-card[data-type]');

        filters.forEach(filter => {
            filter.addEventListener('click', function () {
                const filterKey = this.dataset.filter;

                filters.forEach(item => item.classList.toggle('active', item === this));

                jobCards.forEach(card => {
                    if (filterKey === 'all' || card.dataset.type === filterKey) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        // --- Filter logic ---
        const filters = document.querySelectorAll('.filter-item');
        const jobCards = document.querySelectorAll('.job-card[data-type]');

        filters.forEach(filter => {
            filter.addEventListener('click', function () {
                const filterKey = this.dataset.filter;
                filters.forEach(item => item.classList.toggle('active', item === this));
                jobCards.forEach(card => {
                    card.style.display = (filterKey === 'all' || card.dataset.type === filterKey) ? '' : 'none';
                });
            });
        });

        // --- Apply Modal logic ---
        const applyModal = new bootstrap.Modal(document.getElementById('applyModal'));
        const applyButtons = document.querySelectorAll('.btn-apply');

        applyButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Find the job title from the specific card
                const card = this.closest('.job-card');
                const title = card.querySelector('.job-title').innerText;

                // Update modal info
                document.getElementById('job-title-display').innerText = title;
                document.getElementById('job_title_input').value = title;

                // Open Modal
                applyModal.show();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
      
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "bd",
            preferredCountries: ["bd", "us", "gb", "in"], 
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        
        const form = document.querySelector("#applicationForm");
        form.addEventListener("submit", function(e) {
            const fullNumber = phoneInput.getNumber();
           
            console.log("Full Number with Code: " + fullNumber);
        });

    });
</script>
@endpush

@endsection
