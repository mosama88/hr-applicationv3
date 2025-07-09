@php
    use App\Enums\ShiftTypesEnum;
    use App\Enums\StatusActiveEnum;
@endphp

@extends('dashboard.layouts.master')
@section('active-shiftTypes', 'active')
@section('title', 'تعديل بيانات الشفت ')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/time-picker-style.css">
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'تعديل بيانات الشفت ',
        'previousPage' => 'الشفتات',
        'currentPage' => 'تعديل بيانات الشفت ',
        'url' => 'shiftTypes.index',
    ])



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.shiftTypes.update', $shiftType->slug) }}" method="POST"
                            method="POST" id="updateForm">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">نوع الشفت</label>
                                            <select name="type" class="form-select @error('type') is-invalid @enderror"
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

                                        <!-- حقل من الساعة -->
                                        <div class="col-md-3 mb-3">
                                            <label for="from_time" class="form-label">من الساعة</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white">
                                                    <i class="fas fa-clock"></i>
                                                </span>
                                                <input type="time"
                                                    class="form-control time-picker @error('from_time') is-invalid @enderror"
                                                    onchange="calculateHours()" name="from_time" id="from_time"
                                                    value="{{ old('from_time', $shiftType->from_time) }}" step="300">
                                            </div>
                                            @error('from_time')
                                                <div class="invalid-feedback text-right d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- حقل إلى الساعة -->
                                        <div class="col-md-3 mb-3">
                                            <label for="to_time" class="form-label">إلى الساعة</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white">
                                                    <i class="fas fa-clock"></i>
                                                </span>
                                                <input type="time"
                                                    class="form-control time-picker @error('to_time') is-invalid @enderror"
                                                    onchange="calculateHours()" name="to_time" id="to_time"
                                                    value="{{ old('to_time', $shiftType->to_time) }}" step="300">
                                            </div>
                                            @error('to_time')
                                                <div class="invalid-feedback text-right d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- حقل عدد الساعات -->
                                        <div class="col-md-3 mb-3">
                                            <label for="total_hours" class="form-label">عدد الساعات</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fas fa-calculator"></i>
                                                </span>
                                                <input type="text" name="total_hours"
                                                    class="form-control @error('total_hours') is-invalid @enderror"
                                                    id="total_hours"
                                                    value="{{ old('total_hours', $shiftType->total_hours) }}" readonly>
                                            </div>
                                            @error('total_hours')
                                                <div class="invalid-feedback text-right d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">حالة الشفت</label>
                                            <select name="active" class="form-select @error('active') is-invalid @enderror"
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
    <script src="{{ asset('dashboard') }}/assets/dist/js/moment.min.js"></script>
    <script>
        function calculateHours() {
            const fromTimeInput = document.getElementById('from_time');
            const toTimeInput = document.getElementById('to_time');
            const totalHoursInput = document.getElementById('total_hours');

            const fromTime = fromTimeInput.value;
            const toTime = toTimeInput.value;

            if (!fromTime || !toTime) {
                totalHoursInput.value = '';
                return;
            }

            try {
                let fromMoment = moment(fromTime, 'HH:mm');
                let toMoment = moment(toTime, 'HH:mm');

                // إذا كان وقت النهاية قبل وقت البداية (تجاوز منتصف الليل)
                if (toMoment.isBefore(fromMoment)) {
                    toMoment.add(1, 'day');
                }

                const duration = moment.duration(toMoment.diff(fromMoment));
                const hours = Math.floor(duration.asHours());
                const minutes = duration.minutes();

                // عرض النتيجة بتنسيق ٨.٥٠ ساعة بدلًا من ٨.٨٣
                const formattedHours = hours + (minutes / 60);
                totalHoursInput.value = formattedHours.toFixed(2);

                // تغيير لون الحقل حسب عدد الساعات
                if (formattedHours > 8) {
                    totalHoursInput.classList.add('bg-warning', 'text-dark');
                } else {
                    totalHoursInput.classList.remove('bg-warning', 'text-dark');
                }

            } catch (error) {
                console.error('Error calculating hours:', error);
                totalHoursInput.value = '';
            }
        }

        // حساب الساعات تلقائيًا عند تحميل الصفحة إذا كانت القيم موجودة
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('from_time').value && document.getElementById('to_time').value) {
                calculateHours();
            }
        });
    </script>
@endpush
