<footer style="background: #000D14; color: white;">

    <div class="container-fluid px-lg-5 py-5 border-bottom border-white border-opacity-10" style="max-width: 1072px; margin: 0 auto;">
        <div class="row g-4 g-lg-5">

            {{-- LEFT: Logo + About + Socials --}}
            <div class="col-12 col-md-6 col-lg-4">

                {{-- Brand --}}
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="/assets/img/image 12.png" alt="Trace Logo"
                         style="width: 38px; height: 38px; object-fit: contain;">
                    <div>
                        <h3 class="mb-0 fw-bold" style="font-size: 20px; letter-spacing: 1px;">TRACE</h3>
                        <span style="font-size: 11px; color: #8fa6ad;">Insight. Strategy. Impact</span>
                    </div>
                </div>

                {{-- Description --}}
                <p style="font-size: 13px; color: #8fa6ad; line-height: 1.7; max-width: 260px;">
                    Trace Consulting Limited provides strategic advisory, technical assistance,
                    and digital solutions to governments and development organisations across South Asia.
                </p>

                {{-- Socials --}}
                <div class="d-flex gap-3 mt-3">
                    <i class="fab fa-facebook-f footer-social"></i>
                    <i class="fab fa-twitter footer-social"></i>
                    <i class="fab fa-instagram footer-social"></i>
                    <i class="fab fa-linkedin-in footer-social"></i>
                </div>
            </div>

            {{-- COMPANY --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h4 class="footer-heading">COMPANY</h4>
                <ul class="list-unstyled">
                    <li class="footer-link">About Us</li>
                    <li class="footer-link">Our Team</li>
                    <li class="footer-link">Careers</li>
                    <li class="footer-link">Contact</li>
                </ul>
            </div>

            {{-- WORK --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h4 class="footer-heading">WORK</h4>
                <ul class="list-unstyled">
                    <li class="footer-link">Services</li>
                    <li class="footer-link">Projects</li>
                    <li class="footer-link">Insights</li>
                    <li class="footer-link">Partners</li>
                </ul>
            </div>

            {{-- CONTACT --}}
            <div class="col-12 col-md-6 col-lg-4">
                <h4 class="footer-heading">CONTACT</h4>

                <div class="d-flex align-items-start gap-2 mb-3">
                    <img src="/assets/img/telephone.png" alt="Phone"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">+880 1715-056952</span>
                </div>

                <div class="d-flex align-items-start gap-2 mb-3">
                    <img src="/assets/img/mail.png" alt="Email"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">contact@traceconsultingltd.com</span>
                </div>

                <div class="d-flex align-items-start gap-2">
                    <img src="/assets/img/location.png" alt="Location"
                         style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1); margin-top: 2px;">
                    <span style="font-size: 13px; color: #8fa6ad;">
                        Level 2, Plot 285, Road 19/C,<br>
                        New DOHS, Mohakhali, Dhaka-1206
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
        font-size: 14px;
        color: white;
        opacity: 0.8;
        cursor: pointer;
        transition: color .3s, opacity .3s;
    }

    .footer-social:hover {
        color: #F47735;
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
</style>