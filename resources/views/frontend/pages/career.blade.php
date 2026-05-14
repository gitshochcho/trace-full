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
        font-size: 16px;
        line-height: 1.7;
        max-width: 650px;
        opacity: 0.85;
            text-align: justify;
    }
    .hero-desc p {
        font-size: 16px;
        color: rgba(255,255,255,0.6);
        line-height: 1.7;
        margin-bottom: 10px;
    }
    .hero-desc p:last-child { margin-bottom: 0; }
    .hero-desc ul, .hero-desc ol {
        margin: 0 0 10px 20px;
        color: rgba(255,255,255,0.6);
    }
    .hero-desc li { margin-bottom: 6px; }

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
        text-align: center;
        display: inline-block;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-cv:hover {
        background: #ff8a4d;
        transform: translateY(-2px);
        color: white;
    }

     /* Page Alignment */
    .container-fluid { padding-left: 15px; padding-right: 15px; }
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
        color: white !important;
        border-radius: 50px;
        padding: 8px 24px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
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
            text-align: justify;
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

    /* --- New Modal Styles --- */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 45, 58, 0.8);
        backdrop-filter: blur(5px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .modal-content-box {
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        width: 95%;
        max-width: 500px;
        position: relative;
    }
    .close-modal {
        position: absolute;
        top: 15px; right: 20px;
        font-size: 24px;
        cursor: pointer;
        color: #64748b;
    }
    .modal-content-box h3 { color: var(--dark-navy); font-weight: 700; margin-bottom: 20px; }
    .form-group label { font-size: 14px; font-weight: 600; color: var(--text-slate); margin-bottom: 5px; }
    .form-control { border-radius: 8px; padding: 10px; border: 1px solid #e2e8f0; }

    @media (max-width: 991px) {
        .hero-career h1 { font-size: 32px; }
        .careers-sidebar { margin-bottom: 50px; }
    }
</style>
@endpush

@section('content')
<nav class="service-breadcrumb">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="breadcrumb-links">
            <a href="/">Home</a>
            <span class="sep">›</span>
            <span class="active">Careers</span>
        </div>
    </div>
</nav>

<div class="careers-wrapper">
    <section class="hero-career">
        <div class="container-fluid px-lg-5 page-align-container">
            @php
                use Illuminate\Support\Str;
                $cSection    = $careerHeader?->section     ?? '';
                $cHeading    = $careerHeader?->heading     ?? '';
                $cDesignWord = $careerHeader?->design_word ?? '';
                $cDesc       = $careerHeader?->description ?? '';
                $cButton     = $careerHeader?->sub_heading ?? '';
            @endphp

            @if($cSection)
                <div class="hero-label">{{ $cSection }}</div> 
            @endif

            <h1 class="display-4 fw-bold mb-4">
                {{ Str::before($cHeading, $cDesignWord) }}
                @if($cDesignWord && Str::contains($cHeading, $cDesignWord))
                </br>
                 <span class="highlight">{{ $cDesignWord }}</span>
                @elseif($cDesignWord)
                <span class="highlight">{{ $cDesignWord }}</span>
                @endif
            </h1>

            @if($cDesc)
                <div class="hero-desc text-white-50 mb-4">
                    {!! $cDesc !!}
                </div>
            @endif
        </div>
    </section>

    <div id="open-positions" class="container-fluid px-lg-5 page-align-container py-5 my-lg-5">
        <div class="row g-lg-5">
            <aside class="col-lg-4 careers-sidebar">
                <div class="sidebar-section">
                    <div class="section-label">OPEN POSITIONS</div>
                    <h2 class="sidebar-title">Current <span class="highlight">Openings</span></h2>
                    <p class="text-muted mt-3" style="text-align:justify;">We’re always looking for talented individuals across consulting, research, technology, and project management.</p>
                </div>

                <div class="filter-section">
                    <div class="filter-title">FILTER BY TYPE</div>
                    <div class="filter-item active" data-filter="all">
                        <span>All Roles</span>
                        <span class="count">{{ $jobs->total() }}</span>
                    </div>
                    <div class="filter-item" data-filter="Full-Time">
                        <span>Full-Time</span>
                        <span class="count">{{ $jobs->where('employment_type', 'Full-Time')->count() }}</span>
                    </div>
                    <div class="filter-item" data-filter="Contract">
                        <span>Contract</span>
                        <span class="count">{{ $jobs->where('employment_type', 'Contract')->count() }}</span>
                    </div>
                    <div class="filter-item" data-filter="Part-Time">
                        <span>Part-Time</span>
                        <span class="count">{{ $jobs->where('employment_type', 'Part-Time')->count() }}</span>
                    </div>
                </div>

                <div class="cv-box">
                    <h4>Don't see your role?</h4>
                    <p>Send us your CV and we'll reach out when the right opportunity comes up.</p>
                    <a href="javascript:void(0)" class="btn-cv" id="openCvModal">Send Your CV</a>
                </div>
            </aside>

            <div class="col-lg-8 job-listings">
                @forelse($jobs as $job)
                <div class="job-card" data-type="{{ $job->employment_type }}">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="job-tags">
                            <span class="tag tag-{{ strtolower(str_replace('-', '', $job->employment_type)) }}">{{ strtoupper($job->employment_type) }}</span>
                            <span class="tag tag-location">{{ strtoupper($job->location) }}</span>
                        </div>
                        <a href="{{ route('careerdetails', $job->id) }}" class="btn-apply d-none d-md-flex">Go For Apply <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                    <h3 class="job-title">{{ $job->title }}</h3>
                    <div class="job-dept">{{ $job->department }}</div>
                    <p class="job-desc">{{ Str::limit($job->description, 150) }}</p>
                    <div class="job-meta">
                        <div class="meta-item"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</div>
                        <div class="meta-item"><i class="far fa-calendar"></i> Posted {{ $job->posted_date ? $job->posted_date->format('d M Y') : 'Null' }}</div>
                        <div class="meta-item"><i class="fas fa-calendar-alt"></i>Closing {{ $job->end_date ? $job->end_date->format('d M Y') : 'Null' }}</div>
                        <div class="meta-item"><i class="far fa-clock"></i> {{ $job->experience_level }}</div>
                    </div>
                    <a href="{{ route('careerdetails', $job->id) }}" class="btn-apply w-100 mt-4 d-md-none text-center justify-content-center">Go For Apply <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
                @empty
                <div class="text-center py-5">
                    <h4>No job openings available at the moment</h4>
                    <p class="text-muted">Please check back later or send us your CV for future opportunities.</p>
                    <a href="javascript:void(0)" class="btn-cv w-auto px-5" onclick="document.getElementById('cvModal').style.display='flex'">Send Your CV</a>
                </div>
                @endforelse

                @if($jobs->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $jobs->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if(session('cv_success'))
<div style="position:fixed;top:20px;right:20px;z-index:9999;max-width:360px;" class="alert alert-success alert-dismissible shadow">
    <i class="fas fa-check-circle me-2"></i>{{ session('cv_success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div id="cvModal" class="modal-overlay">
    <div class="modal-content-box shadow-lg">
        <span class="close-modal" id="closeCvModal">&times;</span>
        <h3>Send Your CV</h3>

        @if($errors->any())
        <div class="alert alert-danger py-2 mb-3" style="font-size:13px;">
            <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('cv.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name"
                       value="{{ old('name') }}" required>
            </div>
            <div class="form-group mb-3">
                <label>Email Address <span class="text-muted small">(optional)</span></label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email"
                       value="{{ old('email') }}">
            </div>
            <div class="form-group mb-3">
                <label>Contact Number <span class="text-muted small">(optional)</span></label>
                <input type="tel" name="phone" class="form-control" placeholder="Enter contact number"
                       value="{{ old('phone') }}">
            </div>
            <div class="form-group mb-1">
                <label>Upload CV <span class="text-danger">(PDF only)</span></label>
                <input type="file" name="cv_pdf" class="form-control" accept=".pdf" required>
                <small class="text-muted">Max 5MB · PDF files only</small>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-cv border-0 w-100">Submit Application</button>
            </div>
        </form>
    </div>
</div>

@push('custome-js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Filter Logic
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

        // Modal Logic
        const modal = document.getElementById('cvModal');
        const openBtn = document.getElementById('openCvModal');
        const closeBtn = document.getElementById('closeCvModal');

        if(openBtn) {
            openBtn.onclick = function() { modal.style.display = "flex"; }
        }

        if(closeBtn) {
            closeBtn.onclick = function() { modal.style.display = "none"; }
        }

        // Re-open modal if validation errors exist
        @if($errors->any())
        if (modal) modal.style.display = "flex";
        @endif

        window.onclick = function(event) {
            if (event.target == modal) { modal.style.display = "none"; }
        }
    });
</script>
@endpush
@endsection