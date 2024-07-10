<?php

namespace App\Providers;

use App\Container;
use App\Services\ExchangeRates\ExchangeRatesService;
use App\Services\ExchangeRates\ExchangeRatesServiceInterface;
use GuzzleHttp\Client;

class ExchangeRatesServiceServiceProvider extends BaseServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $this->container->bind(ExchangeRatesServiceInterface::class, function () {
            $c = $this->config->get('exchange_rates');
            $client = new Client();
            return new ExchangeRatesService($client, $this->config->get('exchange_rates'));
        });
    }
}
