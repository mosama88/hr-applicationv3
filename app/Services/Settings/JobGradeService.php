<?php

namespace App\Services\Settings;
use App\Models\JobGrade;

use App\Repositories\Interfaces\Settings\JobGradeRepositoryInterface;

class JobGradeService
{

    public function __construct(protected JobGradeRepositoryInterface $repository)
    {

    }

    public function index()
    {
        return $this->repository->getData();
    }

      public function store($request)
    {
        return $this->repository->storeData($request);
    }

   public function update($request, JobGrade $jobGrade)
    {
        return $this->repository->updateData($request, $jobGrade);
    }

    public function destroy($jobGrade)
    {
        return $this->repository->deleteData($jobGrade);
    }
}