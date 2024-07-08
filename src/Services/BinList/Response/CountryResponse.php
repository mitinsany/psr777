<?php

namespace App\Services\BinList\Response;

/**
 * @property-read string $numeric
 * @property-read string $alpha2
 * @property-read string $name
 * @property-read string $emoji
 * @property-read string $currency
 * @property-read int $latitude
 * @property-read int $longitude
 */
class CountryResponse extends BinListResponse
{
    private string $numeric;
    private string $alpha2;
    private string $name;
    private string $emoji;
    private string $currency;
    private int $latitude;
    private int $longitude;
    public function __construct($data)
    {
        $this->numeric = $data['numeric'];
        $this->alpha2 = $data['alpha2'];
        $this->name = $data['name'];
        $this->emoji = $data['emoji'];
        $this->currency = $data['currency'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
    }

    public function getNumeric(): string
    {
        return $this->numeric;
    }

    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmoji(): string
    {
        return $this->emoji;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getLatitude(): int
    {
        return $this->latitude;
    }

    public function getLongitude(): int
    {
        return $this->longitude;
    }
}
