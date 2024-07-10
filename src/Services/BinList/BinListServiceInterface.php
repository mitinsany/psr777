<?php

namespace App\Services\BinList;

interface BinListServiceInterface
{
    public function getCountryCodeByBin(string $bin): ?string;
}
