@extends('layouts.app')

@section('content')
    @php
        $articleRows = old('articles', $insight->articles->map(function ($article) {
            return [
                'id' => $article->id,
                'author_team_id' => $article->author_team_id,
                'type' => $article->type,
                'title' => $article->title,
                'description' => $article->description,
                'read_minutes' => $article->read_minutes,
                'published_at' => optional($article->published_at)->format('Y-m-d\\TH:i'),
                'icon_url' => $article->iconUrl(),
                'attachment_url' => $article->attachmentUrl(),
            ];
        })->values()->all());

        if (empty($articleRows)) {
            $articleRows = [[
                'id' => null,
                'author_team_id' => '',
                'type' => 'read',
                'title' => '',
                'description' => '',
                'read_minutes' => '',
                'published_at' => '',
                'icon_url' => null,
                'attachment_url' => null,
            ]];
        }
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Insight</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.insights.index') }}">Insights Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('admin.insights.update', $insight) }}" method="POST" enctype="multipart/form-data" id="insightForm">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-12 col-xl-4">
                        <div class="card card-outline card-primary">
                            <div class="card-header"><h3 class="card-title">Insight Information</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Type</label>
                                        <select name="type" class="form-select @error('type') is-invalid @enderror">
                                            <option value="download" @selected(old('type', $insight->type) === 'download')>Download</option>
                                            <option value="read" @selected(old('type', $insight->type) === 'read')>Read</option>
                                            <option value="video_watch" @selected(old('type', $insight->type) === 'video_watch')>Video Watch</option>
                                        </select>
                                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', $insight->sort_order) }}" class="form-control @error('sort_order') is-invalid @enderror">
                                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Heading</label>
                                        <input type="text" name="heading" value="{{ old('heading', $insight->heading) }}" class="form-control @error('heading') is-invalid @enderror">
                                        @error('heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Sub Heading</label>
                                        <input type="text" name="sub_heading" value="{{ old('sub_heading', $insight->sub_heading) }}" class="form-control @error('sub_heading') is-invalid @enderror">
                                        @error('sub_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $insight->description) }}</textarea>
                                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Published At</label>
                                        <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($insight->published_at)->format('Y-m-d\\TH:i')) }}" class="form-control @error('published_at') is-invalid @enderror">
                                        @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="active" value="1" id="activeSwitch" @checked(old('active', $insight->active) == 1)>
                                            <label class="form-check-label" for="activeSwitch">Active</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Insight Image</label>
                                        <div class="mb-2 d-flex gap-2 align-items-center flex-wrap">
                                            <button type="button" id="addInsightImage" class="btn btn-sm btn-outline-primary">+ Add Image</button>
                                            @if($insight->imageUrl())
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="removeCurrentImage">
                                                    <label class="form-check-label" for="removeCurrentImage">Remove current image</label>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" id="insightImageInput" name="image" class="d-none" accept="image/*">
                                        <div id="insightImageQueue" class="d-grid gap-2 mb-2">
                                            @if($insight->imageUrl())
                                                <div class="border rounded p-2 d-flex justify-content-between align-items-center">
                                                    <div><strong>Current image</strong></div>
                                                    <img src="{{ $insight->imageUrl() }}" alt="current image" style="width: 56px; height: 56px; object-fit: cover; border-radius: 8px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Attachment</label>
                                        <div class="mb-2 d-flex gap-2 align-items-center flex-wrap">
                                            <button type="button" id="addInsightAttachment" class="btn btn-sm btn-outline-primary">+ Add Attachment</button>
                                            @if($insight->attachmentUrl())
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remove_attachment" value="1" id="removeCurrentAttachment">
                                                    <label class="form-check-label" for="removeCurrentAttachment">Remove current attachment</label>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" id="insightAttachmentInput" name="attachment" class="d-none" accept=".pdf,.mp4,.mov,.webm,.avi,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,.svg">
                                        <div id="insightAttachmentQueue" class="d-grid gap-2 mb-2">
                                            @if($insight->attachmentUrl())
                                                <div class="border rounded p-2 d-flex justify-content-between align-items-center">
                                                    <div><strong>Current attachment</strong></div>
                                                    <a href="{{ $insight->attachmentUrl() }}" target="_blank" class="btn btn-sm btn-outline-secondary">View</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-8">
                        <div class="card card-outline card-secondary mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Insight Articles</h3>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addArticleRow">Add Row</button>
                            </div>
                            <div class="card-body">
                                <div id="articlesWrapper" class="d-grid gap-3">
                                    @foreach($articleRows as $index => $article)
                                        <div class="border rounded p-3 article-row">
                                            <div class="row g-2 align-items-end">
                                                <div class="col-md-4">
                                                    <label class="form-label">Title</label>
                                                    <input type="hidden" name="articles[{{ $index }}][id]" value="{{ $article['id'] ?? '' }}">
                                                    <input type="text" name="articles[{{ $index }}][title]" value="{{ $article['title'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Author</label>
                                                    <select name="articles[{{ $index }}][author_team_id]" class="form-select">
                                                        <option value="">Select</option>
                                                        @foreach($teams as $team)
                                                            <option value="{{ $team->id }}" @selected(($article['author_team_id'] ?? null) == $team->id)>{{ $team->fullName() }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Type</label>
                                                    <select name="articles[{{ $index }}][type]" class="form-select">
                                                        <option value="download" @selected(($article['type'] ?? '') === 'download')>Download</option>
                                                        <option value="read" @selected(($article['type'] ?? 'read') === 'read')>Read</option>
                                                        <option value="video_watch" @selected(($article['type'] ?? '') === 'video_watch')>Video</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Read Min</label>
                                                    <input type="number" name="articles[{{ $index }}][read_minutes]" value="{{ $article['read_minutes'] ?? '' }}" class="form-control" min="1" max="999">
                                                </div>
                                                <div class="col-md-1 d-grid">
                                                    <button type="button" class="btn btn-outline-danger remove-article-row">&times;</button>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" name="articles[{{ $index }}][description]" value="{{ $article['description'] ?? '' }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Icon</label>
                                                    <input type="file" name="article_icons[{{ $index }}]" class="form-control" accept="image/*">
                                                    @if(!empty($article['icon_url']))
                                                        <img src="{{ $article['icon_url'] }}" alt="icon" style="width: 24px; height: 24px; object-fit: contain; margin-top: 6px;">
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Attachment</label>
                                                    <input type="file" name="article_attachments[{{ $index }}]" class="form-control" accept=".pdf,.mp4,.mov,.webm,.avi,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,.svg">
                                                    @if(!empty($article['attachment_url']))
                                                        <a href="{{ $article['attachment_url'] }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-1">View</a>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Published At</label>
                                                    <input type="datetime-local" name="articles[{{ $index }}][published_at]" value="{{ $article['published_at'] ?? '' }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">Update Insight</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <template id="articleRowTemplate">
        <div class="border rounded p-3 article-row">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Title</label>
                    <input type="hidden" name="__ARTICLE_NAME__[id]" value="">
                    <input type="text" name="__ARTICLE_NAME__[title]" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Author</label>
                    <select name="__ARTICLE_NAME__[author_team_id]" class="form-select">
                        <option value="">Select</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->fullName() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Type</label>
                    <select name="__ARTICLE_NAME__[type]" class="form-select">
                        <option value="download">Download</option>
                        <option value="read" selected>Read</option>
                        <option value="video_watch">Video</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Read Min</label>
                    <input type="number" name="__ARTICLE_NAME__[read_minutes]" class="form-control" min="1" max="999">
                </div>
                <div class="col-md-1 d-grid">
                    <button type="button" class="btn btn-outline-danger remove-article-row">&times;</button>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Description</label>
                    <input type="text" name="__ARTICLE_NAME__[description]" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Icon</label>
                    <input type="file" name="__ARTICLE_ICON_NAME__" class="form-control" accept="image/*">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Attachment</label>
                    <input type="file" name="__ARTICLE_ATTACHMENT_NAME__" class="form-control" accept=".pdf,.mp4,.mov,.webm,.avi,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,.svg">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Published At</label>
                    <input type="datetime-local" name="__ARTICLE_NAME__[published_at]" class="form-control">
                </div>
            </div>
        </div>
    </template>
@endsection

@push('custome-js')
<script>
    (function () {
        const articlesWrapper = document.getElementById('articlesWrapper');
        const addArticleBtn = document.getElementById('addArticleRow');
        const articleTemplate = document.getElementById('articleRowTemplate');

        const imageInput = document.getElementById('insightImageInput');
        const addImageBtn = document.getElementById('addInsightImage');
        const imageQueue = document.getElementById('insightImageQueue');

        const attachmentInput = document.getElementById('insightAttachmentInput');
        const addAttachmentBtn = document.getElementById('addInsightAttachment');
        const attachmentQueue = document.getElementById('insightAttachmentQueue');

        function renderQueue(input, queue, id) {
            const selectedCard = queue.querySelector('[data-selected="1"]');
            if (selectedCard) selectedCard.remove();

            if (!input.files || input.files.length === 0) return;

            const file = input.files[0];
            const card = document.createElement('div');
            card.dataset.selected = '1';
            card.className = 'border rounded p-2 d-flex justify-content-between align-items-center';
            const fileSize = (file.size / 1024).toFixed(1) + ' KB';
            card.innerHTML = '<div><strong>' + file.name + '</strong><div class="small text-muted">' + fileSize + '</div></div>' +
                '<button type="button" class="btn btn-sm btn-outline-danger" id="' + id + '">Remove</button>';
            queue.prepend(card);

            const removeBtn = document.getElementById(id);
            if (removeBtn) {
                removeBtn.addEventListener('click', function () {
                    input.value = '';
                    renderQueue(input, queue, id);
                });
            }
        }

        if (addImageBtn) {
            addImageBtn.addEventListener('click', function () {
                imageInput.click();
            });
        }

        if (imageInput) {
            imageInput.addEventListener('change', function () {
                renderQueue(imageInput, imageQueue, 'removeInsightImage');
            });
        }

        if (addAttachmentBtn) {
            addAttachmentBtn.addEventListener('click', function () {
                attachmentInput.click();
            });
        }

        if (attachmentInput) {
            attachmentInput.addEventListener('change', function () {
                renderQueue(attachmentInput, attachmentQueue, 'removeInsightAttachment');
            });
        }

        function reindexArticleRows() {
            articlesWrapper.querySelectorAll('.article-row').forEach(function (row, index) {
                row.querySelectorAll('input, select, textarea').forEach(function (field) {
                    field.name = field.name
                        .replace(/articles\[\d+\]/, 'articles[' + index + ']')
                        .replace(/article_icons\[\d+\]/, 'article_icons[' + index + ']')
                        .replace(/article_attachments\[\d+\]/, 'article_attachments[' + index + ']');
                });
            });
        }

        if (addArticleBtn) {
            addArticleBtn.addEventListener('click', function () {
                const index = articlesWrapper.querySelectorAll('.article-row').length;
                const html = articleTemplate.innerHTML
                    .replaceAll('__ARTICLE_NAME__', 'articles[' + index + ']')
                    .replaceAll('__ARTICLE_ICON_NAME__', 'article_icons[' + index + ']')
                    .replaceAll('__ARTICLE_ATTACHMENT_NAME__', 'article_attachments[' + index + ']');
                articlesWrapper.insertAdjacentHTML('beforeend', html);
            });
        }

        articlesWrapper.addEventListener('click', function (event) {
            if (!event.target.classList.contains('remove-article-row')) return;
            event.target.closest('.article-row').remove();
            reindexArticleRows();
        });

        reindexArticleRows();
    })();
</script>
@endpush
