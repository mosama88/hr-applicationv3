<?php

namespace App\Exports;

use App\Models\EmployeeSalaryPermanentLoan;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeSalaryPermanentLoanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmployeeSalaryPermanentLoan::all();
    }
}