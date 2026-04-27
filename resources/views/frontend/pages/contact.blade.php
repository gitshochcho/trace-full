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
    /* TRACE Contact Page Custom Styles */
    :root {
        --dark-navy: #002d3a;
        --trace-cyan: #00bfc5;
        --trace-orange: #e85d26;
        --bg-gray: #f8fafc;
        --text-muted: #64748b;
    }

    .contact-wrapper {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: #fff;
        overflow-x: hidden;
    }

    /* Hero Section */
    .contact-hero {
        background-color: var(--dark-navy);
        color: #ffffff;
        padding: 100px 0 160px 0;
        position: relative;
    }
    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: var(--trace-orange);
        margin-bottom: 20px;
        text-transform: uppercase;
    }
    .hero-label::before {
        content: "";
        display: inline-block;
        width: 30px;
        height: 2px;
        background: var(--trace-orange);
    }
    .contact-hero-title {
        font-size: 56px;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 25px;
    }
    .contact-hero-title span { color: var(--trace-cyan); }
    .contact-hero-desc {
        font-size: 18px;
        line-height: 1.6;
        max-width: 550px;
        opacity: 0.85;
    }

    /* Contact Form Card (Overlapping) */
    .contact-form-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        margin-top: -170px;
        position: relative;
        z-index: 10;
        border: 1px solid #ffffff;
        
    }
    .contact-form-header {
        background: var(--dark-navy);
        border-radius: 16px 16px 0 0;
        padding: 26px 30px 8px;
        margin: -40px -40px 10px;
        color: #ffffff;
    }
    .form-label-top {
        font-size: 10px;
        font-weight: 700;
        color: #4DC0C4;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    .form-title {
        font-size: 20px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 5px;
    }
    .form-subtitle {
        font-size: 13px;
        color: rgba(255,255,255,0.8);
        margin-bottom: 20px;
    }
    .contact-form label {
        font-size: 13px;
        font-weight: 700;
        color: var(--dark-navy);
        margin-bottom: 8px;
        display: block;
    }
    .contact-form label .req { color: var(--trace-orange); }
    .contact-form .form-control, .contact-form .form-select {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 12px 15px;
        font-size: 14px;
        border-radius: 8px;
    }
    .btn-send {
        background-color: var(--trace-orange);
        color: white;
        width: 100%;
        padding: 14px;
        border-radius: 8px;
        font-weight: 700;
        border: none;
        margin-top: 20px;
        transition: 0.3s;
    }
    .btn-send:hover { background-color: #d14d1b; }
    .form-privacy {
        font-size: 11px;
        color: #94a3b8;
        text-align: center;
        margin-top: 15px;
    }
    .form-privacy a {
        color: var(--dark-navy);
    }

    /* Info Sections */
    .info-heading {
        font-size: 24px;
        font-weight: 800;
        color: var(--dark-navy);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
    }
    .accent-bar {
        width: 4px;
        height: 24px;
        background-color: var(--trace-orange);
        margin-right: 12px;
        display: inline-block;
    }
    .info-group-label {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-muted);
        margin-bottom: 15px;
        text-transform: uppercase;
    }
    .info-row {
        background: #f8fafc;
        border: 1px solid #eef2f6;
        padding: 20px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        transition: 0.3s;
    }
    .info-icon-wrap {
        width: 45px;
        height: 45px;
        background: #e6f7f8;
        color: var(--trace-cyan);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 20px;
        font-size: 18px;
    }
    .info-primary {
        font-weight: 700;
        color: var(--dark-navy);
        margin-bottom: 0;
        font-size: 16px;
    }
    .info-secondary {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 0;
    }
    .info-action-btn {
        margin-left: auto;
        background: var(--dark-navy);
        color: white;
        font-size: 12px;
        font-weight: 700;
        padding: 8px 18px;
        border-radius: 50px;
        text-decoration: none;
    }

    /* Office Card */
    .office-card {
        display: flex;
        gap: 20px;
        padding: 30px;
        background: #f8fafc;
        border-radius: 16px;
    }
    .office-icon-wrap { color: var(--trace-cyan); font-size: 24px; }
    .office-tag {
        font-size: 10px;
        font-weight: 800;
        color: var(--trace-cyan);
        letter-spacing: 1px;
    }
    .office-name { font-weight: 800; color: var(--dark-navy); font-size: 18px; margin: 5px 0; }
    .office-addr { font-size: 14px; color: var(--text-muted); line-height: 1.6; }
    .office-hours { font-size: 13px; font-weight: 600; color: var(--dark-navy); margin-top: 10px; }
    .map-link { color: var(--trace-cyan); font-weight: 700; text-decoration: none; font-size: 14px; }

    /* Social Pills */
    .social-pill {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        border-radius: 50px;
        border: 1px solid #e2e8f0;
        color: var(--dark-navy);
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
        transition: 0.3s;
        margin-bottom: 12px;
    }
    .social-pill:hover { background: #f1f5f9; }
    .social-pill i { font-size: 16px; }

    .page-align-container { max-width: 1072px; margin: 0 auto; }

    @media (max-width: 991px) {
        .contact-hero { padding: 60px 0 100px 0; text-align: center; }
        .contact-hero-desc { margin: 0 auto; }
        .contact-hero-title { font-size: 38px; }
        .contact-form-card { margin-top: -70px; }
        .info-row { flex-direction: column; text-align: center; }
        .info-icon-wrap { margin-right: 0; margin-bottom: 15px; }
        .info-action-btn { margin-left: 0; margin-top: 15px; width: 100%; }
    }
</style>
@endpush

@section('content')
<nav class="service-breadcrumb">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="breadcrumb-links">
            <a href="\">Home</a>
            <span class="sep">›</span>
            <span class="active">Contact</span>
        </div>
    </div>
</nav>

<div class="contact-wrapper">
    <section class="contact-hero">
        <div class="container-fluid px-lg-5 page-align-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-label">Reach Out</div>
                    @if($heroContent)
                        <h1 class="contact-hero-title">{{ nl2br(e($heroContent->heading ?? 'Let\'s start a conversation.')) }}</h1>
                        <p class="contact-hero-desc">{{ $heroContent->description ?? '' }}</p>
                    @else
                        <h1 class="display-4 fw-bold mb-4">
                    @php
                        $contHeading = $contactHeader->heading ?? "Let's start a conversation.";
                        $contDesignWord = $contactHeader->design_word ?? 'conversation.';

                        if ($contDesignWord) {
                            $contHeading = str_ireplace($contDesignWord, "<span style='color: var(--trace-cyan);'>{$contDesignWord}</span>", $contHeading);
                        }
                    @endphp
                    {!! $contHeading !!}
                </h1>
                <p class="lead text-white-50 mb-0" style="max-width: 580px; line-height: 1.6;">
                    {!! strip_tags($contactHeader->description ?? "Whether you're a government agency, development partner, or private company — TRACE is ready to listen, advise, and collaborate. Reach out and we'll respond within one business day.") !!}
                </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid px-lg-5 page-align-container pb-5">
        <div class="row">
            <div class="col-lg-7 py-lg-5 order-2 order-lg-1">
                
                <div class="mb-5 mt-5 mt-lg-0">
                    <h2 class="info-heading"><span class="accent-bar"></span> Contact Us</h2>
                    
                    @if($contactPhones->count() > 0)
                    <div class="info-group mb-4">
                        <p class="info-group-label"><i class="fas fa-phone-alt me-2"></i> Phone</p>
                        @foreach($contactPhones as $phone)
                        <div class="info-row">
                            <div class="info-icon-wrap"><i class="{{ $phone->icon_class ?? 'fas fa-phone-alt' }}"></i></div>
                            <div class="info-text">
                                <p class="info-primary">{{ $phone->primary_text }}</p>
                                <p class="info-secondary">{{ $phone->secondary_text ?? $phone->title }}</p>
                            </div>
                            @if($phone->link_value)
                            <a href="{{ $phone->link_value }}" class="info-action-btn"><i class="fas fa-phone-alt me-2"></i>Call Now</a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if($contactEmails->count() > 0)
                    <div class="info-group mb-4">
                        <p class="info-group-label"><i class="fas fa-envelope me-2"></i> Send Email</p>
                        @foreach($contactEmails as $email)
                        <div class="info-row">
                            <div class="info-icon-wrap"><i class="{{ $email->icon_class ?? 'fas fa-envelope' }}"></i></div>
                            <div class="info-text">
                                <p class="info-primary">{{ $email->primary_text }}</p>
                                <p class="info-secondary">{{ $email->secondary_text ?? $email->title }}</p>
                            </div>
                            @if($email->link_value)
                            <a href="{{ $email->link_value }}" class="info-action-btn"><i class="fas fa-envelope me-2"></i>Send Email</a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                @if($contactAddresses->count() > 0)
                <div class="mb-5">
                    <h2 class="info-heading"><span class="accent-bar"></span> Our Office</h2>
                    @foreach($contactAddresses as $address)
                    <div class="office-card">
                        <div class="office-icon-wrap"><i class="{{ $address->icon_class ?? 'fas fa-map-marker-alt' }}"></i></div>
                        <div class="office-details">
                            <span class="office-tag">{{ strtoupper($address->title) }}</span>
                            <p class="office-name">{{ $address->name ?? 'Trace Consulting Limited' }}</p>
                            <p class="office-addr">
                                {!! nl2br(e($address->address)) ?? '' !!}
                            </p>
                            @if($address->office_hours)
                            <p class="office-hours">{{ $address->office_hours }}</p>
                            @endif
                            @if($address->link_value)
                            <a href="{{ $address->link_value }}" target="_blank" class="map-link">View on Google Maps →</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <div>
                    <h2 class="info-heading"><span class="accent-bar"></span> Find Us</h2>
                    <div class="rounded-4 overflow-hidden border">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.091001594771!2d90.4233668114383!3d23.815347886470062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c64c103a8757%3A0x4b6e589e81bc5c43!2sBashundhara%20R%2FA%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1713240000000!5m2!1sen!2sbd" 
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 order-1 order-lg-2">
                <div class="contact-form-card">
                    <div class="contact-form-header">
                        <p class="form-label-top">SEND A MESSAGE</p>
                        <h3 class="form-title">Get a Consultation</h3>
                        <p class="form-subtitle">We'll respond within one business day.</p>
                    </div>

                    @if (session('success'))
                        <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 100px; right: 20px; width: 350px; border-radius: 8px; border-left: 4px solid #28a745; box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2); z-index: 9999;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-check-circle" style="font-size: 20px; color: #28a745; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Success!</strong>
                                    <p style="margin: 5px 0 0 0; font-size: 14px;">{{ session('success') }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>First Name <span class="req">*</span></label>
                                <input type="text" name="first_name" class="form-control" placeholder="First name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Last Name <span class="req">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                        </div>

                        <div class="mb-3">
                            <label>Mobile Number <span class="req">*</span></label>
                            <input type="number" name="mobile_number" class="form-control" placeholder="Your mobile number" required>
                        </div>

                        <div class="mb-3">
                            <label>Organization</label>
                            <input type="text" name="organization" class="form-control" placeholder="Your organisation or institution">
                        </div>

                        <div class="mb-3">
                            <label>Subject / Service Area <span class="req">*</span></label>
                            <input 
                                type="text" 
                                name="subject" 
                                list="subject-options" 
                                class="form-control" 
                                placeholder="Select or type your subject..." 
                                required>
                            <datalist id="subject-options">
                                <option value="Trade Facilitation"></option>
                                <option value="Policy Reform"></option>
                                <option value="Digital Solutions"></option>
                                <option value="Research & Publications"></option>
                                <option value="General Enquiry"></option>
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label>Message <span class="req">*</span></label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Tell us about your project or challenge..." required></textarea>
                        </div>

                        <button type="submit" class="btn-send">
                            Send Message <i class="fas fa-paper-plane ms-2"></i>
                        </button>

                        <p class="form-privacy">
                            By submitting this form you agree to our <a href="#" class="text-decoration-none">Privacy Policy</a>. We never share your data.
                        </p>
                    </form>
                </div>

                <div class="mb-5 mt-4">
                    <h2 class="info-heading"><span class="accent-bar"></span> Follow Us</h2>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="social-pill"><i class="fab fa-linkedin-in text-primary"></i> LinkedIn</a>
                        <a href="#" class="social-pill"><i class="fab fa-twitter text-info"></i> Twitter</a>
                        <a href="#" class="social-pill"><i class="fab fa-facebook-f text-primary"></i> Facebook</a>
                        <a href="#" class="social-pill"><i class="fab fa-youtube text-danger"></i> Youtube</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(function() {
                const alert = new bootstrap.Alert(successAlert);
                alert.close();
            }, 1000); // 10 seconds
        }
    });
</script>
@endpush