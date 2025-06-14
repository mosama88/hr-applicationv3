@php
    use App\Enums\ShiftTypesEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-shiftTypes', 'active')
@section('title', 'الشفتات')
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
                        <form action="{{ route('dashboard.shiftTypes.store') }}" method="POST" id="storeForm">
                            @csrf

                            <div class="col-md-12">
                                <h5 class="card-header">أضافة شفت جديد</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">نوع الشفت</label>
                                            <select name="type" class="custom-select @error('type') is-invalid @enderror"
                                                aria-label="Default select example">
                                                <option selected value="">-- أختر الحالة--</option>
                                                <option @if (old('type') == ShiftTypesEnum::MORNING) selected @endif
                                                    value="{{ ShiftTypesEnum::MORNING }}">
                                                    {{ ShiftTypesEnum::MORNING->label() }}
                                                </option>
                                                <option @if (old('type') == ShiftTypesEnum::NIGHT) selected @endif
                                                    value="{{ ShiftTypesEnum::NIGHT }}">
                                                    {{ ShiftTypesEnum::NIGHT->label() }}
                                                </option>
                                                <option @if (old('type') == ShiftTypesEnum::FULLTIME) selected @endif
                                                    value="{{ ShiftTypesEnum::FULLTIME }}">
                                                    {{ ShiftTypesEnum::FULLTIME->label() }}
                                                </option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            @php
                                                $configFromTime = ['format' => 'HH:mm:ss'];
                                            @endphp
                                            <x-adminlte-input-date label="من الساعة" name="from_time"
                                                value="{{ old('from_time') }}" id="from_time" :config="$configFromTime"
                                                placeholder="HH:MM" onchange="calculateHours()" autocomplete="off">
                                                <x-slot name="prependSlot">
                                                    <div
                                                        class="input-group-text bg-gradient-info @error('from_time') is-invalid @enderror">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input-date>


                                            @error('from_time')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            @php
                                                $configToTime = ['format' => 'HH:mm:ss'];

                                            @endphp
                                            <x-adminlte-input-date label="إلى الساعة" name="to_time"
                                                value="{{ old('to_time') }}" id="to_time" :config="$configToTime"
                                                placeholder="HH:MM" onchange="calculateHours()" autocomplete="off">
                                                <x-slot name="prependSlot">
                                                    <div
                                                        class="input-group-text bg-gradient-info @error('to_time') is-invalid @enderror">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input-date>


                                            @error('to_time')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">عدد
                                                الساعات</label>
                                            <input type="text" name="total_hours"
                                                class="form-control @error('total_hours') is-invalid @enderror"
                                                id="total_hours" value="{{ old('total_hours') }}" readonly="readonly">
                                            @error('total_hours')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                    <x-create-button-component></x-create-button-component>
                        </form>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
    <script>
        function calculateHours() {
            const from = document.getElementById('from_time').value;
            const to = document.getElementById('to_time').value;

            if (from && to) {
                let fromTime = moment(from, 'HH:mm');
                let toTime = moment(to, 'HH:mm');

                // إذا كان الوقت "إلى" أصغر من "من" نضيف يوم
                if (toTime.isBefore(fromTime)) {
                    toTime.add(1, 'day');
                }

                const duration = moment.duration(toTime.diff(fromTime));
                const totalHoursDecimal = (duration.asMinutes() / 60).toFixed(2);

                document.getElementById('total_hours').value = totalHoursDecimal;
            }
        }
    </script>



    <script src="{{ asset('dashboard') }}/assets/js/forms-pickers.js"></script>
@endpush
