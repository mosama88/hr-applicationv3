@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'الفروع')
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

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- العنوان على اليسار -->
                                <h4 class="mb-0">جدول الفروع</h4>

                                <!-- زر الإضافة على اليمين -->
                                <a href="{{ route('dashboard.branches.create') }}" class="btn btn-success btn-md">
                                    <i class="fas fa-plus-circle mx-1"></i>
                                    <span>إضافة جديد</span>
                                </a>
                            </div>
                        </div>


                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>أسم الفرع</th>
                                        <th>الهاتف</th>
                                        <th>العنوان</th>
                                        <th>البريد الالكترونى</th>
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
                                            <td>{{ $info->phones }}</td>
                                            <td>{{ Str::limit($info->address, 30) }}</td>
                                            <td>{{ $info->email }}</td>
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
                                                    'name' => 'branches',
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
