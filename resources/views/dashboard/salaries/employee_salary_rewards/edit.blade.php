@php
    use App\Enums\Salaries\absenceTypeEnum;
    use App\Models\MainSalaryEmployee;
@endphp
@extends('dashboard.layouts.master')
@section('active-rewards', 'active')
@section('title', 'تعديل خصم الموظف')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2-style.css" />
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'تعديل خصم  للموظف ',
        'previousPage' => 'جدول الخصومات',
        'currentPage' => 'تعديل خصم  للموظف ',
        'url' => 'rewards.index',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->
                        <form action="{{ route('dashboard.rewards.update', $employeeSalaryReward->slug) }}" method="POST"
                            id="storeForm">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="row">
                                    <!-- الشهر المالى -->
                                    <div class="form-group mb-3 col-md-3" style="display: none">
                                        <label for="exampleInputname">الشهر المالى</label>
                                        <input readonly type="text" name="finance_cln_period_id"
                                            class="form-control bg-white @error('finance_cln_period_id') is-invalid @enderror"
                                            value="{{ old('finance_cln_period_id', $employeeSalaryReward->finance_cln_period_id) }}"
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
                                            <option
                                                value="{{ old('main_salary_employee_id', $employeeSalaryReward->main_salary_employee_id ?? '') }}"
                                                selected>
                                                {{ MainSalaryEmployee::find(old('main_salary_employee_id', $employeeSalaryReward->main_salary_employee_id))->employee_name }}
                                            </option>
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
                                            value="{{ old('day_price', $employeeSalaryReward->day_price) * 1 }}"
                                            id="day_price-input">
                                        @error('day_price')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!--  كود الوظف -->
                                    <div class="col-md-3 mb-3" style="display: none">
                                        <label class="form-label" for="employee_code-input">
                                            كود الموظف</label>
                                        <input readonly type="text" name="employee_code"
                                            class="form-control bg-white @error('employee_code') is-invalid @enderror"
                                            value="{{ old('employee_code', $employeeSalaryReward->employee_code) }}"
                                            id="employee_code-input">
                                        @error('employee_code')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- نوع الخصم -->
                                    <div class="col-md-3">
                                        <label class="form-label" for="formtabs-country">نوع المكافأه</label>
                                        <select
                                            class="select2 form-select @error('additional_type_id') is-invalid @enderror"
                                            name="additional_type_id" data-allow-clear="true">
                                            <option selected value="">-- أختر المكافأه --</option>
                                            @foreach ($other['additional_types'] as $additionalType)
                                                <option @if (old('additional_type_id', $employeeSalaryReward->additional_type_id) == $additionalType->id) selected @endif
                                                    value="{{ $additionalType->id }}">
                                                    {{ $additionalType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('additional_type_id')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- قيمة المكافأه -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="total-input">
                                            أجمالى قيمة المكافأه</label>
                                        <input type="text" name="total"
                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                            class="form-control @error('total') is-invalid @enderror"
                                            value="{{ old('total', $employeeSalaryReward->total) }}" id="total-input">
                                        @error('total')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!--  ملاحظات -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label" for="notes-input">
                                            ملاحظات</label>
                                        <input type="text" name="notes"
                                            class="form-control bg-white @error('notes') is-invalid @enderror"
                                            value="{{ old('notes', $employeeSalaryReward->notes) }}" id="notes-input">
                                        @error('notes')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <!-- /.card-body -->

                            <x-edit-button-component></x-edit-button-component>

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
            $('.select2').select2();
        });
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

            // حساب القيمة الإجمالية للخصم  عند تغيير عدد الأيام
            $('input[name="value"]').on('input', function() {
                let days = parseFloat($(this).val()) || 0;
                let dayPrice = parseFloat($('input[name="day_price"]').val()) || 0;
                let total = days * dayPrice;
                $('input[name="total"]').val(total.toFixed(2));
            });
        });
    </script>
@endpush
