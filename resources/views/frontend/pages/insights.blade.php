@extends('frontend.layout.app')






@section('content')
{{-- ==============================
      INSIGHT HERO SECTION
============================== --}}
<section class="insight-hero py-5" style="background-color: #002d3a; color: #fff;">
    <div class="container-fluid px-lg-5 page-align-container py-lg-5">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero-tag d-flex align-items-center gap-2 mb-3" style="font-size: 12px; letter-spacing: 1px; color: #e85d26; font-weight: 700;">
                    <span style="width: 25px; height: 2px; background: #e85d26;"></span>
                    KNOWLEDGE & RESEARCH
                </div>
                <h1 class="display-4 fw-bolder mb-4" style="line-height: 1.1;">
                    Ideas that <span style="color: #00bfc5;">move trade</span> forward.
                </h1>
                <p class="lead opacity-75 mb-4" style="font-size: 16px; max-width: 550px;">
                    Op-eds in national newspapers, in-house research, policy publications, and expert videos — TRACE’s full body of published work.
                </p>
                <div class="d-flex gap-5 mt-5">
                    <div>
                        <h3 class="fw-bold mb-0">20+</h3>
                        <span class="small opacity-50">Op-Eds</span>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">12</h3>
                        <span class="small opacity-50">Publications</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==============================
      TOP FILTER BAR
============================== --}}
<section class="insights-topbar border-bottom sticky-top bg-white py-3 shadow-sm">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="filters d-flex flex-wrap gap-2 gap-md-4">
                    <a href="#" class="filter-link active">All <span class="ms-1 opacity-50">18</span></a>
                    <a href="#" class="filter-link">Videos <span class="ms-1 opacity-50">1</span></a>
                    <a href="#" class="filter-link">Op-Ed / Press <span class="ms-1 opacity-50">3</span></a>
                    <a href="#" class="filter-link">Articles <span class="ms-1 opacity-50">4</span></a>
                    <a href="#" class="filter-link">Publications <span class="ms-1 opacity-50">4</span></a>
                    <a href="#" class="filter-link">Brochures <span class="ms-1 opacity-50">2</span></a>
                </div>
            </div>
            <div class="col-lg-4 mt-3 mt-lg-0">
                <div class="d-flex gap-2">
                    <div class="input-group input-group-sm border rounded-pill px-2 py-1">
                        <span class="input-group-text bg-transparent border-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search insights...">
                    </div>
                    <select class="form-select form-select-sm border-0 fw-bold shadow-none w-auto" style="font-size: 12px;">
                        <option>Newest First</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==============================
      INSIGHTS GRID
