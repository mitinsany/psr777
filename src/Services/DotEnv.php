<?php

namespace App\Services;

class DotEnv
{
    private const DOTENV_FILE = '.env';
    private static array $config;

    public static function load(string $path)
    {
        if (!file_exists($path)) {
            return;
        }
        $dotenvContent = file_get_contents($path . DIRECTORY_SEPARATOR . self::DOTENV_FILE);
        $lines = explode(PHP_EOL, $dotenvContent);
        foreach ($lines as $line) {
            $parts = explode('=', $line);
            if (count($parts) === 2) {
                self::$config[$parts[0]] = $parts[1];
            }
        }
    }

    public static function get(string $key): int|string|null
    {
        return array_key_exists($key, self::$config)
            ? self::$config[$key]
            : null;
    }
}
