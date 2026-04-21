@extends('layouts.app')

@section('content')
    @php
        $previewContent = $content ?? null;
        $previewSlug = $previewContent ? $previewContent->slug : '';
        $previewSection = $previewContent ? $previewContent->section : '';
        $previewHeading = $previewContent ? $previewContent->heading : '';
        $previewSubHeading = $previewContent ? $previewContent->sub_heading : '';
        $previewDesignWord = $previewContent ? $previewContent->design_word : '';
        $previewType = $previewContent ? $previewContent->type : '';
        $previewIconUrl = $previewContent ? $previewContent->iconUrl() : null;
        $previewImageUrl = $previewContent ? $previewContent->imageUrl() : null;
    @endphp

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Content</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.content.index') }}">Content Manager</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-xl-7">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Content</h3>
                        </div>
                        <form action="{{ route('admin.content.update', $content) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('admin.content.partials.form', ['content' => $content])
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update Content</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-xl-5">
                    <div class="card card-outline card-secondary">
                        <div class="card-header"><h3 class="card-title">Preview</h3></div>
                        <div class="card-body">
                            <p class="mb-1"><strong>Slug:</strong> {{ $previewSlug }}</p>
                            <p class="mb-1"><strong>Section:</strong> {{ $previewSection }}</p>
                            <p class="mb-1"><strong>Heading:</strong> {{ $previewHeading }}</p>
                            <p class="mb-1"><strong>Sub heading:</strong> {{ $previewSubHeading }}</p>
                            <p class="mb-1"><strong>Design word:</strong> {{ $previewDesignWord }}</p>
                            <p class="mb-1"><strong>Type:</strong> {{ $previewType }}</p>
                            <hr>
                            @if($previewIconUrl)
                                <div class="mb-3">
                                    <strong class="d-block mb-1">Icon</strong>
                                    <img src="{{ $previewIconUrl }}" alt="icon" style="width: 60px; height: 60px; object-fit: contain;">
                                </div>
                            @endif
                            @if($previewImageUrl)
                                <div>
                                    <strong class="d-block mb-1">Image</strong>
                                    <img src="{{ $previewImageUrl }}" alt="image" class="img-fluid rounded">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
