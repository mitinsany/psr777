<?php

require_once 'vendor/autoload.php';

/** @var \App\Application $app */
$app = (new App\Container())->get(\App\Application::class);

$app->setInputFileMame(__DIR__ . DIRECTORY_SEPARATOR . $argv[1]);
$fees = $app->calculate();
$app->outputArray($fees);
