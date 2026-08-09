@php
    $orgSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'TRACE Consulting',
        'url' => url('/'),
        'logo' => asset('assets/img/og-tag-image.jpeg'),
        'sameAs' => array_values(array_filter([
            config('services.social.facebook'),
            config('services.social.linkedin'),
            config('services.social.twitter'),
        ])),
    ];

    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'TRACE Consulting',
        'url' => url('/'),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($orgSchema, JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES) !!}</script>
@stack('schema')
