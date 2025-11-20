<?php

namespace App\Service\Mail;

use Laminas\Mail\Transport\SmtpOptions as LaminasSmtpOptions;

class SmtpOptions implements SmtpOptionsInterface
{
    protected array $config;

    public function __construct(
        array $config,
    ) {
        $this->config = $config;
    }

    public function getSmtpOptions(): LaminasSmtpOptions
    {
        $config = $this->config;
        //set up
        $mailCofig = [
            'host'              => $config['smtpSettings']['server']['host'],
            'port'              => $config['smtpSettings']['server']['port'],
            'connection_time_limit' => 300,
        ];
        if (!empty($config['smtpSettings']['server']['ssl'])) {
            $mailCofig['connection_config']['ssl'] = $config['smtpSettings']['server']['ssl'];
        }
        if (!empty($config['smtpSettings']['auth'])) {
            $mailCofig['connection_class'] = 'login';
            $mailCofig['connection_config']['username'] = $config['smtpSettings']['auth']['username'];
            $mailCofig['connection_config']['password'] = $config['smtpSettings']['auth']['password'];
        }

        return new LaminasSmtpOptions($mailCofig);
    }
}
