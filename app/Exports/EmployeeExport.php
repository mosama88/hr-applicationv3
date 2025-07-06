<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class EmployeeExport implements FromArray, WithHeadings, WithStyles
{
    protected $data;

    public function __construct($employees)
    {
        // نحضّر فقط الأعمدة المطلوبة
        $this->data = $employees->map(function ($employee) {
            return [
                'employee_code'  => $employee->employee_code,
                'fp_code'  => $employee->fp_code,
                'name'     => $employee->name,
                'gender'     => $employee->gender->label(),
                'branch_id' => $employee->branch ? $employee->branch->name : 'غير محددة',
                'job_grade_id'     => $employee->jobGrade->name,
                'qualification_id'     => $employee->qualification->name,
                'qualification_year'     => $employee->qualification_year,
                'major'     => $employee->major,
                'graduation_estimate'     => $employee->graduation_estimate->label(),
                'birth_date'     => $employee->birth_date,
                'national_id'     => $employee->national_id,
                'end_national_id'     => $employee->end_national_id,
                'national_id_place'     => $employee->national_id_place,
                'blood_type_id' => $employee->bloodType ? $employee->bloodType->name : 'غير محددة',
                'religion'     => $employee->religion->label(),
                'language_id' => $employee->language ? $employee->language->name : 'غير محددة',
                'email '     => $employee->email,
                'country_id' => $employee->country ? $employee->country->name : 'غير محددة',
                'governorate_id' => $employee->governorate ? $employee->governorate->name : 'غير محددة',
                'city_id' => $employee->city ? $employee->city->name : 'غير محددة',
                'home_telephone'     => $employee->home_telephone,
                'mobile'     => $employee->mobile,
                'address'     => $employee->address,
                'military'     => $employee->military->label(),
                'military_service_start_date'     => $employee->military_service_start_date,
                'military_service_end_date'     => $employee->military_service_end_date,
                'military_wepon'     => $employee->military_wepon,
                'military_exemption_date'     => $employee->military_exemption_date,
                'military_exemption_reason'     => $employee->military_exemption_reason,
                'military_postponement_date'     => $employee->military_postponement_date,
                'military_postponement_reason'     => $employee->military_postponement_reason,
                'driving_license'     => $employee->driving_license->label(),
                'driving_license_type'     => $employee->driving_license_type->label(),
                'driving_License_id'     => $employee->driving_License_id,
                'has_relatives'     => $employee->has_relatives->label(),
                'relatives_details'     => $employee->relatives_details,
                'notes'     => $employee->notes,
                'hiring_date'     => $employee->hiring_date,
                'functional_status'     => $employee->functional_status->label(),
                'department_id'     => $employee->department ? $employee->department->name : 'غير محددة',
                'job_category_id'     => $employee->jobCategory ? $employee->jobCategory->name : 'غير محددة',
                'has_attendance'     => $employee->has_attendance->label(),
                'has_fixed_shift'     => $employee->has_fixed_shift->label(),
                'shifts_type_id'     =>  $employee->shiftsType ? $employee->shiftsType->name : 'غير محددة',
                'daily_work_hour'     => $employee->daily_work_hour,
                'salary'     => $employee->salary,
                'day_price'     => $employee->day_price,
                'currency_id '     => $employee->currency ? $employee->currency->name : 'غير محددة',
                'bank_number_account'     => $employee->bank_number_account,
                'motivation_type'     => $employee->motivation_type->label(),
                'motivation_value'     => $employee->motivation_value,
                'has_social_insurance'     => $employee->has_social_insurance->label(),
                'social_insurance_cut_monthely'     => $employee->social_insurance_cut_monthely,
                'social_insurance_number'     => $employee->social_insurance_number,
                'has_medical_insurance'     => $employee->has_medical_insurance->label(),
                'medical_insurance_cut_monthely'     => $employee->medical_insurance_cut_monthely,
                'medical_insurance_number'     => $employee->medical_insurance_number,
                'type_salary_receipt'     => $employee->type_salary_receipt->label(),
                'has_vacation_balance'     => $employee->has_vacation_balance->label(),
                'urgent_person_details'     => $employee->urgent_person_details,
                'social_status'     => $employee->social_status->label(),
                'children_number'     => $employee->children_number,
                'has_disabilities'     => $employee->has_disabilities->label(),
                'disabilities_details'     => $employee->disabilities_details,
                'nationality_id'     =>  $employee->nationality ? $employee->nationality->name : 'غير محددة',
                'pasport_identity'     => $employee->pasport_identity,
                'pasport_exp_date'     => $employee->pasport_exp_date,
                'has_fixed_allowances'     => $employee->has_fixed_allowances->label(),
                'active'     => $employee->active->label(),
            ];
        })->toArray();
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'كود الموظف',
            'كود البصمة',
            'اسم الموظف',
            'النوع',
            'الفرع',
            'الدرجه الوظيفية',
            'المؤهل الدراسي',
            'سنة التخرج',
            'تخصص التخرج',
            'تقدير التخرج',
            'تاريخ الميلاد',
            'رقم بطاقة الهوية',
            'تاريخ انتهاء بطاقة الهوية',
            'مركز اصدار بطاقة الهوية',
            'فصيلة الدم',
            'الديانة',
            'اللغة',
            'البريد الالكتروني',
            'الدولة',
            'المحافظة',
            'المدينة/المركز',
            'هاتف المنزل',
            'هاتف المحمول',
            'عنوان الاقامة',
            'حالة الخدمة العسكرية',
            'تاريخ بداية الخدمة العسكرية',
            'تاريخ نهاية الخدمة العسكرية',
            'سلاح الخدمة العسكرية',
            'تاريخ الاعفاء النهائى الخدمة العسكرية',
            'سبب اعفاء الخدمة العسكرية',
            'تاريخ الاعفاء المؤقت الخدمة العسكرية',
            'سبب ومدة تأجيل الخدمة العسكرية',
            'هل يمتلك رخصة قيادة',
            'نوع رخصة القيادة',
            'رقم رخصة القيادة',
            'هل يمتلك أقارب بالعمل',
            'تفاصيل الاقارب',
            'ملاحظات',
            'تاريخ التعيين',
            'الحالة الوظيفية',
            'الادارة',
            'الوظيفة',
            'هل له بصمة حضور وانصراف',
            'هل شفت ثابت',
            'أنواع الشفتات',
            'عدد ساعات العمل اليومي',
            'المرتب',
            'الراتب اليومى',
            'عملة القبض',
            'رقم الحساب المصرفي',
            'هل له حافز',
            'قيمة الحافز الشهري',
            'هل له تأمين اجتماعي',
            'قيمة التأمين الاجتماعي المستقطع شهرياً',
            'رقم التامين الاجتماعي للموظف',
            'هل له تأمين طبي',
            'قيمة التأمين الطبي المستقطع شهرياً',
            'رقم التامين الطبي للموظف',
            'نوع صرف راتب الموظف',
            'هل له رصيد اجازات سنوي',
            'شخص يمكن الرجوع اليه للضرورة',
            'الحالة الأجتماعية',
            'عدد الأطفال',
            'هل يمتلك اعاقة / عمليات سابقة',
            'تفاصيل الاعاقة / عمليات سابقة',
            'الجنسية',
            'رقم الباسبور',
            'تاريخ انتهاء الباسبور',
            'هل له حافز',
            'حالة بيانات الموظف',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // نحسب عدد الصفوف = عدد البيانات + صف العناوين
        $rowCount = count($this->data) + 1;
        $columnCount = count($this->data[0] ?? []);

        // حساب آخر خلية مثل: D5 مثلاً
        $lastColumnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount);
        $range = "A1:{$lastColumnLetter}{$rowCount}";

        // تطبيق التنسيق
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // تنسيق الصف الأول
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D3D3D3'],
                ],
            ],
        ];
    }
}
