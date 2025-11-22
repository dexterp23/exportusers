<?php

namespace Dexlib\ExportUsers\Service\Mail;

class EmailTemplates implements EmailTemplatesInterface
{
    protected const EMAIL_TEMPLATE_FOLDER = '/var/www/html/vendor/dexterp23/exportusers/data/templates/mail/';
    public const MAIL_EXPORT_USERS = 'exportUsers';

    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getMailTemplate(string $key): string
    {
        $array = [
            self::MAIL_EXPORT_USERS => self::EMAIL_TEMPLATE_FOLDER . 'exportUsers.phtml',
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
