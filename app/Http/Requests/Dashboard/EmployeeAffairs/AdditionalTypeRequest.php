<?php

namespace App\Http\Requests\Dashboard\EmployeeAffairs;

use Illuminate\Foundation\Http\FormRequest;

class AdditionalTypeRequest extends FormRequest
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
        $additional_typeId = $this->route('additional_type') ? $this->route('additional_type')->id : null;

        return [
            'name' => 'required|unique:additional_types,name,' . $additional_typeId,
            'active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم نوع الأضافى مطلوب',
            'name.unique' => 'اسم نوع الأضافى موجود بالفعل',
        ];
    }
}
