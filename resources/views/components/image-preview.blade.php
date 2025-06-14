<div class="box box-primary col-md-6">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <div class="box-body">
        <input type="file" id="imageInput" name="{{ $name }}" />

        <img id="imagePreview" style="max-width: 200px; display: none;" />

    </div>
</div>
@push('css')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
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
