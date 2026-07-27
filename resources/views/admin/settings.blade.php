@extends('layouts.app')

@section('content')
    @php
        $socialLinks = old('social_links', $setting->social_links ?? []);
        if (! is_array($socialLinks)) {
            $socialLinks = [];
        }
        if (empty($socialLinks)) {
            $socialLinks = [
                ['title' => 'Facebook', 'link' => '', 'media_key' => null],
            ];
        }
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Settings</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-10">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Website Settings</h3>
                        </div>
                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Logo Image</label>
                                        <input type="hidden" name="remove_logo_image" value="0" id="logoRemoveImageInput">
                                        <input type="file" id="logoImageInput" name="logo_image" class="form-control @error('logo_image') is-invalid @enderror" data-max-size="2048" data-max-width="240" data-max-height="80">
                                        @error('logo_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 240×80px (transparent PNG preferred, max 2MB) — supports PNG, JPG, WEBP, SVG</small>
                                        @if($setting?->logoImageUrl())
                                            <div id="existingLogoImageWrap" class="mt-2 position-relative d-inline-block">
                                                <img src="{{ $setting->logoImageUrl() }}" alt="Current logo" style="max-height: 70px;">
                                                <button type="button" id="removeLogoImageBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:22px;height:22px;font-size:12px;" title="Remove current logo">&times;</button>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Logo Text</label>
                                        <input type="text" name="logo_text" value="{{ old('logo_text', $setting->logo_text ?? '') }}" class="form-control @error('logo_text') is-invalid @enderror" placeholder="TRACE">
                                        @error('logo_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Logo Motto</label>
                                        <input type="text" name="logo_tagline" value="{{ old('logo_tagline', $setting->logo_tagline ?? '') }}" class="form-control @error('logo_tagline') is-invalid @enderror" placeholder="moto">
                                        @error('logo_tagline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Favicon Image</label>
                                        <input type="hidden" name="remove_favicon_image" value="0" id="faviconRemoveImageInput">
                                        <input type="file" id="faviconImageInput" name="favicon_image" class="form-control @error('favicon_image') is-invalid @enderror" data-max-size="512" data-max-width="64" data-max-height="64">
                                        @error('favicon_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 64×64px (square, max 512KB) — supports PNG, JPG, WEBP, SVG, ICO</small>
                                        @if($setting?->faviconImageUrl())
                                            <div id="existingFaviconImageWrap" class="mt-2 position-relative d-inline-block">
                                                <img src="{{ $setting->faviconImageUrl() }}" alt="Current favicon" style="max-height: 40px; max-width: 40px;">
                                                <button type="button" id="removeFaviconImageBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:20px;height:20px;font-size:11px;" title="Remove current favicon">&times;</button>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Footer Contact Mobile</label>
                                        <input type="text" name="footer_contact_mobile" value="{{ old('footer_contact_mobile', $setting->footer_contact_mobile ?? '') }}" class="form-control @error('footer_contact_mobile') is-invalid @enderror">
                                        @error('footer_contact_mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Footer Contact Email</label>
                                        <input type="email" name="footer_contact_email" value="{{ old('footer_contact_email', $setting->footer_contact_email ?? '') }}" class="form-control @error('footer_contact_email') is-invalid @enderror">
                                        @error('footer_contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Footer Contact Location</label>
                                        <textarea name="footer_contact_location" rows="4" class="form-control @error('footer_contact_location') is-invalid @enderror">{{ old('footer_contact_location', $setting->footer_contact_location ?? '') }}</textarea>
                                        @error('footer_contact_location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Footer Description</label>
                                        <textarea name="footer_description" rows="4" class="form-control @error('footer_description') is-invalid @enderror">{{ old('footer_description', $setting->footer_description ?? '') }}</textarea>
                                        @error('footer_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label mb-0">Social Links</label>
                                            <button type="button" class="btn btn-sm btn-outline-primary" id="addSocialLink">Add Row</button>
                                        </div>

                                        <div id="socialLinksWrapper" class="d-grid gap-3">
                                            @foreach($socialLinks as $index => $socialLink)
                                                <div class="row g-2 social-link-row align-items-end">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="social_links[{{ $index }}][title]" value="{{ $socialLink['title'] ?? '' }}" class="form-control" placeholder="Facebook">
                                                        <input type="hidden" name="social_links[{{ $index }}][media_key]" value="{{ $socialLink['media_key'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Link</label>
                                                        <input type="text" name="social_links[{{ $index }}][link]" value="{{ $socialLink['link'] ?? '' }}" class="form-control" placeholder="https://...">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Icon Image</label>
                                                        <input type="hidden" name="social_links[{{ $index }}][remove_icon]" value="0" class="remove-icon-input">
                                                        <input type="file" name="social_links_icons[{{ $index }}]" class="form-control icon-file-input" accept="image/*" data-max-size="512" data-max-width="32" data-max-height="32">
                                                        <small class="text-muted"><i class="fas fa-info-circle"></i> 32×32px square</small>
                                                        @php
                                                            $existingIcon = null;
                                                            if (! empty($socialLink['media_key'])) {
                                                                $existingIcon = $setting?->getFirstMediaUrl('social_icon_' . $socialLink['media_key']);
                                                            }
                                                        @endphp
                                                        <div class="mt-2 position-relative d-inline-block icon-preview-wrap {{ $existingIcon ? '' : 'd-none' }}" data-saved-icon-url="{{ $existingIcon ?? '' }}">
                                                            <img src="{{ $existingIcon ?? '' }}" alt="Icon" style="height: 22px; width: 22px; object-fit: contain;">
                                                            <button type="button" class="btn btn-danger btn-sm remove-icon-btn position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:16px;height:16px;font-size:10px;line-height:1;" title="Remove icon">&times;</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-grid">
                                                        <button type="button" class="btn btn-outline-danger remove-social-link">&times;</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-text">Each social item supports title + link + uploaded icon image.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="socialLinkTemplate">
        <div class="row g-2 social-link-row align-items-end">
            <div class="col-md-4">
                <label class="form-label">Title</label>
                <input type="text" name="__NAME__[title]" class="form-control" placeholder="Facebook">
                <input type="hidden" name="__NAME__[media_key]" value="">
            </div>
            <div class="col-md-4">
                <label class="form-label">Link</label>
                <input type="text" name="__NAME__[link]" class="form-control" placeholder="https://...">
            </div>
            <div class="col-md-3">
                <label class="form-label">Icon Image</label>
                <input type="hidden" name="__NAME__[remove_icon]" value="0" class="remove-icon-input">
                <input type="file" name="__ICON_NAME__" class="form-control icon-file-input" accept="image/*" data-max-size="512" data-max-width="32" data-max-height="32">
                <small class="text-muted"><i class="fas fa-info-circle"></i> 32×32px square</small>
                <div class="mt-2 position-relative d-inline-block icon-preview-wrap d-none" data-saved-icon-url="">
                    <img src="" alt="Icon" style="height: 22px; width: 22px; object-fit: contain;">
                    <button type="button" class="btn btn-danger btn-sm remove-icon-btn position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:16px;height:16px;font-size:10px;line-height:1;" title="Remove icon">&times;</button>
                </div>
            </div>
            <div class="col-md-1 d-grid">
                <button type="button" class="btn btn-outline-danger remove-social-link">&times;</button>
            </div>
        </div>
    </template>

@push('custome-js')
<script>
    (function () {
        function wireSingleImageRemove(fileInputId, removeBtnId, removeInputId, existingWrapId) {
            const fileInput = document.getElementById(fileInputId);
            const removeBtn = document.getElementById(removeBtnId);
            const removeInput = document.getElementById(removeInputId);

            if (removeBtn && removeInput) {
                removeBtn.addEventListener('click', function () {
                    removeInput.value = '1';
                    const wrap = document.getElementById(existingWrapId);
                    if (wrap) wrap.remove();
                });
            }

            if (fileInput && removeInput) {
                fileInput.addEventListener('change', function () {
                    if (fileInput.files && fileInput.files.length > 0) {
                        removeInput.value = '0';
                    }
                });
            }
        }

        wireSingleImageRemove('logoImageInput', 'removeLogoImageBtn', 'logoRemoveImageInput', 'existingLogoImageWrap');
        wireSingleImageRemove('faviconImageInput', 'removeFaviconImageBtn', 'faviconRemoveImageInput', 'existingFaviconImageWrap');

        const wrapper = document.getElementById('socialLinksWrapper');
        const addButton = document.getElementById('addSocialLink');
        const template = document.getElementById('socialLinkTemplate');

        function reindexRows() {
            wrapper.querySelectorAll('.social-link-row').forEach((row, index) => {
                row.querySelectorAll('input').forEach((input) => {
                    input.name = input.name
                        .replace(/social_links\[\d+\]/, `social_links[${index}]`)
                        .replace(/social_links_icons\[\d+\]/, `social_links_icons[${index}]`);
                });
            });
        }

        addButton.addEventListener('click', function () {
            const index = wrapper.querySelectorAll('.social-link-row').length;
            const html = template.innerHTML
                .replaceAll('__NAME__', `social_links[${index}]`)
                .replaceAll('__ICON_NAME__', `social_links_icons[${index}]`);
            wrapper.insertAdjacentHTML('beforeend', html);
        });

        wrapper.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-social-link')) {
                event.target.closest('.social-link-row').remove();
                reindexRows();
                return;
            }

            if (event.target.classList.contains('remove-icon-btn')) {
                const row = event.target.closest('.social-link-row');
                const wrap = event.target.closest('.icon-preview-wrap');
                const fileInput = row ? row.querySelector('.icon-file-input') : null;
                const removeIconInput = row ? row.querySelector('.remove-icon-input') : null;
                const savedIconUrl = wrap ? wrap.dataset.savedIconUrl : '';

                if (fileInput) fileInput.value = '';

                if (savedIconUrl) {
                    if (removeIconInput) removeIconInput.value = '1';
                    if (wrap) wrap.classList.add('d-none');
                } else if (wrap) {
                    wrap.classList.add('d-none');
                    wrap.querySelector('img').src = '';
                }
            }
        });

        wrapper.addEventListener('change', function (event) {
            if (!event.target.classList.contains('icon-file-input')) return;

            const input = event.target;
            const row = input.closest('.social-link-row');
            const wrap = row ? row.querySelector('.icon-preview-wrap') : null;
            const removeIconInput = row ? row.querySelector('.remove-icon-input') : null;
            if (!wrap) return;

            const img = wrap.querySelector('img');
            const savedIconUrl = wrap.dataset.savedIconUrl || '';

            if (input.files && input.files.length > 0) {
                if (removeIconInput) removeIconInput.value = '0';
                img.src = URL.createObjectURL(input.files[0]);
                wrap.classList.remove('d-none');
            } else if (savedIconUrl) {
                if (removeIconInput) removeIconInput.value = '0';
                img.src = savedIconUrl;
                wrap.classList.remove('d-none');
            } else {
                img.src = '';
                wrap.classList.add('d-none');
            }
        });

        reindexRows();
    })();
</script>
@endpush
@endsection