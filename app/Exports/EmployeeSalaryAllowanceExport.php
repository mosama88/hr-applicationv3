<?php

namespace App\Exports;

use App\Models\EmployeeSalaryAllowance;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeSalaryAllowanceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmployeeSalaryAllowance::all();
    }
}