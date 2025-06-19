<?php

namespace App\Repositories\Settings;

use App\Models\Qualification;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\Settings\QualificationInterface;

class QualificationRepository implements QualificationInterface
{

    public function getData()
    {

        $com_code = Auth::user()->com_code;
        $data = Qualification::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }


    public function storeData($request): ?Qualification
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return Qualification::create($dataInsert);
    }




    public function showData()
    {
        //
    }


    public function updateData($request, Qualification $qualification): ?Qualification
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $qualification->update($dataUpdate);
        return  $qualification;
    }


    public function deleteData(Qualification $qualification)
    {
        $qualification->delete();
        return  $qualification;
    }

    
    public function searchQualification($request)
    {
        $qualifications = Qualification::where('name', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return $qualifications;
    }
}