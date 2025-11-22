<?php

namespace Dexlib\ExportUsers\Service\Mail;

class EmailTemplates implements EmailTemplatesInterface
{
    public const MAIL_EXPORT_USERS = 'exportUsers';

    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getMailTemplate(string $key): string
    {
        $array = [
            self::MAIL_EXPORT_USERS => $this->config['mailFolder'] . '/exportUsers.phtml',
        ];
        return $array[$key];
    }

    public function getMailSubject(string $key): string
    {
        $array = [
            self::MAIL_EXPORT_USERS => 'Export Users'
        ];
        return $array[$key];
    }
}
