@php
    use App\Enums\PanelSettingSystemStatusEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-admin_panel_settings', 'active')
@section('title', 'الصفحة الرئيسية')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('dashboard.admin_panel_settings.update', $adminPanelSetting->slug) }}" method="POST"
                id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- الزر على اليسار -->
                                    <h4 class="mb-0">شركة {{ $adminPanelSetting['company_name'] }}</h4>


                                    <!-- النص على اليمين -->


                                    <button type="submit" id="submitButton" class="btn btn-md btn-info"> <i
                                            class="fa-solid fa-key"></i>تعديل البيانات </button>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="mx-2 my-2">

                                    <div class="col-md-6 mb-3">
                                        <x-image-preview name='logo' title="أرفق شعار الشركة" />

                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">


                                        <tr>
                                            <td style="width: 60%">هاتف الشركة</td>
                                            <td>
                                                <input type="text" name="mobile"
                                                    class="form-control @error('mobile') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['mobile'] }}">
                                                @error('mobile')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">عنوان الشركة</td>
                                            <td>
                                                <input type="text" name="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['address'] }}">
                                                @error('address')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">بريد الشركة</td>
                                            <td>
                                                <input type="text" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['email'] }}">
                                                @error('email')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%"> حالة التفعيل</td>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customActive"
                                                        name="system_status"
                                                        value="{{ PanelSettingSystemStatusEnum::Active }}"
                                                        @if (old('system_status', $adminPanelSetting->system_status) == PanelSettingSystemStatusEnum::Active) checked @endif>
                                                    <label for="customActive" class="custom-control-label"> <i
                                                            class="fas fa-fire text-primary mx-1"></i>{{ PanelSettingSystemStatusEnum::Active->label() }}</label>
                                                </div>

                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customInactive"
                                                        name="system_status"
                                                        value="{{ PanelSettingSystemStatusEnum::Inactive }}"
                                                        @if (old('system_status', $adminPanelSetting->system_status) == PanelSettingSystemStatusEnum::Inactive) checked @endif>
                                                    <label for="customInactive" class="custom-control-label"> <i
                                                            class="fas fa-times text-danger mx-1"></i>{{ PanelSettingSystemStatusEnum::Inactive->label() }}</label>
                                                </div>

                                                @error('system_status')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 60%"> الحد الأقصى لاحتساب عدد ساعات عمل
                                                اضافية عند انصراف الموظف
                                                واحتساب
                                                بصمة الانصراف و الاستحتسب على انها بصمة حضور شفت جديد</td>

                                            <td>
                                                <input type="text" name="max_hours_take_fp_as_addtional"
                                                    class="form-control @error('max_hours_take_fp_as_addtional') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['max_hours_take_fp_as_addtional'] * 1 }}">
                                                @error('max_hours_take_fp_as_addtional')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>

                                        <tr>
                                            <td style="width: 60%"> بعد كام دقيقة نحسب تاخير حضور </td>
                                            <td>
                                                <input type="text" name="after_minute_calculate_delay"
                                                    class="form-control @error('after_minute_calculate_delay') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['after_minute_calculate_delay'] * 1 }}">
                                                @error('after_minute_calculate_delay')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%"> بعد كام دقيقة نحسب انصراف مبكر </td>
                                            <td>
                                                <input type="text" name="after_minute_calculate_early_departure"
                                                    class="form-control @error('after_minute_calculate_early_departure') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['after_minute_calculate_early_departure'] * 1 }}">
                                                @error('after_minute_calculate_early_departure')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%"> بعد كام مره تأخير او إنصراف مبكر نخصم
                                                ربع يوم
                                            </td>
                                            <td>
                                                <input type="text" name="after_minute_quarterday"
                                                    class="form-control @error('after_minute_quarterday') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['after_minute_quarterday'] * 1 }}">
                                                @error('after_minute_quarterday')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%"> بعد كام مرة تأخير او أنصراف مبكر نخصم
                                                نص يوم </td>
                                            <td>
                                                <input type="text" name="after_time_half_daycut"
                                                    class="form-control @error('after_time_half_daycut') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['after_time_half_daycut'] * 1 }}">
                                                @error('after_time_half_daycut')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">نخصم بعد كام مره تاخير او أنصراف مبكر
                                                يوم كامل </td>
                                            <td>
                                                <input type="text" name="after_time_allday_daycut"
                                                    class="form-control @error('after_time_allday_daycut') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['after_time_allday_daycut'] * 1 }}">
                                                @error('after_time_allday_daycut')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">أقل من كام دقيقة فرق بين البصمة الأولى
                                                والثانية يتم إهمال
                                                البصمة
                                            </td>
                                            <td>
                                                <input type="text" name="less_than_minute_neglecting_fp"
                                                    class="form-control @error('less_than_minute_neglecting_fp') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['less_than_minute_neglecting_fp'] * 1 }}">
                                                @error('less_than_minute_neglecting_fp')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">رصيد اجازات الموظف الشهري </td>
                                            <td>
                                                <input type="text" name="monthly_vacation_balance"
                                                    class="form-control @error('monthly_vacation_balance') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['monthly_vacation_balance'] * 1 }}">
                                                @error('monthly_vacation_balance')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">بعد كام يوم ينزل للموظف رصيد اجازات
                                            </td>
                                            <td>
                                                <input type="text" name="after_days_begin_vacation"
                                                    class="form-control @error('after_days_begin_vacation') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['after_days_begin_vacation'] * 1 }}">
                                                @error('after_days_begin_vacation')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">الرصيد الاولي المرحل عند تفعيل الاجازات
                                                للموظف مثل نزول عشرة
                                                ايام
                                                ونص بعد سته شهور للموظف </td>
                                            <td>
                                                <input type="text" name="first_balance_begin_vacation"
                                                    class="form-control @error('first_balance_begin_vacation') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['first_balance_begin_vacation'] * 1 }}">
                                                @error('first_balance_begin_vacation')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">قيمة خصم الايام بعد اول مرة غياب بدون
                                                اذن </td>
                                            <td>
                                                <input type="text" name="sanctions_value_first_absence"
                                                    class="form-control @error('sanctions_value_first_absence') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['sanctions_value_first_absence'] * 1 }}">
                                                @error('sanctions_value_first_absence')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">قيمة خصم الايام بعد ثاني مرة غياب بدون
                                                اذن </td>
                                            <td>
                                                <input type="text" name="sanctions_value_second_absence"
                                                    class="form-control @error('sanctions_value_second_absence') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['sanctions_value_second_absence'] * 1 }}">
                                                @error('sanctions_value_second_absence')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">قيمة خصم الايام بعد ثالث مرة غياب بدون
                                                اذن </td>
                                            <td>
                                                <input type="text" name="sanctions_value_thaird_absence"
                                                    class="form-control @error('sanctions_value_thaird_absence') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['sanctions_value_thaird_absence'] * 1 }}">
                                                @error('sanctions_value_thaird_absence')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 60%">قيمة خصم الايام بعد رابع مرة غياب بدون
                                                اذن </td>
                                            <td>
                                                <input type="text" name="sanctions_value_forth_absence"
                                                    class="form-control @error('sanctions_value_forth_absence') is-invalid @enderror"
                                                    value="{{ $adminPanelSetting['sanctions_value_forth_absence'] * 1 }}">
                                                @error('sanctions_value_forth_absence')
                                                    <span class="invalid-feedback text-right" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>

                                            <td style="width: 60%">شعار الشركة</td>
                                            <td>
                                                @if ($adminPanelSetting->getFirstMediaUrl('logo', 'preview'))
                                                    <img class="img-thumbnail rounded me-2 mt-2" alt="200x200"
                                                        style="width: 60%;"
                                                        src="{{ $adminPanelSetting->getFirstMediaUrl('logo', 'preview') }}"
                                                        data-holder-rendered="true">
                                                @else
                                                    <img class="img-thumbnail rounded me-2 mt-2" alt="200x200"
                                                        style="width: 60%;"
                                                        src="{{ asset('dashboard') }}/assets/dist/img/hr-logo.jpg"
                                                        data-holder-rendered="true">
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>


                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row (main row) -->

                </div><!-- /.container-fluid -->

            </form>

    </section>


@endsection
@push('js')
@endpush
