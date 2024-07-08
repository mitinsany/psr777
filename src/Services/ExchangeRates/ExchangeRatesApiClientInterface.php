<?php

namespace App\Services\ExchangeRates;

interface ExchangeRatesApiClientInterface
{
    public function getLatest(): string|bool;
}
