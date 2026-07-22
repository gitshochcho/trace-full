@extends('frontend.layout.app')

@push('custome-css')
<style>
    .page-align-container { max-width: 1072px; margin: 0 auto; }

    /* Breadcrumb */
    .service-breadcrumb {
        background: #F8F9FB;
        border-bottom: 1px solid #E5E9ED;
        padding: 12px 0;
    }
    .breadcrumb-links { font-size: 13px; color: #94A3B8; }
    .breadcrumb-links a { color: #64748B; text-decoration: none; }
    .breadcrumb-links .sep { margin: 0 8px; }
    .breadcrumb-links .active { color: #01354B; font-weight: 600; }

    /* Hero */
    .innovations-hero { padding: 56px 0 32px; text-align: center; }
    .innovations-hero h1 {
        font-size: 38px; font-weight: 800; color: #01354B; margin-bottom: 14px;
    }
    .innovations-hero p {
        max-width: 620px; margin: 0 auto; color: #64748B; font-size: 15px; line-height: 1.7;
    }

    /* Filter bar */
    .innov-filter-bar { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; padding-bottom: 40px; }
    .innov-filter-link {
        display: inline-block; padding: 8px 18px; border-radius: 100px;
        font-size: 13px; font-weight: 600; color: #01354B; background: #F1F5F9;
        text-decoration: none; white-space: nowrap; transition: 0.2s; cursor: pointer;
    }
    .innov-filter-link:hover { background: #E6F7F8; color: #01888C; }
    .innov-filter-link.active { background: #01354B; color: #fff; }

    /* Card grid */
    .innov-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; padding-bottom: 20px; }
    .innov-card {
        background: #fff; border: 1px solid #E3E8EB; border-radius: 14px; overflow: hidden;
        display: flex; flex-direction: column;
        box-shadow: 0 4px 14px rgba(1, 53, 75, 0.06);
        transition: box-shadow 0.3s, transform 0.3s, border-color 0.3s;
        text-decoration: none; color: inherit;
    }
    .innov-card:hover { box-shadow: 0 10px 28px rgba(1, 53, 75, 0.14); transform: translateY(-4px); border-color: #4CC3C3; }
    .innov-card-img-box { position: relative; height: 170px; overflow: hidden; background: #f1f4f7; border-radius: 14px 14px 0 0; }
    .innov-card-img-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .innov-card:hover .innov-card-img-box img { transform: scale(1.05); }
    .innov-card-body { padding: 16px 18px 20px; flex: 1; display: flex; flex-direction: column; }
    .innov-category { font-size: 12px; font-weight: 600; color: #01888C; margin-bottom: 8px; }
    .innov-title { font-size: 17px; font-weight: 800; color: #01354B; margin-bottom: 8px; line-height: 1.35; }
    .innov-desc {
        font-size: 13px; color: #64748B; line-height: 1.6; margin-bottom: 14px; text-align: justify; flex: 1;
    }
    .innov-link { font-size: 13px; font-weight: 700; color: #01888C; text-decoration: none; }
    .innov-link:hover { color: #01354B; }

    .innov-empty-note { text-align: center; color: #94A3B8; font-size: 14px; padding: 40px 0 60px; }

    @media (max-width: 900px) { .innov-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 600px) { .innov-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
@php
    $heroHeading    = $innovationsPageContent?->heading;
    $heroDescription= strip_tags($innovationsPageContent?->description ?? '');
@endphp

<nav class="service-breadcrumb">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">›</span>
            <span class="active">Our Innovation</span>
        </div>
    </div>
</nav>

@if ($heroHeading || $heroDescription)
<section class="innovations-hero">
    <div class="container-fluid px-lg-5 page-align-container">
        @if ($heroHeading)
            <h1>{{ $heroHeading }}</h1>
        @endif
        @if ($heroDescription)
            <p>{{ $heroDescription }}</p>
        @endif
    </div>
</section>
@endif

<section>
    <div class="container-fluid px-lg-5 page-align-container">

        <!-- @if($categories->isNotEmpty())
        <div class="innov-filter-bar" id="innovFilterBar">
            <span class="innov-filter-link active" data-filter="ALL">All</span>
            @foreach($categories as $category)
                <span class="innov-filter-link" data-filter="{{ strtoupper($category) }}">{{ $category }}</span>
            @endforeach
        </div>
        @endif -->

        @if($innovations->isEmpty())
            <div class="innov-empty-note">No innovations have been added yet.</div>
        @else
        <div class="innov-grid" id="innovGrid">
            @foreach($innovations as $innovation)
            <a href="{{ $innovation->website_link ?: '#' }}" class="innov-card" data-category="{{ strtoupper($innovation->category ?? '') }}" @if($innovation->website_link) target="_blank" rel="noopener" @endif>
                <div class="innov-card-img-box">
                    @if($innovation->imageUrl())
                        <img src="{{ $innovation->imageUrl() }}" alt="{{ $innovation->title }}" loading="lazy">
                    @endif
                </div>
                <div class="innov-card-body">
                    <!-- @if($innovation->category)
                        <span class="innov-category">{{ $innovation->category }}</span>
                    @endif -->
                    <h3 class="innov-title">{{ $innovation->title }}</h3>
                    @if($innovation->description)
                        <p class="innov-desc">{{ $innovation->description }}</p>
                    @endif
                    @if($innovation->website_link)
                        <span class="innov-link">Visit Website &rarr;</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        <!-- <div class="innov-empty-note">🚀 More innovations coming soon to drive greater impact.</div> -->
        @endif

    </div>
</section>

@include('frontend.layout.cta')

@endsection

@section('scripts')
<script>
(function () {
    const filterBar = document.getElementById('innovFilterBar');
    const grid = document.getElementById('innovGrid');
    if (!filterBar || !grid) return;

    const cards = grid.querySelectorAll('.innov-card');
    const links = filterBar.querySelectorAll('.innov-filter-link');

    filterBar.addEventListener('click', function (e) {
        const link = e.target.closest('.innov-filter-link');
        if (!link) return;

        links.forEach(l => l.classList.remove('active'));
        link.classList.add('active');

        const filter = link.dataset.filter;
        cards.forEach(card => {
            card.style.display = (filter === 'ALL' || card.dataset.category === filter) ? '' : 'none';
        });
    });
})();
</script>
@endsection
