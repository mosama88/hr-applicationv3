@php
    use App\Enums\PanelSettingSystemStatusEnum;
@endphp
@extends('dashboard.layouts.master', ['titlePage' => 'إعدادت الشركة '])
@section('active-admin_panel_settings', 'active')
@section('title', 'الصفحة الرئيسية')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header d-flex justify-content-end">
                    <div class="card-title m-0">
                        <a href="{{ route('dashboard.admin_panel_settings.edit', $data->slug) }}"
                            class="btn btn-info text-white">
                            <i class="fas fa-edit mx-1"></i> تعديل
                        </a>
                    </div>
                </div>

                <!--end::Header-->
                <!--begin::Form-->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">

                        <tr>
                            <td class="wd-500">أسم الشركة</td>
                            <td> {{ $data['company_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="wd-500">هاتف الشركة</td>
                            <td> {{ $data['mobile'] }}</td>
                        </tr>
                        <tr>
                            <td class="wd-500">عنوان الشركة</td>
                            <td> {{ $data['address'] }}</td>
                        </tr>
                        <tr>
                            <td class="wd-500">بريد الشركة</td>
                            <td> {{ $data['email'] }}</td>
                        </tr>
                        <tr>
                            <td class="wd-500"> حالة التفعيل</td>
                            <td>

                                @if ($data['system_status'] == PanelSettingSystemStatusEnum::Active)
                                    <span class="badge bg-primary">
                                        {{ PanelSettingSystemStatusEnum::Active->label() }}</span>
                                @else
                                    <span class="badge bg-danger">
                                        {{ PanelSettingSystemStatusEnum::Inactive->label() }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500"> الحد الأقصى لاحتساب عدد ساعات عمل اضافية عند انصراف الموظف
                                واحتساب
                                بصمة الانصراف و الاستحتسب على انها بصمة حضور شفت جديد</td>
                            <td>

                                <h6>{{ $data['max_hours_take_fp_as_addtional'] * 1 }}
                                    <span class="badge bg-primary">
                                        @if ($data['max_hours_take_fp_as_addtional'] <= 10)
                                            ساعات
                                        @else
                                            ساعه
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>

                        <tr>
                            <td class="wd-500"> بعد كام دقيقة نحسب تاخير حضور </td>
                            <td>
                                <h6>{{ $data['after_minute_calculate_delay'] * 1 }}
                                    <span class="badge bg-danger">
                                        @if ($data['after_minute_calculate_delay'] <= 10)
                                            دقائق
                                        @else
                                            دقيقة
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500"> بعد كام دقيقة نحسب انصراف مبكر </td>
                            <td>
                                <h6>{{ $data['after_minute_calculate_early_departure'] * 1 }}
                                    <span class="badge bg-danger">
                                        @if ($data['after_minute_calculate_early_departure'] <= 10)
                                            دقائق
                                        @else
                                            دقيقة
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500"> بعد كام مره تأخير او إنصراف مبكر نخصم ربع يوم
                            </td>
                            <td>
                                <h6>{{ $data['after_minute_quarterday'] * 1 }}
                                    <span class="badge bg-danger">
                                        @if ($data['after_minute_quarterday'] <= 10)
                                            دقائق
                                        @else
                                            دقيقة
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500"> بعد كام مرة تأخير او أنصراف مبكر نخصم نص يوم </td>
                            <td>
                                <h6>{{ $data['after_time_half_daycut'] * 1 }}
                                    <span class="badge bg-primary">
                                        @if ($data['after_time_half_daycut'] <= 10)
                                            ساعات
                                        @else
                                            ساعه
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">نخصم بعد كام مره تاخير او أنصراف مبكر يوم كامل </td>
                            <td>
                                <h6>{{ $data['after_time_allday_daycut'] * 1 }}
                                    <span class="badge bg-primary">
                                        @if ($data['after_time_allday_daycut'] <= 10)
                                            مرات
                                        @else
                                            مره
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">أقل من كام دقيقة فرق بين البصمة الأولى والثانية يتم إهمال
                                البصمة
                            </td>
                            <td>
                                <h6>{{ $data['less_than_minute_neglecting_fp'] * 1 }}
                                    <span class="badge bg-danger">
                                        @if ($data['less_than_minute_neglecting_fp'] <= 10)
                                            دقائق
                                        @else
                                            دقيقة
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">رصيد اجازات الموظف الشهري </td>
                            <td>
                                <h6>{{ $data['monthly_vacation_balance'] * 1 }}
                                    <span class="badge bg-success">
                                        @if ($data['monthly_vacation_balance'] <= 10)
                                            أيام
                                        @else
                                            يوم
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">بعد كام يوم ينزل للموظف رصيد اجازات </td>
                            <td>
                                <h6>{{ $data['after_days_begin_vacation'] * 1 }}
                                    <span class="badge bg-success">
                                        @if ($data['after_days_begin_vacation'] <= 10)
                                            أيام
                                        @else
                                            يوم
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة
                                ايام
                                ونص بعد سته شهور للموظف </td>
                            <td>
                                <h6>{{ $data['first_balance_begin_vacation'] * 1 }}
                                    <span class="badge bg-success">
                                        @if ($data['first_balance_begin_vacation'] <= 10)
                                            أيام
                                        @else
                                            يوم
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">قيمة خصم الايام بعد اول مرة غياب بدون اذن </td>
                            <td>
                                <h6>{{ $data['sanctions_value_first_absence'] * 1 }}
                                    <span class="badge bg-success">
                                        @if ($data['sanctions_value_first_absence'] <= 10)
                                            أيام
                                        @else
                                            يوم
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">قيمة خصم الايام بعد ثاني مرة غياب بدون اذن </td>
                            <td>
                                <h6>{{ $data['sanctions_value_second_absence'] * 1 }}
                                    <span class="badge bg-success">
                                        @if ($data['sanctions_value_second_absence'] <= 10)
                                            أيام
                                        @else
                                            يوم
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">قيمة خصم الايام بعد ثالث مرة غياب بدون اذن </td>
                            <td>
                                <h6>{{ $data['sanctions_value_thaird_absence'] * 1 }}
                                    <span class="badge bg-success">
                                        @if ($data['sanctions_value_thaird_absence'] <= 10)
                                            أيام
                                        @else
                                            يوم
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">قيمة خصم الايام بعد رابع مرة غياب بدون اذن </td>
                            <td>
                                <h6>{{ $data['sanctions_value_forth_absence'] * 1 }}
                                    <span class="badge bg-success">
                                        @if ($data['sanctions_value_forth_absence'] <= 10)
                                            أيام
                                        @else
                                            يوم
                                        @endif
                                    </span>
                                </h6>
                            </td>
                        </tr>
                        <tr>
                            <td class="wd-500">شعار الشركة</td>
                            <td>
                                @if ($data->getFirstMediaUrl('logo', 'preview'))
                                    <img class="img-thumbnail rounded me-2 mt-2" alt="200x200" style="width: 60%;"
                                        src="{{ $data->getFirstMediaUrl('logo', 'preview') }}" data-holder-rendered="true">
                                @else
                                    <img class="img-thumbnail rounded me-2 mt-2" alt="200x200" style="width: 60%;"
                                        src="{{ asset('dashboard') }}/assets/dist/img/hr-logo.jpg"
                                        data-holder-rendered="true">
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>
                <!--end::Form-->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->


@endsection
@push('js')
@endpush
