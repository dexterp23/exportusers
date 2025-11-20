<?php

namespace App\Service\Mail;

use App\Utils\EmailTemplates;
use Psr\Container\ContainerInterface;
use Roles\Entity\Role;

class MailBodyBuilderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $emailTemplates = new EmailTemplates($config);

        $dataEnricher = new MailDataEnricher();
        $renderer = new MailRenderer();

        return new MailBodyBuilder(
            $dataEnricher,
            $renderer,
            $emailTemplates
        );
    }
}
