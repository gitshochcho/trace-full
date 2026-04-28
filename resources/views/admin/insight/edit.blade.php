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
                                        <option value="{{ $type->id }}" data-type-category="{{ strtolower((string) ($type->type_category ?? '')) }}" {{ $insight->type == $type->id ? 'selected' : '' }}>{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12" id="editAuthorFieldWrap">
                                <label class="form-label">Author Name</label>
                                <select id="editAuthorTeamSelect" name="author_team_id" class="form-control">
                                    <option value="">Select Author</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ old('author_team_id', $insight->articles->first()?->author_team_id) == $team->id ? 'selected' : '' }}>
                                            {{ $team->first_name }} {{ $team->last_name }}
                                        </option>
                                    @endforeach
                                </select>
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

                            <div class="col-12">
                                <label class="form-label">Video Link (Optional)</label>
                                <input type="url" name="video_link" class="form-control" value="{{ old('video_link', $insight->video_link) }}">
                            </div>
                            <div class="col-12">
    <label class="form-label">Source Name (Op-Ed এর জন্য, যেমন: Daily Star)</label>
    <input type="url" name="source_name" class="form-control" 
        value="{{ old('source_name', $insight->source_name) }}"
        placeholder="e.g. Daily Star">
</div>

                            <div class="col-md-8">
                                <label class="form-label">Insight Image</label>
                                <input type="file" name="article_image" class="form-control" accept="image/*" data-max-size="4096" data-max-width="1200" data-max-height="800">
                                @if($insight->articleImageUrl() ?? $insight->imageUrl())
                                    <small class="text-muted">Current: <a href="{{ $insight->articleImageUrl() ?? $insight->imageUrl() }}" target="_blank">View image</a></small>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Image Description</label>
                                <input type="text" name="articles[0][image_description]" class="form-control"
                                    value="{{ old('articles.0.image_description', $insight->articles->first()?->image_description) }}"
                                    placeholder="Category/Label">
                            </div>

                           <div class="col-12">

    {{-- Insight Attachment (Brochures / Download) --}}
    <div class="p-3 border rounded mb-3" style="border-left: 4px solid #e85d26 !important;">
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

    {{-- Article Attachment (Read / Articles) --}}
    <div class="p-3 border rounded" style="border-left: 4px solid #0369a1 !important;">
        <label class="form-label fw-bold mb-1">
            <i class="fas fa-file-alt me-1" style="color:#0369a1;"></i>
            Article Attachment
            <span class="badge bg-primary ms-1" style="font-size:10px;">Read / Articles</span>
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

                            {{-- Social Share Links --}}
                            <div class="col-12 mt-2 p-3 bg-light rounded">
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

@endsection

{{-- CKEditor CDN --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editTypeSelect = document.getElementById('editInsightTypeSelect');
    const editAuthorWrap = document.getElementById('editAuthorFieldWrap');
    const editAuthorSelect = document.getElementById('editAuthorTeamSelect');
    const editArticleSectionsWrap = document.getElementById('editArticleSectionsWrap');

    const editors = {}; // CKEditor 5 instances store করার জন্য

    function isReadTypeSelected() {
        if (!editTypeSelect) return false;
        const selected = editTypeSelect.options[editTypeSelect.selectedIndex];
        const category = (selected?.dataset?.typeCategory || '').toLowerCase();
        const optionText = (selected?.text || '').toLowerCase();

        return ['read', 'article'].includes(category) || optionText.includes('article') || optionText.includes('read');
    }

    function toggleReadOnlyFields() {
        const showReadFields = isReadTypeSelected();

        if (editAuthorWrap) editAuthorWrap.style.display = showReadFields ? '' : 'none';
        if (editAuthorSelect) {
            editAuthorSelect.required = showReadFields;
            if (!showReadFields) editAuthorSelect.value = '';
        }

        if (editArticleSectionsWrap) {
            editArticleSectionsWrap.style.display = showReadFields ? '' : 'none';
            editArticleSectionsWrap.querySelectorAll('input, textarea, select, button').forEach((el) => {
                if (el.id === 'addArticleBtn') {
                    el.disabled = !showReadFields;
                    return;
                }

                if (['INPUT', 'TEXTAREA', 'SELECT'].includes(el.tagName)) {
                    el.disabled = !showReadFields;
                }
            });
        }
    }

    // ===== CKEditor 5 Initialize =====
    function initCKEditor(textarea) {
        if (!textarea || editors[textarea.id]) return;

        ClassicEditor.create(textarea, {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'link', '|',
                    'undo', 'redo'
                ]
            },
        }).then(editor => {
            editors[textarea.id] = editor;
        }).catch(err => {
            console.error(err);
        });
    }

    // সব existing editor init করুন
    document.querySelectorAll('textarea.article-editor').forEach(function(textarea) {
        initCKEditor(textarea);
    });

    // ===== Article Section Logic =====
    const wrapper = document.getElementById('articles-wrapper');
    const btn = document.getElementById('addArticleBtn');
    const tpl = document.getElementById('articleTemplate');

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
            let h = tpl.innerHTML.trim();
            h = h.replaceAll('__ARTICLE_NAME__', `articles[${idx}]`).replaceAll('__INDEX__', idx);
            wrapper.insertAdjacentHTML('beforeend', h);
            reindex();

            // নতুন textarea init করুন
            setTimeout(() => {
                const newTextarea = document.getElementById(`articleEditor_${idx}`);
                if (newTextarea) initCKEditor(newTextarea);
            }, 100);
        });

        wrapper.addEventListener('click', e => {
            if (e.target.closest('.remove-article-row')) {
                const row = e.target.closest('.article-row');
                // CKEditor destroy করুন
                row.querySelectorAll('textarea.article-editor').forEach(function(ta) {
                    if (editors[ta.id]) {
                        editors[ta.id].destroy();
                        delete editors[ta.id];
                    }
                });
                row.remove();
                reindex();
            }
        });

        reindex();
    }

    // ===== Social Links Logic =====
    const socialWrapper = document.getElementById('social-links-wrapper');
    const socialBtn = document.getElementById('add-social-link-btn');
    if (socialWrapper && socialBtn) {
        socialBtn.addEventListener('click', () => {
            const count = socialWrapper.querySelectorAll('.social-link-row').length;
            const row = document.createElement('div');
            row.className = 'social-link-row d-flex gap-2 mb-2';
            row.innerHTML = `
                <input type="text" name="articles[0][social_links][${count}][name]"
                    class="form-control form-control-sm" placeholder="Platform" style="width:140px">
                <input type="text" name="articles[0][social_links][${count}][link]"
                    class="form-control form-control-sm" placeholder="URL">
                <button type="button" class="btn btn-sm btn-outline-danger remove-social-link">&times;</button>
            `;
            socialWrapper.appendChild(row);
        });

        socialWrapper.addEventListener('click', e => {
            if (e.target.closest('.remove-social-link')) {
                e.target.closest('.social-link-row').remove();
            }
        });
    }

    // ===== Form Submit — CKEditor 5 data sync =====
    document.getElementById('editInsightForm').addEventListener('submit', function() {
        Object.values(editors).forEach(editor => {
            const sourceElement = editor.sourceElement;
            if (sourceElement) {
                sourceElement.value = editor.getData();
            }
        });
    });

    if (editTypeSelect) {
        editTypeSelect.addEventListener('change', toggleReadOnlyFields);
    }

    toggleReadOnlyFields();

});
</script>