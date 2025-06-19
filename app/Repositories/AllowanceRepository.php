<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\Allowance;
use App\Repositories\Interfaces\AllowanceRepositoryInterface;

class AllowanceRepository implements AllowanceRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = Allowance::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

      public function storeData($request): Allowance
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return Allowance::create($dataInsert);
    }

    public function updateData($request, Allowance $allowance): Allowance
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

       $allowance->update($dataUpdate);
        return  $allowance;
    }


   public function deleteData(Allowance $allowance)
    {
        $allowance->delete();
        return  $allowance;
    }


}