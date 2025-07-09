@php
    use App\Enums\ShiftTypesEnum;
    use App\Enums\StatusActiveEnum;
@endphp

@extends('dashboard.layouts.master')
@section('active-shiftTypes', 'active')
@section('title', 'عرض بيانات الشفت')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/time-picker-style.css">
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بيانات الشفت',
        'previousPage' => 'الشفتات',
        'currentPage' => 'عرض بيانات الشفت',
        'url' => 'shiftTypes.index',
    ])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->


                        <div class="col-md-12">
                            <h5 class="card-header">عرض بيانات الشفت </h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">نوع الشفت</label>
                                        <select disabled name="type"
                                            class="form-select bg-white @error('type') is-invalid @enderror"
                                            aria-label="Default select example">
                                            <option selected value="">-- أختر الحالة--</option>
                                            <option @if (old('type', $shiftType->type) == ShiftTypesEnum::MORNING) selected @endif
                                                value="{{ ShiftTypesEnum::MORNING }}">
                                                {{ ShiftTypesEnum::MORNING->label() }}
                                            </option>
                                            <option @if (old('type', $shiftType->type) == ShiftTypesEnum::NIGHT) selected @endif
                                                value="{{ ShiftTypesEnum::NIGHT }}">
                                                {{ ShiftTypesEnum::NIGHT->label() }}
                                            </option>
                                            <option @if (old('type', $shiftType->type) == ShiftTypesEnum::FULLTIME) selected @endif
                                                value="{{ ShiftTypesEnum::FULLTIME }}">
                                                {{ ShiftTypesEnum::FULLTIME->label() }}
                                            </option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- حقل من الساعة -->
                                    <div class="col-md-3 mb-3">
                                        <label for="from_time" class="form-label">من الساعة</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                            <input disabled type="time"
                                                class="form-control time-picker bg-white @error('from_time') is-invalid @enderror"
                                                onchange="calculateHours()" name="from_time" id="from_time"
                                                value="{{ old('from_time', $shiftType->from_time) }}" step="300"
                                                min="08:00" max="20:00">
                                        </div>
                                        @error('from_time')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- حقل إلى الساعة -->
                                    <div class="col-md-3 mb-3">
                                        <label for="to_time" class="form-label">إلى الساعة</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                            <input disabled type="time"
                                                class="form-control time-picker bg-white @error('to_time') is-invalid @enderror"
                                                onchange="calculateHours()" name="to_time" id="to_time"
                                                value="{{ old('to_time', $shiftType->to_time) }}" step="300"
                                                min="08:00" max="20:00">
                                        </div>
                                        @error('to_time')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- حقل عدد الساعات -->
                                    <div class="col-md-3 mb-3">
                                        <label for="total_hours" class="form-label">عدد الساعات</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-success text-white">
                                                <i class="fas fa-calculator"></i>
                                            </span>
                                            <input disabled type="text" name="total_hours"
                                                class="form-control bg-white @error('total_hours') is-invalid @enderror"
                                                id="total_hours" value="{{ old('total_hours', $shiftType->total_hours) }}"
                                                readonly>
                                        </div>
                                        @error('total_hours')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة الشفت</label>
                                        <select disabled name="active"
                                            class="form-select bg-white @error('active') is-invalid @enderror"
                                            id="exampleFormControlSelect1" aria-label="Default select example">
                                            <option selected value="">-- أختر الحالة--</option>
                                            <option @if (old('active', $shiftType->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::ACTIVE }}">
                                                {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                            <option @if (old('active', $shiftType->active) == StatusActiveEnum::INACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::INACTIVE }}">
                                                {{ StatusActiveEnum::INACTIVE->label() }}</option>
                                        </select>
                                        @error('active')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
