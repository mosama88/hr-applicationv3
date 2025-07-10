<!-- Modal -->
<div class="modal fade" id="importExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">إستيراد ملف {{ $title }} لشهر
                    {{ $financeClnPeriod }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.' . $url . '.import') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="alert alert-info" style="direction: rtl; text-align: right;">
                        <strong>تعليمات هامة قبل رفع الملف:</strong>
                        <ul>
                            <li>📄 يجب أن يكون الملف Excel بصيغة: <code>.xlsx</code> أو <code>.xls</code> أو
                                <code>.csv</code>.
                            </li>
                            <li>✅ تأكد من أن الأعمدة مرتبة كما يلي: <code>{{ $columns }}</code>.</li>
                            <li>📌 يجب أن تبدأ البيانات من الصف الأول.</li>
                            <li>⚠️ لا تترك خانات فارغة في الصفوف.</li>
                            <li>🔄 تأكد من أن الملف لا يحتوي على رموز أو أحرف خاصة غير مقبولة.</li>
                        </ul>
                    </div> <input type="file" name="file" class="form-control mb-2" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="سعلاةهف" class="btn btn-primary">استيراد الملف</button>
            </div>
            </form>

        </div>
    </div>
</div>
