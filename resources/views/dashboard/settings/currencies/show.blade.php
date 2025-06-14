@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-currencies', 'active')
@section('title', 'عرض بيانات العملة')
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
                            <h5 class="card-header">عرض بيانات العملة</h5>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">أسم العملة</label>
                                        <input readonly name="name" type="text"
                                            value="{{ old('name', $currency->name) }}" class="form-control"
                                            id="exampleFormControlInput1" placeholder="مثال:بلد....">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">كود
                                            العملة</label>
                                        <input readonly name="currency_symbol"
                                            value="{{ old('currency_symbol', $currency->currency_symbol) }}" class="form-control"
                                            type="text" id="exampleFormControlReadOnlyInput1" placeholder="EG...">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة العملة</label>
                                        <select readonly name="active" class="custom-select" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                            <option selected value="">-- أختر الحالة--</option>
                                            <option @if (old('active', $currency->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                value="{{ StatusActiveEnum::ACTIVE }}">
                                                {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                            <option @if (old('active', $currency->active) == StatusActiveEnum::INACTIVE) selected @endif
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
