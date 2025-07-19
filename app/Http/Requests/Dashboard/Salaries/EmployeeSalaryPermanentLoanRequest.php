<?php

namespace App\Http\Requests\Dashboard\Salaries;

use App\Enums\IsArchivedEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\PermanentLoan\PermanentLoanhasParentDisbursedDoneEnum;

class EmployeeSalaryPermanentLoanRequest extends FormRequest
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
            'employee_code' => 'required',
            'employee_salary' => 'required|numeric|min:0',
            'total' => 'required|min:0',
            'month_number_installment' => 'required|integer|min:1',
            'month_installment_value' => 'required|min:0',
            'year_month_start' => 'nullable|string|max:20',
            'year_month_start_date' => 'required|date',
            'installment_paid' => 'nullable|min:0',
            'installment_remain' => 'nullable|min:0',
            'notes' => 'nullable|string',
            'has_disbursed_done' => [
                'nullable',
                Rule::in(array_column(PermanentLoanhasParentDisbursedDoneEnum::cases(), 'value')),
            ],
            'disbursed_by' => 'nullable|exists:admins,id',
            'disbursed_at' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_code.required' => 'كود الموظف مطلوب.',

            'employee_salary.required' => 'مرتب الموظف مطلوب.',
            'employee_salary.numeric' => 'مرتب الموظف يجب أن يكون رقمًا.',
            'employee_salary.min' => 'مرتب الموظف لا يمكن أن يكون أقل من 0.',

            'total.required' => 'إجمالي القرض أو السلفة مطلوب.',
            'total.min' => 'إجمالي القرض أو السلفة لا يمكن أن يكون أقل من 0.',

            'month_number_installment.required' => 'عدد أشهر الأقساط مطلوب.',
            'month_number_installment.integer' => 'عدد أشهر الأقساط يجب أن يكون رقمًا صحيحًا.',
            'month_number_installment.min' => 'عدد الأشهر يجب أن يكون على الأقل 1.',


            'month_installment_value.required' => 'قيمة القسط الشهري مطلوب.',
            'month_installment_value.min' => 'قيمة القسط الشهري لا يمكن أن تكون أقل من 0.',

            'year_month_start.max' => 'بداية السداد لا يجب أن تتجاوز 20 حرفًا.',
            'year_month_start.string' => 'بداية السداد يجب أن تكون نصًا.',

            'year_month_start_date.required' => 'تاريخ بداية السداد مطلوب.',
            'year_month_start_date.date' => 'تاريخ بداية السداد غير صالح.',

            'installment_paid.min' => 'القسط المدفوع لا يمكن أن يكون أقل من 0.',

            'installment_remain.min' => 'القسط المتبقي لا يمكن أن يكون أقل من 0.',

            'notes.string' => 'الملاحظات يجب أن تكون نصًا.',

            'has_disbursed_done.in' => 'حالة الصرف يجب أن تكون إما 0 أو 1 فقط.',

            'disbursed_by.exists' => 'المستخدم الذي صرف السلفة غير موجود.',

            'disbursed_at.date' => 'تاريخ الصرف غير صالح.',

        ];
    }
}