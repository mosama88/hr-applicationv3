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
<script src="{{ asset('dashboard') }}/assets/vendor/libs/@form-validation/popular.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/libs/@form-validation/auto-focus.js"></script>

<!-- Main JS -->

<script src="{{ asset('dashboard') }}/assets/js/main.js"></script>

<!-- Page JS -->
<script src="{{ asset('dashboard') }}/assets/js/pages-auth.js"></script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;
        submitButton.innerHTML = 'جاري تسجيل الدخول...'; // Optional: Change text while submitting
    });
</script>
