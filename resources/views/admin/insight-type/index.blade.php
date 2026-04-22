@extends('layouts.app')

@section('content')
    
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Insights Manager</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Insights Type Manager</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Create Type</h3>
                        </div>
                        <form action="{{ route('admin.insight-types.store') }}" method="POST" enctype="multipart/form-data" id="insightTypeForm">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    
                                    <div class="col-12">
                                        <label class="form-label">Type Name</label>
                                        <input type="text" name="type" value="{{ old('type') }}" class="form-control @error('type') is-invalid @enderror">
                                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" id="activeSwitch" @checked(old('status', '1') == '1')>
                                            <label class="form-check-label" for="activeSwitch">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Type</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-xl-7">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Existing Insights</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Heading</th>
                                        <th>Type</th>
                                        <th>Articles</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($insights as $insight)
                                        <tr>
                                            <td>
                                                @if($insight->imageUrl())
                                                    <img src="{{ $insight->imageUrl() }}" alt="{{ $insight->heading }}" style="width: 42px; height: 42px; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $insight->heading }}</td>
                                            <td>{{ strtoupper(str_replace('_', ' ', $insight->type)) }}</td>
                                            <td>{{ $insight->articles->count() }}</td>
                                            <td>{{ $insight->sort_order }}</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('admin.insights.edit', $insight) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form action="{{ route('admin.insights.destroy', $insight) }}" method="POST" onsubmit="return confirm('Delete this insight?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No insights found yet.</td>
                                        </tr>
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
            queue.innerHTML = '';
            if (!input.files || input.files.length === 0) return;

            const file = input.files[0];
            const card = document.createElement('div');
            card.className = 'border rounded p-2 d-flex justify-content-between align-items-center';
            const fileSize = (file.size / 1024).toFixed(1) + ' KB';
            card.innerHTML = '<div><strong>' + file.name + '</strong><div class="small text-muted">' + fileSize + '</div></div>' +
                '<button type="button" class="btn btn-sm btn-outline-danger" id="' + id + '">Remove</button>';
            queue.appendChild(card);

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
            if (!event.target.classList.contains('remove-article-row')) {
                return;
            }
            event.target.closest('.article-row').remove();
            reindexArticleRows();
        });

        reindexArticleRows();
    })();
</script>
@endpush
