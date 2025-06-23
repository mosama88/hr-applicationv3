<!-- Modal -->
<div class="modal fade" id="open-month{{ $financeClnPeriod->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.main_salary_records.open-month', $financeClnPeriod->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <div class="row">
                            <!-- تاريخ بداية البصمة -->
                            <div class="col-md-6">
                                <label for="start_date_fp" class="form-label">تاريخ بداية البصمة</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary"
                                        style="background-color: #2C6391 !important; border-color: #2C6391;">
                                        <i class="far fa-calendar-alt text-white"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control date-input date-picker @error('start_date_fp') is-invalid @enderror"
                                        name="start_date_fp" id="start_date_fp-input" placeholder="يوم / شهر / سنة"
                                        value="{{ old('start_date_fp') }}">
                                    <button type="button" class="btn btn-outline-secondary clear-date-btn"
                                        data-target="#start_date_fp-input">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @error('start_date_fp')
                                    <div class="invalid-feedback text-right d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <!-- تاريخ نهاية البصمة -->
                            <div class="col-md-6">
                                <label for="end_date_fp" class="form-label">تاريخ نهاية البصمة</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary"
                                        style="background-color: #2C6391 !important; border-color: #2C6391;">
                                        <i class="far fa-calendar-alt text-white"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control date-input date-picker @error('end_date_fp') is-invalid @enderror"
                                        name="end_date_fp" id="end_date_fp-input" placeholder="يوم / شهر / سنة"
                                        value="{{ old('end_date_fp') }}">
                                    <button type="button" class="btn btn-outline-secondary clear-date-btn"
                                        data-target="#end_date_fp-input">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @error('end_date_fp')
                                    <div class="invalid-feedback text-right d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-primary">تأكيد البيانات</button>
            </div>
            </form>
        </div>
    </div>
</div>
