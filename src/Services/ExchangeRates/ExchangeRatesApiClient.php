<?php

namespace App\Services\ExchangeRates;

class ExchangeRatesApiClient implements ExchangeRatesApiClientInterface
{
    private const URL_GET_LATEST = 'http://api.exchangeratesapi.io/latest?access_key=%s';
    public function __construct(private string $apiKey)
    {
    }

    public function getLatest(): string|bool
    {
        return file_get_contents(sprintf(self::URL_GET_LATEST, $this->apiKey));
    }
}
