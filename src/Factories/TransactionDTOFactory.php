<?php

namespace App\Factories;

use App\DTO\TransactionDTO;
use App\Enum\CurrencyEnum;
use App\Enum\InputFileKeyEnum;

class TransactionDTOFactory
{
    public function create(array $data): TransactionDTO
    {
        return new TransactionDTO(
            $data[InputFileKeyEnum::BIN->value],
            $data[InputFileKeyEnum::AMOUNT->value],
            CurrencyEnum::fromCode($data[InputFileKeyEnum::CURRENCY->value])
        );
    }
}
