<?php

namespace App\Http\Requests\Dashboard\EmployeeAffairs;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatusActiveEnum;
use Illuminate\Validation\Rule;
class DiscountTypeRequest extends FormRequest
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
        $discount_typeId = $this->route('discount_type') ? $this->route('discount_type')->id : null;

        return [
            'name' => 'required|unique:discount_types,name,' . $discount_typeId,
            'active' => [
                'nullable',
                Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم نوع الخصم مطلوب',
            'name.unique' => 'اسم نوع الخصم موجود بالفعل',
        ];
    }
}