<?php

namespace App\Services\Settings;

use App\Models\Branch;
use App\Repositories\Interfaces\Settings\BranchInterface;
use App\Http\Requests\Dashboard\Settings\Settings\FinanceCalendarRequest;


class BranchService
{
    public function __construct(protected BranchInterface $repository) {}

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

    public function update($request, Branch $branch)
    {
        return $this->repository->updateData($request, $branch);
    }

    public function destroy($branch)
    {
        return $this->repository->deleteData($branch);
    }
}