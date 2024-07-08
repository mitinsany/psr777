<?php

namespace App\Services\ExchangeRates\Response;

use App\Enum\CurrencyEnum;

class RateItem
{
    public function __construct(private CurrencyEnum $currency, private float $rate)
    {
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}
