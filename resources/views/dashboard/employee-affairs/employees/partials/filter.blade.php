@php
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
                                <div class="col-md-4">
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
                                <div class="col-md-2">
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
                                <div class="col-md-2">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <label class="form-label" for="formtabs-country">الجنسية</label>
                                    <select name="nationality_id" class="select2 form-select nationality_select2"
                                        data-allow-clear="true">
                                        @if (old('nationality_id'))
                                            <option value="{{ request('nationality_id') }}" selected>
                                                {{ Nationality::find(request('nationality_id'))?->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>


                                <!-- الموظفين -->
                                {{-- <div class="col-md-4">
                                    <label class="form-label" for="formtabs-country">الموظف</label>
                                    <select class="select2 form-select" name="employee_search" data-allow-clear="true">
                                        <option selected value="">-- أختر
                                            الموظف --
                                        </option>
                                        @foreach ($other['employees'] as $employee)
                                            <option @if (request('employee_search') == $employee->id) selected @endif
                                                value="{{ $employee->id }}">
                                                {{ $employee->name }} &larr; {{ $employee->employee_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}


                            </div>
                            <div class="col-3 mx-auto mb-3 text-center">
                                <button type="submit" class="btn btn-md btn-primary">فلتر <i
                                        class="fa-solid fa-filter mx-1"></i></button>

                                <a href="javascript:void(0)" onclick="resetFilters()" class="btn btn-secondary">إمسح<i
                                        class="fa-solid fa-broom mx-1"></i></a>


                            </div>
                        </div>
                    </div>

</form>
@push('js')

@endpush
