@extends('layouts.app')
@section('content')
@php
$articleRows = old('articles', $insight->articles->map(fn($a) => [
    'id'                => $a->id,
    'title'             => $a->title,
    'description'       => $a->description,
    'image_description' => $a->image_description,
    'read_minutes'      => $a->read_minutes,
    'social_links'      => $a->social_links ?? [],
])->values()->all());
if (empty($articleRows)) $articleRows = [['id' => null, 'title' => '', 'description' => '']];

$savedAuthorTeamIds  = old('author_team_ids', $insight->author_team_ids ?? []);
$savedOutsideAuthors = old('outside_authors', $insight->outside_authors ?? []);
$currentInsightImageUrl = $insight->articleImageUrl() ?: $insight->imageUrl();
$currentInsightImageRemoveField = $insight->articleImageUrl() ? 'remove_article_image' : 'remove_image';
@endphp

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0">Edit Insight</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.insights.index') }}">Insights Manager</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content"><div class="container-fluid">
    <form action="{{ route('admin.insights.update', $insight) }}" method="POST" enctype="multipart/form-data" id="editInsightForm">
        @csrf @method('PUT')
        <div class="row g-4">

            {{-- LEFT: General Information --}}
            <div class="col-12 col-xl-5">
                <div class="card card-outline card-primary">
                    <div class="card-header"><h3 class="card-title">General Information</h3></div>
                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label">Insight Type</label>
                                <select id="editInsightTypeSelect" name="type" class="form-control">
                                    @foreach($insightTypes as $type)
                                        <option value="{{ $type->id }}"
                                            data-type-category="{{ strtolower((string) ($type->type_category ?? '')) }}"
                                            {{ $insight->type == $type->id ? 'selected' : '' }}>
                                            {{ $type->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Team Authors (multiple) --}}
                           {{-- Author Field Wrap --}}
<div class="col-12" id="editAuthorFieldWrap">
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
                <div class="chip-check" style="display:none;width:16px;height:16px;border-radius:50%;background:#185FA5;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="10" height="10" viewBox="0 0 10 10"><polyline points="1.5,5 4,8 8.5,2" stroke="#E6F1FB" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <input type="checkbox" name="author_team_ids[]" value="{{ $team->id }}"
                       {{ $isSelected ? 'checked' : '' }} style="display:none;">
            </div>
        @endforeach
    </div>
