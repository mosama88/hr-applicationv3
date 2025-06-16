<?php

namespace App\Http\Requests\Dashboard\EmployeeAffairs;

use App\Enums\YesOrNoEnum;
use App\Enums\AdminGenderEnum;
use App\Enums\StatusActiveEnum;
use Illuminate\Validation\Rule;
use App\Enums\Employee\ReligionEnum;
use App\Enums\Employee\SocialStatus;
use App\Enums\Employee\MotivationType;
use App\Enums\Employee\FunctionalStatus;
use App\Enums\Employee\TypeSalaryReceipt;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Employee\GraduationEstimateEnum;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //     $employeeId = $this->route('employee') ? $this->route('employee')->id : null;

    //     return [
    //         'fp_code' => 'required|unique:employees,fp_code,' . $employeeId,
    //         'name' => 'required|min:7|unique:employees,name,' . $employeeId,
    //         'gender' => [
    //             'required',
    //             Rule::in(array_column(AdminGenderEnum::cases(), 'value')),
    //         ],
    //         'branch_id' => 'required|exists:branches,id',
    //         'job_grade_id' => 'nullable|exists:job_grades,id',
    //         'qualification_id' => 'required|exists:qualifications,id', // المؤهل الدراسي
    //         'qualification_year' => 'nullable|digits:4|integer|min:1950|max:' . date('Y'),
    //         'major' => 'nullable', // تخصص التخرج
    //         'graduation_estimate' => [
    //             'required',
    //             Rule::in(array_column(GraduationEstimateEnum::cases(), 'value')),
    //         ],
    //         'birth_date' => 'required|date', // تاريخ الميلاد
    //         'national_id' => 'required|unique:employees,national_id|max:14|min:14', //رقم الهوية
    //         'end_national_id' => 'required|date', //
    //         'national_id_place' => 'required', //
    //         'blood_type_id' => 'nullable|exists:blood_types,id', // فصيلة الدم
    //         'religion' => [
    //             'required',
    //             Rule::in(array_column(ReligionEnum::cases(), 'value')),
    //         ],

    //         'language_id' => 'required|exists:languages,id', // اللغة الاساسية
    //         'email' => 'required|unique:employees,email,' . $employeeId,

    //         'country_id' => 'required|exists:countries,id', // الدول
    //         'governorate_id' => 'required|exists:governorates,id', // المحافظات
    //         'city_id' => 'required|exists:cities,id', // المدينة/المركز
    //         'home_telephone' => 'required', //  هاتف المنزل
    //         'mobile' => 'required', // هاتف المحمول
    //         'address' => 'required|string|min:5|max:300',
    //         'military' => 'required',
    //         'military_service_start_date' => 'nullable',
    //         'military_service_end_date' => 'nullable',
    //         'military_wepon' => 'nullable',
    //         'military_exemption_date' => 'nullable',
    //         'military_exemption_reason' => 'nullable',
    //         'military_postponement_reason' => 'nullable',
    //         'military_postponement_date' => 'nullable',
    //         'date_resignation' => 'nullable',
    //         'resignation_reason' => 'nullable',
    //         'driving_license' => 'nullable',
    //         'driving_license_type' => 'nullable',
    //         'driving_License_id' => 'nullable',
    //         'has_relatives' => 'nullable',
    //         'relatives_details' => 'nullable',
    //         'notes' => 'nullable',
    //         'hiring_date' => 'required|date',
    //         'functional_status' => [
    //             'required',
    //             Rule::in(array_column(FunctionalStatus::cases(), 'value')),
    //         ],
    //         'department_id' => ['nullable','exists:departments,id'],
    //         'job_category_id' => 'nullable|exists:job_categories,id',
    //         'has_attendance' => [
    //             'required',
    //             Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
    //         ],
    //         'has_fixed_shift' => [
    //             'required',
    //             Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
    //         ],
    //         'shifts_type_id' => 'required|exists:shifts_types,id',
    //         'daily_work_hour' => 'required',
    //         'salary' => 'required',
    //         'day_price' => 'required',
    //         'currency_id' => 'nullable|exists:currencies,id',
    //         'bank_number_account' => 'nullable',
    //         'motivation_type' => [
    //             'required',
    //             Rule::in(array_column(MotivationType::cases(), 'value')),
    //         ],
    //         'motivation_value' => 'nullable',
    //         'has_social_insurance' => [
    //             'required',
    //             Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
    //         ],
    //         'social_insurance_cut_monthely' => 'nullable',
    //         'social_insurance_number' => 'nullable',
    //         'has_medical_insurance' => [
    //             'required',
    //             Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
    //         ],
    //         'medical_insurance_cut_monthely' => 'nullable',
    //         'medical_insurance_number' => 'nullable',
    //         'type_salary_receipt' => [
    //             'required',
    //             Rule::in(array_column(TypeSalaryReceipt::cases(), 'value')),
    //         ],
    //         'has_vacation_balance' => [
    //             'required',
    //             Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
    //         ],
    //         'urgent_person_details' => 'nullable',
    //         'children_number' => 'nullable',
    //         'social_status' => [
    //             'required',
    //             Rule::in(array_column(SocialStatus::cases(), 'value')),
    //         ],
    //         'has_disabilities' => [
    //             'required',
    //             Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
    //         ],
    //         'disabilities_details' => 'nullable',
    //         'nationality_id' => 'required|exists:nationalities,id',
    //         'pasport_identity' => 'nullable',
    //         'pasport_exp_date' => 'nullable|date',
    //         'has_fixed_allowances' => [
    //             'required',
    //             Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
    //         ],
    //         'is_done_Vacation_formula' => 'nullable',
    //         'is_Sensitive_manager_data' => 'nullable',
    //         'active' => [
    //             'nullable',
    //             Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
    //         ],
    //        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

    //     ];
    // }


    public function rules(): array
    {
        $employeeId = $this->route('employee') ? $this->route('employee')->id : null;

        return [
            'fp_code' => 'nullable|unique:employees,fp_code,' . $employeeId,
            'name' => 'nullable|min:7|unique:employees,name,' . $employeeId,
            'gender' => [
                'nullable',
                Rule::in(array_column(AdminGenderEnum::cases(), 'value')),
            ],
            'branch_id' => 'nullable|exists:branches,id',
            'job_grade_id' => 'nullable|exists:job_grades,id',
            'qualification_id' => 'nullable|exists:qualifications,id', // المؤهل الدراسي
            'qualification_year' => 'nullable|digits:4|integer|min:1950|max:' . date('Y'),
            'major' => 'nullable', // تخصص التخرج
            'graduation_estimate' => [
                'nullable',
                Rule::in(array_column(GraduationEstimateEnum::cases(), 'value')),
            ],
            'birth_date' => 'nullable|date', // تاريخ الميلاد
            'national_id' => 'nullable|unique:employees,national_id|max:14|min:14', //رقم الهوية
            'end_national_id' => 'nullable|date', //
            'national_id_place' => 'nullable', //
            'blood_type_id' => 'nullable|exists:blood_types,id', // فصيلة الدم
            'religion' => [
                'nullable',
                Rule::in(array_column(ReligionEnum::cases(), 'value')),
            ],

            'language_id' => 'nullable|exists:languages,id', // اللغة الاساسية
            'email' => 'nullable|unique:employees,email,' . $employeeId,

            'country_id' => 'nullable|exists:countries,id', // الدول
            'governorate_id' => 'nullable|exists:governorates,id', // المحافظات
            'city_id' => 'nullable|exists:cities,id', // المدينة/المركز
            'home_telephone' => 'nullable', //  هاتف المنزل
            'mobile' => 'nullable', // هاتف المحمول
            'address' => 'nullable|string|min:5|max:300',
            'military' => 'nullable',
            'military_service_start_date' => 'nullable',
            'military_service_end_date' => 'nullable',
            'military_wepon' => 'nullable',
            'military_exemption_date' => 'nullable',
            'military_exemption_reason' => 'nullable',
            'military_postponement_reason' => 'nullable',
            'military_postponement_date' => 'nullable',
            'date_resignation' => 'nullable',
            'resignation_reason' => 'nullable',
            'driving_license' => 'nullable',
            'driving_license_type' => 'nullable',
            'driving_License_id' => 'nullable',
            'has_relatives' => 'nullable',
            'relatives_details' => 'nullable',
            'notes' => 'nullable',
            'hiring_date' => 'nullable|date',
            'functional_status' => [
                'nullable',
                Rule::in(array_column(FunctionalStatus::cases(), 'value')),
            ],
            'department_id' => ['nullable', 'exists:departments,id'],
            'job_category_id' => 'nullable|exists:job_categories,id',
            'has_attendance' => [
                'nullable',
                Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
            ],
            'has_fixed_shift' => [
                'nullable',
                Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
            ],
            'shifts_type_id' => 'nullable|exists:shifts_types,id',
            'daily_work_hour' => 'nullable',
            'salary' => 'nullable',
            'day_price' => 'nullable',
            'currency_id' => 'nullable|exists:currencies,id',
            'bank_number_account' => 'nullable',
            'motivation_type' => [
                'nullable',
                Rule::in(array_column(MotivationType::cases(), 'value')),
            ],
            'motivation_value' => 'nullable',
            'has_social_insurance' => [
                'nullable',
                Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
            ],
            'social_insurance_cut_monthely' => 'nullable',
            'social_insurance_number' => 'nullable',
            'has_medical_insurance' => [
                'nullable',
                Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
            ],
            'medical_insurance_cut_monthely' => 'nullable',
            'medical_insurance_number' => 'nullable',
            'type_salary_receipt' => [
                'nullable',
                Rule::in(array_column(TypeSalaryReceipt::cases(), 'value')),
            ],
            'has_vacation_balance' => [
                'nullable',
                Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
            ],
            'urgent_person_details' => 'nullable',
            'children_number' => 'nullable',
            'social_status' => [
                'nullable',
                Rule::in(array_column(SocialStatus::cases(), 'value')),
            ],
            'has_disabilities' => [
                'nullable',
                Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
            ],
            'disabilities_details' => 'nullable',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'pasport_identity' => 'nullable',
            'pasport_exp_date' => 'nullable|date',
            'has_fixed_allowances' => [
                'nullable',
                Rule::in(array_column(YesOrNoEnum::cases(), 'value')),
            ],
            'is_done_Vacation_formula' => 'nullable',
            'is_Sensitive_manager_data' => 'nullable',
            'active' => [
                'nullable',
                Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
            ],
        ];
    }




    public function messages(): array
    {
        return [
            'fp_code.required' => 'كود البصمة مطلوب.',
            'fp_code.unique' => 'كود البصمة مستخدم من قبل.',

            'name.required' => 'اسم الموظف مطلوب.',
            'name.min' => 'يجب ألا يقل الاسم عن 7 أحرف.',
            'name.unique' => 'اسم الموظف مستخدم من قبل.',

            'gender.required' => 'النوع مطلوب.',
            'gender.in' => 'النوع المحدد غير صحيح.',

            'branch_id.required' => 'الفرع مطلوب.',
            'branch_id.exists' => 'الفرع المحدد غير موجود.',

            'job_grade_id.required' => 'يرجى اختيار الدرجة الوظيفية.',
            'job_grade_id.exists' => 'الدرجة الوظيفية المختارة غير صحيحة.',

            'qualification_id.required' => 'المؤهل الدراسي مطلوب.',
            'qualification_id.exists' => 'المؤهل الدراسي المحدد غير موجود.',

            'qualification_year.digits' => 'سنة التخرج يجب أن تتكون من 4 أرقام.',
            'qualification_year.integer' => 'سنة التخرج يجب أن تكون عددًا صحيحًا.',
            'qualification_year.min' => 'سنة التخرج يجب ألا تقل عن 1950.',
            'qualification_year.max' => 'سنة التخرج يجب ألا تتجاوز السنة الحالية.',

            'graduation_estimate.required' => 'تقدير التخرج مطلوب.',
            'graduation_estimate.in' => 'تقدير التخرج المحدد غير صحيح.',

            'birth_date.required' => 'تاريخ الميلاد مطلوب.',
            'birth_date.date' => 'تنسيق تاريخ الميلاد غير صحيح.',

            'national_id.required' => 'رقم الهوية مطلوب.',
            'national_id.unique' => 'رقم الهوية مستخدم من قبل.',
            'national_id.max' => 'رقم الهوية يجب أن يتكون من 14 رقم.',
            'national_id.min' => 'رقم الهوية يجب أن يتكون من 14 رقم.',

            'end_national_id.required' => 'تاريخ انتهاء الهوية مطلوب.',
            'end_national_id.date' => 'تنسيق تاريخ انتهاء الهوية غير صحيح.',

            'national_id_place.required' => 'مكان إصدار الهوية مطلوب.',

            'blood_type_id.exists' => 'فصيلة الدم المحددة غير موجودة.',

            'religion.required' => 'الديانة مطلوبة.',
            'religion.in' => 'الديانة المحددة غير صحيحة.',

            'language_id.required' => 'اللغة الأساسية مطلوبة.',
            'language_id.exists' => 'اللغة المحددة غير موجودة.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل.',

            'country_id.required' => 'الدولة مطلوبة.',
            'country_id.exists' => 'الدولة المحددة غير موجودة.',

            'governorate_id.required' => 'المحافظة مطلوبة.',
            'governorate_id.exists' => 'المحافظة المحددة غير موجودة.',

            'city_id.required' => 'المدينة مطلوبة.',
            'city_id.exists' => 'المدينة المحددة غير موجودة.',

            'home_telephone.required' => 'رقم هاتف المنزل مطلوب.',
            'mobile.required' => 'رقم المحمول مطلوب.',

            'address.required' => 'العنوان مطلوب.',
            'address.string' => 'العنوان يجب أن يكون نصًا.',
            'address.min' => 'العنوان يجب أن يحتوي على 5 أحرف على الأقل.',
            'address.max' => 'العنوان يجب ألا يزيد عن 300 حرف.',

            'military.required' => 'موقف التجنيد مطلوب.',
            'military.string' => 'موقف التجنيد يجب أن يكون نصًا.',
            'military.min' => 'موقف التجنيد يجب أن يحتوي على 5 أحرف على الأقل.',
            'military.max' => 'موقف التجنيد يجب ألا يزيد عن 300 حرف.',

            'hiring_date.required' => 'تاريخ التعيين مطلوب.',
            'hiring_date.date' => 'تنسيق تاريخ التعيين غير صحيح.',

            'functional_status.required' => 'الحالة الوظيفية مطلوبة.',
            'functional_status.in' => 'الحالة الوظيفية المحددة غير صحيحة.',

            'department_id.required' => 'القسم مطلوب.',
            'department_id.exists' => 'القسم المحدد غير موجود.',

            'job_category_id.required' => 'الفئة الوظيفية مطلوبة.',
            'job_category_id.exists' => 'الفئة الوظيفية المحددة غير موجودة.',

            'has_attendance.required' => 'حقل الحضور مطلوب.',
            'has_attendance.in' => 'قيمة الحضور غير صحيحة.',

            'has_fixed_shift.required' => 'حقل دوام ثابت مطلوب.',
            'has_fixed_shift.in' => 'قيمة الدوام الثابت غير صحيحة.',

            'shifts_type_id.required' => 'نوع الورديات مطلوب.',
            'shifts_type_id.exists' => 'نوع الورديات المحدد غير موجود.',

            'daily_work_hour.required' => 'عدد ساعات العمل اليومية مطلوب.',

            'salary.required' => 'الراتب الشهري مطلوب.',
            'day_price.required' => 'الراتب اليومي مطلوب.',

            'currency_id.required' => 'العملة مطلوبة.',
            'currency_id.exists' => 'العملة المحددة غير موجودة.',

            'motivation_type.required' => 'نوع الحافز مطلوب.',
            'motivation_type.in' => 'نوع الحافز المحدد غير صحيح.',

            'has_social_insurance.required' => 'بيان التأمين الاجتماعي مطلوب.',
            'has_social_insurance.in' => 'قيمة التأمين الاجتماعي غير صحيحة.',

            'has_medical_insurance.required' => 'بيان التأمين الطبي مطلوب.',
            'has_medical_insurance.in' => 'قيمة التأمين الطبي غير صحيحة.',

            'type_salary_receipt.required' => 'نوع استلام الراتب مطلوب.',
            'type_salary_receipt.in' => 'نوع استلام الراتب غير صحيح.',

            'has_vacation_balance.required' => 'رصيد الإجازات مطلوب.',
            'has_vacation_balance.in' => 'قيمة رصيد الإجازات غير صحيحة.',

            'social_status.required' => 'الحالة الاجتماعية مطلوبة.',
            'social_status.in' => 'الحالة الاجتماعية غير صحيحة.',

            'has_disabilities.required' => 'بيان وجود إعاقة مطلوب.',
            'has_disabilities.in' => 'قيمة الإعاقة غير صحيحة.',

            'nationality_id.required' => 'الجنسية مطلوبة.',
            'nationality_id.exists' => 'الجنسية المحددة غير موجودة.',

            'pasport_exp_date.date' => 'تاريخ انتهاء جواز السفر غير صحيح.',

            'has_fixed_allowances.required' => 'بيان وجود بدلات ثابتة مطلوب.',
            'has_fixed_allowances.in' => 'قيمة البدلات الثابتة غير صحيحة.',

            'active.in' => 'حالة التفعيل غير صحيحة.',
        ];
    }
}
