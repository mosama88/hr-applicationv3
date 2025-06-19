<?php

namespace App\Services\EmployeeAffairs;

use App\Models\Employee;

use App\Repositories\Interfaces\EmployeeAffairs\EmployeeRepositoryInterface;

class EmployeeService
{

    public function __construct(protected EmployeeRepositoryInterface $repository) {}

    public function index()
    {
        return $this->repository->getData();
    }

    public function store($request)
    {
        return $this->repository->storeData($request);
    }

    public function update($request, Employee $employee)
    {
        return $this->repository->updateData($request, $employee);
    }

    public function destroy($employee)
    {
        return $this->repository->deleteData($employee);
    }

    public function uploadFiles($request)
    {
        return $this->repository->uploadFilesData($request);
    }

      public function destroyUploadFiles($id)
    {
        return $this->repository->destroyUploadFilesData($id);
    }

    
}