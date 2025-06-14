@php
    use App\Enums\ShiftTypesEnum;
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-shiftTypes', 'active')
@section('title', 'تعديل بيانات الشفتات')
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
                            <h5 class="card-header">تعديل بيانات الشفت</h5>
                            <form action="{{ route('dashboard.shiftTypes.update', $shiftType->slug) }}" method="POST"
                                id="updateForm">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">نوع الشفت</label>
                                            <select name="type" class="custom-select @error('type') is-invalid @enderror"
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
                                            @error('type')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">من
                                                الساعه</label>
                                            <input type="text" name="from_time"
                                                class="form-control flatpickr-input @error('from_time') is-invalid @enderror"
                                                placeholder="HH:MM" id="from_time"
                                                value="{{ old('from_time', $shiftType->from_time) }}" readonly="readonly"
                                                onchange="calculateHours()">
                                            @error('from_time')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">إلى
                                                الساعه</label>
                                            <input type="text" name="to_time"
                                                value="{{ old('to_time', $shiftType->to_time) }}"
                                                class="form-control flatpickr-input  @error('to_time') is-invalid @enderror"
                                                placeholder="HH:MM" id="to_time" readonly="readonly"
                                                onchange="calculateHours()">
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
                                                value="{{ old('to_time', $shiftType->total_hours) }}"
                                                class="form-control @error('total_hours') is-invalid @enderror"
                                                id="total_hours" readonly="readonly">
                                            @error('total_hours')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">نوع الشفت</label>
                                            <select name="active" class="custom-select @error('active') is-invalid @enderror"
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
                                </div>
                                <!-- /.card-body -->
                                <x-edit-button-component></x-edit-button-component>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
    <script>
        function calculateHours() {
            const from = document.getElementById('from_time').value;
            const to = document.getElementById('to_time').value;

            if (from && to) {
                const [fromHour, fromMin] = from.split(':').map(Number);
                const [toHour, toMin] = to.split(':').map(Number);

                let fromDate = new Date();
                fromDate.setHours(fromHour, fromMin, 0);

                let toDate = new Date();
                toDate.setHours(toHour, toMin, 0);

                // إذا كان "إلى" أصغر من "من" (يعني اليوم التالي)
                if (toDate < fromDate) {
                    toDate.setDate(toDate.getDate() + 1);
                }

                const diffMs = toDate - fromDate;
                const totalMinutes = diffMs / 1000 / 60;
                const totalHoursDecimal = (totalMinutes / 60).toFixed(2); // الناتج: 12.50 مثلا

                document.getElementById('total_hours').value = totalHoursDecimal;
            }
        }

        // تفعيل flatpickr
        flatpickr("#from_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            allowInput: true,
            onChange: calculateHours
        });

        flatpickr("#to_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            allowInput: true,
            onChange: calculateHours
        });
    </script>


    <script src="{{ asset('dashboard') }}/assets/js/forms-pickers.js"></script>
@endpush
