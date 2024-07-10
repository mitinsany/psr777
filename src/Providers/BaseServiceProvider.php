<?php

namespace App\Providers;

use App\Container;
use App\Repositories\Config;

abstract class BaseServiceProvider
{
    protected Container $container;
    protected Config $config;

    public function __construct(Container $container, Config $config)
    {
        $this->container = $container;
        $this->config = $config;
    }
}
