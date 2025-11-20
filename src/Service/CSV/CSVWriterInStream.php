<?php

namespace App\Service\CSV;

class CSVWriterInStream implements CSVWriterInterface
{
    private $fileHandle;

    public function __construct()
    {
        $this->fileHandle = fopen('php://temp', 'r+');

        if ($this->fileHandle === false) {
            throw new \RuntimeException('Failed to open temp file for CSV writing');
        }
    }

    public function writeHeader(array $header): void
    {
        fputcsv($this->fileHandle, $header);
    }

    public function writeRow(array $row): void
    {
        fputcsv($this->fileHandle, $row);
    }

    public function getContent(): string
    {
        rewind($this->fileHandle);
        $content = stream_get_contents($this->fileHandle);

        if ($content === false) {
            throw new \RuntimeException('Failed to read CSV content');
        }

        return $content;
    }

    public function __destruct()
    {
        if (is_resource($this->fileHandle)) {
            fclose($this->fileHandle);
        }
    }
}
