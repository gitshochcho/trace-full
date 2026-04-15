<section class="cta-section">
    <div class="custom-container">
        <div class="cta-content-wrapper">
            <div class="row align-items-center gy-4">
                
                <div class="col-lg-8">
                    <div class="cta-tag">
                        <span class="line"></span>
                        WORK WITH US
                    </div>
                    <h2 class="cta-title">
                        Have a project in mind? <br>
                        Let’s build something <span>that lasts.</span>
                    </h2>
                    <p class="cta-desc">
                        Whether reforming a regulatory system, building technical capacity, or modernising digital infrastructure — we'd like to hear from you.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <button class="cta-btn">
                        Get in Touch →
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- CTA Styles --}}
<style>
/* ================= CTA SECTION ================= */
.cta-section {
    width: 100%;
    background: #01354B; /* ছবির গাঢ় নীল রঙ */
    padding: 100px 0;
    position: relative;
    overflow: hidden; /* বৃত্তটি বাইরে যেন না যায় */
}

/* ডানদিকের সেই হালকা বৃত্তাকার শেপ */
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

/* কন্টেইনার এবং এলাইনমেন্ট */
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
    color: #4DC0C4; /* ছবির আকাশী রঙ */
    font-weight: 600;
    margin-bottom: 15px;
}

.cta-tag .line {
    width: 25px;
    height: 2px;
    background: #F47735; /* সেই কমলা দাগ */
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