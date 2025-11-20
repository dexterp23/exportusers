<?php

namespace App\Service\CSV;

use Psr\Container\ContainerInterface;

class UserCSVExportFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $csvWriter = new CSVWriterInStream();
        $formatter = new UserCSVFormatter();

        return new UserCSVExport(
            $csvWriter,
            $formatter
        );
    }
}
