<?php

namespace Integration;

use App\Application;
use App\Container;
use App\Enum\CurrencyEnum;
use App\Services\BinList\BinListServiceInterface;
use App\Services\ExchangeRates\ExchangeRatesServiceInterface;
use App\Services\ExchangeRates\Response\RateCollection;
use App\Services\ExchangeRates\Response\RateItem;
use App\Services\FeeService;
use App\Services\InputFileService;
use App\Services\TransactionService;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class CalculateTest extends TestCase
{
    private function createMockBinList($countyCode)
    {
        $mockBinList = $this->createMock(BinListServiceInterface::class);
        $mockBinList
            ->method('getCountryCodeByBin')
            ->willReturn($countyCode);

        return $mockBinList;
    }

    private function createMockExchangeRate(RateCollection $ratesCollection)
    {
        $mockExchangeRatesService = $this->createMock(ExchangeRatesServiceInterface::class);
        $mockExchangeRatesService
            ->method('getRates')
            ->willReturn($ratesCollection);

        return $mockExchangeRatesService;
    }

    private function createRatesCollection(CurrencyEnum $currencyEnum, float $rate): RateCollection
    {
        $rateCollection = new RateCollection();
        $rateCollection->add(new RateItem($currencyEnum, $rate));

        return $rateCollection;
    }

    #[TestWith(['DK', 'EUR', 1, 100., 1])]
    #[TestWith(['LT', 'USD', 1.081438, 50., 0.5])]
    #[TestWith(['JP', 'JPY', 174.438041, 10000., 200.])]
    #[TestWith(['US', 'USD', 1.081473, 130., 2.6])]
    #[TestWith(['LT', 'GBP', 0.8457, 2000., 20.])]
    #[TestWith(['', 'EUR', 1, 100., 2.])]
    public function testCalculate($countyCode, $currencyCode, $rate, $amount, $expected)
    {
        $currencyEnum = CurrencyEnum::fromCode($currencyCode);
        $ratesCollection = $this->createRatesCollection($currencyEnum, $rate);

        $di = new Container();
        $app = new Application(
            $di->get(InputFileService::class),
            $di->get(TransactionService::class),
            $di->get(FeeService::class),
            $this->createMockBinList($countyCode),
            $this->createMockExchangeRate($ratesCollection)
        );

        $this->assertEquals($expected, $app->calculateFee('', $ratesCollection, $currencyEnum, $amount));
    }
}
