@php

    use App\Enums\FinanceClnPeriodsIsOpen;

@endphp
@extends('dashboard.layouts.master')
@section('active-main_salary_records', 'active')
@section('title', 'السجلات الرئيسية للرواتب')
@push('css')
@endpush
@section('content')

    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'السجلات الرئيسية للرواتب',
        'previousPage' => 'لوحة التحكم',
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
                                        <th>حالة الشهر</th>
                                        <th>بداية البصمة</th>
                                        <th>نهاية البصمة</th>
                                        <th>الاجراءات</th>
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
                                            <td>
                                                @if ($financeClnPeriod->is_open == FinanceClnPeriodsIsOpen::Pending)
                                                    <span class="badge bg-warning">
                                                        {{ FinanceClnPeriodsIsOpen::Pending->label() }}
                                                    </span>
                                                @elseif($financeClnPeriod->is_open == FinanceClnPeriodsIsOpen::Open)
                                                    <span class="badge bg-success">
                                                        {{ FinanceClnPeriodsIsOpen::Open->label() }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        {{ FinanceClnPeriodsIsOpen::Archived->label() }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $financeClnPeriod->start_date_fp }}</td>
                                            <td>{{ $financeClnPeriod->end_date_fp }}</td>
                                            <td></td>

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
@endpush
