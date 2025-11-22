<?php

namespace Dexlib\ExportUsers\Service\CSV;

interface CSVWriterInterface
{
    public function writeHeader(array $header): void;
    public function writeRow(array $row): void;
    public function getContent(): string;
}
