@php
    use App\Enums\FinanceClnPeriodsIsOpen;
    use App\Enums\Salaries\SanctionTypeEnum;
    use App\Enums\IsArchivedEnum;
    use App\Enums\AdminGenderEnum;
@endphp

@extends('dashboard.layouts.master')
@section('active-rewards', 'active')
@section('title', 'مكافأت الموظفين')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2-style.css" />
    <style>
        /* تنسيق عام لعارض السيرة الذاتية */
        .cv-container {
            position: relative;
            min-height: 40px;
            text-align: center;
        }

        /* تنسيق معاينة PDF */
        .pdf-preview {
            display: inline-block;
            position: relative;
        }

        .pdf-icon {
            font-size: 30px;
            color: #e74c3c;
            transition: all 0.3s ease;
        }

        /* تنسيق أدوات التلميح */
        .pdf-tooltip,
        .img-tooltip {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 100;
        }

        /* إظهار الأدوات عند Hover */
        .pdf-icon-wrapper:hover .pdf-tooltip,
        .img-preview:hover .img-tooltip {
            visibility: visible;
            opacity: 1;
        }

        /* تنسيق الصورة */
        .img-preview {
            position: relative;
            display: inline-block;
        }

        .img-thumbnail {
            max-width: 70px;
            max-height: 70px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .no-cv {
            color: #999;
            font-style: italic;
            font-size: 12px;
        }
    </style>
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول مكافأت الموظفين',
        'previousPage' => 'سجل الشهور المالية للمكافأت',
        'currentPage' => 'جدول مكافأت الموظفين',
        'url' => 'rewards.index',
    ])


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    @include('dashboard.salaries.employee_salary_rewards.partials.filter')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- الزر على اليسار -->


                                    <!-- النص على اليمين -->
                                    <a href="{{ route('dashboard.rewards.create', $financeClnPeriod->slug) }}"
                                        class="btn btn-md btn-success">
                                        <i class="fa-solid fa-square-plus mx-1"></i>أضافة جديد</a>
                                </div>
                            </h3>




                            <div class="card-tools">
                                <h4 class="mb-0">جدول مكافأت الموظفين</h4>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>صورة الموظف</th>
                                        <th>كود الموظف</th>
                                        <th>أسم الموظف</th>
                                        <th>الادارة</th>
                                        <th>الفرع</th>
                                        <th>المكافأت</th>
                                        <th>أجمالى</th>
                                        <th>الملاحظات</th>
                                        <th>الحالة</th>
                                        @if ($financeClnPeriod['is_open'] == FinanceClnPeriodsIsOpen::Open)
                                            <th>العمليات</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @php
                                                    $employee = $info->mainSalaryEmployee->employee ?? null;
                                                @endphp

                                                @if ($employee)
                                                    @php
                                                        $photoUrl = $employee->getFirstMediaUrl('photo', 'preview');
                                                    @endphp

                                                    @if ($photoUrl)
                                                        <img class="img-thumbnail rounded-circle" src="{{ $photoUrl }}"
                                                            style="width: 70px; height: 70px; object-fit: cover;"
                                                            alt="{{ $employee->name }}">
                                                    @elseif($employee->gender === AdminGenderEnum::Male)
                                                        <img class="img-thumbnail rounded-circle"
                                                            src="{{ asset('dashboard/assets/dist/assets/img/employees-male-default.png') }}"
                                                            style="width: 70px; height: 70px; object-fit: cover;"
                                                            alt="{{ $employee->name }}">
                                                    @elseif($employee->gender === AdminGenderEnum::Female)
                                                        <img class="img-thumbnail rounded-circle"
                                                            src="{{ asset('dashboard/assets/dist/assets/img/employees-female-default.png') }}"
                                                            style="width: 70px; height: 70px; object-fit: cover;"
                                                            alt="{{ $employee->name }}">
                                                    @else
                                                        <img class="img-thumbnail rounded-circle"
                                                            src="{{ asset('dashboard/assets/img/Employee.png') }}"
                                                            style="width: 70px; height: 70px; object-fit: cover;"
                                                            alt="صورة افتراضية">
                                                    @endif
                                                @else
                                                    <img class="img-thumbnail rounded-circle"
                                                        src="{{ asset('dashboard/assets/img/Employee.png') }}"
                                                        style="width: 70px; height: 70px; object-fit: cover;"
                                                        alt="لا يوجد موظف">
                                                @endif
                                            </td>
                                            <td>{{ $info->employee_code }}</td>
                                            <td>{{ $info->mainSalaryEmployee->employee_name }}</td>
                                            <td>{{ $info->mainSalaryEmployee->department->name }}</td>
                                            <td>{{ $info->mainSalaryEmployee->branch->name }}</td>
                                            <td>{{ $info->additionalType->name }}</td>
                                            <td>{{ $info->total * 1 }}</td>
                                            <td>{{ Str::limit($info->notes, 30) }}</td>
                                            <td>
                                                @if ($info->is_archived == IsArchivedEnum::Archived)
                                                    <span class="badge bg-danger">{{ $info->is_archived->label() }}</span>
                                                @else
                                                    <span class="badge bg-success">{{ $info->is_archived->label() }}</span>
                                                @endif
                                            </td>



                                            <td>
                                                @include('dashboard.partials.actions_salaries', [
                                                    'name' => 'rewards',
                                                    'name_id' => $info->slug,
                                                ])
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-secondary" role="alert">عفوآ لا توجد بيانات!</div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-12 my-2">
                                    {{ $data->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
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
            $('.main_salary_employee_id_select2').select2({
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
@endpush
