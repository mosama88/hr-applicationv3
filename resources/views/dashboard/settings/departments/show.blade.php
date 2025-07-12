@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-departments', 'active')
@section('title', 'عرض بيانات الادارة')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بيانات الادارة',
        'previousPage' => 'الادارات',
        'currentPage' => 'عرض بيانات الادارة ',
        'url' => 'departments.index',
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
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">أسم الادارة</label>
                                        <input disabled name="name" value="{{ old('name', $department->name) }}"
                                            type="text" class="form-control bg-white @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:فرع....">
                                        @error('name')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">هاتف
                                            الادارة</label>
                                        <input disabled name="phones"
                                            class="form-control bg-white @error('phones') is-invalid @enderror"
                                            value="{{ old('name', $department->phones) }}" type="text"
                                            id="exampleFormControlReadOnlyInput1" placeholder="010...">
                                        @error('phones')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                    <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">الملاحظات
                                        </label>
                                        <input disabled name="notes"
                                            class="form-control bg-white @error('notes') is-invalid @enderror"
                                            value="{{ old('notes', $department->notes) }}" type="text"
                                            id="exampleFormControlReadOnlyInput1" placeholder="21 ش...">
                                        @error('notes')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة الادارة</label>
                                        <select disabled name="active"
                                            class="form-select bg-white @error('active') is-invalid @enderror"
                                            id="exampleFormControlSelect1" aria-label="Default select example">
                                            <option selected value="">-- أختر الحالة--</option>
                                            <option @if (old('active', $department->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::ACTIVE }}">
                                                {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                            <option @if (old('active', $department->active) == StatusActiveEnum::INACTIVE) selected @endif
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
                                            value="{{ optional($department->createdBy)->name }} {{ $department->created_at ? '(' . $department->created_at->format('Y-m-d H:i') . ')' : '' }}"
                                            name="decision_number" class="form-control bg-white"
                                            id="exampleInputdecision_number">
                                    </div>


                                    {{-- التعديل بواسطة --}}
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="exampleInputdecision_number">التعديل بواسطة</label>
                                        <input disabled type="text"
                                            value="{{ $department->updated_by ? $department->updatedBy->name : '' }}{{ ' ' }}({{ optional($department->updated_at)->format('Y-m-d H:i') }})"
                                            name="decision_number" class="form-control bg-white"
                                            id="exampleInputdecision_number">
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
