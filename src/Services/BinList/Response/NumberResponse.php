<?php

namespace App\Services\BinList\Response;

class NumberResponse extends BinListResponse
{
    private int $length;
    private bool $luhn;

    public function __construct($data)
    {
        $this->length = $data['length'];
        $this->luhn = $data['luhn'];
    }
}
