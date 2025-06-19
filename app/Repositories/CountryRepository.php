<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\Country;
use App\Repositories\Interfaces\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = Country::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

    public function storeData($request): Country
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return Country::create($dataInsert);
    }

    public function updateData($request, Country $country): Country
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $country->update($dataUpdate);
        return  $country;
    }


    public function deleteData(Country $country)
    {
        $country->delete();
        return  $country;
    }


    public function searchCountryForEmployee($request)
    {
        $countries = Country::where('name', 'LIKE', "%{$request->q}%")->orWhere('country_code', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return  $countries;
    }
}