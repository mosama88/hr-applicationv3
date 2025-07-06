<?php

namespace App\Imports;

use App\Models\Nationality;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class NationalityImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Nationality([
            'name' => $row[0],
            'active' => StatusActiveEnum::ACTIVE,
            'created_by' => Auth::user()->id,
            'com_code' => Auth::user()->com_code,
        ]);
    }
}
