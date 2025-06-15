@php

    use App\Enums\StatusActiveEnum;

@endphp
@extends('dashboard.layouts.master')
@section('active-countries', 'active')
@section('title', 'الدول')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض دولة جديدة',
        'previousPage' => 'الدول',
        'currentPage' => 'عرض دولة جديدة',
        'url' => 'countries.index',
    ])



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-drak card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->

                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">أسم الدولة</label>
                                        <input disabled name="name" type="text"
                                            value="{{ old('name', $country->name) }}"
                                            class="form-control bg-white @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:مصر....">
                                        @error('name')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">كود
                                            الدولة</label>
                                        <input disabled name="country_code"
                                            value="{{ old('country_code', $country->country_code) }}"
                                            class="form-control bg-white @error('country_code') is-invalid @enderror"
                                            type="text" id="exampleFormControlReadOnlyInput1" placeholder="EG...">
                                        @error('country_code')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة اللغه</label>
                                        <select disabled name="active"
                                            class="form-select bg-white @error('active') is-invalid @enderror"
                                            id="exampleFormControlSelect1" aria-label="Default select example">
                                            <option selected value="">-- أختر الحالة--</option>
                                            <option @if (old('active', $country->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::ACTIVE }}">
                                                {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                            <option @if (old('active', $country->active) == StatusActiveEnum::INACTIVE) selected @endif
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


                            </div>
                        </div>
                        <!-- /.card-body -->

                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
