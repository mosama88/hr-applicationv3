@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-cities', 'active')
@section('title', 'عرض بيانات المدينة')
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
                            <h5 class="card-header">عرض بيانات المدينة</h5>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">أسم المدينة</label>
                                        <input readonly name="name" type="text" value="{{ old('name', $city->name) }}"
                                            class="form-control" id="exampleFormControlInput1"
                                            placeholder="مثال:التجمع الخامس....">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="select2Basic" class="form-label">الدولة</label>
                                        <input readonly name="name" type="text"
                                            value="{{ old('name', $city->governorate->name) }}" class="form-control"
                                            id="exampleFormControlInput1" placeholder="مثال:الاسكندرية....">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة المدينة</label>
                                        <select readonly name="active" class="custom-select" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                            <option selected value="">-- أختر الحالة--</option>
                                            <option @if (old('active', $city->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::ACTIVE }}">
                                                {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                            <option @if (old('active', $city->active) == StatusActiveEnum::INACTIVE) selected @endif
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
