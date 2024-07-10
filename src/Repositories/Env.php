<?php

namespace App\Repositories;

class Env
{
    protected static bool $loaded = false;
    protected static array $config;

    public static function load(string $envFile): void
    {
        if (self::$loaded) {
            return;
        }
        $content = file_get_contents($envFile);
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            $parts = explode('=', $line);
            if (count($parts) === 2) {
                self::$config[$parts[0]] = $parts[1];
            } else {
                $partsExploded = $parts;
                unset($partsExploded[0]);
                self::$config[$parts[0]] = implode('=', $partsExploded);
            }
        }
        self::$loaded = true;
    }

    public static function get(string $key): int|string|null
    {
        self::load(__DIR__ . '/../../.env');
        return self::$config[$key] ?? null;
    }

    public static function has(string $key): bool
    {
        return !empty($self::$config[$key]);
    }

    public static function all(): array
    {
        return self::$config;
    }
}
