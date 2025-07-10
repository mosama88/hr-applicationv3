<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromArray;

class EmployeeSalaryRewardExport implements FromArray, WithHeadings, WithStyles

{
    protected $data;

    public function __construct($employeeSalarydiscounts)
    {

        $this->data = $employeeSalarydiscounts->map(function ($employeeSalarydiscount) {
            return [
                'financeClnPeriod' => $employeeSalarydiscount->financeClnPeriod ? $employeeSalarydiscount->financeClnPeriod->year_and_month : 'غير محددة',
                'mainSalaryEmployee' => $employeeSalarydiscount->mainSalaryEmployee ? $employeeSalarydiscount->mainSalaryEmployee->employee_name : 'غير محددة',
                'employee_code'   => $employeeSalarydiscount->employee_code,
                'day_price'   => $employeeSalarydiscount->day_price,
                'branch_id' => $employeeSalarydiscount->mainSalaryEmployee->branch?->name ?? 'غير محددة', // أو المسار الصحيح
                'department_code' => $employeeSalarydiscount->mainSalaryEmployee->department?->name ?? 'غير محددة', // 
                'additional_type_id' => $employeeSalarydiscount->additionalType?->name ?? 'غير محددة', // أو المسار الصحيح
                'total' => $employeeSalarydiscount->total,
                'notes' => $employeeSalarydiscount->notes,
            ];
        })->toArray();
    }

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
            'الفرع',
            'الادارة',
            'نوع المكافأه',
            'الأجمالى',
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