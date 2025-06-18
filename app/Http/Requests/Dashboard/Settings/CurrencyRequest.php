<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatusActiveEnum;
use Illuminate\Validation\Rule;
class CurrencyRequest extends FormRequest
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
        $currencyId = $this->route('currency') ? $this->route('currency')->id : null;

        return [
            'name' => 'required|unique:currencies,name,' . $currencyId,
            'currency_symbol' => 'required|unique:currencies,currency_symbol,' . $currencyId,
            'active' => [
                'nullable',
                Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم العملة مطلوب.',
            'name.unique' => 'اسم العملة مستخدم من قبل.',
            'currency_symbol.required' => 'كود العملة مطلوب.',
            'currency_symbol.unique' => 'كود العملة مستخدم من قبل.',
        ];
    }
}