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
                            <h5 class="card-header">تعديل بيانات الدرجه الوظيفية</h5>
                            <form action="{{ route('dashboard.job_grades.update', $jobGrade->slug) }}" method="POST"
                                id="updateForm">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم الدرجه
                                                الوظيفية</label>
                                            <input name="name" type="text" value="{{ old('name', $jobGrade->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
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
                                            <input name="min_salary" type="text"
                                                value="{{ old('min_salary', $jobGrade->min_salary) * 1 }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^0+/, '');"
                                                class="form-control @error('min_salary') is-invalid @enderror"
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
                                            <input name="max_salary" type="text"
                                                value="{{ old('max_salary', $jobGrade->max_salary) * 1 }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^0+/, '');"
                                                class="form-control @error('max_salary') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:7000....">
                                            @error('max_salary')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">ملاحظات</label>
                                            <input name="notes" type="text"
                                                value="{{ old('notes', $jobGrade->notes) }}"
                                                class="form-control @error('notes') is-invalid @enderror"
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
                                            <select readonly name="active" class="custom-select"
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
                        <x-edit-button-component></x-edit-button-component>

                        </form>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
