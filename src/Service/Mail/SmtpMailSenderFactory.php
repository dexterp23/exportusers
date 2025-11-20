<?php

namespace App\Service\Mail;

use OptimaApps\Logger\Logger;
use Psr\Container\ContainerInterface;

class SmtpMailSenderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $logger = Logger::getInstance();
        if (isset($config['logger'])) {
            $logger->setConfig($config['logger']);
        }
        $smtpOptions = new SmtpOptions($config);
        $laminasMailMessageBuilder = $container->get(LaminasMailMessageBuilder::class);

        return new SmtpMailSender(
            $smtpOptions,
            $laminasMailMessageBuilder,
            $logger
        );
    }
}
