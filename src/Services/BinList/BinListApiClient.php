<?php

namespace App\Services\BinList;

class BinListApiClient implements BinListApiClientInterface
{
    private const URI_LOOKUP_BIN = 'https://lookup.binlist.net/%s';

    public function getByBin(string $bin): string|bool
    {
        return file_get_contents(sprintf(self::URI_LOOKUP_BIN, $bin));
    }
}
