<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class BloodTypeRequest extends FormRequest
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
        $bloodTypeId = $this->route('bloodType') ? $this->route('bloodType')->id : null;

        return [
            'name' => 'required|unique:blood_types,name,' . $bloodTypeId,
            'active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم فصيلة الدم مطلوب',
            'name.unique' => 'اسم فصيلة الدم موجود بالفعل',
        ];
    }
}
