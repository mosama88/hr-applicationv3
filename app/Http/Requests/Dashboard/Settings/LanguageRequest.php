<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        $languageId = $this->route('language') ? $this->route('language')->id : null;

        return [
            'name' => 'required|unique:languages,name,' . $languageId,
            'active' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم اللغه مطلوب.',
            'name.unique' => 'اسم اللغه مستخدم من قبل.',
        ];
    }
}