<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatusActiveEnum;
use Illuminate\Validation\Rule;
class JobGradeRequest extends FormRequest
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
        $job_gradeId = $this->route('job_grade') ? $this->route('job_grade')->id : null;

        return [
            'name' => 'required|unique:job_grades,name,' . $job_gradeId,
            'job_grades_code' => 'nullable',
            'min_salary' => 'required',
            'max_salary' => 'required|gt:min_salary',
            'notes' => 'nullable',
            'active' => [
                'nullable',
                Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم نوع الدرجه مطلوب',
            'name.unique' => 'اسم نوع الدرجه موجود بالفعل',
            'min_salary.required' => 'الحد الأدنى للمرتب مطلوب',
            'max_salary.required' => 'الحد الأقصى مطلوب',
            'max_salary.gt' => 'يجب أن يكون الحد الأقصى للراتب أكبر من الحد الأدنى للراتب',
        ];
    }
}