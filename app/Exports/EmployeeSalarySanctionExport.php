<?php

namespace App\Exports;

use App\Models\EmployeeSalarySanction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeSalarySanctionExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return EmployeeSalarySanction::all();
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
            'ملاحظات',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // تنسيق الصف الأول (العناوين)
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D3D3D3'], // لون رمادي فاتح
                ],
            ],
        ];
    }
}
