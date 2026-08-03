@php
    $seoTitle = trim($seoTitle ?? '') ?: 'TRACE Consulting';
    $seoDescription = trim(strip_tags($seoDescription ?? '')) ?: 'TRACE Consulting delivers regulatory reform, technical capacity building and digital infrastructure solutions across Bangladesh and beyond.';
    $seoDescription = \Illuminate\Support\Str::limit($seoDescription, 160, '');
    $seoImage = $seoImage ?? asset('assets/img/og-tag-image.jpeg');
    $seoUrl = $seoUrl ?? url()->current();
    $seoType = $seoType ?? 'website';
    $seoSiteName = 'TRACE Consulting';
    $seoRobots = $seoRobots ?? 'index,follow';
@endphp
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{{ $seoTitle }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $seoDescription }}">
<meta name="robots" content="{{ $seoRobots }}">
<link rel="canonical" href="{{ $seoUrl }}">
@isset($seoPrevUrl)
<link rel="prev" href="{{ $seoPrevUrl }}">
@endisset
@isset($seoNextUrl)
<link rel="next" href="{{ $seoNextUrl }}">
@endisset

{{-- Facebook / Open Graph --}}
<meta property="og:type" content="{{ $seoType }}">
<meta property="og:url" content="{{ $seoUrl }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:site_name" content="{{ $seoSiteName }}">
<meta property="fb:app_id" content="1302728604857233">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">
