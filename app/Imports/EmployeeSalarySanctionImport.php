<?php

namespace App\Imports;

use App\Models\FinanceClnPeriod;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeSalarySanction;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeSalarySanctionImport implements ToModel
{

    public $financeClnPeriodId;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $com_code = Auth::user()->com_code;
        $userId = Auth::user()->id;
        $financeClnPeriod = FinanceClnPeriod::where('com_code', $com_code)
            ->where('id', $this->financeClnPeriodId)
            ->firstOrFail();
        if ($financeClnPeriod->is_open != FinanceClnPeriodsIsOpen::Open) {
            return redirect()->route('dashboard.sanctions.show', $financeClnPeriod->slug)->withErrors(['error' => 'عفوا الشهر المالى غير مفتوح !'])->withInput();
        }
        
        return new EmployeeSalarySanction([
            'finance_calendar_id'       => $row['finance_calendar_id'],
            'main_salary_employee_id'   => $row['main_salary_employee_id'],
            'employee_code'             => $row['employee_code'],
            'day_price'                 => $row['day_price'],
            'sanctions_type'            => $row['sanctions_type'],
            'value'                     => $row['value'],
            'total'                     => $row['total'],
            'notes'                     => $row['notes'],
            'com_code'                  => $com_code,
            'created_by'                =>  $userId,
        ]);
    }
}