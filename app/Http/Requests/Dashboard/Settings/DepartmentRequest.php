<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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

        $departmentId = $this->route('department') ? $this->route('department')->id : null;

        return [
            'name' => 'required|unique:departments,name,' . $departmentId,
            'phones' => 'required',
            'notes' => 'required',
            'active' => 'nullable|in:2,1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الادارة مطلوب',
            'name.unique' => 'اسم الادارة موجود بالفعل',
            'phones.required' => 'هاتف الادارة مطلوب',
            'notes.required' => 'ملاحظات الادارة مطلوب',

        ];
    }
}
