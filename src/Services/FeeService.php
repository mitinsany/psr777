<?php

namespace App\Services;

class FeeService
{
    private const FEE_EUROPEAN = 0.01;
    private const FEE_NON_EUROPEAN = 0.02;

    public function getFeeRate(bool $isEuropeanCountryCode): float
    {
        return $isEuropeanCountryCode
            ? self::FEE_EUROPEAN
            : self::FEE_NON_EUROPEAN;
    }

    public function getAmountFee(float $amount, float $fee): float
    {
        return $amount * $fee;
    }

    public function round(float $amount): float
    {
        return round($amount, 2, PHP_ROUND_HALF_UP);
    }
}
