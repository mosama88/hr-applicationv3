@php
    use App\Enums\FinanceCalendarsIsOpen;
    use App\Enums\FinanceClnPeriodsIsOpen;
@endphp
@extends('dashboard.layouts.master')
@section('active-main_salary_records', 'active')
@section('title', 'السجلات الرئيسية للرواتب')
@push('css')
@endpush
@section('content')
    @include('dashboard.layouts.message')

    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'السجلات الرئيسية للرواتب',
        'previousPage' => '',
        'class' => 'fa-solid fa-house',
        'currentPage' => 'السجلات الرئيسية للرواتب',
        'url' => 'index',
    ])


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">السجلات الرئيسية للرواتب </h3>
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
                                                @elseif ($financeClnPeriod->FinanceCalendar->is_open == FinanceCalendarsIsOpen::Open)
                                                    {{-- إذا كان التقويم المالي مفتوحا --}}
                                                    @if ($financeClnPeriod->is_open == FinanceClnPeriodsIsOpen::Open)
                                                        <div class="d-flex gap-2">
                                                            {{-- حالة مفتوح --}}
                                                            <span class="badge bg-success">
                                                                {{ FinanceClnPeriodsIsOpen::Open->label() }}
                                                            </span>
                                                            <form id="close-month-form-{{ $financeClnPeriod->id }}"
                                                                action="{{ route('dashboard.main_salary_records.close-month', $financeClnPeriod->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="button" title="أغلق الشهر المالى"
                                                                    class="btn btn-sm btn-danger text-white"
                                                                    onclick="confirmCloseMonth({{ $financeClnPeriod->id }})">
                                                                    <i class="fa-solid fa-lock"></i>
                                                                </button>
                                                            </form>

                                                            <a title="تعديل"
                                                                href="{{ route('dashboard.main_salary_records.edit-open', $financeClnPeriod->slug) }}"
                                                                class="btn btn-sm btn-info text-white">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        </div>
                                                    @elseif($financeClnPeriod->countOpenMonth == 0 && $financeClnPeriod->counterPreviousWatingOpen == 0)
                                                        <div class="d-flex gap-2">
                                                            <div class="d-flex gap-2">

                                                                {{-- حالة معلق ويمكن فتحه --}}
                                                                <span class="badge bg-warning">
                                                                    {{ FinanceClnPeriodsIsOpen::Pending->label() }}
                                                                </span>

                                                                <!-- Button trigger modal -->
                                                                <a title="أفتح الشهر المالى"
                                                                    class="btn btn-sm btn-primary text-white"
                                                                    href="{{ route('dashboard.main_salary_records.create-open', $financeClnPeriod->slug) }}">
                                                                    <i class="fa-solid fa-lock-open"></i>
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
