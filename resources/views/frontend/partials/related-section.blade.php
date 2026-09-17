{{--
    Reusable "Related X" section for the Service / Project / Team / Insight detail pages.
    Renders nothing if $items is empty, so pages an admin hasn't linked yet stay clean.
    Shows the first 3 cards; if the admin linked more, a "Show more" toggle reveals the rest.

    Required props:
      $title : string          Section heading, e.g. "Related Projects"
      $items : Collection      Project|Insight|Team|Service models
      $type  : string          'project' | 'insight' | 'team' | 'service'
                                Also drives a per-type colour + icon so the 2-3 sections
                                stacked on one page read as distinct zones, not repeats.

    Optional props:
      $containerClass : string  A container class already defined on the including page
                                 (e.g. 'custom-container-content'), reused here so this
                                 section lines up exactly with the page's other sections
                                 instead of guessing a max-width/padding of its own.
--}}
@php
    $items = $items ?? collect();
    // Matches --grid-cols per type below, so the first row is always full before "Show more".
    $visibleCount = $type === 'team' ? 4 : 3;
    $typeIcon = [
        'project' => 'fa-briefcase',
        'insight' => 'fa-lightbulb',
        'team' => 'fa-users',
        'service' => 'fa-layer-group',
    ][$type] ?? 'fa-circle';
