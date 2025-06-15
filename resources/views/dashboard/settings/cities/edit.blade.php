@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-cities', 'active')
@section('title', 'المدن')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'تعديل بيانات المدينة',
        'previousPage' => 'المدن',
        'currentPage' => 'تعديل بيانات المدينة',
        'url' => 'cities.index',
    ])


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.cities.update', $city->slug) }}" method="POST" id="updateForm">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم المدينة</label>
                                            <input name="name" type="text" value="{{ old('name', $city->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:التجمع الخامس....">
                                            @error('name')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="select2Basic" class="form-label">المدينة</label>
                                            <select name="governorate_id" id="select2Basic"
                                                class="select2 form-select js-example-basic-single @error('country_id') is-invalid @enderror"
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
                                            <select name="active" class="form-select @error('active') is-invalid @enderror"
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


                                </div>
                            </div>
                            <!-- /.card-body -->

                            <x-edit-button-component></x-edit-button-component>

                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
    <script src="{{ asset('dashboard') }}/assets/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
