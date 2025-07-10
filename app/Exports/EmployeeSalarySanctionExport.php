<?php

namespace App\Exports;


use App\Enums\Salaries\SanctionTypeEnum;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeSalarySanctionExport implements FromArray, WithHeadings, WithStyles

{
    protected $data;

    public function __construct($employeeSalaryAllowances)
    {


        $this->data = $employeeSalaryAllowances->map(function ($item) {
            // استخراج نوع الجزاء كنص باستخدام enum
            $sanctionTypeLabel = is_int($item->sanctions_type)
                ? SanctionTypeEnum::tryFrom($item->sanctions_type)?->label()
                : $item->sanctions_type?->label();
            return [
                'financeClnPeriod' => $item->financeClnPeriod ? $item->financeClnPeriod->year_and_month : 'غير محددة',
                'mainSalaryEmployee' => $item->mainSalaryEmployee ? $item->mainSalaryEmployee->employee_name : 'غير محددة',
                'employee_code'   => $item->employee_code,
                'day_price'   => $item->day_price,
                'sanctions_type' => $sanctionTypeLabel ?? '',
                'value' => $item->value,
                'total' => $item->total,
                'branch_id' => $item->mainSalaryEmployee->branch?->name ?? 'غير محددة', // أو المسار الصحيح
                'department_code' => $item->mainSalaryEmployee->department?->name ?? 'غير محددة', // 
                'notes' => $item->notes,
            ];
        })->toArray();
    }

    /**
     * تُرجع البيانات التي سيتم تصديرها.
     */
    public function array(): array
    {
        return $this->data;
    }

    /**
     * تُرجع رؤوس الأعمدة.
     */
    public function headings(): array
    {
        return [
            'الشهر المالى',
            'أسم الموظف',
            'كود الموظف',
            'المرتب اليومى',
            'نوع الجزاء',
            'عدد الايام',
            'الأجمالى',
            'الفرع',
            'الادارة',
            'ملاحظات',
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