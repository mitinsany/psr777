<?php

namespace App\Exceptions;

class ExchangeRatesApiClientException extends BaseException
{
    public function __construct(string $message = "", int $code = 0, private string $type)
    {
        parent::__construct($message, $code);
    }

    public function getType(): string
    {
        return $this->type;
    }
}
