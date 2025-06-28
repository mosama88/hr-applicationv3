@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'فتح الشهر المالى')
@push('css')
    <!-- مكتبة Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- ستايل إضافي للغة العربية -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/flatpicker.css">
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'فتح الشهر المالى ',
        'previousPage' => 'الشهور المالية',
        'currentPage' => 'فتح الشهر المالى ',
        'url' => 'main_salary_records.index',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->

                        <form action="{{ route('dashboard.main_salary_records.edit-month', $financeClnPeriod->id) }}"
                            method="POST" id="storeForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group mb-3 col-md-3">
                                        <label for="exampleInputname">السنه المالية</label>
                                        <input disabled type="text" name="finance_yr"
                                            class="form-control bg-white @error('finance_yr') is-invalid @enderror"
                                            value="{{ old('finance_yr', $financeClnPeriod->finance_yr) }}"
                                            id="exampleInputname">
                                        @error('finance_yr')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 col-md-3">
                                        <label for="exampleInputname">الشهر المالى</label>
                                        <input disabled type="text" name="year_and_month"
                                            class="form-control bg-white @error('year_and_month') is-invalid @enderror"
                                            value="{{ old('year_and_month', $financeClnPeriod->year_and_month) }}"
                                            id="exampleInputname">
                                        @error('year_and_month')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label for="exampleInputname">بداية الشهر</label>
                                        <input disabled type="text" name="start_date_m"
                                            class="form-control bg-white @error('start_date_m') is-invalid @enderror"
                                            value="{{ old('start_date_m', $financeClnPeriod->start_date_m) }}"
                                            id="exampleInputname">
                                        @error('start_date_m')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 col-md-3">
                                        <label for="exampleInputname">نهاية الشهر</label>
                                        <input disabled type="text" name="end_date_m"
                                            class="form-control bg-white @error('end_date_m') is-invalid @enderror"
                                            value="{{ old('end_date_m', $financeClnPeriod->end_date_m) }}"
                                            id="exampleInputname">
                                        @error('end_date_m')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-6">
                                        <label for="start_date_fp" class="form-label">تاريخ بداية البصمة</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary"
                                                style="background-color: #2C6391 !important; border-color: #2C6391;">
                                                <i class="far fa-calendar-alt text-white"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control date-input date-picker @error('start_date_fp') is-invalid @enderror"
                                                name="start_date_fp" id="start_date_fp-input" placeholder="يوم / شهر / سنة"
                                                value="{{ old('start_date_fp', $financeClnPeriod->start_date_fp) }}">
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

                                    <div class="form-group mb-3 col-6">
                                        <label for="end_date_fp" class="form-label">تاريخ نهاية البصمة</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary"
                                                style="background-color: #2C6391 !important; border-color: #2C6391;">
                                                <i class="far fa-calendar-alt text-white"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control date-input date-picker @error('end_date_fp') is-invalid @enderror"
                                                name="end_date_fp" id="end_date_fp-input" placeholder="يوم / شهر / سنة"
                                                value="{{ old('end_date_fp', $financeClnPeriod->end_date_fp) }}">
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
    <!-- مكتبة Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- ملف اللغة العربية -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".date-picker", {
                locale: "ar", // تفعيل اللغة العربية
                dateFormat: "Y-m-d", // صيغة التاريخ
                allowInput: true, // السماح بالإدخال اليدوي
                altInput: true, // عرض بديل للتاريخ
                altFormat: "j F Y", // صيغة العرض: 15 أكتوبر 2023
                minDate: "today", // لا تسمح بتواريخ قبل اليوم
                disableMobile: true, // تعطيل المحرك الافتراضي على الموبايل
                nextArrow: '<i class="fa fa-angle-right"></i>',
                prevArrow: '<i class="fa fa-angle-left"></i>'
            });
            const startDate = flatpickr(".date-input", {
                onChange: function(selectedDates) {
                    endDate.set("minDate", selectedDates[0]);
                }
            });

            const endDate = flatpickr(".end_national_id-input", {});
        });
        $(document).ready(function() {
            $('.clear-date-btn').on('click', function() {
                let targetInput = $(this).data('target');
                $(targetInput).val('');
            });
        });
    </script>
@endpush
