<?php

namespace App\Services\BinList\Response;

/**
 * @property-read string $name
 */
class BankResponse extends BinListResponse
{
    private string $name;

    public function __construct($data)
    {
        $this->name = $data['name'];
    }

    public function getName(): string
    {
        return $this->name;
    }
}
