<?php

namespace App\Http\Requests\Dashboard\Salaries;

use Illuminate\Validation\Rule;
use App\Enums\Salaries\SanctionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeSalarySanctionsRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'main_salary_employee_id' => 'required|exists:employees,id',
            'finance_cln_period_id' => 'required',
            'employee_code' => 'required',
            'day_price' => 'required',
            'sanctions_type' => [
                'required',
                Rule::in(array_column(SanctionTypeEnum::cases(), 'value')),
            ],
            'value' => 'required',
            'total' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'main_salary_employee_id.required' => 'يجب اختيار الموظف.',
            'main_salary_employee_id.exists' => 'الموظف المختار غير موجود.',

            'finance_cln_period_id.required' => 'يجب اختيار الشهر المالي.',
            'employee_code.required' => 'يجب إدخال كود الموظف.',
            'day_price.required' => 'يجب إدخال قيمة أجر اليوم.',

            'sanctions_type.required' => 'يجب اختيار نوع الجزاء.',
            'sanctions_type.in' => 'نوع الجزاء غير صالح.',

            'value.required' => 'يجب إدخال قيمة الجزاء.',
            'total.required' => 'يجب إدخال إجمالي الخصم.',
        ];
    }
}