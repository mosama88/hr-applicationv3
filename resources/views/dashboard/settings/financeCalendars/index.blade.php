@php
    use App\Enums\FinanceCalendarsIsOpen;
@endphp
@extends('dashboard.layouts.master')
@section('active-financeCalendars', 'active')
@section('title', 'السنوات المالية')
@push('css')
    <style>
        .btn-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 6px;
            padding: 0;
        }
    </style>
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'إعدادات الشركة',
        'previousPage' => 'لوحة التحكم',
        'currentPage' => 'إعدادات الشركة',
        'url' => 'index',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">



                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- الزر على اليسار -->


                                    <!-- النص على اليمين -->
                                    <a href="{{ route('dashboard.financeCalendars.create') }}" class="btn btn-md btn-success">
                                        <i class="mx-1 fas fa-plus"></i>إضافة
                                        جديد</a>

                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول السنوات المالية</h4>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>السنه المالية</th>
                                        <th>وصف السنه</th>
                                        <th>من</th>
                                        <th>الى</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">

                                    <tr>
                                        @forelse ($data as $info)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $info->finance_yr }}</td>
                                            <td>{{ $info->finance_yr_desc }}</td>
                                            <td>{{ $info->start_date }}</td>
                                            <td>{{ $info->end_date }}</td>
                                            <td>
                                                @if ($info->is_open == FinanceCalendarsIsOpen::Open)
                                                    <span class="badge bg-success">مفعل</span>
                                                @elseif ($info->is_open == FinanceCalendarsIsOpen::Pending)
                                                    <span class="badge bg-warning">معلق</span>
                                                @else
                                                    <span class="badge bg-danger">مؤرشف</span>
                                                @endif
                                            </td>


                                            <td>
                                                @include('dashboard.partials.actions', [
                                                    'name' => 'financeCalendars',
                                                    'name_id' => $info->slug,
                                                ])
                                            </td>
                                    </tr>
                                @empty
                                    عفوآ لا توجد بيانات
                                    @endforelse
                                </tbody>
                            </table>
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
