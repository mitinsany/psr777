<?php

namespace App\Services;

use App\DTO\TransactionDTO;

class InputFileService
{
    public function readFile(string $filePath): string
    {
        return trim(file_get_contents($filePath));
    }

    public function explodeBy(string $data, string $separator = "\n"): array
    {
        return explode($separator, $data);
    }

    /**
     * @param string $filePath
     * @return array<TransactionDTO>
     */
    public function parseFile(string $filePath): array
    {
        $result = [];
        $data = $this->explodeBy($this->readFile($filePath));

        foreach ($data as $row) {
            if (empty($row)) {
                break;
            }
            $result[] = json_decode($row, true);
        }

        return $result;
    }
}
