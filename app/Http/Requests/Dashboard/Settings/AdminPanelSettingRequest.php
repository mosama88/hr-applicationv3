<?php

namespace App\Http\Requests\Dashboard\Settings;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class AdminPanelSettingRequest extends FormRequest
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
        $admin_panel_settingsId = $this->route('admin_panel_settings') ? $this->route('admin_panel_settings')->id : null;

        return [
            'mobile' => 'required|max:15', // تحقق من أن الهاتف يحتوي على 10 أرقام
            'address' => 'required|string|max:255|unique:admin_panel_settings,email' . $admin_panel_settingsId, // تحقق من أن العنوان نصي ولا يتجاوز 255 حرف
            'email' => 'required|email|max:255', // تحقق من أن البريد الإلكتروني صالح
            'system_status' => 'required|string|in:1,2',
            'max_hours_take_fp_as_addtional' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'after_minute_calculate_delay' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'after_minute_calculate_early_departure' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'after_minute_quarterday' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'after_time_half_daycut' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'after_time_allday_daycut' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'less_than_minute_neglecting_fp' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'monthly_vacation_balance' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'after_days_begin_vacation' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'first_balance_begin_vacation' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'sanctions_value_first_absence' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'sanctions_value_second_absence' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'sanctions_value_thaird_absence' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'sanctions_value_forth_absence' => 'required|numeric|min:1', // تحقق من أن العدد هو رقم صحيح
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // تحقق من أن الصورة هي صورة صحيحة
        ];
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'mobile.required' => 'يجب إدخال رقم هاتف الشركة.',
            'mobile.max' => 'رقم الهاتف يجب أن يكون أقل من 15 رقم.',
            'address.required' => 'يجب إدخال عنوان الشركة.',
            'address.string' => 'عنوان الشركة يجب أن يكون نصًا.',
            'address.max' => 'عنوان الشركة لا يجب أن يتجاوز 255 حرفًا.',
            'email.required' => 'يجب إدخال بريد الشركة.',
            'email.email' => 'البريد الإلكتروني يجب أن يكون صالحًا.',
            'email.max' => 'البريد الإلكتروني لا يجب أن يتجاوز 255 حرفًا.',
            'email.unique' => 'البريد الإلكتروني مسجل من قبل.',
            'system_status.required' => 'يجب اختيار حالة التفعيل.',
            'system_status.in' => 'الحالة المختارة غير صالحة.',
            'max_hours_take_fp_as_addtional.required' => 'يجب إدخال الحد الأقصى لاحتساب ساعات العمل الإضافية.',
            'max_hours_take_fp_as_addtional.numeric' => 'الحد الأقصى لاحتساب ساعات العمل الإضافية يجب أن يكون رقمًا.',
            'max_hours_take_fp_as_addtional.min' => 'الحد الأقصى لاحتساب ساعات العمل الإضافية يجب أن يكون أكبر من 0.',
            'after_minute_calculate_delay.required' => 'يجب إدخال عدد الدقائق لاحتساب تأخير الحضور.',
            'after_minute_calculate_delay.numeric' => 'عدد الدقائق يجب أن يكون رقماً.',
            'after_minute_calculate_delay.min' => 'عدد الدقائق يجب أن يكون أكبر من 0.',
            'after_minute_calculate_early_departure.required' => 'يجب إدخال عدد الدقائق لاحتساب انصراف مبكر.',
            'after_minute_calculate_early_departure.numeric' => 'عدد الدقائق يجب أن يكون رقماً.',
            'after_minute_calculate_early_departure.min' => 'عدد الدقائق يجب أن يكون أكبر من 0.',
            'after_minute_quarterday.required' => 'يجب إدخال عدد المرات التي يتم فيها خصم ربع يوم.',
            'after_minute_quarterday.numeric' => 'عدد المرات يجب أن يكون رقماً.',
            'after_minute_quarterday.min' => 'عدد المرات يجب أن يكون أكبر من 0.',
            'after_time_half_daycut.required' => 'يجب إدخال عدد المرات التي يتم فيها خصم نصف يوم.',
            'after_time_half_daycut.numeric' => 'عدد المرات يجب أن يكون رقماً.',
            'after_time_half_daycut.min' => 'عدد المرات يجب أن يكون أكبر من 0.',
            'after_time_allday_daycut.required' => 'يجب إدخال عدد المرات التي يتم فيها خصم يوم كامل.',
            'after_time_allday_daycut.numeric' => 'عدد المرات يجب أن يكون رقماً.',
            'after_time_allday_daycut.min' => 'عدد المرات يجب أن يكون أكبر من 0.',
            'less_than_minute_neglecting_fp.required' => 'يجب إدخال عدد الدقائق لإهمال البصمة.',
            'less_than_minute_neglecting_fp.numeric' => 'عدد الدقائق يجب أن يكون رقماً.',
            'less_than_minute_neglecting_fp.min' => 'عدد الدقائق يجب أن يكون أكبر من 0.',
            'monthly_vacation_balance.required' => 'يجب إدخال رصيد اجازات الموظف الشهري.',
            'monthly_vacation_balance.numeric' => 'رصيد الاجازات يجب أن يكون رقماً.',
            'monthly_vacation_balance.min' => 'رصيد الاجازات يجب أن يكون أكبر من 0.',
            'after_days_begin_vacation.required' => 'يجب إدخال عدد الأيام التي يجب بعده بداية الإجازات.',
            'after_days_begin_vacation.numeric' => 'عدد الأيام يجب أن يكون رقماً.',
            'after_days_begin_vacation.min' => 'عدد الأيام يجب أن يكون أكبر من 0.',
            'first_balance_begin_vacation.required' => 'يجب إدخال رصيد الإجازات الأولي.',
            'first_balance_begin_vacation.numeric' => 'رصيد الإجازات الأولي يجب أن يكون رقماً.',
            'first_balance_begin_vacation.min' => 'رصيد الإجازات الأولي يجب أن يكون أكبر من 0.',
            'sanctions_value_first_absence.required' => 'يجب إدخال قيمة خصم الأيام بعد أول مرة غياب.',
            'sanctions_value_first_absence.numeric' => 'قيمة الخصم يجب أن تكون رقماً.',
            'sanctions_value_first_absence.min' => 'قيمة الخصم يجب أن تكون أكبر من 0.',
            'sanctions_value_second_absence.required' => 'يجب إدخال قيمة خصم الأيام بعد ثاني مرة غياب.',
            'sanctions_value_second_absence.numeric' => 'قيمة الخصم يجب أن تكون رقماً.',
            'sanctions_value_second_absence.min' => 'قيمة الخصم يجب أن تكون أكبر من 0.',
            'sanctions_value_thaird_absence.required' => 'يجب إدخال قيمة خصم الأيام بعد ثالث مرة غياب.',
            'sanctions_value_thaird_absence.numeric' => 'قيمة الخصم يجب أن تكون رقماً.',
            'sanctions_value_thaird_absence.min' => 'قيمة الخصم يجب أن تكون أكبر من 0.',
            'sanctions_value_forth_absence.required' => 'يجب إدخال قيمة خصم الأيام بعد رابع مرة غياب.',
            'sanctions_value_forth_absence.numeric' => 'قيمة الخصم يجب أن تكون رقماً.',
            'sanctions_value_forth_absence.min' => 'قيمة الخصم يجب أن تكون أكبر من 0.',
            'image.image' => 'الملف المرفق يجب أن يكون صورة.',
            'image.mimes' => 'يجب أن تكون الصورة بصيغة jpeg أو png أو jpg أو gif أو svg.',
            'image.max' => 'حجم الصورة يجب أن يكون أقل من 2 ميجابايت.',
        ];
    }
}