@extends('frontend.layout.app')

@push('custome-css')
<style>
    .tag-dot { width: 8px; height: 8px; background-color: #01888C; border-radius: 50%; }
    .section-tag-pill {
        color: #00898e; font-size: 12px; font-weight: 700; letter-spacing: 1px;
        background: #e6f4f4; padding: 4px 12px; border-radius: 20px;
    }
    .text-teal { color: #00898e; }
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

    /* Filter bar */
    .updates-topbar { background: #fff; }
    .filter-link {
        display: inline-block; padding: 6px 16px; margin-right: 8px; border-radius: 100px;
        font-size: 13px; font-weight: 600; color: #64748B; background: #F1F5F9;
        text-decoration: none; white-space: nowrap; transition: 0.2s;
    }
    .filter-link:hover { background: #E6F7F8; color: #01888C; }
    .filter-link.active { background: #01354B; color: #fff; }

    /* Card grid (reused styling from home "Latest Updates" section) */
    .updates-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .news-card-link { text-decoration: none; color: inherit; }
    .news-small-card {
        width: 100%; height: 100%; background: #fff; border: 1px solid #E3E8EB; border-radius: 10px;
        overflow: hidden; display: flex; flex-direction: column;
        transition: box-shadow 0.3s, transform 0.3s, border-color 0.3s;
    }
    .news-card-link:hover .news-small-card {
        box-shadow: 0 10px 28px rgba(1, 53, 75, 0.16); transform: translateY(-4px); border-color: #4CC3C3;
    }
    .news-card-link:hover .news-card-img-box img { transform: scale(1.05); }
    .news-card-link:hover .news-footer-link { color: #01354B; }
    .news-small-img img { height: 170px; object-fit: cover; transition: transform 0.5s ease; width: 100%; display: block; }
    .news-card-img-box { position: relative; background: #f1f4f7; overflow: hidden; }
    .news-card-img-box.no-image { display: flex; align-items: center; justify-content: center; min-height: 170px; }
    .news-card-img-box.no-image i { font-size: 32px; color: #cbd5e1; }
    .news-img-overlay-gradient {
        position: absolute; inset: 0;
        background: linear-gradient(142.06deg, rgba(1, 53, 75, 0.6) 0%, rgba(1, 136, 140, 0.3) 100%);
    }
    .news-badge-custom {
        position: absolute; bottom: 12px; left: 12px; background: #F47735; color: #fff;
        font-size: 10px; padding: 3px 10px; border-radius: 100px;
    }
    .news-card-body-small { padding: 18px 20px 12px; flex: 1; }
    .news-card-h-small { font-size: 15px; font-weight: 700; color: #01354B; line-height: 1.4; margin-bottom: 0; }
    .news-card-footer-small {
        display: flex; justify-content: space-between; align-items: center;
        padding: 12px 20px; border-top: 1px solid #F1F5F9;
    }
    .news-meta-text { font-size: 11px; color: #94A3B8; }
    .news-footer-link { font-size: 12px; color: #01888C; font-weight: 700; text-decoration: none; transition: color 0.3s; }

    @media (max-width: 900px) {
        .updates-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
        .updates-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
@php
    $updHeading    = $latestUpdatesContent?->heading     ?? 'News & Features';
    $updDesignWord = $latestUpdatesContent?->design_word ?? '';
    $updDescription= strip_tags($latestUpdatesContent?->description ?? '');
    $sourceIconMap = ['project' => 'fa-folder-open', 'job' => 'fa-briefcase', 'insight' => 'fa-newspaper'];
@endphp

<nav class="service-breadcrumb">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">›</span>
            <span class="active">Latest Updates</span>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="py-5" style="background-color: #002d3a; color: #fff;">
    <div class="container-fluid px-lg-5 page-align-container py-lg-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-3" style="font-size: 12px; letter-spacing: 1px; color: #e85d26; font-weight: 700;">
                    <span style="width: 25px; height: 2px; background: #e85d26;"></span>
                    LATEST UPDATES
                </div>
                <h1 class="display-5 fw-bolder mb-3" style="line-height: 1.1;">
                    @if($updDesignWord && str_contains($updHeading, $updDesignWord))
                        {{ \Illuminate\Support\Str::before($updHeading, $updDesignWord) }}<span style="color:#00bfc5;">{{ $updDesignWord }}</span>{{ \Illuminate\Support\Str::after($updHeading, $updDesignWord) }}
                    @else
                        {{ $updHeading }}
                    @endif
                </h1>
                @if($updDescription)
                <p class="lead opacity-75 mb-0" style="font-size: 15px; max-width: 620px; color: rgba(255,255,255,0.8); text-align: justify;">
                    {{ $updDescription }}
                </p>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- FILTER BAR --}}
<section class="updates-topbar border-bottom sticky-top py-3 shadow-sm">
    <div class="container-fluid px-lg-5 page-align-container">
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('latestUpdates') }}" class="filter-link {{ $activeFilter === 'ALL' ? 'active' : '' }}">ALL ({{ $counts['ALL'] }})</a>
            <a href="{{ route('latestUpdates', ['type' => 'insight']) }}" class="filter-link {{ $activeFilter === 'INSIGHT' ? 'active' : '' }}">INSIGHTS ({{ $counts['INSIGHT'] }})</a>
            <a href="{{ route('latestUpdates', ['type' => 'project']) }}" class="filter-link {{ $activeFilter === 'PROJECT' ? 'active' : '' }}">PROJECTS ({{ $counts['PROJECT'] }})</a>
            <a href="{{ route('latestUpdates', ['type' => 'job']) }}" class="filter-link {{ $activeFilter === 'JOB' ? 'active' : '' }}">CAREERS ({{ $counts['JOB'] }})</a>
        </div>
    </div>
</section>

{{-- GRID --}}
<section class="py-5 bg-white">
    <div class="container-fluid px-lg-5 page-align-container">

        @if($paginatedUpdates->isEmpty())
            <div class="text-center py-5 text-muted">No updates found.</div>
        @else
        <div class="updates-grid">
            @foreach($paginatedUpdates as $item)
            @php
                $itemDate = $item->date instanceof \Carbon\Carbon ? $item->date->format('M d, Y') : ($item->date ? \Carbon\Carbon::parse($item->date)->format('M d, Y') : '');
                $typeIcon = $sourceIconMap[$item->source] ?? 'fa-newspaper';
            @endphp
            <a href="{{ $item->link }}" class="news-card-link" @if($item->is_external) target="_blank" rel="noopener" @endif>
                <div class="news-small-card">
                    <div class="news-card-img-box news-small-img {{ !$item->image ? 'no-image' : '' }}">
                        @if($item->image)
                            <img src="{{ $item->image }}" alt="{{ $item->heading }}" loading="lazy">
                            <div class="news-img-overlay-gradient"></div>
                        @else
                            <i class="fas {{ $typeIcon }}"></i>
                        @endif
                        <span class="news-badge-custom" style="background: #01888C;">{{ strtoupper($item->badge_label) }}</span>
                    </div>
                    <div class="news-card-body-small">
                        <h4 class="news-card-h-small">{{ $item->heading }}</h4>
                    </div>
                    <div class="news-card-footer-small">
                        <span class="news-meta-text">{{ $itemDate }}{{ $itemDate && $item->extra ? ' · ' : '' }}{{ $item->extra }}</span>
                        <span class="news-footer-link">{{ $item->action_label }} &rarr;</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        @if($paginatedUpdates->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $paginatedUpdates->appends(['type' => request('type')])->links() }}
        </div>
        @endif
        @endif

    </div>
</section>

@include('frontend.layout.cta')

@endsection
