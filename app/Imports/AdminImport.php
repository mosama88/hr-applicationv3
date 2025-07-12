<?php

namespace App\Imports;

use App\Models\Admin;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class AdminImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Admin([
            'name' => $row[0],
            'address' => $row[1],
            'phones' => $row[2],
            'email' => $row[3],
            'active' => StatusActiveEnum::ACTIVE,
            'created_by' => Auth::user()->id,
            'com_code' => Auth::user()->com_code,
        ]);
    }
}