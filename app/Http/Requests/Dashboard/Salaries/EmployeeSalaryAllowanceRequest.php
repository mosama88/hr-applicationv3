<?php

namespace App\Http\Requests\Dashboard\Salaries;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeSalaryAllowanceRequest extends FormRequest
{
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
            'allowance_id' => 'required|exists:allowances,id',
            'total' => 'required',
            'notes' => 'nullable|string|max:500',
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

            'allowance_id.required' => 'يجب اختيار نوع البدل.',
            'allowance_id.in' => 'نوع البدل غير موجود.',

            'total.required' => 'يجب إدخال إجمالي البدل.',

            'notes.max' => 'لا يجب أن يتجاوز حقل الملاحظات 500 حرف.',
            'notes.string' => 'حقل الملاحظات يجب أن يكون نصاً.',
        ];
    }
}