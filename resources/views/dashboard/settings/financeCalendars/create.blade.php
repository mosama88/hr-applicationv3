@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'أضافة سنه مالية')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'أضافة سنه مالية جديدة',
        'previousPage' => 'السنوات المالية',
        'currentPage' => 'أضافة سنه مالية جديدة',
        'url' => 'financeCalendars.index',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <h3 class="card-title">أضافة سنه مالية جديده</h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.financeCalendars.store') }}" method="POST" id="storeForm">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-2">
                                        <label for="exampleInputname">السنه</label>
                                        <input type="text" name="finance_yr"
                                            class="form-control @error('finance_yr') is-invalid @enderror"
                                            value="{{ old('finance_yr') }}" id="exampleInputname"
                                            placeholder="أدخل السنه.....">
                                        @error('finance_yr')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 col-10">
                                        <label for="exampleInputdesc">وصف السنه</label>
                                        <input type="text" name="finance_yr_desc"
                                            class="form-control @error('finance_yr_desc') is-invalid @enderror"
                                            id="exampleInputdesc" value="{{ old('finance_yr_desc') }}"
                                            placeholder="أدخل وصف السنه.....">
                                        @error('finance_yr_desc')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group mb-3 col-6" dir="rtl">
                                        <input type="text" placeholder="HH:i"
                                            class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                            id="start_date" value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 col-6" dir="rtl">
                                        <input type="text" placeholder="HH:i"
                                            class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                            id="end_date" value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#start_date_picker", {
                dateFormat: "Y-m-d"
            });

            flatpickr("#end_date_picker", {
                dateFormat: "Y-m-d"
            });
        });
    </script>
@endpush