@endphp
@if($items->isNotEmpty())
    @once
        @push('custome-css')
            <style>
                .related-section { padding: 2.75rem 0; background: #fff; }
                .related-section .related-section-inner { max-width: 1200px; margin: 0 auto; padding: 0 16px; }

                /* Per-type identity: a distinct accent colour (icon, underline, card edge)
                   so stacked sections on the same page read as separate zones — background
                   stays plain white throughout. */
                .related-section--project { --accent: #0F6FB0; --accent-tint: rgba(15,111,176,.12); --media-ratio: 16 / 9; --media-position: center; }
                .related-section--insight { --accent: #F47735; --accent-tint: rgba(244,119,53,.12); --media-ratio: 16 / 9; --media-position: center; }
                .related-section--team    { --accent: #01888C; --accent-tint: rgba(1,136,140,.12); --media-ratio: 4 / 5; --media-position: center 20%; --grid-cols: 4; }
                .related-section--service { --accent: #6D5BD0; --accent-tint: rgba(109,91,208,.12); --media-ratio: 16 / 9; --media-position: center; }

                .related-section .related-section-heading { display: flex; align-items: center; gap: .75rem; margin-bottom: 1.5rem; }
                .related-section .related-section-icon { flex-shrink: 0; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: var(--accent-tint); color: var(--accent); font-size: 1rem; }
                .related-section h2.related-section-title { position: relative; font-size: 1.5rem; font-weight: 700; padding-bottom: .5rem; margin: 0; color: #0f172a; }
                .related-section h2.related-section-title::after { content: ''; position: absolute; left: 0; bottom: 0; height: 3px; width: 48px; border-radius: 2px; background: var(--accent); transform: scaleX(0); transform-origin: left; transition: transform .7s cubic-bezier(.16,1,.3,1) .2s; }
                .related-section .related-section-heading.is-visible h2.related-section-title::after { transform: scaleX(1); }

                .related-section .related-grid { display: grid; grid-template-columns: repeat(var(--grid-cols, 3), minmax(0, 1fr)); gap: 1.5rem; }
                @media (max-width: 780px) { .related-section .related-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
                @media (max-width: 560px) { .related-section .related-grid { grid-template-columns: minmax(0, 1fr); } }

                /* Compound selectors (matching .related-card too) so these reliably win over
                   the base ".related-card { display: flex }" rule regardless of source order. */
                .related-section .related-card.related-card-extra { display: none; }
                .related-section .related-grid.is-expanded .related-card.related-card-extra { display: flex; }

                .related-section .related-card { display: flex; flex-direction: column; border: 1px solid #e5e7eb; border-top: 3px solid var(--accent); border-radius: 14px; overflow: hidden; background: #fff; text-decoration: none; color: inherit; height: 100%; transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease, border-color .3s ease; will-change: transform; }
                .related-section .related-card-media { width: 100%; aspect-ratio: var(--media-ratio, 4 / 3); background-color: #f1f5f9; background-position: var(--media-position, center); background-size: cover; background-repeat: no-repeat; transition: transform .5s ease; }
                .related-section .related-card-avatar { width: 100%; aspect-ratio: var(--media-ratio, 4 / 3); background: var(--accent-tint); display: flex; align-items: center; justify-content: center; font-size: 1.9rem; font-weight: 600; color: var(--accent); transition: transform .5s ease; }

                /* Hover: the image (fills its box edge-to-edge, no side gaps) zooms in gently. */
                .related-section .related-card:hover .related-card-media,
                .related-section .related-card:hover .related-card-avatar { transform: scale(1.03); }
                .related-section .related-card-body { padding: 1.1rem 1.25rem 1.35rem; flex-grow: 1; }
                .related-section .related-card-title { font-size: 1.1rem; font-weight: 600; margin: 0 0 .35rem; color: #0f172a; line-height: 1.4; }
                .related-section .related-card-subtitle { font-size: .88rem; color: #64748b; margin: 0; }

                /* Show more / show less toggle */
                .related-section .related-expand-wrap { display: flex; justify-content: center; margin-top: 1.75rem; }
                .related-section .related-expand-toggle { display: inline-flex; align-items: center; gap: .5rem; padding: .6rem 1.4rem; border-radius: 999px; border: 1.5px solid var(--accent); background: #fff; color: var(--accent); font-size: .92rem; font-weight: 600; cursor: pointer; transition: background .2s ease, color .2s ease; }
                .related-section .related-expand-toggle:hover { background: var(--accent); color: #fff; }
                .related-section .related-expand-toggle i { transition: transform .3s ease; }
                .related-section .related-expand-toggle.is-expanded i { transform: rotate(180deg); }

                /* Entrance animation: fades in, glides up and gently un-scales into place.
                   Duration/easing/delay are set from JS only for the entrance itself (see
                   below) so this never slows down the separate hover transition above. */
                .related-section .related-reveal { opacity: 0; transform: translateY(36px) scale(.94); }
                .related-section .related-reveal.is-visible { opacity: 1; transform: translateY(0) scale(1); }

                /* Hover: lift the whole card — declared after .is-visible so it wins the
                   transform tie-break once a card has settled into view. */
                .related-section .related-card:hover { box-shadow: 0 16px 32px rgba(15, 23, 42, .14); border-color: #cbd5e1; transform: translateY(-8px); color: inherit; }

                @media (prefers-reduced-motion: reduce) {
                    .related-section .related-reveal { opacity: 1; transform: none; }
                    .related-section h2.related-section-title::after { transition: none; transform: scaleX(1); }
                    .related-section .related-card,
                    .related-section .related-card-media,
                    .related-section .related-card-avatar { transition: none; }
                    .related-section .related-card:hover { transform: none; }
                    .related-section .related-card:hover .related-card-media,
                    .related-section .related-card:hover .related-card-avatar { transform: none; }
                }
            </style>
        @endpush

        @push('custome-js')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                    function reveal(el) {
                        var delay = Number(el.dataset.revealDelay || 0);

                        if (reduceMotion) {
                            el.classList.add('is-visible');
                            return;
                        }

                        // Entrance-only transition — cleared afterwards so it never lingers
                        // into the fast, independent hover transition defined in CSS.
                        el.style.transition = 'opacity .7s cubic-bezier(.16,1,.3,1) ' + delay + 'ms, transform .7s cubic-bezier(.16,1,.3,1) ' + delay + 'ms';
                        el.classList.add('is-visible');
                        window.setTimeout(function () { el.style.transition = ''; }, delay + 750);
                    }

                    // ── Scroll-reveal for the first 3 (always-visible) cards + heading ──
                    var revealEls = document.querySelectorAll('.related-section .related-reveal');

                    if (!('IntersectionObserver' in window)) {
                        revealEls.forEach(reveal);
                    } else {
                        var observer = new IntersectionObserver(function (entries, obs) {
                            entries.forEach(function (entry) {
                                if (entry.isIntersecting) {
                                    reveal(entry.target);
                                    obs.unobserve(entry.target);
                                }
                            });
                        }, { threshold: 0.1, rootMargin: '0px 0px -10% 0px' });

                        revealEls.forEach(function (el) { observer.observe(el); });
                    }

                    // ── Show more / show less ──
                    document.addEventListener('click', function (e) {
                        var toggle = e.target.closest('.related-expand-toggle');
                        if (!toggle) return;

                        var section = toggle.closest('.related-section');
                        var grid = section && section.querySelector('.related-grid');
                        if (!grid) return;

                        var expanding = !grid.classList.contains('is-expanded');
                        grid.classList.toggle('is-expanded', expanding);
                        toggle.classList.toggle('is-expanded', expanding);
                        toggle.setAttribute('aria-expanded', expanding ? 'true' : 'false');
                        toggle.querySelector('.related-expand-label').textContent = expanding
                            ? toggle.dataset.lessLabel
                            : toggle.dataset.moreLabel;

                        if (expanding) {
                            grid.querySelectorAll('.related-card-extra.related-reveal:not(.is-visible)').forEach(reveal);
                        } else {
                            section.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        }
                    });
                });
            </script>
        @endpush
    @endonce

    <section class="related-section related-section--{{ $type }}">
        <div class="{{ $containerClass ?? 'related-section-inner' }}">
            <div class="related-section-heading related-reveal">
                <span class="related-section-icon"><i class="fas {{ $typeIcon }}"></i></span>
                <h2 class="related-section-title">{{ $title }}</h2>
            </div>
            <div class="related-grid">
                @foreach($items as $item)
                    @php
                        $link = '#';
                        $cardTitle = '';
                        $cardSubtitle = '';
                        $imageUrl = null;
                        $initials = '';

                        switch ($type) {
                            case 'project':
                                $link = route('projectdetails', $item);
                                $cardTitle = $item->project_title;
                                $cardSubtitle = $item->client ?? $item->project_status ?? '';
                                $imageUrl = $item->heroImageUrl() ?: $item->imageUrl();
                                $initials = strtoupper(substr($cardTitle, 0, 2));
                                break;

                            case 'insight':
                                $firstArticle = $item->articles->first();
                                $link = $firstArticle
                                    ? route('articleDetails', $firstArticle)
                                    : route('articleDetails', ['insight_id' => $item->id]);
                                $cardTitle = $item->heading;
                                $cardSubtitle = $item->sub_heading ?: ($item->insightType->type ?? '');
                                $imageUrl = $item->imageUrl() ?: $item->articleImageUrl();
                                $initials = strtoupper(substr($cardTitle, 0, 2));
                                break;

                            case 'team':
                                $link = route('teamdetails', $item);
                                $cardTitle = $item->fullName();
                                $cardSubtitle = $item->designation ?? '';
                                $imageUrl = $item->imageUrl();
                                $initials = strtoupper(substr($cardTitle, 0, 1));
                                break;

                            case 'service':
                                $link = route('serviceDetails', $item->id);
                                $cardTitle = $item->service_name;
                                $cardSubtitle = $item->section ?? '';
                                $imageUrl = $item->imageUrl() ?: $item->iconUrl();
                                $initials = strtoupper(substr($cardTitle, 0, 2));
                                break;
                        }

                        $isExtra = $loop->index >= $visibleCount;
                    @endphp
                    <a href="{{ $link }}"
                       class="related-card related-reveal{{ $isExtra ? ' related-card-extra' : '' }}"
                       data-reveal-delay="{{ ($isExtra ? $loop->index - $visibleCount : $loop->index) * 90 }}">
                        @if($imageUrl)
                            <div class="related-card-media" style="background-image:url('{{ $imageUrl }}');"></div>
                        @else
                            <div class="related-card-avatar">{{ $initials }}</div>
                        @endif
                        <div class="related-card-body">
                            <p class="related-card-title">{{ $cardTitle }}</p>
                            @if($cardSubtitle)
                                <p class="related-card-subtitle">{{ $cardSubtitle }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            @if($items->count() > $visibleCount)
                @php $extraCount = $items->count() - $visibleCount; @endphp
                <div class="related-expand-wrap">
                    <button type="button"
                            class="related-expand-toggle"
                            aria-expanded="false"
                            data-more-label="Show {{ $extraCount }} more"
                            data-less-label="Show less">
                        <span class="related-expand-label">Show {{ $extraCount }} more</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            @endif
        </div>
    </section>
@endif
