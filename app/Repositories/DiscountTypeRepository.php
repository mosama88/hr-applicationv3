<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\DiscountType;
use App\Repositories\Interfaces\DiscountTypeRepositoryInterface;

class DiscountTypeRepository implements DiscountTypeRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = DiscountType::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

      public function storeData($request): DiscountType
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return DiscountType::create($dataInsert);
    }

    public function updateData($request, DiscountType $discountType): DiscountType
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

       $discountType->update($dataUpdate);
        return  $discountType;
    }


   public function deleteData(DiscountType $discountType)
    {
        $discountType->delete();
        return  $discountType;
    }


}