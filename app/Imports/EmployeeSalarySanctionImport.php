<?php

namespace App\Imports;

use App\Models\FinanceClnPeriod;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Models\EmployeeSalarySanction;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeSalarySanctionImport implements ToModel
{

    protected $yearAndMonth;

    public function __construct($yearAndMonth)
    {
        $this->yearAndMonth = $yearAndMonth;
    }

    public function model(array $row)
    {
        $com_code = Auth::user()->com_code;
        $userId = Auth::user()->id;

        // الحصول على الشهر المالي المطلوب
        $financeClnPeriod = FinanceClnPeriod::where('com_code', $com_code)
            ->where('year_and_month', $this->yearAndMonth)
            ->where('is_open', FinanceClnPeriodsIsOpen::Open)
            ->first();

        if (!$financeClnPeriod) {
            throw new \Exception("الشهر المالي المحدد غير موجود أو غير مفتوح.");
        }

        return new EmployeeSalarySanction([
            'finance_calendar_id'       => $financeClnPeriod->yearAndMonth,
            'main_salary_employee_id'   => $row['main_salary_employee_id'],
            'employee_code'             => $row['employee_code'],
            'day_price'                 => $row['day_price'],
            'sanctions_type'            => $row['sanctions_type'],
            'value'                     => $row['value'],
            'total'                     => $row['total'],
            'notes'                     => $row['notes'],
            'com_code'                  => $com_code,
            'created_by'                => $userId,
        ]);
    }
}
