<?php

namespace App\Services\BinList;

use App\Exceptions\BinListException;
use App\Services\BinList\Response\GetByBinResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BinListService implements BinListServiceInterface
{
    public function __construct(private Client $client, private array $config)
    {
    }

    /**
     * @throws BinListException
     */
    public function getByBinRequest(string $bin): string
    {
        try {
            $response = $this->client->get(sprintf($this->config['url_lookup_bin'], $bin));
        } catch (GuzzleException $e) {
            throw new BinListException($e->getMessage());
        }
        return $response->getBody()->getContents();
    }

    /**
     * @throws BinListException
     */
    public function getByBin(string $bin): GetByBinResponse
    {
        $binListResponse = $this->getByBinRequest($bin);
        $responseData = json_decode($binListResponse, true);

        return new GetByBinResponse($responseData);
    }

    /**
     * @throws BinListException
     */
    public function getCountryCodeByBin(string $bin): ?string
    {
        return $this->getByBin($bin)->getCountry()?->getAlpha2();
    }
}
