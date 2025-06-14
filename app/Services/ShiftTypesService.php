<?php

namespace App\Services;

use App\Models\ShiftsType;
use App\Models\FinanceCalendar;
use App\Repositories\Interfaces\ShiftTypesInterface;


class ShiftTypesService
{
    public function __construct(protected ShiftTypesInterface $repository) {}

    public function index()
    {
        return $this->repository->getData();
    }

    public function store($request)
    {
        return $this->repository->storeData($request);
    }

    public function show(ShiftsType $shiftType)
    {
        $financeClnPeriods = $this->repository->showData($shiftType);
        if ($financeClnPeriods->isEmpty()) {
            throw new \Exception('!عفوآ لقد حدث خطأ ما'); // Or use a custom exception
        }
        return $financeClnPeriods;
    }

    public function update($request, ShiftsType $shiftType)
    {
        return $this->repository->updateData($request, $shiftType);
    }

    public function destroy(ShiftsType $shiftType)
    {
        return $this->repository->deleteData($shiftType);
    }
}
