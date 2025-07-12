<?php

namespace App\Http\Requests\Dashboard;

use App\Enums\AdminGenderEnum;
use App\Enums\StatusActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $adminId = $this->route('admin') ? $this->route('admin')->id : null;

        return [

            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $adminId,
            'email' => 'required|email|unique:admins,email,' . $adminId,
            'mobile' => 'required|string|max:20|unique:admins,mobile,' . $adminId,
            'password' => 'nullable|string|min:6|confirmed',
            'active' => [
                'nullable',
                Rule::in(array_column(StatusActiveEnum::cases(), 'value')),
            ],

            'gender' => [
                'required',
                Rule::in(array_column(AdminGenderEnum::cases(), 'value')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يجب أن يزيد عن 255 حرفًا.',

            'slug.string' => 'المعرف النصي يجب أن يكون نصًا.',
            'slug.unique' => 'المعرف النصي مستخدم من قبل.',

            'username.required' => 'اسم المستخدم مطلوب.',
            'username.string' => 'اسم المستخدم يجب أن يكون نصًا.',
            'username.unique' => 'اسم المستخدم مستخدم من قبل.',
            'username.max' => 'اسم المستخدم لا يجب أن يزيد عن 255 حرفًا.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.unique' => 'البريد الإلكتروني مستخدم من قبل.',

            'mobile.required' => 'رقم الجوال مطلوب.',
            'mobile.string' => 'رقم الجوال يجب أن يكون نصًا.',
            'mobile.unique' => 'رقم الجوال مستخدم من قبل.',
            'mobile.max' => 'رقم الجوال لا يجب أن يزيد عن 20 رقمًا.',

            'password.string' => 'كلمة المرور يجب أن تكون نصًا.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 6 أحرف.',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق.',

            'gender.required' => 'نوع الجنس مطلوب.',
            'gender.in' => 'الجنس يجب أن يكون  (ذكر) أو  (أنثى).',

            'active.in' => 'حالة التفعيل يجب أن تكون إما  (غير مفعل) أو  (مفعل).',
        ];
    }
}