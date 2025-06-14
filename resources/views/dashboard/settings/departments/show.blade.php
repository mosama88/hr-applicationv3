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
                            <div class="card mb-4">
                                <h5 class="card-header">عرض بيانات الادارة</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم الادارة</label>
                                            <input readonly="" name="name" value="{{ $department->name }}"
                                                type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="مثال:ادارة المخاطر....">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">هاتف
                                                الادارة</label>
                                            <input readonly="" name="phones" class="form-control"
                                                value="{{ $department->phones }}" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="010...">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">البريد
                                                الالكترونى
                                            </label>
                                            <input readonly="" name="email" class="form-control"
                                                value="{{ $department->email }}" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">حالة الادارة</label>
                                            <select readonly="" class="custom-select" id="exampleFormControlSelect1"
                                                aria-label="Default select example">
                                                <option selected value="">-- أختر الحالة--</option>
                                                <option @if (old('active', $department->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::ACTIVE }}">
                                                    {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                                <option @if (old('active', $department->active) == StatusActiveEnum::INACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::INACTIVE }}">
                                                    {{ StatusActiveEnum::INACTIVE->label() }}</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">الملاحظات
                                        </label>
                                        <input readonly name="notes" class="form-control"
                                            value="{{ old('notes', $department->notes) }}" type="text"
                                            id="exampleFormControlReadOnlyInput1" placeholder="21 ش...">

                                    </div>




                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
