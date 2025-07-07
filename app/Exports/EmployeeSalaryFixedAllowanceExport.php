<?php

namespace App\Exports;

use App\Models\EmployeeSalaryFixedAllowance;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeSalaryFixedAllowanceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmployeeSalaryFixedAllowance::all();
    }
}
