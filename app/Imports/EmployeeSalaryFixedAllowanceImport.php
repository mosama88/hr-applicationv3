<?php

namespace App\Imports;

use App\Models\EmployeeSalaryFixedAllowance;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeSalaryFixedAllowanceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmployeeSalaryFixedAllowance([
            //
        ]);
    }
}
