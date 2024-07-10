<?php

use App\Repositories\Env;

function env(string $paramName, $default = null)
{
    return Env::get($paramName) ?? $default;
}
