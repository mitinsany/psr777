<?php

namespace App;

use App\Enum\CountryEnum;
use App\Exceptions\BinListApiClientException;
use App\Exceptions\ExchangeRatesApiClientException;
use App\Services\BinList\BinListServiceInterface;
use App\Services\ExchangeRates\ExchangeRatesServiceInterface;
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

    public function calculateFees(): array
    {
        $result = [];

        $fileItems = $this->inputFileService->parseFile($this->inputFileMame);
        $transactionDTOs = $this->transactionService->createFromArray($fileItems);

        foreach ($transactionDTOs as $transactionDTO) {
            $result[] = $this->calculateByDTO($transactionDTO);
        }

        return $result;
    }

    /**
     * @throws BinListApiClientException
     * @throws ExchangeRatesApiClientException
     */
    private function calculateByDTO($transactionDTO): float
    {
        $isEuropeanCountryCode = CountryEnum::isEuropeanCountryCode(
            $this->binListService->getCountryCodeByBin($transactionDTO->getBin())
        );

        $exchangeRatesResponse = $this->exchangeRatesService->getLatest()->getRates();
        $responseCurrencyItem = $exchangeRatesResponse->getByCurrency($transactionDTO->getCurrency()->name);
        $rate = $responseCurrencyItem->getRate();
        $amountFixed = $this->transactionService->amountFixed($transactionDTO, $rate);
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
