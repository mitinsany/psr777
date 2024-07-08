<?php

namespace App\Services\BinList\Response;

class GetByBinResponse extends BinListResponse
{
    private ?NumberResponse $number = null;
    private string $scheme;
    private string $type;
    private string $brand;
    private CountryResponse $country;
    private BankResponse $bank;


    public function __construct($data)
    {
        if ($data['number']) {
            $this->number = new NumberResponse($data['number']);
        }
        $this->scheme = $data['scheme'];
        $this->type = $data['type'];
        $this->brand = $data['brand'];
        $this->country = new CountryResponse($data['country']);
        $this->bank = new BankResponse($data['bank']);
    }

    /**
     * @return NumberResponse|null
     */
    public function getNumber(): ?NumberResponse
    {
        return $this->number;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCountry(): CountryResponse
    {
        return $this->country;
    }

    public function getBank(): BankResponse
    {
        return $this->bank;
    }
}
