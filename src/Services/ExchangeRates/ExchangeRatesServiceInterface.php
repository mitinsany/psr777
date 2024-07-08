<?php

namespace App\Services\ExchangeRates;

use App\Services\ExchangeRates\Response\RateCollection;

interface ExchangeRatesServiceInterface
{
    public function getRates(): RateCollection;
}
