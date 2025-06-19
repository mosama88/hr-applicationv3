<?php

namespace App\Repositories\Settings;

use App\Models\Department;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\Settings\DepartmentInterface;

class DepartmentRepository implements DepartmentInterface
{


    public function getData()
    {

        $com_code = Auth::user()->com_code;
        $data = Department::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }


    public function storeData($request): ?Department
    {

        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return Department::create($dataInsert);
    }




    public function showData()
    {
        //
    }


    public function updateData($request, Department $department): ?Department
    {


        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $department->update($dataUpdate);
        return  $department;
    }


    public function deleteData(Department $department)
    {
        $department->delete();
        return  $department;
    }
    public function searchDepartmentForEmployee($request)
    {
        $departments = Department::where('name', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return $departments;
    }
}