<?php

namespace App\Services\ExchangeRates\Response;

class RateCollection
{
    /**
     * @var array<RateItem>
     */
    private array $items = [];

    public function add(RateItem $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return RateItem[]|array<RateItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getByCurrency(string $currency): ?RateItem
    {
        foreach ($this->items as $item) {
            if ($item->getCurrency()->is($currency)) {
                return $item;
            }
        }
        return null;
    }
}
