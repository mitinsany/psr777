<?php

namespace App\Services\ExchangeRates\Response;

use App\Enum\CurrencyEnum;

class GetLatestResponse extends ExchangeRatesResponse
{
    private bool $success;
    private ?int $timestamp;
    private ?string $base;
    private ?string $date;
    private ?RateCollection $rates = null;
    private ?ErrorResponse $errorResponse = null;

    public function __construct(array $response)
    {
        $this->success = $response['success'] ?? false;
        $this->timestamp = $response['timestamp'] ?? null;
        $this->base = $response['base'] ?? null;
        $this->date = $response['date'] ?? null;
        if (array_key_exists('rates', $response)) {
            $this->rates = new RateCollection();
            foreach ($response['rates'] as $currency => $rate) {
                $rate = new RateItem(CurrencyEnum::fromCode($currency), $rate);
                $this->rates->add($rate);
            }
        }
        if (array_key_exists('error', $response)) {
            $this->errorResponse = new ErrorResponse($response['error']);
        }
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getRates(): RateCollection
    {
        return $this->rates;
    }

    public function getErrorResponse(): ?ErrorResponse
    {
        return $this->errorResponse;
    }
}
