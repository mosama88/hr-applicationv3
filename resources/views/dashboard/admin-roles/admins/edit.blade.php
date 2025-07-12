@php
    use App\Enums\AdminGenderEnum;
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-admins', 'active')
@section('title', 'تعديل بيانات المستخدم')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'تعديل بيانات المستخدم',
        'previousPage' => 'جدول المستخدمين',
        'currentPage' => 'تعديل بيانات المستخدم ',
        'url' => 'admins.index',
    ])


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.admins.update', $admin->slug) }}" method="POST" id="updateForm">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم المستخدم</label>
                                            <input name="name" type="text" value="{{ old('name', $admin->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:مستخدم....">
                                            @error('name')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">هاتف
                                                المستخدم</label>
                                            <input name="mobile" value="{{ old('mobile', $admin->mobile) }}"
                                                class="form-control @error('mobile') is-invalid @enderror" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="010...">
                                            @error('mobile')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="gender-input" class="form-label">نوع
                                                الجنس</label>
                                            <select id="gender-input"
                                                class="form-select @error('gender') is-invalid @enderror" name="gender"
                                                aria-label="Default select example">
                                                <option selected value="">-- أختر نوع الجنس -- </option>
                                                @foreach (AdminGenderEnum::cases() as $gender)
                                                    <option value="{{ $gender->value }}"
                                                        @if (old('gender', $admin->gender->value) == $gender->value) selected @endif>
                                                        {{ $gender->label() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">أسم
                                                المستخدم</label>
                                            <input name="username" value="{{ old('username', $admin->username) }}"
                                                class="form-control @error('username') is-invalid @enderror" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                            @error('username')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">البريد
                                                الالكترونى
                                            </label>
                                            <input name="email" value="{{ old('email', $admin->email) }}"
                                                class="form-control @error('email') is-invalid @enderror" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                            @error('email')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">كلمة المرور
                                            </label>
                                            <input name="password" value="{{ $admin->password }}"
                                                class="form-control @error('password') is-invalid @enderror" type="password"
                                                id="exampleFormControlReadOnlyInput1" placeholder="**********">
                                            @error('password')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">تأكيد كلمة
                                                المرور
                                            </label>
                                            <input name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                type="password" id="exampleFormControlReadOnlyInput1" value="{{ $admin->password }}"
                                                placeholder="**********">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">حالة حساب
                                                الادمن</label>
                                            <select name="active" class="form-select @error('active') is-invalid @enderror"
                                                id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option selected value="">-- أختر الحالة--</option>
                                                <option @if (old('active', $admin->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::ACTIVE }}">
                                                    {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                                <option @if (old('active', $admin->active) == StatusActiveEnum::INACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::INACTIVE }}">
                                                    {{ StatusActiveEnum::INACTIVE->label() }}</option>
                                            </select>
                                            @error('active')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <x-edit-button-component></x-edit-button-component>

                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
