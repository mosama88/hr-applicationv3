@php
    use App\Enums\FinanceCalendarsIsOpen;
    use App\Enums\FinanceClnPeriodsIsOpen;
@endphp
@extends('dashboard.layouts.master')
@section('active-sanctions', 'active')
@section('title', 'السجلات الرئيسية للجزاءات')
@push('css')
@endpush
@section('content')
    @include('dashboard.layouts.message')

    <!-- Content Header (Page header) -->
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'السجلات الرئيسية للجزاءات',
        'previousPage' => '',
        'class' => 'fa-solid fa-house',
        'currentPage' => 'السجلات الرئيسية للجزاءات',
        'url' => 'index',
    ])


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">السجلات الرئيسية للجزاءات </h3>
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
                                                        href="{{ route('dashboard.sanctions.show', $financeClnPeriod->slug) }}"
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
                                                                href="{{ route('dashboard.sanctions.show', $financeClnPeriod->slug) }}"
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
