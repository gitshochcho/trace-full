@extends('layouts.app')
@section('content')
@php
$articleRows = old('articles', [[
    'id' => null, 'author_team_id' => '', 'type' => '',
    'title' => '', 'description' => '', 'read_minutes' => '',
    'published_at' => '', 'image_description' => '', 'social_links' => [],
]]);
@endphp

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0">Insights Manager</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Insights Manager</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12 col-xl-5">
                <div class="card card-outline card-primary">
                    <div class="card-header"><h3 class="card-title">Create Insight</h3></div>
                    <form action="{{ route('admin.insights.store') }}" method="POST" enctype="multipart/form-data" id="insightForm">
                        @csrf
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Type</label>
                                    <select id="insightTypeSelect" name="type" class="form-select @error('type') is-invalid @enderror" required>
                                        <option value="">Select Type</option>
                                        @foreach($insightTypes as $type)
                                            <option value="{{ $type->id }}" data-type-category="{{ strtolower((string) ($type->type_category ?? '')) }}" @selected(old('type') == $type->id)>{{ ucfirst(str_replace('_', ' ', $type->type)) }}</option>
                                        @endforeach
                                    </select>
                                    @error('type') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 mb-3" id="authorFieldWrap">
                                    <label class="form-label">Author Name</label>
                                    <select id="authorTeamSelect" name="author_team_id" class="form-control">
                                        <option value="">Select Author</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" {{ old('author_team_id') == $team->id ? 'selected' : '' }}>{{ $team->first_name }} {{ $team->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Heading</label>
                                    <input type="text" name="heading" value="{{ old('heading') }}" class="form-control @error('heading') is-invalid @enderror">
                                    @error('heading') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Sub Heading</label>
                                    <input type="text" name="sub_heading" value="{{ old('sub_heading') }}" class="form-control @error('sub_heading') is-invalid @enderror">
                                    @error('sub_heading') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Published At</label>
                                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="form-control @error('published_at') is-invalid @enderror">
                                    @error('published_at') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="active" value="1" id="activeSwitch" @checked(old('active', '1') == '1')>
                                        <label class="form-check-label" for="activeSwitch">Active</label>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <label class="form-label">Insight Image</label>
                                    <button type="button" id="addInsightImage" class="btn btn-sm btn-outline-primary mb-2">+ Add Image</button>
                                    <input type="file" id="insightImageInput" name="image" class="d-none" accept="image/*">
                                    <div id="insightImageQueue" class="d-grid gap-2"></div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Attachment (PDF/Video/Doc)</label>
                                    <button type="button" id="addInsightAttachment" class="btn btn-sm btn-outline-primary mb-2">+ Add Attachment</button>
                                    <input type="file" id="insightAttachmentInput" name="attachment" class="d-none" accept=".pdf,.mp4,.mov,.webm,.avi,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,.svg">
                                    <div id="insightAttachmentQueue" class="d-grid gap-2"></div>
                                </div> --}}

                                <div class="col-12" id="articleSectionsWrap">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label mb-0 fw-bold">Article Sections</label>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="addArticleRow">+ Add Section</button>
                                    </div>
                                    <div id="articlesWrapper" class="d-grid gap-2">
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
                                                        <textarea name="articles[{{ $index }}][description]" rows="2" class="form-control" placeholder="Section content...">{{ $article['description'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="form-label">Article Image</label>
                                                        <input type="file" name="article_images[{{ $index }}]" class="form-control" accept="image/*">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Image Description</label>
                                                        <input type="text" name="articles[{{ $index }}][image_description]" value="{{ $article['image_description'] ?? '' }}" class="form-control" placeholder="Category Label">
                                                    </div>
                                                  <div class="mb-3">
    <label class="form-label">File Attachment</label>
    <input type="file" name="article_attachments[{{ $index }}]" class="form-control" 
        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.mov">
</div>
                                                    
                                                    <div class="col-12 mt-2 p-3 bg-light rounded">
                                                        <label class="form-label fw-bold">Social Share Links</label>
                                                        <div class="social-links-wrapper" data-idx="{{ $index }}">
                                                            @foreach(old("articles.$index.social_links", $article['social_links'] ?? []) as $sIdx => $link)
                                                                <div class="social-link-row d-flex gap-2 mb-2">
                                                                    <input type="text" name="articles[{{ $index }}][social_links][{{ $sIdx }}][name]" class="form-control form-control-sm" placeholder="Platform" value="{{ $link['name'] ?? '' }}" style="width:140px">
                                                                    <input type="url" name="articles[{{ $index }}][social_links][{{ $sIdx }}][link]" class="form-control form-control-sm" placeholder="URL" value="{{ $link['link'] ?? '' }}">
                                                                    <input type="file" name="social_icon_files[{{ $index }}][{{ $sIdx }}]" class="form-control form-control-sm" accept="image/*" style="width:150px">
                                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-social-link">&times;</button>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-outline-primary add-social-link" data-idx="{{ $index }}">+ Add Social Link</button>
                                                    </div>

                                                    <div class="col-md-1 d-flex align-items-end">
                                                        <button type="button" class="btn btn-outline-danger w-100 remove-article-row">&times;</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end"><button type="submit" class="btn btn-primary">Save Insight</button></div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-xl-7">
                <div class="card card-outline card-secondary">
                    <div class="card-header"><h3 class="card-title">Existing Insights</h3></div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped align-middle mb-0">
                            <thead><tr><th>Image</th><th>Heading</th><th>Type</th><th>Sections</th><th>Order</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse($insights as $insight)
                                    <tr>
                                        <td>@if($insight->imageUrl())<img src="{{ $insight->imageUrl() }}" alt="{{ $insight->heading }}" style="width:42px;height:42px;object-fit:cover;border-radius:8px;">@else<span class="text-muted">-</span>@endif</td>
                                        <td>{{ $insight->heading }}</td>
                                        <td>{{ $insight->insightType ? ucfirst(str_replace('_', ' ', $insight->insightType->type)) : '-' }}</td>
                                        <td>{{ $insight->articles->count() }}</td>
                                        <td>{{ $insight->sort_order }}</td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('admin.insights.edit', $insight) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('admin.insights.destroy', $insight) }}" method="POST" onsubmit="return confirm('Delete this insight?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger">Delete</button></form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center text-muted py-4">No insights found yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<template id="articleRowTemplate">
    <div class="border rounded p-3 article-row">
        <input type="hidden" name="__ARTICLE_NAME__[id]" value="">
        <div class="row g-3">
            <div class="col-md-5"><label class="form-label">Section Title</label><input type="text" name="__ARTICLE_NAME__[title]" class="form-control" placeholder="e.g. Abstract"></div>
            <div class="col-md-3"><label class="form-label">Read Minutes</label><input type="number" name="__ARTICLE_NAME__[read_minutes]" class="form-control" min="1" placeholder="5"></div>
            <div class="col-md-4"><label class="form-label">Published At</label><input type="datetime-local" name="__ARTICLE_NAME__[published_at]" class="form-control"></div>
            <div class="col-12"><label class="form-label">Description</label><textarea name="__ARTICLE_NAME__[description]" rows="2" class="form-control" placeholder="Section content..."></textarea></div>
            <div class="col-md-8"><label class="form-label">Article Image</label><input type="file" name="article_images[__INDEX__]" class="form-control" accept="image/*"></div>
            <div class="col-md-4"><label class="form-label">Image Description</label><input type="text" name="__ARTICLE_NAME__[image_description]" class="form-control" placeholder="Category Label"></div>
            <div class="col-md-8"><label class="form-label">File Attachment</label><input type="file" name="article_attachments[__INDEX__]" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.mov"></div>
            <div class="col-12 mt-2 p-3 bg-light rounded">
                <label class="form-label fw-bold">Social Share Links</label>
                <div class="social-links-wrapper" data-idx="__INDEX__">
                    <div class="social-link-row d-flex gap-2 mb-2">
                        <input type="text" name="__ARTICLE_NAME__[social_links][0][name]" class="form-control form-control-sm" placeholder="Platform" style="width:140px">
                        <input type="url" name="__ARTICLE_NAME__[social_links][0][link]" class="form-control form-control-sm" placeholder="URL">
                        <input type="file" name="social_icon_files[__INDEX__][0]" class="form-control form-control-sm" accept="image/*" style="width:150px">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-social-link">&times;</button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary add-social-link" data-idx="__INDEX__">+ Add Social Link</button>
            </div>
            <div class="col-md-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger w-100 remove-article-row">&times;</button></div>
        </div>
    </div>
</template>
@endsection

{{-- @push('scripts') --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('insightTypeSelect');
    const authorWrap = document.getElementById('authorFieldWrap');
    const authorSelect = document.getElementById('authorTeamSelect');
    const articleSectionsWrap = document.getElementById('articleSectionsWrap');

    function isReadTypeSelected() {
        if (!typeSelect) return false;
        const selected = typeSelect.options[typeSelect.selectedIndex];
        const category = (selected?.dataset?.typeCategory || '').toLowerCase();
        const optionText = (selected?.text || '').toLowerCase();
        return ['read', 'article'].includes(category) || optionText.includes('article') || optionText.includes('read');
    }

    function toggleReadOnlyFields() {
        const showReadFields = isReadTypeSelected();
        if (authorWrap) authorWrap.style.display = showReadFields ? '' : 'none';
        if (authorSelect) {
            authorSelect.required = showReadFields;
            if (!showReadFields) authorSelect.value = '';
        }

        if (articleSectionsWrap) {
            articleSectionsWrap.style.display = showReadFields ? '' : 'none';
            articleSectionsWrap.querySelectorAll('input, textarea, select, button').forEach((el) => {
                if (el.id === 'addArticleRow') {
                    el.disabled = !showReadFields;
                    return;
                }
                if (['INPUT', 'TEXTAREA', 'SELECT'].includes(el.tagName)) {
                    el.disabled = !showReadFields;
                }
            });
        }
    }

    const wrapper = document.getElementById('articlesWrapper');
    const btn = document.getElementById('addArticleRow');
    const tpl = document.getElementById('articleRowTemplate');
    if (!wrapper || !btn || !tpl) return;

    function reindex() {
        wrapper.querySelectorAll('.article-row').forEach((row, idx) => {
            row.querySelectorAll('input, textarea').forEach(field => {
                if (field.name) field.name = field.name.replace(/articles\[\d+\]/, `articles[${idx}]`);
            });
            row.querySelectorAll('input[type="file"]').forEach(field => {
                if (field.name.startsWith('article_images[')) field.name = `article_images[${idx}]`;
                if (field.name.startsWith('article_attachments[')) field.name = `article_attachments[${idx}]`;
            });
            const sWrap = row.querySelector('.social-links-wrapper');
            if (sWrap) { sWrap.setAttribute('data-idx', idx); const addBtn = row.querySelector('.add-social-link'); if(addBtn) addBtn.setAttribute('data-idx', idx); }
        });
    }

    btn.addEventListener('click', () => {
        const idx = wrapper.querySelectorAll('.article-row').length;
        let html = tpl.innerHTML.trim();
        html = html.replaceAll('__ARTICLE_NAME__', `articles[${idx}]`).replaceAll('__INDEX__', idx);
        wrapper.insertAdjacentHTML('beforeend', html);
        reindex();
    });

    wrapper.addEventListener('click', e => {
        if (e.target.closest('.remove-article-row')) { e.target.closest('.article-row').remove(); reindex(); return; }
        if (e.target.closest('.remove-social-link')) { e.target.closest('.social-link-row').remove(); return; }
        if (e.target.closest('.add-social-link')) {
            const btnEl = e.target.closest('.add-social-link');
            const container = btnEl.previousElementSibling;
            const idx = container.getAttribute('data-idx');
            const count = container.querySelectorAll('.social-link-row').length;
            const row = document.createElement('div');
            row.className = 'social-link-row d-flex gap-2 mb-2';
            row.innerHTML = `<input type="text" name="articles[${idx}][social_links][${count}][name]" class="form-control form-control-sm" placeholder="Platform" style="width:140px"><input type="url" name="articles[${idx}][social_links][${count}][link]" class="form-control form-control-sm" placeholder="URL"><input type="file" name="social_icon_files[${idx}][${count}]" class="form-control form-control-sm" accept="image/*" style="width:150px"><button type="button" class="btn btn-sm btn-outline-danger remove-social-link">&times;</button>`;
            container.appendChild(row);
        }
    });

    if (typeSelect) typeSelect.addEventListener('change', toggleReadOnlyFields);

    reindex();
    toggleReadOnlyFields();
});
</script>
{{-- @endpush --}}