@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            @if ($errors->has('error'))
                toastr.error('{{ $errors->first('error') }}');
            @endif

            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush
