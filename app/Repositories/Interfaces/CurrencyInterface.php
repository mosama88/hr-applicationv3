<?php

namespace App\Repositories\Interfaces;

use App\Models\Currency;

interface CurrencyInterface
{
    public function getData();
    public function storeData($request): ?Currency;
    public function updateData($request, Currency $branch);
    public function deleteData(Currency $branch);
}