<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\CurrencyInterface;

class CurrencyRepository implements CurrencyInterface
{


    public function getData()
    {

        $com_code = Auth::user()->com_code;
        $data = Currency::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }


    public function storeData($request): ?Currency
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return Currency::create($dataInsert);
    }




    public function showData()
    {
        //
    }


    public function updateData($request, Currency $currency): ?Currency
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $currency->update($dataUpdate);
        return  $currency;
    }


    public function deleteData(Currency $currency)
    {
        $currency->delete();
        return  $currency;
    }
    public function searchCurrancyForEmployee($request)
    {
        $currencies = Currency::where('name', 'LIKE', "%{$request->q}%")->orWhere('currency_symbol', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return $currencies;
    }
}