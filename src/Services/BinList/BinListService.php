<?php

namespace App\Services\BinList;

use App\Exceptions\BinListApiClientException;
use App\Services\BinList\Response\GetByBinResponse;

class BinListService implements BinListServiceInterface
{
    public function __construct(private BinListApiClientInterface $binListApiClient)
    {
    }

    /**
     * @throws BinListApiClientException
     */
    public function getByBin(string $bin): GetByBinResponse
    {
        $binListResponse = $this->binListApiClient->getByBin($bin);
        if (!$binListResponse) {
            throw new BinListApiClientException();
        }
        $responseData = json_decode($binListResponse, true);

        return new GetByBinResponse($responseData);
    }

    public function getCountryCodeByBin(string $bin): string
    {
        return $this->getByBin($bin)->getCountry()->getAlpha2();
    }
}
