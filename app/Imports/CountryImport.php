<?php

namespace App\Imports;

use App\Models\Country;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class CountryImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Country([
            'name' => $row[0],
            'country_code' => $row[1],
            'active' => StatusActiveEnum::ACTIVE,
            'created_by' => Auth::user()->id,
            'com_code' => Auth::user()->com_code,
        ]);
    }
}