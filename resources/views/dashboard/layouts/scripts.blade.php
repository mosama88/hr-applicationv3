  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="{{ asset('dashboard') }}/assets/dist/js/overlayscrollbars.browser.es6.min.js"></script>

  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="{{ asset('dashboard') }}/assets/dist/js/popper.min.js"></script>

  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="{{ asset('dashboard') }}/assets/dist/js/bootstrap.min.js"></script>

  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="{{ asset('dashboard') }}/assets/dist/js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script src="{{ asset('dashboard') }}/assets/dist/js/fontawesome.min.js"></script>

  <!-- Toastr -->
  {{-- <script src="{{ asset('dashboard') }}/assets/dist/toastr/toastr.min.js"></script> --}}

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



  <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
          scrollbarTheme: 'os-theme-light',
          scrollbarAutoHide: 'leave',
          scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function() {
          const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
          if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
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
