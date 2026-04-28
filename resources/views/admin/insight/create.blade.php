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
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12" id="authorFieldWrap">
                                    <label class="form-label">Author Name</label>
                                    <select id="authorTeamSelect" name="author_team_id" class="form-control">
                                        <option value="">Select Author</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" {{ old('author_team_id') == $team->id ? 'selected' : '' }}>
                                                {{ $team->first_name }} {{ $team->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
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

                                <div class="col-md-6">
                                    <label class="form-label">Published At</label>
                                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="form-control @error('published_at') is-invalid @enderror">
                                    @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Source Name</label>
                                    <input type="text" name="source_name" value="{{ old('source_name') }}" class="form-control @error('source_name') is-invalid @enderror">
                                    @error('source_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
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
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 1200×800px (max 4MB)</small>
                                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Attachment</label>
                                    <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror"
                                           accept=".pdf,.mp4,.mov,.webm,.avi,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,.svg">
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> PDF, video, or document (max 30MB)</small>
                                    @error('attachment')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                            <textarea name="articles[{{ $index }}][description]" rows="2" class="form-control" placeholder="Section content...">{{ $article['description'] ?? '' }}</textarea>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">Article Image</label>
                                            <input type="file" name="article_images[{{ $index }}]" class="form-control" accept="image/*">
                                            <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 800×600px (max 2MB)</small>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Image Description</label>
                                            <input type="text" name="articles[{{ $index }}][image_description]" value="{{ $article['image_description'] ?? '' }}" class="form-control" placeholder="Category Label">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">File Attachment</label>
                                            <input type="file" name="article_attachments[{{ $index }}]" class="form-control"
                                                   accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.mov">
                                        </div>
                                        <div class="col-12 mt-1 p-3 bg-light rounded">
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
                <textarea name="__ARTICLE_NAME__[description]" rows="2" class="form-control" placeholder="Section content..."></textarea>
            </div>
            <div class="col-md-8">
                <label class="form-label">Article Image</label>
                <input type="file" name="article_images[__INDEX__]" class="form-control" accept="image/*">
                <small class="text-muted"><i class="fas fa-info-circle"></i> Recommended: 800×600px (max 2MB)</small>
            </div>
            <div class="col-md-4">
                <label class="form-label">Image Description</label>
                <input type="text" name="__ARTICLE_NAME__[image_description]" class="form-control" placeholder="Category Label">
            </div>
            <div class="col-12">
                <label class="form-label">File Attachment</label>
                <input type="file" name="article_attachments[__INDEX__]" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.mov">
            </div>
            <div class="col-12 mt-1 p-3 bg-light rounded">
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
            <div class="col-12 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-outline-danger remove-article-row">
                    <i class="fas fa-trash me-1"></i> Remove Section
                </button>
            </div>
        </div>
    </div>
</template>
@endsection

@push('custome-js')
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
        }
    }

    const wrapper = document.getElementById('articlesWrapper');
    const btn = document.getElementById('addArticleRow');
    const tpl = document.getElementById('articleRowTemplate');

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
            if (sWrap) {
                sWrap.setAttribute('data-idx', idx);
                const addBtn = row.querySelector('.add-social-link');
                if (addBtn) addBtn.setAttribute('data-idx', idx);
            }
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
        if (e.target.closest('.remove-article-row')) {
            e.target.closest('.article-row').remove();
            reindex();
            return;
        }
        if (e.target.closest('.remove-social-link')) {
            e.target.closest('.social-link-row').remove();
            return;
        }
        if (e.target.closest('.add-social-link')) {
            const btnEl = e.target.closest('.add-social-link');
            const container = btnEl.previousElementSibling;
            const idx = container.getAttribute('data-idx');
            const count = container.querySelectorAll('.social-link-row').length;
            const row = document.createElement('div');
            row.className = 'social-link-row d-flex gap-2 mb-2';
            row.innerHTML = `<input type="text" name="articles[${idx}][social_links][${count}][name]" class="form-control form-control-sm" placeholder="Platform" style="width:140px">
                <input type="url" name="articles[${idx}][social_links][${count}][link]" class="form-control form-control-sm" placeholder="URL">
                <input type="file" name="social_icon_files[${idx}][${count}]" class="form-control form-control-sm" accept="image/*" style="width:150px">
                <button type="button" class="btn btn-sm btn-outline-danger remove-social-link">&times;</button>`;
            container.appendChild(row);
        }
    });

    if (typeSelect) typeSelect.addEventListener('change', toggleReadOnlyFields);
    reindex();
    toggleReadOnlyFields();
});
</script>
@endpush
