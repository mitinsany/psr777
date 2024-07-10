<?php

namespace App\Services;

use App\DTO\TransactionDTO;
use App\Factories\TransactionDTOFactory;

class TransactionService
{
    public function __construct(
        private TransactionDTOFactory $transactionDTOFactory,
        private CurrencyRateService $currencyRateService
    ) {
    }

    /**
     * @return array<TransactionDTO>
     */
    public function createFromArray(array $transactions): array
    {
        $result = [];
        foreach ($transactions as $transaction) {
            $result[] = $this->transactionDTOFactory->create($transaction);
        }

        return $result;
    }

    public function amountFixed(bool $isEur, float $amount, float $rate): float
    {
        return ($isEur xor $rate == 0)
                ? $this->currencyRateService->amountByRate($amount, $rate)
                : $amount;
    }
}
