<?php

namespace App\Repositories\Interfaces\Settings;

use App\Models\ShiftsType;

interface ShiftTypesInterface
{
    public function getData();
    public function storeData($request);
    public function showData(ShiftsType $shiftType);
    public function updateData($request, ShiftsType $shiftType);
    public function deleteData(ShiftsType $shiftType);
}
