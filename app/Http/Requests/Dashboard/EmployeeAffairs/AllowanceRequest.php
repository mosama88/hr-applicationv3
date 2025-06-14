<?php

namespace App\Http\Requests\Dashboard\EmployeeAffairs;

use Illuminate\Foundation\Http\FormRequest;

class AllowanceRequest extends FormRequest
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
        $allowanceId = $this->route('allowance') ? $this->route('allowance')->id : null;

        return [
            'name' => 'required|unique:allowances,name,' . $allowanceId,
            'active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم نوع البدلات مطلوب',
            'name.unique' => 'اسم نوع البدلات موجود بالفعل',
        ];
    }
}
