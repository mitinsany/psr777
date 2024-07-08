<?php

namespace App\Services\ExchangeRates;

use App\Exceptions\ExchangeRatesApiClientException;
use App\Services\ExchangeRates\Response\GetLatestResponse;
use App\Services\ExchangeRates\Response\RateCollection;

class ExchangeRatesService implements ExchangeRatesServiceInterface
{
    public function __construct(private ExchangeRatesApiClientInterface $exchangeRatesApiClient)
    {
    }

    public function getLatest(): GetLatestResponse
    {
        $exchangeRatesResponse = $this->exchangeRatesApiClient->getLatest();
        $responseData = json_decode($exchangeRatesResponse, true);
        $response = new GetLatestResponse($responseData);
        if (!$response->isSuccess()) {
            throw new ExchangeRatesApiClientException(
                $response->getErrorResponse()->getInfo(),
                $response->getErrorResponse()->getCode(),
                $response->getErrorResponse()->getType()
            );
        }

        return new GetLatestResponse($responseData);
    }

    public function getRates(): RateCollection
    {
        return $this->getLatest()->getRates();
    }
}
