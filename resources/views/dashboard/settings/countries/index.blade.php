@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-countries', 'active')
@section('title', 'الدول')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول الدول',
        'previousPage' => 'لوحة التحكم',
        'currentPage' => 'جدول الدول',
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
                                    <x-add-new-button route="countries.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول الدول</h4>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mx-2 mb-4 mt-3">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="إبحث بالاسم"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive text-nowrap">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>أسم الدولة</th>
                                        <th>كود الدولة</th>
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
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->country_code }}</td>
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
                                                    'name' => 'countries',
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
