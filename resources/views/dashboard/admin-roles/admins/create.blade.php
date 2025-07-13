@php
    use App\Enums\AdminGenderEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-admins', 'active')
@section('title', 'المستخدمين')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'أضافة مستخدم جديد',
        'previousPage' => 'جدول المستخدمين',
        'currentPage' => 'أضافة مستخدم جديد',
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
                        <form action="{{ route('dashboard.admins.store') }}" method="POST" id="storeForm" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم المستخدم</label>
                                            <input name="name" type="text" value="{{ old('name') }}"
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
                                            <input name="mobile" value="{{ old('mobile') }}"
                                                class="form-control @error('mobile') is-invalid @enderror" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="010...">
                                            @error('mobile')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="gender-input" class="form-label">نوع
                                                الجنس</label>
                                            <select id="gender-input"
                                                class="form-select @error('gender') is-invalid @enderror" name="gender"
                                                aria-label="Default select example">
                                                <option selected value="">-- أختر نوع الجنس --</option>
                                                @foreach (AdminGenderEnum::cases() as $gender)
                                                    <option value="{{ $gender->value }}"
                                                        @if (old('gender') == $gender->value) selected @endif>
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
                                            <input name="username" value="{{ old('username') }}"
                                                class="form-control @error('username') is-invalid @enderror" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                            @error('username')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">البريد
                                                الالكترونى
                                            </label>
                                            <input name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                            @error('email')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <x-image-preview name='photo' title="أرفق صورة الأدمن" />
                                        @error('photo')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <x-create-button-component></x-create-button-component>

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
