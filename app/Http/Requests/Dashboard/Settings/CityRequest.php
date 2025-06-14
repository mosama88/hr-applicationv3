<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        $cityId = $this->route('city') ? $this->route('city')->id : null;

        return [
            'name' => 'required|unique:cities,name,' . $cityId,
            'governorate_id' => 'required|exists:governorates,id',
            'active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم المدينة مطلوب',
            'name.unique' => 'اسم المدينة موجود بالفعل',
            'governorate_id.required' => 'المحافظة مطلوبة',
        ];
    }
}
