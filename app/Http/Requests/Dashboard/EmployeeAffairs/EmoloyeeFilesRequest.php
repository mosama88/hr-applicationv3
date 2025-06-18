<?php

namespace App\Http\Requests\Dashboard\EmployeeAffairs;

use Illuminate\Foundation\Http\FormRequest;

class EmoloyeeFilesRequest extends FormRequest
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
        $employeeFileId = $this->route('employeeFile') ? $this->route('employeeFile')->id : null;

        return [
            'file_name' => 'required|string|unique:employees,name,' . $employeeFileId,
            'upload_file' => 'required|mimes:pdf,png,jpg,jpeg,doc,docx|max:10240' // 10MB
        ];
    }

    public function messages()
    {
        return [
            'file_name.required' => 'اسم الملف مطلوب',
            'file_name.unique' => 'أسم الملف موجود بالفعل',
            'upload_file.required' => 'مرفق الملف مطلوب',
            'upload_file.mimes' => ' (pdf,png, jpg, jpeg, doc, docx)يجب ان يكون الملف من نوع ',
        ];
    }
}
