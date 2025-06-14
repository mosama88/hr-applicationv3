  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
  </script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="{{ asset('dashboard') }}/assets/dist/js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script src="{{ asset('dashboard') }}/assets/dist/js/fontawesome.min.js"></script>

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
