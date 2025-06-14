@push('js')
    <script>
        $(document).ready(function() {
            // إعدادات toastr
            toastr.options = {
                "closeButton": false, // <--- لا تظهر علامة الإغلاق
                "progressBar": true,
                "positionClass": "toast-top-left", // الزاوية العلوية اليسرى
                "timeOut": "5000",
                "extendedTimeOut": "1000",
            };

            @if ($errors->has('error')) toastr.error('{{ $errors->first('error') }}'); @endif

            @if (session('success')) toastr.success('{{ session('success') }}'); @endif
        });
    </script>
@endpush
