<?php

namespace App\DTO;

use App\Enum\CurrencyEnum;

class TransactionDTO
{
    public function __construct(
        private string $bin,
        private float $amount,
        private CurrencyEnum $currency
    ) {
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }
}
