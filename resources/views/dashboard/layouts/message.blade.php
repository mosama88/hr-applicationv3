@push('css')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/toastr/toastr.min.css">
    <style>
        /* تخصيص Toastr */
        .toast-success {
            background-color: #28a745 !important;
            /* أخضر */
            color: white !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
            /* أحمر */
            color: white !important;
        }

        .toast-info {
            background-color: #17a2b8 !important;
            /* أزرق */
            color: white !important;
        }

        .toast-warning {
            background-color: #ffc107 !important;
            /* أصفر */
            color: #212529 !important;
            /* نص داكن للأصفر */
        }

        /* تحسين شكل الزر والإطارات */
        .toast-close-button {
            color: white !important;
            opacity: 0.8 !important;
        }

        .toast {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            border-radius: 4px !important;
        }
    </style>
@endpush
@push('js')
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // تهيئة Toastr
            toastr.options = {
                "closeButton": true, // زر الإغلاق
                "debug": false,
                "newestOnTop": true, // الرسائل الجديدة تظهر بالأعلى
                "progressBar": true, // شريط التقدم
                "positionClass": "toast-top-right", // الموضع
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "1000", // مدة الظهور
                "hideDuration": "3000", // مدة الاختفاء
                "timeOut": "5000", // الوقت قبل الاختفاء التلقائي
                "extendedTimeOut": "1000", // وقت إضافي عند التمرير
                "showEasing": "swing", // تأثير الظهور
                "hideEasing": "linear", // تأثير الاختفاء
                "showMethod": "fadeIn", // طريقة الظهور
                "hideMethod": "fadeOut" // طريقة الاختفاء
            };

            //    @if (session('toast_error'))
            //         toastr.error('{{ session('toast_error') }}', 'خطأ');
            //     @endif

            @if ($errors->has('error'))
                toastr.error('{{ $errors->first('error') }}', 'خطأ!');
            @elseif (session('success'))
                toastr.success('{{ session('success') }}', 'نجاح');
            @endif
        });
    </script>
@endpush
