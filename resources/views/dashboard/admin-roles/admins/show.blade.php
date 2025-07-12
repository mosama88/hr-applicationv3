@php
    use App\Enums\AdminGenderEnum;
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-admins', 'active')
@section('title', 'عرض بيانات المستخدم')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بيانات المستخدم',
        'previousPage' => 'جدول المستخدمين',
        'currentPage' => 'عرض بيانات المستخدم ',
        'url' => 'admins.index',
    ])


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->


                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">أسم المستخدم</label>
                                        <input readonly name="name" type="text" value="{{ old('name', $admin->name) }}"
                                            class="form-control"
                                            id="exampleFormControlInput1" placeholder="مثال:مستخدم....">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">هاتف
                                            المستخدم</label>
                                        <input readonly name="mobile" value="{{ old('mobile', $admin->mobile) }}"
                                            class="form-control" type="text"
                                            id="exampleFormControlReadOnlyInput1" placeholder="010...">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="gender-input" class="form-label">نوع الجنس</label>
                                        <input readonly name="gender" value="{{ $admin->gender->label() }}"
                                            class="form-control" type="text"
                                            id="exampleFormControlReadOnlyInput1">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">أسم
                                            المستخدم</label>
                                        <input readonly name="username" value="{{ old('username', $admin->username) }}"
                                            class="form-control" type="text"
                                            id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">البريد
                                            الالكترونى
                                        </label>
                                        <input readonly name="email" value="{{ old('email', $admin->email) }}"
                                            class="form-control" type="text"
                                            id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">حالة حساب
                                            الادمن</label>
                                        <input readonly name="active" value="{{ $admin->active->label() }}"
                                            class="form-control" type="text"
                                            id="exampleFormControlReadOnlyInput1">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
