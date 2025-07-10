@php
    use App\Enums\Salaries\absenceTypeEnum;
    use App\Models\MainSalaryEmployee;
@endphp
@extends('dashboard.layouts.master')
@section('active-employee_salary_allowances', 'active')
@section('title', 'عرض بدل الموظف')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بدل للموظف ',
        'previousPage' => 'جدول البدلات',
        'currentPage' => 'عرض بدل للموظف ',
        'url' => 'employee_salary_allowances.index',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-dark card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->


                        <div class="card-body">
                            <div class="row">
                                <!-- الشهر المالى -->
                                <div class="form-group mb-3 col-md-3" style="display: none">
                                    <label for="exampleInputname">الشهر المالى</label>
                                    <input readonly type="text" name="finance_cln_period_id"
                                        class="form-control bg-white"
                                        value="{{ old('finance_cln_period_id', $financeClnPeriod->year_and_month) }}"
                                        id="exampleInputname">
                                </div>
                                <!--  أسم الموظف  -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="main_salary_employee_id-input">
                                        أسم الموظف</label>
                                    <input readonly type="text" name="main_salary_employee_id"
                                        class="form-control bg-white"
                                        value="{{ old('main_salary_employee_id', $employeeSalaryAllowance->mainSalaryEmployee->employee_name) }}"
                                        id="main_salary_employee_id-input">
                                </div>

                                <!--  أجر اليوم الواحد -->
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="day_price-input">
                                        أجر اليوم الواحد</label>
                                    <input readonly type="text" name="day_price" class="form-control bg-white"
                                        value="{{ old('day_price', $employeeSalaryAllowance->day_price) * 1 }}"
                                        id="day_price-input">
                                </div>

                                <!--  كود الوظف -->
                                <div class="col-md-2 mb-3" style="display: none">
                                    <label class="form-label" for="employee_code-input">
                                        كود الموظف</label>
                                    <input readonly type="text" name="employee_code" class="form-control bg-white"
                                        value="{{ old('employee_code', $employeeSalaryAllowance->employee_code) }}"
                                        id="employee_code-input">
                                </div>

                                <!-- نوع البدل -->
                                <div class="col-md-3">
                                    <label class="form-label" for="formtabs-country">نوع البدل</label>
                                    <input readonly type="text" name="total"
                                        class="form-control bg-white @error('total') is-invalid @enderror"
                                        value="{{ old('total', $employeeSalaryAllowance->allowance->name) }}"
                                        id="total-input">
                                </div>

                                <!-- قيمة البدل -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="total-input">
                                        أجمالى قيمة البدل</label>
                                    <input readonly type="text" name="total"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                        class="form-control bg-white @error('total') is-invalid @enderror"
                                        value="{{ old('total', $employeeSalaryAllowance->total) }}" id="total-input">
                                </div>

                            </div>
                            <div class="row">
                                <!--  ملاحظات -->
                                <div class="col-md-8 mb-3">
                                    <label readonly class="form-label" for="notes-input">
                                        ملاحظات</label>
                                    <input readonly type="text" name="notes" class="form-control bg-white"
                                        value="{{ old('notes', $employeeSalaryAllowance->notes) }}" id="notes-input">
                                </div>
                            </div>

                        </div>


                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
