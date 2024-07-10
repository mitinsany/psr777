<?php

namespace App;

use App\Enum\CountryEnum;
use App\Enum\CurrencyEnum;
use App\Services\BinList\BinListServiceInterface;
use App\Services\ExchangeRates\ExchangeRatesServiceInterface;
use App\Services\ExchangeRates\Response\RateCollection;
use App\Services\FeeService;
use App\Services\InputFileService;
use App\Services\TransactionService;

class Application
{
    private string $inputFileMame;

    public function __construct(
        private InputFileService $inputFileService,
        private TransactionService $transactionService,
        private FeeService $feeService,
        private BinListServiceInterface $binListService,
        private ExchangeRatesServiceInterface $exchangeRatesService
    ) {
    }

    public function setInputFileMame(string $inputFileMame): void
    {
        $this->inputFileMame = $inputFileMame;
    }

    public function calculate(): array
    {
        $fileItems = $this->inputFileService->parseFile($this->inputFileMame);
        $transactionDTOs = $this->transactionService->createFromArray($fileItems);
        $ratesCollection = $this->exchangeRatesService->getRates();
        return $this->calculateFees($transactionDTOs, $ratesCollection);
    }

    public function calculateFees(array $transactionDTOs, RateCollection $ratesCollection): array
    {
        $result = [];

        foreach ($transactionDTOs as $transactionDTO) {
            $result[] = $this->calculateFee(
                $transactionDTO->getBin(),
                $ratesCollection,
                $transactionDTO->getCurrency(),
                $transactionDTO->getAmount()
            );
        }

        return $result;
    }

    public function calculateFee(
        string $bin,
        RateCollection $rateCollection,
        CurrencyEnum $currency,
        float $amount
    ): float {
        $countryCode = $this->binListService->getCountryCodeByBin($bin);
        $isEuropeanCountryCode = $countryCode && CountryEnum::isEuropeanCountryCode($countryCode);
        $responseCurrencyItem = $rateCollection->getByCurrency($currency->name);
        $rate = $responseCurrencyItem->getRate();

        $amountFixed = $this->transactionService->amountFixed($currency->isEUR(), $amount, $rate);
        $fee = $this->feeService->getFeeRate($isEuropeanCountryCode);
        $amountFee = $this->feeService->getAmountFee($amountFixed, $fee);

        return $this->feeService->round($amountFee);
    }

    public function output(string $line): void
    {
        print $line . PHP_EOL;
    }

    public function outputArray(array $lineArray): void
    {
        foreach ($lineArray as $line) {
            $this->output($line);
        }
    }
}
