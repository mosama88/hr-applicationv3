<?php

namespace App\Imports;

use App\Models\FinanceClnPeriod;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Models\EmployeeSalarySanction;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Enums\Salaries\SanctionTypeEnum;
use App\Models\MainSalaryEmployee;

class EmployeeSalarySanctionImport implements ToModel
{

    protected $yearAndMonth;

    public function __construct($yearAndMonth)
    {
        $this->yearAndMonth = $yearAndMonth;
    }

    public function model(array $row)
    {
        $sanctionsValue = $this->parseSanctionType($row[4]);

        if (is_null($sanctionsValue)) {
            throw new \Exception("نوع الجزاء غير صالح أو غير معروف: {$row[4]}");
        }

        $com_code = Auth::user()->com_code;
        $userId = Auth::user()->id;

        // الحصول على الشهر المالي المطلوب
        $financeClnPeriod = FinanceClnPeriod::where('com_code', $com_code)
            ->where('year_and_month', $this->yearAndMonth)
            ->where('is_open', FinanceClnPeriodsIsOpen::Open)->where('id', $row[0])
            ->first();

        if (!$financeClnPeriod) {
            throw new \Exception("الشهر المالي المحدد غير موجود أو غير مفتوح.");
        }
        
        $mainSalaryEmployee = MainSalaryEmployee::where('com_code', $com_code)
            ->where('employee_code', $row[2])
            ->first();

        if (!$mainSalaryEmployee) {
            throw new \Exception("الموظف المرتبط بالراتب الأساسي غير موجود: {$row[1]}");
        }
        return new EmployeeSalarySanction([
            'finance_calendar_id'       => $financeClnPeriod->id,
            'main_salary_employee_id' => $mainSalaryEmployee?->id, // لحماية من null
            'employee_code'             => $row[2],
            'day_price'                 => $row[3],
            'sanctions_type' => SanctionTypeEnum::from($sanctionsValue),
            'value'                     => $row[5],
            'total'                     => $row[6],
            'notes'                     => $row[7],
            'com_code'                  => $com_code,
            'created_by'                => $userId,
        ]);
    }

    protected function parseSanctionType($value): ?int
    {
        $map = [
            'جزاء أيام' => 1,
            'جزاء بصمة' => 2,
            'جزاء تحقيق' => 3,
            // أو حتى 'خصم' => 1, حسب ما في الإكسل
        ];

        $value = trim($value);
        return $map[$value] ?? null;
    }
}