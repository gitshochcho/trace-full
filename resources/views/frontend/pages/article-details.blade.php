@extends('frontend.layout.app')

@push('custome-css')

<style>

/* =========================================
   ARTICLE HERO
========================================= */
.article-hero {
    background: #01354B;
    padding: 40px 0 44px;
}

.article-hero-inner {
    max-width: 1072px;
    margin: 0 auto;
    padding: 0 24px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #94a3b8;
    text-decoration: none;
    margin-bottom: 22px;
    transition: color .2s;
}
.back-link:hover { color: #fff; }

.article-meta-top {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}

.art-tag {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.2px;
    padding: 5px 12px;
    border-radius: 4px;
}

.pub-tag {
    background: #F47735;
    color: #fff;
}

.cat-tag {
    background: rgba(34,193,195,.15);
    color: #22c1c3;
    border: 1px solid rgba(34,193,195,.3);
}

.article-title {
    font-size: 38px;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 24px;
    max-width: 760px;
}

.article-byline {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.author-avatar-sm {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
}

.byline-name {
    font-size: 13px;
    font-weight: 600;
    color: #e2e8f0;
}

.byline-sep {
    color: #64748b;
    font-size: 13px;
}

.byline-meta {
    font-size: 12px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* =========================================
   ARTICLE LAYOUT
========================================= */
.article-layout {
    max-width: 1072px;
    margin: 0 auto;
    padding: 48px 24px 80px;
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 48px;
    align-items: start;
}

/* =========================================
   LEFT — MAIN CONTENT
========================================= */
.article-content { min-width: 0; }

/* SHARE BAR */
.share-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.share-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    color: #94a3b8;
}

.share-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 1px solid #E5E9ED;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 13px;
    text-decoration: none;
    transition: .2s;
}
.share-btn:hover { border-color: #01888C; color: #01888C; }

.copy-link-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #22c1c3;
    text-decoration: none;
    margin-left: auto;
    font-weight: 600;
    transition: color .2s;
}
.copy-link-btn:hover { color: #01888C; }

/* HERO IMAGE */
.article-img-wrap { margin-bottom: 32px; }

.article-main-img {
    width: 100%;
    height: 320px;
    object-fit: cover;
    border-radius: 10px;
    display: block;
}

.img-caption {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 10px;
    line-height: 1.5;
    font-style: italic;
}

/* SECTION HEADINGS */
.section-heading {
    font-size: 22px;
    font-weight: 700;
    color: #0f172a;
    margin: 36px 0 14px;
    padding-bottom: 10px;
    border-bottom: 2px solid #F1F4F7;
}

.sub-heading {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    margin: 24px 0 10px;
}

/* BODY TEXT */
.body-text {
    font-size: 14.5px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 16px;
}

/* KEY FINDINGS BOX */
.key-findings-box {
    background: #F8FAFC;
    border: 1px solid #E5E9ED;
    border-left: 4px solid #01888C;
    border-radius: 10px;
    padding: 22px 24px;
    margin: 28px 0;
}

.kf-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
}

.kf-icon { font-size: 16px; }

.kf-title {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    color: #01888C;
}

.kf-list {
    list-style: none;
    padding-left: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 14px;
    counter-reset: keyfindings;
}

.kf-list li {
    font-size: 13.5px;
    color: #334155;
    line-height: 1.65;
    padding-left: 48px;
    position: relative;
    counter-increment: keyfindings;
}

.kf-list li::before {
    content: counter(keyfindings);
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #01888C;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
}

.kf-list li::marker { display: none; }

/* BLOCKQUOTE */
.pull-quote {
    border-left: 4px solid #F47735;
    margin: 28px 0;
    padding: 16px 20px;
    background: #FFFAF7;
    border-radius: 0 8px 8px 0;
    font-size: 15px;
    font-style: italic;
    color: #334155;
    line-height: 1.7;
}

/* POLICY REC BOX */
.policy-rec-box {
    background: #F0FAFA;
    border: 1px solid #B2E8E8;
    border-radius: 8px;
    padding: 16px 20px;
    font-size: 13.5px;
    color: #334155;
    line-height: 1.7;
    margin: 24px 0;
}

.policy-label {
    font-weight: 700;
    color: #01888C;
}

/* ARTICLE TAGS */
.article-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 36px;
    padding-top: 24px;
    border-top: 1px solid #F1F4F7;
}

