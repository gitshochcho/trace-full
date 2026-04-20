<footer style="background: #000D14; color: white;">
    @php
        $socialLinks = $siteSettings?->socialLinksWithIcons() ?? [];
    @endphp

    <div class="container-fluid px-lg-5 py-5 border-bottom border-white border-opacity-10" style="max-width: 1072px; margin: 0 auto;">
        <div class="row g-4 g-lg-5">

            {{-- LEFT: Logo + About + Socials --}}
            <div class="col-12 col-md-6 col-lg-4">

                {{-- Brand --}}
                <div class="footer-brand mb-3">
                    @if($siteSettings?->logoImageUrl())
                        <img src="{{ $siteSettings->logoImageUrl() }}" alt="Trace Logo"
                             style="width: 38px; height: 38px; object-fit: contain;">
                    @endif
                    <div class="d-flex flex-column">
                        <h3 class="mb-0 fw-bold footer-brand-title">{{ $siteSettings?->logo_text ?: 'TRACE' }}</h3>
                        <span class="footer-brand-tagline">{{ $siteSettings?->logo_tagline ?: 'Insight. Strategy. Impact' }}</span>
                    </div>
                </div>

                {{-- Description --}}
                <p style="font-size: 13px; color: #8fa6ad; line-height: 1.7; max-width: 260px;">
                    {{ $siteSettings?->footer_description ?: 'Trace Consulting Limited provides strategic advisory, technical assistance, and digital solutions to governments and development organisations across South Asia.' }}
                </p>

                {{-- Socials --}}
                <div class="d-flex gap-3 mt-3">
                    @foreach($socialLinks as $socialLink)
                        <a href="{{ $socialLink['link'] ?? '#' }}" target="_blank" rel="noreferrer" class="text-decoration-none" aria-label="{{ $socialLink['title'] ?? 'social link' }}">
                            @if(! empty($socialLink['icon_url']))
                                <img src="{{ $socialLink['icon_url'] }}" alt="{{ $socialLink['title'] ?? 'Social icon' }}" class="footer-social" style="width: 14px; height: 14px; object-fit: contain;">
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- COMPANY --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h4 class="footer-heading">COMPANY</h4>
                <ul class="list-unstyled">
                    <li class="footer-link"><a href="/about" >About Us</a></li>
                    <li class="footer-link"><a href="/team" >Our Team</a></li>
                    <li class="footer-link"><a href="/careers" >Careers</a></li>
                    <li class="footer-link"><a href="/contact" >Contact</a></li>
                </ul>
            </div>

            {{-- WORK --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h4 class="footer-heading">WORK</h4>
                <ul class="list-unstyled">
                    <li class="footer-link"><a href="/services" >Services</a></li>
                    <li class="footer-link"><a href="#" >Projects</a></li>
                    <li class="footer-link"><a href="/insights" >Insights</a></li>
                    <li class="footer-link"><a href="#" >Partners</a></li>
                </ul>
            </div>

            {{-- CONTACT --}}
            <div class="col-12 col-md-6 col-lg-4">
                <h4 class="footer-heading">CONTACT</h4>

                <div class="d-flex align-items-start gap-2 mb-3">
                    <img src="/assets/img/telephone.png" alt="Phone"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">{{ $siteSettings?->footer_contact_mobile ?: '+880 1715-056952' }}</span>
                </div>

                <div class="d-flex align-items-start gap-2 mb-3">
                    <img src="/assets/img/mail.png" alt="Email"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">{{ $siteSettings?->footer_contact_email ?: 'contact@traceconsultingltd.com' }}</span>
                </div>

                <div class="d-flex align-items-start gap-2">
                    <img src="/assets/img/location.png" alt="Location"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">
                        {!! nl2br(e($siteSettings?->footer_contact_location ?: 'Level 2, Plot 285, Road 19/C, New DOHS, Mohakhali, Dhaka-1206')) !!}
                    </span>
                </div>
            </div>

        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="container-fluid px-lg-5 py-3" style="max-width: 1072px; margin: 0 auto;">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <p class="mb-0" style="font-size: 12px; color: #8fa6ad;">
                © 2025 Trace Consulting Limited. All rights reserved.
            </p>
            <div class="d-flex gap-3">
                <span class="footer-bottom-link">Privacy Policy</span>
                <span class="footer-bottom-link">Terms of Use</span>
            </div>
        </div>
    </div>

</footer>

{{-- Footer Styles --}}
<style>
    .footer-heading {
        font-size: 13px;
        letter-spacing: 1px;
        margin-bottom: 18px;
        color: #F47735;
    }

    .footer-link {
        font-size: 13px;
        color: #8fa6ad;
        margin-bottom: 10px;
        cursor: pointer;
        transition: color .3s;
    }

    .footer-link:hover {
        color: #F47735;
    }

    .footer-social {
        display: inline-block;
        opacity: 0.8;
        cursor: pointer;
        transition: opacity .3s;
    }

    .footer-social:hover {
        opacity: 1;
    }

    .footer-bottom-link {
        font-size: 12px;
        color: #8fa6ad;
        cursor: pointer;
        transition: color .3s;
    }

    .footer-bottom-link:hover {
        color: #F47735;
    }

    .footer-brand {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .footer-brand-title {
        font-size: 20px;
        letter-spacing: 1px;
        color: #ffffff;
        margin-bottom: 2px;
    }

    .footer-brand-tagline {
        font-size: 11px;
        color: #8fa6ad;
    }
</style>