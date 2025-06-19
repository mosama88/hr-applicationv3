<?php

namespace App\Repositories\Interfaces\Settings;

use App\Models\Currency;

interface CurrencyInterface
{
    public function getData();
    public function storeData($request): ?Currency;
    public function updateData($request, Currency $currency);
    public function deleteData(Currency $currency);
    public function searchCurrancyForEmployee($request);
}