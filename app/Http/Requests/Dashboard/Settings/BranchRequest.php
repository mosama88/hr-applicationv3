<?php

namespace App\Http\Requests\Dashboard\Settings;

use App\Models\Branch;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatusActiveEnum;
use Illuminate\Validation\Rule;
class BranchRequest extends FormRequest
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
        $branchId = $this->route('branch') ? $this->route('branch')->id : null;
        return [
            'name' => 'required|unique:branches,name,' . $branchId,
            'email' => 'required|email',
            'phones' => 'required',
            'address' => 'required',
            'active' => [
                'nullable',
                Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الفرع مطلوب',
            'name.unique' => 'اسم الفرع موجود',
            'email.required' => 'البريد الالكترونى للفرع مطلوب',
            'email.email' => 'برجاء كتابة البريد الالكترونى بطريقة صحيحة',
            'phones.required' => 'هاتف الفرع مطلوب',
            'address.required' => 'عنوان الفرع مطلوب',

        ];
    }
}