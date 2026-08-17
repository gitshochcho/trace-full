@extends('layouts.app')

@section('content')
    @php
        $currentOgImageUrl = $pageSetting->ogImageUrl();
        $currentTwitterImageUrl = $pageSetting->twitterImageUrl();
        $previewTitle = old('meta_title', $pageSetting->meta_title) ?: ($defaults['meta_title'] ?? $pageSetting->page_name);
        $previewDescription = old('meta_description', $pageSetting->meta_description) ?: ($defaults['meta_description'] ?? '');
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Page Settings — {{ $pageSetting->page_name }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.pageSettings.index') }}">Page Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageSetting->page_name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-xl-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $pageSetting->page_name }}</h3>
                            <span class="badge bg-secondary ms-2">slug: {{ $pageSetting->page_slug }}</span>
                        </div>

                        <form action="{{ route('admin.pageSettings.update', $pageSetting) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-seo" type="button">SEO</button></li>
                                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-og" type="button">Open Graph</button></li>
                                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-twitter" type="button">Twitter / X</button></li>
                                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-advanced" type="button">Advanced / Custom Meta</button></li>
                                </ul>

                                <div class="tab-content pt-4">

                                    {{-- ============ SEO TAB ============ --}}
                                    <div class="tab-pane fade show active" id="tab-seo">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label for="meta_title_input" class="form-label mb-0">Meta Title</label>
                                                    @if(!empty($defaults['meta_title']))
                                                        <button type="button" class="btn btn-link btn-sm p-0" id="reset-meta-title-btn">
                                                            <i class="fas fa-undo me-1"></i>Reset to Default
                                                        </button>
                                                    @endif
                                                </div>
                                                <input type="text" name="meta_title" id="meta_title_input"
                                                       value="{{ old('meta_title', $pageSetting->meta_title) }}"
                                                       data-default="{{ $defaults['meta_title'] ?? '' }}"
                                                       data-counter="meta_title_counter"
                                                       class="form-control @error('meta_title') is-invalid @enderror"
                                                       maxlength="255"
                                                       placeholder="e.g. Our Services | TRACE Consulting">
                                                <div class="d-flex justify-content-between">
                                                    <small class="text-muted">Recommended around 50–60 characters.</small>
                                                    <small class="text-muted char-counter" id="meta_title_counter">0 / 60</small>
                                                </div>
                                                @error('meta_title')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label for="meta_description_input" class="form-label mb-0">Meta Description</label>
                                                    @if(!empty($defaults['meta_description']))
                                                        <button type="button" class="btn btn-link btn-sm p-0" id="reset-meta-description-btn">
                                                            <i class="fas fa-undo me-1"></i>Reset to Default
                                                        </button>
                                                    @endif
                                                </div>
                                                <textarea name="meta_description" id="meta_description_input" rows="4"
                                                          class="form-control @error('meta_description') is-invalid @enderror"
                                                          maxlength="500"
                                                          data-default="{{ $defaults['meta_description'] ?? '' }}"
                                                          data-counter="meta_description_counter"
                                                          placeholder="A short, compelling summary of this page for search results.">{{ old('meta_description', $pageSetting->meta_description) }}</textarea>
                                                <div class="d-flex justify-content-between">
                                                    <small class="text-muted">Recommended around 150–160 characters.</small>
                                                    <small class="text-muted char-counter" id="meta_description_counter">0 / 160</small>
                                                </div>
                                                @error('meta_description')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="canonical_url_input" class="form-label">Canonical URL</label>
                                                <input type="url" name="canonical_url" id="canonical_url_input"
                                                       value="{{ old('canonical_url', $pageSetting->canonical_url) }}"
                                                       class="form-control @error('canonical_url') is-invalid @enderror"
                                                       placeholder="https://traceconsultingltd.com/{{ $pageSetting->page_slug }} (leave blank to auto-use this page's URL)">
                                                <small class="text-muted">Leave blank unless this page's content is duplicated elsewhere and you need to point search engines to a preferred URL.</small>
                                                @error('canonical_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="robots_select" class="form-label">Robots</label>
                                                <select name="robots" id="robots_select" class="form-select @error('robots') is-invalid @enderror">
                                                    @foreach(\App\Models\PageSetting::ROBOTS_OPTIONS as $value => $label)
                                                        <option value="{{ $value }}" @selected(old('robots', $pageSetting->robots ?: 'index,follow') === $value)>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @error('robots')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="author_input" class="form-label">Author</label>
                                                <input type="text" name="author" id="author_input"
                                                       value="{{ old('author', $pageSetting->author) }}"
                                                       class="form-control @error('author') is-invalid @enderror"
                                                       maxlength="255" placeholder="TRACE Consulting">
                                                @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ============ OPEN GRAPH TAB ============ --}}
                                    <div class="tab-pane fade" id="tab-og">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">OG Type</label>
                                                <select name="og_type" id="og_type_select" class="form-select @error('og_type') is-invalid @enderror">
                                                    @foreach(\App\Models\PageSetting::OG_TYPE_OPTIONS as $type)
                                                        <option value="{{ $type }}" @selected(old('og_type', $pageSetting->og_type ?: 'website') === $type)>{{ ucfirst($type) }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">Use "Article" only for feed/publication-style pages.</small>
                                                @error('og_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-8">
                                                <label class="form-label">OG Locale</label>
                                                <input type="text" name="og_locale"
                                                       value="{{ old('og_locale', $pageSetting->og_locale ?: 'en_US') }}"
                                                       class="form-control @error('og_locale') is-invalid @enderror"
                                                       maxlength="20" placeholder="en_US">
                                                @error('og_locale')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">OG Title <small class="text-muted">(defaults to Meta Title when left blank)</small></label>
                                                <input type="text" name="og_title"
                                                       value="{{ old('og_title', $pageSetting->og_title) }}"
                                                       class="form-control @error('og_title') is-invalid @enderror"
                                                       maxlength="255" placeholder="{{ $previewTitle }}">
                                                @error('og_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">OG Description <small class="text-muted">(defaults to Meta Description when left blank)</small></label>
                                                <textarea name="og_description" rows="3"
                                                          class="form-control @error('og_description') is-invalid @enderror"
                                                          maxlength="500"
                                                          placeholder="{{ $previewDescription }}">{{ old('og_description', $pageSetting->og_description) }}</textarea>
                                                @error('og_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">OG Image</label>
                                                <input type="file" name="og_image"
                                                       class="form-control @error('og_image') is-invalid @enderror"
                                                       accept="image/*">
                                                <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 1200×630px (max 4MB). Used for Facebook/WhatsApp link previews.</small>
                                                @error('og_image')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                                @if ($currentOgImageUrl)
                                                    <div class="mt-2 d-flex align-items-center gap-3">
                                                        <img id="og-image-preview" src="{{ $currentOgImageUrl }}" alt="OG image"
                                                             style="width: 160px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6;">
                                                        <div>
                                                            <button type="button" class="btn btn-sm btn-outline-danger" id="remove-og-image-btn">
                                                                <i class="fas fa-trash-alt me-1"></i> Remove
                                                            </button>
                                                            <input type="hidden" name="remove_og_image" id="remove_og_image_input" value="0">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">OG Image Alt Text</label>
                                                <input type="text" name="og_image_alt"
                                                       value="{{ old('og_image_alt', $pageSetting->og_image_alt) }}"
                                                       class="form-control @error('og_image_alt') is-invalid @enderror"
                                                       maxlength="255" placeholder="Describe the image for accessibility">
                                                @error('og_image_alt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ============ TWITTER TAB ============ --}}
                                    <div class="tab-pane fade" id="tab-twitter">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Twitter Card Type</label>
                                                <select name="twitter_card" class="form-select @error('twitter_card') is-invalid @enderror">
                                                    @foreach(\App\Models\PageSetting::TWITTER_CARD_OPTIONS as $type)
                                                        <option value="{{ $type }}" @selected(old('twitter_card', $pageSetting->twitter_card ?: 'summary_large_image') === $type)>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                                @error('twitter_card')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Twitter @site</label>
                                                <input type="text" name="twitter_site"
                                                       value="{{ old('twitter_site', $pageSetting->twitter_site) }}"
                                                       class="form-control @error('twitter_site') is-invalid @enderror"
                                                       maxlength="60" placeholder="@traceconsulting">
                                                @error('twitter_site')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Twitter @creator</label>
                                                <input type="text" name="twitter_creator"
                                                       value="{{ old('twitter_creator', $pageSetting->twitter_creator) }}"
                                                       class="form-control @error('twitter_creator') is-invalid @enderror"
                                                       maxlength="60" placeholder="@author (optional)">
                                                @error('twitter_creator')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Twitter Title <small class="text-muted">(defaults to OG Title when left blank)</small></label>
                                                <input type="text" name="twitter_title"
                                                       value="{{ old('twitter_title', $pageSetting->twitter_title) }}"
                                                       class="form-control @error('twitter_title') is-invalid @enderror"
                                                       maxlength="255">
                                                @error('twitter_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Twitter Description <small class="text-muted">(defaults to OG Description when left blank)</small></label>
                                                <textarea name="twitter_description" rows="3"
                                                          class="form-control @error('twitter_description') is-invalid @enderror"
                                                          maxlength="500">{{ old('twitter_description', $pageSetting->twitter_description) }}</textarea>
                                                @error('twitter_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Twitter Image <small class="text-muted">(defaults to OG Image when left blank)</small></label>
                                                <input type="file" name="twitter_image"
                                                       class="form-control @error('twitter_image') is-invalid @enderror"
                                                       accept="image/*">
                                                @error('twitter_image')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                                @if ($currentTwitterImageUrl)
                                                    <div class="mt-2 d-flex align-items-center gap-3">
                                                        <img id="twitter-image-preview" src="{{ $currentTwitterImageUrl }}" alt="Twitter image"
                                                             style="width: 160px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6;">
                                                        <div>
                                                            <button type="button" class="btn btn-sm btn-outline-danger" id="remove-twitter-image-btn">
                                                                <i class="fas fa-trash-alt me-1"></i> Remove
                                                            </button>
                                                            <input type="hidden" name="remove_twitter_image" id="remove_twitter_image_input" value="0">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ============ ADVANCED / CUSTOM META TAB ============ --}}
                                    <div class="tab-pane fade" id="tab-advanced">
                                        <p class="text-muted">
                                            Add extra <code>&lt;meta&gt;</code> tags this page needs that aren't covered above —
                                            e.g. <code>fb:app_id</code>, <code>twitter:site</code>, or any custom property.
                                            Keys may only contain letters, digits, <code>:</code>, <code>-</code> and <code>_</code>.
                                        </p>

                                        @if($customMetas->isNotEmpty())
                                            <div class="table-responsive mb-4">
                                                <table class="table table-sm table-bordered align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>Type</th>
                                                            <th>Key</th>
                                                            <th>Value</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($customMetas as $customMeta)
                                                            <tr>
                                                                <td><span class="badge bg-secondary">{{ $customMeta->type }}</span></td>
                                                                <td><code>{{ $customMeta->key }}</code></td>
                                                                <td>{{ $customMeta->value }}</td>
                                                                <td>
                                                                    <form action="{{ route('admin.pageSettings.customMeta.destroy', [$pageSetting, $customMeta]) }}" method="POST" onsubmit="return confirm('Remove this custom meta tag?');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-muted fst-italic">No custom meta tags added yet.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.pageSettings.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>

                        {{-- Separate form for adding a custom meta — kept outside the main form so it posts independently --}}
                        <div class="card-body border-top d-none" id="add-custom-meta-panel">
                            <h6>+ Add Custom Meta</h6>
                            <form action="{{ route('admin.pageSettings.customMeta.store', $pageSetting) }}" method="POST" class="row g-2 align-items-end">
                                @csrf
                                <div class="col-md-3">
                                    <label class="form-label">Type</label>
                                    <select name="type" class="form-select">
                                        @foreach(\App\Models\CustomMeta::TYPES as $type)
                                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Key</label>
                                    <input type="text" name="key" class="form-control" placeholder="fb:app_id" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Value</label>
                                    <input type="text" name="value" class="form-control" placeholder="123456789" required>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary w-100">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- ============ PREVIEW SIDEBAR ============ --}}
                <div class="col-12 col-xl-4">
                    <div class="card card-outline card-secondary mb-4">
                        <div class="card-header"><h3 class="card-title">Google Search Preview</h3></div>
                        <div class="card-body">
                            <div style="font-family: arial, sans-serif;">
                                <div style="color: #1a0dab; font-size: 18px; line-height: 1.3;" id="preview-title">{{ $previewTitle }}</div>
                                <div style="color: #006621; font-size: 14px;">{{ url('/' . ltrim($pageSetting->page_slug === 'home' ? '' : $pageSetting->page_slug, '/')) }}</div>
                                <div style="color: #545454; font-size: 13px;" id="preview-description">{{ \Illuminate\Support\Str::limit($previewDescription, 160) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-outline card-secondary">
                        <div class="card-header"><h3 class="card-title">Social Share Preview</h3></div>
                        <div class="card-body p-0">
                            @if($currentOgImageUrl)
                                <img src="{{ $currentOgImageUrl }}" class="w-100" style="aspect-ratio: 1200/630; object-fit: cover;" alt="OG preview">
                            @else
                                <div class="w-100 d-flex align-items-center justify-content-center bg-light text-muted" style="aspect-ratio: 1200/630;">No OG image set</div>
                            @endif
                            <div class="p-3">
                                <div class="text-uppercase text-muted" style="font-size: 11px;">{{ parse_url(url('/'), PHP_URL_HOST) }}</div>
                                <div class="fw-bold" id="preview-og-title">{{ $previewTitle }}</div>
                                <div class="text-muted" style="font-size: 13px;" id="preview-og-description">{{ \Illuminate\Support\Str::limit($previewDescription, 120) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custome-js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Reset-to-default buttons
    const resetMetaTitleBtn = document.getElementById('reset-meta-title-btn');
    const metaTitleInput = document.getElementById('meta_title_input');
    if (resetMetaTitleBtn && metaTitleInput) {
        resetMetaTitleBtn.addEventListener('click', function () {
            metaTitleInput.value = metaTitleInput.dataset.default || '';
            metaTitleInput.dispatchEvent(new Event('input'));
        });
    }

    const resetMetaDescriptionBtn = document.getElementById('reset-meta-description-btn');
    const metaDescriptionInput = document.getElementById('meta_description_input');
    if (resetMetaDescriptionBtn && metaDescriptionInput) {
        resetMetaDescriptionBtn.addEventListener('click', function () {
            metaDescriptionInput.value = metaDescriptionInput.dataset.default || '';
            metaDescriptionInput.dispatchEvent(new Event('input'));
        });
    }

    // Character counters + live preview sync
    const previewTitle = document.getElementById('preview-title');
    const previewOgTitle = document.getElementById('preview-og-title');
    const previewDescription = document.getElementById('preview-description');
    const previewOgDescription = document.getElementById('preview-og-description');

    function bindCounter(input, counterId, recommendedMax, previewEls) {
        const counterEl = document.getElementById(counterId);
        function update() {
            const len = input.value.length;
            if (counterEl) {
                counterEl.textContent = len + ' / ' + recommendedMax;
                counterEl.classList.toggle('text-danger', len > recommendedMax);
                counterEl.classList.toggle('text-muted', len <= recommendedMax);
            }
            (previewEls || []).forEach(function (el) {
                if (el) el.textContent = input.value || el.dataset.placeholder || '';
            });
        }
        input.addEventListener('input', update);
        update();
    }

    if (metaTitleInput) {
        bindCounter(metaTitleInput, 'meta_title_counter', 60, [previewTitle, previewOgTitle]);
    }
    if (metaDescriptionInput) {
        bindCounter(metaDescriptionInput, 'meta_description_counter', 160, [previewDescription, previewOgDescription]);
    }

    // Image remove toggles
    function wireImageRemove(btnId, inputId, previewId) {
        const btn = document.getElementById(btnId);
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        if (!btn) return;
        btn.addEventListener('click', function () {
            if (input.value === '0') {
                preview.style.opacity = '0.3';
                preview.style.filter  = 'grayscale(100%)';
                input.value = '1';
                btn.innerHTML = '<i class="fas fa-undo me-1"></i> Undo';
                btn.classList.replace('btn-outline-danger', 'btn-outline-secondary');
            } else {
                preview.style.opacity = '1';
                preview.style.filter  = 'none';
                input.value = '0';
                btn.innerHTML = '<i class="fas fa-trash-alt me-1"></i> Remove';
                btn.classList.replace('btn-outline-secondary', 'btn-outline-danger');
            }
        });
    }
    wireImageRemove('remove-og-image-btn', 'remove_og_image_input', 'og-image-preview');
    wireImageRemove('remove-twitter-image-btn', 'remove_twitter_image_input', 'twitter-image-preview');

    // Reveal the "Add Custom Meta" mini-form when its tab is active
    const advancedTabBtn = document.querySelector('[data-bs-target="#tab-advanced"]');
    const addCustomMetaPanel = document.getElementById('add-custom-meta-panel');
    if (advancedTabBtn && addCustomMetaPanel) {
        advancedTabBtn.addEventListener('shown.bs.tab', function () {
            addCustomMetaPanel.classList.remove('d-none');
        });
    }
});
</script>
@endpush
