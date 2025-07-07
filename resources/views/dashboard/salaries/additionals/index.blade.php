@php
    use App\Enums\FinanceCalendarsIsOpen;
    use App\Enums\FinanceClnPeriodsIsOpen;
@endphp
@extends('dashboard.layouts.master')
@section('active-additionals', 'active')
@section('title', 'السجلات الرئيسية للاضافى')
@push('css')
    <!-- مكتبة Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- ستايل إضافي للغة العربية -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/flatpicker.css">
    <style>
        /* تحسين مظهر التبويبات */
        .nav-tabs .nav-link {
            font-weight: 600;
            padding: 0.8rem 1.5rem;
            color: #6c757d;
            border-top: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #4e73df;
            background-color: #fff;
            border-top-color: #4e73df;
            border-bottom-color: #dee2e6;
        }

        /* تحسين مظهر البطاقة */
        .card-primary.card-outline {
            border-top: 3px solid #4e73df;
        }
    </style>
@endpush
@section('content')
    @include('dashboard.layouts.message')

    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'السجلات الرئيسية للاضافى',
        'previousPage' => '',
        'class' => 'fa-solid fa-house',
        'currentPage' => 'السجلات الرئيسية للاضافى',
        'url' => 'index',
    ])


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">السجلات الرئيسية للاضافى </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>الشهر</th>
                                        <th>بداية الشهر</th>
                                        <th>نهاية الشهر</th>
                                        <th>عدد الأيام</th>
                                        <th>بداية البصمة</th>
                                        <th>نهاية البصمة</th>
                                        <th class="col-3">حالة الشهر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $financeClnPeriod)
                                        <tr data-widget="expandable-table" aria-expanded="false">
                                            <td>
                                                {{ \Carbon\Carbon::parse($financeClnPeriod->year_and_month)->translatedFormat('F') }}
                                            </td>
                                            <td>{{ $financeClnPeriod->start_date_m }}</td>
                                            <td>{{ $financeClnPeriod->end_date_m }}</td>
                                            <td>{{ $financeClnPeriod->number_of_days }}</td>
                                            <td>{{ $financeClnPeriod->start_date_fp }}</td>
                                            <td>{{ $financeClnPeriod->end_date_fp }}</td>
                                            <td>
                                                @if ($financeClnPeriod->is_open == FinanceClnPeriodsIsOpen::Archived)
                                                    {{-- حالة الأرشيف --}}
                                                    <span class="badge bg-dark">
                                                        {{ FinanceClnPeriodsIsOpen::Archived->label() }}
                                                    </span>
                                                    <a title="عرض"
                                                        href="{{ route('dashboard.additionals.show', $financeClnPeriod->slug) }}"
                                                        class="btn btn-sm btn-info text-white">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                @elseif ($financeClnPeriod->FinanceCalendar->is_open == FinanceCalendarsIsOpen::Open)
                                                    {{-- إذا كان التقويم المالي مفتوحا --}}
                                                    @if ($financeClnPeriod->is_open == FinanceClnPeriodsIsOpen::Open)
                                                        <div class="d-flex gap-2">
                                                            {{-- حالة مفتوح --}}
                                                            <span class="badge bg-success">
                                                                {{ FinanceClnPeriodsIsOpen::Open->label() }}
                                                            </span>
                                                            <a title="عرض"
                                                                href="{{ route('dashboard.additionals.show', $financeClnPeriod->slug) }}"
                                                                class="btn btn-sm btn-info text-white">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    @else
                                                        {{-- حالة معلق ولا يمكن فتحه --}}
                                                        <span class="badge bg-secondary">
                                                            {{ FinanceClnPeriodsIsOpen::Pending->label() }}
                                                        </span>
                                                    @endif
                                                @else
                                                    {{-- إذا كان التقويم المالي مغلقا --}}
                                                    <span class="badge bg-secondary">
                                                        {{ FinanceClnPeriodsIsOpen::Pending->label() }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        لا توجد بيانات
                                    @endforelse

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-12 my-2">
                                    {{ $data->links() }}
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
    <!-- مكتبة Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- ملف اللغة العربية -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".date-picker", {
                locale: "ar", // تفعيل اللغة العربية
                dateFormat: "Y-m-d", // صيغة التاريخ
                allowInput: true, // السماح بالإدخال اليدوي
                altInput: true, // عرض بديل للتاريخ
                altFormat: "j F Y", // صيغة العرض: 15 أكتوبر 2023
                minDate: "today", // لا تسمح بتواريخ قبل اليوم
                disableMobile: true, // تعطيل المحرك الافتراضي على الموبايل
                nextArrow: '<i class="fa fa-angle-right"></i>',
                prevArrow: '<i class="fa fa-angle-left"></i>'
            });
            const startDate = flatpickr(".date-input", {
                onChange: function(selectedDates) {
                    endDate.set("minDate", selectedDates[0]);
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.clear-date-btn').on('click', function() {
                let targetInput = $(this).data('target');
                $(targetInput).val('');
            });
        });
    </script>

    <script>
        function confirmCloseMonth(id) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "هل تريد غلق الشهر المالى؟ لا يمكن الرجوع بعد ذلك!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، أغلقه!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('close-month-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
