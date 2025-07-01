@php
    use App\Models\MainSalaryEmployee;
    use App\Enums\Salaries\SanctionTypeEnum;
@endphp
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2-style.css" />
@endpush

<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">
            <p class="">
                يمكنك استخدام الفلاتر التالية للبحث عن الموظفين حسب كود البصمة أو كود الموظف أو اسم
                الموظف أو نوع الجزاء.......
            </p>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form action="{{ route('dashboard.sanctions.show', $financeClnPeriod->slug) }}" method="GET">
            <div class="row">
                <!--  أسم الموظف  -->
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="main_salary_employee_id-input">
                        أسم الموظف</label>
                    <select name="name" id="main_salary_employee_id-input"
                        class="select2 form-select main_salary_employee_id_select2" data-allow-clear="true">
                        @if (request('name'))
                            <option value="{{ request('name') }}" selected>
                                {{ MainSalaryEmployee::find(request('name'))?->employee_name }}
                            </option>
                        @endif
                    </select>
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
    <script src="{{ asset('dashboard') }}/assets/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // job_category_select2
            $('.main_salary_employee_id_select2').select2({
                placeholder: '-- أختر الموظف --',
                ajax: {
                    url: "{{ route('dashboard.sanctions.search_employee') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(employees => ({
                                id: employees.id,
                                text: `${employees.employee_name} ➜ (${employees.employee_code})`
                            }))
                        };
                    }
                }
            });
        });
    </script>
@endpush
