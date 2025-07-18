<?php

namespace App\Imports;

use App\Models\AdditionalType;
use App\Models\FinanceClnPeriod;
use App\Models\MainSalaryEmployee;
use App\Models\EmployeeSalaryReward;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceClnPeriodsIsOpen;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeSalaryRewardImport implements ToModel
{
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
            ->where('year_and_month', $row[0]) // العمود الأول في الإكسل
            ->where('is_open', FinanceClnPeriodsIsOpen::Open)
            ->first();
        if (!$financeClnPeriod) {
            throw new \Exception("الفترة المالية {$row[0]} غير موجودة أو مغلقة");
        }

        $mainSalaryEmployee = MainSalaryEmployee::where('com_code', $com_code)
            ->where('employee_code', $row[2])
            ->first();

        if (!$mainSalaryEmployee) {
            throw new \Exception("الموظف المرتبط بالراتب الأساسي غير موجود: {$row[1]}");
        }
        $additionalTypeId = AdditionalType::where('name', trim($row[4]))->value('id');

        return new EmployeeSalaryReward([
            'finance_cln_period_id' => $financeClnPeriod->id,
            'main_salary_employee_id' => $mainSalaryEmployee?->id, // لحماية من null
            'employee_code'             => $row[2],
            'day_price'                 => $row[3],
            'additional_type_id'          => $additionalTypeId,
            'total'                     => $row[5],
            'notes'                     => $row[6],
            'com_code'                  => $com_code,
            'created_by'                => $userId,
        ]);
    }
}