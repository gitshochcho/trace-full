@php
  $logoImage = $siteSettings?->logoImageUrl();
  $logoText = $siteSettings?->logo_text ?: '';
  $logoTagline = $siteSettings?->logo_tagline ?: '';
  $hasText = $logoText || $logoTagline;
@endphp

<div class="logo-container d-flex align-items-center {{ $hasText ? 'gap-2' : '' }}">
  @if($logoImage)
    <img src="{{ $logoImage }}" alt="{{ $logoText }} logo" class="logo-img {{ $hasText ? 'logo-img-small' : 'logo-img-large' }}">
  @endif
  @if($logoText || $logoTagline)
  <div class="logo-text-content">
    @if($logoText)
    <h2 class="logo-title m-0 fw-bold">{{ $logoText }}</h2>
    @endif
    @if($logoTagline)
      <span class="logo-tagline">{{ $logoTagline }}</span>
    @endif
  </div>
  @endif
</div>

<style>
  /* Logo Container Styles */
  .logo-container {
    line-height: 1;
  }

  /* Logo Image Styles */
  .logo-img {
    height: auto;
    max-height: 70px;
    object-fit: contain;
    flex-shrink: 0;
  }

  .logo-img-small {
    width: 52px;
    max-height: 60px;
  }

  .logo-img-large {
    width: 200px;
    max-height: 70px;
  }

  /* Logo Text Content */
  .logo-text-content {
    line-height: 0.6;
    display: flex;
    flex-direction: column;
  }

  .logo-title {
    font-size: 22px;
    color: #1a2332;
    line-height: 1.2;
  }

  .logo-tagline {
    font-size: 13px;
    color: #64748B;
    line-height: 1.3;
  }

  /* Responsive: Extra Small Devices (< 480px) */
  @media (max-width: 479px) {
    .logo-img-small {
      width: 36px;
      max-height: 36px;
    }

    .logo-img-large {
      width: 120px;
      max-height: 45px;
    }

    .logo-title {
      font-size: 14px;
    }

    .logo-tagline {
      font-size: 10px;
    }

    .logo-container.gap-2 {
      gap: 0.5rem !important;
    }
  }

  /* Responsive: Small Devices (480px - 576px) */
  @media (min-width: 480px) and (max-width: 576px) {
    .logo-img-small {
      width: 40px;
      max-height: 40px;
    }

    .logo-img-large {
      width: 140px;
      max-height: 50px;
    }

    .logo-title {
      font-size: 16px;
    }

    .logo-tagline {
      font-size: 11px;
    }
  }

  /* Responsive: Medium Devices (577px - 768px) */
  @media (min-width: 577px) and (max-width: 768px) {
    .logo-img-small {
      width: 45px;
      max-height: 45px;
    }

    .logo-img-large {
      width: 165px;
      max-height: 55px;
    }

    .logo-title {
      font-size: 19px;
    }

    .logo-tagline {
      font-size: 12px;
    }
  }

  /* Responsive: Large Devices (769px - 991px) */
  @media (min-width: 769px) and (max-width: 991px) {
    .logo-img-small {
      width: 50px;
      max-height: 55px;
    }

    .logo-img-large {
      width: 185px;
      max-height: 65px;
    }

    .logo-title {
      font-size: 21px;
    }

    .logo-tagline {
      font-size: 12px;
    }
  }

  /* Responsive: Extra Large Devices (992px+) */
  @media (min-width: 992px) {
    .logo-img-small {
      width: 52px;
      max-height: 60px;
    }

    .logo-img-large {
      width: 200px;
      max-height: 70px;
    }

    .logo-title {
      font-size: 22px;
    }

    .logo-tagline {
      font-size: 13px;
    }
  }
</style>
