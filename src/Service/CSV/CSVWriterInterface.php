<?php

namespace App\Service\CSV;

interface CSVWriterInterface
{
    public function writeHeader(array $header): void;
    public function writeRow(array $row): void;
    public function getContent(): string;
}