============================== --}}
<section class="insights-list py-5 bg-white">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="results-info d-flex align-items-center gap-3 mb-5">
            <span class="small text-muted text-nowrap">Showing <b>18</b> insights</span>
            <div class="w-100 bg-light" style="height: 1px;"></div>
        </div>

        <div class="row g-4">
            @php
            // Sample Loop for Cards
            $items = [
                ['tag' => 'VIDEO', 'cat' => 'TECHNOLOGY SOLUTIONS', 'title' => 'LIMS in Action: Digital Lab Management Transforming Testing in Bangladesh', 'btn' => 'Watch', 'badge_bg' => '#e85d26' , 'img' => 'Op-Ed.png'],
                ['tag' => 'BROCHURE', 'cat' => 'LABORATORY SERVICES', 'title' => 'TRACE Laboratory Accreditation Services — Brochure 2024', 'btn' => 'Download', 'badge_bg' => '#e85d26', 'img' => 'TRACE Laboratory Accreditation Services — Brochure 2024.png'],
                ['tag' => 'BROCHURE', 'cat' => 'TRADE FACILITATION', 'title' => 'TRACE Trade Facilitation Services — 2025 Capability Overview', 'btn' => 'Download', 'badge_bg' => '#e85d26', 'img' => 'TRACE Trade Facilitation Services — 2025 Capability Overview.png'],
                ['tag' => 'PUBLICATION', 'cat' => 'RESEARCH & ASSESSMENT', 'title' => 'Export Performance Management: A Framework for South Asian Governments', 'btn' => 'Read', 'badge_bg' => '#00898e', 'img' => 'Export Performance Management_ A Framework for South Asian Governments.png'],
                ['tag' => 'PUBLICATION', 'cat' => 'TECHNOLOGY SOLUTIONS', 'title' => 'Digital Trade Infrastructure in Bangladesh: A Readiness Assessment', 'btn' => 'Read', 'badge_bg' => '#00898e', 'img' => 'Digital Trade Infrastructure in Bangladesh_ A Readiness Assessment.png'],
                ['tag' => 'PUBLICATION', 'cat' => 'POLICY ADVOCACY', 'title' => "Reforming Bangladesh's Export Licensing Framework: Policy Brief 2024", 'btn' => 'Read', 'badge_bg' => '#00898e', 'img' => "Reforming Bangladesh's Export Licensing Framework_ Policy Brief 2024.png"],
            ];
            @endphp

            @foreach($items as $index => $item)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="insight-card h-100 border-0 shadow-sm rounded-5 overflow-hidden bg-white">
                    <div class="card-img-position relative" style="height: 220px; overflow: hidden; position: relative;">
                        <img src="{{ asset('assets/img/' . $item['img']) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item['title'] }}">
                        <span class="badge position-absolute top-0 start-0 m-3 px-3 py-1" style="background: {{ $item['badge_bg'] }}; font-size: 10px; border-radius: 4px;">{{ $item['tag'] }}</span>
                    </div>
                    <div class="card-body p-4">
                        <small class="fw-bold text-teal mb-2 d-block" style="font-size: 11px; color: #00898e; letter-spacing: 0.5px;">{{ $item['cat'] }}</small>
                        <h5 class="card-title fw-bold text-dark mb-3" style="font-size: 17px; line-height: 1.4;">{{ $item['title'] }}</h5>
                        <p class="card-text text-muted small mb-4">TRACE’s technology team on the rollout of Laboratory Information Management Systems across public sector testing facilities...</p>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted" style="font-size: 12px;"><i class="far fa-calendar-alt me-1"></i> Jan 2025 · 18 min</span>
                            @php
                                $link = $item['btn'] === 'Read'
                                    ? route('articleDetails', ['id' => $index + 1])
                                    : '#';
                            @endphp
                            <a href="{{ $link }}" class="fw-bold text-decoration-none text-teal" style="font-size: 12px; color: #00898e;">{{ $item['btn'] }} →</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <button class="btn border px-5 py-2 rounded-pill fw-bold" style="font-size: 13px; background: #fff; color: #01354B; border: 2px solid #01354B; box-shadow: 0 10px 20px rgba(0, 132, 67, 0.18);">
                <i class="fas fa-chevron-down me-2 small"></i> Load More
            </button>
        </div>
    </div>
</section>

{{-- ==============================
      SUBSCRIBE SECTION
============================== --}}
<section class="subscribe-section py-5" style="border-top: 1px solid #eee;">
    <div class="container-fluid px-lg-5 page-align-container py-lg-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="d-flex align-items-center gap-2 mb-3" style="font-size: 12px; letter-spacing: 1px; color: #e85d26; font-weight: 700;">
                    <span style="width: 25px; height: 2px; background: #e85d26;"></span>
                    STAY INFORMED
                </div>
                <h2 class="fw-bold text-dark mb-3">Get TRACE insights in your inbox.</h2>
                <p class="text-muted">Subscribe for our latest op-eds, policy research, and publications — monthly, no spam.</p>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0">
                <form class="d-flex gap-2">
                    <input type="email" class="form-control py-2 px-3 border-light bg-light shadow-none" placeholder="Your email address" style="border-radius: 4px;">
                    <button class="btn btn-dark px-4 fw-bold" style="background: #01354B; color: #fff; border: 2px solid #01354B; border-radius: 4px; box-shadow: 0 10px 24px rgba(1, 53, 75, 0.22);">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('custome-css')
<style>
    /* Custom Styles for Same to Same Look */
    .filter-link {
        text-decoration: none;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        padding-bottom: 5px;
        border-bottom: 2px solid transparent;
        transition: 0.3s;
    }
    .filter-link.active, .filter-link:hover {
        color: #e85d26;
        border-bottom-color: #e85d26;
    }
    .insight-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 1 rem;
    }
    .insight-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.12) !important;
    }
    .insight-card .card-img-position img {
        border-top-left-radius: 1.5rem;
        border-top-right-radius: 1.5rem;
    }
    .object-fit-cover { object-fit: cover; }
    .page-align-container { max-width: 1072px; margin: 0 auto; }
    
    @media (max-width: 991px) {
        .display-4 { font-size: 32px; }
        .filters { justify-content: start; }
    }
</style>

@endpush