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


            ];
        })->toArray();
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return ['أسم الادارة', 'الهاتف', 'الملاحظات']; // ترجم العناوين حسب الأعمدة المختارة
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
