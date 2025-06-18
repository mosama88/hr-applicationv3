<?php

namespace App\Repositories\Interfaces;

use App\Models\JobCategory;

interface JobCategoryInterface
{
    public function getData();
    public function storeData($request): ?JobCategory;
    public function updateData($request, JobCategory $jobCategory);
    public function deleteData(JobCategory $jobCategory);
    public function searchJobCategoryForEmployee($request);
}