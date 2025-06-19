<?php

namespace App\Repositories\Settings;

use App\Models\ShiftsType;
use App\Enums\ShiftTypesEnum;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\Settings\ShiftTypesInterface;

class ShiftTypesRepository implements ShiftTypesInterface
{


    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = ShiftsType::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }


    public function storeData($request)
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'type' => ShiftTypesEnum::from((int) $dataValidate['type']),
            'active' => StatusActiveEnum::ACTIVE,
        ]);

        return ShiftsType::create($dataInsert);
    }




    public function showData(ShiftsType $shiftType)
    {
        //
    }


    public function updateData($request, ShiftsType $shiftType)
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'type' => ShiftTypesEnum::from((int) $dataValidate['type']),
            'active' => $request->active,
        ]);

        $shiftType->update($dataUpdate);
        return $shiftType;
    }


    public function deleteData(ShiftsType $shiftType)
    {
        $shiftType->delete();
        return $shiftType;
    }
}