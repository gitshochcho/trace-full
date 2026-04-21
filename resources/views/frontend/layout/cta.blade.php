<section class="cta-section">
    @php
        use Illuminate\Support\Str;

        $ctaContent = contentBlock('work-with-us');
        $ctaTag = $ctaContent?->section ?: 'WORK WITH US';
        $ctaTitle = $ctaContent?->heading ?: 'Have a project in mind?';
        $ctaTitleSpan = $ctaContent?->design_word ?: 'that lasts.';
        $ctaDescription = $ctaContent?->description ?: "Whether reforming a regulatory system, building technical capacity, or modernising digital infrastructure — we'd like to hear from you.";
        $ctaButtonLabel = $ctaContent?->sub_heading ?: 'Get in Touch';
    @endphp

    <div class="container custom-cta-container"> {{-- ১০৭২পিএক্স কন্টেইনার --}}
        <div class="cta-content-wrapper">
            <div class="row align-items-center gy-4">
                
                <div class="col-lg-8">
                    <div class="cta-tag text-uppercase">
                        <span class="line"></span>
                        {{ $ctaTag }}
                    </div>
                    <h2 class="cta-title">
                        @if(!empty($ctaTitleSpan) && Str::contains($ctaTitle, $ctaTitleSpan))
                            {{ trim(Str::before($ctaTitle, $ctaTitleSpan)) }}
                            <br>
                            <span>{{ $ctaTitleSpan }}</span>{{ Str::after($ctaTitle, $ctaTitleSpan) }}
                        @else
                            {{ $ctaTitle }}
                            @if(!empty($ctaTitleSpan))
                                <br>
                                <span>{{ $ctaTitleSpan }}</span>
                            @endif
                        @endif
                    </h2>
                    <p class="cta-desc">
                        {!! $ctaDescription !!}
                    </p>
                </div>

                <div class="col-lg-4 text-center text-lg-end">
                    <button class="cta-btn">
                        {{ $ctaButtonLabel }} →
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- CTA Styles --}}
<style>
/* ================= CONTAINER FIX ================= */
.custom-cta-container {
    max-width: 1072px !important;
    margin: 0 auto;
    padding-left: 15px;
    padding-right: 15px;
}

/* ================= CTA SECTION ================= */
.cta-section {
    width: 100%;
    background: #01354B; 
    padding: 100px 0;
    position: relative;
    overflow: hidden; 
}

/* Background Circle Decoration */
.cta-section::after {
    content: "";
    position: absolute;
    right: -100px;
    top: -50px;
    width: 400px;
    height: 400px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    pointer-events: none;
}

.cta-content-wrapper {
    position: relative;
    z-index: 2;
}

/* Tag style (WORK WITH US) */
.cta-tag {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
    letter-spacing: 1px;
    color: #4DC0C4; 
    font-weight: 600;
    margin-bottom: 15px;
}

.cta-tag .line {
    width: 25px;
    height: 2px;
    background: #F47735; 
}

/* Title and Description */
.cta-title {
    font-size: 42px;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 15px;
}

.cta-title span {
    color: #4DC0C4;
}

.cta-desc {
    color: #cbd5e1;  
    font-size: 16px;
    line-height: 1.6;
    max-width: 650px;
}

.cta-desc p {
    color: #cbd5e1;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 14px;
}

.cta-desc p:last-child {
    margin-bottom: 0;
}

.cta-desc ul,
.cta-desc ol {
    margin: 0 0 14px 24px;
    color: #cbd5e1;
}

.cta-desc li {
    margin-bottom: 8px;
    line-height: 1.6;
    color: #cbd5e1;
}

/* Button style */
.cta-btn {
    background: #F47735;
    color: #ffffff;
    padding: 14px 32px;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s ease;
}

.cta-btn:hover {
    background: #ff8a4d;
    transform: translateY(-2px);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 991px) {
    .cta-section {
        padding: 70px 0;
        text-align: center;
    }
    .cta-tag {
        justify-content: center;
    }
    .cta-title {
        font-size: 32px;
    }
    .cta-desc {
        margin: 0 auto 30px;
    }
    .text-lg-end {
        text-align: center !important;
    }
}
</style>