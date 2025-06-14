@php
    use Carbon\Carbon;
    use App\Enums\AdminGenderEnum;
    use App\Enums\ShiftTypesEnum;
    use App\Enums\Employee\FunctionalStatus;
    use App\Enums\Employee\Military;
    use App\Enums\Employee\DrivingLicenseType;
    use App\Enums\Employee\MotivationType;
    use App\Enums\Employee\TypeSalaryReceipt;
    use App\Enums\YesOrNoEnum;
    use App\Enums\Employee\ReligionEnum;
    use App\Enums\Employee\SocialStatus;
    use App\Enums\Employee\GraduationEstimateEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-employees', 'active')
@section('title', 'تعديل بيانات الموظف')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/libs/select2/select2.css" />

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->
 
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="col-md-12">
                            <h5 class="card-header d-flex justify-content-between align-items-center">
                                <span>تعديل بيانات {{ $employee->name }}</span>

                                <!-- Submit -->

                                <button type="submit" id="submitButton" class="btn btn-md btn-outline-info">
                                    <i class="fa-solid fa-floppy-disk mx-1"></i> تعديل البيانات
                                </button>
                            </h5>

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger text-center">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="nav-align-top mb-3">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <button class="nav-link active" data-bs-toggle="tab"
                                                        data-bs-target="#form-tabs-personal" role="tab"
                                                        aria-selected="true">
                                                        بيانات شخصية
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab"
                                                        data-bs-target="#form-tabs-account" role="tab"
                                                        aria-selected="false">
                                                        بيانات الخدمة العسكرية
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab"
                                                        data-bs-target="#form-tabs-social" role="tab"
                                                        aria-selected="false">
                                                        بيانات وظيفية
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab"
                                                        data-bs-target="#form-tabs-addtional" role="tab"
                                                        aria-selected="false">
                                                        بيانات إضافية
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade active show" id="form-tabs-personal"
                                                    role="tabpanel">
                                                    <form
                                                        action="{{ route('dashboard.employees.update', $employee->slug) }}"
                                                        method="POST" id="storeForm" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('Patch')
                                                        <div class="row g-3">
                                                            <!-- كود البصمة -->
                                                            <div class="col-md-3 ">
                                                                <label class="form-label" for="fp_code-input">كود بصمة
                                                                    الموظف</label>
                                                                <input type="text"
                                                                    class="form-control @error('fp_code') is-invalid @enderror"
                                                                    name="fp_code"
                                                                    value="{{ old('fp_code', $employee->fp_code) }}"
                                                                    id="fp_code-input"
                                                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                    placeholder="مثال:1000" />
                                                                @error('fp_code')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <!-- الأسم -->
                                                            <div class="col-md-6 ">
                                                                <label class="form-label" for="name-input">اسم
                                                                    الموظف بالكامل <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="name"
                                                                    value="{{ old('name', $employee->name) }}"
                                                                    id="name-input"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    placeholder="مثال:John" />
                                                                @error('name')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- الجنس -->
                                                            <div class="col-md-3 ">
                                                                <label for="gender-input" class="form-label">نوع
                                                                    الجنس</label>
                                                                <select id="gender-input"
                                                                    class="custom-select @error('gender') is-invalid @enderror"
                                                                    name="gender" aria-label="Default select example">
                                                                    <option selected value="">-- أختر نوع الجنس --
                                                                    </option>
                                                                    @foreach (AdminGenderEnum::cases() as $gender)
                                                                        <option value="{{ $gender->value }}"
                                                                            @if (old('gender', $employee->gender->value) == $gender->value) selected @endif>
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

                                                            <!--  سنة التخرج -->
                                                            <div class="col-md-3 ">
                                                                <label class="form-label" for="qualification_year-input">
                                                                    سنة التخرج </label>
                                                                <input type="text" id="qualification_year-input"
                                                                    value="{{ old('qualification_year', $employee->qualification_year) }}"
                                                                    class="form-control @error('qualification_year') is-invalid @enderror"
                                                                    name="qualification_year"
                                                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                    placeholder="مثال:2020" />
                                                                @error('qualification_year')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>



                                                            <!-- المؤهل الدراسي  -->
                                                            <div class="col-md-6">
                                                                <label class="form-label"
                                                                    for="qualification_id-input">المؤهل
                                                                    الدراسي</label>
                                                                <select name="qualification_id"
                                                                    class="select2 custom-select @error('qualification_id') is-invalid @enderror"
                                                                    data-allow-clear="true">
                                                                    <option selected value="">-- أختر المؤهل --
                                                                    </option>
                                                                    @foreach ($other['qualifications'] as $qualification)
                                                                        <option
                                                                            @if (old('qualification_id', $employee->qualification_id) == $qualification->id) selected @endif
                                                                            value="{{ $qualification->id }}">
                                                                            {{ $qualification->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('qualification_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>



                                                            <!-- تقدير التخرج -->
                                                            <div class="col-md-3 ">
                                                                <label for="exampleFormControlSelect1" class="form-label">
                                                                    تقدير التخرج</label>
                                                                <select
                                                                    class="custom-select @error('graduation_estimate') is-invalid @enderror"
                                                                    name="graduation_estimate"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">-- أختر تقدير التخرج --
                                                                    </option>
                                                                    @foreach (GraduationEstimateEnum::cases() as $estimate)
                                                                        <option value="{{ $estimate->value }}"
                                                                            @if (old('graduation_estimate', $employee->graduation_estimate->value) == $estimate->value) selected @endif>
                                                                            {{ $estimate->label() }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('graduation_estimate')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- تخصص  التخرج -->
                                                            <div class="col-md-3 ">
                                                                <label for="major-input" class="form-label">
                                                                    تخصص التخرج</label>
                                                                <input type="text" id="major-input"
                                                                    value="{{ old('major', $employee->major) }}"
                                                                    class="form-control @error('major') is-invalid @enderror"
                                                                    name="major" placeholder="مثال:علوم الحاسوب" />
                                                                @error('major')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- الفرع -->
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="formtabs-country">الفرع
                                                                    التابع له الموظف</label>
                                                                <select
                                                                    class="select2 custom-select @error('branch_id') is-invalid @enderror"
                                                                    name="branch_id" data-allow-clear="true">
                                                                    <option selected value="">-- أختر الفرع --
                                                                    </option>
                                                                    @foreach ($other['branches'] as $branch)
                                                                        <option
                                                                            @if (old('branch_id', $employee->id) == $branch->id) selected @endif
                                                                            value="{{ $branch->id }}">
                                                                            {{ $branch->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('branch_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>




                                                            <!-- تاريخ الميلاد -->
                                                            <div class="col-md-3">
                                                                <label class="form-label" for="birth_date-input">تاريخ
                                                                    الميلاد</label>
                                                                <input type="text" name="birth_date"
                                                                    id="birth_date-input"
                                                                    value="{{ old('birth_date', $employee->birth_date) }}"
                                                                    autocomplete="none"
                                                                    class="form-control date-picker @error('birth_date') is-invalid @enderror"
                                                                    placeholder="YYYY-MM-DD" />
                                                                @error('birth_date')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!--  رقم بطاقة الهوية -->
                                                            <div class="col-md-3 ">
                                                                <label class="form-label" for="national_id-input">
                                                                    رقم بطاقة الهوية </label>
                                                                <input type="text" id="national_id-input"
                                                                    value="{{ old('national_id', $employee->national_id) }}"
                                                                    class="form-control @error('national_id') is-invalid @enderror"
                                                                    name="national_id"
                                                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                    placeholder="مثال:الرقم القومى المكون من 14 رقم" />
                                                                @error('national_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                            <!--  مركز اصدار بطاقة الهوية -->
                                                            <div class="col-md-6 ">
                                                                <label class="form-label" for="national_id_place-input">
                                                                    مركز اصدار بطاقة الهوية </label>
                                                                <input type="text" id="national_id_place-input"
                                                                    value="{{ old('national_id_place', $employee->national_id_place) }}"
                                                                    class="form-control @error('national_id_place') is-invalid @enderror"
                                                                    name="national_id_place"
                                                                    placeholder="مثال:قسم الهرم" />
                                                                @error('national_id_place')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>



                                                            <!-- تاريخ انتهاء بطاقة الهوية -->
                                                            <div class="col-md-3">
                                                                <label class="form-label"
                                                                    for="end_national_id-input">تاريخ
                                                                    انتهاء بطاقة الهوية</label>
                                                                <input type="text" name="end_national_id"
                                                                    value="{{ old('end_national_id', $employee->end_national_id) }}"
                                                                    autocomplete="none" id="end_national_id-input"
                                                                    class="form-control date-picker @error('end_national_id') is-invalid @enderror"
                                                                    placeholder="YYYY-MM-DD" />
                                                                @error('end_national_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                            <!-- الحالة الأجتماعية -->
                                                            <div class="col-md-4">
                                                                <label for="exampleFormControlSelect1" class="form-label">
                                                                    الحالة الأجتماعية</label>
                                                                <select
                                                                    class="custom-select @error('social_status') is-invalid @enderror"
                                                                    name="social_status" id="social_status"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">-- أختر الحالة
                                                                        الأجتماعية --
                                                                    </option>
                                                                    @foreach (SocialStatus::cases() as $socialStatus)
                                                                        <option
                                                                            @if (old('social_status', $employee->social_status->value) == $socialStatus->value) selected @endif
                                                                            value="{{ $socialStatus->value }}">
                                                                            {{ $socialStatus->label() }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('social_status')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- عدد الأطفال -->
                                                            <div class="col-md-3" id="children_number_container"
                                                                style="display: none;">
                                                                <label class="form-label" for="children_number">عدد
                                                                    الأطفال</label>
                                                                <input type="text" id="children_number"
                                                                    value="{{ old('children_number', $employee->children_number) }}"
                                                                    class="form-control @error('children_number') is-invalid @enderror"
                                                                    name="children_number"
                                                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                    placeholder="مثال:1" />
                                                                @error('children_number')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- فصيلة الدم   -->
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="formtabs-country">فصيلة
                                                                    الدم </label>
                                                                <select name="blood_type_id"
                                                                    value="{{ old('blood_type_id', $employee->blood_type_id) }}"
                                                                    class="select2 custom-select @error('blood_type_id') is-invalid @enderror"
                                                                    data-allow-clear="true">
                                                                    <option selected value="">-- أختر نوع فصيلة الدم
                                                                        --
                                                                    </option>
                                                                    @foreach ($other['blood_types'] as $blood)
                                                                        <option
                                                                            @if (old('blood_type_id') == $blood->id) selected @endif
                                                                            value="{{ $blood->id }}">
                                                                            {{ $blood->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('blood_type_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- الجنسية  -->
                                                            <div class="col-md-4">
                                                                <label class="form-label"
                                                                    for="formtabs-country">الجنسية</label>
                                                                <select name="nationality_id"
                                                                    class="select2 custom-select @error('nationality_id') is-invalid @enderror"
                                                                    data-allow-clear="true">
                                                                    <option selected value="">-- أختر الجنسية --
                                                                    </option>
                                                                    @foreach ($other['nationalities'] as $nationality)
                                                                        <option
                                                                            @if (old('nationality_id', $employee->id) == $nationality->id) selected @endif
                                                                            value="{{ $nationality->id }}">
                                                                            {{ $nationality->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('nationality_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                            <!-- اللغة الاساسية التي يتحدث بها   -->
                                                            <div class="col-md-3">
                                                                <label class="form-label" for="formtabs-country">اللغة
                                                                    الاساسية التي يتحدث بها </label>
                                                                <select name="language_id"
                                                                    class="select2 custom-select @error('language_id') is-invalid @enderror"
                                                                    data-allow-clear="true">
                                                                    <option selected value="">-- أختر اللغة --
                                                                    </option>
                                                                    @foreach ($other['languages'] as $language)
                                                                        <option
                                                                            @if (old('language_id', $employee->id) == $language->id) selected @endif
                                                                            value="{{ $language->id }}">
                                                                            {{ $language->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('language_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                            <!-- الديانة -->
                                                            <div class="col-md-3 ">
                                                                <label for="exampleFormControlSelect1" class="form-label">
                                                                    الديانة</label>
                                                                <select
                                                                    class="custom-select @error('religion') is-invalid @enderror"
                                                                    name="religion" aria-label="Default select example">
                                                                    <option selected value="">-- أختر الديانة --
                                                                    </option>
                                                                    @foreach (ReligionEnum::cases() as $religion)
                                                                        <option
                                                                            @if (old('religion', $employee->religion->value) == $religion->value) selected @endif
                                                                            value="{{ $religion->value }}">
                                                                            {{ $religion->label() }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('religion')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                            <!-- البريد الالكتروني-->
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="formtabs-email">البريد
                                                                    الالكتروني</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" id="formtabs-email"
                                                                        name="email"
                                                                        value="{{ old('email', $employee->email) }}"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        placeholder="john.doe" aria-label="john.doe"
                                                                        aria-describedby="formtabs-email2" />
                                                                    <span class="input-group-text"
                                                                        id="formtabs-email2">@example.com</span>
                                                                </div>
                                                                @error('email')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- الدولة التابع لها الموظف   -->
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="formtabs-country">الدولة
                                                                    التابع لها الموظف</label>
                                                                <select name="country_id" id="country_id"
                                                                    class="select2 custom-select @error('country_id') is-invalid @enderror"
                                                                    data-allow-clear="true">
                                                                    <option selected value="">-- أختر الدولة --
                                                                    </option>
                                                                    @foreach ($other['countries'] as $country)
                                                                        <option
                                                                            @if (old('country_id', $employee->id) == $country->id) selected @endif
                                                                            value="{{ $country->id }}">
                                                                            {{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('country_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- المحافظة التابع لها الموظف   -->
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="formtabs-country">المحافظة
                                                                    التابع لها الموظف</label>
                                                                <select name="governorate_id" id="governorate_id"
                                                                    class="select2 custom-select @error('governorate_id') is-invalid @enderror"
                                                                    data-allow-clear="true">
                                                                    <option selected value="">-- أختر المحافظة --
                                                                    </option>
                                                                    @foreach ($other['governorates'] as $governorate)
                                                                        <option
                                                                            @if (old('governorate_id', $employee->id) == $governorate->id) selected @endif
                                                                            value="{{ $governorate->id }}">
                                                                            {{ $governorate->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('governorate_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- المدينة التابع لها الموظف   -->
                                                            <div class="col-md-4">
                                                                <label class="form-label"
                                                                    for="formtabs-country">المدينة/المركز</label>
                                                                <select name="city_id" id="city_id"
                                                                    class="select2 custom-select @error('city_id') is-invalid @enderror"
                                                                    data-allow-clear="true">
                                                                    <option selected value="">-- أختر المدينة/المركز
                                                                        --
                                                                    </option>
                                                                    @foreach ($other['cities'] as $city)
                                                                        <option
                                                                            @if (old('city_id', $employee->id) == $city->id) selected @endif
                                                                            value="{{ $city->id }}">
                                                                            {{ $city->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('city_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- عنوان الاقامة -->
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="address-input">
                                                                    عنوان الاقامة </label>
                                                                <input type="text" id="address-input"
                                                                    value="{{ old('address', $employee->address) }}"
                                                                    class="form-control @error('address') is-invalid @enderror"
                                                                    name="address" placeholder="مثال: شارع..." />
                                                                @error('address')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- هاتف المحمول-->
                                                            <div class="col-md-4 ">
                                                                <label class="form-label" for="mobile-input">
                                                                    هاتف المحمول</label>
                                                                <input type="text"
                                                                    value="{{ old('mobile', $employee->mobile) }}"
                                                                    class="form-control @error('mobile') is-invalid @enderror"
                                                                    name="mobile" id="mobile-input"
                                                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                    placeholder="658 799 8941" />
                                                                @error('mobile')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- هاتف المنزل-->
                                                            <div class="col-md-4 ">
                                                                <label class="form-label" for="home_telephone-input">
                                                                    هاتف المنزل</label>
                                                                <input type="text"
                                                                    value="{{ old('home_telephone', $employee->home_telephone) }}"
                                                                    class="form-control @error('home_telephone') is-invalid @enderror"
                                                                    name="home_telephone" id="home_telephone-input"
                                                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                    placeholder="028 799 8941" />
                                                                @error('home_telephone')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- هل يمتلك رخصة قيادة -->
                                                            <div class="col-md-4">
                                                                <label for="driving_license" class="form-label">هل يمتلك
                                                                    رخصة قيادة</label>
                                                                <select
                                                                    class="custom-select @error('driving_license') is-invalid @enderror"
                                                                    id="driving_license" name="driving_license"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">-- أختر الحالة --
                                                                    </option>
                                                                    @foreach (YesOrNoEnum::cases() as $license)
                                                                        <option
                                                                            @if (old('driving_license', $employee->driving_license->value) == $license->value) selected @endif
                                                                            value="{{ $license->value }}">
                                                                            {{ $license->label() }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('driving_license')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- رقم رخصة القيادة (مخفي بشكل افتراضي) -->
                                                            <div class="col-md-4" id="license_number_container"
                                                                style="display: none;">
                                                                <label class="form-label" for="driving_License_id">رقم
                                                                    رخصة القيادة</label>
                                                                <input type="text" id="driving_License_id"
                                                                    value="{{ old('driving_License_id', $employee->driving_License_id) }}"
                                                                    class="form-control @error('driving_License_id') is-invalid @enderror"
                                                                    name="driving_License_id"
                                                                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                    placeholder="مثال:123..." />
                                                                @error('driving_License_id')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- نوع رخصة القيادة (مخفي بشكل افتراضي) -->
                                                            <div class="col-md-4" id="license_type_container"
                                                                style="display: none;">
                                                                <label for="driving_license_type" class="form-label">نوع
                                                                    رخصة القيادة</label>
                                                                <select
                                                                    class="custom-select @error('driving_license_type') is-invalid @enderror"
                                                                    id="driving_license_type" name="driving_license_type"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">-- أختر النوع --
                                                                    </option>
                                                                    @foreach (DrivingLicenseType::cases() as $licenseType)
                                                                        <option
                                                                            @if (old('driving_license_type', $employee->driving_license_type->value) == $licenseType->value) selected @endif
                                                                            value="{{ $licenseType->value }}">
                                                                            {{ $licenseType->label() }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('driving_license_type')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                            <!-- هل يمتلك أقارب بالعمل -->
                                                            <div class="col-md-4">
                                                                <label for="has_relatives" class="form-label">هل يمتلك
                                                                    أقارب بالعمل</label>
                                                                <select
                                                                    class="custom-select @error('has_relatives') is-invalid @enderror"
                                                                    id="has_relatives" name="has_relatives"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">-- أختر الحالة --
                                                                    </option>
                                                                    @foreach (YesOrNoEnum::cases() as $relatives)
                                                                        <option
                                                                            @if (old('has_relatives', $employee->has_relatives->value) == $relatives->value) selected @endif
                                                                            value="{{ $relatives->value }}">
                                                                            {{ $relatives->label() }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('has_relatives')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- تفاصيل الاقارب (مخفي بشكل افتراضي) -->
                                                            <div class="col-md-12" id="relatives_details_container"
                                                                style="display: none;">
                                                                <label class="form-label" for="relatives_details">تفاصيل
                                                                    الاقارب</label>
                                                                <input type="text" id="relatives_details"
                                                                    value="{{ old('relatives_details', $employee->relatives_details) }}"
                                                                    class="form-control @error('relatives_details') is-invalid @enderror"
                                                                    name="relatives_details"
                                                                    placeholder="أدخل أسماء الأقارب وطبيعة عملهم" />
                                                                @error('relatives_details')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- هل يمتلك اعاقة / عمليات سابقة -->
                                                            <div class="col-md-3">
                                                                <label for="has_disabilities" class="form-label">هل يمتلك
                                                                    اعاقة / عمليات سابقة</label>
                                                                <select
                                                                    class="custom-select @error('has_disabilities') is-invalid @enderror"
                                                                    id="has_disabilities" name="has_disabilities"
                                                                    aria-label="Default select example">
                                                                    <option selected value="">-- أختر الحالة --
                                                                    </option>
                                                                    @foreach (YesOrNoEnum::cases() as $disabilities)
                                                                        <option
                                                                            @if (old('has_disabilities', $employee->has_disabilities->value) == $disabilities->value) selected @endif
                                                                            value="{{ $disabilities->value }}">
                                                                            {{ $disabilities->label() }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('has_disabilities')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- تفاصيل الاعاقة / عمليات سابقة (مخفي بشكل افتراضي) -->
                                                            <div class="col-md-12" id="disabilities_details_container"
                                                                style="display: none;">
                                                                <label class="form-label"
                                                                    for="disabilities_details">تفاصيل الاعاقة / عمليات
                                                                    سابقة</label>
                                                                <input type="text" id="disabilities_details"
                                                                    value="{{ old('disabilities_details', $employee->disabilities_details) }}"
                                                                    class="form-control @error('disabilities_details') is-invalid @enderror"
                                                                    name="disabilities_details"
                                                                    placeholder="أدخل تفاصيل الإعاقة أو العمليات السابقة" />
                                                                @error('disabilities_details')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <!-- ملاحظات علي الموظف -->
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="notes-input">
                                                                    ملاحظات علي الموظف </label>
                                                                <input type="text" id="notes-input"
                                                                    value="{{ old('notes', $employee->notes) }}"
                                                                    class="form-control @error('notes') is-invalid @enderror"
                                                                    name="notes" placeholder="John" />
                                                                @error('notes')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>



                                                        </div>
                                                </div>

                                                <!-- بيانات الخدمة العسكرية -->
                                                <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                                                    <div class="row g-3">
                                                        <!-- حالة الخدمة العسكرية -->
                                                        <div class="col-md-6">
                                                            <label for="military_status" class="form-label">حالة الخدمة
                                                                العسكرية</label>
                                                            <select
                                                                class="custom-select @error('military') is-invalid @enderror"
                                                                id="military_status" name="military"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --</option>
                                                                @foreach (Military::cases() as $military)
                                                                    <option
                                                                        @if (old('military', $employee->fp_code) == $military->value) selected @endif
                                                                        value="{{ $military->value }}">
                                                                        {{ $military->label() }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('military')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- الحقول المخفية بشكل افتراضي -->
                                                        <div id="exemption_temporary_fields" style="display: none;">
                                                            <!-- تاريخ اعفاء الخدمة العسكرية -->
                                                            <div class="col-md-6">
                                                                <label class="form-label"
                                                                    for="military_exemption_date">تاريخ اعفاء الخدمة
                                                                    العسكرية</label>
                                                                <input type="text" name="military_exemption_date"
                                                                    value="{{ old('military_exemption_date', $employee->fp_code) }}"
                                                                    id="military_exemption_date" autocomplete="none"
                                                                    class="form-control date-picker @error('military_exemption_date') is-invalid @enderror"
                                                                    placeholder="YYYY-MM-DD" />
                                                                @error('military_exemption_date', $employee->fp_code)
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- سبب ومدة تأجيل الخدمة العسكرية -->
                                                            <div class="col-md-6">
                                                                <label class="form-label"
                                                                    for="military_postponement_reason">سبب ومدة تأجيل
                                                                    الخدمة العسكرية</label>
                                                                <input type="text" id="military_postponement_reason"
                                                                    value="{{ old('military_postponement_reason', $employee->fp_code) }}"
                                                                    class="form-control @error('military_postponement_reason') is-invalid @enderror"
                                                                    name="military_postponement_reason"
                                                                    placeholder="أذكر السبب والمدة" />
                                                                @error('military_postponement_reason')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div id="final_exemption_fields" style="display: none;">
                                                            <!-- تاريخ اعفاء الخدمة العسكرية -->
                                                            <div class="col-md-6">
                                                                <label class="form-label"
                                                                    for="military_exemption_date_final">تاريخ اعفاء الخدمة
                                                                    العسكرية</label>
                                                                <input type="text" name="military_exemption_date"
                                                                    value="{{ old('military_exemption_date', $employee->fp_code) }}"
                                                                    id="military_exemption_date_final" autocomplete="none"
                                                                    class="form-control date-picker @error('military_exemption_date') is-invalid @enderror"
                                                                    placeholder="YYYY-MM-DD" />
                                                                @error('military_exemption_date')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- سبب اعفاء الخدمة العسكرية -->
                                                            <div class="col-md-6">
                                                                <label class="form-label"
                                                                    for="military_exemption_reason">سبب اعفاء الخدمة
                                                                    العسكرية</label>
                                                                <input type="text" id="military_exemption_reason"
                                                                    value="{{ old('military_exemption_reason', $employee->fp_code) }}"
                                                                    class="form-control @error('military_exemption_reason') is-invalid @enderror"
                                                                    name="military_exemption_reason"
                                                                    placeholder="أذكر السبب" />
                                                                @error('military_exemption_reason')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div id="complete_service_fields" style="display: none;">
                                                            <!-- تاريخ بداية الخدمة العسكرية -->
                                                            <div class="col-md-6">
                                                                <label class="form-label"
                                                                    for="military_service_start_date">تاريخ بداية الخدمة
                                                                    العسكرية</label>
                                                                <input type="text" name="military_service_start_date"
                                                                    id="military_service_start_date" autocomplete="none"
                                                                    value="{{ old('military_service_start_date', $employee->fp_code) }}"
                                                                    class="form-control date-picker @error('military_service_start_date') is-invalid @enderror"
                                                                    placeholder="YYYY-MM-DD" />
                                                                @error('military_service_start_date')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- تاريخ نهاية الخدمة العسكرية -->
                                                            <div class="col-md-6">
                                                                <label class="form-label"
                                                                    for="military_service_end_date">تاريخ نهاية الخدمة
                                                                    العسكرية</label>
                                                                <input type="text" name="military_service_end_date"
                                                                    id="military_service_end_date" autocomplete="none"
                                                                    value="{{ old('military_service_end_date', $employee->fp_code) }}"
                                                                    class="form-control date-picker @error('military_service_end_date') is-invalid @enderror"
                                                                    placeholder="YYYY-MM-DD" />
                                                                @error('military_service_end_date')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!-- سلاح الخدمة العسكرية -->
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="military_weapon">سلاح
                                                                    الخدمة العسكرية</label>
                                                                <input type="text" id="military_weapon"
                                                                    value="{{ old('military_weapon', $employee->fp_code) }}"
                                                                    class="form-control @error('military_weapon') is-invalid @enderror"
                                                                    name="military_weapon"
                                                                    placeholder="مثال: سلاح المشاة" />
                                                                @error('military_weapon')
                                                                    <span class="invalid-feedback text-right" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <!--  بيانات وظيفية -->
                                                <div class="tab-pane fade" id="form-tabs-social" role="tabpanel">
                                                    <div class="row g-3">


                                                        <!-- تاريخ التعيين -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="hiring_date-input">تاريخ
                                                                التعيين
                                                            </label>
                                                            <input type="text" name="hiring_date"
                                                                id="hiring_date-input"
                                                                value="{{ old('hiring_date', $employee->fp_code) }}"
                                                                autocomplete="none"
                                                                class="form-control date-picker @error('hiring_date') is-invalid @enderror"
                                                                placeholder="YYYY-MM-DD" />
                                                            @error('hiring_date')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- الحالة الوظيفية -->
                                                        <div class="col-md-4 ">
                                                            <label for="functional_status-input" class="form-label">
                                                                الحالة الوظيفية
                                                            </label>
                                                            <select
                                                                class="custom-select @error('functional_status') is-invalid @enderror"
                                                                name="functional_status" id="functional_status-input"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --
                                                                </option>
                                                                @foreach (FunctionalStatus::cases() as $functional)
                                                                    <option
                                                                        @if (old('functional_status', $employee->fp_code) == $functional->value) selected @endif
                                                                        value="{{ $functional->value }}">
                                                                        {{ $functional->label() }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('functional_status')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <!-- الدرجه الوظيفية -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="job_grade_id-input">الدرجه
                                                                الوظيفية</label>
                                                            <select name="job_grade_id" id="job_grade_id-input"
                                                                class="select2 custom-select @error('job_grade_id') is-invalid @enderror"
                                                                data-allow-clear="true">
                                                                <option selected value="">-- أختر الدرجه --</option>
                                                                </option>
                                                                @foreach ($other['job_grades'] as $jobGrade)
                                                                    <option
                                                                        @if (old('job_grade_id', $employee->fp_code) == $jobGrade->id) selected @endif
                                                                        value="{{ $jobGrade->id }}">
                                                                        {{ $jobGrade->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('job_grade_id')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <!-- الادارة -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="department_id-input">الادارة
                                                                التابع لها الموظف</label>
                                                            <select
                                                                class="select2 custom-select @error('department_id') is-invalid @enderror"
                                                                name="department_id" data-allow-clear="true"
                                                                id="department_id-input">
                                                                <option selected value="">-- أختر الادارة --
                                                                </option>
                                                                @foreach ($other['departments'] as $branch)
                                                                    <option
                                                                        @if (old('department_id', $employee->fp_code) == $branch->id) selected @endif
                                                                        value="{{ $branch->id }}">
                                                                        {{ $branch->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('department_id')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!--  وظيفة الموظف -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="job_category_id-input">وظيفة
                                                                الموظف</label>
                                                            <select name="job_category_id" id="job_category_id-input"
                                                                class="select2 custom-select @error('job_category_id') is-invalid @enderror"
                                                                data-allow-clear="true">
                                                                <option selected value="">-- أختر الوظيفة --
                                                                </option>
                                                                @foreach ($other['job_categories'] as $jobCategory)
                                                                    <option
                                                                        @if (old('job_category_id', $employee->fp_code) == $jobCategory->id) selected @endif
                                                                        value="{{ $jobCategory->id }}">
                                                                        {{ $jobCategory->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('job_category_id')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <!-- هل له بصمة حضور وانصراف -->
                                                        <div class="col-md-4">
                                                            <label for="has_attendance-input" class="form-label">
                                                                هل له بصمة حضور وانصراف
                                                            </label>
                                                            <select id="has_attendance-input"
                                                                class="custom-select @error('has_attendance') is-invalid @enderror"
                                                                name="has_attendance" aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --
                                                                </option>
                                                                @foreach (YesOrNoEnum::cases() as $attendance)
                                                                    <option
                                                                        @if (old('has_attendance', $employee->fp_code) == $attendance->value) selected @endif
                                                                        value="{{ $attendance->value }}">
                                                                        {{ $attendance->label() }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('has_attendance')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <!-- هل شفت ثابت -->
                                                        <div class="col-md-3">
                                                            <label for="has_fixed_shift" class="form-label">هل شفت
                                                                ثابت</label>
                                                            <select
                                                                class="custom-select @error('has_fixed_shift') is-invalid @enderror"
                                                                id="has_fixed_shift" name="has_fixed_shift"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --</option>
                                                                @foreach (YesOrNoEnum::cases() as $fixedShift)
                                                                    <option
                                                                        @if (old('has_fixed_shift', $employee->fp_code) == $fixedShift->value) selected @endif
                                                                        value="{{ $fixedShift->value }}">
                                                                        {{ $fixedShift->label() }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('has_fixed_shift')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- أنواع الشفتات (مخفي بشكل افتراضي) -->
                                                        <div class="col-md-6" id="shifts_type_container"
                                                            style="display: none;">
                                                            <label for="shifts_type_id" class="form-label">أنواع
                                                                الشفتات</label>
                                                            <select
                                                                class="custom-select @error('shifts_type_id') is-invalid @enderror"
                                                                id="shifts_type_id" name="shifts_type_id"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر النوع --</option>
                                                                @foreach ($other['shifts_types'] as $shift)
                                                                    <option
                                                                        @if (old('shifts_type_id', $employee->fp_code) == $shift->id) selected @endif
                                                                        value="{{ $shift->id }}">
                                                                        {{ $shift->type->label() }} من
                                                                        ({{ Carbon::createFromFormat('H:i:s', $shift->from_time)->format('H:i') }})
                                                                        إلى
                                                                        ({{ Carbon::createFromFormat('H:i:s', $shift->to_time)->format('H:i') }})عدد
                                                                        الساعات {{ $shift->total_hours }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('shifts_type_id')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <!-- عدد ساعات العمل اليومي-->
                                                        <div class="col-md-3 ">
                                                            <label class="form-label" for="daily_work_hour-input">
                                                                عدد ساعات العمل اليومي</label>
                                                            <input type="text" id="daily_work_hour-input"
                                                                value="{{ old('daily_work_hour', $employee->fp_code) }}"
                                                                class="form-control @error('daily_work_hour') is-invalid @enderror"
                                                                name="daily_work_hour"
                                                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                placeholder="مثال:8" />
                                                            @error('daily_work_hour')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- راتب الموظف الشهري -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="monthly_salary">
                                                                راتب الموظف الشهري
                                                            </label>
                                                            <input type="text" id="monthly_salary"
                                                                value="{{ old('salary', $employee->fp_code) }}"
                                                                class="form-control @error('salary') is-invalid @enderror"
                                                                name="salary"
                                                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                placeholder="مثال:3000" />
                                                            @error('salary')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- راتب الموظف اليومى -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="daily_salary">
                                                                راتب الموظف اليومى
                                                            </label>
                                                            <input type="text" id="daily_salary"
                                                                value="{{ old('day_price', $employee->fp_code) }}"
                                                                class="form-control @error('day_price') is-invalid @enderror"
                                                                name="day_price" placeholder="مثال:100" />
                                                            @error('day_price')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- عملة قبض الموظف -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="currency_id-input">عملة قبض
                                                                الموظف
                                                            </label>
                                                            <select name="currency_id" id="currency_id-input"
                                                                class="select2 custom-select @error('currency_id') is-invalid @enderror"
                                                                data-allow-clear="true">
                                                                <option selected value="">-- أختر العملة --
                                                                </option>
                                                                @foreach ($other['currencies'] as $currency)
                                                                    <option
                                                                        @if (old('currency_id', $employee->fp_code) == $currency->id) selected @endif
                                                                        value="{{ $currency->id }}">
                                                                        {{ $currency->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('currency_id')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!--  هل له تأمين اجتماعي -->
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="has_social_insurance">
                                                                هل له تأمين اجتماعي</label>
                                                            <select id="has_social_insurance"
                                                                class="custom-select @error('has_social_insurance') is-invalid @enderror"
                                                                name="has_social_insurance"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --
                                                                </option>
                                                                @foreach (YesOrNoEnum::cases() as $social)
                                                                    <option
                                                                        @if (old('has_social_insurance', $employee->fp_code) == $social->value) selected @endif
                                                                        value="{{ $social->value }}">
                                                                        {{ $social->label() }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('has_social_insurance')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- قيمة التأمين الاجتماعي المستقطع شهرياً -->
                                                        <div class="col-md-5" style="display: none;"
                                                            id="social_insurance_fields">
                                                            <label class="form-label"
                                                                for="social_insurance_cut_monthely-input">
                                                                قيمة التأمين الاجتماعي المستقطع شهرياً </label>
                                                            <input type="text" id="social_insurance_cut_monthely-input"
                                                                value="{{ old('social_insurance_cut_monthely', $employee->fp_code) }}"
                                                                class="form-control @error('social_insurance_cut_monthely') is-invalid @enderror"
                                                                name="social_insurance_cut_monthely"
                                                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                placeholder="مثال:500" />
                                                            @error('social_insurance_cut_monthely')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- رقم التامين الاجتماعي للموظف -->
                                                        <div class="col-md-4" style="display: none;"
                                                            id="social_insurance_value">
                                                            <label class="form-label" for="social_insurance_number-input">
                                                                رقم التامين الاجتماعي للموظف </label>
                                                            <input type="text" id="social_insurance_number-input"
                                                                value="{{ old('social_insurance_number', $employee->fp_code) }}"
                                                                class="form-control @error('social_insurance_number') is-invalid @enderror"
                                                                name="social_insurance_number"
                                                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                placeholder="مثال:123..." />
                                                            @error('social_insurance_number')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <!--  هل له تأمين طبي -->
                                                        <div class="col-md-3">
                                                            <label class="form-label" for="has_medical_insurance">
                                                                هل له تأمين طبي</label>
                                                            <select id="has_medical_insurance"
                                                                class="custom-select @error('has_medical_insurance') is-invalid @enderror"
                                                                name="has_medical_insurance"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --
                                                                </option>
                                                                @foreach (YesOrNoEnum::cases() as $medical)
                                                                    <option
                                                                        @if (old('has_medical_insurance', $employee->fp_code) == $medical->value) selected @endif
                                                                        value="{{ $medical->value }}">
                                                                        {{ $medical->label() }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('has_medical_insurance')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- قيمة التأمين الطبي المستقطع شهرياً -->
                                                        <div class="col-md-5" style="display: none;"
                                                            id="medical_insurance_fields">
                                                            <label class="form-label" for="has_social_insurance">
                                                                قيمة التأمين الطبي المستقطع شهرياً </label>
                                                            <input type="text" id="has_social_insurance"
                                                                value="{{ old('medical_insurance_cut_monthely', $employee->fp_code) }}"
                                                                class="form-control @error('medical_insurance_cut_monthely') is-invalid @enderror"
                                                                name="medical_insurance_cut_monthely"
                                                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                placeholder="مثال:500" />
                                                            @error('medical_insurance_cut_monthely')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- رقم التامين الطبي للموظف -->
                                                        <div class="col-md-4" style="display: none;"
                                                            id="medical_insurance_value">
                                                            <label class="form-label" for="medical_insurance_number">
                                                                رقم التامين الطبي للموظف </label>
                                                            <input type="text" id="medical_insurance_number"
                                                                value="{{ old('medical_insurance_number', $employee->fp_code) }}"
                                                                class="form-control @error('medical_insurance_number') is-invalid @enderror"
                                                                name="medical_insurance_number"
                                                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                placeholder="مثال:123..." />
                                                            @error('medical_insurance_number')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <!--  نوع صرف راتب الموظف -->
                                                        <div class="col-md-3 ">
                                                            <label class="form-label" for="type_salary_receipt">
                                                                نوع صرف راتب الموظف</label>
                                                            <select
                                                                class="custom-select @error('type_salary_receipt') is-invalid @enderror"
                                                                name="type_salary_receipt" id="type_salary_receipt"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --
                                                                </option>
                                                                @foreach (TypeSalaryReceipt::cases() as $salary)
                                                                    <option
                                                                        @if (old('type_salary_receipt', $employee->fp_code) == $salary->value) selected @endif
                                                                        value="{{ $salary->value }}">
                                                                        {{ $salary->label() }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('type_salary_receipt')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- هل له بدلات ثابتة  -->
                                                        <div class="col-md-3 ">
                                                            <label class="form-label" for="has_fixed_allowances">
                                                                هل له بدلات ثابتة</label>
                                                            <select
                                                                class="custom-select @error('has_fixed_allowances') is-invalid @enderror"
                                                                name="has_fixed_allowances" id="has_fixed_allowances"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --
                                                                </option>
                                                                @foreach (YesOrNoEnum::cases() as $allowances)
                                                                    <option
                                                                        @if (old('has_fixed_allowances', $employee->fp_code) == $allowances->value) selected @endif
                                                                        value="{{ $allowances->value }}">
                                                                        {{ $allowances->label() }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('has_fixed_allowances')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <!--  هل له حافز -->
                                                        <div class="col-md-3 ">
                                                            <label class="form-label" for="motivation_type">
                                                                هل له حافز</label>
                                                            <select
                                                                class="custom-select @error('motivation_type') is-invalid @enderror"
                                                                name="motivation_type" id="motivation_type"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --
                                                                </option>
                                                                @foreach (MotivationType::cases() as $motivation)
                                                                    <option
                                                                        @if (old('motivation_type', $employee->fp_code) == $motivation->value) selected @endif
                                                                        value="{{ $motivation->value }}">
                                                                        {{ $motivation->label() }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('motivation_type')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- قيمة الحافز الشهري الثابت -->
                                                        <div class="col-md-3" style="display: none;"
                                                            id="fixed_motivation_value">
                                                            <label class="form-label" for="motivation_value">
                                                                قيمة الحافز الشهري الثابت </label>
                                                            <input type="text" id=""
                                                                value="{{ old('motivation_value', $employee->fp_code) }}"
                                                                class="form-control @error('motivation_value') is-invalid @enderror"
                                                                name="motivation_value" id="motivation_value"
                                                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                placeholder="مثال:500" />
                                                            @error('motivation_value')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <!--  هل له رصيد اجازات سنوي -->
                                                        <div class="col-md-3 ">
                                                            <label class="form-label" for="has_vacation_balance">
                                                                هل له رصيد اجازات سنوي</label>
                                                            <select
                                                                class="custom-select @error('has_vacation_balance') is-invalid @enderror"
                                                                name="has_vacation_balance" id="has_vacation_balance"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة --
                                                                </option>
                                                                @foreach (YesOrNoEnum::cases() as $vacation)
                                                                    <option
                                                                        @if (old('has_vacation_balance', $employee->fp_code) == $vacation->value) selected @endif
                                                                        value="{{ $vacation->value }}">
                                                                        {{ $vacation->label() }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('has_vacation_balance')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>




                                                    </div>
                                                    <div class="pt-4">

                                                    </div>
                                                </div>

                                                <!--  بيانات إضافية -->
                                                <div class="tab-pane fade" id="form-tabs-addtional" role="tabpanel">
                                                    <div class="row g-3">
                                                        <!-- شخص يمكن الرجوع اليه للضرورة -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="urgent_person_details">
                                                                شخص يمكن الرجوع اليه للضرورة </label>
                                                            <input type="text" id="urgent_person_details"
                                                                value="{{ old('urgent_person_details', $employee->fp_code) }}"
                                                                class="form-control @error('urgent_person_details') is-invalid @enderror"
                                                                name="urgent_person_details" placeholder="John" />
                                                            @error('urgent_person_details')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <!-- رقم الباسبور ان وجد -->
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="has_social_insurance">
                                                                رقم الباسبور ان وجد</label>
                                                            <input type="text" id=""
                                                                value="{{ old('pasport_identity') }}"
                                                                class="form-control @error('pasport_identity') is-invalid @enderror"
                                                                name="pasport_identity"
                                                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                                                placeholder="مثال:123..." />
                                                            @error('pasport_identity')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <!-- تاريخ انتهاء الباسبور -->
                                                        <div class="col-md-4">
                                                            <label class="form-label">تاريخ
                                                                انتهاء الباسبور
                                                            </label>
                                                            <input type="text" name="pasport_exp_date"
                                                                value="{{ old('pasport_exp_date', $employee->fp_code) }}"
                                                                autocomplete="none"
                                                                class="form-control date-picker @error('pasport_exp_date') is-invalid @enderror"
                                                                placeholder="YYYY-MM-DD" />
                                                            @error('pasport_exp_date')
                                                                <span class="invalid-feedback text-right" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            {{-- <x-image-preview name="photo" title="أرفق صورة الموظف" /> --}}
                                                            <label for="formFile" class="form-label">ارف صورة
                                                                الموظف</label>
                                                            <input class="form-control" name="photo" type="file"
                                                                id="formFile">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="formFile" class="form-label">أرفاق السيرة
                                                                الذاتية</label>
                                                            <input class="form-control" name="cv" type="file"
                                                                id="formFile">
                                                        </div>
                                                    </div>
                                                    <div class="pt-4">

                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /.card-body -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: '-- أختر --',
                allowClear: true,
                width: '100%' // مهم جدًا عشان التنسيق
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.date-picker').flatpickr({
                dateFormat: "Y-m-d",
                allowInput: true,
                appendTo: document.body
            });
        });
    </script>
    <!-- Vendors JS -->
    <script src="{{ asset('dashboard') }}/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="{{ asset('dashboard') }}/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="{{ asset('dashboard') }}/assets/vendor/libs/moment/moment.js"></script>
    <script src="{{ asset('dashboard') }}/assets/vendor/libs/select2/select2.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/employees/create-scripts.js"></script>

    <!-- filepond -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var submitButton = document.getElementById('submitButton');
            var form = document.getElementById('storeForm');

            // لما تضغط على الزر
            submitButton.addEventListener('click', function(e) {
                e.preventDefault(); // نمنع الإفتراضي لو كان الزر داخل الفورم
                form.submit();
            });

            // عند إرسال الفورم
            form.addEventListener('submit', function(event) {
                submitButton.disabled = true;
                submitButton.innerHTML = 'جاري الحفظ...';
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#country_id').change(function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: '/dashboard/employees/get-governorates/' +
                            countryId, // أضيف '/' في البداية
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#governorate_id').empty();
                            $('#governorate_id').append(
                                '<option value="">-- أختر المحافظة --</option>');
                            $.each(data, function(key, value) {
                                $('#governorate_id').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                            $('#governorate_id').trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error); // لتتبع الأخطاء
                        }
                    });
                } else {
                    $('#governorate_id').empty();
                    $('#governorate_id').append('<option value="">-- أختر المحافظة --</option>');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#governorate_id').change(function() {
                var governorateId = $(this).val();
                if (governorateId) {
                    $.ajax({
                        url: '/dashboard/employees/get-cities/' +
                            governorateId, // أضيف '/' في البداية
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#city_id').empty();
                            $('#city_id').append(
                                '<option value="">-- أختر المدينه --</option>');
                            $.each(data, function(key, value) {
                                $('#city_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                            $('#city_id').trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error); // لتتبع الأخطاء
                        }
                    });
                } else {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">-- أختر المدينه --</option>');
                }
            });
        });
    </script>
@endpush
