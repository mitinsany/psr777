<?php

namespace App\Services\ExchangeRates\Response;

class ErrorResponse
{
    private int $code;
    private string $info;
    private string $type;
    public function __construct(array $data)
    {
        $this->code = $data['code'];
        $this->info = $data['info'];
        $this->type = $data['type'];
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getInfo(): string
    {
        return $this->info;
    }
}
