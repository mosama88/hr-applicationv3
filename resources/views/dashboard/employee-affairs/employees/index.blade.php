@php
    use App\Enums\AdminGenderEnum;
    use App\Enums\StatusActiveEnum;
@endphp

@extends('dashboard.layouts.master')
@section('active-employees', 'active')
@section('title', 'الموظفين')
@push('css')
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
                                        <th>أضافة بواسطة</th>
                                        <th>تعديل بواسطة</th>
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
                                                        src="{{ asset('dashboard') }}/assets/img/employees-default.png"
                                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                                @elseif($info->gender === AdminGenderEnum::Female)
                                                    <img class="img-thumbnail"
                                                        src="{{ asset('dashboard') }}/assets/img/employees-female-default.png"
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
                                            <td>{{ $info->createdBy->name }}</td>
                                            <td>
                                                @if ($info->updated_by > 0)
                                                    {{ $info->updatedBy->name }}
                                                @else
                                                    لا يوجد تحديث
                                                @endif

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
