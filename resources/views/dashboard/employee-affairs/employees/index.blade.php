@php
    use App\Enums\AdminGenderEnum;
    use App\Enums\StatusActiveEnum;
@endphp

@extends('dashboard.layouts.master')
@section('active-employees', 'active')
@section('title', 'الموظفين')
@push('css')
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
        'titlePage' => 'جدول الموظفين',
        'previousPage' => 'لوحة التحكم',
        'currentPage' => 'جدول الموظفين',
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
                                    <x-add-new-button route="employees.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول الموظفين</h4>

                            </div>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>صورة الموظف</th>
                                        <th>كود الموظف</th>
                                        <th>الأسم</th>
                                        <th>الفرع</th>
                                        <th>الوظيفه</th>
                                        <th>الموبايل</th>
                                        <th>الحالة</th>
                                        <th>السيرة الذاتية</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($info->getFirstMediaUrl('photo', 'preview'))
                                                    <img class="img-thumbnail"
                                                        src="{{ $info->getFirstMediaUrl('photo', 'preview') }}"
                                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                                @elseif($info->gender === AdminGenderEnum::Male)
                                                    <img class="img-thumbnail"
                                                        src="{{ asset('dashboard') }}/assets/dist/assets/img/employees-male-default.png"
                                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                                @elseif($info->gender === AdminGenderEnum::Female)
                                                    <img class="img-thumbnail"
                                                        src="{{ asset('dashboard') }}/assets/dist/assets/img/employees-female-default.png"
                                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                                @else
                                                    <img class="img-thumbnail"
                                                        src="{{ asset('dashboard') }}/assets/img/Employee.png"
                                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                                @endif
                                            </td>
                                            <td>{{ $info->employee_code }}</td>
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->branch?->name }}</td>
                                            <td>{{ $info->jobCategory?->name }}</td>
                                            <td>{{ $info->mobile }}</td>
                                            <td>
                                                @if ($info->active == StatusActiveEnum::ACTIVE)
                                                    <span class="badge bg-success">مفعل</span>
                                                @else
                                                    <span class="badge bg-danger">غير مفعل</span>
                                                @endif
                                            </td>
                                            <td style="max-width: 30px; max-height: 70px;">
                                                <div class="cv-container">
                                                    @if ($info->getFirstMediaUrl('cv'))
                                                        @if (Str::endsWith($info->getFirstMediaUrl('cv'), ['.pdf', '.PDF']))
                                                            <!-- عرض أيقونة PDF مع اسم ملف يظهر عند Hover -->
                                                            <div class="pdf-preview">
                                                                <a href="{{ $info->getFirstMediaUrl('cv') }}"
                                                                    target="_blank" class="pdf-link">
                                                                    <div class="pdf-icon-wrapper">
                                                                        <i class="fas fa-file-pdf pdf-icon"></i>
                                                                        <span
                                                                            class="pdf-tooltip">{{ basename($info->getFirstMediaUrl('cv')) }}</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <!-- عرض الصورة مع اسم ملف يظهر عند Hover -->
                                                            <div class="img-preview">
                                                                <img class="img-thumbnail"
                                                                    src="{{ $info->getFirstMediaUrl('cv') }}"
                                                                    style="max-width: 70px; max-height: 70px;"
                                                                    alt="{{ $info->name }}">
                                                                <span
                                                                    class="img-tooltip">{{ basename($info->getFirstMediaUrl('cv')) }}</span>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <span class="no-cv">لا يوجد سيرة ذاتية</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                @include('dashboard.partials.actions', [
                                                    'name' => 'employees',
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
                                    {{ $data->links() }}
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
@endpush
