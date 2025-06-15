@extends('dashboard.layouts.master')
@section('active-countries', 'active')
@section('title', 'الدول')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'أضافة دولة جديدة',
        'previousPage' => 'الدول',
        'currentPage' => 'أضافة دولة جديدة',
        'url' => 'countries.index',
    ])


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.countries.store') }}" method="POST" id="storeForm">
                            @csrf

                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم الدولة</label>
                                            <input name="name" type="text" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:مصر....">
                                            @error('name')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">كود
                                                الدولة</label>
                                            <input name="country_code" value="{{ old('country_code') }}"
                                                class="form-control @error('country_code') is-invalid @enderror"
                                                type="text" id="exampleFormControlReadOnlyInput1" placeholder="EG...">
                                            @error('country_code')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- /.card-body -->

                            <x-create-button-component></x-create-button-component>

                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
