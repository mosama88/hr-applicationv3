<?php
namespace App\Repositories\Interfaces;

use App\Models\JobGrade;

interface JobGradeRepositoryInterface
{
    public function getData();

    public function storeData($request): ?JobGrade;

    public function updateData($request, JobGrade $jobGrade);

    public function deleteData(JobGrade $jobGrade);

}
