<?php

namespace App\Services\Settings;

use App\Models\JobCategory;
use App\Repositories\Interfaces\Settings\JobCategoryInterface;
use App\Http\Requests\Dashboard\Settings\FinanceCalendarRequest;


class JobCategoryService
{
    public function __construct(protected JobCategoryInterface $repository) {}

    public function index()
    {
        return $this->repository->getData();
    }

    public function store($request)
    {
        return $this->repository->storeData($request);
    }

    public function show()
    {
        //
    }

    public function update($request, JobCategory $jobCategory)
    {
        return $this->repository->updateData($request, $jobCategory);
    }

    public function destroy($jobCategory)
    {
        return $this->repository->deleteData($jobCategory);
    }


    public function searchJob_category($request)
    {
        return $this->repository->searchJobCategoryForEmployee($request);
    }
}