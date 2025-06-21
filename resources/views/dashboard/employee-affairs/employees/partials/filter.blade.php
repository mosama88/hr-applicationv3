@php
    use App\Enums\StatusActiveEnum;
    use App\Enums\Employee\TypeSalaryReceipt;
    use App\Models\Currency;
    use Carbon\Carbon;
    use App\Models\JobCategory;
    use App\Models\Department;
    use App\Enums\Employee\FunctionalStatus;
    use App\Enums\Employee\Military;
    use App\Models\Country;
    use App\Enums\Employee\ReligionEnum;
    use App\Models\Nationality;
    use App\Enums\Employee\SocialStatus;
    use App\Enums\AdminGenderEnum;
@endphp

<form action="{{ route('dashboard.employees.filter') }}" method="GET">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- الزر على اليسار -->
                        </div>
                    </h3>

                    <div class="card-tools">
                        <h4 class="mb-0">جدول الموظفين</h4>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted">
                            يمكنك استخدام الفلاتر التالية للبحث عن الموظفين حسب كود البصمة أو كود الموظف أو اسم
                            الموظف أو الفرع التابع له.......
                        </p>
                        <div class="col-12">
                            <div class="row mx-1 my-3">
                                {{-- inputs --}}
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="fp_code-input">كود البصمة</label>
                                    <input type="text" class="form-control" name="fp_code_search"
                                        value="{{ old('fp_code') }}" id="fp_code-input"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                        placeholder="مثال:1000" />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="employee_code-input">كود
                                        الموظف</label>
                                    <input type="text" class="form-control" name="employee_code_search"
                                        value="{{ request('employee_code_search') }}" id="employee_code-input"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                        placeholder="مثال:1000" />
                                </div>

                                <!-- الموظفين -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="employee_search-input">أسم
                                        الموظف أو الرقم القومى</label>
                                    <input type="text" class="form-control" name="employee_search"
                                        value="{{ request('employee_search') }}" id="employee_search-input"
                                        placeholder="مثال:1000" />
                                </div>

                                <!-- الفرع -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="formtabs-country">الفرع
                                        التابع له الموظف</label>
                                    <select class="select2 form-select" name="branch_id" data-allow-clear="true">
                                        <option selected value="">-- أختر
                                            الفرع --
                                        </option>
                                        @foreach ($other['branches'] as $branch)
                                            <option @if (request('branch_id') == $branch->id) selected @endif
                                                value="{{ $branch->id }}">
                                                {{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-- الجنس -->
                                <div class="col-md-2 mb-3">
                                    <label for="gender-input" class="form-label">نوع الجنس</label>
                                    <select id="gender-input" class="form-select" name="gender"
                                        aria-label="Default select example">
                                        <option selected value="">-- أختر نوع الجنس --</option>
                                        @foreach (AdminGenderEnum::cases() as $gender)
                                            <option value="{{ $gender->value }}"
                                                @if (request('gender') == $gender->value) selected @endif>
                                                {{ $gender->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <!--  الحالة الأجتماعية -->
                                <div class="col-md-2 mb-3">
                                    <label for="social_status-input" class="form-label"> الحالة الأجتماعية</label>
                                    <select id="social_status-input" class="form-select" name="social_status"
                                        aria-label="Default select example">
                                        <option selected value="">-- أخترالحالة --</option>
                                        @foreach (SocialStatus::cases() as $socialStatus)
                                            <option @if (request('social_status') == $socialStatus->value) selected @endif
                                                value="{{ $socialStatus->value }}">
                                                {{ $socialStatus->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- الفرع -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="formtabs-country">الفرع
                                        التابع له الموظف</label>
                                    <select class="select2 form-select" name="branch_id" data-allow-clear="true">
                                        <option selected value="">-- أختر
                                            الفرع --
                                        </option>
                                        @foreach ($other['branches'] as $branch)
                                            <option @if (request('branch_id') == $branch->id) selected @endif
                                                value="{{ $branch->id }}">
                                                {{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-- الجنسية  -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="formtabs-country">الجنسية</label>
                                    <select name="nationality_id" class="select2 form-select nationality_select2"
                                        data-allow-clear="true">
                                        @if (request('nationality_id'))
                                            <option value="{{ request('nationality_id') }}" selected>
                                                {{ Nationality::find(request('nationality_id'))?->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>


                                <!-- الديانة -->
                                <div class="col-md-2 mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">الديانة</label>
                                    <select class="form-select" name="religion" aria-label="Default select example">
                                        <option selected value="">-- أخترالديانة --</option>
                                        @foreach (ReligionEnum::cases() as $religion)
                                            <option @if (request('religion') == $religion->value) selected @endif
                                                value="{{ $religion->value }}">
                                                {{ $religion->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-- هاتف المحمول-->
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="mobile-input">
                                        هاتف المحمول</label>
                                    <input type="text" value="{{ request('mobile') }}"
                                        class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                        id="mobile-input" oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                        placeholder="658 799 8941" />
                                    @error('mobile')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <!-- الادارة -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="department_id-input">الادارة </label>
                                    <select name="department_id" class="select2 form-select department_select2"
                                        data-allow-clear="true"
                                        data-ajax-url="{{ route('dashboard.departments.searchDepartment') }}">
                                        @if (request('department_id'))
                                            <option value="{{ request('department_id') }}" selected>
                                                {{ Department::find(request('department_id'))?->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>


                                <!--  وظيفة الموظف -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="job_category_id-input">وظيفة
                                        الموظف</label>
                                    <select name="job_category_id" id="job_category_id-input"
                                        class="select2 form-select job_category_select2" data-allow-clear="true">
                                        @if (request('job_category_id'))
                                            <option value="{{ request('job_category_id') }}" selected>
                                                {{ JobCategory::find(request('job_category_id'))?->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <!-- الدولة التابع لها الموظف   -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="formtabs-country">الدولة</label>
                                    <select name="country_id" id="country_id"
                                        class="select2 form-select country_select2" data-allow-clear="true">
                                        @if (request('country_id'))
                                            <option value="{{ request('country_id') }}" selected>
                                                {{ Country::find(request('country_id'))?->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <!-- المحافظة التابع لها الموظف   -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="governorate_id">المحافظة</label>
                                    <select name="governorate_id" id="governorate_id"
                                        class="select2 form-select governorate_select2" data-allow-clear="true">
                                        <option value="">-- أختر المحافظة --</option>
                                        @forelse ($other['governorates'] as $governorate)
                                            <option @if (request('governorate_id') == $governorate->id) selected @endif
                                                value="{{ $governorate->id }}">
                                                {{ $governorate->name }}</option>
                                        @empty
                                            لا توجد بيانات
                                        @endforelse
                                    </select>
                                </div>

                                <!-- المدينة التابع لها الموظف   -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="formtabs-country">المدينة/المركز</label>
                                    <select name="city_id" id="city_id" class="select2 form-select city_select2"
                                        data-allow-clear="true">
                                        <option value="">-- أختر المدينة --</option>
                                        @forelse ($other['cities'] as $city)
                                            <option @if (request('city_id') == $city->id) selected @endif
                                                value="{{ $city->id }}">
                                                {{ $city->name }}</option>
                                        @empty
                                            لا توجد بيانات
                                        @endforelse
                                    </select>
                                </div>

                                <!-- حالة الخدمة العسكرية -->
                                <div class="col-md-3 mb-3">
                                    <label for="military_status" class="form-label">حالة الخدمة العسكرية</label>
                                    <select class="form-select" id="military_status" name="military"
                                        aria-label="Default select example">
                                        <option selected value="">-- أختر الحالة --
                                        </option>
                                        @foreach (Military::cases() as $military)
                                            <option @if (request('military') == $military->value) selected @endif
                                                value="{{ $military->value }}">
                                                {{ $military->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- الحالة الوظيفية -->
                                <div class="col-md-3 mb-3">
                                    <label for="functional_status-input" class="form-label"> الحالة الوظيفية </label>
                                    <select class="form-select" name="functional_status" id="functional_status-input"
                                        aria-label="Default select example">
                                        <option selected value="">-- أختر الحالة -- </option>
                                        @foreach (FunctionalStatus::cases() as $functional)
                                            <option @if (request('functional_status') == $functional->value) selected @endif
                                                value="{{ $functional->value }}">
                                                {{ $functional->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-- الدرجه الوظيفية -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="job_grade_id-input">الدرجه الوظيفية</label>
                                    <select name="job_grade_id" id="job_grade_id-input" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option selected value="">-- أختر الدرجه -- </option>
                                        </option>
                                        @foreach ($other['job_grades'] as $jobGrade)
                                            <option @if (request('job_grade_id') == $jobGrade->id) selected @endif
                                                value="{{ $jobGrade->id }}">
                                                {{ $jobGrade->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>



                                <!--  نوع صرف راتب الموظف -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="type_salary_receipt">نوع صرف الراتب </label>
                                    <select class="form-select" name="type_salary_receipt" id="type_salary_receipt"
                                        aria-label="Default select example">
                                        <option selected value="">-- أختر
                                            الحالة --
                                        </option>
                                        @foreach (TypeSalaryReceipt::cases() as $salary)
                                            <option @if (request('type_salary_receipt') == $salary->value) selected @endif
                                                value="{{ $salary->value }}">
                                                {{ $salary->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- أنواع الشفتات (مخفي بشكل افتراضي) -->
                                <div class="col-md-6 mb-3">
                                    <label for="shifts_type_id" class="form-label">أنواع
                                        الشفتات</label>
                                    <select class="form-select" id="shifts_type_id" name="shifts_type_id"
                                        aria-label="Default select example">
                                        <option selected value="">-- أختر
                                            النوع --
                                        </option>
                                        @foreach ($other['shifts_types'] as $shift)
                                            <option @if (request('shifts_type_id') == $shift->id) selected @endif
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

                                <!-- عملة قبض الموظف -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="currency_id-input">عملة قبض الموظف </label>
                                    <select name="currency_id" id="currency_id-input"
                                        class="select2 form-select js-example-basic-single currency_select2"
                                        data-allow-clear="true">
                                        @if (old('currency_id'))
                                            <option value="{{ request('currency_id') }}" selected>
                                                {{ Currency::find(request('currency_id'))?->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">حالة حساب
                                        الموظف</label>
                                    <select name="active" class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        <option selected value="">-- أختر الحالة--</option>
                                        @foreach (StatusActiveEnum::cases() as $active)
                                            <option @if (request('active') == $active->value) selected @endif
                                                value="{{ $active->value }}">
                                                {{ $active->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 mx-auto mb-3 text-center">
                                <button type="submit" class="btn btn-md btn-primary">فلتر <i
                                        class="fa-solid fa-filter mx-1"></i></button>

                                <a href="javascript:void(0)" onclick="resetFilters()"
                                    class="btn btn-secondary">إمسح<i class="fa-solid fa-broom mx-1"></i></a>


                            </div>
                        </div>
                    </div>

</form>
@push('js')
@endpush
