<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromArray;

class EmployeeSalaryAdditionalExport implements FromArray, WithHeadings, WithStyles

{
    protected $data;

    public function __construct($absences)
    {
        // نحضّر فقط الأعمدة المطلوبة
        $this->data = $absences->map(function ($item) {
            return [
                optional($item->financeClnPeriod)->year_and_month,
                optional($item->mainSalaryEmployee)->employee_name,
                $item->employee_code,
                $item->day_price,
                $item->value,
                $item->total,
                $item->notes,
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
            'عدد الايام',
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