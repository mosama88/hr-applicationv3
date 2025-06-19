<?php

namespace App\Services\Settings;

use App\Models\Department;
use App\Repositories\Interfaces\Settings\DepartmentInterface;


class DepartmentService
{
    public function __construct(protected DepartmentInterface $repository) {}

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

    public function update($request, Department $department)
    {
        return $this->repository->updateData($request, $department);
    }

    public function destroy($department)
    {
        return $this->repository->deleteData($department);
    }


    public function searchDepartment($request)
    {
        return $this->repository->searchDepartmentForEmployee($request);
    }
}