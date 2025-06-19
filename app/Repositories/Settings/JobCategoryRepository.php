<?php

namespace App\Repositories\Settings;

use App\Models\JobCategory;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\Settings\JobCategoryInterface;

class JobCategoryRepository implements JobCategoryInterface
{

    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = JobCategory::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }


    public function storeData($request): ?JobCategory
    {

        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return JobCategory::create($dataInsert);
    }




    public function showData()
    {
        //
    }


    public function updateData($request, JobCategory $jobCategory): ?JobCategory
    {


        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $jobCategory->update($dataUpdate);
        return  $jobCategory;
    }


    public function deleteData(JobCategory $jobCategory)
    {
        $jobCategory->delete();
        return  $jobCategory;
    }

    public function searchJobCategoryForEmployee($request)
    {
        $jobCategories = JobCategory::where('name', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return $jobCategories;
    }
}