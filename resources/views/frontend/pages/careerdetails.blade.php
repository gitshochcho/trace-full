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
                    <span class="job-division">Trade & Policy Division</span>
                    <h2>Trade Facilitation Consultant</h2>
                    
                    <div class="job-main-text mt-4">
                        <p>We are looking for an experienced trade facilitation consultant to support our growing portfolio of WTO TFA implementation, customs modernisation, and border management reform projects across South Asia.</p>
                        
                        <p>Beyond project implementation, you will be responsible for conducting gap analyses, drafting policy recommendations, and facilitating high-level stakeholder consultations with government agencies and private sector trade bodies.</p>

                        <p>The role requires a deep understanding of international trade laws, regional economic integration, and the ability to translate complex regulatory requirements into actionable business processes.</p>

                        <h4 class="mt-4 mb-3" style="font-weight:700;">Key Responsibilities:</h4>
                        <ul style="color: #64748b; line-height: 2;">
                            <li>Conduct comprehensive trade process mapping and simplification.</li>
                            <li>Develop strategic roadmaps for WTO TFA compliance.</li>
                            <li>Provide technical assistance to customs authorities.</li>
                            <li>Liaise with international development partners.</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Sidebar --}}
            <div class="col-lg-5">
                <div style="position: sticky; top: 20px;">
                    
                    {{-- 1. Job Details Card (Smaller) --}}
                    <div class="job-sidebar-info">
                        <h6 style="font-weight: 700; color: #01354B; margin-bottom: 15px;">Summary</h6>
                        <div class="sidebar-info-item">
                            <span class="info-label">Employment</span>
                            <span class="info-value">Full-Time</span>
                        </div>
                        <div class="sidebar-info-item">
                            <span class="info-label">Location</span>
                            <span class="info-value">Dhaka, BD</span>
                        </div>
                        <div class="sidebar-info-item">
                            <span class="info-label">Experience</span>
                            <span class="info-value">3-5 Years</span>
                        </div>
                    </div>

                    {{-- 2. Apply Now Form Card --}}
                    <div class="apply-form-card">
                        <h5>Apply for this position</h5>
                        <form action="#" method="POST" enctype="multipart/form-data">
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
                                    <input type="file" id="cv-file" name="cv" style="display:none;" required>
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