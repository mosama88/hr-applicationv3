<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Governorate;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class CityImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $com_code = Auth::user()->com_code;
        $governorateId = Governorate::where('name', trim($row[1]))->value('id');


        return new City([
            'name' => $row[0],
            'governorate_id' => $governorateId,
            'active' => StatusActiveEnum::ACTIVE,
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
        ]);
    }
}
