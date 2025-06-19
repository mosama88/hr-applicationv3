<?php

namespace App\Services\Settings;

use App\Models\Currency;
use App\Repositories\Interfaces\Settings\CurrencyInterface;
use App\Http\Requests\Dashboard\Settings\FinanceCalendarRequest;


class CurrencyService
{
    public function __construct(protected CurrencyInterface $repository) {}

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

    public function update($request, Currency $currency)
    {
        return $this->repository->updateData($request, $currency);
    }

    public function destroy($currency)
    {
        return $this->repository->deleteData($currency);
    }


    public function searchCurrency($request)
    {
        return $this->repository->searchCurrancyForEmployee($request);
    }
}