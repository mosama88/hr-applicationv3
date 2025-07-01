<?php

namespace App\Imports;

use App\Models\EmployeeSalarySanction;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeSalarySanctionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmployeeSalarySanction([
            //
        ]);
    }
}
