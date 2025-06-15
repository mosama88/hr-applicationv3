@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-job_grades', 'active')
@section('title', 'الدرجات الوظيفية')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بيانات الدرجه الوظيفية',
        'previousPage' => 'الدرجات الوظيفية',
        'currentPage' => 'عرض بيانات الدرجه الوظيفية',
        'url' => 'job_grades.index',
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
                                        <label for="exampleFormControlInput1" class="form-label">أسم الدرجه
                                            الوظيفية</label>
                                        <input disabled name="name" type="text"
                                            value="{{ old('name', $jobGrade->name) }}"
                                            class="form-control bg-white @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:الدرجه الاولى....">
                                        @error('name')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">الحد الأدنى
                                            للمرتب</label>
                                        <input disabled name="min_salary" type="text"
                                            value="{{ old('min_salary', $jobGrade->min_salary) * 1 }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^0+/, '');"
                                            class="form-control bg-white @error('min_salary') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:5000....">
                                        @error('min_salary')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">الحد الأقصى
                                            للمرتب</label>
                                        <input disabled name="max_salary" type="text"
                                            value="{{ old('max_salary', $jobGrade->max_salary) * 1 }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^0+/, '');"
                                            class="form-control bg-white @error('max_salary') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:7000....">
                                        @error('max_salary')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">ملاحظات</label>
                                        <input disabled name="notes" type="text"
                                            value="{{ old('notes', $jobGrade->notes) }}"
                                            class="form-control bg-white @error('notes') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:ملاحظات....">
                                        @error('notes')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة الدرجه
                                            الوظيفية</label>
                                        <select disabled name="active" class="form-select bg-white"
                                            id="exampleFormControlSelect1" aria-label="Default select example">
                                            <option selected value="">-- أختر الحالة--</option>
                                            <option @if (old('active', $jobGrade->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::ACTIVE }}">
                                                {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                            <option @if (old('active', $jobGrade->active) == StatusActiveEnum::INACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::INACTIVE }}">
                                                {{ StatusActiveEnum::INACTIVE->label() }}</option>
                                        </select>
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
