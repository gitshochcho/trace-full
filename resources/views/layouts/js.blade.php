<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/adminlte.js')}}"></script>

<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>



<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':

                toastr.options.timeOut = 5000;
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':

                toastr.options.timeOut = 5000;
                toastr.success("{{ Session::get('message') }}");

                break;
            case 'warning':

                toastr.options.timeOut = 5000;
                toastr.warning("{{ Session::get('message') }}");

                break;
            case 'error':

                toastr.options.timeOut = 5000;
                toastr.error("{{ Session::get('message') }}");

                break;
        }
    @endif
</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Open the modal and set the delete URL
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const deleteUrl = this.getAttribute('data-url');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.setAttribute('action', deleteUrl);
        });
    });
});
</script>

<script>
/* ── Global image / file size & dimension validator (hard block) ── */
(function () {
    const state = new WeakMap(); // input → { ok: bool|null }

    function fmtMB(bytes) { return (bytes / 1048576).toFixed(1) + ' MB'; }

    function getBox(input) {
        let el = input.nextElementSibling;
        while (el) {
            if (el.classList && el.classList.contains('upload-size-warn')) return el;
            el = el.nextElementSibling;
        }
        const d = document.createElement('div');
        d.className = 'upload-size-warn';
        input.insertAdjacentElement('afterend', d);
        return d;
    }

    function setOk(input) {
        state.set(input, { ok: true });
        getBox(input).innerHTML = '';
        input.classList.remove('is-invalid');
    }

    function setError(input, msg) {
        state.set(input, { ok: false });
        input.classList.add('is-invalid');
        getBox(input).innerHTML =
            '<div class="alert alert-danger py-1 px-2 mt-1 mb-0 small">'
            + '<i class="fas fa-times-circle me-1"></i>'
            + '<strong>Upload blocked.</strong> ' + msg
            + ' <em>It may break your design.</em></div>';
    }

    function check(input) {
        const maxKB = parseInt(input.dataset.maxSize  || '0');
        const maxW  = parseInt(input.dataset.maxWidth  || '0');
        const maxH  = parseInt(input.dataset.maxHeight || '0');
        if (!maxKB && !maxW && !maxH) return;

        if (!input.files || !input.files.length) { setOk(input); return; }

        state.set(input, { ok: null }); // pending

        const files = Array.from(input.files);
        let pending = 0;
        const errors = [];

        files.forEach(function (file) {
            if (maxKB && file.size > maxKB * 1024) {
                errors.push('File is ' + fmtMB(file.size) + ' — max allowed is ' + (maxKB / 1024).toFixed(0) + ' MB.');
            }

            if (file.type.startsWith('image/') && (maxW || maxH)) {
                pending++;
                const url = URL.createObjectURL(file);
                const img = new Image();
                img.onload = function () {
                    URL.revokeObjectURL(url);
                    const parts = [];
                    if (maxW && img.naturalWidth  > maxW) parts.push('width '  + img.naturalWidth  + 'px (max ' + maxW  + 'px)');
                    if (maxH && img.naturalHeight > maxH) parts.push('height ' + img.naturalHeight + 'px (max ' + maxH + 'px)');
                    if (parts.length) errors.push('Image dimensions too large — ' + parts.join(', ') + '.');
                    if (--pending === 0) finish();
                };
                img.src = url;
            }
        });

        if (pending === 0) finish();

        function finish() {
            if (errors.length) setError(input, errors.join(' '));
            else setOk(input);
        }
    }

    // Validate on file select
    document.addEventListener('change', function (e) {
        const t = e.target;
        if (t.tagName === 'INPUT' && t.type === 'file'
            && (t.dataset.maxSize || t.dataset.maxWidth || t.dataset.maxHeight)) {
            check(t);
        }
    });

    // Block form submit if any input failed
    document.addEventListener('submit', function (e) {
        const inputs = e.target.querySelectorAll('input[type="file"][data-max-size], input[type="file"][data-max-width], input[type="file"][data-max-height]');
        let blocked = false;
        inputs.forEach(function (inp) {
            const s = state.get(inp);
            if (s && s.ok === false) blocked = true;
        });
        if (blocked) {
            e.preventDefault();
            if (typeof toastr !== 'undefined') {
                toastr.error('File upload error — please fix the highlighted fields before saving.');
            }
            // Scroll to first error
            const first = e.target.querySelector('.is-invalid');
            if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }, true); // capture phase so it runs before other submit handlers
})();
</script>
