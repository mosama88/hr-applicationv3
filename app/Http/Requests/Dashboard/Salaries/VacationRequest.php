<?php

namespace App\Http\Requests\Dashboard\Salaries;

use Illuminate\Foundation\Http\FormRequest;

class VacationRequest extends FormRequest
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
            'name' => 'required',
            'active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم مطلوب',
        ];
    }
}
