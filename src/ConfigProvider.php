<?php

declare(strict_types=1);

namespace Dexlib\ExportUsers;

use Dexlib\ExportUsers\Service\Export\ExportUsersService;
use Dexlib\ExportUsers\Service\Export\ExportUsersServiceFactory;
use Dexlib\ExportUsers\Service\CSV\UserCSVExport;
use Dexlib\ExportUsers\Service\CSV\UserCSVExportFactory;
use Dexlib\ExportUsers\Service\Mail\SmtpMailSender;
use Dexlib\ExportUsers\Service\Mail\SmtpMailSenderFactory;
use Dexlib\ExportUsers\Service\Mail\LaminasMailMessageBuilder;
use Dexlib\ExportUsers\Service\Mail\LaminasMailMessageBuilderFactory;
use Dexlib\ExportUsers\Service\Mail\MailBodyBuilder;
use Dexlib\ExportUsers\Service\Mail\MailBodyBuilderFactory;
use Mezzio\Hal\Metadata\MetadataMap;

/**
 * The configuration provider for the OpenApis module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'routes' => $this->getRoutes(),
             MetadataMap::class => $this->getHalMetadataMap(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                ExportUsersService::class => ExportUsersServiceFactory::class,
                UserCSVExport::class => UserCSVExportFactory::class,
                SmtpMailSender::class => SmtpMailSenderFactory::class,
                LaminasMailMessageBuilder::class => LaminasMailMessageBuilderFactory::class,
                MailBodyBuilder::class => MailBodyBuilderFactory::class,
            ],
        ];
    }

    public function getRoutes(): array
    {
        return [

        ];
    }

    public function getHalMetadataMap()
    {
        return [

        ];
    }
}
