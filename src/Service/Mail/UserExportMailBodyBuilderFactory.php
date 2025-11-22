<?php

namespace Dexlib\ExportUsers\Service\Mail;

use Dexlib\ExportUsers\Utils\EmailTemplates;
use Psr\Container\ContainerInterface;
use Roles\Entity\Role;

class UserExportMailBodyBuilderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $entityManager = $container->get('doctrine.entity_manager.orm_default');
        $roleRepository = $entityManager->getRepository(Role::class);
        $emailTemplates = new EmailTemplates($config);

        $roleNameResolver = new RoleNameResolver($roleRepository);
        $dataEnricher = new UserExportMailDataEnricher($roleNameResolver);
        $renderer = new MailRenderer();

        return new UserExportMailBodyBuilder(
            $dataEnricher,
            $renderer,
            $emailTemplates
        );
    }
}
