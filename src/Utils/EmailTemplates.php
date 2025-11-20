<?php

namespace App\Utils;

class EmailTemplates implements EmailTemplatesInterface
{
    public const DEFAULT_LANGUAGE = 'de';

    public const MAIL_MFA = 'mfa';
    public const MAIL_SIGNATURE = 'signatureAndLogo';
    public const MAIL_EXPORT_USERS = 'exportUsers';

    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getMailTemplate($key)
    {
        $folder = self::DEFAULT_LANGUAGE;
        $array = [
            self::MAIL_MFA => $this->config['mailFolder'] . $folder . '/mfa.phtml',
            self::MAIL_SIGNATURE => $this->config['mailFolder'] . $folder . '/signatureAndLogo.phtml',
            self::MAIL_EXPORT_USERS => $this->config['mailFolder'] . $folder . '/exportUsers.phtml',
        ];
        return $array[$key];
    }

    public function getMailSubject($key)
    {
        $array = [
            self::MAIL_MFA => 'MFA-Schlüssel zum Real Garant Garantieverwaltungssystem',
            self::MAIL_EXPORT_USERS => 'Benutzer exportieren'
        ];
        return $array[$key];
    }
}
