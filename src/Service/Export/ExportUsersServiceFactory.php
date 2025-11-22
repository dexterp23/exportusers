<?php

namespace Dexlib\ExportUsers\Service\Export;

use Dexlib\ExportUsers\Service\Export\ExportUsersService;
use Dexlib\ExportUsers\Service\CSV\UserCSVExport;
use Dexlib\ExportUsers\Service\Mail\MailAttachmentCreate;
use Dexlib\ExportUsers\Service\Mail\MailMessageBuilder;
use Dexlib\ExportUsers\Service\Mail\SmtpMailSender;
use Dexlib\ExportUsers\Service\Mail\EmailTemplates;
use Dexlib\ExportUsers\Service\Mail\MailBodyBuilder;
use Dexlib\ExportUsers\Utils\FilenameGenerator;
use Psr\Container\ContainerInterface;

class ExportUsersServiceFactory
{
    public function __invoke(ContainerInterface $container): ExportUsersService
    {
        $config = $container->get('config');
        $userCSVExport = $container->get(UserCSVExport::class);
        $filenameGenerator = new FilenameGenerator();
        $mailAttachmentCreate = new MailAttachmentCreate();
        $mailMessageBuilder = new MailMessageBuilder();
        $smtpMailSender = $container->get(SmtpMailSender::class);
        $mailBodyBuilder = $container->get(MailBodyBuilder::class);
        $emailTemplates = new EmailTemplates($config);

        return new ExportUsersService(
            $config,
            $userCSVExport,
            $filenameGenerator,
            $mailAttachmentCreate,
            $mailMessageBuilder,
            $smtpMailSender,
            $mailBodyBuilder,
            $emailTemplates
        );
    }
}
