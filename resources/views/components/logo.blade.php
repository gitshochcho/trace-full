@php
  $logoImage = $siteSettings?->logoImageUrl();
  $logoText = $siteSettings?->logo_text ?: '';
  $logoTagline = $siteSettings?->logo_tagline ?: '';
@endphp

<div class="d-flex align-items-center gap-2">
  @if($logoImage)
    <img src="{{ $logoImage }}" alt="{{ $logoText }} logo" style="width: 52px; height: auto; object-fit: contain;">
  @endif
  <div style="line-height: .6;">
    <h2 class="m-0 fw-bold" style="font-size: 22px; color: #1a2332;">{{ $logoText }}</h2>
    @if($logoTagline)
      <span style="font-size: 13px; color: #64748B;">{{ $logoTagline }}</span>
    @endif
  </div>
</div>
