<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatusActiveEnum;
use Illuminate\Validation\Rule;
class JobsCategoryRequest extends FormRequest
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
        $jobCategoryId = $this->route('jobCategory') ? $this->route('jobCategory')->id : null;

        return [
            'name' => 'required|unique:job_categories,name,' . $jobCategoryId,
            'active' => [
                'nullable',
                Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الوظيفة مطلوب',
            'name.unique' => 'اسم الوظيفة موجود بالفعل',
        ];
    }
}