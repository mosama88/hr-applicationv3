<?php

namespace App\Http\Requests\Dashboard\Salaries;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeSalaryAdditionalRequest extends FormRequest
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
            'value' => 'required',
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

            'sanctions_type.required' => 'يجب اختيار نوع الاضافى.',
            'sanctions_type.in' => 'نوع الاضافى غير صالح.',

            'value.required' => 'يجب إدخال قيمة الاضافى.',
            'total.required' => 'يجب إدخال إجمالي الخصم.',

            'notes.max' => 'لا يجب أن يتجاوز حقل الملاحظات 500 حرف.',
            'notes.string' => 'حقل الملاحظات يجب أن يكون نصاً.',
        ];
    }
}