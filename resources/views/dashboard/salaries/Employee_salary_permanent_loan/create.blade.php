@php
    use App\Enums\Salaries\SanctionTypeEnum;
    use App\Models\MainSalaryEmployee;
@endphp
@extends('dashboard.layouts.master')
@section('active-permanent_loan', 'active')
@section('title', 'انشاء سلفه مستديمة للموظف')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2-style.css" />
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'انشاء سلفه مستديمة للموظف ',
        'previousPage' => 'جدول السلف المستديمة',
        'currentPage' => 'انشاء سلفه مستديمة للموظف ',
        'url' => 'permanent_loan.index',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->

                        <form action="{{ route('dashboard.permanent_loan.store') }}" method="POST" id="storeForm">
                            @csrf
                            <div class="card-body">
                                <div class="row">

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

                                    <!--  مرتب الموظف -->
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label" for="employee_salary-input">
                                            مرتب الموظف</label>
                                        <input readonly type="text" name="employee_salary"
                                            class="form-control bg-white @error('employee_salary') is-invalid @enderror"
                                            value="{{ old('employee_salary') }}" id="employee_salary-input">
                                        @error('employee_salary')
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


                                    <!-- قيمة السلفه مستديمة -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="total-input">
                                            أجمالى قيمة السلفه مستديمة</label>
                                        <input type="text" name="total"
                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                            class="form-control @error('total') is-invalid @enderror"
                                            value="{{ old('total') }}" id="total-input">
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
                        url: '/api/get-day-price/permanent_loan/' + employeeId,
                        method: 'GET',
                        success: function(response) {
                            if (response.status) {
                                let dayPrice = Math.round(response.day_price);
                                $('input[name="day_price"]').val(dayPrice);
                                $('input[name="employee_code"]').val(response.employee_code);
                                $('input[name="employee_salary"]').val(response
                                .employee_salary);
                            } else {
                                $('input[name="day_price"]').val('');
                                $('input[name="employee_salary"]').val('');
                                $('input[name="employee_code"]').val('');
                            }
                        },
                        error: function() {
                            $('input[name="day_price"]').val('');
                            $('input[name="employee_code"]').val('');
                            $('input[name="employee_salary"]').val('');
                        }
                    });
                } else {
                    $('input[name="day_price"]').val('');
                    $('input[name="employee_salary"]').val('');
                    $('input[name="employee_code"]').val('');
                }
            });

            // حساب القيمة الإجمالية للسلفه مستديمة عند تغيير عدد الأيام
            $('input[name="value"]').on('input', function() {
                let days = parseFloat($(this).val()) || 0;
                let dayPrice = parseFloat($('input[name="day_price"]').val()) || 0;
                let total = days * dayPrice;
                $('input[name="total"]').val(total.toFixed(2));
            });
        });
    </script>
@endpush
