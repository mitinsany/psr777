<?php

namespace App\Services;

class CurrencyRateService
{
    public function amountByRate(float $amount, float $rate): float
    {
        return $amount / $rate;
    }
}
