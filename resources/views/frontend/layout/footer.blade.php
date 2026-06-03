<footer style="background: #000D14; color: white;">
    @php
        $socialLinks = $siteSettings?->socialLinksWithIcons() ?? [];
    @endphp

    <div class="container-fluid px-lg-0 py-5 border-bottom border-white border-opacity-10" style="max-width: 1072px; margin: 0 auto;">
        {{-- Flex container to push items to far ends --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start g-4">

            {{-- LEFT SIDE: Logo + About + Socials --}}
            <div class="footer-left-section" style="max-width: 350px;">
                {{-- Brand --}}
                <div class="footer-brand mb-3">
                    @if($siteSettings?->logoImageUrl())
                        <img src="{{ $siteSettings->logoImageUrl() }}" alt="Trace Logo"
                             style="width: 200px; height: 70px; object-fit: contain;">
                    @endif
                    <div class="d-flex flex-column">
                        <h3 class="mb-0 fw-bold footer-brand-title">{{ $siteSettings?->logo_text ?: '' }}</h3>
                        <span class="footer-brand-tagline">{{ $siteSettings?->logo_tagline ?: '' }}</span>
                    </div>
                </div>

                {{-- Description --}}
                <p style="font-size: 13px; color: #8fa6ad; line-height: 1.7; margin-bottom: 20px; text-align: justify;">
                    {{ $siteSettings?->footer_description ?: '' }}
                </p>

                {{-- Socials --}}
                <div class="d-flex gap-3">
                    @foreach($socialLinks as $socialLink)
                        <a href="{{ $socialLink['link'] ?? '#' }}" target="_blank" rel="noreferrer" class="text-decoration-none" aria-label="{{ $socialLink['title'] ?? 'social link' }}">
                            @if(! empty($socialLink['icon_url']))
                                <img src="{{ $socialLink['icon_url'] }}" alt="{{ $socialLink['title'] ?? 'Social icon' }}" class="footer-social" style="width: 14px; height: 14px; object-fit: contain;">
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT SIDE: CONTACT --}}
            <div class="footer-right-section mt-4 mt-md-0" style="min-width: 280px;">
                <h4 class="footer-heading">CONTACT</h4>

                <div class="d-flex align-items-start gap-2 mb-3">
                    <img src="/assets/img/telephone.png" alt="Phone"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">{{ $siteSettings?->footer_contact_mobile ?: '' }}</span>
                </div>

                <div class="d-flex align-items-start gap-2 mb-3">
                    <img src="/assets/img/mail.png" alt="Email"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">{{ $siteSettings?->footer_contact_email ?: '' }}</span>
                </div>

                <div class="d-flex align-items-start gap-2">
                    <img src="/assets/img/location.png" alt="Location"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">
                        {!! nl2br(e($siteSettings?->footer_contact_location ?: '')) !!}
                    </span>
                </div>
            </div>

        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="container-fluid px-lg-0 py-3" style="max-width: 1072px; margin: 0 auto;">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <p class="mb-0" style="font-size: 12px; color: #8fa6ad;">
                © 2026 TRACE Consulting. All rights reserved.
            </p>
            <!-- <div class="d-flex gap-3">
                <span class="footer-bottom-link">Privacy Policy</span>
                <span class="footer-bottom-link">Terms of Use</span>
            </div> -->
        </div>
    </div>
</footer>

<style>
    .footer-heading {
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 18px;
        color: white;
    }

    .footer-social {
        display: inline-block;
        opacity: 0.8;
        transition: opacity .3s;
        filter: brightness(0) invert(1); /* আইকন সাদা করার জন্য */
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