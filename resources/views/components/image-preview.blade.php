<div class="box box-primary col-md-6">
    <div class="box-header with-border">
        <h5 class="box-title">{{ $title }}</h5>
    </div>
    <div class="box-body">
        <input type="file" id="imageInput" name="{{ $name }}" />

        <img id="imagePreview" style="max-width: 200px; display: none;" />

    </div>
</div>
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/filepond.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/filepond-plugin-image-preview.css" />
@endpush
@push('js')
    <script src="{{ asset('dashboard') }}/assets/dist/js/filepond.js"></script>
    <script src="{{ asset('dashboard') }}/assets/dist/js/filepond-plugin-image-preview.js"></script>
    <script src="{{ asset('dashboard') }}/assets/dist/js/filepond-plugin-file-validate-type.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            FilePond.registerPlugin(FilePondPluginImagePreview);
            const pond = FilePond.create(document.querySelector('#imageInput'), {
                allowImagePreview: true,
                imagePreviewMaxHeight: 200,
                storeAsFile: true,
                allowMultiple: true,
                acceptedFileTypes: ['image/*'],
            });

            @if ($value)
                pond.addFile("{{ $value }}");
            @endif
        });
    </script>
@endpush
