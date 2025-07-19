@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'تعديل السنه المالية')
@push('css')
    <!-- مكتبة Flatpickr CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/flatpickr.min.css">

    <!-- ستايل إضافي للغة العربية -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/material_blue.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/flatpicker.css">
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'تعديل السنه المالية ',
        'previousPage' => 'السنوات المالية',
        'currentPage' => 'تعديل السنه المالية ',
        'url' => 'financeCalendars.index',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.financeCalendars.update', $financeCalendar->slug) }}"
                            method="POST" id="updateForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-2">
                                        <label for="exampleInputname">السنه</label>
                                        <input type="text" name="finance_yr"
                                            class="form-control @error('finance_yr') is-invalid @enderror"
                                            value="{{ old('finance_yr', $financeCalendar->finance_yr) }}"
                                            id="exampleInputname" placeholder="أدخل السنه.....">
                                        @error('finance_yr')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 col-10">
                                        <label for="exampleInputdesc">وصف السنه</label>
                                        <input type="text" name="finance_yr_desc"
                                            class="form-control @error('finance_yr_desc') is-invalid @enderror"
                                            id="exampleInputdesc"
                                            value="{{ old('finance_yr_desc', $financeCalendar->finance_yr_desc) }}"
                                            placeholder="أدخل وصف السنه.....">
                                        @error('finance_yr_desc')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group mb-3 col-3">
                                        <label for="start_date" class="form-label">تاريخ البدء</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary"
                                                style="background-color: #2C6391 !important; border-color: #2C6391;">
                                                <i class="far fa-calendar-alt text-white"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control date-input date-picker @error('start_date') is-invalid @enderror"
                                                name="start_date" id="start_date-input" placeholder="يوم / شهر / سنة"
                                                value="{{ old('start_date', $financeCalendar->start_date) }}">
                                            <button type="button" class="btn btn-outline-secondary clear-date-btn"
                                                data-target="#start_date-input">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        @error('start_date')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 col-3">
                                        <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary"
                                                style="background-color: #2C6391 !important; border-color: #2C6391;">
                                                <i class="far fa-calendar-alt text-white"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control date-input date-picker @error('end_date') is-invalid @enderror"
                                                name="end_date" id="end_date-input" placeholder="يوم / شهر / سنة"
                                                value="{{ old('end_date', $financeCalendar->end_date) }}">
                                            <button type="button" class="btn btn-outline-secondary clear-date-btn"
                                                data-target="#end_date-input">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        @error('end_date')
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
    <script src="{{ asset('dashboard') }}/assets/dist/js/flatpickr.js"></script>
    <!-- ملف اللغة العربية -->
    <script src="{{ asset('dashboard') }}/assets/dist/js/ar.js"></script>
    <script src="{{ asset('dashboard') }}/assets/dist/js/flatpicker-scripts.js"></script>
@endpush
