<?php

namespace App\Repositories\Settings;
use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\Governorate;
use App\Repositories\Interfaces\Settings\GovernorateRepositoryInterface;

class GovernorateRepository implements GovernorateRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = Governorate::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

      public function storeData($request): Governorate
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return Governorate::create($dataInsert);
    }

    public function updateData($request, Governorate $governorate): Governorate
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

       $governorate->update($dataUpdate);
        return  $governorate;
    }


   public function deleteData(Governorate $governorate)
    {
        $governorate->delete();
        return  $governorate;
    }


}