</div>

                            {{-- Outside Authors --}}
                            <div class="col-12" id="editOutsideAuthorsWrap">
                                <div class="border rounded p-3" style="background:#f8f9fa;">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label fw-bold mb-0 small text-uppercase text-muted">Outside Authors</label>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="editAddOutsideAuthorBtn">
                                            <i class="fas fa-plus me-1"></i> Add More
                                        </button>
                                    </div>
                                    <div id="editOutsideAuthorsWrapper">
                                        @foreach($savedOutsideAuthors as $oIdx => $oAuthor)
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
                                <label class="form-label">Main Heading</label>
                                <input type="text" name="heading" class="form-control" value="{{ old('heading', $insight->heading) }}" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Sub Heading</label>
                                <input type="text" name="sub_heading" class="form-control" value="{{ old('sub_heading', $insight->sub_heading) }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Description (Intro)</label>
                                <textarea name="description" class="form-control" id="mainDescription">{{ old('description', $insight->description) }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Published At</label>
                                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', $insight->published_at?->format('Y-m-d\TH:i')) }}">
                            </div>

                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="active" value="1" id="activeSwitch" {{ old('active', $insight->active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activeSwitch">Active</label>
                                </div>
                            </div>

                            {{-- Video Link: visible only for Video type --}}
                            <div class="col-12" id="editVideoLinkFieldWrap">
                                <label class="form-label">Video Link (Optional)</label>
                                <input type="url" name="video_link" class="form-control" value="{{ old('video_link', $insight->video_link) }}" placeholder="https://...">
                            </div>

                            {{-- Source Name: visible only for Op-Ed/Press --}}
                            <div class="col-12" id="editSourceNameFieldWrap">
                                <label class="form-label">Source Name</label>
                                <input type="text" name="source_name" class="form-control"
                                    value="{{ old('source_name', $insight->source_name) }}"
                                    placeholder="e.g. Daily Star">
                            </div>

                            <div class="col-md-8" id="editArticleImageWrap">
                                <label class="form-label">Insight Image</label>
                                <input type="hidden" name="{{ $currentInsightImageRemoveField }}" value="0" id="removeInsightImageInput">
                                <input type="file" id="insightImageInput" name="article_image" class="form-control" accept="image/*" data-max-size="4096" data-max-width="1200" data-max-height="800">
                                @if($currentInsightImageUrl)
                                    <div id="existingInsightImageWrap" class="mt-2 position-relative d-inline-block w-100">
                                        <img src="{{ $currentInsightImageUrl }}" alt="current insight image" class="img-fluid rounded border" style="max-height:160px;width:100%;object-fit:cover;">
                                        <button type="button" id="removeInsightImageBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:26px;height:26px;font-size:14px;" title="Remove current image">&times;</button>
                                    </div>
                                @endif
                                <div id="insightImagePreviewWrap" class="mt-2 d-none position-relative d-inline-block w-100">
                                    <img id="insightImagePreview" src="" alt="Selected insight image" class="img-fluid rounded border" style="max-height:160px;width:100%;object-fit:cover;">
                                    <button type="button" id="clearInsightImageBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:26px;height:26px;font-size:14px;" title="Remove selected image">&times;</button>
                                </div>
                            </div>

                            <div class="col-md-4" id="editImageDescWrap">
                                <label class="form-label">Image Description</label>
                                <input type="text" name="articles[0][image_description]" class="form-control"
                                    value="{{ old('articles.0.image_description', $insight->articles->first()?->image_description) }}"
                                    placeholder="Category/Label">
                            </div>

                            <div class="col-12">
                                {{-- Insight Attachment: visible only for Brochures --}}
                                <div class="p-3 border rounded mb-3" id="editInsightAttachmentWrap" style="border-left: 4px solid #e85d26 !important;">
                                    <label class="form-label fw-bold mb-1">
                                        <i class="fas fa-file-download me-1" style="color:#e85d26;"></i>
                                        Insight Attachment
                                        <span class="badge bg-warning text-dark ms-1" style="font-size:10px;">Brochures / Download</span>
                                    </label>
                                    <small class="text-muted d-block mb-2">এই file টি সরাসরি Download button এ কাজ করবে।</small>

                                    @if($insight->attachmentUrl())
                                        <div class="d-flex align-items-center gap-2 p-2 bg-light rounded mb-2">
                                            <i class="fas fa-paperclip text-warning"></i>
                                            <a href="{{ $insight->attachmentUrl() }}" target="_blank" class="small flex-grow-1 text-truncate">
                                                Current file — Click to view
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger py-0 px-2" style="font-size:11px; white-space:nowrap;"
                                                onclick="this.closest('form').insertAdjacentHTML('beforeend', '<input type=\'hidden\' name=\'remove_attachment\' value=\'1\'>'); this.closest('.d-flex').remove();">
                                                <i class="fas fa-trash-alt me-1"></i> Remove
                                            </button>
                                        </div>
                                    @endif

                                    <input type="file" name="attachment" class="form-control form-control-sm"
                                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.mov">
                                </div>

                                {{-- Article Attachment: visible only for Publication / Article --}}
                                <div class="p-3 border rounded" id="editArticleAttachmentWrap" style="border-left: 4px solid #0369a1 !important;">
                                    <label class="form-label fw-bold mb-1">
                                        <i class="fas fa-file-alt me-1" style="color:#0369a1;"></i>
                                        Article Attachment
                                        <span class="badge bg-primary ms-1" style="font-size:10px;">Publication / Article</span>
                                    </label>
                                    <small class="text-muted d-block mb-2">Article section এর সাথে যুক্ত file।</small>

                                    @if($insight->articles->first()?->attachmentUrl())
                                        <div class="d-flex align-items-center gap-2 p-2 bg-light rounded mb-2">
                                            <i class="fas fa-paperclip text-primary"></i>
                                            <a href="{{ $insight->articles->first()->attachmentUrl() }}" target="_blank" class="small flex-grow-1 text-truncate">
                                                Current file — Click to view
                                            </a>
                                        </div>
                                    @endif

                                    <input type="file" name="article_attachments[0]" class="form-control form-control-sm"
                                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.mov">
                                </div>
                            </div>

                            {{-- Social Share Links: visible only for Article / Publication --}}
                            <div class="col-12 mt-2 p-3 bg-light rounded" id="editSocialLinksWrap">
                                <label class="form-label fw-bold">Social Share Links</label>
                                <div id="social-links-wrapper">
                                    @foreach(old('articles.0.social_links', $insight->articles->first()?->social_links ?? []) as $sIdx => $link)
                                        <div class="social-link-row d-flex gap-2 mb-2">
                                            <input type="text" name="articles[0][social_links][{{ $sIdx }}][name]"
                                                class="form-control form-control-sm" placeholder="Platform"
                                                value="{{ $link['name'] ?? '' }}" style="width:140px">
                                            <input type="text" name="articles[0][social_links][{{ $sIdx }}][link]"
                                                class="form-control form-control-sm" placeholder="URL"
                                                value="{{ $link['link'] ?? '' }}">
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-social-link">&times;</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-social-link-btn">+ Add Social Link</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Article Sections --}}
            <div class="col-12 col-xl-7" id="editArticleSectionsWrap">
                <div class="card card-outline card-success">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Article Sections</h3>
                        <button type="button" id="addArticleBtn" class="btn btn-sm btn-primary">Add More Section</button>
                    </div>
                    <div class="card-body">
                        <div id="articles-wrapper">
                            @foreach($articleRows as $index => $row)
                                <div class="article-row border p-3 mb-3 shadow-sm rounded">
                                    <input type="hidden" name="articles[{{ $index }}][id]" value="{{ $row['id'] }}">

                                    <div class="mb-3">
                                        <label class="form-label">Section Title</label>
                                        <input type="text" name="articles[{{ $index }}][title]" class="form-control"
                                            value="{{ $row['title'] }}" placeholder="e.g. Abstract">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea name="articles[{{ $index }}][description]"
                                            class="form-control article-editor"
                                            id="articleEditor_{{ $index }}">{{ $row['description'] }}</textarea>
                                    </div>

                                    @if($index > 0)
                                        <button type="button" class="btn btn-danger btn-sm remove-article-row">Remove Section</button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-lg btn-success">Update Insight Article</button>
            </div>
        </div>
    </form>
</div></div>

{{-- Article Template --}}
<template id="articleTemplate">
    <div class="article-row border p-3 mb-3 shadow-sm rounded">
        <input type="hidden" name="__ARTICLE_NAME__[id]" value="">
        <div class="mb-3">
            <label class="form-label">Section Title</label>
            <input type="text" name="__ARTICLE_NAME__[title]" class="form-control" placeholder="e.g. Abstract">
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="__ARTICLE_NAME__[description]" class="form-control article-editor" id="articleEditor___INDEX__"></textarea>
        </div>
        <button type="button" class="btn btn-danger btn-sm remove-article-row">Remove Section</button>
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
.author-chip.chip-selected .chip-check { display: flex !important; }
</style>

@endpush

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editTypeSelect      = document.getElementById('editInsightTypeSelect');
    const editAuthorWrap      = document.getElementById('editAuthorFieldWrap');
    const editOutsideWrap     = document.getElementById('editOutsideAuthorsWrap');
    const editArticleSectWrap = document.getElementById('editArticleSectionsWrap');
    const editVideoLinkWrap   = document.getElementById('editVideoLinkFieldWrap');
    const editSourceNameWrap  = document.getElementById('editSourceNameFieldWrap');
    const editInsightAttWrap  = document.getElementById('editInsightAttachmentWrap');
    const editArticleAttWrap  = document.getElementById('editArticleAttachmentWrap');
    const editSocialLinksWrap = document.getElementById('editSocialLinksWrap');
    const editArticleImageWrap = document.getElementById('editArticleImageWrap');
    const editImageDescWrap   = document.getElementById('editImageDescWrap');
    const insightImageInput = document.getElementById('insightImageInput');
    const insightImagePreviewWrap = document.getElementById('insightImagePreviewWrap');
    const insightImagePreview = document.getElementById('insightImagePreview');
    const clearInsightImageBtn = document.getElementById('clearInsightImageBtn');
    const removeInsightImageBtn = document.getElementById('removeInsightImageBtn');
    const removeInsightImageInput = document.getElementById('removeInsightImageInput');

    const editors = {};

    function getTypeInfo() {
        if (!editTypeSelect || editTypeSelect.selectedIndex < 0) return { category: '', text: '' };
        const sel = editTypeSelect.options[editTypeSelect.selectedIndex];
        return {
            category: (sel?.dataset?.typeCategory || '').toLowerCase(),
            text: (sel?.text || '').toLowerCase(),
        };
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
        const existingWrap = document.getElementById('existingInsightImageWrap');

        if (!insightImageInput.files || insightImageInput.files.length === 0) {
            insightImagePreviewWrap.classList.add('d-none');
            insightImagePreview.src = '';
            if (existingWrap) existingWrap.classList.remove('d-none');
            return;
        }

        insightImagePreview.src = URL.createObjectURL(insightImageInput.files[0]);
        insightImagePreviewWrap.classList.remove('d-none');
        if (existingWrap) existingWrap.classList.add('d-none');
    }

    if (insightImageInput) {
        insightImageInput.addEventListener('change', renderInsightImagePreview);
    }

    if (clearInsightImageBtn) {
        clearInsightImageBtn.addEventListener('click', function () {
            insightImageInput.value = '';
            insightImagePreviewWrap.classList.add('d-none');
            insightImagePreview.src = '';
            const existingWrap = document.getElementById('existingInsightImageWrap');
            if (existingWrap) existingWrap.classList.remove('d-none');
        });
    }

    if (removeInsightImageBtn && removeInsightImageInput) {
        removeInsightImageBtn.addEventListener('click', function () {
            removeInsightImageInput.value = '1';
            const wrap = document.getElementById('existingInsightImageWrap');
            if (wrap) wrap.remove();
        });
    }

    function toggleVisibility() {
        setVisible(editAuthorWrap,       isArticleOrPub());
        setVisible(editOutsideWrap,      isArticleOrPub());
        setVisible(editVideoLinkWrap,    isVideoType());
        setVisible(editSourceNameWrap,   isOpEdType());
        setVisible(editInsightAttWrap,   isBrochuresType());
        setVisible(editArticleAttWrap,   isArticleOrPub());
        setVisible(editArticleImageWrap, isArticleOrPub());
        setVisible(editImageDescWrap,    isArticleOrPub());
        setVisible(editSocialLinksWrap,  isArticleOrPub());
        setVisible(editArticleSectWrap,  isArticleOrPub());
    }

    // ===== CKEditor =====
    function initCKEditor(textarea) {
        if (!textarea || editors[textarea.id]) return;
        ClassicEditor.create(textarea, {
            toolbar: {
                items: ['heading','|','bold','italic','underline','strikethrough','|',
                    'bulletedList','numberedList','|','outdent','indent','|','link','|','undo','redo']
            },
        }).then(editor => { editors[textarea.id] = editor; }).catch(console.error);
    }

    document.querySelectorAll('textarea.article-editor, textarea.outside-author-editor').forEach(initCKEditor);

    // ===== Outside Authors =====
    const outsideWrapper = document.getElementById('editOutsideAuthorsWrapper');
    const addOutsideBtn  = document.getElementById('editAddOutsideAuthorBtn');
    const outsideTpl     = document.getElementById('outsideAuthorTemplate');

    function reindexOutside() {
        outsideWrapper.querySelectorAll('.outside-author-row').forEach((row, idx) => {
            row.querySelectorAll('input, textarea').forEach(f => {
                if (f.name) f.name = f.name.replace(/outside_authors\[\d+\]/, `outside_authors[${idx}]`);
                if (f.tagName === 'TEXTAREA') f.id = `outsideEditor_${idx}`;
            });
        });
    }

    if (addOutsideBtn && outsideWrapper && outsideTpl) {
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
                    if (editors[ta.id]) { editors[ta.id].destroy(); delete editors[ta.id]; }
                });
                row.remove();
                reindexOutside();
            }
        });
    }

    // ===== Article Sections =====
    const wrapper = document.getElementById('articles-wrapper');
    const btn     = document.getElementById('addArticleBtn');
    const tpl     = document.getElementById('articleTemplate');

    if (wrapper && btn && tpl) {
        function reindex() {
            wrapper.querySelectorAll('.article-row').forEach((row, idx) => {
                row.querySelectorAll('input').forEach(f => {
                    if (f.name) f.name = f.name.replace(/articles\[\d+\]/, `articles[${idx}]`);
                });
            });
        }

        btn.addEventListener('click', () => {
            const idx = wrapper.querySelectorAll('.article-row').length;
            const h = tpl.innerHTML.trim()
                .replaceAll('__ARTICLE_NAME__', `articles[${idx}]`)
                .replaceAll('__INDEX__', idx);
            wrapper.insertAdjacentHTML('beforeend', h);
            reindex();
            setTimeout(() => {
                const newTa = document.getElementById(`articleEditor_${idx}`);
                if (newTa) initCKEditor(newTa);
            }, 100);
        });

        wrapper.addEventListener('click', e => {
            if (e.target.closest('.remove-article-row')) {
                const row = e.target.closest('.article-row');
                row.querySelectorAll('textarea.article-editor').forEach(ta => {
                    if (editors[ta.id]) { editors[ta.id].destroy(); delete editors[ta.id]; }
                });
                row.remove();
                reindex();
            }
        });

        reindex();
    }

    // ===== Social Links =====
    const socialWrapper = document.getElementById('social-links-wrapper');
    const socialBtn     = document.getElementById('add-social-link-btn');
    if (socialWrapper && socialBtn) {
        socialBtn.addEventListener('click', () => {
            const count = socialWrapper.querySelectorAll('.social-link-row').length;
            const row   = document.createElement('div');
            row.className = 'social-link-row d-flex gap-2 mb-2';
            row.innerHTML = `
                <input type="text" name="articles[0][social_links][${count}][name]"
                    class="form-control form-control-sm" placeholder="Platform" style="width:140px">
                <input type="text" name="articles[0][social_links][${count}][link]"
                    class="form-control form-control-sm" placeholder="URL">
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
    document.getElementById('editInsightForm').addEventListener('submit', function () {
        Object.values(editors).forEach(editor => {
            if (editor.sourceElement) editor.sourceElement.value = editor.getData();
        });
    });

    if (editTypeSelect) editTypeSelect.addEventListener('change', toggleVisibility);
    toggleVisibility();
});


</script>