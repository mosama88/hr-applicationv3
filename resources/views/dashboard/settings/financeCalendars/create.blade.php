@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'أضافة سنه مالية')
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
                            <h3 class="card-title">أضافة سنه مالية جديده</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
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
                                        @php
                                            $configStart = [
                                                'format' => 'YYYY-MM-DD',
                                                'minDate' => "js:moment().startOf('month')",
                                                'maxDate' => "js:moment().endOf('month')",
                                                'daysOfWeekDisabled' => [0, 6],
                                                'locale' => 'ar', // إضافة اللغة العربية (يدعم rtl تلقائيًا)
                                                'icons' => [
                                                    'time' => 'fas fa-clock',
                                                    'date' => 'fas fa-calendar',
                                                    'up' => 'fas fa-arrow-up',
                                                    'down' => 'fas fa-arrow-down',
                                                    'previous' => 'fas fa-chevron-right',
                                                    'next' => 'fas fa-chevron-left',
                                                    'today' => 'fas fa-calendar-check',
                                                    'clear' => 'fas fa-trash',
                                                    'close' => 'fas fa-times',
                                                ],
                                            ];
                                        @endphp

                                        <x-adminlte-input-date name="start_date" id="start_date_picker" label="من"
                                            :config="$configStart" placeholder="YYYY-MM-DD HH:MM"
                                            fgroup-class="@error('start_date') is-invalid @enderror" autocomplete="off">
                                            <x-slot name="appendSlot">
                                                <div class="input-group-text bg-dark">
                                                    <i class="fas fa-calendar-day"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input-date>
                                    </div>

                                    <div class="form-group mb-3 col-6" dir="rtl">
                                        @php
                                            $configEnd = [
                                                'format' => 'YYYY-MM-DD',
                                                'minDate' => "js:moment().startOf('month')",
                                                'maxDate' => "js:moment().endOf('month')",
                                                'daysOfWeekDisabled' => [0, 6],
                                                'locale' => 'ar', // إضافة اللغة العربية (يدعم rtl تلقائيًا)
                                                'icons' => [
                                                    'time' => 'fas fa-clock',
                                                    'date' => 'fas fa-calendar',
                                                    'up' => 'fas fa-arrow-up',
                                                    'down' => 'fas fa-arrow-down',
                                                    'previous' => 'fas fa-chevron-right',
                                                    'next' => 'fas fa-chevron-left',
                                                    'today' => 'fas fa-calendar-check',
                                                    'clear' => 'fas fa-trash',
                                                    'close' => 'fas fa-times',
                                                ],
                                            ];
                                        @endphp

                                        <x-adminlte-input-date name="end_date" id="end_date_picker" label="إلى"
                                            :config="$configEnd" placeholder="YYYY-MM-DD HH:MM"
                                            fgroup-class="@error('end_date') is-invalid @enderror" autocomplete="off">
                                            <x-slot name="appendSlot">
                                                <div class="input-group-text bg-dark">
                                                    <i class="fas fa-calendar-day"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input-date>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <x-create-button-component></x-create-button-component>

                        </form>
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
