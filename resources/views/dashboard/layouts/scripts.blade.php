<script src="{{ asset('dashboard') }}/assets/vendor/libs/jquery/jquery.js"></script>

<script src="{{ asset('dashboard') }}/assets/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/js/bootstrap.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/node-waves/node-waves.js"></script>

<script src="{{ asset('dashboard') }}/assets/vendor/libs/@algolia/autocomplete-js.js"></script>

<script src="{{ asset('dashboard') }}/assets/vendor/libs/pickr/pickr.js"></script>

<script src="{{ asset('dashboard') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="{{ asset('dashboard') }}/assets/vendor/libs/hammer/hammer.js"></script>

<script src="{{ asset('dashboard') }}/assets/vendor/libs/i18n/i18n.js"></script>

<script src="{{ asset('dashboard') }}/assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('dashboard') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/swiper/swiper.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

<!-- Main JS -->

<script src="{{ asset('dashboard') }}/assets/js/main.js"></script>

<!-- Page JS -->
<script src="{{ asset('dashboard') }}/assets/js/dashboards-analytics.js"></script>


@stack('js')

<script>
    // حل بديل أكثر موثوقية
    function disableButton() {
        const submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ';

        // إرسال النموذج تلقائيًا بعد تعطيل الزر
        document.getElementById('storeForm').submit();
    }

    // أو يمكنك استخدام هذا الحدث
    document.getElementById('storeForm').addEventListener('submit', function() {
        const submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ';
    });
</script>
<script>
    // حل بديل أكثر موثوقية
    function disableButton() {
        const submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التعديل';

        // إرسال النموذج تلقائيًا بعد تعطيل الزر
        document.getElementById('editForm').submit();
    }

    // أو يمكنك استخدام هذا الحدث
    document.getElementById('editForm').addEventListener('submit', function() {
        const submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التعديل';
    });
</script>
