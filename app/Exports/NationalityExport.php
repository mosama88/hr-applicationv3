<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class NationalityExport implements FromArray, WithHeadings, WithStyles
{
    protected $data;

    public function __construct($nationalities)
    {
        // نحضّر فقط الأعمدة المطلوبة
        $this->data = $nationalities->map(function ($nationality) {
            return [
                'name'   => $nationality->name,
            ];
        })->toArray();
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return ['أسم الجنسية']; // ترجم العناوين حسب الأعمدة المختارة
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
