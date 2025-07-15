<?php

namespace App\Imports;

use App\Models\EmployeeSalaryPermanentLoan;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeSalaryPermanentLoanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmployeeSalaryPermanentLoan([
            //
        ]);
    }
}