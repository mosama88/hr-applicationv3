<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\BranchInterface;

class BranchRepository implements BranchInterface
{


    public function getData()
    {
        $com_code  = Auth::user()->com_code;
        $data = Branch::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }


    public function storeData($request): ?Branch
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' => StatusActiveEnum::ACTIVE,
        ]);
        return Branch::create($dataInsert);
    }




    public function showData()
    {
        //
    }


    public function updateData($request, Branch $branch): ?Branch
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
        ]);
        $branch->update($dataUpdate);
        return  $branch;
    }


    public function deleteData(Branch $branch)
    {
        $branch->delete();
        return  $branch;
    }
}