.art-pill {
    font-size: 12px;
    color: #475569;
    background: #F1F4F7;
    padding: 6px 14px;
    border-radius: 100px;
    transition: .2s;
    cursor: pointer;
}
.art-pill:hover { background: #E2F5F5; color: #01888C; }

/* FOOTNOTE */
.article-footnote {
    font-size: 13px !important;
    color: #94a3b8 !important;
}
.article-footnote a { color: #22c1c3; text-decoration: none; }
.article-footnote a:hover { text-decoration: underline; }

/* =========================================
   RIGHT — SIDEBAR
========================================= */
.article-sidebar { display: flex; flex-direction: column; gap: 20px; position: sticky; top: 24px; }

.sidebar-card {
    background: #fff;
    border: 1px solid #E5E9ED;
    border-radius: 12px;
    padding: 20px;
}

.sidebar-heading {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    color: #94a3b8;
    margin-bottom: 14px;
}

/* TABLE OF CONTENTS */
.toc-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.toc-link {
    display: block;
    font-size: 13px;
    color: #64748b;
    text-decoration: none;
    padding: 8px 10px;
    border-radius: 6px;
    border-left: 2px solid transparent;
    transition: .2s;
    line-height: 1.4;
}

.toc-link:hover { background: #F8FAFC; color: #01888C; border-left-color: #01888C; }
.toc-active { background: #F0FAFA !important; color: #01888C !important; border-left-color: #01888C !important; font-weight: 600; }

/* DOWNLOAD CARD */
.download-card {
    background: #01354B;
    border: none;
    text-align: center;
}

.dl-icon {
    width: 44px;
    height: 44px;
    background: rgba(255,255,255,.12);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #fff;
    margin: 0 auto 12px;
}

.dl-text {
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 6px;
}

.dl-sub {
    font-size: 12px;
    color: #94a3b8;
    line-height: 1.5;
    margin-bottom: 16px;
}

.dl-btn {
    display: block;
    background: #F47735;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 11px 16px;
    border-radius: 6px;
    text-decoration: none;
    transition: background .2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
}
.dl-btn:hover { background: #d9622a; color: #fff; }

/* AUTHOR CARD */
.author-info {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.author-avatar-lg {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
}

.author-full-name {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 3px;
}

.author-role {
    font-size: 12px;
    color: #64748b;
    margin: 0;
}

.author-bio {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.65;
    margin: 0;
}

/* RELATED INSIGHTS */
.related-list { display: flex; flex-direction: column; gap: 14px; }

.related-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    cursor: pointer;
}

.related-thumb {
    width: 56px;
    height: 48px;
    border-radius: 6px;
    flex-shrink: 0;
    background-size: cover;
    background-position: center;
}

.related-text { flex: 1; min-width: 0; }

.related-cat {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #F47735;
    display: block;
    margin-bottom: 4px;
}

.related-title {
    font-size: 12.5px;
    color: #334155;
    line-height: 1.45;
    margin: 0;
    transition: color .2s;
}

.related-item:hover .related-title { color: #01888C; }

/* =========================================
   CTA SECTION
========================================= */
.article-cta {
    background: #01354B;
    padding: 72px 0;
}

.cta-inner {
    max-width: 1072px;
    margin: 0 auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 40px;
    align-items: center;
}

.cta-inner .cta-label {
    font-size: 11px;
    letter-spacing: 2px;
    color: #F47735;
    font-weight: 600;
    margin-bottom: 14px;
    display: block;
}

.cta-inner .cta-title {
    font-size: 34px;
    font-weight: 700;
    color: #fff;
    line-height: 1.3;
    margin-bottom: 14px;
}

.cta-inner .cta-title span { color: #22c1c3; }

.cta-inner .cta-desc {
    font-size: 14px;
    color: #94a3b8;
    line-height: 1.7;
    max-width: 480px;
    margin: 0;
}

.cta-btn {
    display: inline-block;
    background: #F47735;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    padding: 14px 28px;
    border-radius: 6px;
    text-decoration: none;
    transition: background .3s;
    white-space: nowrap;
}
.cta-btn:hover { background: #d9622a; color: #fff; }

/* =========================================
   RESPONSIVE
========================================= */
@media (max-width: 1024px) {
    .article-layout {
        grid-template-columns: 1fr 280px;
        gap: 32px;
    }
}

@media (max-width: 900px) {
    .article-layout {
        grid-template-columns: 1fr;
        padding: 36px 20px 60px;
    }

    .article-sidebar {
        position: static;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .article-title { font-size: 28px; }

    .cta-inner {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .cta-inner .cta-title { font-size: 26px; }
}

@media (max-width: 640px) {
    .article-hero { padding: 28px 0 32px; }
    .article-title { font-size: 22px; }
    .article-layout { padding: 24px 16px 48px; }

    .article-sidebar {
        grid-template-columns: 1fr;
    }

    .share-bar { gap: 8px; }
    .copy-link-btn { margin-left: 0; }

    .article-main-img { height: 220px; }

    .section-heading { font-size: 18px; }

    .article-cta { padding: 48px 0; }
    .cta-inner .cta-title { font-size: 22px; }

    .byline-sep { display: none; }
    .article-byline { gap: 8px; }
}

</style>
@endpush

@section('content')

@php
    $articleTypeLabel = strtoupper($article->insightType?->type ?: 'READ');
    $categoryLabel = $article->insight?->sub_heading ?: 'Insight';
    $articleTitle = $article->insight?->heading ?: 'Insight Article';
    // Team authors (multiple) — from insight level
    $authorTeamIds = $article->insight?->author_team_ids ?? [];
    $authorTeams   = !empty($authorTeamIds)
        ? \App\Models\Team::whereIn('id', $authorTeamIds)->get()
        : collect();
    // Fall back to article-level single author if insight has none
    if ($authorTeams->isEmpty() && $article->author) {
        $authorTeams = collect([$article->author]);
    }
    $primaryAuthor   = $authorTeams->first();
    $authorName      = $primaryAuthor?->fullName() ?: 'TRACE Research Desk';
    $authorRole      = $primaryAuthor?->designation ?: 'Author';
    $authorInitials  = collect(explode(' ', $authorName))->filter()->map(fn ($word) => strtoupper(substr($word, 0, 1)))->take(2)->implode('');
    $authorImageUrl  = $primaryAuthor?->imageUrl();

    // Outside authors
    $outsideAuthors  = $article->insight?->outside_authors ?? [];

    $publishedLabel = optional($article->published_at)->format('F Y') ?: 'Recent';
    $readMinutes = $article->read_minutes ?: 8;
    $viewCount = max(120, ($readMinutes * 90));
    $articleImage = $article->iconUrl() 
    ?: $article->insight?->articleImageUrl() 
    ?: $article->insight?->imageUrl() 
    ?: asset('assets/img/Trace team.png');
    $downloadUrl = $article->attachmentUrl() ?: ($article->insight?->attachmentUrl() ?: '#');

    $rawDescription = trim((string) ($article->description ?? $article->insight?->description ?? ''));
    $paragraphs = collect(preg_split('/\n\s*\n/', $rawDescription))->map(fn ($row) => trim($row))->filter()->values();

    $introParagraphs = $paragraphs->slice(0, 2);
    $mainParagraphs = $paragraphs->slice(2);
    if ($mainParagraphs->isEmpty()) {
        $mainParagraphs = $paragraphs;
    }

    $tags = collect([
        $article->insight?->heading,
        $article->insight?->sub_heading,
        strtoupper($article->insightType?->type ?: 'read'),
        $authorRole,
    ])->filter()->take(7);
@endphp

{{-- ==============================
     ARTICLE HERO
============================== --}}
<section class="article-hero">
    <div class="article-hero-inner">

        <a href="{{ route('insights') }}" class="back-link">← Back to Insights</a>

        <div class="article-meta-top">
            <span class="art-tag pub-tag">{{ $articleTypeLabel }}</span>
            <span class="art-tag cat-tag">{{ $categoryLabel }}</span>
        </div>

        <h1 class="article-title">{{ $articleTitle }}</h1>

        <div class="article-byline flex-wrap">
            @foreach($authorTeams as $teamAuthor)
            @php
                $tName     = $teamAuthor->fullName() ?: 'Author';
                $tInitials = collect(explode(' ', $tName))->filter()->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
                $tImgUrl   = $teamAuthor->imageUrl();
            @endphp
            <div class="author-avatar-sm" style="{{ $tImgUrl ? 'overflow:hidden; padding:0;' : 'background:#1a9e75;' }}">
                @if($tImgUrl)
                    <img src="{{ $tImgUrl }}" alt="{{ $tName }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                @else
                    {{ $tInitials }}
                @endif
            </div>
            <span class="byline-name">{{ $tName }}</span>
            @if(!$loop->last)<span class="byline-sep">&amp;</span>@endif
            @endforeach
            <span class="byline-sep">·</span>
            <span class="byline-meta"><i class="far fa-calendar"></i> {{ $publishedLabel }}</span>
            <span class="byline-sep">·</span>
            <span class="byline-meta"><i class="far fa-clock"></i> {{ $readMinutes }} min read</span>
            <span class="byline-sep">·</span>
            <span class="byline-meta"><i class="far fa-eye"></i> {{ number_format($viewCount) }} views</span>
        </div>

    </div>
</section>

{{-- ==============================
     ARTICLE BODY
============================== --}}
<div class="article-layout">

    {{-- ===== LEFT: MAIN CONTENT ===== --}}
    <div class="article-content">

        {{-- Share Bar --}}
       <div class="share-bar">
    <span class="share-label">SHARE</span>
    @forelse($article->social_links ?? [] as $social)
        <a href="{{ $social['link'] ?? '#' }}" class="share-btn" target="_blank" rel="noopener" title="{{ $social['name'] ?? '' }}">
            <i class="fab fa-{{ strtolower($social['name'] ?? 'link') }}"></i>
        </a>
    @empty
        <a href="#" class="share-btn"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="share-btn"><i class="fab fa-twitter"></i></a>
        <a href="#" class="share-btn"><i class="fab fa-linkedin-in"></i></a>
    @endforelse
    <a href="#" class="copy-link-btn" onclick="navigator.clipboard.writeText(window.location.href); return false;">
        <i class="far fa-copy"></i> Copy link
    </a>
</div>

        {{-- Hero Image --}}
        <div class="article-img-wrap">
              <img src="{{ $articleImage }}"
                  alt="{{ $articleTitle }}"
                 class="article-main-img">
             <p class="img-caption">
    {{ $article->image_description ?: ($categoryLabel . ' — published by TRACE Insights.') }}
</p>
        </div>

       @foreach($sections as $section)
    <h2 class="section-heading" id="section-{{ $loop->index }}">
        {{ $section->title }}
    </h2>
   <div class="body-text">{!! $section->description !!}</div>
@endforeach

        {{-- Tags --}}
        <div class="article-tags">
            @foreach($tags as $tag)
                <span class="art-pill">{{ $tag }}</span>
            @endforeach
        </div>

    </div>{{-- end article-content --}}

    {{-- ===== RIGHT: SIDEBAR ===== --}}
    <aside class="article-sidebar">

        {{-- Table of Contents --}}
        <div class="sidebar-card toc-card">
            <h4 class="sidebar-heading">CONTENTS</h4>
            <ul class="toc-list">
    @foreach($sections as $section)
        <li>
            <a href="#section-{{ $loop->index }}" class="toc-link">
                {{ $section->title }}
            </a>
        </li>
    @endforeach
</ul>
        </div>

        {{-- Download --}}
        <div class="sidebar-card download-card">
            <div class="dl-icon"><i class="far fa-file-alt"></i></div>
            <p class="dl-text">Download Full Publication</p>
            <p class="dl-sub">Get the complete PDF report, data appendices and methodology notes.</p>
            <a href="{{ $downloadUrl }}" class="dl-btn" target="_blank" rel="noopener"><i class="fas fa-download"></i> Download File</a>
        </div>

        {{-- Authors --}}
        <div class="sidebar-card author-card">
            <h4 class="sidebar-heading">{{ $authorTeams->count() + count($outsideAuthors) > 1 ? 'AUTHORS' : 'AUTHOR' }}</h4>

            {{-- Team Authors --}}
            @foreach($authorTeams as $teamAuthor)
            @php
                $tName     = $teamAuthor->fullName() ?: 'Author';
                $tRole     = $teamAuthor->designation ?: 'Author';
                $tInitials = collect(explode(' ', $tName))->filter()->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
                $tImgUrl   = $teamAuthor->imageUrl();
            @endphp
            <div class="author-info {{ !$loop->first ? 'mt-3 pt-3 border-top' : '' }}">
                <div class="author-avatar-lg" style="{{ $tImgUrl ? 'overflow:hidden; padding:0;' : 'background:#1a9e75;' }}">
                    @if($tImgUrl)
                        <img src="{{ $tImgUrl }}" alt="{{ $tName }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                    @else
                        {{ $tInitials }}
                    @endif
                </div>
                <div>
                    <p class="author-full-name">{{ $tName }}</p>
                    <p class="author-role">{{ $tRole }}</p>
                </div>
            </div>
            <p class="author-bio">{{ \Illuminate\Support\Str::limit(stripPTags($teamAuthor->description ?? ''), 150) }}</p>
            @endforeach

            {{-- Outside Authors (separate section) --}}
            @if(!empty($outsideAuthors))
                <div class="mt-3 pt-3 border-top">
                    <p class="sidebar-heading mb-2" style="font-size:10px;">CONTRIBUTING AUTHORS</p>
                    @foreach($outsideAuthors as $outside)
                    @php $oInitials = collect(explode(' ', $outside['name'] ?? 'A'))->filter()->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode(''); @endphp
                    <div class="author-info {{ !$loop->first ? 'mt-3 pt-2 border-top' : '' }}">
                        <div class="author-avatar-lg" style="background:#e85d26;">{{ $oInitials }}</div>
                        <div>
                            <p class="author-full-name">{{ $outside['name'] ?? '' }}</p>
                            <p class="author-role">Contributing Author</p>
                        </div>
                    </div>
                    @if(!empty($outside['description']))
                        <p class="author-bio">{!! \Illuminate\Support\Str::limit(strip_tags($outside['description']), 150) !!}</p>
                    @endif
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Related Insights --}}
        <div class="sidebar-card related-card">
            <h4 class="sidebar-heading">RELATED INSIGHTS</h4>
            <div class="related-list">
                @forelse($relatedArticles as $related)
                    <a href="{{ route('articleDetails', $related) }}" class="related-item text-decoration-none">
                        <div class="related-thumb" style="background-image: url('{{ $related->iconUrl() ?: ($related->insight?->imageUrl() ?: asset('assets/img/Op-Ed.png')) }}');"></div>
                        <div class="related-text">
                            <span class="related-cat">{{ strtoupper($related->insightType?->type ?: 'read') }}</span>
                            <p class="related-title">{{ \Illuminate\Support\Str::limit($related->title, 70) }}</p>
                        </div>
                    </a>
                @empty
                    <p class="small text-muted mb-0">No related insights available.</p>
                @endforelse

            </div>
        </div>

    </aside>

</div>{{-- end article-layout --}}

<!-- {{-- ==============================
     CTA
============================== --}}
<section class="article-cta">
    <div class="cta-inner">
        <div>
            <span class="cta-label">— WORK WITH US</span>
            <h2 class="cta-title">
                Have a project in mind?<br>
                Let's build something <span>that lasts.</span>
            </h2>
            <p class="cta-desc">
                Whether reforming a regulatory system, building technical capacity, or modernising
                digital infrastructure — we'd like to hear from you.
            </p>
        </div>
        <div>
            <a href="#" class="cta-btn">Get in Touch →</a>
        </div>
    </div>
</section> -->

@include('frontend.layout.cta')

@endsection

@section('scripts')
<script>
// Active TOC on scroll
(function () {
    const sections = document.querySelectorAll('h2[id]');
    const tocLinks = document.querySelectorAll('.toc-link');

    if (!sections.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                tocLinks.forEach(l => l.classList.remove('toc-active'));
                const active = document.querySelector(`.toc-link[href="#${entry.target.id}"]`);
                if (active) active.classList.add('toc-active');
            }
        });
    }, { rootMargin: '-20% 0px -70% 0px' });

    sections.forEach(s => observer.observe(s));
})();
</script>
@endsection