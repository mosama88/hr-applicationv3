<?php

namespace App\Repositories\EmployeeAffairs;
use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\AdditionalType;
use App\Repositories\Interfaces\EmployeeAffairs\AdditionalTypeRepositoryInterface;

class AdditionalTypeRepository implements AdditionalTypeRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = AdditionalType::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

      public function storeData($request): AdditionalType
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return AdditionalType::create($dataInsert);
    }

    public function updateData($request, AdditionalType $additionalType): AdditionalType
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

       $additionalType->update($dataUpdate);
        return  $additionalType;
    }


   public function deleteData(AdditionalType $additionalType)
    {
        $additionalType->delete();
        return  $additionalType;
    }


}