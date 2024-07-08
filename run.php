<?php

require_once 'vendor/autoload.php';

\App\Services\DotEnv::load(__DIR__);

$app = new \App\Application(
    new App\Services\InputFileService(),
    new \App\Services\TransactionService(new App\Factories\TransactionDTOFactory(), new \App\Services\CurrencyRateService()),
    new \App\Services\FeeService(),
    new \App\Services\BinList\BinListService(new \App\Services\BinList\BinListApiClient()),
    new \App\Services\ExchangeRates\ExchangeRatesService(
        new \App\Services\ExchangeRates\ExchangeRatesApiClient(\App\Services\DotEnv::get('ACCESS_KEY'))
    )
);

$app->setInputFileMame(__DIR__ . DIRECTORY_SEPARATOR . $argv[1]);
$fees = $app->calculateFees();
$app->outputArray($fees);