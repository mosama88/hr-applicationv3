<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\BloodType;
use App\Repositories\Interfaces\BloodTypeRepositoryInterface;

class BloodTypeRepository implements BloodTypeRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = BloodType::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

      public function storeData($request): BloodType
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return BloodType::create($dataInsert);
    }

    public function updateData($request, BloodType $bloodType): BloodType
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

       $bloodType->update($dataUpdate);
        return  $bloodType;
    }


   public function deleteData(BloodType $bloodType)
    {
        $bloodType->delete();
        return  $bloodType;
    }


}