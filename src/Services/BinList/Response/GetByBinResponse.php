<?php

namespace App\Services\BinList\Response;

class GetByBinResponse extends BinListResponse
{
    private ?NumberResponse $number = null;
    private ?string $scheme = null;
    private ?string $type = null;
    private ?string $brand = null;
    private ?CountryResponse $country = null;
    private ?BankResponse $bank = null;


    public function __construct($data)
    {
        if (!empty($data['number'])) {
            $this->number = new NumberResponse($data['number']);
        }
        if (!empty($data['scheme'])) {
            $this->scheme = $data['scheme'];
        }
        if (!empty($data['type'])) {
            $this->type = $data['type'];
        }
        if (!empty($data['brand'])) {
            $this->brand = $data['brand'];
        }
        if (!empty($data['country'])) {
            $this->country = new CountryResponse($data['country']);
        }
        if (!empty($data['bank'])) {
            $this->bank = new BankResponse($data['bank']);
        }
    }

    /**
     * @return NumberResponse|null
     */
    public function getNumber(): ?NumberResponse
    {
        return $this->number;
    }

    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getCountry(): ?CountryResponse
    {
        return $this->country;
    }

    public function getBank(): ?BankResponse
    {
        return $this->bank;
    }
}
