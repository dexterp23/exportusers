<?php

namespace Dexlib\ExportUsers\Service\Mail;

use Psr\Container\ContainerInterface;

class SmtpMailSenderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $smtpOptions = new SmtpOptions($config);
        $laminasMailMessageBuilder = $container->get(LaminasMailMessageBuilder::class);

        return new SmtpMailSender(
            $smtpOptions,
            $laminasMailMessageBuilder
        );
    }
}
