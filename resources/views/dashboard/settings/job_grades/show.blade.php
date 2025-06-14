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

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="col-md-12">
                            <h5 class="card-header">عرض بيانات الدرجه الوظيفية</h5>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">أسم الدرجه الوظيفية</label>
                                        <input readonly name="name" type="text"
                                            value="{{ old('name', $jobGrade->name) }}" class="form-control"
                                            id="exampleFormControlInput1" placeholder="مثال:الدرجه الاولى....">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">الحد الأدنى
                                            للمرتب</label>
                                        <input readonly name="min_salary" type="text"
                                            value="{{ old('min_salary', $jobGrade->min_salary) * 1 }}" class="form-control"
                                            id="exampleFormControlInput1" placeholder="مثال:5000....">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">الحد الأقصى
                                            للمرتب</label>
                                        <input readonly name="max_salary" type="text"
                                            value="{{ old('max_salary', $jobGrade->max_salary) * 1 }}" class="form-control"
                                            id="exampleFormControlInput1" placeholder="مثال:7000....">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">ملاحظات</label>
                                        <input readonly name="notes" type="text"
                                            value="{{ old('notes', $jobGrade->notes) }}" class="form-control"
                                            id="exampleFormControlInput1" placeholder="مثال:ملاحظات....">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة الدرجه
                                            الوظيفية</label>
                                        <select readonly name="active" class="custom-select" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
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

                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
