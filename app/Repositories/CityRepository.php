<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\City;
use App\Repositories\Interfaces\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = City::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

      public function storeData($request): City
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return City::create($dataInsert);
    }

    public function updateData($request, City $city): City
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

       $city->update($dataUpdate);
        return  $city;
    }


   public function deleteData(City $city)
    {
        $city->delete();
        return  $city;
    }


}