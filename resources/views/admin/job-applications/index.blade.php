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
                                        <select name="status" id="applicationsStatusSelect" class="form-control form-control-sm me-2">
                                            <option value="">All Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        </select>
                                        <span class="spinner-border spinner-border-sm text-primary d-none align-self-center" id="applicationsFilterSpinner" role="status"></span>
                                    </form>
                                    <button type="button" id="downloadAllCvsBtn"
                                            data-endpoint="{{ route('admin.job-applications.download-all-cv') }}"
                                            data-search="{{ request('search') }}"
                                            data-status="{{ request('status') }}"
                                            class="btn btn-success btn-sm" title="Download every CV matching the current filter, one file at a time">
                                        <i class="fas fa-download"></i> Download All CVs
                                    </button>
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

        // Keep the browser URL/back-button and a page refresh in sync with the current filter.
        const newUrl = params.toString() ? (indexUrl + '?' + params.toString()) : indexUrl;
        window.history.replaceState(null, '', newUrl);

        // Keep "Download All CVs" scoped to whatever is currently filtered.
        downloadAllBtn.dataset.search = searchInput.value.trim();
        downloadAllBtn.dataset.status = statusSelect.value;

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

    const btn = downloadAllBtn;
    if (!btn) return;

    btn.addEventListener('click', function () {
        const params = new URLSearchParams();
        if (btn.dataset.search) params.set('search', btn.dataset.search);
        if (btn.dataset.status) params.set('status', btn.dataset.status);

        const originalHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Preparing…';

        fetch(btn.dataset.endpoint + '?' + params.toString(), {
            headers: { 'Accept': 'application/json' },
        })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                const applications = data.applications || [];
                if (applications.length === 0) {
                    alert('No applications with a CV match the current filter.');
                    return;
                }

                // Trigger one download at a time via a hidden iframe, spaced out slightly
                // so the browser doesn't treat the burst as a popup/spam and drop some of them.
                applications.forEach(function (application, index) {
                    setTimeout(function () {
                        const iframe = document.createElement('iframe');
                        iframe.style.display = 'none';
                        iframe.src = application.download_url;
                        document.body.appendChild(iframe);
                        setTimeout(function () { iframe.remove(); }, 10000);
                    }, index * 600);
                });

                setTimeout(function () {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }, applications.length * 600 + 500);
            })
            .catch(function () {
                alert('Could not fetch the CV list. Please try again.');
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            });
    });
});
</script>
@endpush
