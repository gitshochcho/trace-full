@php
    use Illuminate\Support\Str;

    // Fallback chain: page/entity override (passed in via $seo*) → global Setting defaults → hardcoded last resort.
    $seoTitle = trim($seoTitle ?? '') ?: ($siteSettings?->default_meta_title ?: 'TRACE Consulting');
    $seoDescription = trim(strip_tags($seoDescription ?? '')) ?: ($siteSettings?->default_meta_description ?: 'TRACE Consulting is a strategic advisory firm specializing in international trade, economic policy, and regulatory reform.');
    $seoDescription = Str::limit($seoDescription, 160, '');
    $seoImage = $seoImage ?? asset('assets/img/og-tag-image.jpeg');
    $seoUrl = $seoUrl ?? url()->current();
    $seoCanonical = $seoCanonical ?? $seoUrl;
    $seoType = $seoType ?? 'website';
    $seoSiteName = $siteSettings?->default_og_site_name ?: 'TRACE Consulting';
    $seoLocale = $seoLocale ?? ($siteSettings?->default_og_locale ?: 'en_US');
    $seoRobots = $seoRobots ?? ($siteSettings?->default_robots ?: 'index,follow');
    $seoAuthor = $seoAuthor ?? null;
    $seoImageAlt = $seoImageAlt ?? $seoTitle;

    // Open Graph title/description default to the main SEO title/description when not explicitly overridden.
    $ogTitle = trim($ogTitle ?? '') ?: $seoTitle;
    $ogDescription = trim($ogDescription ?? '') ?: $seoDescription;

    // Twitter Card defaults to the OG values when not explicitly overridden.
    $twitterCard = $twitterCard ?? 'summary_large_image';
    $twitterTitle = trim($twitterTitle ?? '') ?: $ogTitle;
    $twitterDescription = trim($twitterDescription ?? '') ?: $ogDescription;
    $twitterImage = $twitterImage ?? $seoImage;
    $twitterSite = $twitterSite ?? ($siteSettings?->default_twitter_site ?: null);
    $twitterCreator = $twitterCreator ?? null;

    // Custom admin-added <meta> tags (dynamic key/value system), if the calling view passed any.
    // Reserved keys are already rendered by this template above — skip any custom meta that
    // collides with one of them so admins can't accidentally create a duplicate tag.
    $reservedMetaKeys = [
        'description', 'robots', 'author', 'og:type', 'og:url', 'og:title', 'og:description',
        'og:image', 'og:image:alt', 'og:site_name', 'og:locale', 'fb:app_id',
        'article:author', 'article:section', 'article:published_time', 'article:modified_time',
        'twitter:card', 'twitter:title', 'twitter:description', 'twitter:image', 'twitter:site', 'twitter:creator',
    ];
    $customMetas = ($customMetas ?? collect())->reject(
        fn ($meta) => in_array(strtolower($meta->key), $reservedMetaKeys, true)
    );
@endphp
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{{ $seoTitle }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $seoDescription }}">
<meta name="robots" content="{{ $seoRobots }}">
@if($seoAuthor)
<meta name="author" content="{{ $seoAuthor }}">
@endif
<link rel="canonical" href="{{ $seoCanonical }}">
@isset($seoPrevUrl)
<link rel="prev" href="{{ $seoPrevUrl }}">
@endisset
@isset($seoNextUrl)
<link rel="next" href="{{ $seoNextUrl }}">
@endisset

{{-- Facebook / Open Graph --}}
<meta property="og:type" content="{{ $seoType }}">
<meta property="og:url" content="{{ $seoUrl }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:image:alt" content="{{ $seoImageAlt }}">
<meta property="og:site_name" content="{{ $seoSiteName }}">
<meta property="og:locale" content="{{ $seoLocale }}">
<meta property="fb:app_id" content="1302728604857233">

@if($seoType === 'article')
    @isset($articleAuthor)
    <meta property="article:author" content="{{ $articleAuthor }}">
    @endisset
    @isset($articleSection)
    <meta property="article:section" content="{{ $articleSection }}">
    @endisset
    @isset($articlePublishedTime)
    <meta property="article:published_time" content="{{ $articlePublishedTime }}">
    @endisset
    @isset($articleModifiedTime)
    <meta property="article:modified_time" content="{{ $articleModifiedTime }}">
    @endisset
@endif

{{-- Twitter Card --}}
<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $twitterTitle }}">
<meta name="twitter:description" content="{{ $twitterDescription }}">
<meta name="twitter:image" content="{{ $twitterImage }}">
@if($twitterSite)
<meta name="twitter:site" content="{{ $twitterSite }}">
@endif
@if($twitterCreator)
<meta name="twitter:creator" content="{{ $twitterCreator }}">
@endif

{{-- Custom meta tags added from the admin panel --}}
@foreach($customMetas as $customMeta)
    @if($customMeta->usesPropertyAttribute())
<meta property="{{ $customMeta->key }}" content="{{ $customMeta->value }}">
    @else
<meta name="{{ $customMeta->key }}" content="{{ $customMeta->value }}">
    @endif
@endforeach
