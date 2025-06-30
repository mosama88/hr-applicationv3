@php
    use App\Enums\Salaries\SanctionTypeEnum;
    use App\Models\MainSalaryEmployee;
@endphp
@extends('dashboard.layouts.master')
@section('active-sanctions', 'active')
@section('title', 'عرض جزاء الموظف')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض جزاء للموظف ',
        'previousPage' => 'جدول الجزاءات',
        'currentPage' => 'عرض جزاء للموظف ',
        'url' => 'sanctions.index',
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
                                        <option
                                            value="{{ old('main_salary_employee_id', $sanction->main_salary_employee_id ?? '') }}"
                                            selected>
                                            {{ MainSalaryEmployee::find(old('main_salary_employee_id', $sanction->main_salary_employee_id))->employee_name }}
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
                                        value="{{ old('day_price', $sanction->day_price) * 1 }}" id="day_price-input">
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
                                        @foreach (SanctionTypeEnum::cases() as $sanctionType)
                                            <option value="{{ $sanctionType->value }}"
                                                @if (old('sanctions_type', $sanction->sanctions_type->value ?? '') == $sanctionType->value) selected @endif>
                                                {{ $sanctionType->label() }}
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
                                        value="{{ old('value', $sanction->value) * 1 }}" id="value-input">
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
                                        value="{{ old('total', $sanction->total) * 1 }}" id="total-input">
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
                                        value="{{ old('notes', $sanction->notes) }}" id="notes-input">
                                    @error('notes')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
