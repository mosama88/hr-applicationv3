<?php

namespace App\Repositories\Settings;

use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\JobGrade;
use App\Repositories\Interfaces\Settings\JobGradeRepositoryInterface;

class JobGradeRepository implements JobGradeRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = JobGrade::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

    public function storeData($request): JobGrade
    {
        $com_code =  Auth::user()->com_code;
        $last_code = JobGrade::orderByDesc('job_grades_code')->where('com_code', $com_code)->value('job_grades_code');
        $new_code = $last_code ? $last_code + 1 : 1;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
            'job_grades_code' =>  $new_code,
        ]);

        return JobGrade::create($dataInsert);
    }

    public function updateData($request, JobGrade $jobGrade): JobGrade
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $jobGrade->update($dataUpdate);
        return  $jobGrade;
    }


    public function deleteData(JobGrade $jobGrade)
    {
        $jobGrade->delete();
        return  $jobGrade;
    }
}