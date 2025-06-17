@php
    use App\Enums\StatusActiveEnum;
    use App\Models\Currency;
    use App\Models\City;
    use App\Models\Country;
    use App\Models\Language;
    use App\Models\Governorate;
    use App\Models\JobCategory;
    use App\Models\Nationality;
    use App\Models\Qualification;
    use App\Models\Department;
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
@section('title', 'عرض بيانات الموظف ' . $employee->nam)
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2-style.css" />

    <!-- مكتبة Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- ستايل إضافي للغة العربية -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/flatpicker.css">
    <style>
        /* تحسين مظهر التبويبات */
        .nav-tabs .nav-link {
            font-weight: 600;
            padding: 0.8rem 1.5rem;
            color: #6c757d;
            border-top: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #4e73df;
            background-color: #fff;
            border-top-color: #4e73df;
            border-bottom-color: #dee2e6;
        }

        /* تحسين مظهر البطاقة */
        .card-primary.card-outline {
            border-top: 3px solid #4e73df;
        }
    </style>
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بيانات ' . $employee->name,
        'previousPage' => 'الموظفين',
        'currentPage' => 'عرض بيانات الموظف',
        'url' => 'employees.index',
    ])


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark card-outline mb-4">
                        <!--begin::Header-->
                        <!-- تبويبات النموذج -->
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="employee-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="personal-tab" data-toggle="pill" href="#personal"
                                        role="tab">
                                        <i class="fas fa-user mr-1"></i> بيانات شخصية
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="military-tab" data-toggle="pill" href="#military"
                                        role="tab">
                                        <i class="fas fa-shield-alt mr-1"></i> بيانات الخدمة العسكرية
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="job-tab" data-toggle="pill" href="#job" role="tab">
                                        <i class="fas fa-briefcase mr-1"></i> بيانات وظيفية
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="additional-tab" data-toggle="pill" href="#additional"
                                        role="tab">
                                        <i class="fas fa-info-circle mr-1"></i> بيانات إضافية
                                    </a>
                                </li>
                            </ul>
                            <div class="col-md-12">
                                <div class="card-body">



                                    <form action="{{ route('dashboard.employees.update', $employee->slug) }}" method="POST"
                                        id="updateForm" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        @csrf
                                        <div class="tab-content" id="employee-tabs-content">
                                            <!-- تبويب البيانات الشخصية -->
                                            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                                <div class="row g-3">
                                                    <!-- كود البصمة -->
                                                    <div class="col-md-3 ">
                                                        <label class="form-label" for="fp_code-input">كود بصمة
                                                            الموظف</label>
                                                        <input disabled type="text" class="form-control bg-white"
                                                            name="fp_code" value="{{ old('fp_code', $employee->fp_code) }}"
                                                            id="fp_code-input" />

                                                    </div>
                                                    <!-- الأسم -->
                                                    <div class="col-md-6 ">
                                                        <label class="form-label" for="name-input">اسم
                                                            الموظف بالكامل <span class="text-danger">*</span></label>
                                                        <input disabled type="text" name="name"
                                                            value="{{ old('name', $employee->name) }}" id="name-input"
                                                            class="form-control bg-white" />
                                                    </div>

                                                    <!-- الجنس -->
                                                    <div class="col-md-3 ">
                                                        <label for="gender-input" class="form-label">نوع
                                                            الجنس</label>
                                                        <select disabled id="gender-input" class="form-select  bg-white"
                                                            name="gender" aria-label="Default select example">
                                                            <option selected value="">-- أختر نوع الجنس--</option>
                                                            @foreach (AdminGenderEnum::cases() as $gender)
                                                                <option value="{{ $gender->value }}"
                                                                    @if (old('gender', $employee->gender->value) == $gender->value) selected @endif>
                                                                    {{ $gender->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!--  سنة التخرج -->
                                                    <div class="col-md-3 ">
                                                        <label class="form-label" for="qualification_year-input">
                                                            سنة التخرج </label>
                                                        <input disabled type="text" id="qualification_year-input"
                                                            value="{{ old('qualification_year', $employee->qualification_year) }}"
                                                            class="form-control bg-white" name="qualification_year"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />
                                                    </div>

                                                    <!-- المؤهل الدراسي  -->
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="qualification_id-input">المؤهل
                                                            الدراسي</label>
                                                        <select disabled name="qualification_id"
                                                            class="form-select  bg-white qualification_select2"
                                                            data-allow-clear="true">
                                                            @if (old('qualification_id') || isset($employee->qualification_id))
                                                                <option
                                                                    value="{{ old('qualification_id', $employee->qualification_id ?? '') }}"
                                                                    selected>
                                                                    {{ Qualification::find(old('qualification_id', $employee->qualification_id))->name }}
                                                                </option>
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <!-- تقدير التخرج -->
                                                    <div class="col-md-3 ">
                                                        <label for="exampleFormControlSelect1" class="form-label">
                                                            تقدير التخرج</label>
                                                        <select disabled class="form-select  bg-white"
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

                                                    </div>

                                                    <!-- تخصص  التخرج -->
                                                    <div class="col-md-3 ">
                                                        <label for="major-input" class="form-label">
                                                            تخصص التخرج</label>
                                                        <input disabled type="text" id="major-input"
                                                            value="{{ old('major', $employee->major) }}"
                                                            class="form-control bg-white" name="major" />
                                                    </div>

                                                    <!-- الفرع -->
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="formtabs-country">الفرع
                                                            التابع له الموظف</label>
                                                        <select disabled class="select2 form-select  bg-white"
                                                            name="branch_id" data-allow-clear="true">
                                                            <option selected value="">-- أختر الفرع -- </option>
                                                            @foreach ($other['branches'] as $branch)
                                                                <option @if (old('branch_id', $employee->branch_id) == $branch->id) selected @endif
                                                                    value="{{ $branch->id }}">
                                                                    {{ $branch->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <!-- تاريخ الميلاد -->
                                                    <div class="col-md-3">
                                                        <label for="birth_date" class="form-label">تاريخ الميلاد</label>
                                                        <div class="input-group">
                                                            <input disabled type="text" id="birth_date"
                                                                value="{{ old('birth_date', $employee->birth_date) }}"
                                                                class="form-control bg-white" name="birth_date" />
                                                        </div>
                                                    </div>

                                                    <!--  رقم بطاقة الهوية -->
                                                    <div class="col-md-3 ">
                                                        <label class="form-label" for="national_id-input">
                                                            رقم بطاقة الهوية </label>
                                                        <input disabled type="text" id="national_id-input"
                                                            value="{{ old('national_id', $employee->national_id) }}"
                                                            class="form-control bg-white" name="national_id"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />
                                                    </div>


                                                    <!--  مركز اصدار بطاقة الهوية -->
                                                    <div class="col-md-6 ">
                                                        <label class="form-label" for="national_id_place-input">
                                                            مركز اصدار بطاقة الهوية </label>
                                                        <input disabled type="text" id="national_id_place"
                                                            value="{{ old('national_id_place', $employee->national_id_place) }}"
                                                            class="form-control bg-white" name="national_id_place" />

                                                    </div>


                                                    <!-- تاريخ انتهاء بطاقة الهوية -->
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="end_national_id-input">تاريخ
                                                            انتهاء بطاقة الهوية</label>
                                                        <input disabled type="text" id="end_national_id"
                                                            value="{{ old('end_national_id', $employee->end_national_id) }}"
                                                            class="form-control bg-white" name="end_national_id" />
                                                    </div>


                                                    <!-- الحالة الأجتماعية -->
                                                    <div class="col-md-4">
                                                        <label for="exampleFormControlSelect1" class="form-label">
                                                            الحالة الأجتماعية</label>
                                                        <select disabled class="form-select  bg-white"
                                                            name="social_status" id="social_status"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر الحالة الأجتماعية --
                                                            </option>
                                                            @foreach (SocialStatus::cases() as $socialStatus)
                                                                <option @if (old('social_status', $employee->social_status->value) == $socialStatus->value) selected @endif
                                                                    value="{{ $socialStatus->value }}">
                                                                    {{ $socialStatus->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- عدد الأطفال -->
                                                    <div class="col-md-3" id="children_number_container"
                                                        style="display: none;">
                                                        <label class="form-label" for="children_number">عدد
                                                            الأطفال</label>
                                                        <input disabled type="text" id="children_number"
                                                            value="{{ old('children_number', $employee->children_number) }}"
                                                            class="form-control bg-white " name="children_number"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>

                                                    <!-- فصيلة الدم   -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="formtabs-country">فصيلة
                                                            الدم </label>
                                                        <select disabled name="blood_type_id"
                                                            value="{{ old('blood_type_id') }}"
                                                            class="select2 form-select  bg-white "
                                                            data-allow-clear="true">
                                                            <option selected value="">-- أختر نوع فصيلة الدم --
                                                            </option>
                                                            @foreach ($other['blood_types'] as $blood)
                                                                <option @if (old('blood_type_id', $employee->blood_type_id) == $blood->id) selected @endif
                                                                    value="{{ $blood->id }}">
                                                                    {{ $blood->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- الجنسية  -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="formtabs-country">الجنسية</label>
                                                        <select disabled name="nationality_id"
                                                            class="select2 form-select  bg-white nationality_select2 "
                                                            data-allow-clear="true">

                                                            @if (old('nationality_id') || isset($employee->nationality_id))
                                                                <option
                                                                    value="{{ old('nationality_id', $employee->nationality_id ?? '') }}"
                                                                    selected>
                                                                    {{ Nationality::find(old('nationality_id', $employee->nationality_id))->name }}
                                                                </option>
                                                            @endif
                                                        </select>

                                                    </div>

                                                    <!-- اللغة الاساسية التي يتحدث بها   -->
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="formtabs-country">اللغة
                                                            الاساسية التي يتحدث بها </label>
                                                        <select disabled name="language_id"
                                                            class="select2 form-select  bg-white language_select2 "
                                                            data-allow-clear="true">
                                                            @if (old('language_id') || isset($employee->language_id))
                                                                <option
                                                                    value="{{ old('language_id', $employee->language_id ?? '') }}"
                                                                    selected>
                                                                    {{ Language::find(old('language_id', $employee->language_id))->name }}
                                                                </option>
                                                            @endif
                                                        </select>

                                                    </div>

                                                    <!-- الديانة -->
                                                    <div class="col-md-3 ">
                                                        <label for="exampleFormControlSelect1" class="form-label">
                                                            الديانة</label>
                                                        <select disabled class="form-select  bg-white " name="religion"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الديانة --
                                                            </option>
                                                            @foreach (ReligionEnum::cases() as $religion)
                                                                <option @if (old('religion', $employee->religion->value) == $religion->value) selected @endif
                                                                    value="{{ $religion->value }}">
                                                                    {{ $religion->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- البريد الالكتروني-->
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="formtabs-email">البريد
                                                            الالكتروني</label>
                                                        <div class="input-group input-group-merge">
                                                            <input disabled type="text" id="formtabs-email"
                                                                name="email"
                                                                value="{{ old('email', $employee->email) }}"
                                                                class="form-control bg-white " aria-label="john.doe"
                                                                aria-describedby="formtabs-email2" />
                                                            <span class="input-group-text"
                                                                id="formtabs-email2">@example.com</span>
                                                        </div>

                                                    </div>

                                                    <!-- الدولة التابع لها الموظف   -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="formtabs-country">الدولة
                                                            التابع لها الموظف</label>
                                                        <select disabled name="country_id" id="country_id"
                                                            class="select2 form-select  bg-white country_select2 "
                                                            data-allow-clear="true">
                                                            @if (old('country_id') || isset($employee->country_id))
                                                                <option
                                                                    value="{{ old('country_id', $employee->country_id ?? '') }}"
                                                                    selected>
                                                                    {{ Country::find(old('country_id', $employee->country_id))->name }}
                                                                </option>
                                                            @endif
                                                        </select>

                                                    </div>

                                                    <!-- المحافظة التابع لها الموظف   -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="governorate_id">المحافظة
                                                            التابع لها الموظف</label>
                                                        <select disabled name="governorate_id" id="governorate_id"
                                                            class="select2 form-select  bg-white governorate_select2 "
                                                            data-allow-clear="true">
                                                            <option value="">-- أختر المحافظة --</option>
                                                            @forelse ($other['governorates'] as $governorate)
                                                                <option @if (old('governorate_id', $employee->governorate_id) == $governorate->id) selected @endif
                                                                    value="{{ $governorate->id }}">
                                                                    {{ $governorate->name }}</option>
                                                            @empty
                                                                لا توجد بيانات
                                                            @endforelse
                                                        </select>

                                                    </div>

                                                    <!-- المدينة التابع لها الموظف   -->
                                                    <div class="col-md-4">
                                                        <label class="form-label"
                                                            for="formtabs-country">المدينة/المركز</label>
                                                        <select disabled name="city_id" id="city_id"
                                                            class="select2 form-select  bg-white city_select2 "
                                                            data-allow-clear="true">
                                                            <option value="">-- أختر المدينة --</option>
                                                            @forelse ($other['cities'] as $city)
                                                                <option @if (old('city_id', $employee->city_id) == $city->id) selected @endif
                                                                    value="{{ $city->id }}">
                                                                    {{ $city->name }}</option>
                                                            @empty
                                                                لا توجد بيانات
                                                            @endforelse
                                                        </select>

                                                    </div>


                                                    <!-- عنوان الاقامة -->
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="address-input">
                                                            عنوان الاقامة </label>
                                                        <input disabled type="text" id="address-input"
                                                            value="{{ old('address', $employee->address) }}"
                                                            class="form-control bg-white " name="address" />

                                                    </div>

                                                    <!-- هاتف المحمول-->
                                                    <div class="col-md-4 ">
                                                        <label class="form-label" for="mobile-input">
                                                            هاتف المحمول</label>
                                                        <input disabled type="text"
                                                            value="{{ old('mobile', $employee->mobile) }}"
                                                            class="form-control bg-white " name="mobile"
                                                            id="mobile-input"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>

                                                    <!-- هاتف المنزل-->
                                                    <div class="col-md-4 ">
                                                        <label class="form-label" for="home_telephone-input">
                                                            هاتف المنزل</label>
                                                        <input disabled type="text"
                                                            value="{{ old('home_telephone', $employee->home_telephone) }}"
                                                            class="form-control bg-white " name="home_telephone"
                                                            id="home_telephone-input"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>

                                                    <!-- هل يمتلك رخصة قيادة -->
                                                    <div class="col-md-4">
                                                        <label for="driving_license" class="form-label">هل
                                                            يمتلك
                                                            رخصة قيادة</label>
                                                        <select disabled class="form-select  bg-white "
                                                            id="driving_license" name="driving_license"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $license)
                                                                <option @if (old('driving_license', $employee->driving_license->value) == $license->value) selected @endif
                                                                    value="{{ $license->value }}">
                                                                    {{ $license->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- رقم رخصة القيادة (مخفي بشكل افتراضي) -->
                                                    <div class="col-md-4" id="license_number_container"
                                                        style="display: none;">
                                                        <label class="form-label" for="driving_License_id">رقم
                                                            رخصة القيادة</label>
                                                        <input disabled type="text" id="driving_License_id"
                                                            value="{{ old('driving_License_id', $employee->driving_License_id) }}"
                                                            class="form-control bg-white " name="driving_License_id"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>

                                                    <!-- نوع رخصة القيادة (مخفي بشكل افتراضي) -->
                                                    <div class="col-md-4" id="license_type_container"
                                                        style="display: none;">
                                                        <label for="driving_license_type" class="form-label">نوع
                                                            رخصة القيادة</label>
                                                        <select disabled class="form-select  bg-white "
                                                            id="driving_license_type" name="driving_license_type"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                النوع --
                                                            </option>
                                                            @foreach (DrivingLicenseType::cases() as $licenseType)
                                                                <option @if (old('driving_license_type', $employee->value) == $licenseType->value) selected @endif
                                                                    value="{{ $licenseType->value }}">
                                                                    {{ $licenseType->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>


                                                    <!-- هل يمتلك أقارب بالعمل -->
                                                    <div class="col-md-4">
                                                        <label for="has_relatives" class="form-label">هل يمتلك
                                                            أقارب بالعمل</label>
                                                        <select disabled class="form-select  bg-white " id="has_relatives"
                                                            name="has_relatives" aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $relatives)
                                                                <option @if (old('has_relatives', $employee->has_relatives->value) == $relatives->value) selected @endif
                                                                    value="{{ $relatives->value }}">
                                                                    {{ $relatives->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- تفاصيل الاقارب (مخفي بشكل افتراضي) -->
                                                    <div class="col-md-12" id="relatives_details_container"
                                                        style="display: none;">
                                                        <label class="form-label" for="relatives_details">تفاصيل
                                                            الاقارب</label>
                                                        <input disabled type="text" id="relatives_details"
                                                            value="{{ old('relatives_details', $employee->relatives_details) }}"
                                                            class="form-control bg-white " name="relatives_details" />

                                                    </div>

                                                    <!-- هل يمتلك اعاقة / عمليات سابقة -->
                                                    <div class="col-md-3">
                                                        <label for="has_disabilities" class="form-label">
                                                            هل يمتلك اعاقة / عمليات سابقة</label>
                                                        <select disabled class="form-select  bg-white "
                                                            id="has_disabilities" name="has_disabilities"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $disabilities)
                                                                <option @if (old('has_disabilities', $employee->has_disabilities->value) == $disabilities->value) selected @endif
                                                                    value="{{ $disabilities->value }}">
                                                                    {{ $disabilities->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- تفاصيل الاعاقة / عمليات سابقة (مخفي بشكل افتراضي) -->
                                                    <div class="col-md-12" id="disabilities_details_container"
                                                        style="display: none;">
                                                        <label class="form-label" for="disabilities_details">تفاصيل
                                                            الاعاقة / عمليات سابقة</label>
                                                        <input disabled type="text" id="disabilities_details"
                                                            value="{{ old('disabilities_details', $employee->disabilities_details) }}"
                                                            class="form-control bg-white " name="disabilities_details" />

                                                    </div>

                                                    <!-- ملاحظات علي الموظف -->
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="notes-input">
                                                            ملاحظات علي الموظف </label>
                                                        <input disabled type="text" id="notes-input"
                                                            value="{{ old('notes', $employee->notes) }}"
                                                            class="form-control bg-white " name="notes" />

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- باقي الحقول -->




                                            <!-- تبويب الخدمة العسكرية -->
                                            <div class="tab-pane fade" id="military" role="tabpanel">
                                                <div class="row g-3">

                                                    <!-- حالة الخدمة العسكرية -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="military_status" class="form-label">حالة الخدمة
                                                            العسكرية</label>
                                                        <select disabled class="form-select  bg-white "
                                                            id="military_status" name="military"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (Military::cases() as $military)
                                                                <option @if (old('military', $employee->military->value) == $military->value) selected @endif
                                                                    value="{{ $military->value }}">
                                                                    {{ $military->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- الحقول المخفية بشكل افتراضي -->
                                                    <div class="row mb-3">
                                                        <!-- تاريخ الاعفاء المؤقت الخدمة العسكرية -->
                                                        <div class="col-md-4 mb-3 related_miltary_postponement">
                                                            <label class="form-label"
                                                                for="military_postponement_date">تاريخ
                                                                الاعفاء المؤقت الخدمة العسكرية</label>

                                                            <input disabled type="text" id="military_postponement_date"
                                                                value="{{ old('military_postponement_date', $employee->military_postponement_date) }}"
                                                                class="form-control bg-white"
                                                                name="military_postponement_date" />
                                                        </div>



                                                        <!-- سبب ومدة تأجيل الخدمة العسكرية -->
                                                        <div class="col-md-8 mb-3 related_miltary_postponement">
                                                            <label class="form-label"
                                                                for="military_postponement_reason">سبب
                                                                ومدة تأجيل
                                                                الخدمة العسكرية</label>
                                                            <input disabled type="text"
                                                                id="military_postponement_reason"
                                                                value="{{ old('military_postponement_reason') }}"
                                                                class="form-control bg-white "
                                                                name="military_postponement_reason" />

                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <!-- تاريخ الاعفاء النهائى الخدمة العسكرية -->
                                                        <div class="col-md-4 mb-3 related_miltary_exemption">
                                                            <label class="form-label" for="military_exemption_date">تاريخ
                                                                الاعفاء النهائى الخدمة العسكرية</label>

                                                            <input disabled type="text" id="military_exemption_date"
                                                                value="{{ old('military_exemption_date', $employee->military_exemption_date) }}"
                                                                class="form-control bg-white"
                                                                name="military_exemption_date" />
                                                        </div>

                                                        <!-- سبب اعفاء الخدمة العسكرية -->
                                                        <div class="col-md-8 mb-3 related_miltary_exemption">
                                                            <label class="form-label" for="military_exemption_reason">سبب
                                                                اعفاء الخدمة العسكرية</label>
                                                            <input disabled type="text" id="military_exemption_reason"
                                                                value="{{ old('military_exemption_reason', $employee->military_exemption_reason) }}"
                                                                class="form-control bg-white "
                                                                name="military_exemption_reason">

                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <!-- تاريخ بداية الخدمة العسكرية -->
                                                        <div class="col-md-4 mb-3 related_miltary_completed">
                                                            <label class="form-label" for="military_service_start_date">
                                                                تاريخ بداية الخدمة العسكرية</label>
                                                            <input disabled type="text"
                                                                id="military_service_start_date"
                                                                value="{{ old('military_service_start_date', $employee->military_service_start_date) }}"
                                                                class="form-control bg-white"
                                                                name="military_service_start_date" />
                                                        </div>


                                                        <!-- تاريخ نهاية الخدمة العسكرية -->
                                                        <div class="col-md-4 mb-3 related_miltary_completed">
                                                            <label class="form-label"
                                                                for="military_service_end_date">تاريخ نهاية الخدمة
                                                                العسكرية</label>
                                                            <input disabled type="text" id="military_service_end_date"
                                                                value="{{ old('military_service_end_date', $employee->military_service_end_date) }}"
                                                                class="form-control bg-white"
                                                                name="military_service_end_date" />
                                                        </div>



                                                        <!-- سلاح الخدمة العسكرية -->
                                                        <div class="col-md-4 mb-3 related_miltary_completed">
                                                            <label class="form-label" for="military_wepon">سلاح الخدمة
                                                                العسكرية</label>
                                                            <input disabled type="text" id="military_wepon"
                                                                value="{{ old('military_wepon', $employee->military_wepon) }}"
                                                                class="form-control bg-white ">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- تبويب البيانات الوظيفية -->
                                            <div class="tab-pane fade" id="job" role="tabpanel">
                                                <div class="row g-3">
                                                    <!-- تاريخ التعيين -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="hiring_date-input">تاريخ
                                                            التعيين</label>
                                                        <input disabled type="text" id="hiring_date"
                                                            value="{{ old('hiring_date', $employee->hiring_date) }}"
                                                            class="form-control bg-white" name="hiring_date" />
                                                    </div>


                                                    <!-- الحالة الوظيفية -->
                                                    <div class="col-md-4 ">
                                                        <label for="functional_status-input" class="form-label">
                                                            الحالة الوظيفية
                                                        </label>
                                                        <select disabled class="form-select  bg-white "
                                                            name="functional_status" id="functional_status-input"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر الحالة -- </option>
                                                            @foreach (FunctionalStatus::cases() as $functional)
                                                                <option @if (old('functional_status', $employee->functional_status->value) == $functional->value) selected @endif
                                                                    value="{{ $functional->value }}">
                                                                    {{ $functional->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- الدرجه الوظيفية -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="job_grade_id-input">الدرجه
                                                            الوظيفية</label>
                                                        <select disabled name="job_grade_id" id="job_grade_id-input"
                                                            class="select2 form-select  bg-white "
                                                            data-allow-clear="true">
                                                            <option selected value="">-- أختر الدرجه -- </option>
                                                            </option>
                                                            @foreach ($other['job_grades'] as $jobGrade)
                                                                <option @if (old('job_grade_id', $employee->job_grade_id) == $jobGrade->id) selected @endif
                                                                    value="{{ $jobGrade->id }}">
                                                                    {{ $jobGrade->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>


                                                    <!-- الادارة -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="department_id-input">الادارة التابع
                                                            لها الموظف</label>
                                                        <select disabled name="department_id"
                                                            class="select2 form-select  bg-white department_select2 "
                                                            data-allow-clear="true"
                                                            data-ajax-url="{{ route('dashboard.departments.searchDepartment') }}">
                                                            @if (old('department_id') || isset($employee->department_id))
                                                                <option
                                                                    value="{{ old('department_id', $employee->department_id ?? '') }}"
                                                                    selected>
                                                                    {{ Department::find(old('department_id', $employee->department_id))->name }}
                                                                </option>
                                                            @endif
                                                        </select>

                                                    </div>

                                                    <!--  وظيفة الموظف -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="job_category_id-input">وظيفة
                                                            الموظف</label>
                                                        <select disabled name="job_category_id" id="job_category_id-input"
                                                            class="select2 form-select  bg-white job_category_select2 "
                                                            data-allow-clear="true">
                                                            @if (old('job_category_id') || isset($employee->job_category_id))
                                                                <option
                                                                    value="{{ old('job_category_id', $employee->job_category_id ?? '') }}"
                                                                    selected>
                                                                    {{ JobCategory::find(old('job_category_id', $employee->job_category_id))->name }}
                                                                </option>
                                                            @endif
                                                        </select>

                                                    </div>


                                                    <!-- هل له بصمة حضور وانصراف -->
                                                    <div class="col-md-4">
                                                        <label for="has_attendance-input" class="form-label">
                                                            هل له بصمة حضور وانصراف
                                                        </label>
                                                        <select disabled id="has_attendance-input"
                                                            class="form-select  bg-white " name="has_attendance"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $attendance)
                                                                <option @if (old('has_attendance', $employee->has_attendance->value) == $attendance->value) selected @endif
                                                                    value="{{ $attendance->value }}">
                                                                    {{ $attendance->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>


                                                    <!-- هل شفت ثابت -->
                                                    <div class="col-md-3">
                                                        <label for="has_fixed_shift" class="form-label">هل شفت
                                                            ثابت</label>
                                                        <select disabled class="form-select  bg-white "
                                                            id="has_fixed_shift" name="has_fixed_shift"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $fixedShift)
                                                                <option @if (old('has_fixed_shift', $employee->has_fixed_shift->value) == $fixedShift->value) selected @endif
                                                                    value="{{ $fixedShift->value }}">
                                                                    {{ $fixedShift->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- أنواع الشفتات (مخفي بشكل افتراضي) -->
                                                    <div class="col-md-6" id="shifts_type_container"
                                                        style="display: none;">
                                                        <label for="shifts_type_id" class="form-label">أنواع
                                                            الشفتات</label>
                                                        <select disabled class="form-select  bg-white "
                                                            id="shifts_type_id" name="shifts_type_id"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                النوع --
                                                            </option>
                                                            @foreach ($other['shifts_types'] as $shift)
                                                                <option @if (old('shifts_type_id', $employee->shifts_type_id) == $shift->id) selected @endif
                                                                    value="{{ $shift->id }}">
                                                                    {{ $shift->type->label() }} من
                                                                    ({{ Carbon::createFromFormat('H:i:s', $shift->from_time)->format('H:i') }})
                                                                    إلى
                                                                    ({{ Carbon::createFromFormat('H:i:s', $shift->to_time)->format('H:i') }})عدد
                                                                    الساعات
                                                                    {{ $shift->total_hours }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>


                                                    <!-- عدد ساعات العمل اليومي-->
                                                    <div class="col-md-3 ">
                                                        <label class="form-label" for="daily_work_hour-input">
                                                            عدد ساعات العمل اليومي</label>
                                                        <input disabled type="text" id="daily_work_hour-input"
                                                            value="{{ old('daily_work_hour', $employee->daily_work_hour) }}"
                                                            class="form-control bg-white " name="daily_work_hour"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>

                                                    <!-- راتب الموظف الشهري -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="monthly_salary">
                                                            راتب الموظف الشهري
                                                        </label>
                                                        <input disabled type="text" id="monthly_salary"
                                                            value="{{ old('salary', $employee->salary) }}"
                                                            class="form-control bg-white " name="salary"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>

                                                    <!-- راتب الموظف اليومى -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="daily_salary">
                                                            راتب الموظف اليومى
                                                        </label>
                                                        <input disabled type="text" id="daily_salary"
                                                            value="{{ old('day_price', $employee->day_price) }}"
                                                            class="form-control bg-white " name="day_price" />

                                                    </div>

                                                    <!-- عملة قبض الموظف -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="currency_id-input">عملة قبض
                                                            الموظف
                                                        </label>
                                                        <select disabled name="currency_id" id="currency_id-input"
                                                            class="select2 form-select  bg-white js-example-basic-single currency_select2 "
                                                            data-allow-clear="true">
                                                            @if (old('currency_id') || isset($employee->currency_id))
                                                                <option
                                                                    value="{{ old('currency_id', $employee->currency_id ?? '') }}"
                                                                    selected>
                                                                    {{ Currency::find(old('currency_id', $employee->currency_id))->name }}
                                                                </option>
                                                            @endif
                                                        </select>

                                                    </div>

                                                    <!--  هل له تأمين اجتماعي -->
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="has_social_insurance">
                                                            هل له تأمين اجتماعي</label>
                                                        <select disabled id="has_social_insurance"
                                                            class="form-select  bg-white " name="has_social_insurance"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $social)
                                                                <option @if (old('has_social_insurance', $employee->has_social_insurance->value) == $social->value) selected @endif
                                                                    value="{{ $social->value }}">
                                                                    {{ $social->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- قيمة التأمين الاجتماعي المستقطع شهرياً -->
                                                    <div class="col-md-5" style="display: none;"
                                                        id="social_insurance_fields">
                                                        <label class="form-label"
                                                            for="social_insurance_cut_monthely-input">
                                                            قيمة التأمين الاجتماعي المستقطع شهرياً
                                                        </label>
                                                        <input disabled type="text"
                                                            id="social_insurance_cut_monthely-input"
                                                            value="{{ old('social_insurance_cut_monthely', $employee->social_insurance_cut_monthely) }}"
                                                            class="form-control bg-white "
                                                            name="social_insurance_cut_monthely"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>

                                                    <!-- رقم التامين الاجتماعي للموظف -->
                                                    <div class="col-md-4" style="display: none;"
                                                        id="social_insurance_value">
                                                        <label class="form-label" for="social_insurance_number-input">
                                                            رقم التامين الاجتماعي للموظف </label>
                                                        <input disabled type="text" id="social_insurance_number-input"
                                                            value="{{ old('social_insurance_number', $employee->social_insurance_number) }}"
                                                            class="form-control bg-white " name="social_insurance_number"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>
                                                    <!--  هل له تأمين طبي -->
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="has_medical_insurance">
                                                            هل له تأمين طبي</label>
                                                        <select disabled id="has_medical_insurance"
                                                            class="form-select  bg-white " name="has_medical_insurance"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $medical)
                                                                <option @if (old('has_medical_insurance', $employee->has_medical_insurance->value) == $medical->value) selected @endif
                                                                    value="{{ $medical->value }}">
                                                                    {{ $medical->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- قيمة التأمين الطبي المستقطع شهرياً -->
                                                    <div class="col-md-5" style="display: none;"
                                                        id="medical_insurance_fields">
                                                        <label class="form-label" for="has_social_insurance">
                                                            قيمة التأمين الطبي المستقطع شهرياً
                                                        </label>
                                                        <input disabled type="text" id="has_social_insurance"
                                                            value="{{ old('medical_insurance_cut_monthely', $employee->medical_insurance_cut_monthely) }}"
                                                            class="form-control bg-white "
                                                            name="medical_insurance_cut_monthely"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>

                                                    <!-- رقم التامين الطبي للموظف -->
                                                    <div class="col-md-4" style="display: none;"
                                                        id="medical_insurance_value">
                                                        <label class="form-label" for="medical_insurance_number">
                                                            رقم التامين الطبي للموظف </label>
                                                        <input disabled type="text" id="medical_insurance_number"
                                                            value="{{ old('medical_insurance_number', $employee->medical_insurance_number) }}"
                                                            class="form-control bg-white " name="medical_insurance_number"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>


                                                    <!--  نوع صرف راتب الموظف -->
                                                    <div class="col-md-3 ">
                                                        <label class="form-label" for="type_salary_receipt">
                                                            نوع صرف راتب الموظف</label>
                                                        <select disabled class="form-select  bg-white "
                                                            name="type_salary_receipt" id="type_salary_receipt"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (TypeSalaryReceipt::cases() as $salary)
                                                                <option @if (old('type_salary_receipt', $employee->type_salary_receipt->value) == $salary->value) selected @endif
                                                                    value="{{ $salary->value }}">
                                                                    {{ $salary->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- هل له بدلات ثابتة  -->
                                                    <div class="col-md-3 ">
                                                        <label class="form-label" for="has_fixed_allowances">
                                                            هل له بدلات ثابتة</label>
                                                        <select disabled class="form-select  bg-white "
                                                            name="has_fixed_allowances" id="has_fixed_allowances"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $allowances)
                                                                <option @if (old('has_fixed_allowances', $employee->has_fixed_allowances->value) == $allowances->value) selected @endif
                                                                    value="{{ $allowances->value }}">
                                                                    {{ $allowances->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>


                                                    <!--  هل له حافز -->
                                                    <div class="col-md-3 ">
                                                        <label class="form-label" for="motivation_type">
                                                            هل له حافز</label>
                                                        <select disabled class="form-select  bg-white "
                                                            name="motivation_type" id="motivation_type"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (MotivationType::cases() as $motivation)
                                                                <option @if (old('motivation_type', $employee->motivation_type->value) == $motivation->value) selected @endif
                                                                    value="{{ $motivation->value }}">
                                                                    {{ $motivation->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <!-- قيمة الحافز الشهري الثابت -->
                                                    <div class="col-md-3" style="display: none;"
                                                        id="fixed_motivation_value">
                                                        <label class="form-label" for="motivation_value">
                                                            قيمة الحافز الشهري الثابت </label>
                                                        <input disabled type="text" id=""
                                                            value="{{ old('motivation_value', $employee->motivation_value) }}"
                                                            class="form-control bg-white " name="motivation_value"
                                                            id="motivation_value"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>


                                                    <!--  هل له رصيد اجازات سنوي -->
                                                    <div class="col-md-3 ">
                                                        <label class="form-label" for="has_vacation_balance">
                                                            هل له رصيد اجازات سنوي</label>
                                                        <select disabled class="form-select  bg-white "
                                                            name="has_vacation_balance" id="has_vacation_balance"
                                                            aria-label="Default select example">
                                                            <option selected value="">-- أختر
                                                                الحالة --
                                                            </option>
                                                            @foreach (YesOrNoEnum::cases() as $vacation)
                                                                <option @if (old('has_vacation_balance', $employee->has_vacation_balance->value) == $vacation->value) selected @endif
                                                                    value="{{ $vacation->value }}">
                                                                    {{ $vacation->label() }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>




                                                </div>
                                            </div>


                                            <!-- تبويب البيانات الإضافية -->
                                            <div class="tab-pane fade" id="additional" role="tabpanel">
                                                <div class="row g-3">
                                                    <!-- شخص يمكن الرجوع اليه للضرورة -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="urgent_person_details">
                                                            شخص يمكن الرجوع اليه للضرورة </label>
                                                        <input disabled type="text" id="urgent_person_details"
                                                            value="{{ old('urgent_person_details', $employee->urgent_person_details) }}"
                                                            class="form-control bg-white " name="urgent_person_details" />

                                                    </div>

                                                    <!-- رقم الباسبور ان وجد -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="has_social_insurance">
                                                            رقم الباسبور ان وجد</label>
                                                        <input disabled type="text" id=""
                                                            value="{{ old('pasport_identity', $employee->pasport_identity) }}"
                                                            class="form-control bg-white " name="pasport_identity"
                                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'');" />

                                                    </div>
                                                    <!-- تاريخ انتهاء الباسبور -->
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="pasport_exp_date-input">تاريخ
                                                            انتهاء الباسبور
                                                        </label>
                                                        <input disabled type="text" id="pasport_exp_date"
                                                            value="{{ old('pasport_exp_date', $employee->pasport_exp_date) }}"
                                                            class="form-control bg-white" name="pasport_exp_date" />
                                                    </div>

                                                    <div class="row col-12 mt-3">
                                                        <div class="col-md-4 mb-3">
                                                            <label for="exampleFormControlSelect1" class="form-label">حالة
                                                                حساب الموظف</label>
                                                            <select disabled name="active" class="form-select  bg-white "
                                                                id="exampleFormControlSelect1"
                                                                aria-label="Default select example">
                                                                <option selected value="">-- أختر الحالة--</option>
                                                                <option @if (old('active', $employee->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                                    value="{{ StatusActiveEnum::ACTIVE }}">
                                                                    {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                                                <option @if (old('active', $employee->active) == StatusActiveEnum::INACTIVE) selected @endif
                                                                    value="{{ StatusActiveEnum::INACTIVE }}">
                                                                    {{ StatusActiveEnum::INACTIVE->label() }}</option>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <x-image-preview name='photo' title="أرفق صورة الموظف" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="formFile" class="form-label">أرفاق
                                                            السيرة
                                                            الذاتية</label>
                                                        <input disabled class="form-control" name="cv"
                                                            type="file" id="formFile">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                </div>
                                <x-edit-button-component></x-edit-button-component>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->


                    <!--end::Form-->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
    <script src="{{ asset('dashboard') }}/assets/dist/js/employees/create-scripts.js"></script>
    <script src="{{ asset('dashboard') }}/assets/dist/js/select2.min.js"></script>
@endpush
