<?php

namespace App\Services\Settings;

use App\Models\Qualification;
use App\Repositories\Interfaces\Settings\QualificationInterface;


class QualificationService
{
    public function __construct(protected QualificationInterface $repository) {}

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

    public function update($request, Qualification $qualification)
    {
        return $this->repository->updateData($request, $qualification);
    }

    public function destroy($qualification)
    {
        return $this->repository->deleteData($qualification);
    }


    public function searchQualification($request)
    {
        return $this->repository->searchQualification($request);
    }
}