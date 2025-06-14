<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class QualificationRequest extends FormRequest
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
        $qualificationId = $this->route('qualification') ? $this->route('qualification')->id : null;

        return [
            'name' => 'required|unique:qualifications,name,' . $qualificationId,
            'active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم المؤهل مطلوب',
            'name.unique' => 'اسم المؤهل موجود بالفعل',

        ];
    }
}