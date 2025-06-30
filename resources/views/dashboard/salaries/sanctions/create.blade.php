@php
    use App\Enums\Salaries\SanctionTypeEnum;
    use App\Models\MainSalaryEmployee;
@endphp
@extends('dashboard.layouts.master')
@section('active-sanctions', 'active')
@section('title', 'انشاء جزاء للموظف')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2-style.css" />
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'انشاء جزاء للموظف ',
        'previousPage' => 'جدول الجزاءات',
        'currentPage' => 'انشاء جزاء للموظف ',
        'url' => 'sanctions.show',
        'url2' => $financeClnPeriod->slug,
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->

                        <form action="{{ route('dashboard.sanctions.store', $financeClnPeriod->id) }}" method="POST"
                            id="storeForm">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <!-- الشهر المالى -->
                                    <div class="form-group mb-3 col-md-3" style="display: none">
                                        <label for="exampleInputname">الشهر المالى</label>
                                        <input readonly type="text" name="finance_cln_period_id"
                                            class="form-control bg-white @error('finance_cln_period_id') is-invalid @enderror"
                                            value="{{ old('finance_cln_period_id', $financeClnPeriod->year_and_month) }}"
                                            id="exampleInputname">
                                        @error('finance_cln_period_id')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--  أسم الموظف  -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="main_salary_employee_id-input">
                                            أسم الموظف</label>
                                        <select name="main_salary_employee_id" id="main_salary_employee_id-input"
                                            class="select2 form-select employee_select2 @error('main_salary_employee_id') is-invalid @enderror"
                                            data-allow-clear="true">
                                            @if (old('main_salary_employee_id'))
                                                <option value="{{ old('main_salary_employee_id') }}" selected>
                                                    {{ MainSalaryEmployee::find(old('main_salary_employee_id'))?->name }}
                                                </option>
                                            @endif
                                        </select>
                                        @error('main_salary_employee_id')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!--  أجر اليوم الواحد -->
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label" for="day_price-input">
                                            أجر اليوم الواحد</label>
                                        <input readonly type="text" name="day_price"
                                            class="form-control bg-white @error('day_price') is-invalid @enderror"
                                            value="{{ old('day_price') }}" id="day_price-input">
                                        @error('day_price')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!--  كود الوظف -->
                                    <div class="col-md-2 mb-3" style="display: none">
                                        <label class="form-label" for="employee_code-input">
                                            كود الموظف</label>
                                        <input readonly type="text" name="employee_code"
                                            class="form-control bg-white @error('employee_code') is-invalid @enderror"
                                            value="{{ old('employee_code') }}" id="employee_code-input">
                                        @error('employee_code')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- نوع الجزاء -->
                                    <div class="col-md-3 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">
                                            نوع الجزاء</label>
                                        <select class="form-select @error('sanctions_type') is-invalid @enderror"
                                            name="sanctions_type" aria-label="Default select example">
                                            <option selected value="">-- أختر النوع--</option>
                                            @foreach (SanctionTypeEnum::cases() as $sanction)
                                                <option value="{{ $sanction->value }}"
                                                    @if (old('sanctions_type') == $sanction->value) selected @endif>
                                                    {{ $sanction->label() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sanctions_type')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <!-- عدد أيام الجزاء -->
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label" for="value-input">
                                            عدد أيام الجزاء</label>
                                        <input type="text" name="value"
                                            class="form-control @error('value') is-invalid @enderror"
                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                            value="{{ old('value') }}" id="value-input">
                                        @error('value')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- قيمة الجزاء -->
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label" for="total-input">
                                            قيمة الجزاء</label>
                                        <input readonly type="text" name="total"
                                            class="form-control bg-white @error('total') is-invalid @enderror"
                                            value="{{ old('total') }}" id="total-input">
                                        @error('total')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!--  ملاحظات -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label" for="notes-input">
                                            ملاحظات</label>
                                        <input type="text" name="notes"
                                            class="form-control bg-white @error('notes') is-invalid @enderror"
                                            value="{{ old('notes') }}" id="notes-input">
                                        @error('notes')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <!-- /.card-body -->

                            <x-create-button-component></x-create-button-component>

                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
    <script src="{{ asset('dashboard') }}/assets/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // job_category_select2
            $('.employee_select2').select2({
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
    <script>
        $(document).ready(function() {
            $('#main_salary_employee_id-input').on('change', function() {
                var employeeId = $(this).val();
                if (employeeId) {
                    $.ajax({
                        url: '/api/get-day-price/' + employeeId,
                        method: 'GET',
                        success: function(response) {
                            if (response.status) {
                                let dayPrice = Math.round(response.day_price);
                                $('input[name="day_price"]').val(dayPrice);
                                $('input[name="employee_code"]').val(response
                                    .employee_code); // التصحيح هنا
                            } else {
                                $('input[name="day_price"]').val('');
                                $('input[name="employee_code"]').val('');
                            }
                        },
                        error: function() {
                            $('input[name="day_price"]').val('');
                            $('input[name="employee_code"]').val('');
                        }
                    });
                } else {
                    $('input[name="day_price"]').val('');
                    $('input[name="employee_code"]').val('');
                }
            });

            // حساب القيمة الإجمالية للجزاء عند تغيير عدد الأيام
            $('input[name="value"]').on('input', function() {
                let days = parseFloat($(this).val()) || 0;
                let dayPrice = parseFloat($('input[name="day_price"]').val()) || 0;
                let total = days * dayPrice;
                $('input[name="total"]').val(total.toFixed(2));
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // عند تغيير عدد أيام الجزاء
            $('#value-input').on('input', function() {
                calculateTotal();
            });

            // لو تغير أجر اليوم أيضًا من أي عملية (مثلاً تغيير الموظف)
            $('#day_price-input').on('input', function() {
                calculateTotal();
            });

            function calculateTotal() {
                var days = parseInt($('#value-input').val()) || 0;
                var dayPrice = parseInt($('#day_price-input').val()) || 0;
                var total = days * dayPrice;
                $('#total-input').val(total);
            }
        });
    </script>
@endpush
