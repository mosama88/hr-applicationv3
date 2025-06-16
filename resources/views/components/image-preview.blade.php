<div class="box box-primary col-md-6">
    <div class="box-header with-border">
        <h5 class="box-title">{{ $title }}</h5>
    </div>
    <div class="box-body">
        <input type="file" id="imageInput" name="{{ $name }}" />

        <img id="imagePreview" style="width: 400px;  display: none;" />

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
            // تسجيل الملحقات
            FilePond.registerPlugin(
                FilePondPluginImagePreview
            );

            // إنشاء مثيل FilePond
            const pond = FilePond.create(document.querySelector('#imageInput'), {
                allowImagePreview: true,
                imagePreviewHeight: 400, // تحديد ارتفاع معاينة الصورة
                imagePreviewMaxHeight: 400, // أقصى ارتفاع للمعاينة
                imageCropAspectRatio: '1:1', // نسبة القص (اختياري)
                stylePanelAspectRatio: 1, // نسبة العرض إلى الارتفاع
                maxFiles: 1, // الحد الأقصى لعدد الملفات
                acceptedFileTypes: ['image/*'],
                storeAsFile: true,
                labelIdle: 'اسحب وأسقط الصورة أو <span class="filepond--label-action">تصفح</span>',
                labelInvalidField: 'الحقل يحتوي على ملفات غير صالحة',
                labelFileWaitingForSize: 'جاري حساب الحجم',
                labelFileSizeNotAvailable: 'الحجم غير متاح',
                labelFileLoading: 'جاري التحميل',
                labelFileLoadError: 'خطأ أثناء التحميل',
                labelFileProcessing: 'جاري الرفع',
                labelFileProcessingComplete: 'تم الرفع بنجاح',
                labelFileProcessingAborted: 'تم إلغاء الرفع',
                labelFileProcessingError: 'خطأ أثناء الرفع',
                labelFileProcessingRevertError: 'خطأ أثناء الاسترجاع',
                labelFileRemoveError: 'خطأ أثناء الحذف',
                labelTapToCancel: 'انقر للإلغاء',
                labelTapToRetry: 'انقر لإعادة المحاولة',
                labelTapToUndo: 'انقر للتراجع',
                labelButtonRemoveItem: 'حذف',
                labelButtonAbortItemLoad: 'إلغاء',
                labelButtonRetryItemLoad: 'إعادة المحاولة',
                labelButtonAbortItemProcessing: 'إلغاء',
                labelButtonUndoItemProcessing: 'تراجع',
                labelButtonRetryItemProcessing: 'إعادة المعالجة',
                labelButtonProcessItem: 'رفع'
            });

            // إذا كانت هناك صورة موجودة مسبقاً
            @if (isset($value) && $value)
                pond.addFile("{{ asset($value) }}").then(file => {
                    console.log('تم تحميل الصورة بنجاح');
                });
            @endif

            // لمعالجة الأخطاء
            pond.on('error', (error) => {
                console.error('حدث خطأ:', error);
            });
        });
    </script>


    {{-- <script>
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
    </script> --}}
@endpush
