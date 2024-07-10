<?php

namespace App\Providers;

use App\Container;
use App\Services\BinList\BinListService;
use App\Services\BinList\BinListServiceInterface;
use GuzzleHttp\Client;

class BinListServiceServiceProvider extends BaseServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $this->container->bind(BinListServiceInterface::class, function () {
            $client = new Client();
            return new BinListService($client, $this->config->get('bin_list'));
        });
    }
}
