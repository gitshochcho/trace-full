
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
<link href="{{asset('frontend/css/fontawesome-all.min.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/aos.min.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/swiper.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">

<!-- Favicon -->
@if(!empty($siteSettings?->faviconImageUrl()))
    <link rel="icon" href="{{ $siteSettings->faviconImageUrl() }}">
@else
    <link rel="icon" href="{{asset('frontend/assets/images/favicon.png')}}">
@endif
