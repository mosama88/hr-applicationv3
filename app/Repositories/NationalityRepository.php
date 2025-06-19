<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\Nationality;
use App\Repositories\Interfaces\NationalityRepositoryInterface;

class NationalityRepository implements NationalityRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = Nationality::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

    public function storeData($request): Nationality
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return Nationality::create($dataInsert);
    }

    public function updateData($request, Nationality $nationality): Nationality
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $nationality->update($dataUpdate);
        return  $nationality;
    }


    public function deleteData(Nationality $nationality)
    {
        $nationality->delete();
        return  $nationality;
    }


    function searchNationalityForEmployee($request)
    {
        $nationalities = Nationality::where('name', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return  $nationalities;
    }
}