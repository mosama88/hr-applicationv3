@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-cities', 'active')
@section('title', 'المدن')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بيانات المدينة',
        'previousPage' => 'المدن',
        'currentPage' => 'عرض بيانات المدينة',
        'url' => 'cities.index',
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
                                        <label for="exampleFormControlInput1" class="form-label">أسم المدينة</label>
                                        <input disabled name="name" type="text" value="{{ old('name', $city->name) }}"
                                            class="form-control bg-white @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:التجمع الخامس....">
                                        @error('name')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="select2Basic" class="form-label">المدينة</label>
                                        <select disabled name="governorate_id" id="select2Basic"
                                            class="select2 form-select js-example-basic-single bg-white @error('country_id') is-invalid @enderror"
                                            data-allow-clear="true">
                                            <option selected value="">--أختر الدولة --</option>
                                            @forelse ($governorates as $governorate)
                                                <option @if (old('governorate_id', $city->governorate_id) == $governorate->id) selected @endif
                                                    value="{{ $governorate->id }}">{{ $governorate->name }}</option>
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
                                <div class="row">
                                    {{-- الانشاء بواسطة --}}
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="exampleInputdecision_number">الانشاء بواسطة</label>
                                        <input disabled type="text"
                                            value="{{ optional($city->createdBy)->name }} {{ $city->created_at ? '(' . $city->created_at->format('Y-m-d H:i') . ')' : '' }}"
                                            name="decision_number" class="form-control bg-white"
                                            id="exampleInputdecision_number">
                                    </div>


                                    {{-- التعديل بواسطة --}}
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="exampleInputdecision_number">التعديل بواسطة</label>
                                        <input disabled type="text"
                                            value="{{ $city->updated_by ? $city->updatedBy->name : '' }}{{ ' ' }}({{ optional($city->updated_at)->format('Y-m-d H:i') }})"
                                            name="decision_number" class="form-control bg-white"
                                            id="exampleInputdecision_number">
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
