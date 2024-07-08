<?php

namespace App\Services\BinList;

use stdClass;

interface BinListApiClientInterface
{
    public function getByBin(string $bin): string|bool;
}
