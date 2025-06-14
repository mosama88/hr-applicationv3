<!-- jQuery -->
<script src="{{ asset('dashboard') }}/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('dashboard') }}/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dashboard') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('dashboard') }}/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('dashboard') }}/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('dashboard') }}/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('dashboard') }}/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('dashboard') }}/assets/plugins/moment/moment.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('dashboard') }}/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>
<!-- Summernote -->
<script src="{{ asset('dashboard') }}/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('dashboard') }}/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard') }}/assets/dist/js/adminlte.js"></script>
<script src="{{ asset('dashboard') }}/dist/js/demo.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dashboard') }}/assets/dist/js/pages/dashboard.js"></script>


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
