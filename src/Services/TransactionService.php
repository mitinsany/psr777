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

    public function amountFixed(TransactionDTO $transactionDTO, float $rate): float
    {
        return ($transactionDTO->getCurrency()->isEUR() xor $rate == 0)
                ? $this->currencyRateService->amountByRate($transactionDTO->getAmount(), $rate)
                : $transactionDTO->getAmount();
    }
}
