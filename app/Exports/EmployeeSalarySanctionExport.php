<?php

namespace App\Exports;

use App\Models\FinanceClnPeriod;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeSalarySanction;
use App\Enums\Salaries\SanctionTypeEnum;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeSalarySanctionExport implements FromCollection, WithHeadings, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * تُرجع البيانات التي سيتم تصديرها.
     */
    public function collection()
    {

        // تأكد من أن $this->data عبارة عن Collection أو Array of arrays
        return collect($this->data)->map(function ($item) {
            $sanctionTypeLabel = is_int($item->sanctions_type)
                ? SanctionTypeEnum::tryFrom($item->sanctions_type)?->label()
                : $item->sanctions_type?->label();


            return [
                optional($item->financeClnPeriod)->year_and_month,
                optional($item->mainSalaryEmployee)->employee_name,
                $item->employee_code,
                $item->day_price,
                $sanctionTypeLabel ?? '',
                $item->value,
                $item->total,
                $item->notes,
            ];
        });
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