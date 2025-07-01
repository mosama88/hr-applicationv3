@php
    use App\Models\MainSalaryEmployee;
    use App\Enums\Salaries\SanctionTypeEnum;
@endphp
@push('css')
@endpush

<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">
            <p class="">
                يمكنك استخدام الفلاتر التالية للبحث عن الموظفين حسب كود الموظف أو اسم
                الموظف أو نوع الجزاء.......
            </p>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <a class="btn btn-success float-right mx-2"
            href="{{ route('dashboard.sanctions.export', $financeClnPeriod->slug) }}">
            <i class="fas fa-arrow-alt-circle-down ml-2"></i> تحميل اكسيل شيت
        </a>

        <form action="{{ route('dashboard.sanctions.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control mb-2" required>
            <button class="btn btn-primary">استيراد ملف</button>
        </form>
        <form action="{{ route('dashboard.sanctions.show', $financeClnPeriod->slug) }}" method="GET">
            <div class="row">

                <!-- كود الموظف -->
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="employee_code-input">كود
                        الموظف</label>
                    <input type="text" class="form-control" name="employee_code_search"
                        value="{{ request('employee_code_search') }}" id="employee_code-input"
                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');" placeholder="مثال:1000" />
                </div>

                <!--  أسم الموظف  -->
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="name-input">أسم الموظف</label>
                    <input type="text" class="form-control" name="name" value="{{ request('name') }}"
                        id="name-input" placeholder="مثال:احمد" />
                </div>


                <!-- نوع الجزاء -->
                <div class="col-md-3 mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">
                        نوع الجزاء</label>
                    <select class="form-select" name="sanction_types" aria-label="Default select example">
                        <option selected value="">-- أختر النوع--</option>
                        @foreach (SanctionTypeEnum::cases() as $sanction)
                            <option value="{{ $sanction->value }}" @if (request('sanction_types') == $sanction->value) selected @endif>
                                {{ $sanction->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- عدد أيام الجزاء -->
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="value-input">
                        عدد أيام الجزاء</label>
                    <input type="text" name="days_sanctions" class="form-control"
                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="{{ request('days_sanctions') }}"
                        id="value-input">
                </div>
            </div>
            @include('dashboard.partials.filter-actions')
        </form>
    </div>
    <!-- /.card-body -->
</div>
@push('js')
@endpush
