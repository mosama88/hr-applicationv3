<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatusActiveEnum;
use Illuminate\Validation\Rule;
class CountryRequest extends FormRequest
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
        $countryId = $this->route('country') ? $this->route('country')->id : null;

        return [
            'name' => 'required|unique:countries,name,' . $countryId,
            'country_code' => 'required|unique:countries,country_code,' . $countryId,
            'active' => [
                'nullable',
                Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم الدولة مطلوب.',
            'name.unique' => 'اسم الدولة مستخدم من قبل.',
            'country_code.required' => 'كود الدولة مطلوب.',
            'country_code.unique' => 'كود الدولة مستخدم من قبل.',
        ];
    }
}