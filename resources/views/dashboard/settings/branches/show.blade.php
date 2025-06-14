@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'عرض بيانات الفرع')
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
                            <h4> عرض بيانات الفرع
                            </h4>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم الفرع</label>
                                            <input readonly="" name="name" value="{{ $branch->name }}" type="text"
                                                class="form-control" id="exampleFormControlInput1"
                                                placeholder="مثال:فرع....">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">هاتف
                                                الفرع</label>
                                            <input readonly="" name="phones" class="form-control"
                                                value="{{ $branch->phones }}" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="010...">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">البريد
                                                الالكترونى
                                            </label>
                                            <input readonly="" name="email" class="form-control"
                                                value="{{ $branch->email }}" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">حالة الفرع</label>
                                            <select readonly="" class="custom-select" id="exampleFormControlSelect1"
                                                aria-label="Default select example">
                                                <option selected value="">-- أختر الحالة--</option>
                                                <option @if (old('active', $branch->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::ACTIVE }}">
                                                    {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                                <option @if (old('active', $branch->active) == StatusActiveEnum::INACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::INACTIVE }}">
                                                    {{ StatusActiveEnum::INACTIVE->label() }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">عنوان الفرع
                                            </label>
                                            <input readonly="" name="address" class="form-control"
                                                value="{{ $branch->address }}" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="21 ش...">
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- الانشاء بواسطة --}}
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="exampleInputdecision_number">الانشاء بواسطة</label>
                                            <input disabled type="text"
                                                value="{{ optional($branch->createdBy)->name }} {{ $branch->created_at ? '(' . $branch->created_at->format('Y-m-d H:i') . ')' : '' }}"
                                                name="decision_number" class="form-control bg-white"
                                                id="exampleInputdecision_number">
                                        </div>


                                        {{-- التعديل بواسطة --}}
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="exampleInputdecision_number">التعديل بواسطة</label>
                                            <input disabled type="text"
                                                value="{{ $branch->updated_by ? $branch->updatedBy->name : '' }}{{ ' ' }}({{ optional($branch->updated_at)->format('Y-m-d H:i') }})"
                                                name="decision_number" class="form-control bg-white"
                                                id="exampleInputdecision_number">
                                        </div>



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
