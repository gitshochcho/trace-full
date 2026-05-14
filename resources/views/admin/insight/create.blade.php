@extends('layouts.app')

@section('content')
@php
$articleRows = old('articles', [[
    'id' => null, 'type' => '',
    'title' => '', 'description' => '', 'read_minutes' => '',
    'published_at' => '', 'image_description' => '', 'social_links' => [],
]]);
@endphp

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Add Insight</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.insights.index') }}">Insights Manager</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Insight</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <form action="{{ route('admin.insights.store') }}" method="POST" enctype="multipart/form-data" id="insightForm">
            @csrf
            <div class="row g-4">

                {{-- General Information --}}
                <div class="col-12 col-xl-5">
                    <div class="card card-outline card-primary">
                        <div class="card-header"><h3 class="card-title">General Information</h3></div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Type <span class="text-danger">*</span></label>
                                    <select id="insightTypeSelect" name="type" class="form-select @error('type') is-invalid @enderror" required>
                                        <option value="">Select Type</option>
                                        @foreach($insightTypes as $type)
                                            <option value="{{ $type->id }}"
                                                    data-type-category="{{ strtolower((string) ($type->type_category ?? '')) }}"
                                                    @selected(old('type') == $type->id)>
                                                {{ ucfirst(str_replace('_', ' ', $type->type)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', $nextSortOrder) }}" class="form-control @error('sort_order') is-invalid @enderror" min="0">
                                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Team Authors (multiple) --}}
                                {{-- Author Field Wrap --}}
<div class="col-12" id="authorFieldWrap">
    <label class="form-label">Author Name</label>
    <p class="text-muted small mb-2">Click to select, click again to remove</p>
    <div class="author-chip-grid d-flex flex-wrap gap-2" id="authorChipGrid">
        @foreach($teams as $team)
            @php $isSelected = in_array($team->id, old('author_team_ids', [])); @endphp
            <div class="author-chip d-flex align-items-center gap-2 rounded-pill px-3 py-2 border {{ $isSelected ? 'chip-selected' : '' }}"
                 data-id="{{ $team->id }}"
                 style="cursor:pointer; user-select:none; transition: all 0.15s;">
                <div class="author-avatar rounded-circle d-flex align-items-center justify-content-center"
                     style="width:28px;height:28px;font-size:11px;font-weight:500;background:#dee2e6;color:#495057;flex-shrink:0;">
                    {{ strtoupper(substr($team->first_name,0,1).substr($team->last_name,0,1)) }}
                </div>
                <span style="font-size:14px;">{{ $team->first_name }} {{ $team->last_name }}</span>
                <div class="chip-check" style="width:16px;height:16px;border-radius:50%;background:#185FA5;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="10" height="10" viewBox="0 0 10 10"><polyline points="1.5,5 4,8 8.5,2" stroke="#E6F1FB" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <input type="checkbox" name="author_team_ids[]" value="{{ $team->id }}"
                       {{ $isSelected ? 'checked' : '' }} style="display:none;">
            </div>
        @endforeach
    </div>
</div>

                                {{-- Outside Authors --}}
                                <div class="col-12" id="outsideAuthorsWrap">
                                    <div class="border rounded p-3" style="background:#f8f9fa;">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label fw-bold mb-0 small text-uppercase text-muted">Outside Authors</label>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" id="addOutsideAuthorBtn">
                                                <i class="fas fa-plus me-1"></i> Add More
                                            </button>
                                        </div>
                                        <div id="outsideAuthorsWrapper">
                                            @foreach(old('outside_authors', []) as $oIdx => $oAuthor)
                                            <div class="outside-author-row border rounded p-3 mb-2 bg-white">
                                                <div class="row g-2">
                                                    <div class="col-12">
                                                        <input type="text" name="outside_authors[{{ $oIdx }}][name]"
                                                            value="{{ $oAuthor['name'] ?? '' }}"
                                                            class="form-control form-control-sm" placeholder="Author name">
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea name="outside_authors[{{ $oIdx }}][description]"
                                                            class="form-control form-control-sm outside-author-editor"
                                                            id="outsideEditor_{{ $oIdx }}" rows="3"
                                                            placeholder="Short bio or description...">{{ $oAuthor['description'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="col-12 text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-outside-author">
                                                            <i class="fas fa-trash me-1"></i> Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Heading <span class="text-danger">*</span></label>
                                    <input type="text" name="heading" value="{{ old('heading') }}" class="form-control @error('heading') is-invalid @enderror" required>
                                    @error('heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Sub Heading</label>
                                    <input type="text" name="sub_heading" value="{{ old('sub_heading') }}" class="form-control @error('sub_heading') is-invalid @enderror">
                                    @error('sub_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Article Image + Description: visible for Article/Publication --}}
                                <div class="col-md-8" id="articleImageWrap">
                                    <label class="form-label">Article Image</label>
                                    <input type="file" name="article_image" class="form-control" accept="image/*">
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 800×600px (max 2MB)</small>
                                </div>
                                <div class="col-md-4" id="imageDescWrap">
                                    <label class="form-label">Image Description</label>
                                    <input type="text" name="articles[0][image_description]" value="{{ old('articles.0.image_description') }}" class="form-control" placeholder="Category/Label">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Published At</label>
                                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="form-control @error('published_at') is-invalid @enderror">
                                    @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Source Name: visible only for Op-Ed/Press --}}
                                <div class="col-md-6" id="sourceNameFieldWrap">
                                    <label class="form-label">Source Name</label>
                                    <input type="text" name="source_name" value="{{ old('source_name') }}" class="form-control @error('source_name') is-invalid @enderror" placeholder="e.g. Daily Star">
                                    @error('source_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Video Link: visible only for Video type --}}
                                <div class="col-md-6" id="videoLinkFieldWrap">
                                    <label class="form-label">Video Link</label>
                                    <input type="url" name="video_link" value="{{ old('video_link') }}" class="form-control @error('video_link') is-invalid @enderror" placeholder="https://...">
                                    @error('video_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6 d-flex align-items-end">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="active" value="0">
                                        <input class="form-check-input" type="checkbox" name="active" value="1" id="activeSwitch" @checked(old('active', '1') == '1')>
                                        <label class="form-check-label" for="activeSwitch">Active</label>
                                    </div>
                                </div>

                                {{-- Publish Share Links --}}
                                <div class="col-12 p-3 rounded" id="publishLinkWrap" style="background: #eef9f9; border: 1px solid #b2e8e8;">
                                    <label class="form-label fw-bold" style="color: #01888C;">Publish Share Links</label>
                                    <div id="publish-links-wrapper">
                                        @foreach(old('publish_links', []) as $pIdx => $plink)
                                        <div class="publish-link-row d-flex gap-2 mb-2">
                                            <input type="text" name="publish_links[{{ $pIdx }}][name]" class="form-control form-control-sm" placeholder="Label (e.g. ResearchGate)" value="{{ $plink['name'] ?? '' }}" style="width:160px">
                                            <input type="text" name="publish_links[{{ $pIdx }}][link]" class="form-control form-control-sm" placeholder="URL" value="{{ $plink['link'] ?? '' }}">
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-publish-link">&times;</button>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm mt-2" id="add-publish-link-btn" style="background: #01888C; color: #fff;">+ Add Publish Link</button>
                                </div>

                                {{-- Social Share Links: visible for Article/Publication --}}
                                <div class="col-12 p-3 bg-light rounded" id="socialLinksWrap">
                                    <label class="form-label fw-bold">Social Share Links</label>
                                    <div id="social-links-wrapper">
                                        @foreach(old('articles.0.social_links', []) as $sIdx => $link)
                                        <div class="social-link-row d-flex gap-2 mb-2">
                                            <input type="text" name="articles[0][social_links][{{ $sIdx }}][name]" class="form-control form-control-sm" placeholder="Platform" value="{{ $link['name'] ?? '' }}" style="width:140px">
                                            <input type="url" name="articles[0][social_links][{{ $sIdx }}][link]" class="form-control form-control-sm" placeholder="URL" value="{{ $link['link'] ?? '' }}">
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-social-link">&times;</button>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-social-link-btn">+ Add Social Link</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Media --}}
                    <div class="card card-outline card-secondary mt-4">
                        <div class="card-header"><h3 class="card-title">Media</h3></div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Insight Image</label>
                                    <input type="file" id="insightImageInput" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" data-max-size="4096" data-max-width="1200" data-max-height="800">
                                    <div id="insightImagePreviewWrap" class="mt-2 d-none position-relative d-inline-block w-100">
                                        <img id="insightImagePreview" src="" alt="Selected insight image" class="img-fluid rounded border" style="max-height:160px;width:100%;object-fit:cover;">
                                        <button type="button" id="clearInsightImageBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:26px;height:26px;font-size:14px;" title="Remove selected image">&times;</button>
                                    </div>
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 1200×800px (max 4MB)</small>
                                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Insight Attachment: visible only for Brochures --}}
                                <div class="col-12" id="insightAttachmentWrap">
                                    <label class="form-label">
                                        Insight Attachment
                                        <span class="badge bg-warning text-dark ms-1" style="font-size:10px;">Brochures</span>
                                    </label>
                                    <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror"
                                           accept=".pdf,.mp4,.mov,.webm,.avi,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,.svg">
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> PDF, video, or document (max 30MB)</small>
                                    @error('attachment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Article Attachment: visible only for Publication --}}
                                <div class="col-12" id="articleAttachmentWrap">
                                    <label class="form-label">
                                        Article Attachment
                                        <span class="badge bg-primary ms-1" style="font-size:10px;">Publication / Article</span>
                                    </label>
                                    <div class="d-flex gap-2 align-items-center">
                                        <input type="file" name="article_attachments[0]" id="articleAttachmentInput" class="form-control"
                                               accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.mov">
                                        {{-- <button type="button" id="inlineClearArticleAttachmentBtn" class="btn btn-outline-secondary btn-sm d-none" title="Clear selected file">
                                            <i class="fas fa-times"></i>
                                        </button> --}}
                                    </div>
                                    <div id="articleAttachmentPreviewWrap" class="mt-2 d-none d-flex align-items-center gap-2 p-2 bg-light rounded mb-2">
                                        <i class="fas fa-paperclip text-primary"></i>
                                        <span id="articleAttachmentPreviewName" class="small flex-grow-1 text-truncate"></span>
                                        <button type="button" id="clearArticleAttachmentBtn" class="btn btn-sm btn-danger py-0 px-2" style="font-size:11px; white-space:nowrap;" title="Clear selected file">Remove</button>
                                    </div>
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Publication/Article file (max 30MB)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Article Sections --}}
                <div class="col-12 col-xl-7" id="articleSectionsWrap">
                    <div class="card card-outline card-info">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Article Sections</h3>
                            <button type="button" class="btn btn-sm btn-outline-info" id="addArticleRow">
                                <i class="fas fa-plus me-1"></i> Add Section
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="articlesWrapper" class="d-grid gap-3">
                                @foreach($articleRows as $index => $article)
                                <div class="border rounded p-3 article-row">
                                    <input type="hidden" name="articles[{{ $index }}][id]" value="{{ $article['id'] ?? '' }}">
                                    <div class="row g-3">
                                        <div class="col-md-5">
                                            <label class="form-label">Section Title</label>
                                            <input type="text" name="articles[{{ $index }}][title]" value="{{ $article['title'] ?? '' }}" class="form-control" placeholder="e.g. Abstract">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Read Minutes</label>
                                            <input type="number" name="articles[{{ $index }}][read_minutes]" value="{{ $article['read_minutes'] ?? '' }}" class="form-control" min="1" placeholder="5">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Published At</label>
                                            <input type="datetime-local" name="articles[{{ $index }}][published_at]" value="{{ $article['published_at'] ?? '' }}" class="form-control">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <textarea name="articles[{{ $index }}][description]" rows="2" class="form-control article-section-editor" id="articleSectionEditor_{{ $index }}" placeholder="Section content...">{{ $article['description'] ?? '' }}</textarea>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-article-row">
                                                <i class="fas fa-trash me-1"></i> Remove Section
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-2 mt-3 mb-4">
                <a href="{{ route('admin.insights.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Insight</button>
            </div>
        </form>
    </div>
</div>

<template id="articleRowTemplate">
    <div class="border rounded p-3 article-row">
        <input type="hidden" name="__ARTICLE_NAME__[id]" value="">
        <div class="row g-3">
            <div class="col-md-5">
                <label class="form-label">Section Title</label>
                <input type="text" name="__ARTICLE_NAME__[title]" class="form-control" placeholder="e.g. Abstract">
            </div>
            <div class="col-md-3">
                <label class="form-label">Read Minutes</label>
                <input type="number" name="__ARTICLE_NAME__[read_minutes]" class="form-control" min="1" placeholder="5">
            </div>
            <div class="col-md-4">
                <label class="form-label">Published At</label>
                <input type="datetime-local" name="__ARTICLE_NAME__[published_at]" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="__ARTICLE_NAME__[description]" rows="2" class="form-control article-section-editor" id="articleSectionEditor___INDEX__" placeholder="Section content..."></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-outline-danger remove-article-row">
                    <i class="fas fa-trash me-1"></i> Remove Section
                </button>
            </div>
        </div>
    </div>
</template>

<template id="outsideAuthorTemplate">
    <div class="outside-author-row border rounded p-3 mb-2 bg-white">
        <div class="row g-2">
            <div class="col-12">
                <input type="text" name="outside_authors[__INDEX__][name]"
                    class="form-control form-control-sm" placeholder="Author name">
            </div>
            <div class="col-12">
                <textarea name="outside_authors[__INDEX__][description]"
                    class="form-control form-control-sm outside-author-editor"
                    id="outsideEditor___INDEX__" rows="3"
                    placeholder="Short bio or description..."></textarea>
            </div>
            <div class="col-12 text-end">
                <button type="button" class="btn btn-sm btn-outline-danger remove-outside-author">
                    <i class="fas fa-trash me-1"></i> Remove
                </button>
            </div>
        </div>
    </div>
</template>
@endsection

@push('custome-css')
<style>
.author-chip { border: 1.5px solid #dee2e6; background: #fff; }
.author-chip:hover { border-color: #adb5bd; background: #f8f9fa; }
.author-chip.chip-selected { background: #E6F1FB; border-color: #185FA5; color: #0C447C; }
.author-chip.chip-selected .author-avatar { background: #185FA5; color: #E6F1FB; }
.author-chip .chip-check { display: none; }
.author-chip.chip-selected .chip-check { display: flex; }
</style>

@endpush

@push('custome-js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect       = document.getElementById('insightTypeSelect');
    const authorWrap       = document.getElementById('authorFieldWrap');
    const outsideAuthWrap  = document.getElementById('outsideAuthorsWrap');
    const articleSectWrap  = document.getElementById('articleSectionsWrap');
    const videoLinkWrap    = document.getElementById('videoLinkFieldWrap');
    const sourceNameWrap   = document.getElementById('sourceNameFieldWrap');
    const insightAttWrap   = document.getElementById('insightAttachmentWrap');
    const articleAttWrap   = document.getElementById('articleAttachmentWrap');
    const articleImageWrap = document.getElementById('articleImageWrap');
    const imageDescWrap    = document.getElementById('imageDescWrap');
    const socialLinksWrap  = document.getElementById('socialLinksWrap');
    const publishLinkWrap  = document.getElementById('publishLinkWrap');
    const insightImageInput = document.getElementById('insightImageInput');
    const insightImagePreviewWrap = document.getElementById('insightImagePreviewWrap');
    const insightImagePreview = document.getElementById('insightImagePreview');
    const clearInsightImageBtn = document.getElementById('clearInsightImageBtn');

    // Article attachment preview/clear
    const articleAttachmentInput = document.getElementById('articleAttachmentInput');
    const articleAttachmentPreviewWrap = document.getElementById('articleAttachmentPreviewWrap');
    const articleAttachmentPreviewName = document.getElementById('articleAttachmentPreviewName');
    const clearArticleAttachmentBtn = document.getElementById('clearArticleAttachmentBtn');

    const ckEditors = {};

    function getTypeInfo() {
        if (!typeSelect || typeSelect.selectedIndex < 0) return { category: '', text: '' };
        const sel = typeSelect.options[typeSelect.selectedIndex];
        return {
            category: (sel?.dataset?.typeCategory || '').toLowerCase(),
            text: (sel?.text || '').toLowerCase(),
        };
    }

    if (articleAttachmentInput) {
        articleAttachmentInput.addEventListener('change', () => {
            if (!articleAttachmentInput.files || articleAttachmentInput.files.length === 0) {
                articleAttachmentPreviewWrap?.classList.add('d-none');
                articleAttachmentPreviewName && (articleAttachmentPreviewName.textContent = '');
                return;
            }
            const f = articleAttachmentInput.files[0];
            articleAttachmentPreviewName && (articleAttachmentPreviewName.textContent = f.name);
            articleAttachmentPreviewWrap.classList.remove('d-none');
        });
    }

    if (clearArticleAttachmentBtn) {
        clearArticleAttachmentBtn.addEventListener('click', () => {
            if (articleAttachmentInput) articleAttachmentInput.value = '';
            articleAttachmentPreviewWrap?.classList.add('d-none');
            if (articleAttachmentPreviewName) articleAttachmentPreviewName.textContent = '';
        });
    }

    function isArticleType()     { const { category, text } = getTypeInfo(); return ['read','article'].includes(category) || text.includes('article'); }
    function isPublicationType() { const { text } = getTypeInfo(); return text.includes('publication'); }
    function isVideoType()       { const { category, text } = getTypeInfo(); return category.includes('video') || category.includes('watch') || text.includes('video'); }
    function isOpEdType()        { const { category, text } = getTypeInfo(); return category === 'read_on' || text.includes('op-ed') || text.includes('press'); }
    function isBrochuresType()   { const { category, text } = getTypeInfo(); return category === 'download' || text.includes('brochure'); }
    function isArticleOrPub()    { return isArticleType() || isPublicationType(); }

    function setVisible(el, show) { if (el) el.style.display = show ? '' : 'none'; }

    function renderInsightImagePreview() {
        if (!insightImageInput || !insightImagePreviewWrap || !insightImagePreview) return;

        if (!insightImageInput.files || insightImageInput.files.length === 0) {
            insightImagePreviewWrap.classList.add('d-none');
            insightImagePreview.src = '';
            return;
        }

        insightImagePreview.src = URL.createObjectURL(insightImageInput.files[0]);
        insightImagePreviewWrap.classList.remove('d-none');
    }

    if (insightImageInput) {
        insightImageInput.addEventListener('change', renderInsightImagePreview);
    }

    if (clearInsightImageBtn) {
        clearInsightImageBtn.addEventListener('click', function () {
            insightImageInput.value = '';
            insightImagePreviewWrap.classList.add('d-none');
            insightImagePreview.src = '';
        });
    }

    function toggleVisibility() {
        setVisible(authorWrap,       isArticleOrPub());
        setVisible(outsideAuthWrap,  isArticleOrPub());
        setVisible(videoLinkWrap,    isVideoType());
        setVisible(sourceNameWrap,   isOpEdType());
        setVisible(insightAttWrap,   isBrochuresType());
        setVisible(articleAttWrap,   isArticleOrPub());
        setVisible(articleImageWrap, isArticleOrPub());
        setVisible(imageDescWrap,    isArticleOrPub());
        setVisible(socialLinksWrap,  isArticleOrPub());
        setVisible(publishLinkWrap,  isArticleOrPub());
        setVisible(articleSectWrap,  isArticleOrPub());
    }

    // ===== CKEditor =====
    function initCKEditor(textarea) {
        if (!textarea || ckEditors[textarea.id]) return;
        ClassicEditor.create(textarea, {
            toolbar: { items: ['bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', '|', 'undo', 'redo'] }
       }).then(editor => {
            ckEditors[textarea.id] = editor;
            editor.editing.view.document.on('keydown', function (evt, data) {
                if (data.domEvent.key === 'Enter' && !data.domEvent.shiftKey) {
                    evt.stop();
                    data.preventDefault();
                    editor.execute('shiftEnter');
                }
            }, { priority: 'high' });

        }).catch(console.error);
    }

    document.querySelectorAll('textarea.outside-author-editor, textarea.article-section-editor').forEach(initCKEditor);

    // ===== Outside Authors =====
    const outsideWrapper = document.getElementById('outsideAuthorsWrapper');
    const addOutsideBtn  = document.getElementById('addOutsideAuthorBtn');
    const outsideTpl     = document.getElementById('outsideAuthorTemplate');

    function reindexOutside() {
        outsideWrapper.querySelectorAll('.outside-author-row').forEach((row, idx) => {
            row.querySelectorAll('input, textarea').forEach(f => {
                if (f.name) f.name = f.name.replace(/outside_authors\[\d+\]/, `outside_authors[${idx}]`);
                if (f.tagName === 'TEXTAREA') f.id = `outsideEditor_${idx}`;
            });
        });
    }

    addOutsideBtn.addEventListener('click', () => {
        const idx = outsideWrapper.querySelectorAll('.outside-author-row').length;
        outsideWrapper.insertAdjacentHTML('beforeend', outsideTpl.innerHTML.trim().replaceAll('__INDEX__', idx));
        reindexOutside();
        setTimeout(() => initCKEditor(document.getElementById(`outsideEditor_${idx}`)), 100);
    });

    outsideWrapper.addEventListener('click', e => {
        if (e.target.closest('.remove-outside-author')) {
            const row = e.target.closest('.outside-author-row');
            row.querySelectorAll('textarea').forEach(ta => {
                if (ckEditors[ta.id]) { ckEditors[ta.id].destroy(); delete ckEditors[ta.id]; }
            });
            row.remove();
            reindexOutside();
        }
    });

    // ===== Article Sections =====
    const wrapper = document.getElementById('articlesWrapper');
    const btn     = document.getElementById('addArticleRow');
    const tpl     = document.getElementById('articleRowTemplate');

    function reindex() {
        wrapper.querySelectorAll('.article-row').forEach((row, idx) => {
            row.querySelectorAll('input, textarea').forEach(f => {
                if (f.name) f.name = f.name.replace(/articles\[\d+\]/, `articles[${idx}]`);
            });
        });
    }

    btn.addEventListener('click', () => {
        const idx = wrapper.querySelectorAll('.article-row').length;
        const html = tpl.innerHTML.trim()
            .replaceAll('__ARTICLE_NAME__', `articles[${idx}]`)
            .replaceAll('__INDEX__', idx);
        wrapper.insertAdjacentHTML('beforeend', html);
        reindex();
        setTimeout(() => initCKEditor(document.getElementById(`articleSectionEditor_${idx}`)), 100);
    });

    wrapper.addEventListener('click', e => {
        if (e.target.closest('.remove-article-row')) {
            const row = e.target.closest('.article-row');
            row.querySelectorAll('textarea').forEach(ta => {
                if (ckEditors[ta.id]) { ckEditors[ta.id].destroy(); delete ckEditors[ta.id]; }
            });
            row.remove(); reindex();
        }
    });

    // ===== Publish Links =====
    const publishWrapper = document.getElementById('publish-links-wrapper');
    const publishBtn     = document.getElementById('add-publish-link-btn');
    if (publishWrapper && publishBtn) {
        publishBtn.addEventListener('click', () => {
            const count = publishWrapper.querySelectorAll('.publish-link-row').length;
            const row   = document.createElement('div');
            row.className = 'publish-link-row d-flex gap-2 mb-2';
            row.innerHTML = `<input type="text" name="publish_links[${count}][name]" class="form-control form-control-sm" placeholder="Label (e.g. ResearchGate)" style="width:160px">
                <input type="text" name="publish_links[${count}][link]" class="form-control form-control-sm" placeholder="URL">
                <button type="button" class="btn btn-sm btn-outline-danger remove-publish-link">&times;</button>`;
            publishWrapper.appendChild(row);
        });
        publishWrapper.addEventListener('click', e => {
            if (e.target.closest('.remove-publish-link')) e.target.closest('.publish-link-row').remove();
        });
    }

    // ===== Social Links (General Section) =====
    const socialWrapper = document.getElementById('social-links-wrapper');
    const socialBtn     = document.getElementById('add-social-link-btn');
    if (socialWrapper && socialBtn) {
        socialBtn.addEventListener('click', () => {
            const count = socialWrapper.querySelectorAll('.social-link-row').length;
            const row   = document.createElement('div');
            row.className = 'social-link-row d-flex gap-2 mb-2';
            row.innerHTML = `<input type="text" name="articles[0][social_links][${count}][name]" class="form-control form-control-sm" placeholder="Platform" style="width:140px">
                <input type="url" name="articles[0][social_links][${count}][link]" class="form-control form-control-sm" placeholder="URL">
                <button type="button" class="btn btn-sm btn-outline-danger remove-social-link">&times;</button>`;
            socialWrapper.appendChild(row);
        });
        socialWrapper.addEventListener('click', e => {
            if (e.target.closest('.remove-social-link')) e.target.closest('.social-link-row').remove();
        });
    }

    // ===== Author Chips =====
document.querySelectorAll('.author-chip').forEach(chip => {
    chip.addEventListener('click', (e) => {
        
        if (e.target.tagName === 'INPUT') return;
        const cb = chip.querySelector('input[type=checkbox]');
        chip.classList.toggle('chip-selected');
        cb.checked = chip.classList.contains('chip-selected');
    });
});

    // ===== Sync CKEditor on submit =====
    document.getElementById('insightForm').addEventListener('submit', function () {
        Object.values(ckEditors).forEach(editor => {
            if (editor.sourceElement) editor.sourceElement.value = editor.getData();
        });
    });

    if (typeSelect) typeSelect.addEventListener('change', toggleVisibility);
    reindex();
    toggleVisibility();
});


</script>
@endpush