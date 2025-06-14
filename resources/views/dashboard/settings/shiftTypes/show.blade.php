@php
    use App\Enums\ShiftTypesEnum;
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-shiftTypes', 'active')
@section('title', 'عرض بيانات الشفت')
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
                                <h5 class="card-header">عرض بيانات الشفت</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">نوع الشفت</label>
                                            <select readonly name="type" class="custom-select"
                                                aria-label="Default select example">
                                                <option selected value="">-- أختر الحالة--</option>
                                                <option @if (old('type', $shiftType->type) == ShiftTypesEnum::MORNING) selected @endif
                                                    value="{{ ShiftTypesEnum::MORNING }}">
                                                    {{ ShiftTypesEnum::MORNING->label() }}
                                                </option>
                                                <option @if (old('type', $shiftType->type) == ShiftTypesEnum::NIGHT) selected @endif
                                                    value="{{ ShiftTypesEnum::NIGHT }}">
                                                    {{ ShiftTypesEnum::NIGHT->label() }}
                                                </option>
                                                <option @if (old('type', $shiftType->type) == ShiftTypesEnum::FULLTIME) selected @endif
                                                    value="{{ ShiftTypesEnum::FULLTIME }}">
                                                    {{ ShiftTypesEnum::FULLTIME->label() }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">من
                                                الساعه</label>
                                            <input type="text" name="from_time" class="form-control flatpickr-input"
                                                placeholder="HH:MM" id="from_time"
                                                value="{{ old('from_time', $shiftType->from_time) }}" readonly="readonly">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">إلى
                                                الساعه</label>
                                            <input type="text" name="to_time"
                                                value="{{ old('to_time', $shiftType->to_time) }}"
                                                class="form-control flatpickr-input" placeholder="HH:MM" id="to_time"
                                                readonly="readonly">

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">عدد
                                                الساعات</label>
                                            <input type="text" name="total_hours"
                                                value="{{ old('to_time', $shiftType->total_hours) }}" class="form-control"
                                                id="total_hours" readonly="readonly">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">نوع الشفت</label>
                                            <select readonly name="active"
                                                class="custom-select @error('active') is-invalid @enderror"
                                                id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option selected value="">-- أختر الحالة--</option>
                                                <option @if (old('active', $shiftType->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::ACTIVE }}">
                                                    {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                                <option @if (old('active', $shiftType->active) == StatusActiveEnum::INACTIVE) selected @endif
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
                                                value="{{ optional($shiftType->createdBy)->name }} {{ $shiftType->created_at ? '(' . $shiftType->created_at->format('Y-m-d H:i') . ')' : '' }}"
                                                name="decision_number" class="form-control bg-white"
                                                id="exampleInputdecision_number">
                                        </div>


                                        {{-- التعديل بواسطة --}}
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="exampleInputdecision_number">التعديل بواسطة</label>
                                            <input disabled type="text"
                                                value="{{ $shiftType->updated_by ? $shiftType->updatedBy->name : '' }}{{ ' ' }}({{ optional($shiftType->updated_at)->format('Y-m-d H:i') }})"
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
