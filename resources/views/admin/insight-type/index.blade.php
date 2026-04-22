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
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($insights as $insight)
                                        <tr>
                                            <td>{{ strtoupper(str_replace('_', ' ', $insight->type)) }}</td>
                                            <td>
                                                @if($insight->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                                </td>
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
