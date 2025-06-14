<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateRequest extends FormRequest
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
        $governorateId = $this->route('governorate') ? $this->route('governorate')->id : null;

        return [
            'name' => 'required|unique:governorates,name,' . $governorateId,
            'country_id' => 'required|exists:countries,id',
            'active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم المحافظة مطلوب',
            'name.unique' => 'اسم المحافظة موجوده بالفعل',
            'country_id.required' => 'البلد مطلوبة',
        ];
    }
}
