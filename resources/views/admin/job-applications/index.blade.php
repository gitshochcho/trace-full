@extends('layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Job Applications</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Job Applications</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0" id="applicationsCountHeading">All Applications ({{ $applications->total() }})</h3>
                                <div class="card-tools d-flex align-items-center">
                                    <form method="GET" id="applicationsFilterForm" class="d-flex me-2" onsubmit="return false;">
                                        <input type="text" name="search" id="applicationsSearchInput" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search by name or email" autocomplete="off">
                                        <select name="status" id="applicationsStatusSelect" class="form-select form-select-sm me-2" style="width: auto;">
                                            <option value="">All Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        </select>
                                        <select name="job_posting_id" id="applicationsJobPostingSelect" class="form-select form-select-sm me-2 fw-semibold"
                                                style="width: auto; max-width: 220px; background-color: #eaf2ff; border: 1px solid #4a90e2; color: #1a56b0;">
                                            <option value="">All Job Positions</option>
                                            @foreach($jobPostings as $jobPosting)
                                                <option value="{{ $jobPosting->id }}" {{ (string) request('job_posting_id') === (string) $jobPosting->id ? 'selected' : '' }}>{{ $jobPosting->title }}</option>
                                            @endforeach
                                        </select>
                                        <span class="spinner-border spinner-border-sm text-primary d-none align-self-center" id="applicationsFilterSpinner" role="status"></span>
                                    </form>
                                    <a href="#" id="downloadAllCvsBtn"
                                       data-endpoint="{{ route('admin.job-applications.download-all-cv') }}"
                                       data-search="{{ request('search') }}"
                                       data-status="{{ request('status') }}"
                                       data-job-posting-id="{{ request('job_posting_id') }}"
                                       class="btn btn-sm text-white fw-semibold"
                                       style="background: linear-gradient(135deg, #ff6a00, #ee0979); border: none; box-shadow: 0 2px 6px rgba(238, 9, 121, 0.35);"
                                       title="Download a ZIP of every CV matching the current filter">
                                        <i class="fas fa-file-archive"></i> Download All CVs (ZIP)
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="applicationsTableWrapper">
                            @include('admin.job-applications._table')
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
    const searchInput = document.getElementById('applicationsSearchInput');
    const statusSelect = document.getElementById('applicationsStatusSelect');
    const jobPostingSelect = document.getElementById('applicationsJobPostingSelect');
    const tableWrapper = document.getElementById('applicationsTableWrapper');
    const countHeading = document.getElementById('applicationsCountHeading');
    const spinner = document.getElementById('applicationsFilterSpinner');
    const downloadAllBtn = document.getElementById('downloadAllCvsBtn');
    const indexUrl = @json(route('admin.job-applications.index'));

    let debounceTimer = null;
    let activeRequest = null;

    function runFilter() {
        const params = new URLSearchParams();
        if (searchInput.value.trim() !== '') params.set('search', searchInput.value.trim());
        if (statusSelect.value !== '') params.set('status', statusSelect.value);
        if (jobPostingSelect.value !== '') params.set('job_posting_id', jobPostingSelect.value);

        // Keep the browser URL/back-button and a page refresh in sync with the current filter.
        const newUrl = params.toString() ? (indexUrl + '?' + params.toString()) : indexUrl;
        window.history.replaceState(null, '', newUrl);

        // Keep "Download All CVs" scoped to whatever is currently filtered.
        downloadAllBtn.dataset.search = searchInput.value.trim();
        downloadAllBtn.dataset.status = statusSelect.value;
        downloadAllBtn.dataset.jobPostingId = jobPostingSelect.value;

        if (activeRequest) activeRequest.abort();
        activeRequest = new AbortController();

        spinner.classList.remove('d-none');

        fetch(indexUrl + '?' + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            signal: activeRequest.signal,
        })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                tableWrapper.innerHTML = data.table_html;
                countHeading.textContent = 'All Applications (' + data.total + ')';
            })
            .catch(function (err) {
                if (err.name !== 'AbortError') {
                    console.error('Filter request failed', err);
                }
            })
            .finally(function () {
                spinner.classList.add('d-none');
            });
    }

    // Live search: re-filter automatically a moment after the admin stops typing —
    // no "Filter" button to click, and clearing the box brings everything back.
    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(runFilter, 400);
    });

    statusSelect.addEventListener('change', function () {
        clearTimeout(debounceTimer);
        runFilter();
    });

    jobPostingSelect.addEventListener('change', function () {
        clearTimeout(debounceTimer);
        runFilter();
    });

    const btn = downloadAllBtn;
    if (!btn) return;

    // A ZIP is just a normal file download — navigate straight to the endpoint with the
    // current filter as query params, no fetch()/blob buffering needed.
    btn.addEventListener('click', function (event) {
        event.preventDefault();

        const params = new URLSearchParams();
        if (btn.dataset.search) params.set('search', btn.dataset.search);
        if (btn.dataset.status) params.set('status', btn.dataset.status);
        if (btn.dataset.jobPostingId) params.set('job_posting_id', btn.dataset.jobPostingId);

        const query = params.toString();
        window.location.href = btn.dataset.endpoint + (query ? '?' + query : '');
    });
});
</script>
@endpush
