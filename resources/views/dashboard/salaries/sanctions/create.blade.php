@php
    use App\Enums\Salaries\SanctionTypeEnum;
    use App\Http\Controllers\Dashboard\Salaries\MainSalaryRecordController;
@endphp
@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'أنشاء جزاء للموظف')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2-style.css" />
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'أنشاء جزاء للموظف ',
        'previousPage' => 'الشهور المالية',
        'currentPage' => 'أنشاء جزاء للموظف ',
        'url' => 'sanctions.index',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->

                        <form action="{{ route('dashboard.sanctions.store', $financeClnPeriod->id) }}" method="POST"
                            id="storeForm">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-md-3" style="display: none">
                                        <label for="exampleInputname">الشهر المالى</label>
                                        <input disabled type="text" name="year_and_month"
                                            class="form-control bg-white @error('year_and_month') is-invalid @enderror"
                                            value="{{ old('year_and_month', $financeClnPeriod->year_and_month) }}"
                                            id="exampleInputname">
                                        @error('year_and_month')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="main_salary_employee_id-input">
                                            أسم الموظف</label>
                                        <select name="main_salary_employee_id" id="main_salary_employee_id-input"
                                            class="select2 form-select employee_select2 @error('main_salary_employee_id') is-invalid @enderror"
                                            data-allow-clear="true">
                                            @if (old('main_salary_employee_id'))
                                                <option value="{{ old('main_salary_employee_id') }}" selected>
                                                    {{ MainSalaryRecordController::find(old('main_salary_employee_id'))?->name }}
                                                </option>
                                            @endif
                                        </select>
                                        @error('main_salary_employee_id')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label class="form-label" for="day_price-input">
                                            أجر اليوم الواحد</label>
                                        <input disabled type="text" name="day_price"
                                            class="form-control bg-white @error('day_price') is-invalid @enderror"
                                            value="{{ old('day_price') }}" id="day_price-input">
                                        @error('day_price')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- نوع الجزاء -->
                                    <div class="col-md-3 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">
                                            نوع الجزاء</label>
                                        <select class="form-select @error('sanctions_type') is-invalid @enderror"
                                            name="sanctions_type" aria-label="Default select example">
                                            <option selected value="">-- أختر النوع--</option>
                                            @foreach (SanctionTypeEnum::cases() as $sanction)
                                                <option value="{{ $sanction->value }}"
                                                    @if (old('sanctions_type') == $sanction->value) selected @endif>
                                                    {{ $sanction->label() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sanctions_type')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <!-- نوع الجزاء -->
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label" for="value-input">
                                            عدد أيام الجزاء</label>
                                        <input type="text" name="value"
                                            class="form-control @error('value') is-invalid @enderror"
                                            value="{{ old('value') }}" id="value-input">
                                        @error('value')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- قيمة الجزاء -->
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="total-input">
                                        قيمة الجزاء</label>
                                    <input disabled type="text" name="total"
                                        class="form-control bg-white @error('total') is-invalid @enderror"
                                        value="{{ old('total') }}" id="total-input">
                                    @error('total')
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
    <script src="{{ asset('dashboard') }}/assets/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // job_category_select2
            $('.employee_select2').select2({
                placeholder: '-- أختر الموظف --',
                ajax: {
                    url: "{{ route('dashboard.sanctions.search_employee') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(employees => ({
                                id: employees.id,
                                text: `${employees.employee_name} ➜ (${employees.employee_code})`
                            }))
                        };
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#main_salary_employee_id-input').on('change', function() {
                var employeeId = $(this).val();
                if (employeeId) {
                    $.ajax({
                        url: '/api/get-day-price/' + employeeId,
                        method: 'GET',
                        success: function(response) {
                            if (response.status) {
                                let dayPrice = Math.round(response.day_price); // عدد صحيح فقط
                                $('input[name="day_price"]').val(dayPrice);
                            } else {
                                $('input[name="day_price"]').val('');
                            }
                        },
                        error: function() {
                            $('input[name="day_price"]').val('');
                        }
                    });
                } else {
                    $('input[name="day_price"]').val('');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // عند تغيير عدد أيام الجزاء
            $('#value-input').on('input', function() {
                calculateTotal();
            });

            // لو تغير أجر اليوم أيضًا من أي عملية (مثلاً تغيير الموظف)
            $('#day_price-input').on('input', function() {
                calculateTotal();
            });

            function calculateTotal() {
                var days = parseInt($('#value-input').val()) || 0;
                var dayPrice = parseInt($('#day_price-input').val()) || 0;
                var total = days * dayPrice;
                $('#total-input').val(total);
            }
        });
    </script>
@endpush
