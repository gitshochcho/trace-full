@php
    // $items: array of ['label' => string, 'url' => string|null]. Last item should have url = null (current page).
    $items = $items ?? [];
    $trail = array_merge([['label' => 'Home', 'url' => url('/')]], $items);

    $schemaItems = [];
    foreach ($trail as $index => $crumb) {
        $schemaItems[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $crumb['label'],
            'item' => $crumb['url'] ?: url()->current(),
        ];
    }

    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $schemaItems,
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES) !!}</script>
