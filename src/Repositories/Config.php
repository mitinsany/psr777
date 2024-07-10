<?php

namespace App\Repositories;

class Config
{
    private const CONFIG_DIR = __DIR__ . '/../../config';
    private array $config = [];

    public function __construct()
    {
        $files = scandir(self::CONFIG_DIR);
        foreach ($files as $fileName) {
            if (in_array($fileName, ['.', '..'])) {
                continue;
            }
            $info = pathinfo($fileName);
            $this->config[$info['filename']] = require_once self::CONFIG_DIR . '/' . $fileName;
        }
    }

    public function get(string $path): int|string|array
    {
        $pathParts = explode('.', $path);
        return count($pathParts) > 1
            ? $this->config[$pathParts[0]][$pathParts[1]]
            : $this->config[$pathParts[0]];
    }
}
