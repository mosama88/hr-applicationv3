<?php

namespace App\Imports;

use App\Models\EmployeeSalaryReward;
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
        return new EmployeeSalaryReward([
            //
        ]);
    }
}
