<?php

namespace App\Services\Settings;

use App\Models\FinanceCalendar;
use App\Repositories\Interfaces\Settings\FinanceCalendarInterface;
use App\Http\Requests\Dashboard\Settings\FinanceCalendarRequest;


class FinanceCalendarService
{
    public function __construct(protected FinanceCalendarInterface $repository) {}

    public function index()
    {
        return $this->repository->getData();
    }

    public function store($request)
    {
        return $this->repository->storeData($request);
    }

    public function show(FinanceCalendar $financeCalendar)
    {
        $financeClnPeriods = $this->repository->showData($financeCalendar);
        if ($financeClnPeriods->isEmpty()) {
            throw new \Exception('!عفوآ لقد حدث خطأ ما'); // Or use a custom exception
        }
        return $financeClnPeriods;
    }

    public function update($request, FinanceCalendar $financeCalendar)
    {
        return $this->repository->updateData($request, $financeCalendar);
    }

    public function destroy(FinanceCalendar $financeCalendar)
    {
        return $this->repository->deleteData($financeCalendar);
    }

    public function openYear(FinanceCalendar $financeCalendar)
    {
        return $this->repository->openYearData($financeCalendar);
    }
    public function closeYear(FinanceCalendar $financeCalendar)
    {
        return $this->repository->closeYearData($financeCalendar);
    }
}