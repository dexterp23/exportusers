<?php

namespace Dexlib\ExportUsers\Service\CSV;

class UserCSVExport implements UserCSVExportInterface
{
    private CSVWriterInterface $csvWriter;
    private UserCSVFormatterInterface $formatter;

    public function __construct(
        CSVWriterInterface $csvWriter,
        UserCSVFormatterInterface $formatter
    ) {
        $this->csvWriter = $csvWriter;
        $this->formatter = $formatter;
    }

    public function add(array $users, array $header = []): void
    {
        if (!empty($header)) {
            $this->csvWriter->writeHeader($header);
        }

        foreach ($users as $user) {
            $row = $this->formatter->format($user);
            $this->csvWriter->writeRow($row);
        }
    }

    public function export(): string
    {
        return $this->csvWriter->getContent();
    }
}
