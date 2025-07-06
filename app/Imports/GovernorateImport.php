<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Governorate;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class GovernorateImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $com_code = Auth::user()->com_code;
        $countryId = Country::where('name', trim($row[1]))->value('id');

        return new Governorate([
            'name' => $row[0],
            'country_id' => $countryId,
            'active' => StatusActiveEnum::ACTIVE,
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
        ]);
    }
}
