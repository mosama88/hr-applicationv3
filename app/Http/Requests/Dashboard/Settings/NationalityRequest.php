<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class NationalityRequest extends FormRequest
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
        $nationalityId = $this->route('nationality') ? $this->route('nationality')->id : null;

        return [
            'name' => 'required|unique:nationalities,name,' . $nationalityId,
            'active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الجنسية مطلوب',
            'name.unique' => 'اسم الجنسية موجود بالفعل',
        ];
    }
}
