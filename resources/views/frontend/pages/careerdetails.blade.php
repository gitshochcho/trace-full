@extends('frontend.layout.app')

@push('custome-css')
{{-- International Telephone Input CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<style>
    /* Layout */
    .career-details-section { padding: 60px 0 80px; background: #fff; }
    .career-container { max-width: 1072px; margin: 0 auto; padding: 0 24px; }

    /* Left Content */
    .job-description h2 { font-size: 28px; font-weight: 700; color: #01354B; margin-bottom: 8px; }
    .job-division { color: #01888C; font-weight: 600; margin-bottom: 24px; display: block; }
    .job-main-text p { font-size: 15px; color: #64748b; line-height: 1.8; margin-bottom: 20px; }

    /* Sections - Responsibilities & Requirements */
    .job-section {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px solid #E5E9ED;
    }
    .job-section h3 {
        font-size: 20px;
        font-weight: 700;
        color: #01354B;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .job-section h3 i {
        margin-right: 10px;
        color: #01888C;
        font-size: 24px;
    }
    .job-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .job-section li {
        font-size: 15px;
        color: #64748b;
        line-height: 1.8;
        padding: 12px 0 12px 32px;
        position: relative;
        text-align: justify;
    }
    .job-section li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #01888C;
        font-weight: 700;
        font-size: 18px;
    }

    /* Right Sidebar - Info Card (Now Smaller) */
    .job-sidebar-info {
        background: #F8FAF7;
        border: 1px solid #E5E9ED;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .sidebar-info-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #E5E9ED;
    }
    .sidebar-info-item:last-child { border-bottom: none; }
    .info-label { font-size: 12px; color: #94a3b8; font-weight: 500; }
    .info-value { font-size: 12px; color: #334155; font-weight: 600; }

    /* Right Sidebar - Apply Form Card */
    .apply-form-card {
        background: #ffffff;
        border: 1px solid #E5E9ED;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.02);
    }
    .apply-form-card h5 { font-size: 18px; font-weight: 700; color: #01354B; margin-bottom: 15px; }
    
    .form-group { margin-bottom: 15px; }
    .form-label { font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; display: block; }
    .form-control {
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        padding: 10px 12px;
        font-size: 14px;
        width: 100%;
    }
    .form-control:focus {
        border-color: #01888C;
        outline: none;
        box-shadow: 0 0 0 3px rgba(1, 136, 140, 0.1);
    }
    
    /* CV Upload Area */
    .cv-upload-label {
        border: 2px dashed #E2E8F0;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: 0.3s;
        display: block;
    }
    .cv-upload-label:hover { border-color: #01888C; background: #f0fafa; }
    .cv-upload-label i { font-size: 20px; color: #01888C; margin-bottom: 8px; }
    .cv-upload-label span { display: block; font-size: 12px; color: #64748b; }

    .btn-apply-submit {
        display: block;
        width: 100%;
        background: #F47735;
        color: #fff;
        text-align: center;
        padding: 12px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        margin-top: 10px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-apply-submit:hover { background: #d9622a; }

    /* Phone input adjustment */
    .iti { width: 100%; }
</style>
@endpush

@section('content')

<section class="career-details-section">
    <div class="career-container">
        <div class="row g-5">
            
            {{-- LEFT COLUMN: Job Description --}}
            <div class="col-lg-7">
                <div class="job-description">
                    <span class="job-division">{{ $job->department }}</span>
                    <h2>{{ $job->title }}</h2>
                    
                    <div class="job-main-text mt-4" style="text-align: justify;">
                        {!! nl2br($job->description) !!}
                    </div>

                    {{-- Responsibilities Section --}}
                    @if($job->responsibilities)
                    <div class="job-section">
                        <h3><i class="fas fa-tasks"></i> Key Responsibilities</h3>
                        <ul>
                            @foreach(array_filter(array_map('trim', explode("\n", $job->responsibilities))) as $responsibility)
                            <li>{{ $responsibility }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Requirements Section --}}
                    @if($job->requirements)
                    <div class="job-section">
                        <h3><i class="fas fa-star"></i> Required Qualifications</h3>
                        <ul>
                            @foreach(array_filter(array_map('trim', explode("\n", $job->requirements))) as $requirement)
                            <li>{{ $requirement }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT COLUMN: Sidebar --}}
            <div class="col-lg-5">
                <div style="position: sticky; top: 100px;">
                    
                    {{-- 1. Job Details Card (Smaller) --}}
                    <div class="job-sidebar-info">
                        <h6 style="font-weight: 700; color: #01354B; margin-bottom: 15px;">Summary</h6>
                        <div class="sidebar-info-item">
                            <span class="info-label">Employment</span>
                            <span class="info-value">{{ $job->employment_type }}</span>
                        </div>
                        <div class="sidebar-info-item">
                            <span class="info-label">Location</span>
                            <span class="info-value">{{ $job->location }}</span>
                        </div>
                        <div class="sidebar-info-item">
                            <span class="info-label">Experience</span>
                            <span class="info-value">{{ $job->experience_level }}</span>
                        </div>
                        <div class="sidebar-info-item">
                            <span class="info-label">Posted</span>
                            <span class="info-value">{{ $job->posted_date->format('M d, Y') }}</span>
                        </div>
                        <div class="sidebar-info-item">
                            <span class="info-label">End Date</span>
                            <span class="info-value">
                                @if($job->end_date)
                                    {{ $job->end_date->format('M d, Y') }}
                                    @if($job->end_date->isPast())
                                        <span class="badge bg-danger ms-1">Expired</span>
                                    @endif
                                @else
                                    <span class="text-muted">Open-ended</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- 2. Apply Now Form Card --}}
                    <div class="apply-form-card">
                        <h5>Apply for this position</h5>
                        
                        {{-- Success Message --}}
                        @if(session('success'))
                        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px 16px; border-radius: 6px; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-check-circle" style="font-size: 18px;"></i>
                            <div>
                                <strong>Success!</strong>
                                <p style="margin: 0; font-size: 13px;">{{ session('success') }}</p>
                            </div>
                        </div>
                        @endif

                        {{-- Error Message --}}
                        @if(session('error'))
                        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px 16px; border-radius: 6px; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-exclamation-circle" style="font-size: 18px;"></i>
                            <div>
                                <strong>Error!</strong>
                                <p style="margin: 0; font-size: 13px;">{{ session('error') }}</p>
                            </div>
                        </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if($errors->any())
                        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px 16px; border-radius: 6px; margin-bottom: 15px;">
                            <strong style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                <i class="fas fa-exclamation-circle"></i> Validation Errors
                            </strong>
                            <ul style="margin: 0; padding-left: 20px; font-size: 13px;">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('job.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" id="phone" class="form-control" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Upload CV (PDF/DOC)</label>
                                <label for="cv-file" class="cv-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Click to upload or drag & drop</span>
                                    <input type="file" id="cv-file" name="cv" style="display:none;" accept=".pdf,.doc,.docx" required>
                                </label>
                                <div id="file-name" style="font-size: 11px; color: #01888C; margin-top: 5px;"></div>
                            </div>

                            <button type="submit" class="btn-apply-submit">
                                Submit Application <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@include('frontend.layout.cta')

@push('custome-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    // Initialize Phone Input
    const phoneInput = document.querySelector("#phone");
    window.intlTelInput(phoneInput, {
        initialCountry: "bd",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    // Show selected file name
    document.getElementById('cv-file').onchange = function () {
        document.getElementById('file-name').innerHTML = "Selected: " + this.files[0].name;
    };
</script>
@endpush

@endsection