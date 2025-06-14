  <!-- jQuery -->
  <script src="{{ asset('dashboard') }}/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('dashboard') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dashboard') }}/assets/dist/js/adminlte.min.js"></script>

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
