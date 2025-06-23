<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class FinanceClnPeriodRequest extends FormRequest
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
            'finance_calendar_id' => 'nullable|exists:finance_calendars,id',
            'finance_yr' => 'nullable',
            'year_and_month' => 'nullable',
            'start_date_m' => 'nullable',
            'end_date_m' => 'nullable',
            'number_of_days' => 'nullable',
            'start_date_fp' => 'required|date',
            'end_date_fp' => 'required|date|after:start_date_fp',
            'is_open' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'finance_yr.required' => 'كود السنة المالية مطلوب',
            'finance_yr.string' => 'برجاء كتابة السنه بشكل صحيح ',
            'finance_yr.unique' => 'كود السنة مسجل من قبل ',
            'finance_yr_desc' => 'وصف السنة المالية مطلوب',
            'start_date.required' => 'تاريخ بداية السنة المالية مطلوب',
            'end_date.required' => 'تاريخ نهاية السنة المالية مطلوب',
            'end_date.after' => 'يجب أن يكون تاريخًا بعد بداية السنه المالية.',

        ];
    }
}
