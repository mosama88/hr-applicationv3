@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-governorates', 'active')
@section('title', 'المحافظات')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بيانات المحافظة',
        'previousPage' => 'المحافظات',
        'currentPage' => 'عرض بيانات المحافظة',
        'url' => 'governorates.index',
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">أسم المحافظة</label>
                                        <input disabled name="name" type="text"
                                            value="{{ old('name', $governorate->name) }}"
                                            class="form-control bg-white @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:الاسكندرية....">
                                        @error('name')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="select2Basic" class="form-label">الدولة</label>
                                        <select disabled name="country_id" id="select2Basic"
                                            class="select2 form-select  bg-white @error('country_id') is-invalid @enderror"
                                            data-allow-clear="true">
                                            <option selected value="">--أختر الدولة --</option>
                                            @forelse ($countries as $country)
                                                <option @if (old('country_id', $governorate->id) == $country->id) selected @endif
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                            @empty
                                                <span>عفوآ لا توجد بيانات</span>
                                            @endforelse
                                        </select>
                                        @error('country_id')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة المحافظات</label>
                                        <select disabled name="active"
                                            class="form-select bg-white @error('active') is-invalid @enderror"
                                            id="exampleFormControlSelect1" aria-label="Default select example">
                                            <option selected value="">-- أختر الحالة--</option>
                                            <option @if (old('active', $governorate->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::ACTIVE }}">
                                                {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                            <option @if (old('active', $governorate->active) == StatusActiveEnum::INACTIVE) selected @endif
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
