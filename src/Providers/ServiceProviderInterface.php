<?php

namespace App\Providers;

use App\Container;

interface ServiceProviderInterface
{
    public function register(Container $container): void;
}
