@php
    use Carbon\Carbon;
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-shiftTypes', 'active')
@section('title', 'الشفتات')
@push('css')

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
                                <h4 class="mb-0">جدول الشفتات</h4>

                                <!-- زر الإضافة على اليمين -->
                                <a href="{{ route('dashboard.shiftTypes.create') }}" class="btn btn-success btn-md">
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
                                        <th>نوع الشفت</th>
                                        <th>من الساعه</th>
                                        <th>إلى الساعه</th>
                                        <th>عدد الساعات</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $info->type->label() }}</td>
                                            <td>{{ Carbon::createFromFormat('H:i:s', $info->from_time)->format('H:i') }}
                                            </td>
                                            <td>{{ Carbon::createFromFormat('H:i:s', $info->to_time)->format('H:i') }}
                                            <td>{{ $info->total_hours }}</td>
                                            <td>
                                                @if ($info->active == StatusActiveEnum::ACTIVE)
                                                    <span class="badge bg-success">مفعل</span>
                                                @else
                                                    <span class="badge bg-danger">غير مفعل</span>
                                                @endif
                                            </td>


                                            <td>
                                                @include('dashboard.partials.actions', [
                                                    'name' => 'shiftTypes',
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
