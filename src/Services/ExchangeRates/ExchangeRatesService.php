<?php

namespace App\Services\ExchangeRates;

use App\Exceptions\ExchangeRatesGuzzleException;
use App\Exceptions\ExchangeRatesResponseException;
use App\Services\ExchangeRates\Response\GetLatestResponse;
use App\Services\ExchangeRates\Response\RateCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ExchangeRatesService implements ExchangeRatesServiceInterface
{
    public function __construct(private Client $client, private array $config)
    {
    }

    /**
     * @throws ExchangeRatesGuzzleException
     */
    public function requestGetLatest(): string|bool
    {
        try {
            $response = $this->client->get($this->config['url_exchange_rates']);
        } catch (GuzzleException $e) {
            throw new ExchangeRatesGuzzleException($e->getMessage());
        }

        return $response->getBody()->getContents();
    }

    /**
     * @throws ExchangeRatesResponseException
     * @throws ExchangeRatesGuzzleException
     */
    public function getLatest(): GetLatestResponse
    {
        $exchangeRatesResponse = $this->requestGetLatest();
        $responseData = json_decode($exchangeRatesResponse, true);
        $response = new GetLatestResponse($responseData);
        if (!$response->isSuccess()) {
            throw new ExchangeRatesResponseException(
                $response->getErrorResponse()->getInfo(),
                $response->getErrorResponse()->getCode(),
                $response->getErrorResponse()->getType()
            );
        }

        return new GetLatestResponse($responseData);
    }

    /**
     * @throws ExchangeRatesResponseException
     * @throws ExchangeRatesGuzzleException
     */
    public function getRates(): RateCollection
    {
        return $this->getLatest()->getRates();
    }
}
